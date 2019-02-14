<?php
require_once('header.php');

// userがログインしていなければindex.phpに遷移する
if(!isset($_SESSION[user])){
    header('location:index.php');
    exit();
}

?>  
<div class="col-sm-8 offset-sm-2">
    <section>
        <h2>登録フォーム</h2>
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