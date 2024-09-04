<?php
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
    $sql = "SELECT *
            FROM details
            INNER JOIN results ON details.result_id = results.result_id 
            INNER JOIN teams ON details.away_team_id = teams.team_id 
            INNER JOIN lineups ON details.result_id = lineups.result_id
            INNER JOIN members ON lineups.player_id = members.member_id";
    
    $rows = $pdo->query($sql);
    $row = $rows->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "データベースに接続できませんでした：" . $e->getMessage();
    exit;
}

$results = [];
foreach ($row as $r) {
    $results[$r['result_id']]['result'] = $r;
    $results[$r['result_id']]['members'][] = $r;

    // 交代選手のデータを取得
    if (!empty($r['ins'])) {
        $results[$r['result_id']]['ins'][] = $r['member_name'];
    }
    if (!empty($r['outs'])) {
        $results[$r['result_id']]['outs'][] = $r['member_name'];
    }
    
    
    // 得点者のデータを取得
    if ($r["scores"] != "0") {
    $results[$r['result_id']]['scorers'][] = ['member_name' => $r['member_name'], 'scores' => $r['scores']];
    }

}

// ポジション別のデータ
function filterByPosition($members, $position) {
    return array_filter($members, function($member) use ($position) {
        return $member['member_pos'] === $position;
    });
}

// print_r($subs);
//     exit;


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta name="robots" content="noindex">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FC.ESPERTOオフィシャル</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/stylesheet.css">
  <link rel="stylesheet" href="css/responsive-styles.css">
  <!-- <link rel="stylesheet"  href="css/sample.css"> -->
  <link rel="stylesheet"  href="css/sa.css">

</head>

<body>

<div class="top-wrapper">
  <div class="container">
    <h1>MATCH</h1>
  </div>
</div>
<div class="match-wrapper">
  <div class="container">
    <div class="heading">
      <h2>試合データ</h2>
    </div>
    <section id="demo01" class="card01 l-section">
      <div class="swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden matches">
        <div class="swiper-wrapper" id="swiper-wrapper-9cf1b6c69d4710530" aria-live="polite" style="cursor: grab; transform: translate3d(0px, 0px, 0px);"> 
          <?php foreach($results as $result_id => $result): ?>
          <a href="http://localhost/detail.php?result_id=<?php echo $result_id; ?>" class="swiper-slide" role="group" aria-label="Slide" data-swiper-slide-index="<?php echo $result_id; ?>" style="width: 279px; margin-right: 32px;">
            <article class="slide">
              <div class="slide-media img-cover">
                <img src="img/IMG_3871.JPG" alt="Slide Image">
              </div>
              <div class="slide-content">
                <div class="match-title"><?php echo $result['result']['match_category']; ?></div>
                <div class="date"><?php echo $result['result']["match_date"]; ?>KICK OFF </div>
                  <p class="place"><?php echo $result['result']['place']; ?></p>
                
                <div class="match-table">
                  <span class="team-name">FC.ESPERTO</span>
                  <span class="score">
                    <?php echo $result['result']["home_half"] + $result['result']["home_goals"]; ?> - 
                    <?php echo $result['result']["away_half"] + $result['result']["away_goals"]; ?>
                  </span>
                  <span class="team-name"><?php echo $result['result']["team_name"]; ?></span>
                  <span class="half-score"><?php echo $result['result']['home_half']; ?>-
                  <?php echo $result['result']['away_half']; ?></span>
                  <span class="half-score"><?php echo $result['result']["home_goals"]; ?>-
                  <?php echo $result['result']["away_goals"]; ?></span>
                  <p class="scorer">
                  <!-- 得点者を表示 -->
                    <?php if (!empty($result['scorers'])): ?>
                      <ul>
                        <?php foreach ($result['scorers'] as $scorer): ?>
                          <li><?php echo $scorer['member_name']; ?> × <?php echo $scorer['scores']; ?></li>
                        <?php endforeach; ?>
                        <?php else: ?>
                          得点者なし
                      </ul>
                    <?php endif; ?>
                  </p>

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
                      <?php foreach(['GK', 'DF', 'MF', 'FW'] as $pos): ?>
                        <?php foreach(filterByPosition($result['members'], $pos) as $member): ?>
                          <?php if($member['starter'] == "1"): ?>
                          <tr>
                            <td class="position"><?php echo $pos; ?></td>
                            <td><?php echo $member['member_num']; ?></td>
                            <td><?php echo $member['member_name']; ?></td>
                          </tr>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      <?php endforeach; ?>
                    </table>
                    <p>控えメンバー</p>
                    <table>
                      <tr>
                        <th>ポジション</th>
                        <th>背番号</th>
                        <th>名前</th>
                      </tr>
                      <?php foreach(['GK', 'DF', 'MF', 'FW'] as $pos): ?>
                        <?php foreach(filterByPosition($result['members'], $pos) as $member): ?>
                          <?php if($member['starter'] == "0"): ?>
                          <tr>
                            <td class="position"><?php echo $pos; ?></td>
                            <td><?php echo $member['member_num']; ?></td>
                            <td><?php echo $member['member_name']; ?></td>
                          </tr>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      <?php endforeach; ?>
                    </table>
                    <p>交代</p>
                    <table>
                      <tr>
                        <th>IN</th>
                        <th>OUT</th>
                      </tr>
                     
                      <?php if (isset($result['ins']) && isset($result['outs'])): ?>
                        <?php foreach ($result['ins'] as $index => $in_player): ?>
                        <tr>
                          <td><?php echo $in_player; ?></td>
                          <td><?php echo isset($result['outs'][$index]) ? $result['outs'][$index] : ''; ?></td>
                        </tr>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </table>
                      <div class="sammary">
                        <h6>試合総括</h6>
                        <p class='txt-content'><?php echo $result['result']["summary"]; ?></p>
                      </div>
                  </div>
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
</div>

<script src="./js/lib/swiper-bundle.min.js"></script>
<script src="./js/common.js?22020713"></script>
<script>
    (function() {
        const mySwiper = new Swiper('.card01 .swiper', {
            slidesPerView: 1,
            spaceBetween: 24,
            slidesPerGroup: 1,
            grabCursor: true,
            pagination: {
                el: '.card01 .swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.card01 .swiper-button-next',
                prevEl: '.card01 .swiper-button-prev',
            },
        });
    }());
</script>

</body>
</html>
