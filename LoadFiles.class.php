<?php

require_once('globals.class.php');
require_once('PagesContent.trait.php');
require_once('Pagination.class.php');

class LoadFiles {
    use PagesContent;

    public $directory_name;

    function __construct($directory_name = null, $folder = null, $search = null, $last_in_page = null, $folder_path = null) {
        $this->directory_name = $directory_name;
        $this->search = $search;
        $this->folder = $folder;
        $this->folder_path = $folder_path;
        $this->pagination = new Pagination($last_in_page);
    }

    function setDirectory(){
        $this->directory_name = $this->directory_name ?? Globals::DEFAULT_DIRECTORY;
        return $this->directory_name . ($this->folder ? '\\'. rawurldecode($this->folder) : '');
    }

    function scanDirectoryForFiles(){
        $directory_name = $this->setDirectory($this->folder);
        $files = array_diff(scandir($directory_name . '/', 1), array(".", ".."));
        // echo count($files);
        usort($files, 'strnatcasecmp');
        return $files;
    }

    function searchInDirectory($search, $files, $i){
        $search = $search ? urldecode($search) : '';
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

    function loadGallery(){
        $html = '';
        $files = $this->scanDirectoryForFiles($this->folder);
        $last_on_page = $this->pagination->setMaxPagination(count($files), $this->search);
        $start_on_page = $this->pagination->setMinPagination($this->search);
        for($i = $start_on_page; $i < $last_on_page; $i++){
            if($this->search !== null && $this->searchInDirectory($this->search, $files, $i) === false){
                continue;
            }
            $new_dir = $this->setDirectory($this->folder).'\\'.$files[$i];
            if($this->folder === null) {
                $content_page = $this->mainIndexPage($new_dir, $files, $i);
            }else {
                $content_page = $this->viewPage($new_dir, $files, $i, $this->folder);
            }
            if(empty($content_page)){
                continue;
            }
            $html .= $content_page;
        }
        return $html;
    }
    
}
?>