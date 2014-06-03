<?php

require_once(__DIR__ . '/../bootstrap.php');

class PrevNextTest extends PHPUnit_Framework_TestCase {

  protected function setUp() {

    $this->site = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site'    => root('test.site')
    ));

    $this->site->visit('/');
    $this->projects = $this->site->find('projects')->children();

  }

  public function testNext() {

    $project = $this->projects->first();

    $this->assertEquals('project-a', $project->uid());

    $project = $project->next();

    $this->assertEquals('project-b', $project->uid());

    $project = $project->next();

    $this->assertEquals('project-c', $project->uid());

    $project = $project->next();

    $this->assertEquals(null, $project);

  }

  public function testPrev() {

    $project = $this->projects->last();

    $this->assertEquals('project-c', $project->uid());

    $project = $project->prev();

    $this->assertEquals('project-b', $project->uid());

    $project = $project->prev();

    $this->assertEquals('project-a', $project->uid());

    $project = $project->prev();

    $this->assertEquals(null, $project);

  }

  public function testHas() {

    // the first visible page
    $page = $this->site->children()->first();

    $this->assertFalse($page->hasPrev());
    $this->assertFalse($page->hasPrevVisible());
    $this->assertFalse($page->hasPrevInvisible());
    $this->assertTrue($page->hasNextInvisible());
    $this->assertTrue($page->hasNext());
    $this->assertTrue($page->hasNextVisible());

    // the last visible page
    $page = $this->site->children()->find('contact');
    $this->assertTrue($page->hasPrev());
    $this->assertTrue($page->hasPrevVisible());
    $this->assertTrue($page->hasNext());
    $this->assertTrue($page->hasNextInvisible());
    $this->assertFalse($page->hasPrevInvisible());
    $this->assertFalse($page->hasNextVisible());

    // the first invisible page
    $page = $this->site->children()->find('error');
    $this->assertTrue($page->hasPrev());
    $this->assertTrue($page->hasPrevVisible());
    $this->assertTrue($page->hasNext());
    $this->assertTrue($page->hasNextInvisible());
    $this->assertFalse($page->hasPrevInvisible());
    $this->assertFalse($page->hasNextVisible());

  }

}
