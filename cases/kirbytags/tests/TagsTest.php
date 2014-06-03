<?php

require_once(__DIR__ . '/../bootstrap.php');

class TagsTest extends PHPUnit_Framework_TestCase {

  protected function setUp() {

    $this->site = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site'    => root('test.site'),
      'url'          => 'http://getkirby.com'
    ));

    $this->site->visit('/');

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

    // go to the project page which contains the image
    $this->site->visit('projects/project-a');

    // create the image tag
    $image = kirbytag(array(
      'image' => 'project-a.jpg'
    ));

    $this->assertEquals('<img src="http://getkirby.com/content/02-projects/01-project-a/project-a.jpg" alt="project-a" />', (string)$image);

    // with alt text
    $image = kirbytag(array(
      'image' => 'project-a.jpg',
      'alt'   => 'Project A'
    ));

    $this->assertEquals('<img src="http://getkirby.com/content/02-projects/01-project-a/project-a.jpg" alt="Project A" />', (string)$image);

    // with link
    $image = kirbytag(array(
      'image' => 'project-a.jpg',
      'alt'   => 'Project A',
      'link'  => 'http://google.com'
    ));

    $this->assertEquals('<a href="http://google.com"><img src="http://getkirby.com/content/02-projects/01-project-a/project-a.jpg" alt="Project A" /></a>', (string)$image);

    // with self referential link
    $image = kirbytag(array(
      'image' => 'project-a.jpg',
      'alt'   => 'Project A',
      'link'  => 'project-a.jpg'
    ));

    $this->assertEquals('<a href="http://getkirby.com/content/02-projects/01-project-a/project-a.jpg"><img src="http://getkirby.com/content/02-projects/01-project-a/project-a.jpg" alt="Project A" /></a>', (string)$image);

    // with self referential link version two
    $image = kirbytag(array(
      'image' => 'project-a.jpg',
      'alt'   => 'Project A',
      'link'  => 'self'
    ));

    $this->assertEquals('<a href="http://getkirby.com/content/02-projects/01-project-a/project-a.jpg"><img src="http://getkirby.com/content/02-projects/01-project-a/project-a.jpg" alt="Project A" /></a>', (string)$image);

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