<?php

require_once(__DIR__ . '/../bootstrap.php');

class UrlTest extends PHPUnit_Framework_TestCase {

  public function testDefaultUrls() {

    $site = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site'    => root('test.site'),
      'url'          => 'http://getkirby.com'
    ));

    $this->assertEquals('http://getkirby.com', $site->url());

    $this->assertEquals('http://getkirby.com/projects', $site->find('projects')->url());
    $this->assertEquals('http://getkirby.com/projects/project-a', $site->find('projects/project-a')->url());
    $this->assertEquals('http://getkirby.com/x/poq46c', $site->find('projects')->tinyurl());

    // disable tinyurls
    $site->options['tinyurl.enabled'] = false;

    $this->assertEquals('http://getkirby.com/projects', $site->find('projects')->tinyurl());

  }

  public function testRelativeUrls() {

    $site = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site'    => root('test.site'),
      'url'          => '/'
    ));

    $this->assertEquals('/', $site->url());

    $this->assertEquals('/projects', $site->find('projects')->url());
    $this->assertEquals('/projects/project-a', $site->find('projects/project-a')->url());
    $this->assertEquals('/x/poq46c', $site->find('projects')->tinyurl());

    // disable tinyurls
    $site->options['tinyurl.enabled'] = false;

    $this->assertEquals('/projects', $site->find('projects')->tinyurl());
    $this->assertEquals('/content', $site->options['content.url']);
    $this->assertEquals('/thumbs', thumb::$defaults['url']);

  }

  public function testTwoSites() {

    // when the site object is initiated twice, the urls for subpages should still be correct

    $a = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site'    => root('test.site'),
      'url'          => 'http://google.com'
    ));

    $this->assertEquals('http://google.com', $a->url());
    $this->assertEquals('http://google.com/projects/project-a', $a->find('projects/project-a')->url());

    $b = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site'    => root('test.site'),
      'url'          => 'http://apple.com'
    ));

    $this->assertEquals('http://apple.com', $b->url());
    $this->assertEquals('http://apple.com/projects/project-a', $b->find('projects/project-a')->url());

    $c = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site'    => root('test.site'),
      'url'          => '/'
    ));

    $this->assertEquals('/', $c->url());
    $this->assertEquals('/projects/project-a', $c->find('projects/project-a')->url());

  }

}