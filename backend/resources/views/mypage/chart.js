    <!--------------------------------
     Chart.jsによる読書記録グラフ
     --------------------------------->
    <!-- Chart.js読み込み -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <canvas id="myChart"></canvas>
    <script>
        //ラベル
        let labels = [
            @for ($i = 5; $i >= 0; $i--)
            "{{ $monthly_reading[$i]['date'] }}",
            @endfor
        ];
        //読書数
        let average_reading_log = [
            @for ($i = 5; $i >= 0; $i--)
            "{{ $monthly_reading[$i]['monthly_reading_result'] }}",
            @endfor
            // 50.0, //5ヶ月前のデータ
            // 51.0, //4ヶ月前のデータ
            // 52.0, //3ヶ月前のデータ
            // 53.0, //2ヶ月前のデータ
            // 54.0, //1ヶ月前のデータ
            // 54.0  //今月のデータ
        ];
        //グラフを描画
        let ctx = document.getElementById("myChart");
        let myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: '読書推移',
                        data: average_reading_log,
                        borderColor: "rgba(0,0,255,1)",
                        backgroundColor: "rgba(0,0,0,0)"
                    },
                ]
            },
            options: {
                title: {
                    display: true,
                    text: '◯◯さんの読書記録'
                }
            }
        });

    </script>