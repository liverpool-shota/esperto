<?php
/////////////////////////
//後からコメントを外す
////////////////////////

// ファイルを読み込む（相対パスで読み込む）
// require_once 'settings\config.php';

// データベース接続情報(localhost)
define('DB_HOST', 'localhost'); // データベースのホスト名
define('DB_USER', 'root'); // データベースのユーザー名
define('DB_PASS', ''); // データベースのパスワード
define('DB_NAME', 'esperto'); // データベース名

// データベース接続情報
define('DB_HOST', 'mysql643.db.sakura.ne.jp'); // データベースのホスト名
define('DB_USER', 'esperto'); // データベースのユーザー名
define('DB_PASS', 'bell1100'); // データベースのパスワード
define('DB_NAME', 'esperto_db'); // データベース名

//クエリパラメータ（season）を取得
if(isset($_GET["result_id"])){
//サニタイズ後に変数に格納
//変数名はカラム名のまま使う(可読性が低くなるため)
$result_id = htmlspecialchars($_GET["result_id"]);
 }else{
  $result_id = "9";
 }


// データベースへの接続
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

    // SQLクエリを準備
    $sql = "SELECT * FROM details   INNER JOIN results  ON details.result_id = results.result_id INNER JOIN lineups ON details.result_id = lineups.result_id
            INNER JOIN members ON  lineups.player_id = members.member_id INNER JOIN teams  ON details.away_team_id = teams.team_id
            WHERE details.result_id = {$result_id}  ;" ;
          
            
    $rows = $pdo->query($sql);
    $row = $rows->fetchAll(PDO::FETCH_ASSOC);
    $sql = "SELECT result_id FROM details;";
    $wes = $pdo->query($sql);
    $we = $wes->fetchAll(PDO::FETCH_ASSOC);



//試合idデータ
for($i=0; $i<count($we); $i++) {
  $weeks[$i] = $we[$i]["result_id"];
  $week = array_unique($weeks);
  sort($week);
  }

  
  // 各試合カテゴリーデータ
  for($i=0; $i<count($row); $i++) {
      $matches[$i] = $row[$i]["match_category"];
      $match = array_unique($matches);
      
  }
  // 試合日時
  for($i=0; $i<count($row); $i++) {
      $dates[$i] = $row[$i]["match_date"];
      $date = array_unique($dates);
  }

  // 試合会場
  for($i=0; $i<count($row); $i++) {
    $places[$i] = $row[$i]["place"];
    $place = array_unique($places);
  }
  //対戦相手データ
  for($i=0; $i<count($row); $i++) {
    $opponents[$i] = $row[$i]["team_name"];
    $opponent = array_unique($opponents);
  }

  //得点者
  $l = 0;
  $scorers = array(); // 空の配列を初期化

for ($i = 0; $i < count($row); $i++) {
    // 条件文の修正: in_array関数を使用して配列内に値があるかを確認
    if (in_array($row[$i]["scores"], array("1", "2", "3"))) {
        $scorers[$l] = $row[$i];  
        $l++; // インクリメントを追加
    }
}

  //1stホームゴール
  for($i=0; $i<count($row); $i++) {
    $halfs[$i] = $row[$i]["home_half"];
    $half = array_unique($halfs);
  }
  //2ndホームゴール
  for($i=0; $i<count($row); $i++) {
    $goals[$i] = $row[$i]["home_goals"];
    $goal = array_unique($goals);
  }
  //1st相手ゴール
  for($i=0; $i<count($row); $i++) {
    $aways[$i] = $row[$i]["away_half"];
    $away = array_unique($aways);
  }
  //2nd相手ゴール
  for($i=0; $i<count($row); $i++) {
    $awaygoals[$i] = $row[$i]["away_goals"];
    $awaygoal = array_unique($awaygoals);
  }
  //要約
  for($i=0; $i<count($row); $i++) {
    $summaries[$i] = $row[$i]["summary"];
    $summary = array_unique($summaries);
  }


  //inplayerデータ
  $k = 0;
  $ins = array(); // 空の配列を初期化
  
  for ($i = 0; $i < count($row); $i++) {
      // 条件文の修正: in_array関数を使用して配列内に値があるかを確認
      if (in_array($row[$i]["ins"], array("1", "2", "3"))) {
          $ins[$k] = $row[$i];  
          $k++; // インクリメントを追加
      }
  }
  

  //outplayerデータ
  $k = 0;
$outs = array(); // 空の配列を初期化

for ($i = 0; $i < count($row); $i++) {
    // 条件文の修正: in_array関数を使用して配列内に値があるかを確認
    if (in_array($row[$i]["outs"], array("1", "2", "3"))) {
        $outs[$k] = $row[$i];  
        $k++; // インクリメントを追加
    }
}


    // print_r($scorers);
    // exit;
} 
catch (PDOException $e) {
    echo "データベースに接続できませんでした：" . $e->getMessage();
    exit;
}


// GKのデータ用意
$j = 0;
for($i=0; $i<count($row); $i++) {
  if($row[$i]["member_pos"] == "GK") {
    $gks[$j] = $row[$i];
    $j++;
  }
}

//DFのデータを用意
$j = 0;
for($i=0; $i<count($row); $i++) {
  if($row[$i]["member_pos"] == "DF") {
    $dfs[$j] = $row[$i];
    $j++;
  }
}

//MFのデータを用意
$j = 0;
for($i=0; $i<count($row); $i++) {
  if($row[$i]["member_pos"] == "MF") {
    $mfs[$j] = $row[$i];
    $j++;
  }
}

//FWのデータを用意
$j = 0;
for($i=0; $i<count($row); $i++) {
  if($row[$i]["member_pos"] == "FW") {
    $fws[$j] = $row[$i];
    $j++;
  }
}


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FC.ESPERTOオフィシャル</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/responsive-styles.css">
  </head>
  <body>
    <header>
      <div class="header-left">
        <p><a href="index.php">FC.ESPERTO</a></p>
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
          <h1>MATCH</h1>
        </div>
    </div>
    <div class="match-wrapper">
      <div class="container">
        <div class="heading">
          <h2>試合データ</h2>
          <select id="result_id">
              <option value="未選択">選択してください</option>

              <?php
                foreach($week as $w){
                if($game == $w){
                  echo "<option value='{$w}' selected>{$w}</option>";
                }else{
                  echo "<option value='{$w}'>{$w}</option>";
                }
                }
              ?>
            </select>
        </div>
        <div class="matches">
           <?php foreach($match as $m): ?>
           <h4 class='match-title'><?php echo $m ?></h4>
           <?php endforeach; ?>
           <?php foreach($date as $d): ?>
           <div class='date'><?php echo $d ?> KICK OFF</div>
           <?php endforeach ; ?>
           <?php foreach($place as $p): ?>
           <a href='#' class='place'><?php echo $p ?></a>
           <?php endforeach ; ?>
           <div class='match-table'>
            <p class="team-name">FC.ESPERTO</p>
            <?php foreach($half as $h): ?>
            <?php foreach($goal as $g): ?>
            <p class='total-score'><?php echo $h+$g ?>-
            <?php endforeach; ?>
            <?php endforeach; ?>
            <?php foreach($away as $a): ?>
            <?php foreach($awaygoal as $aw): ?>
            <?php echo $a+$aw ?>
            <?php endforeach; ?>
            <?php endforeach; ?>
            </p>
            <?php foreach($opponent as $op): ?>
            <p class='team-name'><?php echo $op ?></p> 
            <?php endforeach; ?>
            <?php foreach($half as $h): ?>
            <span class='half-score'><?php echo $h ?>-
            <?php endforeach; ?>
            <?php foreach($away as $a): ?>
            <?php echo $a ?></span>
            <?php endforeach; ?>
            <?php foreach($goal as $g): ?>
            <span class='half-score'><?php echo $g ?>-
            <?php endforeach; ?>
            <?php foreach($awaygoal as $aw): ?>
            <?php echo $aw?></span>
            <?php endforeach; ?>
            <?php foreach($scorers as $scorer): ?>
            <p class='scorer'><?php echo  $scorer["member_name"]; ?>×
            <?php echo $scorer["scores"]; ?> 
            <?php endforeach; ?>
            <span>得点者</span>なし</p>   
         </div> 
        </div>
      </div>
    </div>
    <div class="detail-wrapper">
        <div class="container">
            <h5>試合データ</h5>
            <p>先発メンバー</p>
                    <table>
                        <tr>
                            <th>ポジション</th>
                            <th>背番号</th>
                            <th>名前</th>
                        </tr>
                        
                        <?php foreach($gks as $gk): ?>
                          <?php if($gk["starter"] == "1"): ?>
                            <tr>
                              <td class="position">GK</td>
                              <td><?php echo $gk["member_num"]; ?></td>
                              <td><?php echo $gk["member_name"]; ?></td>
                            </tr>
                          <?php endif; ?>
                        <?php endforeach ; ?>
              
                        <?php foreach($dfs as $df): ?>
                          <?php if($df["starter"] == "1"):?>
                            <tr>
                              <td class="position">DF</td> 
                              <td><?php echo $df["member_num"]; ?></td>
                              <td><?php echo $df["member_name"]; ?></td>
                            </tr> 
                          <?php endif; ?>
                        <?php endforeach ; ?>
                    
                        <?php foreach($mfs as $mf): ?>
                          <?php if($mf["starter"] == "1"): ?>
                            <tr>
                              <td class="position">MF</td>
                              <td><?php echo $mf["member_num"]; ?></td>
                              <td><?php echo $mf["member_name"]; ?></td>
                            </tr> 
                          <?php endif; ?>
                        <?php endforeach ; ?>
                        
                        <?php foreach($fws as $fw): ?>
                          <?php if($fw["starter"] == "1"): ?>
                            <tr>
                              <td class="position">FW</td>
                              <td><?php echo $fw["member_num"]; ?></td>
                              <td><?php echo $fw["member_name"]; ?></td>
                            </tr> 
                          <?php endif; ?>
                        <?php endforeach ; ?>    
                    </table>
            <p>控えメンバー</p>
                    <table>
                        <tr>
                            <th>ポジション</th>
                            <th>背番号</th>
                            <th>名前</th>
                        </tr>
                
                        <?php foreach($gks as $gk): ?>
                          <?php if($gk["starter"] == "0"): ?>
                            <tr>
                              <td class="position">GK</td>
                              <td><?php echo $gk["member_num"]; ?></td>
                              <td><?php echo $gk["member_name"]; ?></td>
                            </tr>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      
                        <?php foreach($dfs as $df): ?>
                          <?php if($df["starter"] == "0"): ?>
                            <tr>
                              <td class="position">DF</td>
                              <td><?php echo $df["member_num"]; ?></td>
                              <td><?php echo $df["member_name"]; ?></td>
                            </tr>
                          <?php endif; ?>
                        <?php endforeach; ?>
                  
                        <?php foreach($mfs as $mf): ?>
                          <?php if($mf["starter"] == "0"): ?>
                            <tr>
                              <td class="position">MF</td>
                              <td><?php echo $mf["member_num"]; ?></td>
                              <td><?php echo $mf["member_name"]; ?></td>
                            </tr>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      
                        <?php foreach($fws as $fw): ?>
                          <?php if($fw["starter"] =="0"): ?>
                            <tr>
                              <td class="position">FW</td>
                              <td><?php echo $fw["member_num"]; ?></td>
                              <td><?php echo $fw["member_name"]; ?></td>
                            </tr>
                          <?php endif; ?>
                        <?php endforeach; ?>
            
                    </table>
            <p>交代</p>
                    <table>
                        <tr>
                            <th>IN</th>
                            <th>OUT</th>
                        </tr>
                         
                        <?php foreach($ins as $in): ?>
                        <?php foreach($outs as $out): ?>
                          <tr> 
                            <?php if($in["ins"] =="1"): ?>   
                              <?php if($out["outs"] =="1"): ?>                        
                              <td><?php echo $in["member_name"]; ?></td>
                              <td><?php echo $out["member_name"]; ?></td>
                            <?php endif; ?>
                            <?php endif; ?>
                          </tr>
                          <tr> 
                            <?php if($in["ins"] =="2"): ?>   
                              <?php if($out["outs"] =="2"): ?>                        
                              <td><?php echo $in["member_name"]; ?></td>
                              <td><?php echo $out["member_name"]; ?></td>
                            <?php endif; ?>
                            <?php endif; ?>
                          </tr>
                          <tr> 
                            <?php if($in["ins"] =="3"): ?>   
                              <?php if($out["outs"] =="3"): ?>                        
                              <td><?php echo $in["member_name"]; ?></td>
                              <td><?php echo $out["member_name"]; ?></td>
                            <?php endif; ?>
                            <?php endif; ?>
                          </tr>
                        <?php endforeach; ?>
                        <?php endforeach; ?>  
                      </table>
            <div class="sammary">
                <?php foreach($summary as $s): ?>
                <h6>試合総括</h6>
                <p class='txt-content'><?php echo $s ?></p>
                <?php endforeach ; ?>
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
         document.getElementById("result_id").addEventListener("change", function() {
          // select要素を取得
          let selectElement = document.getElementById("result_id");
          // select要素で選択中のoptionの値を取得
          let selectedValue = selectElement.value;
          //画面を再読み込み
          window.location.href = "http://localhost/detail.php?result_id=" + selectedValue;
          window.location.href = "http://esperto.sakura.ne.jp/detail.php?result_id=" + selectedValue;
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