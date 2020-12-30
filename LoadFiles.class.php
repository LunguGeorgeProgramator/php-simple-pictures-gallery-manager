<?php

class LoadFiles {

    public $directory_name;

    function __construct($directory_name = null) {
        $this->directory_name = $directory_name;
    }

    function setDirectory($folder = null){
        $this->directory_name = $this->directory_name ?? Globals::DEFAULT_DIRECTORY;
        return $this->directory_name . ($folder ? '\\'. rawurldecode($folder) : '');
    }

    function scanDirectoryForFiles($folder = null){
        $directory_name = $this->setDirectory($folder);
        $files = scandir($directory_name, 0);
        usort($files, 'strnatcasecmp');
        return $files;
    }

    function searchInDirectory($search, $files, $i){
        $text = addslashes(urldecode($search));
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

    function loadGallery($search = null, $folder = null){
        $html = $search ? urldecode($search) : '';
        $files = $this->scanDirectoryForFiles($folder);
        $i_val = $folder ? 2 : 0;
        for($i = $i_val; $i < count($files); $i++){
            if($files[$i]  == "." || $files[$i]  == "..") {
                continue;
            }
            if($search !== null && $this->searchInDirectory($search, $files, $i) === true){
                continue;
            }
            $new_dir = $this->setDirectory($folder).'\\'.$files[$i];
            if($folder === null) {
                $content_page = $this->mainIndexPage($new_dir, $files, $i);
            }else {
                $content_page = $this->viewPage($new_dir, $files, $i, $folder);
            }
            if(empty($content_page)){
                continue;
            }
            $html .= $content_page;
        }
        return $html;
    }

    function mainIndexPage($new_dir, $files, $i){
        $httml = '';
        if (is_dir($new_dir)) {
            $filesNew = scandir($new_dir, 0);
            if($filesNew){
                if(isset($filesNew[2])){
                    $filesNew[2] = $filesNew[2];
                } else {
                    $filesNew[2] = $filesNew[0];
                }
                if (file_exists( $new_dir.'\\'.$filesNew[2])) {
                    $httml .= '<div class="col">';
                    $filename = $new_dir.'\\'.$filesNew[2]; 
                    $pict = '/'. array_reverse(explode('\\', $new_dir))[1].'/'.$files[$i].'/'.$filesNew[2];
                    $pict = $this->replaceString($pict);
                    $name = rawurlencode(str_replace('&', '%26', $files[$i]));
                    $httml .= '<a target="_blank" href="/'.Globals::POJECT_DIR.'/view.php?folder='. $name.'"><img src="'.$pict.'" alt="Smiley face" width="250"></ass><br>';
                    $httml .= "<b style='height: 100px; overflow: hidden;'>".$files[$i]."</b>";
                    $httml .= '</div>';
                } else {
                    return $httml;
                }
            }
        } else {
            return $httml;
        }
        return $httml;
    }

    function viewPage($file, $files, $i, $folder){
        $html = '';
        if (!file_exists($file)) { 
            return $html;
        }  
        $pict = '/'. array_reverse(explode('\\', $file))[2].'/'.rawurldecode($folder).'/'.$files[$i];  
        $pict = $this->replaceString($pict);
        $html .= '<img class="col" src="'.$pict.'"  data-highres="'.$pict.'" width="250" alt="Smiley face" >';
        return $html;
    }

    function replaceString($str){
        $str = str_replace('%','%25', $str);
        $str = str_replace('#','%23', $str);
        return $str;
    }

}
?>