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
        //$numbers[$i] = $row[$i]["member_num"];
        //$jnames[$i] = $row[$i]["member_name"];
        //$enames[$i] = $row[$i]["member_roma_name"];
    
        if($row[$i]["member_pos"] == "GK"){
            $GKs[$i] = $row[$i];
        
        }elseif($row[$i]["member_pos"] == "DF"){
            $DFs[$i] = $row[$i];
        }elseif($row[$i]["member_pos"] == "MF"){
            $MFs[$i] = $row[$i];
        }elseif($row[$i]["member_pos"] == "FW"){
            $FWs[$i] = $row[$i];
        }

    }

    print_r($FWs);
    exit;
} 
catch (PDOException $e) {
    echo "データベースに接続できませんでした：" . $e->getMessage();
    exit;
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
        <div class="container">
            <div class="header-left"><a href="C:\Users\Bell\OneDrive\デスクトップ\ESPERTO\index.html">FC.ESPERTO</a></div>
            <div class="header-right">
              <ul class="menu-lists">
                <li class="menu-list"><a href="#">TEAM</a>
                  <ul class="drop-lists">
                    <li class="drop-list"><a href="C:\Users\Bell\OneDrive\デスクトップ\ESPERTO\club.html">クラブ概要</a></li>
                    <li class="drop-list"><a href="C:\Users\Bell\OneDrive\デスクトップ\ESPERTO\member.html">メンバー</a></li>
                  </ul>
                </li>
                <li class="menu-list"><a href="#">MATCHES</a>
                  <ul class="drop-lists">
                    <li class="drop-list"><a href="C:\Users\Bell\OneDrive\デスクトップ\ESPERTO\match.html">試合情報</a></li>
                    <li class="drop-list"><a href="C:\Users\Bell\OneDrive\デスクトップ\ESPERTO\result.html">試合結果</a></li>
                    <li class="drop-list"><a href="C:\Users\Bell\OneDrive\デスクトップ\ESPERTO\league.html">順位表</a></li>
                  </ul>
                </li>
                <li class="menu-list"><a href="C:\Users\Bell\OneDrive\デスクトップ\ESPERTO\contact.html">CONTACT US</a></li>
                <li class="menu-list"><a href="https://www.instagram.com/f.c__esperto?utm_source=ig_web_button_share_sheet&igsh=MmVlMjlkMTBhMg==" class="instagram"><span class="fa fa-instagram"></span></a></li>
            </ul>
          </div>
        </div>
    </header>
    <div class="top-wrapper">
        <div class="container">
            <h1>TEAM</h1>
        </div>
    </div>
    <div class="players-wrapper">
        <div class="container">
          <h2 class="heading">PLAYERS</h2>
          <div class="players-all">
            
            <h3>GK</h3>
            <?php
                foreach($GKs as $GK)
                
                ?>        
                    
            <h3>DF</h3>
            <?php
                foreach($DFs as $DF)
                
                ?>     
                    
            <h3>MF</h3>
            <?php
                foreach($MFs as $MF)
                
                ?>
                   
            <h3>FW</h3>
            <?php
                foreach($FWs as $FW)
                
                ?>
                    
            
            
            <ul class="playerList">
                <li class="playerList__item">
                    <a href="/team/2023/01_wakahara_tomoya">
                        <div class="playerList__item__boxNum">
                        <?php
                
                            foreach($number as $num){
                            echo "<span class='number'>{$num}</span>";
                            }
                        
                            foreach($position as $pos){

                            echo "<span class='position'>{$pos}</span>";
                            }
                        
                        ?>
                        </div>
                        <div class="playerList__item__boxImg">
                        <img  src="C:\Users\Bell\Downloads\Shutterstock_580100869.jpg" alt = "">
                        </div>
                        <div class="playerList__item__boxNames">
                        <?php
                            foreach($jname as $j) {

                            echo "<p class='boxNameJp'>{$j}</p>";
                            }

                            foreach($enames as $ena){

                            echo "<p class='boxNameEn'>{$ena}</p>";
                            }
                        ?>
                        </div>
                    </a>
                </li>
                <li class="playerList__item">
                    <a href="/team/2023/21_warner_hahn">
                        <div class="playerList__item__boxNum">
                        <span class="number">31</span>
                        <span class="position">GK</span>
                        </div>
                        <div class="playerList__item__boxImg">
                        <img src="C:\Users\Bell\Downloads\Shutterstock_580100869.jpg">
                        </div>
                        <div class="playerList__item__boxNames">
                        <p class="boxNameJp">西宮 真南人</p>
                        <p class="boxNameEn">Manato Nishimiya</p>
                        </div>
                    </a>
                </li>
                <li class="playerList__item">
                    <a href="/team/2023/26_ota_gakuji">
                        <div class="playerList__item__boxNum">
                        <span class="number">26</span>
                        <span class="position">GK</span>
                        </div>
                        <div class="playerList__item__boxImg">
                        <img src="C:\Users\Bell\Downloads\Shutterstock_580100869.jpg">
                        </div>
                        <div class="playerList__item__boxNames">
                        <p class="boxNameJp">濱田 恵助</p>
                        <p class="boxNameEn">Keisuke Hamada</p>
                        </div>
                    </a>
                </li>
            </ul>
            <h3 >DF</h3>
            <ul class="playerList">
                <li class="playerList__item">
                    <a href="/team/2023/01_wakahara_tomoya">
                        <div class="playerList__item__boxNum">
                        <span class="number">3</span>
                        <span class="position">DF</span>
                        </div>
                        <div class="playerList__item__boxImg">
                        <img  src="C:\Users\Bell\Downloads\Shutterstock_606491741.jpg" alt = "">
                        </div>
                        <div class="playerList__item__boxNames">
                        <p class="boxNameJp">澤田 崇文</p>
                        <p class="boxNameEn">Takafumi Sawada</p>
                        </div>
                    </a>
                </li>
                <li class="playerList__item">
                    <a href="/team/2023/21_warner_hahn">
                        <div class="playerList__item__boxNum">
                        <span class="number">7</span>
                        <span class="position">DF</span>
                        </div>
                        <div class="playerList__item__boxImg">
                        <img src="C:\Users\Bell\Downloads\Shutterstock_606491741.jpg">
                        </div>
                        <div class="playerList__item__boxNames">
                        <p class="boxNameJp">道下 紘平</p>
                        <p class="boxNameEn">Kouhei Mitishita</p>
                        </div>
                    </a>
                </li>
                <li class="playerList__item">
                    <a href="/team/2023/26_ota_gakuji">
                        <div class="playerList__item__boxNum">
                        <span class="number">17</span>
                        <span class="position">DF</span>
                        </div>
                        <div class="playerList__item__boxImg">
                        <img src="C:\Users\Bell\Downloads\Shutterstock_606491741.jpg">
                        </div>
                        <div class="playerList__item__boxNames">
                        <p class="boxNameJp">森 貴之</p>
                        <p class="boxNameEn">Takayuki Mori</p>
                        </div>
                    </a>
                </li>
                <li class="playerList__item">
                    <a href="/team/2023/01_wakahara_tomoya">
                        <div class="playerList__item__boxNum">
                        <span class="number">37</span>
                        <span class="position">DF</span>
                        </div>
                        <div class="playerList__item__boxImg">
                        <img  src="C:\Users\Bell\Downloads\Shutterstock_606491741.jpg" alt = "">
                        </div>
                        <div class="playerList__item__boxNames">
                        <p class="boxNameJp">太田 祐資</p>
                        <p class="boxNameEn">Yuzi Ota</p>
                        </div>
                    </a>
                </li>
                <li class="playerList__item">
                    <a href="/team/2023/21_warner_hahn">
                        <div class="playerList__item__boxNum">
                        <span class="number">70</span>
                        <span class="position">DF</span>
                        </div>
                        <div class="playerList__item__boxImg">
                        <img src="C:\Users\Bell\Downloads\Shutterstock_606491741.jpg">
                        </div>
                        <div class="playerList__item__boxNames">
                        <p class="boxNameJp">森田 将太</p>
                        <p class="boxNameEn">Shota Morita</p>
                        </div>
                    </a>
                </li>
                <li class="playerList__item">
                    <a href="/team/2023/26_ota_gakuji">
                        <div class="playerList__item__boxNum">
                        <span class="number">96</span>
                        <span class="position">DF</span>
                        </div>
                        <div class="playerList__item__boxImg">
                        <img src="C:\Users\Bell\Downloads\Shutterstock_606491741.jpg">
                        </div>
                        <div class="playerList__item__boxNames">
                        <p class="boxNameJp">坂本 千太郎</p>
                        <p class="boxNameEn">Sentaro Sakamoto</p>
                        </div>
                    </a>
                </li>
            </ul>
            <h3>MF</h3>
            <ul class="playerList">
                <li class="playerList__item">
                    <a href="/team/2023/01_wakahara_tomoya">
                        <div class="playerList__item__boxNum">
                        <span class="number">4</span>
                        <span class="position">MF</span>
                        </div>
                        <div class="playerList__item__boxImg">
                        <img  src="C:\Users\Bell\Downloads\Shutterstock_1075084739.jpg" alt = "">
                        </div>
                        <div class="playerList__item__boxNames">
                        <p class="boxNameJp">端野 健</p>
                        <p class="boxNameEn">Ken Hashino</p>
                        </div>
                    </a>
                </li>
                <li class="playerList__item">
                    <a href="/team/2023/21_warner_hahn">
                        <div class="playerList__item__boxNum">
                        <span class="number">6</span>
                        <span class="position">MF</span>
                        </div>
                        <div class="playerList__item__boxImg">
                        <img src="C:\Users\Bell\Downloads\Shutterstock_1075084739.jpg">
                        </div>
                        <div class="playerList__item__boxNames">
                        <p class="boxNameJp">板谷 大輝</p>
                        <p class="boxNameEn">Daiki Itatani</p>
                        </div>
                    </a>
                </li>
                <li class="playerList__item">
                    <a href="/team/2023/26_ota_gakuji">
                        <div class="playerList__item__boxNum">
                        <span class="number">13</span>
                        <span class="position">MF</span>
                        </div>
                        <div class="playerList__item__boxImg">
                        <img src="C:\Users\Bell\Downloads\Shutterstock_1075084739.jpg">
                        </div>
                        <div class="playerList__item__boxNames">
                        <p class="boxNameJp">大西 草太</p>
                        <p class="boxNameEn">Sota Onishi</p>
                        </div>
                    </a>
                </li>
                <li class="playerList__item">
                    <a href="/team/2023/01_wakahara_tomoya">
                        <div class="playerList__item__boxNum">
                        <span class="number">14</span>
                        <span class="position">MF</span>
                        </div>
                        <div class="playerList__item__boxImg">
                        <img  src="C:\Users\Bell\Downloads\Shutterstock_1075084739.jpg" alt = "">
                        </div>
                        <div class="playerList__item__boxNames">
                        <p class="boxNameJp">松本 雄太</p>
                        <p class="boxNameEn">Yuta Matsumoto</p>
                        </div>
                    </a>
                </li>
                <li class="playerList__item">
                    <a href="/team/2023/21_warner_hahn">
                        <div class="playerList__item__boxNum">
                        <span class="number">15</span>
                        <span class="position">MF</span>
                        </div>
                        <div class="playerList__item__boxImg">
                        <img src="C:\Users\Bell\Downloads\Shutterstock_1075084739.jpg">
                        </div>
                        <div class="playerList__item__boxNames">
                        <p class="boxNameJp">今井 蒼空</p>
                        <p class="boxNameEn">Sora Imai</p>
                        </div>
                    </a>
                </li>
                <li class="playerList__item">
                    <a href="/team/2023/26_ota_gakuji">
                        <div class="playerList__item__boxNum">
                        <span class="number">33</span>
                        <span class="position">MF</span>
                        </div>
                        <div class="playerList__item__boxImg">
                        <img src="C:\Users\Bell\Downloads\Shutterstock_1075084739.jpg">
                        </div>
                        <div class="playerList__item__boxNames">
                        <p class="boxNameJp">石島 和真</p>
                        <p class="boxNameEn">Kazuma Isizima</p>
                        </div>
                    </a>
                </li>
            </ul>
            <h3>FW</h3>
            <ul class="playerList">
                <li class="playerList__item">
                    <a href="/team/2023/01_wakahara_tomoya">
                        <div class="playerList__item__boxNum">
                        <span class="number">5</span>
                        <span class="position">FW</span>
                        </div>
                        <div class="playerList__item__boxImg">
                        <img  src="C:\Users\Bell\Downloads\Shutterstock_606491411.jpg" alt = "">
                        </div>
                        <div class="playerList__item__boxNames">
                        <p class="boxNameJp">辻 徹也</p>
                        <p class="boxNameEn">Tetsuya Tsuzi</p>
                        </div>
                    </a>
                </li>
                <li class="playerList__item">
                    <a href="/team/2023/21_warner_hahn">
                        <div class="playerList__item__boxNum">
                        <span class="number">10</span>
                        <span class="position">FW</span>
                        </div>
                        <div class="playerList__item__boxImg">
                        <img src="C:\Users\Bell\Downloads\Shutterstock_606491411.jpg">
                        </div>
                        <div class="playerList__item__boxNames">
                        <p class="boxNameJp">中本 淳一郎</p>
                        <p class="boxNameEn">Junitiro Nakamoto</p>
                        </div>
                    </a>
                </li>
                <li class="playerList__item">
                    <a href="/team/2023/26_ota_gakuji">
                        <div class="playerList__item__boxNum">
                        <span class="number">11</span>
                        <span class="position">FW</span>
                        </div>
                        <div class="playerList__item__boxImg">
                        <img src="C:\Users\Bell\Downloads\Shutterstock_606491411.jpg">
                        </div>
                        <div class="playerList__item__boxNames">
                        <p class="boxNameJp">畑山 一都</p>
                        <p class="boxNameEn">Kazuto Hatayama</p>
                        </div>
                    </a>
                </li>
                <li class="playerList__item">
                    <a href="/team/2023/01_wakahara_tomoya">
                        <div class="playerList__item__boxNum">
                        <span class="number">20</span>
                        <span class="position">FW</span>
                        </div>
                        <div class="playerList__item__boxImg">
                        <img  src="C:\Users\Bell\Downloads\Shutterstock_606491411.jpg" alt = "">
                        </div>
                        <div class="playerList__item__boxNames">
                        <p class="boxNameJp">堀場 弾</p>
                        <p class="boxNameEn">Dan Horiba</p>
                        </div>
                    </a>
                </li>
                <li class="playerList__item">
                    <a href="/team/2023/21_warner_hahn">
                        <div class="playerList__item__boxNum">
                        <span class="number">32</span>
                        <span class="position">FW</span>
                        </div>
                        <div class="playerList__item__boxImg">
                        <img src="C:\Users\Bell\Downloads\Shutterstock_606491411.jpg">
                        </div>
                        <div class="playerList__item__boxNames">
                        <p class="boxNameJp">米澤 雅也</p>
                        <p class="boxNameEn">Masaya Yonezawa</p>
                        </div>
                    </a>
                </li>
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
  
    </body>
  </html>