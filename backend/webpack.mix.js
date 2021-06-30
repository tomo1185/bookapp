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
    .sass('resources/assets/sass/mypage/common.scss', 'assets/build/css/mypage/')
    .sass('resources/assets/sass/mypage/home.scss', 'assets/build/css/mypage/')
    .sass('resources/assets/sass/mypage/book_register.scss', 'assets/build/css/mypage/')
    .sass('resources/assets/sass/mypage/title_search.scss', 'assets/build/css/mypage/')
    .sass('resources/assets/sass/mypage/profile_settings.scss', 'assets/build/css/mypage/')

    // buildディレクトリに出力したcssファイルを、toppage.cssというファイルに１つにまとめてpublicディレクトリへ出力する
    .styles(
        [
            'public/assets/build/css/mypage/common.css',
            'public/assets/build/css/mypage/home.css',
            'public/assets/build/css/mypage/book_register.css',
            'public/assets/build/css/mypage/title_search.css',
            'public/assets/build/css/mypage/profile_settings.css'
        ],
        'public/css/style.css'
    )
mix
    // ビルドしたsassをそれぞれ開発側buildディレクトリへ出力
    .sass('resources/assets/sass/toppage.scss', 'assets/build/css/')

    // buildディレクトリに出力したcssファイルを、toppage.cssというファイルに１つにまとめてpublicディレクトリへ出力する
    .styles(
        [
            'public/assets/build/css/toppage.css',
        ],
        'public/css/top.css'
    )

mix
    .js(
        [
            'public/assets/build/js/mypage/book/form/batch-change-volumes.js',
            'public/assets/build/js/mypage/book/form/favorite-add-check.js',
            'public/assets/build/js/mypage/bootstrap-form-validation.js',
        ],
        'public/js/bookform.js'
        )

mix.js('public/assets/build/js/mypage/book/home-datatables.js', 'public/js/datatables.js')
mix.js('public/assets/build/js/mypage/book/title-search-datatables.js', 'public/js/title-search-datatables.js')
mix.js('public/assets/build/js/mypage/bootstrap-form-validation.js', 'public/js/profile-validation.js')