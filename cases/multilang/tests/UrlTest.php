<?php

require_once(__DIR__ . '/../bootstrap.php');

class UrlTest extends PHPUnit_Framework_TestCase {

  public function _testDefaultURLs() {

    $site = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site' => root('test.content'),
      'url' => 'http://getkirby.com',
      'languages' => array(
        'de' => array(
          'name'    => 'Deutsch',
          'code'    => 'de',
          'locale'  => 'de_DE',
          'default' => true
        ),
        'en' => array(
          'name'    => 'English',
          'code'    => 'en',
          'locale'  => 'en_US'
        )
      )
    ));

    $this->assertEquals('http://getkirby.com', $site->url());
    $this->assertEquals('http://getkirby.com/de', $site->url('de'));
    $this->assertEquals('http://getkirby.com/en', $site->url('en'));

    $this->assertEquals('http://getkirby.com/de', $site->languages()->find('de')->url());
    $this->assertEquals('http://getkirby.com/en', $site->languages()->find('en')->url());

    $this->assertEquals('http://getkirby.com/de', $site->languages()->findDefault()->url());

  }

  public function _testRelativeURLs() {

    $site = kirby::setup(array(
      'url' => '/',
      'languages' => array(
        'de' => array(
          'name'    => 'Deutsch',
          'code'    => 'de',
          'locale'  => 'de_DE',
          'default' => true
        ),
        'en' => array(
          'name'    => 'English',
          'code'    => 'en',
          'locale'  => 'en_US'
        )
      )
    ));

    $this->assertEquals('/', $site->url());
    $this->assertEquals('/de', $site->url('de'));
    $this->assertEquals('/en', $site->url('en'));

    $this->assertEquals('/de', $site->languages()->find('de')->url());
    $this->assertEquals('/en', $site->languages()->find('en')->url());

    $this->assertEquals('/de', $site->languages()->findDefault()->url());

  }

  public function testCustomURLs() {

    $site = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site' => root('test.content'),
      'url' => 'http://getkirby.com',
      'languages' => array(
        'de' => array(
          'name'    => 'Deutsch',
          'code'    => 'de',
          'locale'  => 'de_DE',
          'default' => true,
          'url'     => '/'
        ),
        'en' => array(
          'name'    => 'English',
          'code'    => 'en',
          'locale'  => 'en_US',
          'url'     => '/en'
        )
      )
    ));

    $this->assertEquals('http://getkirby.com', $site->url());
    $this->assertEquals('http://getkirby.com', $site->url('de'));
    $this->assertEquals('http://getkirby.com/en', $site->url('en'));

    $this->assertEquals('http://getkirby.com', $site->languages()->find('de')->url());
    $this->assertEquals('http://getkirby.com/en', $site->languages()->find('en')->url());

    $this->assertEquals('http://getkirby.com', $site->languages()->findDefault()->url());

    // set the current language
    $site->language = $site->languages->de;

    $this->assertEquals('http://getkirby.com/projects', $site->find('projects')->url());
    $this->assertEquals('http://getkirby.com/projects/project-a', $site->find('projects/project-a')->url());

    // set the current language
    $site->language = $site->languages->en;

    $this->assertEquals('http://getkirby.com/en/projects', $site->find('projects')->url());
    $this->assertEquals('http://getkirby.com/en/projects/project-a', $site->find('projects/project-a')->url());

  }

}