<?php
session_start();
// require_once 'funcs.php';
// sschk();

$dir = 'sample_img/';
$images = glob($dir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>こころログ[今の気持ちを登録]</title>
    <link rel="stylesheet" href="css/common.css" />
    <link rel="stylesheet" href="css/index.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
</head>

<body>
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">登録一覧表示</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="login.php">ログイン</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
                <div class="navbar-header user-name"><p><?= $_SESSION['name'] ?>さん、こんにちは！</p></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->
    <!-- Main[Start] -->
    <div>
        <div class="container jumbotron">
            <h1>今の気持ちを登録しよう</h1>
        </div>
        <div>
            <h2>次の画像の中で、今の自分の気持ちに最も近いと思う表情を１つ選択してください。</h2>

            <div class="flex-container">
            <?php foreach ($images as $image): ?>
            <img src="<?php echo $image; ?>"  class="face_img", onclick="displayImageInfo('<?php echo $image; ?>')">
            <?php endforeach; ?>
            </div> <!-- flex-container end -->
            <div id="imageInfo">
            <hr>
            <p>
            <script>
                function displayImageInfo(imageSrc) {
                const fileName = imageSrc.split('/').pop();
                document.getElementById('imageInfo').innerHTML = `<div>選択された画像：<img src="${imageSrc}" > <br> ファイル名： ${fileName} <br> URL： <a href="${imageSrc}" target="_blank">${imageSrc}</a></div>`;
                }
            </script>
            </p></div>
        
            <hr>
            <div class="slider-container">
                <h2>その気持ちの強さは どれくらいですか？</h2>
                <p>すぐ下の真ん中にある「四角いつまみ」を左右に動かし、0から100までの範囲で強さを表してください。（その気持ちが強いほど、数字を大きくしてください。）</p>
                <div id="slider"></div>
                <p>気持ちの強さ（100点満点中）：　<span id="rating">50</span> 点</p>
            </div>
            <script>
                $(function() {
                    $("#slider").slider({
                        min: 0,
                        max: 100,
                        step: 1,
                        value: 50,
                    slide: function(event, ui) {
                        $("#rating").text(ui.value);
                    }
                });
                });
            </script>
        </div>

        <form method="POST" action="insert.php" enctype="multipart/form-data" >
        <!-- enctype="multipart/form-data"  画像をuploadするときに必ず書く！ -->
        <div class="jumbotron">
            <fieldset>
                <legend>今の気持ち</legend>
                <div>
                    <label for="image">選択された画像：</label>
                    <input type="file" name="image" id="image" >
                </div>
                <div>
                    <label for="evaluate"  >気持ちの強さ：</label>
                    <input type="range" name="evaluate" id="evaluate"  min="0" max="100">
                </div>
                <div>
                    <label for="content">その気持ちを言葉にすると：</label>
                    <textarea id="content" name="content" rows="4" cols="40"></textarea>
                </div>
                <div>
                    <input type="submit" value="送信">
                </div>
            </fieldset>
        </div>
    </form>
</body>

</html>
