<?php

require_once(__DIR__ . '/../bootstrap.php');

class CacheCase extends PHPUnit_Framework_TestCase {

  protected function _setUp($driver, $options = array()) {

    $this->site = kirby::setup(array(
      'root.content'  => root('test.content'),
      'root.site'     => root('test.site'),
      'cache'         => true,
      'cache.driver'  => $driver,
      'cache.options' => $options
    ));

  }

  public function testHome() {

    $p = $this->site->visit('/');

    $result = kirby::render($p);

    $this->assertEquals('Home', $result);
    $this->assertEquals('Home', cache::get('home'));

    cache::flush();

    $this->assertEquals(null, cache::get('home'));

  }

  public function testProjects() {

    $p = $this->site->visit('projects');

    $result = kirby::render($p);

    $this->assertEquals('Projects', $result);
    $this->assertEquals('Projects', cache::get('projects'));

    cache::flush();

    $this->assertEquals(null, cache::get('projects'));

  }

  public function testSubproject() {

    $p = $this->site->visit('projects/project-a');

    $result = kirby::render($p);

    $this->assertEquals('Project A', $result);
    $this->assertEquals('Project A', cache::get('projects/project-a'));

    cache::flush();

    $this->assertEquals(null, cache::get('projects/project-a'));

  }

}