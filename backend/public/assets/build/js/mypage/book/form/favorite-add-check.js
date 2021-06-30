/*---------------------------------
 お気に入り追加チェック判定の処理
----------------------------------*/

    let favorite = $('input[name="favorite"]');
favorite.change(function () {
    if (favorite.prop('checked')) {
        favorite.next('label').text("登録する");
        favorite.val("1");
    } else {
        favorite.next('label').text("登録しない");
        favorite.val("0");
    }
});