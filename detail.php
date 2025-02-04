<?php
session_start();

$id = $_GET['id']; //?id~**を受け取る

require_once 'funcs.php';
sschk();
$pdo = db_conn();

//２．登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM contents WHERE id=:id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．表示
if (!$status) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>更新</title>
    <link rel="stylesheet" href="css/common.css" />
    <link rel="stylesheet" href="css/detail.css" />
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">登録一覧</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
                <div class="navbar-header user-name"><p><?= $_SESSION['name'] ?>さん、こんにちは！</p></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->
    <form method="POST" action="update.php" enctype="multipart/form-data">
        <div class="jumbotron">
            <fieldset>
                <legend>[編集]</legend>

            <?php
            if (!empty($row['image'])) {
                echo '<img src="' . h($row['image']) . '" class="image-class">';
            ?>
            <div>
                <label for="new_image">別の画像に変更する場合は以下から登録：</label>
            <?php
            }
            else {
            ?>
            <div>
                <label for="new_image">新しい画像を追加する場合は以下から登録：</label>
            <?php } ?>

                <input type="file" id="new_image" name="new_image">
            </div>

                <div>
                    <label for="evaluate">その気持ちの強さ：</label>
                    <input type="range" id="evaluate" name="evaluate" min="0" max="100" value="<?= h($row['evaluate']) ?>">
                    
                </div>
                <div>
                    <label for="content">その気持ちを言葉にすると：</label>
                    <textarea id="content" name="content" rows="4" cols="40"><?= h($row['content']) ?></textarea>
                </div>
                <div>
                    <input type="submit" value="更新">
                    <input type="hidden" name="id" value="<?= $id ?>">
                </div>
            </fieldset>
        </div>
    </form>
</body>
</html>
