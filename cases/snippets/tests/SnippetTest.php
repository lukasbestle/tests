<?php

require_once(__DIR__ . '/../bootstrap.php');

class SnippetTest extends PHPUnit_Framework_TestCase {

  protected function setUp() {

    $this->site = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site'    => root('test.site')
    ));

    $this->site->visit('/');

  }

  public function testSnippet() {

    $obj = new Obj();
    $obj->title = 'Title';

    $snippet = snippet('test', $obj, true);

    $this->assertEquals('Title', $snippet);

    $snippet = snippet('test', array('item' => $obj), true);

    $this->assertEquals('Title', $snippet);

  }

}
