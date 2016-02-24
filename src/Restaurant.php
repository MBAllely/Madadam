<?php
    class Restaurant
    {
        private $description;
        private $due_date;
        private $cuisine_id;
        private $id;

        function __construct($description, $due_date, $id = null, $cuisine_id)
        {
            $this->description = $description;
            $this->due_date = $due_date;
            $this->id = $id;
            $this->cuisine_id = $cuisine_id;
        }

        // function setDescription($new_description)
        // {
        //     $this->description = (string) $new_description;
        // }
        //
        // function getDescription()
        // {
        //     return $this->description;
        // }
        //
        // function getDueDate()
        // {
        //     return $this->due_date;
        // }
        //
        // function getId()
        // {
        //     return $this->id;
        // }
        //
        // function getCuisineId()
        // {
        //     return $this->cuisine_id;
        // }
        //
        // function save()
        // {
        //     $GLOBALS['DB']->exec("INSERT INTO restaurants (description, due_date, cuisine_id) VALUES ('{$this->getDescription()}', '{$this->getDueDate()}', {$this->getCuisineId()})");
        //     $this->id = $GLOBALS['DB']->lastInsertId();
        // }
        //
        // static function getAll()
        // {
        //     $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
        //     $restaurants = array();
        //     foreach($returned_restaurants as $restaurant) {
        //         $description = $restaurant['description'];
        //         $due_date = $restaurant['due_date'];
        //         $id = $restaurant['id'];
        //         $cuisine_id = $restaurant['cuisine_id'];
        //         $new_restaurant = new Restaurant($description, $due_date, $id, $cuisine_id);
        //         array_push($restaurants, $new_restaurant);
        //     }
        //     return $restaurants;
        // }
        //
        // static function deleteAll()
        // {
        //     $GLOBALS['DB']->exec("DELETE FROM restaurants;");
        // }
        //
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
