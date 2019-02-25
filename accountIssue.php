<?php
require_once('db.php');
require_once('header.php');
$insert_sql = 'INSERT INTO user (user_id, password) VALUES (:user_id, :password)';
try{
    // データベースへ接続
    $db = new PDO($pdo, $db_user, $db_password);
    if(isset($_POST['regist'])){
        if(empty($_POST['user_id']) && empty($_POST['password'])){
            exit();
        }
        $user_id = $_POST['user_id'];
        $pass_hash = password_hash($_POST['password'],PASSWORD_BCRYPT);
        $stmt = $db->prepare($insert_sql);
        $stmt -> bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt -> bindValue(':password', $pass_hash, PDO::PARAM_STR);
        $stmt -> execute();

        header('location: login.php');
        exit();
    }
    
} catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e);
}
?>

                <div class="col-sm-6 offset-sm-3">
                    <section>
                        <h2>アカウント発行</h2>
                        <form class="form" action="accountIssue.php" method="post">
                            <div class="form-gruop">
                                <label class="form-label">管理者ID</label>
                                <input class="form-control" type="text" name="user_id">
                            </div>
                            <div class="form-gruop">
                                <label class="form-label">パスワード</label>
                                <input class="form-control" type="password" name="password">
                            </div>
                            <input class="btn btn-outline-success" type="submit" name="regist" value="登録">
                        </form>
                    </section>
                </div>

<?php require_once('footer.php'); ?>