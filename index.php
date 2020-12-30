<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/jquery.ui.min.css">
<link rel="stylesheet" href="css/custom.css">


<?php
require_once('LoadFiles.class.php');
?>

<form action="/php-simple-pictures-gallery-manager/index.php" method="get">
Search: <input type="text" name="search"><br>
<input type="submit">
</form>
<a href="/php-simple-pictures-gallery-manager">Reset</a>
<div class="container">
  <div class="row">



<?php
$loadFilesClass = new LoadFiles;
// $dir = 'C:\Users\George\Downloads\xxx';
// $files = scandir($dir, 0);
// usort($files, 'strnatcasecmp');

if(isset($_GET['search'])){
    $loadFilesClass->scanDirectory($_GET['search']);
} else {
    $loadFilesClass->scanDirectory();
}
    

// $results = array_search("red",$a);
?>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col"><</div>
    <div class="col">></div>
  </div>
</div>