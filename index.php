<?php

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ようこそ小野寛智ギャラリーへ</title>

    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="base.css">
</head>

<body>
    <div class="wrap">
        <header>
            <h1>○○様ようこそ！</h1>
            <div>
                <a href="logout.php">ログアウト</a>
            </div>
        </header>

        <main>
            <div>
                <img src="images/images.JPG" alt="小野寛智の写真" width="200" height="200">
            </div>

            <form action="" method="post">
                <dl>
                    <div>
                        <dt>コメントをどうぞ</dt>
                        <dd>
                            <textarea name="message" id="message" cols="50" rows="5"></textarea>
                        </dd>
                    </div>
                </dl>
                <div>
                    <input type="submit" value="投稿する">
                </div>

            </form>

            <div>
                <p>
                    <span>ネーム：</span>コメントコメントコメント<br>
                    <span>2021,04,19</span>
                </p>
                <p>
                    <a href="delete.php">削除</a>
                </p>
            </div>

            <div>
                <ul>
                    <li><a href="index.php?page=">前のページ</a></li>
                    <li>前のページ</li>
                    <li><a href="index.php?page=">次のページ</a></li>
                    <li>次のページ</li>
                </ul>
            </div>


        </main>

        <footer id="footer" class="footer">
            <div class="footer__copy-right">
                <p><small>&copy; <span id="copyRight"></span> Hirotomo Ono</small></p>
            </div>
        </footer>
    </div>
</body>

</html>
