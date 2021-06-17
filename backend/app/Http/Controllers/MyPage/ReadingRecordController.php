<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookInformation;
use App\Models\ReadingRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReadingRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('verified');
    }

    public function index()
    {
        $login_user = Auth::id();
        $book_information = DB::table('book_information')
        // ->join('reading_records', 'book_information.book_title_id', '=', 'reading_records.book_title_id')
        ->select('author_name', 'book_title', 'number_of_volumes')
        ->where('book_information.registant_id', $login_user)
        ->get();

        // ページで表示するユーザー名を取得
        $users = DB::table('users')
        ->select('name')
        ->where('id', $login_user)
        ->first();


        $my_charts = DB::table('my_charts')
        ->select('*')
        ->where('user_id', $login_user)
        ->get();

        // DateCalculationController 読み込み(日付と各月の読書数を計算)
        $date_calculation = app()->make('App\Http\Controllers\MyPage\DateCalculationController');
        $monthly_reading = $date_calculation->index($login_user, $my_charts);
        // echo('<pre>');
        // var_dump($month);
        // echo('<pre>');
        return view('mypage.home', compact('book_information', 'monthly_reading', 'users'));
    }
}
