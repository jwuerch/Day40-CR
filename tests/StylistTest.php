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

    class StylistTest extends PHPUnit_Framework_TestCase {

        protected function teardown() {
            Stylist::deleteAll();
            Client::deleteAll();
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

        function test_delete() {
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
            $test_stylist->delete();
            $result = Stylist::getAll();

            //Assert;
            $this->assertEquals([$test_stylist2], $result);
        }

        function test_update() {
            //Arrange;
            $name = 'Danielle';
            $location = '111 SW St';
            $test_stylist = new Stylist($name, $location);
            $test_stylist->save();

            //Act;
            $new_name = 'Hydra';
            $new_location = '111 Bye St';
            $test_stylist->update($new_name, $new_location);
            $result = [$test_stylist->getName(), $test_stylist->getLocation()];

            //Assert;
            $this->assertEquals([$new_name, $new_location], $result);
        }

        function test_getClients() {
            //Arrange;
            $name = 'Danielle';
            $location = '111 SW St';
            $test_stylist = new Stylist($name, $location);
            $test_stylist->save();

            $client_name = 'John';
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            $client_name2 = 'Bill';
            $test_client2 = new Client($client_name2, $stylist_id);
            $test_client2->save();

            $client_name3 = 'Jack';
            $stylist_id2 = 3;
            $test_client3 = new Client($client_name3, $stylist_id2);
            $test_client3->save();

            //Act;
            $result = $test_stylist->getClients();

            //Assert;
            $this->assertEquals([$test_client, $test_client2], $result);
        }

    }


 ?>
