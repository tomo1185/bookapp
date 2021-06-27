@extends('adminlte::page')

@section('title', '登録書籍検索')

@section('content_header')
    {{-- <h1>Dashboard</h1> --}}
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">登録書籍検索</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/mypage/home">ホーム</a></li>
                    <li class="breadcrumb-item active">登録書籍検索</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@stop

@section('content')
<div class="table-wrapper">
    <table class="display" id="myTable">
        <thead>
            <tr>
                <th>♡</th>
                <th>著者</th>
                <th>書籍名</th>
                <th>編集</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($book_info_data as $item)
                <tr>
                    @if ($item->favorite == 1)
                        <td class="favorite"><i class="fas fa-heart"></i></td>
                    @else
                        <td class="favorite">-</td>
                    @endif
                    <td><p style="display:none;">{{ $item->author_name_kana }}</p><p style="margin:0;">{{ $item->author_name }}</p></td>
                    <td><p style="display:none;">{{ $item->book_title_kana }}</p><p style="margin:0;">{{ $item->book_title }}</p></td>
                    <td class="actions">
                        <a href="{{ route('book_manage.edit', ['id' => $item->id]) }}"><button type="button"
                                class="btn btn-xs btn-default text-primary shadow" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </button></a>
                        <form method="POST" action="{{ route('book_manage.destroy', ['id' => $item->id]) }}">
                            @csrf
                            <button class="btn btn-xs btn-default text-danger shadow delete-book-title" title="destroy">
                                <i class="fa fa-lg fa-fw fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
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
                        [2, "asc"]
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
                            targets: 2,
                            width: "50%"
                        },
                        {
                            targets: 3,
                            width: "10%"
                        },
                        // { 'visible': false, 'targets': [2,4] },
                    ],
                });
            }
            $(document).ready(DataTableRead);
        });
    </script>
    <script>
        /*---------------------------------
        Check before deleting
        ----------------------------------*/

        $('.delete-book-title').click(function() {
            if (confirm("本当に削除しますか？")) {} else {
                return false;
            }
        });
    </script>
@stop
