<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookInformation;
use App\Models\ReadingRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        // 1.入力情報を取得
        $login_user = Auth::id();
        // var_dump($login_user);
        $book_info = new BookInformation();

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
            $book_info->number_of_volumes = $request->input('number_of_volumes');
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
                // var_dump($reading_record->read_state);
            }
        }
        return redirect('mypage/book/register');
    }



    public function search()
    {
        $login_user = Auth::id();
        $book_info_data = DB::table('book_information')
            // ->join('reading_records', 'book_information.book_title_id', '=', 'reading_records.book_title_id')
            ->select('author_name', 'book_title', 'number_of_volumes', 'id')
            ->where('registant_id', $login_user)
            ->get();
        // dd($book_info_data);

        return view('mypage.book.title_search', compact('book_info_data'));
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

        $reading_record_data = DB::table('reading_records')
            ->select('id', 'book_volume', 'read_state', 'book_title_id')
            ->where('book_title_id', $id)
            ->get();
        // dd($reading_record_data);

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
            $book_info_data->number_of_volumes = $request->input('number_of_volumes');
            $book_info_data->save();

            // 4-2.更新処理(reading_recordテーブル)
            // readeing_recordsテーブルに書籍登録時の入力データをセット
            $cnt = intval($request->input('number_of_volumes'));
            $reading_record_data = ReadingRecord::find($id);
            $num_diff = $cnt - $bf_number_of_volumes;

            // ・巻数が増えていたらINSERT処理
            // ・巻数が減っていたらDELETE処理
            // ・最後にUPDATE処理
            if ($num_diff > 0) {
                // NSERT処理
                for ($i = $bf_number_of_volumes + 1; $i <= $cnt; $i++) {
                    $read_state = $request->input('read_state');
                    $reading_record_data->insert([
                        'book_title_id' => $id,
                        'registant_id' => $login_user,
                        'book_volume' => $i,
                        'read_state' => $read_state[$i],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }
            } elseif ($num_diff < 0) {
                //  DELETE処理
                for ($j = $bf_number_of_volumes; $j > $cnt; $j--) {
                    $reading_record_data->where('book_volume', $j)
                        ->delete();
                }
            }
            //  UPDATE処理
            for ($k = 1; $k <= $cnt; $k++) {
                $read_state = $request->input('read_state');
                $reading_record_data->where('book_volume', $k)
                    ->update([
                        'read_state' => $read_state[$k],
                        'book_volume' => $k,
                        'updated_at' => Carbon::now()
                    ]);
            }
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
        //
    }
}
