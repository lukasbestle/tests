<?php

require_once(__DIR__ . '/../bootstrap.php');

class SetupTest extends PHPUnit_Framework_TestCase {

  public function testDefaultSetup() {

    $site = kirby::setup(array(
      'root'         => root('test'),
      'root.content' => root('test.content'),
      'root.site'    => root('test.site')
    ));

    $this->assertEquals('/', $site->url());

    $this->assertEquals('home', $site->options['home']);
    $this->assertEquals('error', $site->options['error']);

    $this->assertEquals('txt', $site->options['content.file.extension']);
    $this->assertEquals(array(), $site->options['content.file.ignore']);
    $this->assertEquals('/content', $site->options['content.url']);

    $this->assertEquals(false, $site->options['cache']);
    $this->assertEquals(array(), $site->options['headers']);
    $this->assertEquals('UTC', $site->options['timezone']);
    $this->assertEquals(null, $site->options['license']);

    // tinyurl stuff
    $this->assertEquals('x', $site->options['tinyurl.folder']);
    $this->assertEquals(true, $site->options['tinyurl.enabled']);

    // roots
    $root = root('test');

    $this->assertEquals($root, $site->options['root']);
    $this->assertEquals($root . DS . 'content', $site->options['root.content']);
    $this->assertEquals($root . DS . 'site', $site->options['root.site']);
    $this->assertEquals($root . DS . 'site' . DS . 'cache', $site->options['root.cache']);
    $this->assertEquals($root . DS . 'site' . DS . 'config', $site->options['root.config']);
    $this->assertEquals($root . DS . 'site' . DS . 'controllers', $site->options['root.controllers']);
    $this->assertEquals($root . DS . 'site' . DS . 'tags', $site->options['root.tags']);
    $this->assertEquals($root . DS . 'site' . DS . 'plugins', $site->options['root.plugins']);
    $this->assertEquals($root . DS . 'site' . DS . 'accounts', $site->options['root.accounts']);
    $this->assertEquals($root . DS . 'site' . DS . 'snippets', $site->options['root.snippets']);
    $this->assertEquals($root . DS . 'site' . DS . 'templates', $site->options['root.templates']);

    $this->assertEquals('/assets/css/templates', $site->options['auto.css.url']);
    $this->assertEquals('/assets/js/templates', $site->options['auto.js.url']);
    $this->assertEquals($root . DS . 'assets' . DS . 'css' . DS . 'templates', $site->options['auto.css.root']);
    $this->assertEquals($root . DS . 'assets' . DS . 'js' . DS . 'templates', $site->options['auto.js.root']);

  }

  public function testCustomSetup() {

    $site = kirby::setup(array(
      'root.content'           => root('test.content'),
      'root.site'              => root('test.site'),
      'url'                    => 'http://getkirby.com',
      'auto.css.url'           => 'http://assets.getkirby.com/css/custom',
      'auto.css.root'          => '/assets/css/custom',
      'auto.js.url'            => 'http://assets.getkirby.com/js/custom',
      'auto.js.root'           => '/assets/js/custom',
      'content.file.extension' => 'md',
      'content.url'            => '/custom-content',
      'license'                => 'abcd'
    ));

    $this->assertEquals('http://getkirby.com', $site->options['url']);
    $this->assertEquals('http://assets.getkirby.com/css/custom', $site->options['auto.css.url']);
    $this->assertEquals('/assets/css/custom', $site->options['auto.css.root']);
    $this->assertEquals('http://assets.getkirby.com/js/custom', $site->options['auto.js.url']);
    $this->assertEquals('/assets/js/custom', $site->options['auto.js.root']);

    $this->assertEquals('md', $site->options['content.file.extension']);
    $this->assertEquals('/custom-content', $site->options['content.url']);

    $this->assertEquals('abcd', $site->options['license']);

  }

  public function testThumbSetup() {

    $site = kirby::setup(array(
      'root.content'   => root('test.content'),
      'root.site'      => root('test.site'),
      'thumb.url'      => 'http://thumbs.getkirby.com',
      'thumb.root'     => '/root/for/thumbs',
      'thumb.driver'   => 'im',
      'thumb.filename' => 'thumbnail.{extension}',
    ));

    $this->assertEquals('http://thumbs.getkirby.com', thumb::$defaults['url']);
    $this->assertEquals('/root/for/thumbs', thumb::$defaults['root']);
    $this->assertEquals('im', thumb::$defaults['driver']);
    $this->assertEquals('thumbnail.{extension}', thumb::$defaults['filename']);

  }

}