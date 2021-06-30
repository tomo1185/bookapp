<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DateCalculationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($login_user, $my_charts)
    {
        // dd($login_user);
        $month = [];
        // 今日の経過時間(月初めと月末の日付の時間が0時0分になるよう、時間調整のために用いる)
        $todays_elapsed_time = strtotime('now') - strtotime('today');
        for ($i = 0; $i < 6; $i++) {
            // 6ヶ月間の月初め、月末日、日数を求める
            $month[$i] =[
                'date' => date("Y年m月", strtotime('today -' . $i . ' month')),
                'first_day' => strtotime('first day of -' . $i . ' month') - $todays_elapsed_time,
                'last_day' =>  (strtotime('last day of -' . $i . ' month') - $todays_elapsed_time ) + 86399,
                'monthly_reading_result' => 0,
            ];
            
            foreach ($my_charts as $my_chart => $value) {
                $updated_at = strtotime($value->updated_at); // mychartテーブルの項目のアップデート日をタイムスタンプに変換
                # 過去6ヶ月間の月ごとに読んだ書籍数をカウントする
                if ( $month[$i]["first_day"] <= $updated_at && $updated_at <= $month[$i]["last_day"]) {
                    $month[$i]['monthly_reading_result'] += $value->read_book_counter;
                }
            }
        }
        return $month;
    }
}
