<?php

require_once(__DIR__ . '/../bootstrap.php');

class GdLibTest extends PHPUnit_Framework_TestCase {

  protected function setUp() {

    $this->site = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site'    => root('test.site'),
      'thumb.root'   => root('test.thumbs.a'),
      'thumb.url'    => 'thumbs-a'
    ));

    $this->site->visit('/');

  }

  public function testThumbs() {

  }

}
