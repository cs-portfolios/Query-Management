<?php
require_once('header.php');
require_once('db.php');

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

                if (password_verify($password, $password_hash) && $user_id === $row['user_id']){

                    session_regenerate_id(true); //セッションIDの再発行
                    $_SESSION['user'] = $row;

                    header('location: index.php');
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
<div class="col-sm-6 offset-sm-3">
    <section>
        <h2>ログイン</h2>
        <form action="" method="post">
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