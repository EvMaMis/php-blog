<?php
include('path.php');
include(ROOT . '/app/database/db.php');
if($_SESSION) {
   $user = selectAny('users', ['id'=>$_SESSION['id']], 1);
   tt($user);
}
require_once(ROOT . "/app/include/head.php");
?>
<body>
<?php include("app/include/header.php"); ?>

<!-- main -->
<div class="container">
    <div class="content row">
        <div class="main-content col-md-9 col-12">
            <h2><?=$user['username']?></h2>
            <div class="row">
                <div class="img col-6">
                    <img src="<?=BASE_URL . 'assets/images/posts/' . $user['id_avatar']?>" alt="User avatar" class="img-thumbnail">
                </div>
                <div class="info col-6">
                    <i class="far fa-user"><?=$post['username']?></i>
                    <i class="far fa-calendar"><?=$post['created_date']?></i>
                </div>
                <div class="single_post_text col-12">
                    <?=$post['content']?>
                </div>
            </div>
            <?php include(ROOT . '/app/include/comments.php'); ?>
        </div>

        <?php include(ROOT . '/app/include/sidebar.php'); ?>

    </div>

</div>

<!--Main end-->
<?php include("app/include/footer.php") ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>