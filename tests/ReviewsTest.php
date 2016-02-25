<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";
    require_once "src/Reviews.php";

    $server = 'mysql:host=localhost;dbname=restaurants_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ReviewTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
            Review::deleteAll();
        }

        function test_getDesc()
        {
          //Arrange
          $description = "The food tastes like wallpaper";
          $rating = "*";
          $restaurant_id = 1;
          $test_review = new Review($description, $rating, $restaurant_id);


          //Act
          $result = $test_review->getDescription();

          //Assert
          $this->assertEquals($description, $result);
        }

        function test_getRating()
        {
            //Arrange
            $description = "Pretty good burrito";
            $rating = "**";
            $restaurant_id = 1;
            $test_review = new Review($description, $rating, $restaurant_id);

            //Act
            $result = $test_review->getRating();

            //Assert
            $this->assertEquals($rating, $result);
        }

        function test_getId()
        {
            //Arrange
            $description = "Pretty good burrito";
            $rating = "**";
            $restaurant_id = 1;
            $id = 2;
            $test_review = new Review($description, $rating, $restaurant_id, $id);

            //Act
            $result = $test_review->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));

        }

        function test_save() {
            //Arrange
            $description = "Pretty good burrito";
            $rating = "**";
            $restaurant_id = 1;
            $test_review = new Review($description, $rating, $restaurant_id);
            $test_review->save();

            //Act
            $result = Review::getAll();

            //Assert
            $this->assertEquals($test_review, $result[0]);
        }

        function test_getAll() {
            //Arrange
            $description = "Tasty sandwich";
            $rating = "***";
            $restaurant_id = 1;
            $id = null;
            $test_review = new Review($description, $rating, $restaurant_id, $id);
            $test_review->save();

            $description2 = "Big portions!";
            $rating2 = "**";
            $restaurant_id2 = 1;
            $test_review2 = new Review($description2, $rating2, $restaurant_id2);
            $test_review2->save();

            //Act
            $result = Review::getAll();

            //Assert
            $this->assertEquals([$test_review, $test_review2], $result);

        }

        function test_deleteAll()
        {
            //Arrange
            $description = "Tasty sandwich";
            $rating = "***";
            $restaurant_id = 1;
            $test_review = new Review($description, $rating, $restaurant_id);
            $test_review->save();

            $description2 = "Big portions!";
            $rating2 = "**";
            $restaurant_id2 = 1;
            $test_review2 = new Review($description2, $rating2, $restaurant_id2);
            $test_review2->save();

            //Act
            Review::deleteAll();

            //Assert
            $result = Review::getAll();
            $this->assertEquals([], $result);
        }

        // function test_getRestaurantId()
        // {
        //     //Arrange
        //     $name = "Santeria";
        //     $phone = "503-555-5555";
        //     $price_range = "Cheap";
        //     $id = null;
        //     $cuisine_id = $test_cuisine->getId();
        //     $test_restaurant = new Restaurant($name, $phone, $price_range, $id, $cuisine_id);
        //     $test_restaurant->save();
        //
        //     $description = "Nice atmosphere";
        //     $dating = "**";
        //     $restaurant_id = $test_restaurant->getId();
        //     $test_review= new Review($description, $rating, $restaurant_id, $id);
        //     $test_review->save();
        //
        //     //Act
        //     $result = $test_review->getRestaurantId();
        //
        //     //Assert
        //     $this->assertEquals(true, is_numeric($result));
        //
        // }

        function test_find()
        {
            //Arrange
            $description = "Tasty sandwich";
            $rating = "***";
            $restaurant_id = 1;
            $test_review = new Review($description, $rating, $restaurant_id);
            $test_review->save();

            $description2 = "Big portions!";
            $rating2 = "**";
            $restaurant_id2 = 1;
            $test_review2 = new Review($description2, $rating2, $restaurant_id2);
            $test_review2->save();

            //Act
            $result = Review::find($test_review2->getId());

            //Assert
            $this->assertEquals($test_review2, $result);
        }
    }


?>
