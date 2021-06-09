@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    {{-- <h1>Dashboard</h1> --}}
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">登録書籍検索</h1>
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

    @php
    $heads = ['著者',['label' => '著者(かな)', 'no-export' => false], '書籍名', ['label' => '巻数', 'width' => 5], ['label' => 'Actions', 'no-export' => true, 'width' => 5]];

    $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </button>';
    $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                <i class="fa fa-lg fa-fw fa-trash"></i>
            </button>';
    $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                <i class="fa fa-lg fa-fw fa-eye"></i>
            </button>';

    $config = [
        'data' => [
            ['藍川 さき','あいかわさき',  'これが恋というならば', '1', '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'],
            ['藍川 さき', 'あいかわさき', 'これが恋というならば', '2', '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'],
            ['藍川 さき', 'あいかわさき', 'これが恋というならば', '3', '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'],
            ['藍川 さき', 'あいかわさき', 'これが恋というならば', '4', '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'],
            ['藍川 さき', 'あいかわさき', '僕から君が消えない', '1', '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'],
            ['藍川 さき', 'あいかわさき', '僕から君が消えない', '2', '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'],
            ['加賀 やつこ', 'かがやつこ', '一礼してキス', '1', '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'],
            ['加賀 やつこ', 'かがやつこ', '一礼してキス', '2', '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'],
            ['加賀 やつこ', 'かがやつこ', '一礼してキス', '3', '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'],
            ['咲坂 伊緒', 'さきざかいお', 'アオハライド', '1', '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'],
            ['咲坂 伊緒', 'さきざかいお', 'アオハライド', '2', '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'],
        ],
        'order' => [[1, 'asc']],
        'columns' => [null, null, null, ['orderable' => false]],
    ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" striped hoverable bordered compressed>
        <!-- <tr>
                <td>aaa</td>
                <td>bbb</td>
                <td>ccc</td>
                <td>ddd</td>∏∏
                </tr> -->
        @foreach ($config['data'] as $row)
            <tr>
                @foreach ($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');

    </script>
@stop
