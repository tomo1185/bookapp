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
                    <li class="breadcrumb-item"><a href="http://127.0.0.1/mypage/home">ホーム</a></li>
                    <li class="breadcrumb-item active">登録書籍検索</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@stop

@section('content')

    @php
    $heads = ['著者', '書籍名', ['label' => '巻数', 'width' => 5], ['label' => 'Actions', 'width' => 5]];
    @endphp
    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" striped hoverable bordered compressed>
        @foreach ($book_info_data as $item)
            <tr>
                <td>{{ $item->author_name }}</td>
                <td>{{ $item->book_title }}</td>
                <td>{{ $item->number_of_volumes }}</td>
                {{-- <td>{{ $item->read_state }}</td> --}}
                <td class="actions">
                    <a href="{{ route('book_manage.edit',['id' => $item->id]) }}"><button type="button" class="btn btn-xs btn-default text-primary shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button></a>
                    <button class="btn btn-xs btn-default text-teal shadow" title="Details">
                        <i class="fa fa-lg fa-fw fa-eye"></i>
                    </button>
                    <button class="btn btn-xs btn-default text-danger shadow" title="Details">
                        <i class="fa fa-lg fa-fw fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
    {{-- @foreach ($config['data'] as $row) <tr>
                @foreach ($row as $cell)
                    <td>{!! $cell !!}</td> @endforeach
            </tr>
        @endforeach --}}
@stop

@section('css')
    <link rel="stylesheet" href="/css/style.css">
@stop

@section('js')
    <script>
    </script>
@stop
