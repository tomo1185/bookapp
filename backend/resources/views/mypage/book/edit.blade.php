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
                    <li class="breadcrumb-item"><a href="/mypage/home">ホーム</a></li>
                    <li class="breadcrumb-item"><a href="/mypage/book/title_search">登録書籍検索</a></li>
                    <li class="breadcrumb-item active">登録書籍編集</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@stop

@section('content')
    <div class="container">
        <div class="form-wrapper">
        {{-- <form method="POST" class="g-3 needs-validation" novalidate> --}}
        <form method="POST" action="{{ route('book_manage.update', ['id' => $book_info_data->id]) }}"
            class="g-3 needs-validation" novalidate>
            @csrf
            <div class="row">
                <div class="col-md-6 form-width">
                    <label for="author_name" class="form-label">著者名</label>
                    <input type="text" class="form-control" id="author_name" name="author_name" placeholder="田中太郎" required
                        maxlength="30" value="{{ $book_info_data->author_name }}">
                    <div class="invalid-feedback">
                        入力必須項目です。
                    </div>
                </div>
                <div class="col-md-6 form-width">
                    <label for="author_name_kana" class="form-label">著者名(ふりがな)</label>
                    <input type="text" class="form-control" id="author_name_kana" name="author_name_kana" maxlength="60"
                        placeholder="たなかたろう" required value="{{ $book_info_data->author_name_kana }}">
                    <div class="invalid-feedback">
                        入力必須項目です。
                    </div>
                </div>
                <div class="col-md-6 form-width">
                    <label for="book_title" class="form-label">書籍名</label>
                    <input type="text" class="form-control" id="book_title" name="book_title" maxlength="30" required
                        value="{{ $book_info_data->book_title }}">
                    <div class="invalid-feedback">
                        入力必須項目です。
                    </div>
                </div>
                <div class="col-md-6 form-width">
                    <label for="book_title_kana" class="form-label">書籍名(ふりがな)</label>
                    <input type="text" class="form-control" id="book_title_kana" name="book_title_kana" maxlength="60"
                        value="{{ $book_info_data->book_title_kana }}" required>
                    <div class="invalid-feedback">
                        入力必須項目です。
                    </div>
                </div>
                <div class="col-12 form-width">
                    <label for="memo" class="form-label">メモ</label>
                    <textarea class="form-control" id="memo" rows="5" name="memo" maxlength="500"
                        wrap="hard">{{ $book_info_data->memo }}</textarea>
                    <div class="invalid-feedback">
                        500字以内で入力してください。
                    </div>
                </div>
                <div class="col-12 form-width">
                    <label for="favorite" class="form-label">お気に入り登録</label>
                    <div class="form-check my-0">
                        @if ($book_info_data->favorite == 1)
                            <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="favorite"
                                checked>
                            <label class="form-check-label" for="flexCheckDefault">
                                登録中
                            </label>
                        @else
                            <input class="form-check-input" type="checkbox" value="0" id="flexCheckDefault" name="favorite">
                            <label class="form-check-label" for="flexCheckDefault">
                                未登録
                            </label>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-width" id="number_of_volumes_form">
                <label for="number_of_volumes" class="form-label">全巻数</label>
                <div class="row">
                    <input type="number" class="form-control" min="1" max="500" id="number_of_volumes"
                        name="number_of_volumes" value="{{ $book_info_data->number_of_volumes }}" required>
                    <button type="button" class="btn btn-primary" id="refrect_button">反映する</button>
                    <div class="invalid-feedback">
                        入力必須項目です。1~500の整数を入力してください。
                    </div>
                </div>
            </div>
            <div class="form-width">
                <label for="progress" class="form-label">読書状況</label>
                <div class="row" id="batch_change">
                    <input type="number" id="batch_change_min" min="1" max="500">
                    <p>&nbsp;巻から&nbsp;</p>
                    <input type="number" id="batch_change_max" min="1" max="500">
                    <p>&nbsp;巻まで&nbsp;</p>
                    <select id="batch_change_select">
                        <option value="既読">既読</option>
                        <option value="未読">未読</option>
                    </select>
                    <button type="button" class="btn btn-primary" id="batch_change_button">一括変更</button>
                </div>
                <div class="overflow-auto">
                    <div class="row" id="input_progress">
                        @foreach ($reading_record_data as $item)
                            <div id="vol{{ $loop->iteration }}">
                                <p>{{ $item->book_volume }}巻:
                                    <select name="read_state[{{ $loop->iteration }}]">
                                        <option value="未読" @if ($item->read_state == '未読') selected @endif>未読</option>
                                        <option value="既読" @if ($item->read_state == '既読') selected @endif>既読</option>
                                    </select>
                                </p>
                            </div>&nbsp;
                        @endforeach
                        {{-- ここに読書の読書状況を入力するフォームが出力される --}}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2" id="register_submit">変更する</button>
            </div>
        </form>
    </div> <!-- form-wrapper -->
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/style.css">
@stop

@section('js')
    <script src="https://kit.fontawesome.com/99aa88c827.js" crossorigin="anonymous"></script>
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
                        form.classList.add('was-validated');
                    }, false)
                })
        })()

        /*---------------------------------
         お気に入り追加チェック判定の処理
        ----------------------------------*/
        let favorite = $('input[name="favorite"]');
        favorite.change(function() {
            if (favorite.prop('checked')) {
                favorite.next('label').text("登録する");
                favorite.val("1");
            } else {
                favorite.next('label').text("登録しない");
                favorite.val("0");
            }
        });

        /*---------------------------------
         書籍の全巻数を入力後、反映ボタンを押すまで、
         一括変更ボタンと送信ボタンが押せなくなる
        ----------------------------------*/
        jQuery(function() {
            function some_handler() {
                // 送信ボタン
                $(":submit").prop("disabled", true);
                //  一括変更ボタン
                $("#batch_change_button").prop("disabled", true);
            }
            // キーボードを押し終わった後にイベント発生
            $('#number_of_volumes').keyup(some_handler);
            // 入力値が変更された時にイベント発生
            $('#number_of_volumes').change(some_handler);
        });

        /*---------------------------------
         書籍の全巻数を入力後に反映ボタンを押すと、
         各巻数の読書の読書状況を入力するフォームを出す
        ----------------------------------*/

        jQuery(function() {
            function push_refrect_button() {
                let num_of_val = $('#number_of_volumes').val();
                // 書籍の巻数が変更されたら以前の出力フォームを消す

                if (!($('#vol1').length)) {
                    $("#input_progress").empty();
                }
                // 書籍の巻数が1巻以上valmax巻未満の場合巻ごとの入力フォームを出力する
                let valmax = 500;
                if (num_of_val > 0 && num_of_val <= valmax) {
                    // 送信ボタンと一括変更ボタンが押せるようになる
                    $(":submit").prop("disabled", false);
                    $("#batch_change_button").prop("disabled", false);
                    // 全巻数を増やした時、読書状況のドロップダウンボタンを追加
                    for (let i = 1; i <= num_of_val; i++) {
                        if (!($('#vol' + i).length)) {
                            $('#input_progress').append(
                                '<div id="vol' + i + '" class="ml-1"><p>' + i +
                                '巻:<select name="read_state[' + i +
                                ']"><option value="未読">未読</option><option value="既読">既読</option></select></p></div>'
                            );
                        }
                    }
                    // 全巻数を減らした時、読書状況のドロップダウンボタンを減らす
                    for (let j = valmax; j > num_of_val; j--) {
                        if ($('#vol' + j).length) {
                            $('#vol' + j).remove();
                        }
                    }
                    // 一括変更ボタンの最小値と最大値の初期値を設定
                    $('#batch_change_min').val(1);
                    $('#batch_change_max').val(num_of_val);
                } else {
                    $("#input_progress").empty();
                    if (num_of_val > valmax) {
                        $('#input_progress').append('<p>' + valmax + '巻以内で入力してください。</p>');
                    } else {
                        $('#input_progress').append('<p>全巻数を入力後、「反映する」ボタンを押してください。</p>');
                    }
                }
            }
            // 反映ボタンを押したらイベント発生
            $('#refrect_button').click(push_refrect_button);
        });

        /*---------------------------------
        一括変更ボタンを押したときの変更処理
        ----------------------------------*/
        jQuery(function() {
            function batch_change() {
                // 1. 変数の定義
                let min_val = Number($('#batch_change_min').val()); // 一括変更時の小さい数字
                let max_val = Number($('#batch_change_max').val()); // 一括変更時の大きい数字
                let num_of_val = Number($('#number_of_volumes').val()); // 全巻数
                let common = [min_val, max_val, num_of_val]; //上記変数を共通チェック処理で使用
                let valmax = 500; // 入力数値の上限値
                let = change_flg = 1; //値の一括変更フラグ 1:変更する 0:変更しない
                let change_val = $("#batch_change_select").val();
                // 2. 値のチェック処理(共通)
                for (let j = 0; j < 3; j++) {
                    if (common[j] < 1 || valmax < common[j] || common[j] == "") {
                        alert("入力値が不正です。1 ~ 全巻数までの数値を入力してください。");
                        change_flg = 0;
                        break;
                    }
                }
                console.log("change_flg=" + change_flg);
                console.log("min_val=" + min_val);
                console.log("max_val=" + max_val);
                console.log("num_of_val=" + num_of_val);

                if (change_flg == 1) {
                    if (min_val > max_val || max_val > num_of_val) {
                        alert("入力値が不正です。値を確認してください。");
                        change_flg = 0;
                    }
                }

                // 3. 一括変更処理
                if (change_flg == 1) {
                    for (let k = min_val; k <= max_val; k++) {

                        let change_target = $('select[name="read_state[' + k + ']"]');
                        change_target.children().remove();
                        if (change_val == "既読") {
                            change_target.append(
                                '<option value="未読">未読</option><option value="既読" selected>既読</option></select></p></div>'
                            );
                        }
                        if (change_val == "未読") {
                            change_target.append(
                                '<option value="未読" selected>未読</option><option value="既読">既読</option></select></p></div>'
                            );
                        }
                    }
                    alert(min_val + '巻から' + max_val + '巻まで' + change_val + 'に一括変更しました。');
                }
            }
            $('#batch_change_button').click(batch_change);
        });
        /*---------------------------------
        // 名前自動入力
        ----------------------------------*/
        $(document).ready(
            function() {
                $.fn.autoKana('#author_name', '#author_name_kana', {
                    katakana: false //true：カタカナ、false：ひらがな（デフォルト）
                });
                $.fn.autoKana('#book_title', '#book_title_kana', {
                    katakana: false
                });
            });
    </script>
    <script src="{{ asset('/js/jquery.autoKana.js') }}"></script>
@stop
