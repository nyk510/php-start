<html>
<head>
    <meta charset="UTF-8"/>
    <title>
        メソッドの判定サンプル
    </title>
</head>
</html>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: nyker
 * Date: 2017/07/15
 * Time: 10:48
 */
if (isset($_POST["comment"])) {
    $comment = htmlspecialchars($_POST["comment"]);
    print("あなたのコメントは$comment");
} else {
    ?>
    <p>コメントを以下に挿入</p>
    <form method="POST" action="detect_method.php">
        <input name="comment"/>
        <input type="submit" value="send"/>
    </form>
    <?php
}
?>
</body>
