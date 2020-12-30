<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/jquery.ui.min.css">
<link rel="stylesheet" href="css/custom.css">
<?php 
require_once('globals.class.php');
require_once('LoadFiles.class.php');
?>
<form action="/<?php echo Globals::POJECT_DIR; ?>" method="get">
Search: <input type="text" name="search"><br>
<input type="submit">
</form>
<a href="/<?php echo Globals::POJECT_DIR; ?>">Reset</a>
<div class="container">
  <div class="row">
<?php
$loadFilesClass = new LoadFiles;
if(isset($_GET['search'])){
    echo $loadFilesClass->loadGallery($_GET['search']);
} else {
    echo $loadFilesClass->loadGallery();
}
?>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col"><</div>
    <div class="col">></div>
  </div>
</div>