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

        //getters;
        public function getName() {
            return $this->name;
        }


    }


 ?>