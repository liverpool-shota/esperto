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
    //SQLクエリを準備
    $sql = "SELECT * FROM stadings INNER JOIN teams ON stadings.team_id = teams.team_id where season = {$year} ORDER BY (wins*3+draws) desc , (goals-goal_against) desc;";
    $standings = $pdo->query($sql);
    $standing = $standings->fetchAll(PDO::FETCH_ASSOC);
    $sql = "SELECT season FROM stadings;";
    $rows = $pdo->query($sql);
    $row = $rows->fetchAll(PDO::FETCH_ASSOC);
    


    //print_r($seasons);
    //exit;
} catch (PDOException $e) {
    echo "データベースに接続できませんでした：" . $e->getMessage();
    exit;
}

//seasonデータを準備
for($i=0; $i<count($row); $i++) {
  $seasons[$i] = $row[$i]["season"];
  $season = array_unique($seasons);
  sort($season);
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>League-table</title>
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
          <h1>LEAGUE TABLE</h1>
        </div>
    </div>
      <div class="league_table-wrapper">
        <div class="container">
          <div class="heading">
            <h1>第58回京都フットボールリーグ<?php echo $year ?><br>DIVISON 2</h1>
            <p>順位表</p>
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
  
          <table class="standings">
            <thead>
              <tr>
                <th>順位</th>
                <th>チーム</th>
                <th>勝点</th>
                <th>試合数</th>
                <th>勝</th>
                <th>分</th>
                <th>負</th>
                <th>得点</th>
                <th>失点</th>
                <th>得失点</th>
              </tr>
            </thead>
            <tbody>
    
              <?php
                for($i=0; $i<count($standing); $i++) {
                  echo "<tr>";
                //一位のチームには、背景色をつけるClassを適用する。
                  $rank = $i + 1;
                  if($i == 0){
                  echo "<td class='rank-1'>{$rank}</td>";
                  }else{
              
                  echo "<td class='rank'>{$rank}</td>";
                  } 
                  //チーム表示
                  echo "<td class='teamName'>{$standing[$i]["team_name"]}</td>";

                  //勝ち点
                $points = $standing[$i]["wins"] * 3 + $standing[$i]["draws"] * 1;
                  echo  "<td>{$points}</td>";
              
                  //試合数
                  echo "<td>{$standing[$i]["matches"]}</td>";
                  //勝
                  echo "<td>{$standing[$i]["wins"]}</td>";
                  //分
                  echo "<td>{$standing[$i]["draws"]}</td>";
                  //負
                  echo "<td>{$standing[$i]["loses"]}</td>";
                  //得点
                  echo "<td>{$standing[$i]["goals"]}</td>";
                  //失点
                  echo "<td>{$standing[$i]["goal_against"]}</td>";
                //得失点
                  $goaldifference = $standing[$i]["goals"]-$standing[$i]["goal_against"];
                  echo "<td>{$goaldifference}</td>";

                  echo "</tr>";
                };
              ?>
        
            </tbody>
          </table>
          <p class="box">京都トップリーグチャレンジマッチ出場権</p>
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
          window.location.href = "http://localhost/league.php?season=" + selectedValue;
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

