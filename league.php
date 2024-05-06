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
    $sql = "SELECT * FROM stadings INNER JOIN teams ON stadings.team_id = teams.team_id where season = {$year} ORDER BY (wins*3+draws) desc;";
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
      <div class="container">
          <div class="header-left">
            <a href="C:\Users\Bell\OneDrive\デスクトップ\ESPERTO\index.html">FC.ESPERTO</a>
          </div>
          <div class="header-right">
            <ul class="menu-lists">
              <li class="menu-list"><a href="#">TEAM</a>
                <ul class="drop-lists">
                  <li class="drop-list">
                    <a href="C:\Users\Bell\OneDrive\デスクトップ\ESPERTO\club.html">クラブ概要</a>
                  </li>
                  <li class="drop-list">
                    <a href="C:\Users\Bell\OneDrive\デスクトップ\ESPERTO\member.html">メンバー</a>
                  </li>
                </ul>
              </li>
              <li class="menu-list"><a href="#">MATCHES</a>
                <ul class="drop-lists">
                  <li class="drop-list">
                    <a href="C:\Users\Bell\OneDrive\デスクトップ\ESPERTO\match.html">試合情報</a>
                  </li>
                  <li class="drop-list">
                    <a href="C:\Users\Bell\OneDrive\デスクトップ\ESPERTO\result.html">試合結果</a>
                  </li>
                  <li class="drop-list">
                    <a href="C:\Users\Bell\OneDrive\デスクトップ\ESPERTO\league.html">順位表</a>
                  </li>
                </ul>
              </li>
              <li class="menu-list">
                <a href="C:\Users\Bell\OneDrive\デスクトップ\ESPERTO\contact.html">CONTACT US</a>
              </li>
              <li class="menu-list">
                <a href="https://www.instagram.com/f.c__esperto?utm_source=ig_web_button_share_sheet&igsh=MmVlMjlkMTBhMg==" class="instagram">
                  <span class="fa fa-instagram"></span>
                </a>
              </li>
            </ul>
        </div>
      </div>
    </header>
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

              // $teams = array("伏見F.C","S.Kブリンク","久御山ユナイデット","F.Cコリエンテ","アバンサル","FCエスペルト","パナソニック高槻","たてがみ蹴球団");
              //   foreach($teams as $team) {
              //     echo "<td class="teamName" value="{team}">{$team}</td>";
            ?>
              <!-- <td>21</td>
              <td>7</td>
              <td>7</td>
              <td>0</td>
              <td>0</td>
              <td>27</td>
              <td>3</td>
              <td>24</td>
          </tr>
          <tr class="">
              <th class="rank">2</th>
              <td class="teamName">SKブリンク</td>
              <td>16</td>
              <td>7</td>
              <td>5</td>
              <td>1</td>
              <td>1</td>
              <td>22</td>
              <td>7</td>
              <td>15</td>
          </tr>
                                              <tr class="">
              <th class="rank">3</th>
              <td class="teamName">久御山ユナイテッド</td>
              <td>13</td>
              <td>7</td>
              <td>4</td>
              <td>1</td>
              <td>2</td>
              <td>15</td>
              <td>12</td>
              <td>3</td>
          </tr>
                                              <tr class="">
              <th class="rank">4</th>
              <td class="teamName">F.Cコリエンテ</td>
              <td>9</td>
              <td>7</td>
              <td>2</td>
              <td>3</td>
              <td>2</td>
              <td>18</td>
              <td>11</td>
              <td>7</td>
          </tr>
                                              <tr class="">
              <th class="rank">5</th>
              <td class="teamName">アバンサル</td>
              <td>8</td>
              <td>7</td>
              <td>2</td>
              <td>2</td>
              <td>3</td>
              <td>11</td>
              <td>15</td>
              <td>-4</td>
          </tr>
                                              <tr class="">
              <th class="rank">6</th>
              <td class="teamName">エスペルト</td>
              <td>6</td>
              <td>7</td>
              <td>2</td>
              <td>0</td>
              <td>5</td>
              <td>7</td>
              <td>17</td>
              <td>-10</td>
          </tr>
          <tr class="">
              <th class="rank">7</th>
              <td class="teamName">パナソニック高槻</td>
              <td>4</td>
              <td>7</td>
              <td>1</td>
              <td>1</td>
              <td>5</td>
              <td>5</td>
              <td>17</td>
              <td>-12</td>
          </tr>
          <tr class="">
              <th class="rank">8</th>
              <td class="teamName">たてがみ蹴球団</td>
              <td>3</td>
              <td>7</td>
              <td>1</td>
              <td>0</td>
              <td>6</td>
              <td>7</td>
              <td>30</td>
              <td>-23</td>
          </tr>
        </tbody> -->
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
  </body>
</html>

