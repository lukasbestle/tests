<?php

require_once(__DIR__ . '/../bootstrap.php');

class FinderTest extends PHPUnit_Framework_TestCase {

  protected function setUp() {

    $this->site = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site'    => root('test.site')
    ));

    $this->site->visit('/');

  }

  public function testFind() {

    // level 1

    $p = $this->site->find('projects');
    $this->assertEquals('projects', $p->uid());

    // level 2

    $p = $this->site->find('projects/project-a');
    $this->assertEquals('project-a', $p->uid());

    // non-exisiting

    $p = $this->site->find('projects/project-a/subproject-a');
    $this->assertEquals(null, $p);

    // multiple uris

    $pages = $this->site->find('projects', 'projects/project-a', 'projects/project-b');

    $this->assertEquals(3, $pages->count());
    $this->assertEquals('projects', $pages->nth(0)->uid());
    $this->assertEquals('project-a', $pages->nth(1)->uid());
    $this->assertEquals('project-b', $pages->nth(2)->uid());

    // multiple uris with empty results

    $pages = $this->site->find('projects', 'projects/project-a', 'projects/project-x');

    $this->assertEquals(2, $pages->count());
    $this->assertEquals('projects', $pages->first()->uid());
    $this->assertEquals('project-a', $pages->last()->uid());

  }

  public function testFindBy() {

    // with result

    $p = $this->site->children()->findBy('title', 'Projects');
    $this->assertEquals('projects', $p->uid());

    // without result

    $p = $this->site->children()->findBy('title', 'Does not exist');
    $this->assertEquals(null, $p);

  }

}