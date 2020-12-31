<?php

trait PagesContent {

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
                    $filename = $new_dir.'\\'.$filesNew[2]; 
                    $pict = '/'. array_reverse(explode('\\', $new_dir))[1].'/'.$files[$i].'/'.$filesNew[2];
                    $pict = $this->replaceString($pict);
                    $name = rawurlencode(str_replace('&', '%26', $files[$i]));
                    $httml .= '<div class="col-3">';
                        $httml .= '<div class="ex2">';
                            $httml .= '<a target="_blank" href="/'.Globals::POJECT_DIR.'/view.php?folder='. $name.'"><img src="'.$pict.'" alt="Smiley face" width="250"></ass><br>';
                        $httml .= '</div>';
                        $httml .= '<div class="ex3">';
                            $httml .= "<b style='height: 100px; overflow: hidden;'>".$files[$i]."</b>";
                        $httml .= '</div>';
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

    function paginantionPage($folder = null){
        $html = '<nav aria-label="...">';
        $html .= '<ul class="pagination">';
        $html .= '<li class="page-item"><a class="page-link" href="'.$this->setPaginationUrl().$this->pagination->getPrev().'">Previous</a></li>';
        $html .= '<li class="page-item"><a class="page-link" href="'.$this->setPaginationUrl().$this->pagination->getNext().'"> Next</a></li>';
        $html .= '</nav>';
        $html .= '</ul>';
        return $html;
    }

    function setPaginationUrl() {
        return '/'.Globals::POJECT_DIR.($this->folder_path ? $this->folder_path : '?search='.($this->search ?? '')).'&last_page=';
    }

    function replaceString($str){
        $str = str_replace('%','%25', $str);
        $str = str_replace('#','%23', $str);
        return $str;
    }
}