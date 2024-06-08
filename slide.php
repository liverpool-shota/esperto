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


// リンクのリストをPHPで定義
$links = [
  "http://localhost/news.php?news_id=1",
  "http://localhost/news.php?news_id=2",
  "http://localhost/news.php?news_id=3"
];


// データベースへの接続
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

    // SQLクエリを準備
    $sql = "SELECT * FROM results  LEFT JOIN teams as aways ON results.away_team_id = aways.team_id WHERE season = 2024 ;";
    $rows = $pdo->query($sql);
    $row = $rows->fetchAll(PDO::FETCH_ASSOC);
    // $sql = "SELECT * FROM news ORDER BY news_id DESC ;" ;
    // $infs = $pdo->query($sql);
    // $inf = $infs->fetchAll(PDO::FETCH_ASSOC);
    
    for($i=0; $i<count($row); $i++) {
        $results[$i] = $row[$i];    
    }

    $resa = $results[0];
    $resb = $results[1];
    $resc = $results[2];
    $resd = $results[3];
    $rese = $results[4];
    


    // print_r($resa);
    //  exit;
} 
catch (PDOException $e) {
    echo "データベースに接続できませんでした：" . $e->getMessage();
    exit;
}



// for($i=0; $i<count($row); $i++) {
//     $results[$i] = $row[$i];    
// }

// for($i=0; $i<count($inf); $i++) {
//   $news[$i] = $inf[$i];
// }


?>
<!DOCTYPE html>
<html lang="ja"><head>
  <meta name="robots" content="noindex">
<meta charset="utf-8">
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width">

<title>Swiper DEMO</title>

<link rel="stylesheet" type="text/css" href="s.css">
<link rel="stylesheet" type="text/css" href="a.css">

</head>

<body>
<div class="l-wrapper">
<main>



<?php foreach($results as $result): ?>
                  <div class="slide-content">
                    <time class="slide-date" datetime="2021-12-01"><?php echo $result["match_date"]; ?></time>    
                    <div class="match-info">
                      <span class="team-name">FC.ESPERTO</span>
                      <span class="score"><?php echo $result["home_half"]+$result["home_goals"]; ?>-<?php echo $result["away_half"]+$result["away_goals"]; ?></span>
                      <span class="team-name"><?php echo $result["team_name"]; ?></span>
                    </div>
                    <div class="match-info"><?php echo $result["place"]; ?></div>    
                  </div>
                  <?php endforeach; ?>




                  <section id="demo03" class="card03 l-section">
<div class="l-inner">
    <h2 class="c-title"><span class="ico-basic">#03 基本</span>カード型 03</h2>
    <ul class="c-info">
      <li>自動再生させる</li>
      <li>無限ループさせる</li>
      <li>コンテンツ幅からはみ出たスライドを薄くする</li>
    </ul>
    <section id="demo03" class="card03 l-section">
    <div class="swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-watch-progress">
        <div class="swiper-wrapper" id="swiper-wrapper-ee136ddec2d7545b" aria-live="off" style="cursor: grab; transition-duration: 0ms; transform: translate3d(-2488px, 0px, 0px);">
            <?php foreach($results as $result): ?>
            <a href="#" class="swiper-slide swiper-slide-duplicate" role="#" aria-label="#"  data-swiper-slide-index="#" style="width: 279px; margin-right: 32px;">
            <!-- <?php foreach($results as $result): ?> -->
                <article class="slide">
                    <div class="slide-media img-cover"><img src="https://picsum.photos/id/225/800/500" alt=""></div>
                    <div class="slide-content">
                    <time class="slide-date" datetime="2021-12-01"><?php echo $result["match_date"]; ?></time>    
                    <div class="match-info">
                      <span class="team-name">FC.ESPERTO</span>
                      <span class="score"><?php echo $result["home_half"]+$result["home_goals"]; ?>-<?php echo $result["away_half"]+$result["away_goals"]; ?></span>
                      <span class="team-name"><?php echo $result["team_name"]; ?></span>
                    </div>
                    <div class="match-info"><?php echo $result["place"]; ?></div>
                    </div>
                </article>
            <!-- <?php endforeach ; ?> -->
            </a>
            <?php endforeach; ?>
        </div><!-- /swiper-wrapper -->
      <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-ee136ddec2d7545b"></div>
      <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-ee136ddec2d7545b"></div>
      <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
    </div><!-- /swiper -->
</div>
</section>


<!-- コピー -->
<section id="demo03" class="card03 l-section">
    <div class="swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-watch-progress">
        <div class="swiper-wrapper" id="swiper-wrapper-ee136ddec2d7545b" aria-live="off" style="cursor: grab; transition-duration: 0ms; transform: translate3d(-2488px, 0px, 0px);">
            <?php foreach($results as $result): ?>
            <a href="#" class="swiper-slide" role="group" aria-label="Slide" data-swiper-slide-index="<?php echo $result["result_id"]; ?>" style="width: 279px; margin-right: 32px;">
                <article class="slide">
                    <div class="slide-media img-cover">
                        <img src="https://picsum.photos/id/225/800/500" alt="Slide Image">
                    </div>
                    <div class="slide-content">
                        <time class="slide-date" datetime="<?php echo $result["match_date"]; ?>">
                            <?php echo $result["match_date"]; ?>
                        </time>
                        <div class="match-info">
                            <span class="team-name">FC.ESPERTO</span>
                            <span class="score">
                                <?php echo $result["home_half"] + $result["home_goals"]; ?> - 
                                <?php echo $result["away_half"] + $result["away_goals"]; ?>
                            </span>
                            <span class="team-name"><?php echo $result["team_name"]; ?></span>
                        </div>
                        <div class="match-info"><?php echo $result["place"]; ?></div>
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







<section id="demo03" class="card03 l-section">
<div class="l-inner">
    <h2 class="c-title"><span class="ico-basic">#03 基本</span>カード型 03</h2>
    <ul class="c-info">
      <li>自動再生させる</li>
      <li>無限ループさせる</li>
      <li>コンテンツ幅からはみ出たスライドを薄くする</li>
    </ul>

    <div class="swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-watch-progress">
        <div class="swiper-wrapper" id="swiper-wrapper-ee136ddec2d7545b" aria-live="off" style="cursor: grab; transition-duration: 0ms; transform: translate3d(-2488px, 0px, 0px);">
            <a href="#" class="swiper-slide swiper-slide-duplicate" role="group" aria-label="8 / 10" data-swiper-slide-index="7" style="width: 279px; margin-right: 32px;">
                <article class="slide">
                    <div class="slide-media img-cover"><img src="https://picsum.photos/id/225/800/500" alt=""></div>
                    <div class="slide-content">
                        <time class="slide-date" datetime="2021-12-01">2021.12.01</time>
                        <h2 class="slide-title">Deserunt mollit anim id est laborum.</h2>
                    </div>
                </article>
            </a>
            <a href="#" class="swiper-slide swiper-slide-duplicate" role="group" aria-label="9 / 10" data-swiper-slide-index="8" style="width: 279px; margin-right: 32px;">
                <article class="slide">
                    <div class="slide-media img-cover"><img src="https://picsum.photos/id/1003/800/500" alt=""></div>
                    <div class="slide-content">
                        <time class="slide-date" datetime="2021-12-01">2021.12.01</time>
                        <h2 class="slide-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
                     </div>
                </article>
            </a>
            <a href="#" class="swiper-slide swiper-slide-duplicate" role="group" aria-label="10 / 10" data-swiper-slide-index="9" style="width: 279px; margin-right: 32px;">
                <article class="slide">
                    <div class="slide-media img-cover"><img src="https://picsum.photos/id/127/800/500" alt=""></div>
                    <div class="slide-content">
                        <time class="slide-date" datetime="2021-12-01">2021.12.01</time>
                        <h2 class="slide-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
                    </div>
                </article>
            </a>
            <a href="#" class="swiper-slide" role="group" aria-label="1 / 10" data-swiper-slide-index="0" style="width: 279px; margin-right: 32px;">
                <article class="slide">
                    <div class="slide-media img-cover"><img src="https://picsum.photos/id/139/800/500" alt=""></div>
                    <div class="slide-content">
                        <time class="slide-date" datetime="2021-12-01">2021.12.01</time>
                        <h2 class="slide-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
                    </div>
                </article>
            </a>
            <a href="#" class="swiper-slide" role="group" aria-label="2 / 10" data-swiper-slide-index="1" style="width: 279px; margin-right: 32px;">
                <article class="slide">
                    <div class="slide-media img-cover"><img src="https://picsum.photos/id/1060/800/500" alt=""></div>
                    <div class="slide-content">
                        <time class="slide-date" datetime="2021-12-01">2021.12.01</time>
                        <h2 class="slide-title">Sed eiusmod tempor incidunt ut labore et dolore magna aliqua.</h2>
                    </div>
                </article>
            </a>
            <a href="#" class="swiper-slide" role="group" aria-label="3 / 10" data-swiper-slide-index="2" style="width: 279px; margin-right: 32px;">
                <article class="slide">
                    <div class="slide-media img-cover"><img src="https://picsum.photos/id/1023/800/500" alt=""></div>
                    <div class="slide-content">
                        <time class="slide-date" datetime="2021-12-01">2021.12.01</time>
                        <h2 class="slide-title">Ut enim ad minim veniam.</h2>
                    </div>
                </article>
            </a>
            <a href="#" class="swiper-slide" role="group" aria-label="4 / 10" data-swiper-slide-index="3" style="width: 279px; margin-right: 32px;">
                <article class="slide">
                    <div class="slide-media img-cover"><img src="https://picsum.photos/id/1047/800/500" alt=""></div>
                    <div class="slide-content">
                        <time class="slide-date" datetime="2021-12-01">2021.12.01</time>
                        <h2 class="slide-title">Quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur.</h2>
                    </div>
                </article>
            </a>
            <a href="#" class="swiper-slide swiper-slide-prev" role="group" aria-label="5 / 10" data-swiper-slide-index="4" style="width: 279px; margin-right: 32px;">
                <article class="slide">
                    <div class="slide-media img-cover"><img src="https://picsum.photos/id/248/800/500" alt=""></div>
                    <div class="slide-content">
                        <time class="slide-date" datetime="2021-12-01">2021.12.01</time>
                        <h2 class="slide-title">Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</h2>
                    </div>
                </article>
            </a>
            <a href="#" class="swiper-slide swiper-slide-visible swiper-slide-active" role="group" aria-label="6 / 10" data-swiper-slide-index="5" style="width: 279px; margin-right: 32px;">
                <article class="slide">
                    <div class="slide-media img-cover"><img src="https://picsum.photos/id/109/800/500" alt=""></div>
                    <div class="slide-content">
                        <time class="slide-date" datetime="2021-12-01">2021.12.01</time>
                        <h2 class="slide-title">Excepteur sint obcaecat cupiditat non proident.</h2>
                    </div>
                </article>
            </a>
            <a href="#" class="swiper-slide swiper-slide-visible swiper-slide-next" role="group" aria-label="7 / 10" data-swiper-slide-index="6" style="width: 279px; margin-right: 32px;">
                <article class="slide">
                    <div class="slide-media img-cover"><img src="https://picsum.photos/id/120/800/500" alt=""></div>
                    <div class="slide-content">
                        <time class="slide-date" datetime="2021-12-01">2021.12.01</time>
                        <h2 class="slide-title">Sunt in culpa qui officia.</h2>
                    </div>
                </article>
            </a>
            <a href="#" class="swiper-slide" role="group" aria-label="8 / 10" data-swiper-slide-index="7" style="width: 279px; margin-right: 32px;">
                <article class="slide">
                    <div class="slide-media img-cover"><img src="https://picsum.photos/id/225/800/500" alt=""></div>
                    <div class="slide-content">
                        <time class="slide-date" datetime="2021-12-01">2021.12.01</time>
                        <h2 class="slide-title">Deserunt mollit anim id est laborum.</h2>
                    </div>
                </article>
            </a>
            <a href="#" class="swiper-slide" role="group" aria-label="9 / 10" data-swiper-slide-index="8" style="width: 279px; margin-right: 32px;">
                <article class="slide">
                    <div class="slide-media img-cover"><img src="https://picsum.photos/id/1003/800/500" alt=""></div>
                    <div class="slide-content">
                        <time class="slide-date" datetime="2021-12-01">2021.12.01</time>
                        <h2 class="slide-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
                    </div>
                </article>
            </a>
            <a href="#" class="swiper-slide" role="group" aria-label="10 / 10" data-swiper-slide-index="9" style="width: 279px; margin-right: 32px;">
                <article class="slide">
                    <div class="slide-media img-cover"><img src="https://picsum.photos/id/127/800/500" alt=""></div>
                    <div class="slide-content">
                        <time class="slide-date" datetime="2021-12-01">2021.12.01</time>
                        <h2 class="slide-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
                    </div>
                </article>
            </a>
            <a href="#" class="swiper-slide swiper-slide-duplicate" role="group" aria-label="1 / 10" data-swiper-slide-index="0" style="width: 279px; margin-right: 32px;">
                <article class="slide">
                    <div class="slide-media img-cover"><img src="https://picsum.photos/id/139/800/500" alt=""></div>
                    <div class="slide-content">
                        <time class="slide-date" datetime="2021-12-01">2021.12.01</time>
                        <h2 class="slide-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
                    </div>
                </article>
            </a>
            <a href="#" class="swiper-slide swiper-slide-duplicate" role="group" aria-label="2 / 10" data-swiper-slide-index="1" style="width: 279px; margin-right: 32px;">
                <article class="slide">
                    <div class="slide-media img-cover"><img src="https://picsum.photos/id/1060/800/500" alt=""></div>
                    <div class="slide-content">
                        <time class="slide-date" datetime="2021-12-01">2021.12.01</time>
                        <h2 class="slide-title">Sed eiusmod tempor incidunt ut labore et dolore magna aliqua.</h2>
                    </div>
                </article>
            </a>
            <a href="#" class="swiper-slide swiper-slide-duplicate" role="group" aria-label="3 / 10" data-swiper-slide-index="2" style="width: 279px; margin-right: 32px;">
                <article class="slide">
                    <div class="slide-media img-cover"><img src="https://picsum.photos/id/1023/800/500" alt=""></div>
                    <div class="slide-content">
                        <time class="slide-date" datetime="2021-12-01">2021.12.01</time>
                        <h2 class="slide-title">Ut enim ad minim veniam.</h2>
                    </div>
                </article>
            </a>
        </div><!-- /swiper-wrapper -->
      <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-ee136ddec2d7545b"></div>
      <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-ee136ddec2d7545b"></div>
      <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
    </div><!-- /swiper -->
</div>
</section>

</main>

</div><!-- /wrapper -->

<script src="./js/lib/swiper-bundle.min.js"></script>
<script src="./js/common.js?22020713"></script>
<script>
    /* card03
------------------------------*/
// swiper-setup.js

// document.addEventListener('DOMContentLoaded', (event) => {
//   const slideData = [
// //     { content: '<?php echo $resa["match_date"]; echo $resa["place"]; echo 'FC.ESPERTO'; echo $resa["home_half"]+$resa["home_goals"]; echo '-'; echo $resa["away_half"]+$resa["away_goals"]; echo $resa["team_name"];?>' },
//     { content: '<?php echo $resb["match_date"]; echo $resb["place"]; echo 'FC.ESPERTO'; echo $resb["home_half"]+$resb["home_goals"]; echo '-'; echo $resb["away_half"]+$resb["away_goals"]; echo $resb["team_name"];?>' },
//     { content: '<?php echo $resc["match_date"]; echo $resc["place"]; echo 'FC.ESPERTO'; echo $resc["home_half"]+$resc["home_goals"]; echo '-'; echo $resc["away_half"]+$resc["away_goals"]; echo $resc["team_name"];?>' },
//     { content: '<?php echo $resd["match_date"]; echo $resd["place"]; echo 'FC.ESPERTO'; echo $resd["home_half"]+$resd["home_goals"]; echo '-'; echo $resd["away_half"]+$resd["away_goals"]; echo $resd["team_name"];?>' },
//     { content: '<?php echo $rese["match_date"]; echo $rese["place"]; echo 'FC.ESPERTO  VS'; echo $rese["team_name"];?>' }
//   ]; 
  
//   const swiperWrapper = document.querySelector('.card03 .swiper-wrapper');

//   slideData.forEach(slide => {
//     const slideDiv = document.createElement('div');
//     slideDiv.className = 'swiper-slide';
//     slideDiv.innerText = slide.content;
//     swiperWrapper.appendChild(slideDiv);
//   });

//   const mySwiper = new Swiper('.card03 .swiper', {
//     slidesPerView: 1,
//     spaceBetween: 16,
//     loop: true,
//     loopAdditionalSlides: 1,
//     speed: 1000,
//     autoplay: {
//       delay: 4000,
//       disableOnInteraction: false,
//     },
//     grabCursor: true,
//     watchSlidesProgress: true,
//     navigation: {
//       nextEl: '.card03 .swiper-button-next',
//       prevEl: '.card03 .swiper-button-prev',
//     },
//     breakpoints: {
//       600: {
//         slidesPerView: 2,
//       },
//       1025: {
//         slidesPerView: 4,
//         spaceBetween: 32,
//       }
//     },
//   });
// });




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

 </body></html>



 <section id="demo03" class="card03 l-section">
    <div class="swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-watch-progress">
        <div class="swiper-wrapper" id="swiper-wrapper-ee136ddec2d7545b" aria-live="off" style="cursor: grab; transition-duration: 0ms; transform: translate3d(-2488px, 0px, 0px);">
            <?php foreach($results as $result): ?>
            <a href="#" class="swiper-slide" role="group" aria-label="Slide" data-swiper-slide-index="<?php echo $result["result_id"]; ?>" style="width: 279px; margin-right: 32px;">
                <article class="slide">
                    <div class="slide-media img-cover">
                        <img src="https://picsum.photos/id/225/800/500" alt="Slide Image">
                    </div>
                    <div class="slide-content">
                        <time class="slide-date" datetime="<?php echo $result["match_date"]; ?>">
                            <?php echo $result["match_date"]; ?>
                        </time>
                        <div class="match-info">
                            <span class="team-name">FC.ESPERTO</span>
                            <span class="score">
                                <?php echo $result["home_half"] + $result["home_goals"]; ?> - 
                                <?php echo $result["away_half"] + $result["away_goals"]; ?>
                            </span>
                            <span class="team-name"><?php echo $result["team_name"]; ?></span>
                        </div>
                        <div class="match-info"><?php echo $result["place"]; ?></div>
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





<section id="demo05" class="card04 l-section">
        <div class="l-inner">
          <div class="swiper swiper-b swiper-backface-hidden swiper-initialized swiper-horizontal swiper-pointer-events">
              <div class="swiper-wrapper" id="swiper-wrapper-fc5910813ab388c13" aria-live="off" style="cursor: grab; transform: translate3d(-2488px, 0px, 0px); transition-duration: 0ms;">
                <?php foreach($results as $result): ?>
                <a href="#" class="swiper-slide" role="group" aria-label="Slide" data-swiper-slide-index="<?php echo $result["result_id"]; ?>" style="width: 280px; margin-right: 32px;">
                    <article class="slide">
                        <div class="slide-media img-cover">
                            <img src="https://picsum.photos/id/139/800/500" alt="Slide Image">
                        </div>
                        <div class="slide-content">
                            <time class="slide-date" datetime="<?php echo $result["match_date"]; ?>">
                                <?php echo $result["match_date"]; ?>
                            </time>    
                            <div class="match-info">
                                <span class="team-name">FC.ESPERTO</span>
                                <span class="score">
                                    <?php echo $result["home_half"] + $result["home_goals"]; ?> - 
                                    <?php echo $result["away_half"] + $result["away_goals"]; ?>
                                </span>
                                <span class="team-name"><?php echo $result["team_name"]; ?></span>
                            </div>
                            <div class="match-info"><?php echo $result["place"]; ?></div>    
                        </div>
                    </article>
                </a>
                 <?php endforeach; ?> 
              </div></swiper-wrapper -->
            <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-fc5910813ab388c13"></div>
            <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-fc5910813ab388c13"></div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
          </div><!-- /swiper -->
         </div> 
      </section>




      <script>
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });
    </script>


https://picsum.photos/id/225/800/500


/* .swiper-slide {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    
} */