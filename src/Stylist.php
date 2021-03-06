<?php

    class Stylist {
        private $name;
        private $location;
        private $id;

        public function __construct($name, $location, $id = null) {
            $this->name = $name;
            $this->location = $location;
            $this->id = $id;
        }

        //setters;
        public function setName($new_name) {
            $this->name = $new_name;
        }

        public function setLocation($new_location) {
            $this->location = $new_location;
        }

        //getters;
        public function getName() {
            return $this->name;
        }

        public function getLocation() {
            return $this->location;
        }

        public function getId() {
            return $this->id;
        }

        static function deleteAll() {
            $GLOBALS['DB']->exec("DELETE FROM stylists;");
        }

        public function save() {
            $GLOBALS['DB']->exec("INSERT INTO stylists (name, location) VALUES ('{$this->name}', '{$this->location}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll() {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists");
            $stylists = array();
            foreach ($returned_stylists as $stylist) {
                $name = $stylist['name'];
                $location = $stylist['location'];
                $id = $stylist['id'];
                $new_stylist = new Stylist($name, $location, $id);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }

        static function find($search_id) {
            $found_stylist = null;
            $stylists = Stylist::getAll();
            foreach ($stylists as $stylist) {
                $stylist_id = $stylist->getId();
                if ($stylist_id == $search_id) {
                    $found_stylist = $stylist;
                }
            }
            return $found_stylist;
        }

        public function delete() {
            $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
        }

        public function update($new_name, $new_location) {
            $GLOBALS['DB']->exec("UPDATE stylists SET name = {$new_name} WHERE id = {$this->getId()};");
            $this->setName($new_name);
            $GLOBALS['DB']->exec("UPDATE stylists SET location = {$new_location} WHERE id = {$this->getId()};");
            $this->setLocation($new_location);
        }

        public function getClients() {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getId()}");
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
    }


 ?>
