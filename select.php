<?php
// 0. SESSION開始！！
session_start();

// 1. ログインチェック処理！
// セッションID持ってたら、ok
// 持ってなければ、閲覧できない処理にする。
// 関数化して、他ページにも流用する
require_once('funcs.php');
sschk();


// 1.DB接続する
$pdo = db_conn();

// 2.データ取得SQL作成 登録済みのものを持ってくるので攻撃気にしないで良い
$stmt = $pdo->prepare('
SELECT
 contents.id as id,
 users.name as name,
 contents.content as content,
 contents.image as image,
 contents.evaluate as evaluate
FROM contents JOIN users ON contents.user_id = users.id');
$status = $stmt->execute();

// 3.データ表示
$view = '';

if (!$status) {
    sql_error($stmt);
} else {
    while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<div class="record"><p>';
        $view .= '<a href="detail.php?id=' . $r["id"] . '">';
        $view .= h($r['id'])  . " @ " . $r['name'];
        $view .= '<br><img src="' . h($r['image']) . '" class="image-class">' ."【". h($r['evaluate'])."】". h($r['content']);
        $view .= '</a>';
        $view .= "　";

        if ($_SESSION['kanri_flg'] === 1) {
            $view .= '<a class="btn btn-danger" href="delete.php?id=' . $r['id'] . '">';
            $view .=  '削除' . '</a>';
        }
        $view .= '</p></div>';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>こころログ[一覧表示]</title>
    <!-- <link rel="stylesheet" href="css/login.css" /> -->
    <link rel="stylesheet" href="css/common.css" />
    <link rel="stylesheet" href="css/select.css" />

</head>

<body id="main">
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="index.php">今の気持ちを登録する</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
                <div class="navbar-header user-name"><p><?= $_SESSION['name'] ?>さん、こんにちは！</p></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <div>
        <div class="container jumbotron"><?= $view ?></div>
    </div>
    <!-- Main[End] -->

</body>

</html>
