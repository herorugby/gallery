<?php

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>画像確認</title>

    <link rel="stylesheet" href="../stylesheets/reset.css">
    <link rel="stylesheet" href="../stylesheets/base.css">
</head>

<body>
    <div class="wrap">
        <header>
            <h1>画像の確認</h1>
        </header>

        <main>
            <p>内容を確認して、「登録する」ボタンをクリック</p>

            <form action="" method="post">
                <input type="hidden" name="action" value="submit">
                <dl>
                    <div>
                        <dt>写真</dt>
                        <dd>

                        </dd>
                    </div>
                </dl>
                <div>
                    <a href="admin.php?action=rewrite">&laquo;&nbsp;選択し直す</a> ｜ <input type="submit" value="登録する">
                </div>

            </form>
        </main>

        <footer id="footer" class="footer">
            <div class="footer__copy-right">
                <p><small>&copy; <span id="copyRight"></span> Hirotomo Ono</small></p>
            </div>
        </footer>
    </div>
</body>

</html>
