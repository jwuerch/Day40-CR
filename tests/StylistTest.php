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

        function test_deleteAll() {
            //Arrange;
            $name = 'Danielle';
            $location = '111 SW St';
            $test_stylist = new Stylist($name, $location);

            //Act;
            $result = Stylist::deleteAll();

            //Assert;
            $this->assertEquals([], $result);
        }
    }


 ?>
