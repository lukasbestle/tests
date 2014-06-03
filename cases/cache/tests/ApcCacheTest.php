<?php

require_once(__DIR__ . '/CacheCase.php');

class ApcCacheTest extends CacheCase {

  protected function setUp() {
    $this->_setUp('apc');
  }

}