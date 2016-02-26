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

        function test_save() {
            //Arrange;
            $stylist_name = 'Danielle';
            $stylist_location = '111 SW St';
            $test_stylist = new Stylist($stylist_name, $stylist_location);
            $test_stylist->save();

            $client_name = 'John';
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);

            //Act;
            $test_client->save();
            $result = Client::getAll();

            //Assert;
            $this->assertEquals($test_client, $result[0]);
        }

        function test_getAll() {

            //Arrange;
            $stylist_name = 'Danielle';
            $stylist_location = '111 SW St';
            $test_stylist = new Stylist($stylist_name, $stylist_location);
            $test_stylist->save();

            $client_name = 'John';
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            $client_name2 = 'Bill';
            $stylist_id2 = $test_stylist->getId();
            $test_client2 = new Client($client_name2, $stylist_id2);
            $test_client2->save();

            //Act;
            $result = Client::getAll();

            //Assert;
            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function test_find() {
            $stylist_name = 'Danielle';
            $stylist_location = '111 SW St';
            $test_stylist = new Stylist($stylist_name, $stylist_location);
            $test_stylist->save();

            $client_name = 'John';
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            $client_name2 = 'Bill';
            $test_client2 = new Client($client_name2, $stylist_id);
            $test_client2->save();

            //Act;
            $search_id = $test_client2->getId();
            $result = Client::find($search_id);

            //Assert;
            $this->assertEquals($test_client2, $result);
        }

        function test_delete() {
            //Arrange;
            $stylist_name = 'Danielle';
            $stylist_location = '111 SW St';
            $test_stylist = new Stylist($stylist_name, $stylist_location);
            $test_stylist->save();

            $client_name = 'John';
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            $client_name2 = 'Bill';
            $test_client2 = new Client($client_name2, $stylist_id);
            $test_client2->save();

            //Act;
            $test_client->delete();
            $result = Client::getAll();

            //Assert;
            $this->assertEquals([$test_client2], $result);
        }

        function test_update() {
            //Arrange;
            $stylist_name = 'Danille';
            $stylist_location = '111 SW St';
            $test_stylist = new Stylist($stylist_name, $stylist_location);
            $test_stylist->save();

            $stylist_name2 = 'Jasmine';
            $stylist_location = '111 Hello St';
            $test_stylist2 = new Stylist($stylist_name2, $stylist_location);
            $test_stylist2->save();

            $client_name = 'John';
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            $updated_client_name = 'Bill';
            $updated_stylist_id = $test_stylist2->getId();
            $updated_client = new Client($updated_client_name, $updated_stylist_id);

            //Act;
            $test_client->update($updated_client_name, $updated_stylist_id);
            $result = Client::getAll();

            //Assert;
            $this->assertEquals([$updated_client_name, $updated_stylist_id], [$updated_client->getName(), $updated_client->getStylistId()]);
        }

        function test_searchByName() {
            //Arrange;
            $stylist_name = 'Danielle';
            $stylist_location = '111 SW St';
            $test_stylist = new Stylist($stylist_name, $stylist_location);
            $test_stylist->save();

            $client_name = 'John';
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            $client_name2 = 'Bill';
            $test_client2 = new Client($client_name2, $stylist_id);
            $test_client2->save();

            //Act;
            $search_name = 'John';
            $result = Client::search($search_name);

            //Assert;
            $this->assertEquals($client_name, $result);
        }

    }


 ?>
