<?php

    class Client {
        private $name;
        private $stylist_id;
        private $id;

        public function __construct($name, $stylist_id, $id = null) {
            $this->name = $name;
            $this->stylist_id = $stylist_id;
            $this->id = $id;
        }

        //setters;
        public function setName($new_name) {
            $this->name = $new_name;
        }
        public function setStylistId($new_id) {
          $this->stylist_id = $new_id;
        }

        //getters;
        public function getName() {
            return $this->name;
        }

        public function getStylistId() {
            return $this->stylist_id;
        }

        public function getId() {
            return $this->id;
        }

        static function deleteAll() {
            $GLOBALS['DB']->exec("DELETE FROM clients;");

        }

        static function getAll() {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
            $clients = array();
            foreach ($returned_clients as $client) {
                $name = $client['name'];
                $stylist_id = $client['stylist_id'];
                $id = $client['id'];
                $new_client = new Client($name, $stylist_id, $id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        function save() {
            $GLOBALS['DB']->exec("INSERT INTO clients (name, stylist_id) VALUES ('{$this->getName()}', {$this->getStylistId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function find($search_id) {
            $clients = Client::getAll();
            $found_client = null;
            foreach ($clients as $client) {
                $client_id = $client->getId();
                if ($search_id == $client_id) {
                    $found_client = $client;
                }
            }
            return $found_client;
        }

        public function delete() {
            $GLOBALS['DB']->exec("DELETE FROM clients WHERE id = {$this->getId()};");
        }

        public function update($new_name, $new_stylist_id) {
            $GLOBALS['DB']->exec("UPDATE clients SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
            $GLOBALS['DB']->exec("UPDATE clients SET stylist_id = {$new_stylist_id} WHERE id = {$this->getId()};");
            $this->setStylistId($new_stylist_id);

        }

        static function search($search_name) {
            $clients = Client::getAll();
            $found_clients = array();
            foreach ($clients as $client) {
                $client_name = $client->getName();
                similar_text($search_name, $client_name, $percentage);
                if ($percentage > 25) {
                    array_push($found_clients, $client);
                }
            }
            return $found_clients;
        }

        public function getStylistName() {
            $stylist = Stylist::find($this->getStylistId());
            $stylist_name = $stylist->getName();
            return $stylist_name;
        }

    }


 ?>
