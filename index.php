<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/jquery.ui.min.css">
<link rel="stylesheet" href="css/custom.css">
<?php 
require_once('LoadFiles.class.php');
?>
<form action="/<?php echo Globals::POJECT_DIR; ?>" method="get">
Search: <input type="text" name="search"><br>
<input type="submit">
</form>
<a href="/<?php echo Globals::POJECT_DIR; ?>">Reset</a>
<?php
$loadFilesClass = new LoadFiles(null, $_GET['search'] ?? null, $_GET['last_page'] ?? null);
echo $loadFilesClass->paginantionPage();
 ?>
<div class="container">
  <div class="row">
<?php
if(isset($_GET['search'])){
    echo $loadFilesClass->loadGallery();
} else {
    echo $loadFilesClass->loadGallery();
}
?>
  </div>
</div>
<?php echo $loadFilesClass->paginantionPage(); ?>