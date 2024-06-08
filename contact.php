<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
          <h1>CONTACT US</h1>
        </div>
    </div>
       
    <div class="contact-wrapper">
        <div class="container">
          <div class="heading">
            <h2>お問い合わせ</h2>
            <h3>選手募集中、ぜひ一度練習参加を！！<br>練習試合相手も随時募集しています。</h3>
          </div>
          <form method="post" action="sent.php">
            <div class="form-item">お名前（必須）</div>
            <input type="text" name="name" required>
            <div class="form-item">メールアドレス（必須）</div>
            <input type="text" name="email" required>
            <div class="form-item">年齢</div>
            <select name="age" required>
              <option value="未選択">選択してください</option>
              <?php
                  $ages = array('10代','20代','30代','40代');
                  foreach($ages as $age) {
                    echo "<option value='{$age}'>{$age}</option>";
                  }
              ?>
            </select>
            <div class="form-item" >お問い合わせの種類</div>
            <select name="category" required>
                <option value="未選択">選択してください</option>
                <?php
                    $types = array('練習参加','練習試合','その他');
                    foreach($types as $type) {
                        echo "<option value='{$type}'>{$type}</option>";
                    }
                ?>
            </select>
            <div class="form-item">内容</div>
            <textarea name="body" required></textarea>
            <p><input type="submit" value="送信" class="btn submit"></p>
          </form>
          <!-- <p>お名前（必須）</p>
          <input>
          <p>メールアドレス（必須）</p>
          <input>
          <p>お問い合わせ内容</p>
          <textarea></textarea>
          <p><a href="#" class="btn submit">送信</a></p> -->
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




