<?php
session_start();

$lid = $_POST['lid'];
$lpw = $_POST['lpw'];

require_once('funcs.php');
// sschk();

$pdo = db_conn();

// usersに、登録があるか確認する。
// $stmt = $pdo->prepare('SELECT * FROM users where lid = :lid AND lpw = :lpw;');
$stmt = $pdo->prepare('SELECT * FROM users where lid = :lid AND life_flg = 0');
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
// $stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status === false) {
    sql_error($stmt);
}

//4. 抽出する数を取得
$val = $stmt->fetch(); //1レコードだけ取得する方法
// $count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能(件数取得)

// 入力したPasswordと暗号化されたPasswordを比較する。　戻り値：true,false
$pw = password_verify($lpw,$val['lpw']);
if($pw){
    //Login成功時 該当レコードがあればSESSIONに値を代入
    $_SESSION['chk_ssid'] = session_id();
    $_SESSION['user_id'] = $val['lid'];
    $_SESSION['kanri_flg'] = $val['kanri_flg'];
    $_SESSION['name'] = $val['name'];
    echo 'ログイン認証に成功しました';
    redirect('index.php');
}else{
    //Login失敗時(Logout経由)
    echo 'ログイン認証に失敗しました';
    redirect('logout.php');
}
?>