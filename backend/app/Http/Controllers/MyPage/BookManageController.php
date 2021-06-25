<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookInformation;
use App\Models\ReadingRecord;
use App\Models\MyChart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Mockery\Undefined;


class BookManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('verified');
    }
    /**,
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mypage.book.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1.入力情報を取得・その他前処理
        $login_user = Auth::id();
        // var_dump($login_user);
        $book_info = new BookInformation();
        $read_book_counter = 0; // 読書数をカウントする変数

        // 2.重複チェック(書籍タイトルと著者名)
        $input_book_title = $request->input('book_title');
        $input_author_name = $request->input('author_name');
        // book_informationテーブルから書籍名と著者を取得
        $DB_books = DB::table('book_information')
            ->select('book_title', 'author_name')
            ->where('registant_id', $login_user)
            ->get();

        // 3.入力情報とbook_informationテーブルの保存内容の比較処理
        $save_flg = 1;  // $save_flg 1:保存する 0:保存しない
        foreach ($DB_books as $key => $value) {
            $DB_book = $value->book_title;
            $DB_author = $value->author_name;
            if ($input_book_title !== $DB_book || $input_author_name !== $DB_author) {
            } else {
                $save_flg = 0;
                break;
            }
        }
        // dd($save_flg);
        // 4.保存処理
        if ($save_flg == 1) {
            // book_informationテーブルに書籍登録時の入力データをセット
            $book_info->registant_id = $login_user;
            $book_info->author_name = $request->input('author_name');
            $book_info->author_name_kana = $request->input('author_name_kana');
            $book_info->book_title = $request->input('book_title');
            $book_info->book_title_kana = $request->input('book_title_kana');
            $book_info->memo = $request->input('memo');
            // dd($request->input('favorite'));
            if ($request->input('favorite') == "1") {
                $book_info->favorite = 1;
            } else {
                $book_info->favorite = 0;
            }
            $book_info->number_of_volumes = $request->input('number_of_volumes');
            // dd($book_info);
            $book_info->save();

            // readeing_recordsテーブルに書籍登録時の入力データをセット
            $newbook_id = DB::table('book_information')
                ->select('id')
                ->where('registant_id', $login_user)
                ->orderByDesc('id')
                ->first();
            $cnt = intval($request->input('number_of_volumes'));
            for ($i = 1; $i <= $cnt; $i++) {
                $reading_record = new ReadingRecord();
                $reading_record->book_title_id = $newbook_id->id;
                $reading_record->registant_id = $login_user;
                $read_state = $request->input('read_state');
                $reading_record->book_volume = $i;
                $reading_record->read_state = $read_state[$i];
                $reading_record->save();
                if ($reading_record->read_state == '既読') {
                    $read_book_counter++;
                }
                // var_dump($reading_record->read_state);
            }
            // 5. my_chartテーブルの作成
            $my_chart = new MyChart();
            $my_chart->user_id = $login_user;
            $my_chart->read_book_counter = $read_book_counter;
            $my_chart->save();
        }
        return redirect('mypage/book/register');
    }



    public function search()
    {
        $login_user = Auth::id();
        $book_info_data = DB::table('book_information')
            // ->join('reading_records', 'book_information.book_title_id', '=', 'reading_records.book_title_id')
            ->select('favorite', 'author_name', 'author_name_kana', 'book_title', 'book_title_kana',  'number_of_volumes', 'id')
            ->where('registant_id', $login_user)
            ->get();
        // dd($book_info_data);

        return view('mypage.book.title_search', compact('book_info_data'));
    }

    public function detail($id)
    {
        $book_info_data = BookInformation::find($id);
        $reading_record_data = DB::table('reading_records')
        ->select('id', 'book_volume', 'read_state', 'book_title_id')
        ->where('book_title_id', $id)
        ->get();
        
        return view('mypage.book.detail', compact('book_info_data', 'reading_record_data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 編集画面に表示する書籍タイトルの項目を取得
        // $book_info_data = DB::table('book_information')
        //     ->select('id', 'author_name', 'author_name_kana', 'book_title', 'number_of_volumes')
        //     ->where('id', $id)
        //     ->first();

        $book_info_data = BookInformation::find($id);
        // dd($book_info_data);

        $reading_record_data = DB::table('reading_records')
            ->select('id', 'book_volume', 'read_state', 'book_title_id')
            ->where('book_title_id', $id)
            ->get();
            
            return view('mypage.book.edit', compact('book_info_data', 'reading_record_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 1.前処理
        $login_user = Auth::id();
        $book_info_data = BookInformation::find($id);
        $bf_number_of_volumes = $book_info_data->number_of_volumes;
        $read_book_counter = 0;  // 読書数をカウントする変数
        $reading_records = DB::table('reading_records')
            ->select('*')
            ->where('book_title_id', $id)
            ->get();

        foreach ($reading_records as $key => $value) {
            $bf_read_state[$key + 1] = $value->read_state;
        }
        // dd($bf_read_state);
        // 2.重複チェックの準備
        $save_flg = 1;  // $save_flg 1:保存する 0:保存しない
        $input_book_title = $request->input('book_title');
        $input_author_name = $request->input('author_name');

        // BookInformationテーブルの項目値(書籍名か著者)に変更があれば重複チェックを行う
        if ($book_info_data->book_title !== $input_book_title || $book_info_data->author_name !== $input_author_name) {
            // book_informationテーブルから書籍名と著者を取得
            $DB_books = DB::table('book_information')
                ->select('book_title', 'author_name')
                ->where('registant_id', $login_user)
                ->get();
            foreach ($DB_books as $key => $value) {
                $DB_book = $value->book_title;
                $DB_author = $value->author_name;
                // 3.重複チェック(入力情報とbook_informationテーブルの保存内容)
                if ($input_book_title !== $DB_book || $input_author_name !== $DB_author) {
                    // echo "通過2";
                } else {
                    $save_flg = 0;
                    break;
                }
            }
        }
        // dd($save_flg);
        if ($save_flg == 1) {
            // 4-1.更新処理(book_informationテーブル)
            // book_informationテーブルに書籍登録時の入力データをセット後更新
            $book_info_data->registant_id = $login_user;
            $book_info_data->author_name = $request->input('author_name');
            $book_info_data->author_name_kana = $request->input('author_name_kana');
            $book_info_data->book_title = $request->input('book_title');
            $book_info_data->book_title_kana = $request->input('book_title_kana');
            $book_info_data->memo = $request->input('memo');
            // dd($request->input('favorite'));
            if ($request->input('favorite') == "1") {
                $book_info_data->favorite = 1;
            } else {
                $book_info_data->favorite = 0;
            }
            // dd($book_info_data);
            $book_info_data->number_of_volumes = $request->input('number_of_volumes');
            $book_info_data->save();

            // 4-2.更新処理(reading_recordテーブル)
            // readeing_recordsテーブルに書籍登録時の入力データをセット
            $cnt = intval($request->input('number_of_volumes'));
            // $reading_record_data = ReadingRecord::find($id);
            // $reading_record_data = DB::table('reading_records')
            // ->select('*')
            // ->where('book_title_id', $id)
            // ->limit(1)
            // ->get();
            // echo ('<pre>');
            // echo "reading_record_data=" . $reading_record_data;
            // echo ('</pre>');
            // dd($reading_record_data);
            $num_diff = $cnt - $bf_number_of_volumes;
            // ・巻数が増えていたらINSERT処理
            // ・巻数が減っていたらDELETE処理
            // ・最後にUPDATE処理
            if ($num_diff > 0) {
                // NSERT処理
                for ($i = $bf_number_of_volumes + 1; $i <= $cnt; $i++) {
                    // echo "insert". $i . "=" . $read_state[$i-1];
                    $read_state = $request->input('read_state');
                    // $reading_record_data->insert([
                        DB::table('reading_records')
                        ->insert([
                            'book_title_id' => $id,
                            'registant_id' => $login_user,
                            'book_volume' => $i,
                            'read_state' => $read_state[$i],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                            // ->where('book_title_id', $id),
                            
                        ]);
                    // ]);
                }
            } elseif ($num_diff < 0) {
                //  DELETE処理
                for ($j = $bf_number_of_volumes; $j > $cnt; $j--) {
                    // DELETE処理を行う書籍が既読状態だった場合、読書カウント数を減少させる
                    // echo ('<pre>');
                    // echo "j=" . $j;
                    // echo ('</pre>');
                    if ($bf_read_state[$j] == '既読') {
                        $read_book_counter--;
                    }
                    DB::table('reading_records')
                    ->where('book_title_id', $id)
                    ->where('book_volume', $j)
                    ->delete();

                    // $reading_record_data
                    // ->where('book_title_id', $id)
                    // ->where('book_volume', $j)
                    // ->delete();
                }
            }
            // dd($reading_record_data);
            //  UPDATE処理と読書数の増減カウント処理
            for ($k = 1; $k <= $cnt; $k++) {
                // 読書数の増減カウント処理
                // echo "update". $k . "=" . $bf_read_state[$k]; 読書数カウント確認用
                $read_state = $request->input('read_state');
                if (isset($bf_read_state[$k])) {
                    if ($bf_read_state[$k] == '未読' && $read_state[$k] == '既読') {
                        $read_book_counter++;
                    } elseif ($bf_read_state[$k] == '既読' && $read_state[$k] == '未読') {
                        $read_book_counter--;
                    }
                } elseif ($read_state[$k] == '既読') {
                    $read_book_counter++;
                }
                // echo 'read_book_counter=' . $read_book_counter . '\n';

                // UPDATE処理
                DB::table('reading_records')
                ->where('book_title_id', $id)
                ->where('book_volume', $k)
                ->update([
                    'read_state' => $read_state[$k],
                    'book_volume' => $k,
                    'updated_at' => Carbon::now(),
                ]);
                // $reading_record_data
                //     ->where('book_volume', $k)
                //     ->where('book_title_id', $id)
                //     ->update([
                //         'read_state' => $read_state[$k],
                //         'book_volume' => $k,
                //         'updated_at' => Carbon::now()
                //     ]);
            };
            // 5.my_chartテーブルの作成
            $my_chart = new MyChart();
            $my_chart->user_id = $login_user;
            $my_chart->read_book_counter = $read_book_counter;
            $my_chart->save();
            return redirect('mypage/home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book_info_data = BookInformation::find($id);
        $aaa = DB::table('reading_records')
        ->where('book_title_id', $id)
        ->delete();
        $book_info_data->delete();
        return redirect('/mypage/book/title_search');
    }
}
