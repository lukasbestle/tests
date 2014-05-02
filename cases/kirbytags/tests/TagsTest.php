<?php

require_once(__DIR__ . '/../bootstrap.php');

class TagsTest extends PHPUnit_Framework_TestCase {

  protected function setUp() {

    $site = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site'    => root('test.site')
    ));

    $site->visit('/');

  }

  public function testDate() {

    $year = kirbytag(array(
      'date' => 'Year'
    ));

    $this->assertEquals(date('Y'), $year);

    $month = kirbytag(array(
      'date' => 'm'
    ));

    $this->assertEquals(date('m'), $month);

  }

  public function testEmail() {
    // not testable because of encoded strings
  }

  public function testFile() {
    // TODO: needs a test file
  }

  public function testImage() {
    // TODO: needs a test image
  }

  public function testLink() {

    $link = kirbytag(array(
      'link' => 'http://getkirby.com'
    ));

    $this->assertEquals('<a href="http://getkirby.com">http://getkirby.com</a>', $link);

    $link = kirbytag(array(
      'link' => 'http://getkirby.com',
      'text' => 'Kirby'
    ));

    $this->assertEquals('<a href="http://getkirby.com">Kirby</a>', $link);

    $link = kirbytag(array(
      'link'  => 'http://getkirby.com',
      'text'  => 'Kirby',
      'class' => 'kirby'
    ));

    $this->assertEquals('<a href="http://getkirby.com" class="kirby">Kirby</a>', $link);

    $link = kirbytag(array(
      'link'  => 'http://getkirby.com',
      'text'  => 'Kirby',
      'class' => 'kirby',
      'title' => 'Kirby CMS'
    ));

    $this->assertEquals('<a href="http://getkirby.com" class="kirby" title="Kirby CMS">Kirby</a>', $link);

    $link = kirbytag(array(
      'link'  => 'http://getkirby.com',
      'text'  => 'Kirby',
      'class' => 'kirby',
      'title' => 'Kirby CMS',
      'rel'   => 'me'
    ));

    $this->assertEquals('<a href="http://getkirby.com" rel="me" class="kirby" title="Kirby CMS">Kirby</a>', $link);

    // TODO: target and popup tests
    // TODO: relative link tests

  }

  public function testTwitter() {

    $twitter = kirbytag(array(
      'twitter' => 'getkirby'
    ));

    $this->assertEquals('<a href="https://twitter.com/getkirby">@getkirby</a>', $twitter);

    $twitter = kirbytag(array(
      'twitter' => '@getkirby'
    ));

    $this->assertEquals('<a href="https://twitter.com/getkirby">@getkirby</a>', $twitter);

    $twitter = kirbytag(array(
      'twitter' => '@getkirby',
      'text'    => 'Follow Kirby on Twitter'
    ));

    $this->assertEquals('<a href="https://twitter.com/getkirby">Follow Kirby on Twitter</a>', $twitter);

  }

  public function testYoutube() {
    // TODO
  }

  public function testVimeo() {
    // TODO
  }

  public function testGist() {
    // TODO
  }

}