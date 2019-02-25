<?php
require_once('db.php');
require_once('header.php');

// データベースからデータを取得する
$select_sql = 'SELECT * FROM content ORDER BY uploaded_at';

try{
    // データベースに接続
    $db = new PDO($pdo, $db_user, $db_password);

    $stmt = $db -> prepare($select_sql);
    $stmt->execute();

} catch(PDOException $e){

    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());

}
?>
                <div class="col-sm-10 offset-sm-1">
                    <section>
                        <h2>問い合わせ一覧</h2>
                        <table class="table">
                            <tr>    
                                <th>問い合わせ日</th>
                                <th>氏名</th>
                                <th>対応状況</th>
                                <th>&nbsp;</th>
                            </tr>
                            <?php while ($row = $stmt -> fetch(PDO::FETCH_ASSOC) ): ?>
                            <tr>
                                <td><?= $row['uploaded_at'] ?></td>
                                <td><?= h($row['name']) ?></td>
                                <td><?= $row['status'] ?></td>
                                <td>
                                    <form class="form" action="info.php" metod="get">
                                        <input type="hidden" name="info" value="<?= $row['id'] ?>">
                                    <button class="btn btn-outline-info" type="submit">詳細</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endwhile ?>
                        </table>
                    </section>
                </div>
<?php require_once('footer.php'); ?>