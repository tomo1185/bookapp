const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
    // .vue()
mix
    // ビルドしたsassをそれぞれ開発側buildディレクトリへ出力
    // .sass('resources/assets/sass/home.scss', '../resources/assets/build/css/')
    .sass('resources/assets/sass/mypage/home.scss', 'assets/build/css/mypage/')
    .sass('resources/assets/sass/mypage/book_register.scss', 'assets/build/css/mypage/')
    .sass('resources/assets/sass/mypage/title_search.scss', 'assets/build/css/mypage/')
    .sass('resources/assets/sass/mypage/profile_settings.scss', 'assets/build/css/mypage/')

    // buildディレクトリに出力したcssファイルを、toppage.cssというファイルに１つにまとめてpublicディレクトリへ出力する
    .styles(
        [
            'public/assets/build/css/mypage/home.css',
            'public/assets/build/css/mypage/book_register.css',
            'public/assets/build/css/mypage/title_search.css',
            'public/assets/build/css/mypage/profile_settings.css'
        ],
        'public/css/style.css'
<<<<<<< HEAD
    ),
mix
    .sass('resources/assets/sass/mypage/toppage.scss', 'assets/build/css/mypage')

=======
    )
mix
    // ビルドしたsassをそれぞれ開発側buildディレクトリへ出力
    .sass('resources/assets/sass/toppage.scss', 'assets/build/css/')

    // buildディレクトリに出力したcssファイルを、toppage.cssというファイルに１つにまとめてpublicディレクトリへ出力する
>>>>>>> 作業途中コミット
    .styles(
        [
            'public/assets/build/css/toppage.css',
        ],
<<<<<<< HEAD
        'public/css/toppage.css'
=======
        'public/css/top.css'
>>>>>>> 作業途中コミット
    )