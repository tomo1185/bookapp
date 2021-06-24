@extends('adminlte::page')

@section('title', '登録書籍編集')

@section('content_header')
    {{-- <h1>Dashboard</h1> --}}
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">登録書籍詳細</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/mypage/home">ホーム</a></li>
                    <li class="breadcrumb-item"><a href="/mypage/book/title_search">登録書籍検索</a></li>
                    <li class="breadcrumb-item active">登録書籍詳細</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@stop

@section('content')
    <div class="container">
        {{-- <form method="POST" class="g-3 needs-validation" novalidate> --}}
        <div class="needs-validation">
            @csrf
            <div class="row">
                <div class="col-md-6 form-width">
                    <label for="author_name" class="form-label">著者名</label>
                    <p>{{ $book_info_data->author_name }}</p>
                </div>
                <div class="col-md-6 form-width">
                    <label for="author_name_kana" class="form-label">著者名(ふりがな)</label>
                    <p>{{ $book_info_data->author_name_kana }}</p>
                </div>
                <div class="col-12 form-width">
                    <label for="book_title" class="form-label">書籍名</label>
                    <p>{{ $book_info_data->book_title }}</p>
                </div>
                <div class="col-12 form-width">
                    <label for="memo" class="form-label">メモ</label>
                    <p>{{ $book_info_data->memo }}</p>
                </div>
            </div>
            <div class="form-width">
                <label class="form-label">お気に入り登録状況</label>
                <div class="form-check pl-0 m-0">
                    @if ($book_info_data->favorite == 1)
                        <p>登録中</p>
                    @else
                        <p>未登録</p>
                    @endif
                </div>
            </div>
            <div class="form-width">
                <label for="number_of_volumes" class="form-label">全巻数</label>
                <p>{{ $book_info_data->number_of_volumes }}巻</p>
            </div>
            <div class="form-width">
                <label for="progress" class="form-label">進捗状況</label>
                <div class="row" id="input_progress">
                    @foreach ($reading_record_data as $item)
                        <div id="vol{{ $loop->iteration }}">
                            <p name="read_state[{{ $loop->iteration }}]">{{ $item->book_volume }}巻:
                                @if ($item->read_state == '既読')既読&nbsp;&nbsp;@endif
                                @if ($item->read_state == '未読')未読&nbsp;&nbsp;@endif
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @stop

    @section('css')
        <link rel="stylesheet" href="/css/style.css">
    @stop

    @section('js')
        <script>
            /*-- バリデーション処理--*/
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
             お気に入り追加チェック判定の処理
            ----------------------------------*/
            let favorite = $('input[name="favorite"]');
            favorite.change(function() {
                if (favorite.prop('checked')) {
                    // alert("チェックしました");
                    favorite.val("1");
                } else {
                    // alert("チェックを外しました");
                    favorite.val("0");
                }
            });

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
                                    '巻:'.{{ $item->read_state }}.
                                    '</p></div>'
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
