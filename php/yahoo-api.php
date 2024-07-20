<?php
// APIのエンドポイントURL
$api_endpoint = 'https://map.yahooapis.jp/search/local/V1/localSearch';

//パラメータの設定
// パラメータ一覧（https://developer.yahoo.co.jp/webapi/map/openlocalplatform/v1/localsearch.html#request-param）

require "app-id.php"; // Yahoo!APIクライアントIDはignoreファイルに記述

$output = '&output=json'; //JSON形式でデータを出力
$image = '&image=true'; //画像情報があるデータのみを取得
$detail = '&detail=full'; //出力項目数の設定
$results = '&results=100'; //取得件数の指定を行う（上限100件、未指定は10件）
//住所コード
$ac = isset($_GET['location']) ? htmlspecialchars($_GET['location']) : null; //デフォルトの検索地域（nullで結果を非表示に）
//検索クエリー
$query = isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : null; // デフォルトの検索クエリ（null）

// APIのリクエストURL
$request_url = $api_endpoint . '?appid=' . $app_id . $output . $image . $detail. $results. '&ac=' . $ac . '&query=' . urlencode($query);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yahoo!ローカルサーチAPI</title>
    <link rel="shortcut icon" href="../images/yahoo-api.ico">
    <link rel="stylesheet" href="../css/yahoo-api.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaisei+Opti&display=swap" rel="stylesheet">
</head>

<body>
    <header>
    </header>
    <main id="main">
        <h1><a href="yahoo-api.php"><span class="h1">Yahoo!ローカルサーチAPI</span><wbr>検索サービス</a></h1>

        <!-- 検索条件の入力フォーム -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" onsubmit="return validateForm()">
            <section id="search">
            <label for="keyword">施設名称やカテゴリー名称などを入力<wbr>（温泉、レストラン、コーヒー、スイーツなど）</label><br>
                <input type="text" id="keyword" name="keyword" placeholder="検索キーワードを入力" value="<?php echo htmlspecialchars($query); ?>"><br>
                <label for="location">対象地域を選択</label><br>
                <select id="location" name="location">
                    <option value=null selected disabled>選択</option>
                    <option value="0" <?php if ($ac == "0") echo 'selected'; ?>>全国</option> 
                    <option value="01" <?php if ($ac == "01") echo 'selected'; ?>>北海道</option>
                    <option value="02" <?php if ($ac == "02") echo 'selected'; ?>>青森県</option>
                    <option value="03" <?php if ($ac == "03") echo 'selected'; ?>>岩手県</option>
                    <option value="04" <?php if ($ac == "04") echo 'selected'; ?>>宮城県</option>
                    <option value="05" <?php if ($ac == "05") echo 'selected'; ?>>秋田県</option>
                    <option value="06" <?php if ($ac == "06") echo 'selected'; ?>>山形県</option>
                    <option value="07" <?php if ($ac == "07") echo 'selected'; ?>>福島県</option>
                    <option value="08" <?php if ($ac == "08") echo 'selected'; ?>>茨城県</option>
                    <option value="09" <?php if ($ac == "09") echo 'selected'; ?>>栃木県</option>
                    <option value="10" <?php if ($ac == "10") echo 'selected'; ?>>群馬県</option>
                    <option value="11" <?php if ($ac == "11") echo 'selected'; ?>>埼玉県</option>
                    <option value="12" <?php if ($ac == "12") echo 'selected'; ?>>千葉県</option>
                    <option value="13" <?php if ($ac == "13") echo 'selected'; ?>>東京都</option>
                    <option value="14" <?php if ($ac == "14") echo 'selected'; ?>>神奈川県</option>
                    <option value="15" <?php if ($ac == "15") echo 'selected'; ?>>新潟県</option>
                    <option value="16" <?php if ($ac == "16") echo 'selected'; ?>>富山県</option>
                    <option value="17" <?php if ($ac == "17") echo 'selected'; ?>>石川県</option>
                    <option value="18" <?php if ($ac == "18") echo 'selected'; ?>>福井県</option>
                    <option value="19" <?php if ($ac == "19") echo 'selected'; ?>>山梨県</option>
                    <option value="20" <?php if ($ac == "20") echo 'selected'; ?>>長野県</option>
                    <option value="21" <?php if ($ac == "21") echo 'selected'; ?>>岐阜県</option>
                    <option value="22" <?php if ($ac == "22") echo 'selected'; ?>>静岡県</option>
                    <option value="23" <?php if ($ac == "23") echo 'selected'; ?>>愛知県</option>
                    <option value="24" <?php if ($ac == "24") echo 'selected'; ?>>三重県</option>
                    <option value="25" <?php if ($ac == "25") echo 'selected'; ?>>滋賀県</option>
                    <option value="26" <?php if ($ac == "26") echo 'selected'; ?>>京都府</option>
                    <option value="27" <?php if ($ac == "27") echo 'selected'; ?>>大阪府</option>
                    <option value="28" <?php if ($ac == "28") echo 'selected'; ?>>兵庫県</option>
                    <option value="29" <?php if ($ac == "29") echo 'selected'; ?>>奈良県</option>
                    <option value="30" <?php if ($ac == "30") echo 'selected'; ?>>和歌山県</option>
                    <option value="31" <?php if ($ac == "31") echo 'selected'; ?>>鳥取県</option>
                    <option value="32" <?php if ($ac == "32") echo 'selected'; ?>>島根県</option>
                    <option value="33" <?php if ($ac == "33") echo 'selected'; ?>>岡山県</option>
                    <option value="34" <?php if ($ac == "34") echo 'selected'; ?>>広島県</option>
                    <option value="35" <?php if ($ac == "35") echo 'selected'; ?>>山口県</option>
                    <option value="36" <?php if ($ac == "36") echo 'selected'; ?>>徳島県</option>
                    <option value="37" <?php if ($ac == "37") echo 'selected'; ?>>香川県</option>
                    <option value="38" <?php if ($ac == "38") echo 'selected'; ?>>愛媛県</option>
                    <option value="39" <?php if ($ac == "39") echo 'selected'; ?>>高知県</option>
                    <option value="40" <?php if ($ac == "40") echo 'selected'; ?>>福岡県</option>
                    <option value="41" <?php if ($ac == "41") echo 'selected'; ?>>佐賀県</option>
                    <option value="42" <?php if ($ac == "42") echo 'selected'; ?>>長崎県</option>
                    <option value="43" <?php if ($ac == "43") echo 'selected'; ?>>熊本県</option>
                    <option value="44" <?php if ($ac == "44") echo 'selected'; ?>>大分県</option>
                    <option value="45" <?php if ($ac == "45") echo 'selected'; ?>>宮崎県</option>
                    <option value="46" <?php if ($ac == "46") echo 'selected'; ?>>鹿児島県</option>
                    <option value="47" <?php if ($ac == "47") echo 'selected'; ?>>沖縄県</option>
                </select><br>
                <input type="image" id="search-button" src="../images/search-button.png">
                <p id="error-message" style="color: red; display: none;">地域を選択してください。</p>
            </section>
        </form>

        <script>
            function validateForm() {
                var location = document.getElementById("location").value;
                if(location === "null")    {
                    document.getElementById("error-message").style.display = "block";
                    return false;
                }
                return true;
            }
        </script>

<?php
 // フリーワードと地域に応じた検索を行う処理

//リクエストがGETメソッドであるかどうかをチェック
// 地域の値が空でない場合にのみ検索結果を表示する条件
if ($_SERVER["REQUEST_METHOD"] == "GET" && (isset($ac))) {

    // URLパラメータからページ番号の取得（デフォルト値は1ページ）
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    if ($page < 1) {  
    $page = 1;
    }    

    // 1ページあたりの表示件数（10件に設定）
    $limit = 10;
    $offset = ($page - 1) * $limit;

     // Web APIからJSON形式で出力した生データを変数$raw_dataに格納
    $raw_data = file_get_contents($request_url, false, null);

    // JSON形式で出力した生データを連想配列として変数$dataに格納
    $data = json_decode($raw_data, true);

    //ヒット件数の表示
    $hit = count($data['Feature']) ;
    if  (isset($ac)) {
        echo'<div class="hit">'.'検索結果：' .$hit.'件'.'</div>';    
    }

    // 変数$dataに配列Featureの有無を確認（Featureはお店などの情報が入っている親要素）
    if (isset($data['Feature'])) {
    
    //ページングのためデータを切り取り変数$pageDataに代入
    $pagedData = array_slice($data['Feature'], $offset, $limit);

    //ループ処理をして、変数$placeに配列を格納する
    foreach ($pagedData as $place) {

            // 変数$placeから必要な値を出力する
            echo '<section id="output">';
                echo '<div class="output">';
                    echo '<p class="yomi">' . htmlspecialchars($place['Property']['Yomi']) . '</p>';
                    echo '<h2 class="name">' . htmlspecialchars($place['Name']) . '</h2>';
                    echo '<img class="image" src="' . htmlspecialchars($place['Property']['LeadImage']) . '">';
                    echo '<p class="catchcopy">' . htmlspecialchars($place['Property']['CatchCopy']) . '</p>';
                    echo '<p class="address">住所：' . htmlspecialchars($place['Property']['Address']) . '</p>';
                    echo '<p class="tell">電話：' . htmlspecialchars($place['Property']['Tel1']) . '</p>';
                    if ($place['Property']['Detail']['PcUrl1'] != '') {
                        echo '<p class="url">URL：<a target="_blank" rel="noopener noreferrer" href="'.htmlspecialchars ($place['Property']['Detail']['PcUrl1']).'">' . '外部ページに移動します'. '</a></p>';
                    } else {
                        echo '<p class="url">URL：</p>';
                    } 
                echo '</div>';
            echo '</section>';
                }  
        } else {
            echo 'データが見つかりませんでした。';
        }

        // ページネーションのリンクを表示
        echo '<div class="pagination">';
        if ($page > 1) {
            echo '<a href="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?location=' . urlencode($ac) . '&keyword=' . urlencode($query) . '&page=' . ($page - 1) . '">前のページ</a>';
        }
        if (count($data['Feature']) > $offset + $limit) {
            echo '<a href="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?location=' . urlencode($ac) . '&keyword=' . urlencode($query) . '&page=' . ($page + 1) . '">次のページ</a>'; 
        }
        echo '</div>';
    }        
?>

    </main>
    <footer id="footer">
        <!-- ページトップに移動するためのボタン -->
        <p id="page-top"><a href="#">Page Top</a></p>

        <p id="copyright"><small>&copy2024 Kiyoshi Yamauchi</small></p>
    </footer>
    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="../js/pagetop.js"></script>
</body>

</html>