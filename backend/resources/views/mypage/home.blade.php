@extends('adminlte::page')

@section('title', 'Dashboard')

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
        <p id="recently-read-book">最近記録した書籍タイトル</p>
        @php
            $heads = ['著者', '書籍名', ['label' => '最終記録日', 'width' => 15]];
        @endphp
        {{-- Minimal example / fill data using the component slot --}}
        <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" striped hoverable bordered compressed>
            {{-- @foreach ($book_info_data as $item) --}}
            <tr>
                <td>"aaa"</td>
                <td>"aaa"</td>
                <td>"aaa"</td>
                {{-- <td>{{ $item->read_state }}</td> --}}
                {{-- <td class="actions">
                    <a href="#"><button type="button" class="btn btn-xs btn-default text-primary shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button></a>
                    <a href="#"><button class="btn btn-xs btn-default text-teal shadow" title="Details">
                        <i class="fa fa-lg fa-fw fa-eye"></i>
                    </button></a>
                    <a href="#"><button class="btn btn-xs btn-default text-danger shadow" title="Details">
                        <i class="fa fa-lg fa-fw fa-trash-alt"></i>
                    </button></a>
                </td> --}}
            </tr>
            {{-- @endforeach --}}
        </x-adminlte-datatable>
    </div> <!-- .recently_read -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/style.css">
@stop

@section('js')
@stop
