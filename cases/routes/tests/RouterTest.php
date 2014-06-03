<?php

require_once(__DIR__ . '/../bootstrap.php');

class RouterTest extends PHPUnit_Framework_TestCase {

  protected function setUp() {

    $this->site = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site'    => root('test.site')
    ));

  }

  public function testRoutes() {

    // TODO: needs proper testing

  }

}