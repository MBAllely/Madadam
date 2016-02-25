<?php
    class Review
    {
        private $description;
        private $rating;
        private $restaurant_id;
        private $id;

        function __construct($description, $rating, $restaurant_id, $id = null)
        {
            $this->desciption = $description;
            $this->rating = $rating;
            $restaurant_id = $restaurant_id;
            $this->id = $id;
        }

        function setDescription($new_description)
        {
            $this->description = (string) $new_description;
        }

        function setRating($rating)
        {
            $this->rating = $rating;
        }

        function getDescription()
        {
            return $this->desciption;
        }

        function getRating()
        {
            return $this->rating;
        }

        function getRestaurantId()
        {
            return $this->restaurant_id;
        }

        function getId()
        {
            return $this->id;
        }


    }



 ?>
