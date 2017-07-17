<?php
/**
 * Created by PhpStorm.
 * User: nyker
 * Date: 2017/07/15
 * Time: 18:42
 *
 * データベースとのやりとりをするクラスの定義
 */

namespace utils;


class DataBase
{

    /**
     * 接続文字列
     */
    const DSN = 'mysql:dbname=%s;host=localhost;charset=utf8;';

    /**
     * データベース名
     */
    const DBNAME = 'php-tutorial';

    /**
     * ユーザー名
     */
    const USER_NAME = 'root';

    /**
     * パスワード
     */
    const PASSWORD = 'hoge';

    /**
     * PDOインスタンス
     * @var \PDO
     */
    static private $instance = null;

    /**
     * コンストラクタ
     * @access private
     */
    private function __construct()
    {
    }

    /**
     * db接続のためのPDOインスタンスを取得する
     * 取得するのは一回だけでいいので, 一度取得して居たら既にあるものを返す
     */
    private static function getInstance()
    {

        if (is_null(self::$instance)) {
            $options = array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            );
            self::$instance = new \PDO(
                sprintf(self::DSN, self::DBNAME),
                self::USER_NAME,
                self::PASSWORD,
                $options
            );
        }
        return self::$instance;
    }

    /**
     * Select文の実行
     * @param string $sql
     * @param array array $array
     * @return array
     */
    public
    static function select($sql, array $array = array())
    {
    }
}