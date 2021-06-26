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
        <table class="display" id="myTable">
            <thead>
                <tr>
                    <th>♡</th>
                    <th>著者</th>
                    <th>著者かな</th>
                    <th>書籍名</th>
                    <th>書籍名かな</th>
                    <th>更新日</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($book_information as $item)
                    <tr>
                        @if ($item->favorite == 1)
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
            </tbody>
        </table>
    @stop
    @section('css')
        <link rel="stylesheet" href="/css/style.css">
        {{-- データテーブル --}}
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    @stop
    @section('js')
        <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script>
            jQuery(function() {
                function DataTableRead() {
                    $('#myTable').DataTable({
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Japanese.json",
                        },
                        "order": [
                            [5, "desc"]
                        ],
                        'autoWidth': false,
                        'columnDefs': [{
                                targets: 0,
                                width: "10%"
                            },
                            {
                                targets: 1,
                                width: "30%"
                            },
                            {
                                targets: 3,
                                width: "45%"
                            },
                            {
                                targets: 5,
                                width: "15%"
                            },
                            {
                                'visible': false,
                                'targets': [2, 4]
                            },
                        ],
                    });
                }
                $(document).ready(DataTableRead);
            });
        </script>

        <script src="https://kit.fontawesome.com/99aa88c827.js" crossorigin="anonymous"></script>
    @stop
