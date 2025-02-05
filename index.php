<?php
session_start();
// require_once('funcs.php');
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
    <link rel="stylesheet" href="./css/index.css" />
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
                <div class="navbar-header user-name">
                    <p><?= $_SESSION['name'] ?>さん、こんにちは！</p>
                </div>
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
                    <img src="<?php echo $image; ?>" class="face_img" , onclick="displayImageInfo('<?php echo $image; ?>')">
                <?php endforeach; ?>
            </div> <!-- flex-container end -->
        </div>

        <form method="post" action="insert.php" enctype="multipart/form-data">
            <!-- enctype="multipart/form-data"  画像をuploadするときに必ず書く！ -->
            <div class="jumbotron">
                <fieldset>
                    <legend>今の気持ち</legend>

                    <div id="imageInfo">
                        <p>
                            <script>
                                function displayImageInfo(imageSrc) {
                                    const fileName = imageSrc.split('/').pop();
                                    document.getElementById('imageInfo').innerHTML = `<div>選んだ画像：<img src="${imageSrc}" > <br> ファイル名： ${fileName} <br> URL： <a href="${imageSrc}" target="_blank">${imageSrc}</a></div>`;
                                }
                            </script>
                        </p>
                    </div>
                    <div>
                        <label for="image">画像のアップロード：　※データの受け渡しの自動化が未実装のため「ファイルを選択」からアップロードをお願いします。</label>
                        <input type="file" name="image" id="image">
                    </div>
                    <!-- <script>
                            async function setImageToFileInput(imageSrc, fileInput) {
                                const response = await fetch('imageSrc');
                                const blob = await response.blob();
                                const file = new File([blob], 'fileName', { type: blob.type });

                                const dataTransfer = new DataTransfer();
                                dataTransfer.items.add(file);
                                fileInput.files = dataTransfer.files;
                            }

                            // 例: 画像URLを input にセット
                            const fileInput = document.querySelector("#fileInput");
                            setImageToFileInput("fileName", fileInput);
                        </script> -->



                    <div>
                        <h2>その気持ちの強さは どれくらいですか？</h2>
                        <p>（0から100までの範囲で示してください。強いほど数字を大きくしてください。）</p>
                        <label for="evaluate">気持ちの強さ：</label>
                        <input type="range" name="evaluate" id="evaluate" min="0" max="100" value="0">
                        <p>数値は<span id="current-value"></span>です</p>
                    </div>
                    <script>
                        const inputEvaluate = document.getElementById('evaluate'); // input要素を取得
                        const currentValue = document.getElementById('current-value'); // 埋め込む先のspan要素
                        // 現在の値をspanに埋め込む関数
                        const setCurrentValue = (val) => {
                            currentValue.innerText = val;
                        };
                        // inputイベント時に値をセットする関数
                        const rangeOnChange = (e) => {
                            setCurrentValue(e.target.value);
                        };
                        window.onload = () => {
                            setCurrentValue(inputEvaluate.value); // ページ読み込み時に初期値をセット
                            inputEvaluate.addEventListener('input', rangeOnChange); // スライダー変化時にinputイベントを設定
                        };
                    </script>
                    <div>
                        <label for="content">その気持ちを言葉にすると：</label>
                        <textarea id="content" name="content" rows="4" cols="20"></textarea>
                    </div>
                    <div>
                        <input type="submit" value="送信">
                    </div>
                </fieldset>
            </div>
        </form>
</body>

</html>