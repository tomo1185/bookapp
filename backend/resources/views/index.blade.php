<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>読書記録APP</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="ポートフォリオ用に制作した読書アプリです">
    <link rel="icon" type="image/png" href="{{ url('/favicons/favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Philosopher" rel="stylesheet">
    <link href="{{ asset('/css/top.css') }}" rel="stylesheet">
</head>

<body>
    <div id="home" class="big-bg">
        <header class="page-header wrapper">
            <h1><a href="{{ url('/') }}">読書記録APP</a></h1>
            <nav>
                <ul class="main-nav">
                    @if (Route::has('login'))
                        @auth
                            <li><a href="{{ url('/mypage/home') }}">マイページホーム</a></li>
                        @else
                            <li><a href="{{ route('login') }}">ログイン</a></li>
                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}">アカウント登録</a></li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </nav>
        </header>

        <div class="home-content wrapper">
            <p>ポートフォリオ用に制作した<br>読書記録アプリです</p>
            <h3 style="margin-bottom:0;">読書記録APP紹介動画</h3>
            <iframe src="https://www.youtube.com/embed/smkp4FPb_f0" title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>
        <!--/.home-content -->
        <footer>
            <div class="footer">
                <p>©portfolio-tomo.com</p>
            </div>
        </footer>
    </div> <!-- /#home -->
</body>

</html>
