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



// リンクのリストをPHPで定義
// $links = [
//   "http://localhost/news.php?news_id=1",
//   "http://localhost/news.php?news_id=2",
//   "http://localhost/news.php?news_id=3"
// ];

// リンクのリストをPHPで定義
$links = [
  "http://esperto.sakura.ne.jp/news.php?news_id=1",
  "http://esperto.sakura.ne.jp/news.php?news_id=2",
  "http://esperto.sakura.ne.jp/news.php?news_id=3"
];


// データベースへの接続
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

    // SQLクエリを準備
    $sql = "SELECT * FROM results  LEFT JOIN teams as aways ON results.away_team_id = aways.team_id WHERE season = 2024 ;";
    $rows = $pdo->query($sql);
    $row = $rows->fetchAll(PDO::FETCH_ASSOC);
    $sql = "SELECT * FROM news ORDER BY news_id DESC ;" ;
    $infs = $pdo->query($sql);
    $inf = $infs->fetchAll(PDO::FETCH_ASSOC);
  
    //print_r($results);
    //exit;

} 
catch (PDOException $e) {
    echo "データベースに接続できませんでした：" . $e->getMessage();
    exit;
}


for($i=0; $i<count($row); $i++) {
    $results[$i] = $row[$i];    
}

for($i=0; $i<count($inf); $i++) {
  $news[$i] = $inf[$i];
}


?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FC.ESPERTOオフィシャル</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/responsive-styles.css">


    <!-- <script>
        function getDynamicLink() {
            // PHPで生成されたリンクリストをJavaScript配列として取得
            var links = <?php echo json_encode($links); ?>;
            // 適切なリンク先を選択（ここではランダムに選択）
            var selectedLink = links[Math.floor(Math.random() * links.length)];
            // 選択されたリンクにリダイレクト
            window.location.href = selectedLink;
        }
    </script> -->

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
    <div class="home-wrapper">
        <img  id="top-img" src="img/IMG_3337.JPG">
        <div class="container">
            <h1>PLAY FOR FC.ESPERTO <br>SINCE 1999</h1>
            <p>伝統あるチームでともに勝利を目指して！</p>
        </div>
    </div>
    <div class="match-wrapper">
      <div class="heading">
        <h2>MATCH</h2>
        <p>試合日程・結果</p>
      </div>
     <!-- スライドセクション -->
     <section id="demo03" class="card03 l-section">
        <div class="swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-watch-progress">
          <div class="swiper-wrapper" id="swiper-wrapper-ee136ddec2d7545b" aria-live="off" style="cursor: grab; transition-duration: 0ms; transform: translate3d(-2488px, 0px, 0px);">
            <?php foreach($results as $result): ?>
            <!-- <a href="http://localhost/detail.php?result_id=<?php echo $result["result_id"]; ?>" class="swiper-slide" role="group" aria-label="Slide" data-swiper-slide-index="<?php echo $result["result_id"]; ?>" style="width: 279px; margin-right: 32px;"> -->
            <a href="http://esperto.sakura.ne.jp/detail.php?result_id=<?php echo $result["result_id"]; ?>" class="swiper-slide" role="group" aria-label="Slide" data-swiper-slide-index="<?php echo $result["result_id"]; ?>" style="width: 279px; margin-right: 32px;">
              <article class="slide">
                <div class="slide-media img-cover">
                  <img src="img/IMG_3871.JPG" alt="Slide Image">
                </div>
                <div class="slide-content">
                  <div class="match-titles"><?php echo $result['match_category']; ?></div>
                  <p class="match-date">
                    <?php echo $result["match_date"]; ?>
                    <span class="match-place"><?php echo $result['place']; ?></span>
                  </p>
                  <div class="match-data">
                    <span class="teams-name">FC.ESPERTO</span>
                    <span class="score">
                      <?php echo $result["home_half"] + $result["home_goals"]; ?> - 
                      <?php echo $result["away_half"] + $result["away_goals"]; ?>
                    </span>
                    <span class="teams-name"><?php echo $result["team_name"]; ?></span>
                  </div>
                </div>
              </article>
            </a>
            <?php endforeach; ?>
          </div><!-- /swiper-wrapper -->
          <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-ee136ddec2d7545b"></div>
          <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-ee136ddec2d7545b"></div>
          <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
        </div><!-- /swiper -->
      </section>
    </div>
    
    <div class="news-wrapper">
      <div class="container">
        <div class="heading">
          <h2>NEWS</h2>
          <p>お知らせ</p>
        </div>
        <!-- ニュースセクション -->
        <ul class="news">
          <?php foreach($news as $new): ?>
          <li>
            <!-- <a href="http://localhost/news.php?news_id=<?php echo $new["news_id"]; ?>"> -->
            <a href="http://esperto.sakura.ne.jp/news.php?news_id=<?php echo $new["news_id"]; ?>">
              <dl>
                <dd>
                  <p class="news-dates">
                    <?php echo $new["news_date"]; ?>
                    <span><?php echo $new["categories"]; ?></span>
                  </p>
                  <p class="title"><?php echo $new["titles"]; ?>
                  <i class="fa-solid fa-chevron-right"></i>
                  </p>
                </dd>
              </dl>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
    <div class="team-wrapper">
      <div class="container">
        <div class="heading">
          <h2>TEAM</h2>
          <p>クラブ概要</p>
        </div>
        <p class="txt-content">チーム創設２０年を超え、現在京都フットボールリーグ２部を戦う伝統あるチームです。<br>新旧のチカラを融合し、１部リーグ昇格を目標に真剣勝負を楽しんでいます。</p>
        <p class="about">【主な成績】<br>2015年　京都フットボールリーグ2部　4位<br>2016年　京都フットボールリーグ2部　1位<br>2017年　京都フットボールリーグ2部　1位<br>2018年　京都フットボールリーグ2部　2位<br>
                                        2019年　京都フットボールリーグ2部　4位<br>2021年　京都フットボールリーグ2部　3位<br>2022年　京都フットボールリーグ2部　4位<br>2023年　京都フットボールリーグ2部　6位
        </p>
      </div>
    </div>
    <div class="contact-wrapper">
      <div class="container">
        <div class="heading">
          <h2>CONTACT US</h2>
          <p>お問い合わせ</p>
        </div>
        <form method="post" action="sent.php" id="contactForm">
            <div class="form-item">お名前（必須）</div>
            <input type="text" name="name" id="name" required>
            <div class="form-item">メールアドレス（必須）</div>
            <input type="text" name="email" id="email" required>
            <div class="form-item">年齢</div>
            <select name="age" id="age" required>
              <option value="未選択">選択してください</option>
              <?php
                  $ages = array('10代','20代','30代','40代');
                  foreach($ages as $age) {
                    echo "<option value='{$age}'>{$age}</option>";
                  }
              ?>
            </select>
            <div class="form-item" >お問い合わせの種類</div>
            <select name="category" id="category" required>
                <option value="未選択">選択してください</option>
                <?php
                    $types = array('練習参加','練習試合','その他');
                    foreach($types as $type) {
                        echo "<option value='{$type}'>{$type}</option>";
                    }
                ?>
            </select>
            <div class="form-item">内容</div>
            <textarea name="body" id="body" required></textarea>
            <p><input type="submit" value="送信" class="btn submit"></p>
          </form>
          <p id="errorMessage" style="color: red;"></p>
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
      var images = ["IMG_3337.JPG", "IMG_3972.JPG", "IMG_3870.JPG","IMG_3985.JPG","IMG_3974.JPG"]; // 画像のリスト
      var currentIndex = 0; // 現在の画像のインデックス

      function changeBackgroundImg() {
        // 現在の画像のインデックスを更新
        currentIndex = (currentIndex + 1) % images.length;
        // 要素を取得
        var element = document.getElementById("top-img");
        console.log(element);
        // 背景色を変更
        element.src= "img/" + images[currentIndex];
        // element.style.backgroundImage = "url('img/IMG_3337.JPG')";
      }

      // 1秒ごとに画像を切り替える
      setInterval(changeBackgroundImg, 2000);
    </script>
    <script>
        function showContent(contentId) {
            // 全てのコンテンツを非表示にする
            const contents = document.querySelectorAll('.content');
            contents.forEach(content => content.style.display = 'none');

            // 選択されたコンテンツを表示する
            const selectedContent = document.getElementById(contentId);
            if (selectedContent) {
                selectedContent.style.display = 'block';
            }
        }
    </script>
    <!-- スライド -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="./js/lib/swiper-bundle.min.js"></script>
    <script src="./js/common.js?22020713"></script>
    <script>
      (function() {
        const mySwiper = new Swiper('.card03 .swiper', {
          slidesPerView: 1,
          spaceBetween: 16,
          loop: true,
          loopAdditionalSlides: 1,
          speed: 1000,
          autoplay: {
          delay: 4000,
          disableOnInteraction: false,
        },
          grabCursor: true,
          watchSlidesProgress: true,
          navigation: {
          nextEl: '.card03 .swiper-button-next',
          prevEl: '.card03 .swiper-button-prev',
        },
          breakpoints: {
          600: {
          slidesPerView: 2,
        },
          1025: {
            slidesPerView: 4,
            spaceBetween: 32,
          }
        },
      });
      }());
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

    <!-- 入力フォームのバリデーション -->
    <script>
    document.getElementById('contactForm').addEventListener('submit', function(event) {
      // 各入力フィールドの値を取得
      // var name = document.getElementById('name').value.trim();
      // var email = document.getElementById('email').value.trim();
      // var message = document.getElementById('message').value.trim();

      // エラーメッセージを表示する要素を取得
      var errorMessage = document.getElementById('errorMessage');
      errorMessage.textContent = '';

      // バリデーションチェック
      if (name === '' || email === '' || age === '' || category === '' || body === '') {
        // フォーム送信を阻止
        event.preventDefault();
        
        // エラーメッセージを設定
        errorMessage.textContent = 'すべてのフィールドに入力してください。';
      }
    });
    </script>
    
  </body>
</html>
