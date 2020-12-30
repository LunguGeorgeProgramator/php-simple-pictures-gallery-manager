<?php

class Pagination {

    private $next;
    private $prev;
    private $last_page;

    function __construct($last_page){
        $this->last_page = intval($last_page ?? Globals::MAX_ON_PAGE);
        $this->next = $this->setNext();
        $this->prev = $this->setPrev();
    }

    function setNext(){
        return $this->last_page + Globals::MAX_ON_PAGE;
    }

    function setPrev(){
        $prev = ($this->last_page ?? 0) - Globals::MAX_ON_PAGE;
        return $prev < 0 ? 0 : $prev;
    }

    function getNext() : int {
        return $this->next;
    }

    function getPrev() : int {
        return $this->prev;
    }

    function getLastPage() : int {
        return $this->last_page;
    }

    function setMaxPagination($max, $folder, $search) : int {
        return $folder || $search ? $max : ($this->getLastPage() >= $max ? $max : $this->getLastPage());
    }

    function setMinPagination($folder, $search) : int {
        return $folder || $search ?  0 : $this->getPrev();
    }

}