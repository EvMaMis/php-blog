<?php
require_once("../../path.php");
require_once(ROOT . "/app/controllers/posts.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Blog</title>
    <script src="https://kit.fontawesome.com/40087f1b88.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.  com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Montserrat:wght@400;800&family=Roboto&display=swap"
          rel="stylesheet">

</head>
<body>

<?php include("../../app/include/header_admin.php"); ?>
<div class="container">
    <div class="row">
        <?php require_once("../../app/include/sidebar_admin.php"); ?>
        <div class="posts col-9">
            <?php require_once("../../app/include/buttons_admin.php") ?>

            <div class="row title-table">
                <h2>Управление записями</h2>
                <div class="col-1">ID</div>
                <div class="col-4">Название</div>
                <div class="col-3">Автор</div>
                <div class="col-4">Управление</div>
            </div>
            <?php foreach($posts as $key=>$post): ?>
                <div class="row post">
                    <div class="id col-1"><?=$key+1?></div>
                    <div class="title col-4"><?=$post['title']?></div>
                    <div class="author col-3"><?=$post['username']?></div>
                    <div class="edit col-1"><a href="">edit</a></div>
                    <div class="delete col-1"><a href="">delete</a></div>
                    <?php if($post['status']):?>
                    <div class="status col-2"><a href="">unpublish</a></div>
                    <?php else:?>
                    <div class="status col-2"><a href="">publish</a></div>
                    <?php endif;?>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
<?php include("../../app/include/footer.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>