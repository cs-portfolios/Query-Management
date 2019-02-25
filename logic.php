<?php
require_once('db.php');

// sql　処理
$insert_sql = 'INSERT INTO content( name, email, content, uploaded_at, status) VALUES(:name, :email, :content, NOW(), :status)';
$delete_sql = 'DELETE FROM content WHERE id = :delete_id';
$update_sql = 'UPDATE content SET name = :name, email = :email, content = :content, status = :status WHERE id = :edit_id';


//データベースに接続する
try{
    $db = new PDO($pdo, $db_user, $db_password);

    // データを削除する
    if(isset($_POST['delete_id'])){ 
        $delete_id = $_POST['delete_id'];
        $stmt = $db -> prepare($delete_sql);
        $stmt -> bindValue(':delete_id', $delete_id, PDO::PARAM_INT);
        $stmt -> execute();

        header('location: admin.php');
        exit();
    }

    // データを書き込む
    if(isset($_POST['register'])){ 
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $content = trim($_POST['content']);
        $status = '未対応'; // statusの初期値をセット
        
        $stmt = $db -> prepare($insert_sql);
        $stmt -> bindValue(":name", $name, PDO::PARAM_STR);
        $stmt -> bindValue(":email", $email, PDO::PARAM_STR);
        $stmt -> bindValue(":content", $content, PDO::PARAM_STR);
        $stmt -> bindValue(":status", $status, PDO::PARAM_STR);

        $stmt -> execute();

        header('location: index.php');
        exit();
    }

    // データを編集する
    if(isset($_POST['edit_id'])){

        $edit_id = $_POST['edit_id'];
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $content = trim($_POST['content']);
        $status = $_POST['status'];

        $stmt = $db -> prepare($update_sql);
        $stmt -> bindValue(":edit_id", $edit_id, PDO::PARAM_INT);
        $stmt -> bindValue(":name", $name, PDO::PARAM_STR);
        $stmt -> bindValue(":email", $email, PDO::PARAM_STR);
        $stmt -> bindValue(":content", $content, PDO::PARAM_STR);
        $stmt -> bindValue(":status", $status, PDO::PARAM_STR);
        $stmt -> execute();

        header('location: admin.php');
        exit();
    }

} catch(PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}

