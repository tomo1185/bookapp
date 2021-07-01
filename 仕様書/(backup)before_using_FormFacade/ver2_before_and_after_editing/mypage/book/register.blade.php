@extends('adminlte::page')

@section('title', '書籍登録')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">書籍登録</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/mypage/home">ホーム</a></li>
                    <li class="breadcrumb-item active">書籍登録</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@stop

@section('content')
    <div class="container">
        <div class="form-wrapper">
            {!! Form::open(['route' => ['book_manage.store'], 'class' => 'g-3 needs-validation', 'novalidate']) !!}
            {{-- <form method="POST" action="{{ route('book_manage.store') }}" class="g-3 needs-validation" novalidate> --}}
                @csrf
                <div class="row">
                    <div class="col-md-6 form-width">
                        {!! Form::label('author_name', '著者名', ['class' => 'form-label']) !!}
                        {{-- <label for="author_name" class="form-label">著者名</label> --}}
                        {!! Form::text('author_name', null, [
                            'class' => 'form-control',
                            'id' =>'author_name',
                            'placeholder'=>'田中太郎',
                            'maxlength'=>'30',
                            'required'
                        ]) !!}
                        {{-- <input type="text" class="form-control" id="author_name" name="author_name" placeholder="田中太郎"
                            maxlength="30" required> --}}
                        <div class="invalid-feedback">
                            入力必須項目です
                        </div>
                    </div>
                    <div class="col-md-6 form-width">
                        {!! Form::label('author_name_kana', '著者名(ふりがな)', ['class' => 'form-label']) !!}
                        {{-- <label for="author_name_kana" class="form-label">著者名(ふりがな)</label> --}}
                        {!! Form::text('author_name_kana', null, [
                            'class' => 'form-control',
                            'id' =>'author_name_kana',
                            'placeholder'=>'たなかたろう',
                            'maxlength'=>'60',
                            'required'
                        ]) !!}
                        {{-- <input type="text" class="form-control" id="author_name_kana" name="author_name_kana" maxlength="60"
                            placeholder="たなかたろう" required> --}}
                        <div class="invalid-feedback">
                            入力必須項目です。
                        </div>
                    </div>
                    <div class="col-md-6 form-width">
                        {!! Form::label('book_title', '書籍名', ['class' => 'form-label']) !!}
                        {{-- <label for="book_title" class="form-label">書籍名</label> --}}
                        {!! Form::text('book_title', null, [
                            'class' => 'form-control',
                            'id' =>'book_title',
                            'maxlength'=>'30',
                            'required'
                        ]) !!}
                        {{-- <input type="text" class="form-control" id="book_title" name="book_title" maxlength="30" required> --}}
                        <div class="invalid-feedback">
                            入力必須項目です。
                        </div>
                    </div>
                    <div class="col-md-6 form-width">
                        {!! Form::label('book_title_kana', '書籍名(ふりがな)', ['class' => 'form-label']) !!}
                        {{-- <label for="book_title_kana" class="form-label">書籍名(ふりがな)</label> --}}
                        {!! Form::text('book_title_kana', null, [
                            'class' => 'form-control',
                            'id' =>'book_title_kana',
                            'maxlength'=>'60',
                            'required'
                        ]) !!}
                        {{-- <input type="text" class="form-control" id="book_title_kana" name="book_title_kana" maxlength="60"
                            required> --}}
                        <div class="invalid-feedback">
                            入力必須項目です。
                        </div>
                    </div>
                    <div class="col-12 form-width">
                        {!! Form::label('memo', 'メモ', ['class' => 'form-label']) !!}
                        {{-- <label for="memo" class="form-label">メモ</label> --}}
                        {!! Form::textarea('memo', null, ['class' => 'form-control', 'id' => 'memo', 'rows' => '5', 'maxlength' => '500', 'wrap' => 'hard']) !!}
                        {{-- <textarea class="form-control" id="memo" rows="5" name="memo" maxlength="500"
                            wrap="hard"></textarea> --}}
                        <div class="invalid-feedback">
                            500字以内で入力してください。
                        </div>
                    </div>
                    <div class="col-12 form-width">
                        {!! Form::label('favorite', 'お気に入り登録', ['class' => 'form-label']) !!}
                        {{-- <label for="favorite" class="form-label">お気に入り登録</label> --}}
                        <div class="form-check my-0">
                            {!! Form::checkbox('favorite', '0', false, [
                                'class' => 'form-check-input',
                                'id' => 'flexCheckDefault'
                                ]) !!}
                            {{-- <input class="form-check-input" type="checkbox" value="0" id="flexCheckDefault" name="favorite"> --}}
                            {!! Form::label('flexCheckDefault', '登録しない', ['class' => 'form-check-label']) !!}
                            {{-- <label class="form-check-label" for="flexCheckDefault">
                                登録しない
                            </label> --}}
                        </div> <!-- /.form-check -->
                    </div> <!-- /.form-width -->
                </div> <!-- /.row -->
                <div class="form-width" id="number_of_volumes_form">
                    {!! Form::label('number_of_volumes', '全巻数', ['class' => 'form-label']) !!}
                    {{-- <label for="number_of_volumes" class="form-label">全巻数</label> --}}
                    <div class="row">
                        {{ Form::number('number_of_volumes', null, [
                            'class' => 'form-control',
                            'min' => 1,
                            'max' => 500,
                            'id' => 'number_of_volumes',
                            'required'
                            ]) }}
                        {{-- <input type="number" class="form-control" min="1" max="500" id="number_of_volumes"
                            name="number_of_volumes" required> --}}
                        {!! Form::button('反映する', ['class' => 'btn btn-primary', 'id' => 'refrect_button']) !!}
                        {{-- <button type="button" class="btn btn-primary" id="refrect_button">反映する</button> --}}
                        <div class="invalid-feedback">
                            入力必須項目です。1~500の整数を入力してください。
                        </div>
                    </div>
                </div>
                <div class="form-width">
                    {!! Form::label('progress', '読書状況', ['class' => 'form-label']) !!}
                    {{-- <label for="progress" class="form-label">読書状況</label> --}}
                    <div class="row" id="batch_change">
                        {{ Form::number(null, null, [
                            'min' => 1,
                            'max' => 500,
                            'id' => 'batch_change_min',
                            ]) }}
                        {{-- <input type="number" id="batch_change_min" min="1" max="500"> --}}
                        <p>&nbsp;巻から&nbsp;</p>
                        {{ Form::number(null, null, [
                            'min' => 1,
                            'max' => 500,
                            'id' => 'batch_change_max',
                            ]) }}
                        {{-- <input type="number" id="batch_change_max" min="1" max="500"> --}}
                        <p>&nbsp;巻まで&nbsp;</p>
                        {!! Form::select(null, ['既読' => '既読', '未読' => '未読'], '既読', ['id' => 'batch_change_select']) !!}
                        {{-- <select id="batch_change_select">
                            <option value="既読">既読</option>
                            <option value="未読">未読</option>
                        </select> --}}
                        {!! Form::button('一括変更', ['class' => 'btn btn-primary', 'id' => 'batch_change_button', 'disabled']) !!}
                        {{-- <button type="button" class="btn btn-primary" id="batch_change_button" disabled>一括変更</button> --}}
                    </div>
                    <div class="overflow-auto">
                        <div class="row" id="input_progress" class="ml-3">
                            <p>全巻数を入力後、「反映する」ボタンを押してください。</p>
                            {{-- ここに読書の読書状況を入力するフォームが出力される --}}
                        </div> <!-- /.row #input_progress -->
                    </div>  <!-- /.overflow-auto -->
                    {!! Form::button('登録する', [
                        'type' => 'submit',
                        'class' => 'btn btn-primary mt-2',
                        'id' => 'register_submit',
                        'disabled']) !!}
                    {{-- <button type="submit" class="btn btn-primary mt-2" id="register_submit" disabled>登録する</button> --}}
            {!! Form::close() !!}
            {{-- </form> --}}
        </div> <!-- /.form-wrapper -->
    </div>  <!-- /.container -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/style.css">
@stop
@section('js')
    <script src="https://kit.fontawesome.com/99aa88c827.js" crossorigin="anonymous"></script>
    <script>
    /*---------------------------------
    名前自動入力
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
    <script src="{{ asset('/js/bookform.js') }}"></script>
    <script src="{{ asset('/js/jquery.autoKana.js') }}"></script>
@stop
