<?php

// db情報のテンプレを取得する
require_once('dbinfo.php');

// data source name
$dsn = "mysql:dbname=$DBNM;host=$SERV;port=$PORT;charset=$CHAR";

// data base handler
$dbh = null;

try {
    // ハンドラでdbと接続
    $dbh = new PDO($dsn, $USER, $PASS);
    // 接続できない場合は、エラーレポートを行う
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'DB接続不可：' . $e->getMessage();
    die();
}
