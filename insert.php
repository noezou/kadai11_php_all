<?php
session_start();
require_once('funcs.php');
sschk();

//1. POST内容取得
$content = $_POST['content'];
$evaluate = $_POST['evaluate'];

// echo '<pre>';
// var_dump($_POST['content']);
// var_dump($_POST['evaluate']);
// echo '</pre>';
// exit;

// ログインユーザーIDを取得
$user_id = $_SESSION['user_id'];

// 画像アップロードの処理
// echo '<pre>';
// var_dump($_SESSION['user_id']);
// echo '</pre>';
// exit;


$image = '';

if (isset($_FILES['image'])) {
    // アップロードする画像をリネームする準備
    $uploaded_file = $_FILES['image']['tmp_name']; // 一時保存されている先
    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION); // 拡張子を取得
    $new_name = uniqid() . '.' . $extension; // ファイル名をユニーク化＝名前を一意にする
    // image_pathを確認
    $image_path = 'img/' . $new_name; // 保存先を指定

    // move_uploaded_file()で、一時的に保管されているファイルをimage_pathに移動させる。
    if (move_uploaded_file($uploaded_file, $image_path)) {
        $image = $image_path;
    }
}

//２． DB接続します
$pdo = db_conn();

//３．登録SQL作成
$stmt = $pdo->prepare('INSERT INTO contents(user_id,content,created_at,image,evaluate)VALUES(:user_id,:content,NOW(),:image,:evaluate);');

// echo '<pre>';
// var_dump($stmt);
// echo '</pre>';
// exit;

$stmt->bindValue(':user_id',  $user_id,  PDO::PARAM_INT);
$stmt->bindValue(':content',  $content,  PDO::PARAM_STR);
$stmt->bindValue(':image',    $image,    PDO::PARAM_STR);
$stmt->bindValue(':evaluate', $evaluate, PDO::PARAM_INT);

$status = $stmt->execute(); //実行

// echo '<pre>';
// var_dump($_SESSION);
// var_dump($id);
// var_dump($content);
// var_dump($image);
// var_dump($evaluate);
// echo '</pre>';
// exit;

//４．登録処理後
if (!$status) {
    sql_error($stmt);
} else {
    redirect('select.php');
}
