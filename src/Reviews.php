<?php
    class Review
    {
        private $description;
        private $rating;
        private $restaurant_id;
        private $id;

        function __construct($description, $rating, $restaurant_id, $id = null)
        {
            $this->description = $description;
            $this->rating = $rating;
            $this->restaurant_id = $restaurant_id;
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

        // function setRestaurantId($restaurant_id)
        // {
        //     $this->restaurant_id = $restaurant_id;
        // }

        function getDescription()
        {
            return $this->description;
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

        // function save()
        // {
        //     $GLOBALS['DB']->exec("INSERT INTO reviews (description, rating, restaurant_id) VALUES ( '{$this->getDescription()}', '{$this->getRating()}', {$this->getRestaurantId()});");
        //     $this->id = $GLOBALS['DB']->lastInsertId();
        // }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO reviews (description, rating, restaurant_id) VALUES ('{$this->getDescription()}', '{$this->getRating()}', {$this->getRestaurantId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }


        static function getAll()
        {
            $returned_reviews = $GLOBALS['DB']->query("SELECT * FROM reviews;");
            $reviews = [];
            foreach ($returned_reviews as $review){
                $description = $review['description'];
                $rating = $review['rating'];
                $restaurant_id = $review['restaurant_id'];
                $id = $review['id'];
                $new_review = new Review($description, $rating, $restaurant_id, $id);
                array_push($reviews, $new_review);
            }
            return $reviews;
        }

        static function delete($restaurant_id)
        {
            $GLOBALS['DB']->exec("DELETE FROM reviews WHERE restaurant_id = {$restaurant_id};");
        }

        function deleteOneReview()
        {
            $GLOBALS['DB']->exec("DELETE FROM reviews WHERE id = {$this->getId()};");
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM reviews;");
        }

        static function find($search_id)
        {
            $found_review = null;
            $reviews = Review::getAll();
            foreach($reviews as $review) {
                $review_id = $review->getId();
                if ($review_id == $search_id) {
                    $found_review = $review;
                }
            }
            return $found_review;
        }
    }



 ?>
