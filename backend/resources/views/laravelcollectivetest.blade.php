
<div class="container">

    {!! Form::open(['route'=>'test.store']) !!}
    
    <div>
        ログインID:
        {{-- {!! Form::text('login_id',null) !!} --}}
    </div>
    
    <div>
        パスワード：
        {{-- {!! Form::password('password') !!} --}}
    </div>
    <button type="submit">変更する</button>
    {{-- {!! Form::submit('送信') !!} --}}
    {!! Form::close() !!}
</div>