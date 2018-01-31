<?php
include_once('config.php');
include_once('startup.php');
include_once('Model/M_Users.php');

startup();

// CREATE CLASS -> M_Users
$mUsers = M_Users::Instance();

$mUsers->ifLogin();

?>
<!doctype html>
<html>
<head>
    <?php include('View/blocks/head_tags.php'); ?>
</head>
<body>

<?php include('View/blocks/aside.php'); ?>
<main>
    <?php include('View/blocks/header.php'); ?>
    <div class='wrapper'>
       <?=$content?>
    </div>
</main>

<!-- Sort stuff -->
<form action="?c=article_select" id="sform" method="post" data-table-sort-pos>
    <input name="sortdata" id="sortdata" type="hidden" value=""/>
</form>

<?php include('View/blocks/toast.php'); ?>

<script src="ckeditor/ckeditor.js"></script>
<script src="js/table_view.js"></script>
<script>
    $('[data-ckeditor]').each(function (index, value) {
        CKEDITOR.replace($(value).attr('id'));
    });
</script>
<script src="js/edin_insert.js"></script>


<?php if ($_SESSION['notice']): ?>
    <script>
        $(document).ready(function () {
            showSuccessMessage('<?=$_SESSION['notice']?>');
        });
    </script>
<?php endif; ?>

<?php if ($_SESSION['error']): ?>
    <script>
        $(document).ready(function () {
            showErrorMessage('<?=$_SESSION['error']?>');
        });
    </script>
<?php endif; ?>

</body>
</html>