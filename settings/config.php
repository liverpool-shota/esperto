<?php

// データベース接続情報
define('DB_HOST', 'localhost'); // データベースのホスト名
define('DB_USER', 'root'); // データベースのユーザー名
define('DB_PASS', ''); // データベースのパスワード
define('DB_NAME', 'esperto'); // データベース名

// データベースへの接続
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // その他の設定（オプション）
    echo "データベースに接続できました";
    // $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "データベースに接続できませんでした：" . $e->getMessage();
    exit;
}
