<?php

require_once(__DIR__ . '/../bootstrap.php');

class SortingTest extends PHPUnit_Framework_TestCase {

  protected function setUp() {

    $this->site = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site'    => root('test.site')
    ));

    $this->site->visit('/');

  }

  public function testSort() {

    $pages = $this->site->find('projects')->children()->sortBy('title', 'asc');

    $this->assertEquals('Project A', $pages->nth(0)->title());
    $this->assertEquals('Project a', $pages->nth(1)->title());
    $this->assertEquals('Project B', $pages->nth(2)->title());
    $this->assertEquals('Project C', $pages->nth(3)->title());

  }

}