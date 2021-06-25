@extends('adminlte::page')

@section('title', 'マイページホーム')

@section('content_header')
    {{-- <h1>Dashboard</h1> --}}
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">ホーム</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">ホーム</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@stop
@section('content')
    <p id="greeting">{{ $users->name }}さん、おかえりなさい</p>

    <!--------------------------------
     Chart.jsによる読書記録グラフ
    --------------------------------->
    <!-- Chart.js読み込み -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    
    <div>
        <canvas id="myChart"></canvas>
    </div>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // 作成したいチャートタイプ
            type: 'line',
            // データセットの情報
            data: {
                labels: [
                    @for ($i = 5; $i >= 0; $i--)
                        "{{ $monthly_reading[$i]['date'] }}",
                    @endfor
                ],
                datasets: [{
                    label: "読書推移",
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [
                        @for ($i = 5; $i >= 0; $i--)
                            "{{ $monthly_reading[$i]['monthly_reading_result'] }}",
                        @endfor

                    ],
                }]
            },

            // 設定オプションはここに
            options: {
                // title: {
                //     display: true,
                //     text: '{{ $users->name }}さんの読書記録'
                // }
            }
        });

    </script>
    <div class="recently_read">
        <h5 id="recently-read-book">最近記録した書籍タイトル</h5>
        @php
            $heads = [['label' => '♡', 'width' => 5], '著者', '著者カナ',  '書籍名','書籍名カナ', ['label' => '最終更新日', 'width' => 15]];
            $config = [
                'order' => [[2, 'desc']],
            ];
        @endphp
        {{-- Minimal example / fill data using the component slot --}}
        <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" striped hoverable bordered compressed :config="$config">
            @foreach ($book_information as $item)
                <tr>
                    @if ($item->favorite == 1 )
                    <td class="favorite"><i class="fas fa-heart"></i></td>
                    @else
                        <td class="favorite">-</td>
                    @endif
                    <td>{{ $item->author_name }}</td>
                    <td>{{ $item->author_name_kana }}</td>
                    <td>{{ $item->book_title }}</td>
                    <td>{{ $item->book_title_kana }}</td>
                    <td>{{ $item->updated_at }}</td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </div> <!-- .recently_read -->
@stop
@section('css')
    <link rel="stylesheet" href="/css/style.css">
@stop
@section('js')
<script src="https://kit.fontawesome.com/99aa88c827.js" crossorigin="anonymous"></script>
@stop
