<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/jquery.ui.min.css">
<link rel="stylesheet" href="css/custom.css">
<?php 
require_once('LoadFiles.class.php');
$loadFilesClass = new LoadFiles(null, null, $_GET['search'] ?? null, $_GET['last_page'] ?? null, null);
?>
<div class="container">
  	<div class="row">
    	<form action="/<?php echo Globals::POJECT_DIR; ?>" class="form-inline" method="get">
			<div class="form-group mx-sm-3 mb-2">
				<label for="inputSearch" class="sr-only">Search:</label>
				<input type="text" class="form-control" id="inputSearch" placeholder="Search" name="search">
			</div>
			<button type="submit" class="btn btn-primary mb-2">Submit</button>
			<div class="form-group mx-sm-3 mb-2">
			  <a href="/<?php echo Globals::POJECT_DIR; ?>">Reset</a>
			</div>
    	</form>
  	</div>
  	<?php echo $loadFilesClass->paginantionPage(); ?>
  	<div class="row">
    	<?php echo $loadFilesClass->loadGallery(); ?>
  	</div>
  	<?php echo $loadFilesClass->paginantionPage(); ?>
</div>
