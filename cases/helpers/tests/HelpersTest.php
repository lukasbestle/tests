<?php

require_once(__DIR__ . '/../bootstrap.php');

class HelpersTest extends PHPUnit_Framework_TestCase {

  protected function setUp() {

    $site = kirby::setup(array(
      'url'          => 'http://getkirby.com',
      'root.content' => root('test.content'),
      'root.site'    => root('test.site')
    ));

    $site->visit('/');

  }

  public function testSnippet() {

    $snippet = snippet('test', array('variable' => 'foo'), $return = true);

    $this->assertEquals('test with a variable: foo', $snippet);

  }

  public function testCss() {

    // relative urls
    $css = css('assets/css/site.css');
    $this->assertEquals('<link rel="stylesheet" href="http://getkirby.com/assets/css/site.css" />', $css);

    // absolute urls
    $css = css('http://cdn.getkirby.com/css/site.css');
    $this->assertEquals('<link rel="stylesheet" href="http://cdn.getkirby.com/css/site.css" />', $css);

    // TODO: media

  }

  public function testJs() {

    // relative urls
    $js = js('assets/js/site.js');
    $this->assertEquals('<script src="http://getkirby.com/assets/js/site.js"></script>', $js);

    // absolute urls
    $js = js('http://cdn.getkirby.com/js/site.js');
    $this->assertEquals('<script src="http://cdn.getkirby.com/js/site.js"></script>', $js);

    // TODO: async

  }

  public function testKirbytext() {
    // TODO
  }

  public function testSite() {
    // TODO
  }

  public function testPage() {
    // TODO
  }

  public function testExcerpt() {
    // TODO
  }

  public function testTextfile() {
    // TODO
  }

  public function testKirbytag() {
    // TODO
  }

  public function testYoutube() {
    // TODO
  }

  public function testVimeo() {
    // TODO
  }

  public function testTwitter() {
    // TODO
  }

  public function testGist() {
    // TODO
  }

}