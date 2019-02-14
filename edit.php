<?php
require_once('header.php');
require_once('db.php');

// userがログインしていなければindex.phpに遷移する
if(!isset($_SESSION['user'])){
    header('location:index.php');
    exit();
}

$select_sql = 'SELECT * FROM content WHERE id = :edit_id';

try{
    $db = new PDO($pdo, $db_user, $db_password);

    if(isset($_GET['edit_id'])){
        $edit_id = $_GET['edit_id'];
        $stmt = $db -> prepare($select_sql);
        $stmt -> bindValue(':edit_id', $edit_id, PDO::PARAM_INT);
        $stmt -> execute();

        $row = $stmt -> fetch(PDO::FETCH_ASSOC);
    }

} catch(PDOException $e){
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}

switch($row['status']){
    case '未対応':
        $checked0 = 'checked';
        break;

    case '対応完了':
        $checked1 = 'checked';
        break;
}

?>
<div class="col-sm-8 offset-sm-2">
    <section>
        <h2>編集</h2>
        <div class="nav justify-content-end">
            <form action="logic.php" method="post">
                <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                <button class="btn btn-outline-danger" type="submit">削除</button>
            </form>
        </div>
        <form class="form" action="logic.php" method="post">
            <div class="form-group">
                <label class="form-lable">氏名</label>
                <input class="form-control" type="text" name="name" 
                value="<?= h($row['name']) ?>" required>  
            </div>
            <div class="form-group">
                <label class="form-lable">メールアドレス</label>
                <input class="form-control" type="email" name="email" 
                value="<?= h($row['email']); ?>" required>
            </div>
            <div class="form-group">
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="未対応" <?= $checked0 ?> >
                    <label class="control-label">未対応</label>
                </div>
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="対応完了" <?= $checked1 ?> >
                    <label class="control-label">対応完了</label>
                </div>
            </div>
            <div class="form-group">
                <label class="form-lable">問い合わせ内容</label>
                <textarea class="form-control" type="text" 
                name="content" maxlength="1000"
                rows="10" required><?= h($row['content']) ?></textarea>
            </div>
            <input  type="hidden" name="edit_id" value="<?= $row['id'] ?>">
            <button class="btn btn-block btn-outline-success" type="submit">登録</button>
        </form>
    </section>
</div>
<?php require_once('footer.php'); ?>