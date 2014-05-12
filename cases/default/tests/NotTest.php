<?php

require_once(__DIR__ . '/../bootstrap.php');

class NotTest extends PHPUnit_Framework_TestCase {

  protected function setUp() {

    $this->site = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site'    => root('test.site')
    ));

    $this->site->visit('/');
    $this->projects = $this->site->find('projects')->children();

  }

  public function testNotWithObject() {

    $page  = $this->projects->find('project-b');
    $pages = $this->projects->not($page);

    $this->assertEquals(2, $pages->count());
    $this->assertEquals('project-c', $pages->nth(1)->uid());

  }

  public function testNotWithURI() {

    $pages = $this->projects->not('projects/project-b');

    $this->assertEquals(2, $pages->count());
    $this->assertEquals('project-c', $pages->nth(1)->uid());

  }

  public function testNotWithUID() {

    $pages = $this->projects->not('project-b');

    $this->assertEquals(2, $pages->count());
    $this->assertEquals('project-c', $pages->nth(1)->uid());

  }

}