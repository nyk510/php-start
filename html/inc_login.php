<?php
// 設定
define('ADMIN_ID', 'admin');    // ユーザ名
define('ADMIN_PASS', 'ac0d18d42e66f85ced21654fc2c484d8'); // MD5ハッシュ化パスワード
define('LOCATION', '/');    // ログアウト後飛び先


// 処理振り分け
session_name('sid');
switch (true) {
    case login():
    case exist_sid():
        if (session_on()) break;
    default:
        page_login();
}

// ユーザ名がセットされているかを最終確認
if (empty($id)) die("失敗しました。");


//-------------------------------------------------------//
// 処理がここまでたどり着けば認証完了ということになる。  //
// このスクリプトの処理はここまでで終わり、              //
// include(require)元があればそちらに処理を移す          //
//-------------------------------------------------------//


/**
 * ログイン用ページを表示
 */
function page_login()
{
    $cryptpass = req('cryptpass');
    if ($cryptpass != "") {
        if (ctype_alnum($cryptpass)) die("英数字以外の文字も使用してください。");
        if (strlen($cryptpass) < 8) die("8文字以上を入力してください。");
        $cryptpass = md5($cryptpass);
    }

    // ログインフォーム
    echo <<<EOT
<html><head>
<meta http-equiv="Content-type" content="text/html; charset=Shift_JIS" />
<meta http-equiv="Set-Cookie" content="ON=1; expires=Tue, 1-Jan-2030 00:00:00 GMT" />

<script type="text/javascript" charset="UTF-8" src="//cache1.value-domain.com/xrea_header.js" async="async"></script>
</head><body>
<form action="{$_SERVER['SCRIPT_NAME']}" method="post">
[login認証]<br />
login:<input type="text" name="id" size="10" maxlength="20" /><br />
pass:<input type="password" name="pass" size="10" maxlength="20" /><br />
<input type="hidden" name="login" value="1" />
<input type="submit" value="認証" />
</form>
<form action="{$_SERVER['SCRIPT_NAME']}" method="post">
<hr />
[ADMIN_PASS設定用]<br />
<input type="text" name="cryptpass" value="{$cryptpass}" size="45" maxlength="50" />
<input type="submit" value="pass暗号化" />
</form>
</body></html>
EOT;
    exit;
}

/**
 * セッションＩＤを発行または更新
 */
function session_on()
{
    $sid = req(session_name());
    ini_set('session.use_trans_sid', '0');

    session_start();    // セッション開始
    if (empty($sid)) {    // login時なら
        $_SESSION['id'] = $GLOBALS['id'] = req('id');
    } else {    // セッション継続
        if (req('logout')) session_off();    // ログアウト処理
        if (empty($_SESSION['id'])) return false;
        $GLOBALS['id'] = $_SESSION['id'];

        // セッションＩＤを更新
        $tmp = $_SESSION;
        $_SESSION = array();
        session_destroy();
        session_id(md5(uniqid(rand(), 1)));
        session_start();
        $_SESSION = $tmp;
    }

    if (empty($_COOKIE['ON'])) {    // ブラウザがクッキー拒否なら
        $GLOBALS['hidden'] = "<input type=\"hidden\" name=\"" . session_name()
            . "\" value=\"" . session_id() . "\" />";
        $GLOBALS['param'] = session_name() . "=" . session_id();
    } else $GLOBALS['hidden'] = $GLOBALS['param'] = '';

    return true;
}

/**
 * ログアウト処理
 */
function session_off()
{
    setcookie(session_name(), "", time() - 42000);    // クッキーを消す
    $_SESSION = array();    // セッション変数を消す
    session_destroy();    // セッションファイルを消す
    header("Location: " . LOCATION);
    exit;
}

/**
 * リクエストデータ取得
 */
function req($key)
{
    return (isset($_REQUEST[$key]) ? $_REQUEST[$key] : '');
}

/**
 * 正当なセッションＩＤが送られてきたか判断
 */
function exist_sid()
{
    $sid = req(session_name());
    return (!empty($sid) && file_exists(session_save_path()
        . DIRECTORY_SEPARATOR . 'sess_' . $sid) ? true : false);
}

/**
 * 認証を行う
 */
function login()
{
    $login = req('login');
    if (!empty($login)) {
        $_REQUEST[session_name()] = '';
        $id = req('id');
        $pass = req('pass');
        if (!empty($id) && $id === ADMIN_ID
            && !empty($pass) && md5($pass) === ADMIN_PASS
        ) return true;
    }
    return false;
}