<?php
/////////////////////////
//後からコメントを外す
////////////////////////

// ファイルを読み込む（相対パスで読み込む）
// require_once 'settings\config.php';

// データベース接続情報(localhost)
// $servername = "localhost";  // データベースサーバーのホスト名
// $username = "root";         // MySQLのユーザー名
// $password = "";             // MySQLのパスワード
// $dbname = "esperto"; // 使用するデータベース名

// データベース接続情報
$servername = "mysql643.db.sakura.ne.jp";  // データベースサーバーのホスト名
$username = "esperto";         // MySQLのユーザー名
$password = "bell1100";             // MySQLのパスワード
$dbname = "esperto_db"; // 使用するデータベース名

// フォームから送信されたデータを取得
$name = $_POST['name'];
$email = $_POST['email'];
$age = $_POST['age'];
$category = $_POST['category'];
$body = $_POST['body'];


// データベースへの接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続をチェック
if ($conn->connect_error) {
    die("接続失敗: " . $conn->connect_error);
}

// SQLクエリを準備
$stmt = $conn->prepare("INSERT INTO contacts (name, email, age, category, body) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $age, $category, $body);

// クエリを実行
if ($stmt->execute()) {
    // echo "お問い合わせが送信されました。";
} else {
    echo "エラー: " . $stmt->error;
}

// 接続を閉じる
$stmt->close();    
$conn->close();

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
          <h1>CONTACT US</h1>
        </div>
    </div>
       
    <div class="contact-wrapper">
        <div class="container">
          <div class="heading">
            <h2>お問い合わせ</h2>
            <p>お問い合わせいただきありがとうございます。<br>担当者がご連絡しますので、しばらくお待ちください。</p>
          </div>
          <div class="display-contact">
            <div class="form-title">入力内容</div>
            <div class="form-item">■名前</div>
            <?php echo $_POST['name']; ?>
            <div class="form-item">■メールアドレス</div>
            <?php echo $_POST['email']; ?>
            <div class="form-item">■年齢</div>
            <?php echo $_POST['age']; ?>
            <div class="form-item">■お問い合わせの種類</div>
            <?php echo $_POST['category']; ?>
            <div class="form-item">■内容</div>
            <?php echo $_POST['body']; ?>
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




