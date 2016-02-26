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
    }


 ?>
