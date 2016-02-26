<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";
    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase {

        protected function teardown() {
            Stylist::deleteAll();
        }

        function test_getName() {
            //Arrange;
            $name = 'Danielle';
            $location = '111 SW St';
            $test_stylist = new Stylist($name, $location);

            //Act;
            $result = $test_stylist->getName();

            //Assert;
            $this->assertEquals($name, $result);
        }

        function test_getLocation() {
            //Arrange;
            $name = 'Danielle';
            $location = '111 SW St';
            $test_stylist = new Stylist($name, $location);

            //Act;
            $result = $test_stylist->getLocation();

            //Assert;
            $this->assertEquals($location, $result);
        }

        function test_getId() {
            //Arrange;
            $name = 'Danielle';
            $location = '111 SW St';
            $id = 1;
            $test_stylist = new Stylist($name, $location, $id);

            //Act;
            $result = $test_stylist->getId();

            //Assert;
            $this->assertEquals($id, $result);
        }

        function test_getAll() {
            //Arrange;
            $name = 'Danille';
            $location = '111 SW St';
            $test_stylist = new Stylist($name, $location);
            $test_stylist->save();

            $name2 = 'Jasmine';
            $location2 = '111 Hello St';
            $test_stylist2 = new Stylist($name2, $location2);
            $test_stylist2->save();

            //Act;
            $result = Stylist::getAll();

            //Assert;
            $this->assertEquals([$test_stylist, $test_stylist2], $result);
        }

        function test_deleteAll() {
            //Arrange;
            $name = 'Danielle';
            $location = '111 SW St';
            $test_stylist = new Stylist($name, $location);
            $test_stylist->save();

            //Act;
            Stylist::deleteAll();
            $result = Stylist::getAll();

            //Assert;
            $this->assertEquals([], $result);
        }

        function test_save() {
            //Arrange;
            $name = 'Danielle';
            $location = '111 SW St';
            $test_stylist = new Stylist($name, $location);

            //Act;
            $test_stylist->save();
            $result = Stylist::getAll();

            $this->assertEquals($test_stylist, $result[0]);
        }

        function test_find() {
            //Arrange;
            $name = 'Danielle';
            $location = '111 SW St';
            $test_stylist = new Stylist($name, $location);
            $test_stylist->save();

            $name2 = 'Jasmine';
            $location2 = '111 Hello St';
            $test_stylist2 = new Stylist($name, $location);
            $test_stylist2->save();

            //Act;
            $result = Stylist::find($test_stylist->getId());

            //Assert;
            $this->assertEquals($test_stylist, $result);
        }

    }


 ?>
