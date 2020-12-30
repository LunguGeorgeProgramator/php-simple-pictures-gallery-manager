
<link rel="stylesheet" href="css/zoomwall.css">
<script type="text/javascript" src="js/zoomwall.js"></script>
<link rel="stylesheet" href="css/custom.css">
<script>
	window.onload = function() {
		zoomwall.create(document.getElementById('zoomwall'), true);
	};
</script>
<?php
require_once('globals.class.php');
require_once('LoadFiles.class.php');
?>
<div class="container">
    <div clss="row">
    <a href="/<?php echo Globals::POJECT_DIR; ?>">Back</a>
      <i style=" color: blue;"><?php echo rawurldecode( $_GET['folder'] ); ?> </i>
    </div>
  <div class="row zoomwall" id="zoomwall" >
<?php
$loadFilesClass = new LoadFiles;
echo $loadFilesClass->loadGallery($_GET['folder']);
?>
</div>
<div clss="row">
<a href="/<?php echo Globals::POJECT_DIR; ?>">Back</a>
<?php print rawurldecode($_GET['folder']); ?>
</div>
</div>