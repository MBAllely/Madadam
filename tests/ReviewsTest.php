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
        function test_getDesc()
        {
          //Arrange
          $desc = "The food tastes like wallpaper";
          $rating = "*";
          $restaurant_id = 1;
          $new_review = new Review($desc, $rating, $restaurant_id);


          //Act
          $result = $new_review->getDescription();

          //Assert
          $this->assertEquals($desc, $result);
        }

        function test_getRating()
        {
            //Arrange
            $desc = "Pretty good burrito";
            $rating = "**";
            $restaurant_id = 1;
            $new_review = new Review($desc, $rating, $restaurant_id);

            //Act
            $result = $new_review->getRating();

            //Assert
            $this->assertEquals($rating, $result);
        }
    }


?>
