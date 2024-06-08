<?php
/////////////////////////
//後からコメントを外す
////////////////////////

// ファイルを読み込む（相対パスで読み込む）
// require_once 'settings\config.php';

// データベース接続情報
define('DB_HOST', 'localhost'); // データベースのホスト名
define('DB_USER', 'root'); // データベースのユーザー名
define('DB_PASS', ''); // データベースのパスワード
define('DB_NAME', 'esperto'); // データベース名

//クエリパラメータ（season）を取得
if(isset($_GET["season"])){
  //サニタイズ後に変数に格納
  $year = htmlspecialchars($_GET["season"]);
}else{
  $year = "2024";
}

// データベースへの接続
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

    // SQLクエリを準備
    $sql = "SELECT * FROM results  LEFT JOIN teams as aways ON results.away_team_id = aways.team_id WHERE season = {$year} ;";
    $rels = $pdo->query($sql);
    $rel = $rels->fetchAll(PDO::FETCH_ASSOC);
    $sql = "SELECT season FROM results;";
    $rows = $pdo->query($sql);
    $row = $rows->fetchAll(PDO::FETCH_ASSOC);


    //print_r($results);
    //exit;
} 
catch (PDOException $e) {
    echo "データベースに接続できませんでした：" . $e->getMessage();
    exit;
}

//seasonデータを準備
for($i=0; $i<count($row); $i++) {
  $seasons[$i] = $row[$i]["season"];
  $season = array_unique($seasons);
  sort($season);
  }

for($i=0; $i<count($rel); $i++) {
    $results[$i] = $rel[$i];    
}


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>FC.ESPERTOオフィシャル</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/stylesheet (1).css">
  </head>
  <body>
  <header>
      <div class="header-left">
        <p><a href="index.php">FC.ESPERTO</a><p>
      </div>

      <div class="header-center">
        <img class="logo" src="img/esp.logo.png">
      </div>

      <!-- メニューアイコン -->
      <div class="menu-icon" id="menuIcon">&#9776;
        <div class="sidenav" id="sidenav">
          <a href="javascript:void(0)" class="closebtn" id="closeBtn">&times;</a>
          <ul class="options-lists">
            <li class="option-list"><a href="#">TEAM</a>
              <ul class="under-lists">
                <li class="under-list"><a href="club.html">クラブ概要</a></li>
                <li class="under-list"><a href="member.php">メンバー</a></li>
              </ul>
            </li>
            <li class="option-list"><a href="#">MATCHES</a>
              <ul class="under-lists">
                <li class="under-list"><a href="match.php">試合情報</a></li>
                <li class="under-list"><a href="result.php">試合結果</a></li>
                <li class="under-list"><a href="league.php">順位表</a></li>
              </ul>
            </li>
            <li class="option-list"><a href="contact.php">CONTACT US</a></li>
            <li class="option-list">
              <a href="https://www.instagram.com/f.c__esperto?utm_source=ig_web_button_share_sheet&igsh=MmVlMjlkMTBhMg==" class="instagram">
                <span class="fa fa-instagram"></span>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <!-- <span class= "menu-icon fa fa-bars"></span> -->
      <div class="header-right">
        <ul class="menu-lists">
          <li class="menu-list"><a href="#">TEAM</a>
            <ul class="drop-lists">
              <li class="drop-list"><a href="club.html">クラブ概要</a></li>
              <li class="drop-list"><a href="member.php">メンバー</a></li>
            </ul>
          </li>
          <li class="menu-list"><a href="#">MATCHES</a>
            <ul class="drop-lists">
              <li class="drop-list"><a href="match.php">試合情報</a></li>
              <li class="drop-list"><a href="result.php">試合結果</a></li>
              <li class="drop-list"><a href="league.php">順位表</a></li>
            </ul>
          </li>
          <li class="menu-list"><a href="contact.php">CONTACT US</a></li>
          <li class="menu-list">
            <a href="https://www.instagram.com/f.c__esperto?utm_source=ig_web_button_share_sheet&igsh=MmVlMjlkMTBhMg==" class="instagram">
              <span class="fa fa-instagram"></span>
            </a>
          </li>
        </ul>
      </div>
    </header>
    <div class="top-wrapper">
        <div class="container">
          <h1>MATCH</h1>
        </div>
    </div>
    <div class="match-wrapper">
      <div class="container">
        <div class="heading">
          <h2>試合情報</h2>
          <select id="season">
              <option value="未選択">選択してください</option>

              <?php
                foreach($season as $s){
                if($year == $s){
                  echo "<option value='{$s}' selected>{$s}</option>";
                }else{
                  echo "<option value='{$s}'>{$s}</option>";
                }
                }
              ?>
            </select>
        </div>
        <div class="matches">
          <?php foreach($results as $result): ?>
          <h4 class='match-title'><?php echo $result["match_category"]; ?></h4>
          <div class="date"><?php echo $result["match_date"]; ?> KICK OFF</div>
          <a href='#' class='place'><?php echo $result["place"] ?></a>
          <div class="match-table">
            <p class="team-name">FC.ESPERTO</p>
            <span>VS</span>
            <p class='team-name'><?php echo $result["team_name"]; ?></p>
          </div>
          <?php endforeach ;?>
        </div>
      </div>
    </div>
    <footer>
      <div class="container">
        <div class="footer-left">
          <h2>FC.ESPERTOオフィシャルサイト<br><span>play for ESPERTO, since 1999</span></h2>
        </div>
      </div>
    </footer>
    <script>
         document.getElementById("season").addEventListener("change", function() {
          // select要素を取得
          let selectElement = document.getElementById("season");
          // select要素で選択中のoptionの値を取得
          let selectedValue = selectElement.value;
          //画面を再読み込み
          window.location.href = "http://localhost/match.php?season=" + selectedValue;
          });
    </script>
    <!-- メニューアイコン -->
    <script src="script.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
    var menuIcon = document.getElementById("menuIcon");
    var sidenav = document.getElementById("sidenav");
    var closeBtn = document.getElementById("closeBtn");

    menuIcon.addEventListener("click", function() {
        sidenav.style.width = "250px";
    });

    closeBtn.addEventListener("click", function() {
        sidenav.style.width = "0";
    });

    // Close the sidenav if the user clicks outside of it
    window.addEventListener("click", function(event) {
        if (!event.target.matches('#menuIcon') && !event.target.closest('.sidenav')) {
            sidenav.style.width = "0";
        }
    });
});

    </script>
    </body>
  </html>