<?php
/**
 * Created by PhpStorm.
 * User: nyker
 * Date: 2017/07/15
 * Time: 18:21
 */
include './inc_login.php';

echo <<<EOT
<h3>{$id}さんログイン中</h3>
<a href="foo.php?{$param}">リロード</a> |
<a href="foo.php?logout=1&{$param}">ログアウト</a>
<form action="foo.php" method="post">
{$hidden}
<input type="submit" value="送信" />
</form>
EOT;
