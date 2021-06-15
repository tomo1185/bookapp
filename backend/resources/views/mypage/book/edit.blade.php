@extends('adminlte::page')

@section('title', '登録書籍編集')

@section('content_header')
    {{-- <h1>Dashboard</h1> --}}
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">登録書籍編集</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="http://127.0.0.1/mypage/home">ホーム</a></li>
                    <li class="breadcrumb-item"><a href="http://127.0.0.1/mypage/book/title_search">登録書籍検索</a></li>
                    <li class="breadcrumb-item active">登録書籍編集</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@stop

@section('content')
    <div class="container">
        {{-- <form method="POST" class="g-3 needs-validation" novalidate> --}}
        <form method="POST" action="{{ route('book_manage.update', ['id' => $book_info_data->id]) }}"
            class="g-3 needs-validation" novalidate>
            @csrf
            <div class="row">
                <div class="col-md-6 form-width">
                    <label for="author_name" class="form-label">著者名</label>
                    <input type="text" class="form-control" id="author_name" name="author_name" placeholder="田中 太郎" equired
                        value="{{ $book_info_data->author_name }}">
                    <div class="invalid-feedback">
                        入力必須項目です
                    </div>
                </div>
                <div class="col-md-6 form-width">
                    <label for="author_name_kana" class="form-label">著者名(ふりがな)</label>
                    <input type="text" class="form-control" id="author_name_kana" name="author_name_kana"
                        placeholder="タナカ タロウ" required value="{{ $book_info_data->author_name_kana }}">
                    <div class="invalid-feedback">
                        入力必須項目です
                    </div>
                </div>
                <div class="col-12 form-width">
                    <label for="book_title" class="form-label">書籍名</label>
                    <input type="text" class="form-control" id="book_title" name="book_title" required
                        value="{{ $book_info_data->book_title }}">
                    <div class="invalid-feedback">
                        入力必須項目です
                    </div>
                </div>
            </div>
            <div class="form-width">
                <label for="number_of_volumes" class="form-label">全巻数</label>
                <input type="number" class="form-control" min="1" max="500" id="number_of_volumes" name="number_of_volumes"
                    required value="{{ $book_info_data->number_of_volumes }}">
                <div class="invalid-feedback">
                    入力必須項目です。1~500の整数を入力してください
                </div>
            </div>
            <div class="form-width">
                <label for="progress" class="form-label">進捗状況</label>
                <div class="row" id="input_progress">
                    @foreach ($reading_record_data as $item)
                        <div id="vol{{ $loop->iteration }}">
                            <p>{{ $item->book_volume }}巻:
                                <select name="read_state[{{ $loop->iteration }}]">
                                    <option value="未読" @if ($item->read_state == '未読') selected @endif>未読</option>
                                    <option value="既読" @if ($item->read_state == '既読') selected @endif>既読</option>
                                </select>
                            </p>
                        </div>
                    @endforeach
                    {{-- ここに読書の進捗状況を入力するフォームが出力される --}}
                </div>
                <button type="submit" class="btn btn-primary mt-2">送信</button>
            </div>
        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/style.css">
@stop

@section('js')
    <script>
        /*---------------------------------
                    バリデーション処理
                    ----------------------------------*/
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        /*---------------------------------
         書籍の全巻数を入力後に各巻数の読書の進捗状況を入力するフォームを出す
        ----------------------------------*/
        jQuery(function() {
            function some_handler() {
                let value = $('#number_of_volumes').val();
                // 書籍の巻数が変更されたら以前の出力フォームを消す

                if (!($('#vol1').length)) {
                    $("#input_progress").empty();
                }
                // 書籍の巻数が1巻以上valmax巻未満の場合巻ごとの入力フォームを出力する
                let valmax = 500;
                if (value > 0 && value <= valmax) {
                    for (let i = 1; i <= value; i++) {
                        if (!($('#vol' + i).length)) {
                            $('#input_progress').append('<div id="vol' + i + '"><p>' + i +
                                '巻:<select name="read_state[' + i +
                                ']"><option value="未読">未読</option><option value="既読">既読</option></select></p></div>'
                            );
                        }
                    }
                    for (let j = valmax; j > value; j--) {
                        if ($('#vol' + j).length) {
                            $('#vol' + j).remove();
                        }
                    }
                } else {
                    $("#input_progress").empty();
                    if (value > valmax) {
                        $('#input_progress').append('<p>' + valmax + '巻以内で入力してください</p>');
                    } else {
                        $('#input_progress').append('<p>全巻数を入力後に表示</p>');
                    }
                }
            }
            // キーボードを押し終わった後にイベント発生
            $('#number_of_volumes').keyup(some_handler);
            // 入力値が変更された時にイベント発生
            $('#number_of_volumes').change(some_handler);
        });

        // ブラウザ読み込み後に読書状況を表示させる
        $(document).ready(function() {
            console.log("ready");
        });

    </script>
@stop
