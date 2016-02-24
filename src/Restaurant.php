<?php
    class Restaurant
    {
        private $name;
        private $phone;
        private $price_range;
        private $id;
        private $cuisine_id;

        function __construct($name, $phone, $price_range, $id = null, $cuisine_id)
        {
            $this->name = $name;
            $this->phone = $phone;
            $this->price_range = $price_range;
            $this->id = $id;
            $this->cuisine_id = $cuisine_id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setPhone($new_phone)
        {
            $this->phone = $new_phone;
        }

        function getPhone()
        {
            return $this->phone;
        }

        function setPriceRange($new_price_range)
        {
            $this->price_range = $new_price_range;
        }

        function getPriceRange()
        {
            return $this->price_range;
        }

        function getId()
        {
            return $this->id;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO restaurants (name, phone, price_range, cuisine_id) VALUES ('{$this->getName()}', '{$this->getPhone()}', {$this->getPriceRange()}, {$this->getCuisineId()})");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }
        //
        // static function getAll()
        // {
        //     $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
        //     $restaurants = array();
        //     foreach($returned_restaurants as $restaurant) {
        //         $name = $restaurant['name'];
        //         $phone = $restaurant['phone'];
        //         $id = $restaurant['id'];
        //         $cuisine_id = $restaurant['cuisine_id'];
        //         $new_restaurant = new Restaurant($name, $phone, $id, $cuisine_id);
        //         array_push($restaurants, $new_restaurant);
        //     }
        //     return $restaurants;
        // }
        //
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants;");
        }

        // static function deleteFromCuisine($cuisine_id)
        // {
        //     $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE cuisine_id = {$cuisine_id};");
        // }
        //
        // static function find($search_id)
        // {
        //     $found_restaurant = null;
        //     $restaurants = Restaurant::getAll();
        //     foreach($restaurants as $restaurant) {
        //         $restaurant_id = $restaurant->getId();
        //         if ($restaurant_id == $search_id) {
        //           $found_restaurant = $restaurant;
        //         }
        //     }
        //     return $found_restaurant;
        // }

    }
?>
