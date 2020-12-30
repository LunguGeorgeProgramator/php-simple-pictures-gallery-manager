
<link rel="stylesheet" href="css/zoomwall.css">
<script type="text/javascript" src="js/zoomwall.js"></script>
<style>
html,
body {
  margin: 0;
  padding: 0;
}

body { background-color: black; }

header {
  padding: 1em;
  background-color: #333;
  text-align: center;
}
h1 { color:#fff;}
a:link,
a:visited {
  text-decoration: none;
  font-family: sans-serif;
  color: white;
}

a:hover { color: #ddd; }

#author { float: left; }

#repo { float: right; }

#title {
  display: inline-block;
  font-weight: bold;
}
</style>
<script>
	window.onload = function() {
		zoomwall.create(document.getElementById('zoomwall'), true);
	};
</script>
<div class="container">
    <div clss="row">
    <a href="/gallery">Back</a>
    <?php
    echo '<i style=" color: blue;">'.rawurldecode( $_GET['folder'] ). '</i>';
    ?>
    </div>
  <div class="row zoomwall" id="zoomwall" >
<?php
require_once('LoadFiles.class.php');
$loadFilesClass = new LoadFiles;

if(isset($_GET['folder'])){
  echo $loadFilesClass->loadGallery(null, $_GET['folder']);
}
?>
</div>
<div clss="row">
<a href="/gallery">Back</a>
<?php
print rawurldecode($_GET['folder']);
?>
</div>
</div>