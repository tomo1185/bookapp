/*---------------------------------
  書籍の全巻数を入力後、反映ボタンを押すまで、
  一括変更ボタンと送信ボタンが押せなくなる
 ----------------------------------*/
 jQuery(function () {
    function some_handler() {
        // 送信ボタン
        $(":submit").prop("disabled", true);
        //  一括変更ボタン
        $("#batch_change_button").prop("disabled", true);
    }
    // キーボードを押し終わった後にイベント発生
    $('#number_of_volumes').keyup(some_handler);
    // 入力値が変更された時にイベント発生
    $('#number_of_volumes').change(some_handler);
});

/*---------------------------------
 書籍の全巻数を入力後に反映ボタンを押すと、
 各巻数の読書の読書状況を入力するフォームを出す
----------------------------------*/

jQuery(function () {
    function push_refrect_button() {
        let num_of_val = $('#number_of_volumes').val();
        // 書籍の巻数が変更されたら以前の出力フォームを消す

        if (!($('#vol1').length)) {
            $("#input_progress").empty();
        }
        // 書籍の巻数が1巻以上valmax巻未満の場合巻ごとの入力フォームを出力する
        let valmax = 500;
        if (num_of_val > 0 && num_of_val <= valmax) {
            // 送信ボタンと一括変更ボタンが押せるようになる
            $(":submit").prop("disabled", false);
            $("#batch_change_button").prop("disabled", false);
            // 全巻数を増やした時、読書状況のドロップダウンボタンを追加
            for (let i = 1; i <= num_of_val; i++) {
                if (!($('#vol' + i).length)) {
                    $('#input_progress').append(
                        '<div id="vol' + i + '" class="ml-1"><p>' + i +
                        '巻:<select name="read_state[' + i +
                        ']"><option value="未読">未読</option><option value="既読">既読</option></select></p></div>'
                    );
                }
            }
            // 全巻数を減らした時、読書状況のドロップダウンボタンを減らす
            for (let j = valmax; j > num_of_val; j--) {
                if ($('#vol' + j).length) {
                    $('#vol' + j).remove();
                }
            }
            // 一括変更ボタンの最小値と最大値の初期値を設定
            $('#batch_change_min').val(1);
            $('#batch_change_max').val(num_of_val);
        } else {
            $("#input_progress").empty();
            if (num_of_val > valmax) {
                $('#input_progress').append('<p>' + valmax + '巻以内で入力してください。</p>');
            } else {
                $('#input_progress').append('<p>全巻数を入力後、「反映する」ボタンを押してください。</p>');
            }
        }
    }
    // 反映ボタンを押したらイベント発生
    $('#refrect_button').click(push_refrect_button);
});

/*---------------------------------
一括変更ボタンを押したときの変更処理
----------------------------------*/
jQuery(function () {
    function batch_change() {
        // 1. 変数の定義
        let min_val = Number($('#batch_change_min').val()); // 一括変更時の小さい数字
        let max_val = Number($('#batch_change_max').val()); // 一括変更時の大きい数字
        let num_of_val = Number($('#number_of_volumes').val()); // 全巻数
        let common = [min_val, max_val, num_of_val]; //上記変数を共通チェック処理で使用
        let valmax = 500; // 入力数値の上限値
        let change_flg = 1; //値の一括変更フラグ 1:変更する 0:変更しない
        let change_val = $("#batch_change_select").val();
        // 2. 値のチェック処理(共通)
        for (let j = 0; j < 3; j++) {
            if (common[j] < 1 || valmax < common[j] || common[j] == "") {
                alert("入力値が不正です。1 ~ 全巻数までの数値を入力してください。");
                change_flg = 0;
                break;
            }
        }
        console.log("change_flg=" + change_flg);
        console.log("min_val=" + min_val);
        console.log("max_val=" + max_val);
        console.log("num_of_val=" + num_of_val);

        if (change_flg == 1) {
            if (min_val > max_val || max_val > num_of_val) {
                alert("入力値が不正です。値を確認してください。");
                change_flg = 0;
            }
        }

        // 3. 一括変更処理
        if (change_flg == 1) {
            for (let k = min_val; k <= max_val; k++) {

                let change_target = $('select[name="read_state[' + k + ']"]');
                change_target.children().remove();
                if (change_val == "既読") {
                    change_target.append(
                        '<option value="未読">未読</option><option value="既読" selected>既読</option></select></p></div>'
                    );
                }
                if (change_val == "未読") {
                    change_target.append(
                        '<option value="未読" selected>未読</option><option value="既読">既読</option></select></p></div>'
                    );
                }
            }
            alert(min_val + '巻から' + max_val + '巻まで' + change_val + 'に一括変更しました。');
        }
    }
    $('#batch_change_button').click(batch_change);
});