<?php

require_once(__DIR__ . '/../bootstrap.php');

class UsersTest extends PHPUnit_Framework_TestCase {

  protected function setUp() {

    kirby::setup(array(
      'root.content' => root('test.content'),
      'root.site'    => root('test.site')
    ));

  }

  protected function deleteDummyUser() {
    if($user = site()->users()->peter()) {
      $user->delete();
    }
  }

  protected function tearDown() {
    $this->deleteDummyUser();
  }

  protected function createDummyUser() {

    $this->deleteDummyUser();

    return site()->users()->create(array(
      'username' => 'peter',
      'email'    => 'peter@jackson.com',
      'password' => 'Iamahobbit'
    ));
  }

  public function testCreate() {

    $user = $this->createDummyUser();

    $this->assertEquals('peter', $user->username());
    $this->assertEquals('peter@jackson.com', $user->email());
    $this->assertFalse('Iamahobbit' === $user->password());

    $this->assertEquals(2, site()->users()->count());

  }

  public function testFind() {

    $user = site()->users()->find('bastian');
    $this->assertEquals('bastian', $user->username());

    $user = site()->users()->bastian();
    $this->assertEquals('bastian', $user->username());

  }

  public function testUpdate() {

    $user = $this->createDummyUser();

    // updating existing data
    $user->update(array(
      'email' => 'peter.jackson@aol.com'
    ));

    $this->assertEquals('peter.jackson@aol.com', $user->email());

    // adding data
    $user->update(array(
      'fname' => 'Peter',
      'lname' => 'Jackson'
    ));

    $this->assertEquals('Peter', $user->fname());
    $this->assertEquals('Jackson', $user->lname());

    // unsetting data
    $user->update(array(
      'fname' => null,
      'lname' => null
    ));

    $this->assertEquals(null, $user->fname());
    $this->assertEquals(null, $user->lname());

    // trying to overwrite the username, which is not possible

    $user->update(array(
      'username' => 'paul',
    ));

    $this->assertEquals('peter', $user->username());

  }

  public function testDelete() {

    $user = $this->createDummyUser();
    $site = site();

    $this->assertEquals(2, $site->users()->count());

    $user->delete();

    $this->assertEquals(1, $site->users()->count());

  }

}