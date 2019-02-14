<?php
require_once('db.php');
require_once('view/header.php');

$insert_sql = 'INSERT INTO user (user_id, password) VALUES (:user_id, :password)';

try{
    // データベースへ接続
    $db = new PDO($pdo, $db_user, $db_password);

    if(isset($_POST['regist'])){
        if(empty($_POST['user_id']) && empty($_POST['password'])){
            exit();
        }
    }

    $user_id = $_POST['user_id'];
    $pass_hash = password_hash($_POST['password'],PASSWORD_BCRYPT);

    $stmt = $db->prepare($insert_sql);
    $stmt -> bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt -> bindValue(':password', $pass_hash, PDO::PARAM_STR);
    $stmt -> execute();


} catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e);
}

?>

<section>
    <h2>アカウント発行</h2>
    <form class="form" action="pass.php" method="post">
        <div class="form-gruop">
            <label class="form-label">管理者ID</label>
            <input class="form-control" type="text" name="user_id">
        </div>
        <div class="form-gruop">
            <label class="form-label">パスワード</label>
            <input class="form-control" type="password" name="password">
        </div>
        <button class="btn btn-outline-success" type="submit" name="regist" value="登録">登録</button>
    </form>
</section>

<?php require_once('view/footer.php'); ?>
