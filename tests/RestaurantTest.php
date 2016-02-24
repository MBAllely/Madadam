<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=restaurants_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);




    class RestaurantTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

        // function test_getId()
        // {
        //     //Arrange
        //     $name = "Home stuff";
        //     $id = null;
        //     $test_cuisine = new Cuisine($name, $id);
        //     $test_cuisine->save();
        //
        //     $description = "Wash the dog";
        //     $due_date = "2016-02-28";
        //     $cuisine_id = $test_cuisine->getId();
        //     $test_restaurant = new Restaurant($description, $due_date, $id, $cuisine_id);
        //     $test_restaurant->save();
        //
        //     //Act
        //     $result = $test_restaurant->getId();
        //
        //     //Assert
        //     $this->assertEquals(true, is_numeric($result));
        // }
        //
        // function test_getCuisineId()
        // {
        //     //Arrange
        //     $name = "Home stuff";
        //     $id = null;
        //     $test_cuisine = new Cuisine($name, $id);
        //     $test_cuisine->save();
        //
        //     $description = "Wash the dog";
        //     $due_date = "2016-02-28";
        //     $cuisine_id = $test_cuisine->getId();
        //     $test_restaurant = new Restaurant($description, $due_date, $id, $cuisine_id);
        //     $test_restaurant->save();
        //
        //     //Act
        //     $result = $test_restaurant->getCuisineId();
        //
        //     //Assert
        //     $this->assertEquals(true, is_numeric($result));
        // }
        //
        // function test_save()
        // {
        //     //Arrange
        //     $name = "Home stuff";
        //     $id = null;
        //     $test_cuisine = new Cuisine($name, $id);
        //     $test_cuisine->save();
        //
        //     $description = "Wash the dog";
        //     $due_date = "2016-02-28";
        //     $cuisine_id = $test_cuisine->getId();
        //     $test_restaurant = new Restaurant($description, $due_date, $id, $cuisine_id);
        //
        //     //Act
        //     $test_restaurant->save();
        //
        //     //Assert
        //     $result = Restaurant::getAll();
        //     $this->assertEquals($test_restaurant, $result[0]);
        // }
        //
        // function test_getAll()
        // {
        //     //Arrange
        //     $name = "Home stuff";
        //     $id = null;
        //     $test_cuisine = new Cuisine($name, $id);
        //     $test_cuisine->save();
        //
        //     $description = "Wash the dog";
        //     $due_date = "2016-02-28";
        //     $cuisine_id = $test_cuisine->getId();
        //     $test_restaurant = new Restaurant($description, $due_date, $id, $cuisine_id);
        //     $test_restaurant->save();
        //
        //
        //     $description2 = "Water the lawn";
        //     $due_date2 = "2016-02-27";
        //     $test_restaurant2 = new Restaurant($description2, $due_date2, $id, $cuisine_id);
        //     $test_restaurant2->save();
        //
        //     //Act
        //     $result = Restaurant::getAll();
        //
        //     //Assert
        //     $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        // }
        //
        // function test_deleteAll()
        // {
        //     //Arrange
        //     $name = "Home stuff";
        //     $id = null;
        //     $test_cuisine = new Cuisine($name, $id);
        //     $test_cuisine->save();
        //
        //     $description = "Wash the dog";
        //     $due_date = "2016-02-28";
        //     $cuisine_id = $test_cuisine->getId();
        //     $test_restaurant = new Restaurant($description, $due_date, $id, $cuisine_id);
        //     $test_restaurant->save();
        //
        //     $description2 = "Water the lawn";
        //     $due_date2 = "2016-02-27";
        //     $test_restaurant2 = new Restaurant($description2, $due_date2, $id, $cuisine_id);
        //     $test_restaurant2->save();
        //
        //     //Act
        //     Restaurant::deleteAll();
        //
        //     //Assert
        //     $result = Restaurant::getAll();
        //     $this->assertEquals([], $result);
        // }
        //
        // function test_deleteFromCuisine()
        // {
        //     //Arrange
        //     $name = "Home Stuff";
        //     $id = null;
        //     $test_Cuisine = new Cuisine($name, $id);
        //     $test_Cuisine->save();
        //
        //     $name2 = "Dinner Stuff";
        //     $id = null;
        //     $test_Cuisine2 = new Cuisine($name2, $id);
        //     $test_Cuisine2->save();
        //
        //     $description = "Wash the dog";
        //     $due_date = "2016-02-28";
        //     $cuisine_id = $test_Cuisine->getId();
        //     $test_restaurant = new Restaurant($description, $due_date, $id, $cuisine_id);
        //     $test_restaurant->save();
        //
        //     $description2 = "Chop the onion";
        //     $due_date2 = "2016-02-26";
        //     $cuisine_id2 = $test_Cuisine2->getId();
        //     $test_restaurant2 = new Restaurant($description2, $due_date2, $id, $cuisine_id2);
        //     $test_restaurant2->save();
        //
        //     //Act
        //     Restaurant::deleteFromCuisine($cuisine_id);
        //     $result = Restaurant::getAll();
        //
        //     //Assert
        //     $this->assertEquals([$test_restaurant2], $result);
        // }
        //
        // function test_find()
        // {
        //     //Arrange
        //     $name = "Home stuff";
        //     $id = null;
        //     $test_cuisine = new Cuisine($name, $id);
        //     $test_cuisine->save();
        //
        //     $description = "Wash the dog";
        //     $due_date = "2016-02-28";
        //     $cuisine_id = $test_cuisine->getId();
        //     $test_restaurant = new Restaurant($description, $due_date, $id, $cuisine_id);
        //     $test_restaurant->save();
        //
        //     $description2 = "Water the lawn";
        //     $due_date2 = "2016-02-27";
        //     $test_restaurant2 = new Restaurant($description2, $due_date2, $id, $cuisine_id);
        //     $test_restaurant2->save();
        //
        //     //Act
        //     $result = Restaurant::find($test_restaurant->getId());
        //
        //     //Assert
        //     $this->assertEquals($test_restaurant, $result);
        // }


    }
?>
