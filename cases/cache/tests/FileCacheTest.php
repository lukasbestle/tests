<?php

require_once(__DIR__ . '/CacheCase.php');

class FileCacheTest extends CacheCase {

  protected function setUp() {
    $this->_setUp('file');
  }

}