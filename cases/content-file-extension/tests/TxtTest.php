<?php

require_once(__DIR__ . '/../bootstrap.php');

class TxtTest extends PHPUnit_Framework_TestCase {

  protected function setUp() {

    $this->site = kirby::setup(array(
      'root.content'           => root('test.content.txt'),
      'root.site'              => root('test.site'),
      'content.file.extension' => 'txt'
    ));

  }

  public function testHome() {
    $this->assertEquals('Home', $this->site->page('home')->title());
  }

  public function testError() {
    $this->assertEquals('Error', $this->site->page('error')->title());
  }

  public function testSite() {
    $this->assertEquals('Kirby', $this->site->title());
  }

}