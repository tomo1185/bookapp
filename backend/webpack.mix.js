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

mix.js('resources/js/app.js', 'public/js')
    .vue()
mix
    // ビルドしたsassをそれぞれ開発側buildディレクトリへ出力
    .sass('resources/assets/sass/mypage_home.scss', '../resources/assets/build/css/')
    // .sass('resources/assets/sass/common.scss', '../resources/assets/build/css/')
    // buildディレクトリに出力したcssファイルを、toppage.cssというファイルに１つにまとめてpublicディレクトリへ出力する
    .styles(
        [
            'resources/assets/build/css/mypage_home.css',
            // 'resources/assets/build/css/common.css',
        ],
        'public/css/style.css'
    )
