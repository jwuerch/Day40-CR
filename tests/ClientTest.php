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
            Client::deleteAll();
        }

        function test_getName() {
            //Arrange;
            $stylist_name = 'Danielle';
            $stylist_location ='111 SW St';
            $test_stylist = new Stylist($stylist_name, $stylist_location);
            $test_stylist->save();

            $client_name = 'John';
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);

            //Act;
            $result = $test_client->getName();

            //Assert;
            $this->assertEquals($client_name, $result);
        }

        function test_getStylistId() {
            //Arrange;
            $stylist_name = 'Danille';
            $stylist_location = '111 SW St';
            $test_stylist = new Stylist($stylist_name, $stylist_location);
            $test_stylist->save();

            $client_name = 'John';
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);

            //Act;
            $result = $test_client->getStylistId();

            //Assert;
            $this->assertEquals($stylist_id, $result);
        }

        function test_getId() {
            //Arrange;
            $stylist_name = 'Danille';
            $stylist_location = '111 SW St';
            $test_stylist = new Stylist($stylist_name, $stylist_location);
            $test_stylist->save();

            $client_name = 'John';
            $stylist_id = $test_stylist->getId();
            $id = 1;
            $test_client = new Client($client_name, $stylist_id, $id);

            //Act;
            $result = $test_client->getId();

            //Assert;
            $this->assertEquals($id, $result);
        }

        function test_deleteAll() {
            //Arrange;
            $stylist_name = 'Danielle';
            $stylist_location = '111 SW St';
            $test_stylist = new Stylist($stylist_name, $stylist_location);
            $test_stylist->save();

            $client_name = 'John';
            $stylist_id = $test_stylist->getId();
            $id = 1;
            $test_client = new Client($client_name, $stylist_id, $id);
            $test_client->save();

            //Act;
            Client::deleteAll();
            $result = Client::getAll();

            //Assert;
            $this->assertEquals([], $result);
        }

    }


 ?>
