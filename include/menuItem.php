<?php
  class MenuItem
  {
    public $url;
    public $title;
    public $isCurrent;

    function __construct($url, $title, $isCurrent) {
      $this->url = $url;
      $this->title = $title;
      $this->isCurrent = $isCurrent;
    }
  }
?>