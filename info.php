<?php
require_once('db.php');
require_once('header.php');

// userがログインしていなければlogin.phpに遷移する
if(!isset($_SESSION['user'])){
    header('location:login.php');
    exit();
}

//データの取得処理
$select_sql = 'SELECT * FROM content WHERE id = :info_id';

try{
    $db = new PDO($pdo, $db_user, $db_password);

    if(isset($_GET['info'])){
        
        $info_id = $_GET['info'];
        $stmt = $db -> prepare($select_sql);
        $stmt -> bindValue(':info_id', $info_id, PDO::PARAM_STR);
        $stmt -> execute();

        $row = $stmt -> fetch(PDO::FETCH_ASSOC);
    }

} catch(PDOException $e){
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}

?>

                <div class="col-sm-8 offset-sm-2">
                    <section>
                        <ul class="nav">
                            <li class="list-item"><h2>問い合わせ詳細</h2></li>
                            <li class="nav-item">
                                <form class="form" action="edit.php" method="get">
                                    <input type="hidden" name="edit_id" value="<?= $row['id'] ?>">
                                    <button class="btn btn-outline-success" type="submit">編集</button>
                                </form>
                            </li>
                        </ul>
                        <table class="table">
                            <tr>
                                <th>問い合わせ日</th>
                                <td><?= $row['uploaded_at'] ?><td>
                            </tr>
                            <tr>
                                <th>氏名</th>
                                <td><?= h($row['name']) ?></td>
                            </tr>
                            <tr>
                                <th>E-mail</th>
                                <td><?= h($row['email']) ?></td>
                            </tr>
                            <tr>
                                <th>対応状況</th>
                                <td><?= $row['status'] ?></td>
                            </tr>
                            <tr>
                                <th>問い合わせ内容</th>
                                <td><?= h($row['content']) ?></td>
                            </tr>
                        </table>
                    </section>
                </div>
                
<?php require_once('footer.php'); ?>
