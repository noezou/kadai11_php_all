<?php
session_start();

require_once 'funcs.php';
sschk();

//1. データ取得
$id     = $_POST['id'];
$content = $_POST['content'];
$new_image = $_POST['new_image'];
$evaluate = $_POST['evaluate'];

if (isset($_FILES['new_image'])){
    // アップロードする画像をリネームする準備
    $uploaded_file = $_FILES['new_image']['tmp_name']; // 一時保存されている先
    $extension = pathinfo($_FILES['new_image']['name'], PATHINFO_EXTENSION); // 拡張子を取得
    $new_name = uniqid() . '.' . $extension; // ファイル名をユニーク化＝名前を一意にする
    // image_pathを確認
    $image_path = 'img/' . $new_name; // 保存先を指定

     // move_uploaded_file()で、一時的に保管されているファイルをimage_pathに移動させる。
    if(move_uploaded_file($uploaded_file, $image_path)){
        $image = $image_path;
            }
}

//2. DB接続します

$pdo = db_conn();

//３．登録SQL更新
$stmt = $pdo->prepare('UPDATE contents SET content = :content, image = :image, evaluate = :evaluate WHERE id=:id;');
$stmt->bindValue(':content',  $content,  PDO::PARAM_STR);
$stmt->bindValue(':image',    $image,    PDO::PARAM_STR);
$stmt->bindValue(':evaluate', $evaluate, PDO::PARAM_INT);
$stmt->bindValue(':id',       $id,       PDO::PARAM_INT);

$status = $stmt->execute(); //実行

//４．更新登録処理後
if ($status === false) {
    sql_error($stmt);
} else {
    redirect('select.php');
}
