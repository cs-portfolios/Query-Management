<?php
require_once('db.php');

session_start();

$select_sql = 'SELECT * FROM user WHERE user_id = :user_id';

if(isset($_POST['login'])){

    // 未入力を弾く
    if(!empty($_POST['user_id'] && !empty($_POST['password']))){
        $user_id = $_POST['user_id'];
        $password = $_POST['password'];
        
        try{
            $db = new PDO($pdo, $db_user, $db_password);
            $stmt = $db -> prepare($select_sql);
            $stmt -> bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($rows as $row){
                $password_hash = $row['password'];

                if (password_verify($password, $password_hash)){

                    session_regenerate_id(true); //セッションIDの再発行
                    $_SESSION['user'] = $row;

                    header('location: admin.php');
                    exit();
                }

            } 

        } catch(PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            exit($e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>問い合わせフォーム/ログイン</title>
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
                <div class="col-sm-6 offset-sm-3">
                    <section>
                        <nav class="navbar navbar-expand-sm justify-content-between">
                        <h1>ログイン</h1>
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="btn btn-outline-info" href="index.php">フォームへ戻る</a>
                            </li>
                        </ul>
                        </nav>
                        <form action="login.php" method="post">
                            <div class="form-gruop">
                                <label class="control-label">管理者ID</label>
                                <input class="form-control" type="text" name="user_id">
                            </div>
                            <div class="form-group">
                                <label class="control-label">パスワード</label>
                                <input class="form-control" type="password" name="password">
                            </div>
                            <input class="btn btn-outline-info" type="submit" name="login" value="ログイン">
                        </form>
                    </section>
                </div>
                
<?php require_once('footer.php'); ?>