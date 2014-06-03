<?php

require_once(__DIR__ . '/../bootstrap.php');

class PluginTest extends PHPUnit_Framework_TestCase {

  protected function setUp() {

    $this->site = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site'    => root('test.site')
    ));

  }

  public function testPluginA() {
    $this->assertEquals('A',pluginA());
  }

  public function testPluginB() {
    $this->assertEquals('B',pluginB());
  }

}
