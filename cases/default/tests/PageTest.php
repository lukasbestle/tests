<?php

require_once(__DIR__ . '/../bootstrap.php');

class PageTest extends PHPUnit_Framework_TestCase {

  protected function setUp() {

    $this->site = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site'    => root('test.site')
    ));

    $this->site->visit('projects');
    $this->page = $this->site->page();

  }

  public function testChildren() {

    $this->assertInstanceOf('Children', $this->page->children());
    $this->assertEquals(3, $this->page->children()->count());
    $this->assertEquals(3, $this->site->children()->visible()->count());
    $this->assertEquals(2, $this->site->children()->invisible()->count());

  }

  public function testParent() {
    $this->assertEquals(null, $this->page->parent()->uid());
    $this->assertEquals($this->page, $this->page->children()->first()->parent());
  }

  public function testHomePage() {

    // default setup with home
    $site = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site'    => root('test.site')
    ));

    $page = $site->find('projects');
    $this->assertFalse($page->isHomePage());

    $page = $site->find('home');
    $this->assertTrue($page->isHomePage());

    // modified home page
    $site = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site'    => root('test.site'),
      'home'         => 'projects'
    ));

    $page = $site->find('projects');
    $this->assertTrue($page->isHomePage());

    $page = $site->find('home');
    $this->assertFalse($page->isHomePage());

  }

  public function testErrorPage() {

    // default setup with home
    $site = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site'    => root('test.site')
    ));

    $page = $site->find('projects');
    $this->assertFalse($page->isErrorPage());

    $page = $site->find('error');
    $this->assertTrue($page->isErrorPage());

    // default setup with home
    $site = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site'    => root('test.site'),
      'error'        => 'projects'
    ));

    $page = $site->find('projects');
    $this->assertTrue($page->isErrorPage());

    $page = $site->find('error');
    $this->assertFalse($page->isErrorPage());

  }

}