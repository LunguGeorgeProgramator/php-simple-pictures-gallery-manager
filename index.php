<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/jquery.ui.min.css">
<link rel="stylesheet" href="css/custom.css">

<form action="/gallery/index.php" method="get">
Search: <input type="text" name="search"><br>
<input type="submit">
</form>
<a href="/gallery">Reset</a>
<div class="container">
  <div class="row">



<?php
$dir = 'C:\Users\George\Downloads\xxx';
$files = scandir($dir, 0);
usort($files, 'strnatcasecmp');

if(isset($_GET['search'])){
    echo urldecode($_GET['search']);
    for($i = 0; $i < count($files); $i++){
        $text = addslashes(urldecode($_GET['search']));
        foreach( ['(', ')','[', ']', '{', '}', '_', '-', '.', '~', ','] as $ch ){
            preg_match('/(\\'.$ch.')/', $text, $matchess, PREG_OFFSET_CAPTURE);
            if(empty($matchess)){
                continue;
            }
            $text = str_replace($ch, '\\'.$ch, $text);
        }
        preg_match('/('.$text.')/i', $files[$i], $matches, PREG_OFFSET_CAPTURE);
        if(empty($matches)){
            continue;
        }

        $new_dir = $dir.'\\'.$files[$i];

        if($files[$i]  == "." || $files[$i]  == "..") {
            continue;
        }
        if (is_dir($new_dir)) {
           
            $filesNew = scandir($new_dir, 0);
            if($filesNew){
                if(isset($filesNew[2])){
                    $filesNew[2] = $filesNew[2];
                } else {
                    $filesNew[2] = $filesNew[0];
                }
                if (file_exists( $new_dir.'\\'.$filesNew[2])) {
                    echo '<div class="col">';
                    
                    $filename = $new_dir.'\\'.$filesNew[2]; 
                    $pict = '/xxx/'.$files[$i].'/'.$filesNew[2];
                    $pict = str_replace('%','%25',$pict);
                    $pict = str_replace('#','%23',$pict);
                    
                    $name = rawurlencode(str_replace('&', '%26', $files[$i]));
                    echo '<a target="_blank" href="/gallery/view.php?folder='.$name.'"><img src="'.$pict.'" alt="Smiley face" width="250"></ass><br>';
                    print "<b style='height: 100px; overflow: hidden;'>".$files[$i]."</b>";
                    echo '</div>';
                } else {
                    continue;
                }
                
            }
        } else {
            continue;
        }

        
    }
} else {
    for($i = 0; $i < count($files); $i++){

        $new_dir = $dir.'\\'.$files[$i];

        if($files[$i]  == "." || $files[$i]  == "..") {
            continue;
        }
        if (is_dir($new_dir)) {
           
            $filesNew = scandir($new_dir, 0);
            if($filesNew){
                if(isset($filesNew[2])){
                    $filesNew[2] = $filesNew[2];
                } else {
                    $filesNew[2] = $filesNew[0];
                }
                if (file_exists( $new_dir.'\\'.$filesNew[2])) {
                    echo '<div class="col">';
                    
                    $filename = $new_dir.'\\'.$filesNew[2]; 
                    $pict = '/xxx/'.$files[$i].'/'.$filesNew[2];
                    $pict = str_replace('%','%25',$pict);
                    $pict = str_replace('#','%23',$pict);
                    $name = rawurlencode(str_replace('&', '%26', $files[$i]));
                    echo '<a target="_blank" href="/gallery/view.php?folder='. $name.'"><img src="'.$pict.'" alt="Smiley face" width="250"></ass><br>';
                    print "<b style='height: 100px; overflow: hidden;'>".$files[$i]."</b>";
                    echo '</div>';
                } else {
                    continue;
                }
                
            }
        } else {
            continue;
        }
        // if($i === 20){
        //     break;
        // }
    }
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