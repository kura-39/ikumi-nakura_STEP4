<?php

session_start();

$errors = [];

$name = '';
$age = '';
$phone = '';
$email = '';
$address = '';
$question = '';
$gender = '男性';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 入力値を取得
    $name = trim($_POST['name'] ?? '');
    $age = trim($_POST['age'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $question = trim($_POST['question'] ?? '');
    $gender = $_POST['gender'] ?? '';

    /*
     * 名前
     * ひらがな・カタカナ・漢字・英字のみ
     */
    if ($name === '') {
        $errors['name'] = '名前を入力してください。';
    } elseif (!preg_match('/^[\p{Hiragana}\p{Katakana}\p{Han}A-Za-z]+$/u', $name)) {
        $errors['name'] = '名前はひらがな、カタカナ、漢字、英字のみ使用できます。';
    }

    /*
     * 年齢
     * 0歳～150歳
     */
    if ($age === '') {
        $errors['age'] = '年齢を入力してください。';
    } elseif (!ctype_digit($age) || (int)$age < 0 || (int)$age > 150) {
        $errors['age'] = '年齢は0歳から150歳の間で入力してください。';
    }

    /*
     * 電話番号
     * 半角数字とハイフンのみ
     */
    if ($phone === '') {
        $errors['phone'] = '電話番号を入力してください。';
    } elseif (!preg_match('/^[0-9-]+$/', $phone)) {
        $errors['phone'] = '電話番号は半角数字とハイフンのみ使用できます。';
    }

    /*
     * メールアドレス
     */
    if ($email === '') {
    $errors['email'] = 'メールアドレスを入力してください。';
} elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $errors['email'] = 'メールアドレスの形式が正しくありません。';
}

    /*
     * 住所
     * ひらがな・カタカナ・漢字・英字・半角数字・ハイフンのみ
     */
    if ($address === '') {
        $errors['address'] = '住所を入力してください。';
    } elseif (!preg_match('/^[\p{Hiragana}\p{Katakana}\p{Han}A-Za-z0-9-]+$/u', $address)) {
        $errors['address'] = '住所に使用できない文字が含まれています。';
    }

    /*
     * 性別
     */
    if ($gender !== '男性' && $gender !== '女性') {
        $errors['gender'] = '性別を選択してください。';
    }
    if (empty($errors)) {

    $_SESSION['form_data'] = [
        'name' => $name,
        'age' => $age,
        'phone' => $phone,
        'email' => $email,
        'address' => $address,
        'question' => $question,
        'gender' => $gender
    ];

    header('Location: confirm.php');
    exit;
}
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フォーム入力</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <main class="form-container">

        <h1>フォーム入力</h1>

        <form action="form.php" method="post">

            <div class="form-item">
                <label for="name">名前:</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>"
                >

                <?php if (isset($errors['name'])): ?>
                    <p class="error"><?= htmlspecialchars($errors['name'], ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>
            </div>

            <div class="form-item">
                <label for="age">年齢:</label>
                <input
                    type="text"
                    id="age"
                    name="age"
                    value="<?= htmlspecialchars($age, ENT_QUOTES, 'UTF-8') ?>"
                >

                <?php if (isset($errors['age'])): ?>
                    <p class="error"><?= htmlspecialchars($errors['age'], ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>
            </div>

            <div class="form-item">
                <label for="phone">電話番号:</label>
                <input
                    type="text"
                    id="phone"
                    name="phone"
                    value="<?= htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') ?>"
                >

                <?php if (isset($errors['phone'])): ?>
                    <p class="error"><?= htmlspecialchars($errors['phone'], ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>
            </div>

            <div class="form-item">
                <label for="email">メールアドレス:</label>
                <input
                    type="text"
                    id="email"
                    name="email"
                    value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>"
                >

                <?php if (isset($errors['email'])): ?>
                    <p class="error"><?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>
            </div>

            <div class="form-item">
                <label for="address">住所:</label>
                <input
                    type="text"
                    id="address"
                    name="address"
                    value="<?= htmlspecialchars($address, ENT_QUOTES, 'UTF-8') ?>"
                >

                <?php if (isset($errors['address'])): ?>
                    <p class="error"><?= htmlspecialchars($errors['address'], ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>
            </div>

            <div class="form-item">
                <label for="question">質問:</label>
                <input
                    type="text"
                    id="question"
                    name="question"
                    value="<?= htmlspecialchars($question, ENT_QUOTES, 'UTF-8') ?>"
                >
            </div>

            <div class="form-item">
                <label for="gender">性別:</label>
                <select id="gender" name="gender">
                    <option value="男性" <?= $gender === '男性' ? 'selected' : '' ?>>男性</option>
                    <option value="女性" <?= $gender === '女性' ? 'selected' : '' ?>>女性</option>
                </select>

                <?php if (isset($errors['gender'])): ?>
                    <p class="error"><?= htmlspecialchars($errors['gender'], ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>
            </div>

            <div class="button-area">
                <button type="submit">送信</button>
            </div>

        </form>

    </main>

</body>

</html>

