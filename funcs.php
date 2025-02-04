<?php

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn()
require_once('db_info.php'); //データベース接続情報が記載されているファイルを読み込む
function db_conn()
{
    try {
        // グローバル変数（DB接続用）
        global $db_name; //データベース名   関数外の変数
        global $db_host; //DBホスト名  関数外の変数
        global $db_id; //アカウント名  関数外の変数
        global $db_pw; //パスワード：MAMPは'root'  関数外の変数
        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo; // $pdoに入れただけだと関数内で消えてしまうので、returnで関数を呼び出した先に値を戻す
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}

//SQLエラー
function sql_error($stmt)
{
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('SQLError:' . $error[2]);
}

//リダイレクト関数: redirect($file_name)
function redirect($file_name)
{
    header('Location: ' . $file_name);
    exit();
}

// ログインチェク処理
// SessionCheck関数
function sschk(){
    if (!isset($_SESSION{'chk_ssid'}) || $_SESSION['chk_ssid'] != session_id()) {
    // ログインを経由していない場合
    exit('LOGIN ERROR!');
    };
        session_regenerate_id(true); // セッションハイジャック対策 SESSION KEYを入れ替える
        $_SESSION['chk_ssid']= session_id();
}
