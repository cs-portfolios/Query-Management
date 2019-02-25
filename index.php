<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>問い合わせフォーム</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container-fluid">
        <main>
            <div class="row">
                <div class="col-sm-8 offset-sm-2">
                    <section>
                        <h1>問い合わせ入力フォーム</h1>
                        <p>管理者のとしてのログインは<a href="login.php">こちら</a></p>
                        <form action="logic.php" method="post">
                            <div class="form-group">
                                <label class="form-lable">氏名</label>
                                <input class="form-control" type="text" name="name" required>  
                            </div>
                            <div class="form-group">
                                <label class="form-lable">メールアドレス</label>
                                <input class="form-control" type="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label class="form-lable">問い合わせ内容</label>
                                <textarea class="form-control" type="text" name="content" maxlength="500" rows="10" required></textarea>
                            </div>
                            <input class="btn btn-block btn-outline-success" type="submit" name="register" value="登録">
                        </form>
                    </section>
                </div>

<?php require_once('footer.php'); ?>