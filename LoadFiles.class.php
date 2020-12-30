<?php

require_once('globals.class.php');
require_once('PagesContent.trait.php');
require_once('Pagination.class.php');

class LoadFiles {
    use PagesContent;

    public $directory_name;

    function __construct($directory_name = null, $search = null, $last_in_page = null) {
        $this->directory_name = $directory_name;
        $this->search = $search;
        $this->pagination = new Pagination($last_in_page);
    }

    function setDirectory($folder = null){
        $this->directory_name = $this->directory_name ?? Globals::DEFAULT_DIRECTORY;
        return $this->directory_name . ($folder ? '\\'. rawurldecode($folder) : '');
    }

    function scanDirectoryForFiles($folder = null){
        $directory_name = $this->setDirectory($folder);
        $files = array_diff(scandir($directory_name), array(".", ".."));
        echo count($files);
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

    function loadGallery($folder = null){
        $html = '';
        $files = $this->scanDirectoryForFiles($folder);
        $last_on_page = $this->pagination->setMaxPagination(count($files), $folder, $this->search);
        $start_on_page = $this->pagination->setMinPagination($folder, $this->search);
        for($i = $start_on_page; $i < $last_on_page; $i++){
            if($this->search !== null && $this->searchInDirectory($this->search, $files, $i) === false){
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
    
}
?>