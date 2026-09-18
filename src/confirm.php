<?php
session_start();

if (!isset($_SESSION['form_data'])) {
    header('Location: form.php');
    exit;
}

$form_data = $_SESSION['form_data'];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>入力内容確認</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <main class="form-container">

        <h1>入力内容確認</h1>

        <div class="confirm-item">

            <p>
                <strong>名前:</strong>
                <?= htmlspecialchars($form_data['name'], ENT_QUOTES, 'UTF-8') ?>
            </p>

            <p>
                <strong>年齢:</strong>
                <?= htmlspecialchars($form_data['age'], ENT_QUOTES, 'UTF-8') ?>
            </p>

            <p>
                <strong>電話番号:</strong>
                <?= htmlspecialchars($form_data['phone'], ENT_QUOTES, 'UTF-8') ?>
            </p>

            <p>
                <strong>メールアドレス:</strong>
                <?= htmlspecialchars($form_data['email'], ENT_QUOTES, 'UTF-8') ?>
            </p>

            <p>
                <strong>住所:</strong>
                <?= htmlspecialchars($form_data['address'], ENT_QUOTES, 'UTF-8') ?>
            </p>

            <p>
                <strong>質問:</strong>
                <?= htmlspecialchars($form_data['question'], ENT_QUOTES, 'UTF-8') ?>
            </p>

            <p>
                <strong>性別:</strong>
                <?= htmlspecialchars($form_data['gender'], ENT_QUOTES, 'UTF-8') ?>
            </p>

        </div>

    </main>

</body>

</html>