<?php

require_once(__DIR__ . '/CacheCase.php');

class MemcachedTest extends CacheCase {

  protected function setUp() {
    $this->_setUp('memcached');
  }

}