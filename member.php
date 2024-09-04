<?php
/////////////////////////
//後からコメントを外す
////////////////////////

// ファイルを読み込む（相対パスで読み込む）
// require_once 'settings\config.php';

// データベース接続情報(localhost)
// define('DB_HOST', 'localhost'); // データベースのホスト名
// define('DB_USER', 'root'); // データベースのユーザー名
// define('DB_PASS', ''); // データベースのパスワード
// define('DB_NAME', 'esperto'); // データベース名

// データベース接続情報
define('DB_HOST', 'mysql643.db.sakura.ne.jp'); // データベースのホスト名
define('DB_USER', 'esperto'); // データベースのユーザー名
define('DB_PASS', 'bell1100'); // データベースのパスワード
define('DB_NAME', 'esperto_db'); // データベース名

// データベースへの接続
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

    // SQLクエリを準備
    $sql = "SELECT * FROM members ;";
    $rows = $pdo->query($sql);
    $row = $rows->fetchAll(PDO::FETCH_ASSOC);


    for($i=0; $i<count($row); $i++) {
        $positions[$i] = $row[$i]["member_pos"];
        $position = array_unique($positions);
        
    }

    //print_r($GKnameE);
    //exit;
} 
catch (PDOException $e) {
    echo "データベースに接続できませんでした：" . $e->getMessage();
    exit;
}

//GKのデータ用意
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
        <p><a href="index.php">FC.ESPERTO</a><p>
      </div>

      <div class="header-center">
        <img class="logo" src="img/esp.logo.png">
      </div>
      <!-- メニューアイコン -->
      <div class="menu-icon" id="menuIcon">&#9776;</div>
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
          <h1>TEAM</h1>
        </div>
      </div>
      <div class="players-wrapper">
        <div class="container">
          <div class="heading">
            <h2>PLAYERS</h2>
          </div>
          <div class="players-all">
            <h3>GK</h3>
            <!-- GKデータの書き出し -->
            <ul class = 'playerList'>
            <?php foreach($gks as $gk): ?>
              <li class='playerList__item'>
                <a href='#'>
                  <div class='playerList__item__boxNum'>
                    <span class='number'><?php echo $gk["member_num"]; ?></span>
                    <span class='position'>GK</span>
                  </div>
                  <div class='playerList__item__boxImg'>
                    <img src='img/soccer.gk.jpg'>
                  </div>
                  <div class='playerList__item__boxNames'>
                    <p class ='boxNameJP'><?php echo $gk["member_name"]; ?></p>
                    <p class='boxNameEn'><?php echo $gk["member_roma_name"]; ?></p>
                  </div>
                </a>
              </li>
            <?php endforeach; ?>
            </ul>
            <ul class = 'playerList'>
            <h3>DF</h3>
            <!-- DFデータの書き出し -->
            <?php foreach($dfs as $df): ?>
              <li class='playerList__item'>
                <a href='#'>
                  <div class='playerList__item__boxNum'>
                    <span class='number'><?php echo $df["member_num"]; ?></span>
                    <span class='position'>DF</span>
                  </div>
                  <div class='playerList__item__boxImg'>
                    <img src='img/soccer.df.jpg'>
                  </div>
                  <div class='playerList__item__boxNames'>
                    <p class ='boxNameJP'><?php echo $df["member_name"]; ?></p>
                    <p class='boxNameEn'><?php echo $df["member_roma_name"]; ?></p>
                  </div>
                </a>
              </li>
            <?php endforeach; ?>
            </ul>
            <ul class = 'playerList'>
            <h3>MF</h3>
            <!-- MFデータの書き出し -->
            <?php foreach($mfs as $mf): ?>
              <li class='playerList__item'>
                <a href='#'>
                  <div class='playerList__item__boxNum'>
                    <span class='number'><?php echo $mf["member_num"]; ?></span>
                    <span class='position'>MF</span>
                  </div>
                  <div class='playerList__item__boxImg'>
                    <img src='img/soccer.mf.jpg'>
                  </div>
                  <div class='playerList__item__boxNames'>
                    <p class ='boxNameJP'><?php echo $mf["member_name"]; ?></p>
                    <p class='boxNameEn'><?php echo $mf["member_roma_name"]; ?></p>
                  </div>
                </a>
              </li>
            <?php endforeach; ?>
            </ul>
            <ul class = 'playerList'>
            <h3>FW</h3>
            <!-- FWデータの書き出し -->
            <?php foreach($fws as $fw): ?>
              <li class='playerList__item'>
                <a href='#'>
                  <div class='playerList__item__boxNum'>
                    <span class='number'><?php echo $fw["member_num"]; ?></span>
                    <span class='position'>FW</span>
                  </div>
                  <div class='playerList__item__boxImg'>
                    <img src='img/soccer.fw.jpg'>
                  </div>
                  <div class='playerList__item__boxNames'>
                    <p class ='boxNameJP'><?php echo $fw["member_name"]; ?></p>
                    <p class='boxNameEn'><?php echo $fw["member_roma_name"]; ?></p>
                  </div>
                </a>
              </li>
            <?php endforeach; ?>
            </ul>
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