@extends('adminlte::page')

@section('title', '書籍登録')

@section('content_header')
    {{-- <h1>Dashboard</h1> --}}
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">書籍登録</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="http://127.0.0.1/mypage/home">ホーム</a></li>
                    <li class="breadcrumb-item active">書籍登録</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@stop

@section('content')
    <div class="container">
        <form class="g-3 needs-validation" novalidate>
            <div class="row">
                <div class="col-md-6 mt-2">
                    <label for="validationCustom01" class="form-label">著者名</label>
                    <input type="text" class="form-control" id="validationCustom01" placeholder="田中 太郎" required>
                    <div class="invalid-feedback">
                        入力必須項目です
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                    <label for="validationCustom02" class="form-label">著者名(ふりがな)</label>
                    <input type="text" class="form-control" id="validationCustom02" placeholder="タナカ タロウ" required>
                    <div class="invalid-feedback">
                        入力必須項目です
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <label for="validationCustom03" class="form-label">書籍名</label>
                    <input type="text" class="form-control" id="validationCustom03" required>
                    <div class="invalid-feedback">
                        入力必須項目です
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <label for="validationCustom04" class="form-label">全巻数</label>
                <input type="number" class="form-control" id="validationCustom04" required>
                <div class="invalid-feedback">
                    入力必須項目です
                </div>
            </div>
            <button type="submit" class="btn btn-primary m-2">送信</button>
        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
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

    </script>
@stop
