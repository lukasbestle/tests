<?php

require_once(__DIR__ . '/../bootstrap.php');

class SlugTest extends PHPUnit_Framework_TestCase {

  protected function setUp() {

    $this->site = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site' => root('test.content'),
      'url' => 'http://getkirby.com',
      'languages' => array(
        'en' => array(
          'name'    => 'English',
          'code'    => 'en',
          'locale'  => 'en_US',
          'default' => true
        ),
        'de' => array(
          'name'    => 'Deutsch',
          'code'    => 'de',
          'locale'  => 'de_DE'
        ),
      )
    ));

  }

  public function testProjectsDe() {

    $this->site->visit('/', 'de');

    $p = $this->site->find('projects');

    $this->assertEquals('projects', $p->uid());
    $this->assertEquals('projects', $p->id());
    $this->assertEquals('projekte', $p->slug());
    $this->assertEquals('projekte', $p->uri());

  }

  public function testProjectDe() {

    $this->site->visit('/', 'de');

    $p = $this->site->find('projects/project-a');

    $this->assertEquals('project-a', $p->uid());
    $this->assertEquals('projects/project-a', $p->id());
    $this->assertEquals('projekt-a', $p->slug());
    $this->assertEquals('projekte/projekt-a', $p->uri());

  }

  public function testProjectsEn() {

    $this->site->visit('/', 'en');

    $p = $this->site->find('projects');

    $this->assertEquals('projects', $p->uid());
    $this->assertEquals('projects', $p->id());
    $this->assertEquals('projects', $p->slug());
    $this->assertEquals('projects', $p->uri());

  }

  public function testProjectEn() {

    $this->site->visit('/', 'en');

    $p = $this->site->find('projects/project-a');

    $this->assertEquals('project-a', $p->uid());
    $this->assertEquals('projects/project-a', $p->id());
    $this->assertEquals('project-a', $p->slug());
    $this->assertEquals('projects/project-a', $p->uri());

  }

}