@extends('adminlte::page')

@section('title', 'プロフィール設定')

@section('content_header')
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
        <div class="form-wrapper">
            {!! Form::open([
                'route' => ['mypage.profile.update','id' => $users->id, 'files'=>true],
                'class' => 'g-3 needs-validation',
                'enctype' =>'multipart/form-data',
                'novalidate']) !!}
                {{Form::token()}}
                {{-- @csrf --}}
                <div class="col-sm-12 img-screen">
                    {!! Form::label('text', '現在の画像',
                    ['class' => 'form-label current-profile-img-label']) !!}
                    <div class="current-profile-img">
                        <img src="{{ Storage::url($users->profile_image) }}" alt="profile-photo">
                    </div> <!-- profile-photo -->
                    <div class="mt-3" id="form-padding_profimg">
                        {!! Form::label('formFile', 'プロフィール画像を選択',['class' => 'form-label']) !!}
                        {!! Form::file('profile_image',[
                            'class'=>'form-control',
                            'id'=>'formFile',
                            'accept'=>'image/png image/jpeg'
                            ])
                            !!}
                        <div class="invalid-feedback">
                            .jpg, .jpeg, .pngのファイル拡張子を選択してください
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-12 form-width">
                            {!! Form::label('email', 'メールアドレス',['class' => 'form-label']) !!}
                            {!! Form::email('email', $users->email, [
                                'class' => 'form-control',
                                'id' =>'email',
                            ]) !!}
                            <div class="invalid-feedback">
                                正しいメールアドレスの形式で入力してください
                                @error('email')
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 form-width">
                            {!! Form::label('password1', 'パスワード変更',['class' => 'form-label']) !!}
                            {{-- 正規表現 ^[ -~]{8,100}$  英数字記号8文字以上100文字以下 --}}
                            {!! Form::password('password', [
                                'class' => 'form-control',
                                'id' =>'password-input',
                                'required'=>true,
                                'pattern' => '^[ -~]{8,100}$',
                            ]) !!}
                            <div class="invalid-feedback">
                                8文字以上の英数字記号で入力してください
                            </div>
                        </div>
                        <div class="col-md-12 form-width">
                            {!! Form::label('password2', 'パスワード入力(再入力)',['class' => 'form-label']) !!}
                            {!! Form::password(null, [
                                'class' => 'form-control',
                                'id' =>'password-confirmation-input',
                                'required'=>true,
                                'pattern' => '',
                            ]) !!}
                            <div class="invalid-feedback">
                                空欄もしくはパスワードが不一致です
                            </div>
                        </div>
                    </div> <!-- /.row -->
                    {!! Form::button('変更する', [
                        'type' => 'submit',
                        'class' => 'btn btn-primary mt-2'
                        ]) !!}
                </div> <!-- /.col-sm-12 -->
            {!! Form::close() !!}
        </div> <!-- /.form-wrapper -->
    </div> <!-- .container -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/style.css">
@stop

@section('js')
    <script src="{{ asset('/js/profile-validation.js') }}"></script>
    <script>
        // password-inputの値とpattern属性を連動させる
        $('#password-input').on('input', function() {
            $('#password-confirmation-input').prop('pattern', $(this).val())
        });
    </script>
@stop
