@extends('adminlte::page')

@section('title', 'プロフィール設定')

@section('content_header')
    {{-- <h1>Dashboard</h1> --}}
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">プロフィール設定</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/mypage/home">ホーム</a></li>
                    <li class="breadcrumb-item active">プロフィール設定</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@stop

@section('content')
    <div class="container">
        <div class="profile-input-wrapper">
            {{-- <div class="row"> --}}
                <form method="POST" action="{{ route('mypage.profile.update', ['id' => $users->id]) }}" enctype="multipart/form-data" class="g-3 needs-validation" novalidate>
                    @csrf
                    <div class="col-sm-12 img-screen">
                        <label for="text" class="form-label current-profile-img-label">現在の画像</label>
                        <div class="current-profile-img">
                            <img src="{{ Storage::url($users->profile_image) }}"  alt="profile-photo">
                            {{-- <img src="{{ url($users->profile_image) }}"  alt="profile-photo"> --}}
                        </div> <!-- profile-photo -->
                        <div class="mt-3" id="form-padding_profimg">
                            <label for="formFile" class="form-label">プロフィール画像を選択</label>
                            <input type="file" class="form-control"  id="formFile" name="profile_image" accept="image/png, image/jpeg">
                            {{-- <input type="file" class="form-control"  id="formFile" name="profile_image" accept=".jpg, .jpeg, .png"> --}}
                            <div class="invalid-feedback">
                                .jpg, .jpeg, .pngのファイル拡張子を選択してください
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-12 form-width">
                                <label for="email" class="form-label">メールアドレス</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $users->email }}" >
                                <div class="invalid-feedback">
                                    正しいメールアドレスの形式で入力してください
                                    @error('email') 
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 form-width">
                                <label for="password1" class="form-label">パスワード変更</label>
                                {{-- 正規表現 ^[ -~]{8,100}$  英数字記号8文字以上100文字以下--}}
                                <input type="password" class="form-control" name="password" id="password-input" required=true pattern="^[ -~]{8,100}$">
                                <div class="invalid-feedback">
                                    8文字以上の英数字記号で入力してください
                                </div>
                            </div>
                            <div class="col-md-12 form-width">
                                <label for="password2" class="form-label">パスワード入力(再入力)</label>
                                <input type="password" class="form-control" id="password-confirmation-input" required=true pettern="" >
                                <div class="invalid-feedback">
                                    空欄もしくはパスワードが不一致です
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">変更する</button>
                    </div> <!-- .col-sm-12 -->
                </form>
            {{-- </div> <!-- .row --> --}}
        </div>
    </div> <!-- container -->
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
        バリデーション (パスワード)
        ----------------------------------*/
        // password-inputの値とpattern属性を連動させる
        $('#password-input').on('input', function(){
            $('#password-confirmation-input').prop('pattern', $(this).val())
        });
    //     $('form').on('submit', function() {
    //     // $(window).keyup(function(e){
    //         let error = true;
    //         let pw_value = $('#password1').val();
    //         // 半角英数字記号8文字以上
    //         if ( pw_value.match(/^[ -~]{8,100}$/i)) {
    //             error = false;
    //         }
    //     if ( error ) {
    //         // エラーが見つかった場合
    //         console.log("エラーあり");
    //         return false;
    //     } else {
    //         // エラーがなかった場合
    //         console.log("エラーなし");
    //         return true;
    //     }
    // });
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
