<?php

// db情報のテンプレを取得する
require_once('dbinfo.php');

try {
    // ハンドラでdbと接続
    $dbh = new PDO($dsn, $user, $password);
    // 接続できない場合は、エラーレポートを行う
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'DB接続不可：' . $e->getMessage();
    die();
}
