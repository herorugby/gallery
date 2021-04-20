<?php

// セッションがあるかを判定してからスタートする
if (!isset($_SESSION)) {
    session_start();
}

// グローバル変数のセッションを全て解除する空にする上書きをする
$_SESSION = array();
// ログアウト時の決まり文句ini_setでセッションにクッキーを使うかどうか
if (ini_set("session.use_cookies")) {
    // セッションのクッキーが使っているオプションを指定
    $params = session_get_cookie_params();
    // クッキーの有効期限を設けることでクッキーを削除する
    setcookie(session_name() . '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}

// セッションの破壊
session_destroy();

// クッキーに保存したアドレスを空文字を指定してクッキーを削除する
setcookie('email', '', time() - 3600);

header('Location: index.php');
die();
