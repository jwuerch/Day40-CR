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

        //getters;
        public function getName() {
            
        }

    }


 ?>
