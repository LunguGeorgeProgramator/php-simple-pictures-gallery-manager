
<link rel="stylesheet" href="css/zzzz.css">
<script type="text/javascript" src="js/zzz.js"></script>
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
if(isset($_GET['folder'])){
   
    $dir = 'C:\Users\George\Downloads\xxx\\'.rawurldecode($_GET['folder']);
    $files = scandir($dir, 0);
    // sort($files);
    usort($files, 'strnatcasecmp');
    for($i = 2; $i < count($files); $i++){
        if($files[$i]  == "." || $files[$i]  == "..") {
            continue;
        }
        $file = $dir.'\\'.$files[$i];
        // if (is_dir($file)) {
        //     continue;
        // }
        if (!file_exists( $file)) { 
            continue;
        }  
        $pict = '/xxx/'.rawurldecode($_GET['folder']).'/'.$files[$i];  
        $pict = str_replace('%','%25',$pict);
        $pict = str_replace('#','%23',$pict);
        echo '<img class="col" src="'.$pict.'"  data-highres="'.$pict.'" width="250" alt="Smiley face" >';
      

    }
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