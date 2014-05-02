<?php

require_once(__DIR__ . '/../bootstrap.php');

class CrudTest extends PHPUnit_Framework_TestCase {

  protected function setUp() {

    $this->site = kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site'    => root('test.site')
    ));

    $this->site->visit('/');

  }

  protected function tearDown() {
    $this->deleteDummyPage();
  }

  protected function deleteDummyPage() {

    try {

      if($p = page('a')) {
        $p->delete(true);
      }

      if($p = page('b')) {
        $p->delete(true);
      }

    } catch(Exception $e) {}

  }

  protected function buildDummyPage() {

    $this->deleteDummyPage();

    return $this->site->children()->create('a', 'page', array(
      'title' => 'Page A',
      'text'  => 'Test'
    ));

  }

  public function testCreate() {

    $newPage = $this->buildDummyPage();

    $this->assertEquals(3, $this->site->children()->count());
    $this->assertEquals('a', $this->site->find('a')->uid());
    $this->assertEquals('a', $newPage->uid());
    $this->assertEquals('Page A', $newPage->title());
    $this->assertEquals('Test', $newPage->text());
    $this->assertEquals('default', $newPage->template());
    $this->assertEquals('page', $newPage->intendedTemplate());
    $this->assertEquals(null, $newPage->num());
    $this->assertEquals('a', $newPage->uri());
    $this->assertEquals($newPage, page('a'));

  }

  public function testDelete() {

    $newPage = $this->buildDummyPage();
    $newPage->delete();

    $this->assertEquals(2, $this->site->children()->count());
    $this->assertEquals(null, $this->site->children()->find('a'));

  }

  public function testDeleteHome() {

    $home = page('home');

    $this->setExpectedException('Exception', 'The home page cannot be deleted');
    $home->delete();

  }

  public function testDeleteError() {

    $error = page('error');

    $this->setExpectedException('Exception', 'The error page cannot be deleted');
    $error->delete();

  }

  public function testDeleteSite() {

    $this->setExpectedException('Exception', 'The site cannot be deleted');
    site()->delete();

  }

  public function testDeleteWithChildren() {

    $this->setExpectedException('Exception', 'This page has subpages');

    $main = $this->buildDummyPage();
    $main->children()->create('subpage', 'subpage', array());
    $main->delete();

  }

  public function testUpdate() {

    $newPage = $this->buildDummyPage();
    $newPage->update(array(
      'text' => 'This is an updated text'
    ));

    $this->assertEquals('This is an updated text', $newPage->text());

  }

  public function testSort() {

    $newPage = $this->buildDummyPage();
    $this->assertEquals(null, $newPage->num());

    $this->assertEquals(0, $this->site->children()->visible()->count());

    $newPage->sort(1);
    $this->assertEquals(1, $newPage->num());

    $newPage->sort(2);
    $this->assertEquals(2, $newPage->num());
    $this->assertEquals(1, $newPage->parent()->children()->visible()->count());

    $newPage->sort(0);
    $this->assertEquals(0, $newPage->num());
    $this->assertEquals(1, $newPage->parent()->children()->visible()->count());

  }

  public function testMassSort() {

    // create a temporary test page
    site()->children()->create('test', 'test', array());

    // create a temporary subpage for each character in the alphabet
    foreach(range('a','z') as $p) {
      site()->find('test')->children()->create($p, 'subtest', array());
    }

    $n = 0;

    foreach(site()->find('test')->children()->flip() as $p) {
      $n++;
      $p->sort($n);
    }

    $this->assertEquals('z', site()->find('test')->children()->first()->uid());
    $this->assertEquals('a', site()->find('test')->children()->last()->uid());

    site()->find('test')->delete(true);

  }

  public function testHide() {

    // make sure the page is gone first
    $this->tearDown();

    $newPage = $this->buildDummyPage();
    $this->assertEquals(null, $newPage->num());

    $newPage->sort(1);
    $this->assertEquals(1, $newPage->num());

    $newPage->hide();
    $this->assertEquals(0, $newPage->parent()->children()->visible()->count());

  }

  public function testMove() {

    // make sure the page is gone first
    $this->tearDown();

    $newPage = $this->buildDummyPage();
    $this->assertEquals('a', $newPage->uid());

    $newPage->move('b');
    $this->assertEquals('b', $newPage->uid());

    $this->assertEquals($newPage->uid(), page('b')->uid());

    $newPage->delete();

  }

}
