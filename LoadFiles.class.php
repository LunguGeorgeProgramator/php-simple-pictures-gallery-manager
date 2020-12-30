<?php

class LoadFiles {

    private $default_directory = 'C:\Users\George\Downloads\xxx';
    public $directory_name;

    function __construct($directory_name = null) {
        $this->directory_name = $directory_name ?? $this->default_directory;
    }

    function setDirectory(){
        $files = scandir($this->directory_name, 0);
        usort($files, 'strnatcasecmp');
        return $files;
    }

    function searchInDirectory(){
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
            return false;
        }
        return true;
    }


    function scanDirectory($search = null){
        echo $search ? urldecode($search) : '';
        $files = $this->setDirectory();
        for($i = 0; $i < count($files); $i++){

            if($search !== null && $this->searchInDirectory($search)  === true){
                continue;
            }
            
            $new_dir = $this->directory_name.'\\'.$files[$i];
    
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

    function cellHtmlContent(){
        return '';
    }
}



?>