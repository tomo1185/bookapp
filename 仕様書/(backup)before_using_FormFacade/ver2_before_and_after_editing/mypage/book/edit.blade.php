@extends('adminlte::page')

@section('title', '登録書籍編集')

@section('content_header')
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
            {!! Form::open(['route' => ['book_manage.update', 'id' => $book_info_data->id], 'class' => 'g-3 needs-validation', 'novalidate']) !!}
            @csrf
            <div class="row">
                <div class="col-md-6 form-width">
                    {!! Form::label('author_name', '著者名', ['class' => 'form-label']) !!}
                    {!! Form::text('author_name', $book_info_data->author_name, [
                        'class' => 'form-control',
                        'id' =>'author_name',
                        'placeholder'=>'田中太郎',
                        'maxlength'=>'30',
                        'required'
                    ]) !!}
                    {{-- <input type="text" class="form-control" id="author_name" name="author_name" placeholder="田中太郎" required
                        maxlength="30" value="{{ $book_info_data->author_name }}"> --}}
                    <div class="invalid-feedback">
                        入力必須項目です。
                    </div>
                </div>
                <div class="col-md-6 form-width">
                    {!! Form::label('author_name_kana', '著者名(ふりがな)', ['class' => 'form-label']) !!}
                    {{-- <label for="author_name_kana" class="form-label">著者名(ふりがな)</label> --}}
                    {!! Form::text('author_name_kana', $book_info_data->author_name_kana, [
                        'class' => 'form-control',
                        'id' =>'author_name_kana',
                        'placeholder'=>'たなかたろう',
                        'maxlength'=>'60',
                        'required'
                    ]) !!}
                    {{-- <input type="text" class="form-control" id="author_name_kana" name="author_name_kana" maxlength="60"
                        placeholder="たなかたろう" required value="{{ $book_info_data->author_name_kana }}"> --}}
                    <div class="invalid-feedback">
                        入力必須項目です。
                    </div>
                </div>
                <div class="col-md-6 form-width">
                    {!! Form::label('book_title', '書籍名', ['class' => 'form-label']) !!}
                    {{-- <label for="book_title" class="form-label">書籍名</label> --}}
                    {!! Form::text('book_title', $book_info_data->book_title, [
                        'class' => 'form-control',
                        'id' =>'book_title',
                        'maxlength'=>'30',
                        'required'
                    ]) !!}
                    {{-- <input type="text" class="form-control" id="book_title" name="book_title" maxlength="30" required
                        value="{{ $book_info_data->book_title }}"> --}}
                    <div class="invalid-feedback">
                        入力必須項目です。
                    </div>
                </div>
                <div class="col-md-6 form-width">
                    {!! Form::label('book_title_kana', '書籍名(ふりがな)', ['class' => 'form-label']) !!}
                    {{-- <label for="book_title_kana" class="form-label">書籍名(ふりがな)</label> --}}
                    {!! Form::text('book_title_kana', $book_info_data->book_title_kana, [
                        'class' => 'form-control',
                        'id' =>'book_title_kana',
                        'maxlength'=>'60',
                        'required'
                    ]) !!}
                    {{-- <input type="text" class="form-control" id="book_title_kana" name="book_title_kana" maxlength="60"
                        value="{{ $book_info_data->book_title_kana }}" required> --}}
                    <div class="invalid-feedback">
                        入力必須項目です。
                    </div>
                </div>
                <div class="col-12 form-width">
                    {!! Form::label('memo', 'メモ', ['class' => 'form-label']) !!}
                    {{-- <label for="memo" class="form-label">メモ</label> --}}
                    {!! Form::textarea('memo', $book_info_data->memo, ['class' => 'form-control', 'id' => 'memo', 'rows' => '5', 'maxlength' => '500', 'wrap' => 'hard']) !!}
                    {{-- <textarea class="form-control" id="memo" rows="5" name="memo" maxlength="500"
                        wrap="hard">{{ $book_info_data->memo }}</textarea> --}}
                    <div class="invalid-feedback">
                        500字以内で入力してください。
                    </div>
                </div>
                <div class="col-12 form-width">
                    {!! Form::label('favorite', 'お気に入り登録', ['class' => 'form-label']) !!}
                    {{-- <label for="favorite" class="form-label">お気に入り登録</label> --}}
                    <div class="form-check my-0">
                        @if ($book_info_data->favorite == 1)
                            {!! Form::checkbox('favorite', '1', true, [
                                'class' => 'form-check-input',
                                'id' => 'flexCheckDefault'
                                ]) !!}
                            {{-- <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="favorite"
                                checked> --}}
                            {!! Form::label('flexCheckDefault', '登録中', ['class' => 'form-label']) !!}
                            {{-- <label class="form-check-label" for="flexCheckDefault">
                                登録中
                            </label> --}}
                        @else
                            {!! Form::checkbox('favorite', '0', false, [
                                'class' => 'form-check-input',
                                'id' => 'flexCheckDefault'
                                ]) !!}
                            {{-- <input class="form-check-input" type="checkbox" value="0" id="flexCheckDefault" name="favorite"> --}}
                            {!! Form::label('flexCheckDefault', '未登録', ['class' => 'form-check-label']) !!}
                            {{-- <label class="form-check-label" for="flexCheckDefault">
                                未登録
                            </label> --}}
                        @endif
                    </div> <!-- /.form-check -->
                </div> <!-- /.form-width -->
            </div> <!-- /.row -->
            <div class="form-width" id="number_of_volumes_form">
                {!! Form::label('number_of_volumes', '全巻数', ['class' => 'form-label']) !!}
                {{-- <label for="number_of_volumes" class="form-label">全巻数</label> --}}
                <div class="row">
                    {{ Form::number('number_of_volumes', $book_info_data->number_of_volumes, [
                        'class' => 'form-control',
                        'min' => 1,
                        'max' => 500,
                        'id' => 'number_of_volumes',
                        'required'
                        ]) }}
                    {{-- <input type="number" class="form-control" min="1" max="500" id="number_of_volumes"
                        name="number_of_volumes" value="{{ $book_info_data->number_of_volumes }}" required> --}}
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
                    {{ Form::number(null , null, [
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
                    {!! Form::button('一括変更', ['class' => 'btn btn-primary', 'id' => 'batch_change_button']) !!}
                    {{-- <button type="button" class="btn btn-primary" id="batch_change_button">一括変更</button> --}}
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
                    </div> <!-- /.row #input_progress -->
                </div> <!-- /.overflow-auto -->
                {!! Form::button('変更する', [
                    'type' => 'submit',
                    'class' => 'btn btn-primary mt-2',
                    'id' => 'register_submit']) !!}
                {{-- <button type="submit" class="btn btn-primary mt-2" id="register_submit">変更する</button> --}}
            </div> <!-- /.form-width -->
            {!! Form::close() !!}
            {{-- </form> --}}
        </div> <!-- /.form-wrapper -->
    </div> <!-- /.container -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/style.css">
@stop

@section('js')
    <script src="https://kit.fontawesome.com/99aa88c827.js" crossorigin="anonymous"></script>
    <script>
        /* ------------- */
        /* auto kana     */
        /* ------------- */
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
