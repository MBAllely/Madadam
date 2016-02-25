<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost;dbname=restaurants_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
          Cuisine::deleteAll();
          Restaurant::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Mexican";
            $test_cuisine = new Cuisine($name);

            //Act
            $result = $test_cuisine->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Mexican";
            $id = 1;
            $test_cuisine = new Cuisine($name, $id);

            //Act
            $result = $test_cuisine->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $name = "Mexican";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals($test_cuisine, $result[0]);
        }

        function testUpdate()
        {
            //Arrange
            $name = "Mexican";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $new_name = "Puerto Rican";

            //Act
            $test_cuisine->update($new_name);

            //Assert
            $this->assertEquals("Puerto Rican", $test_cuisine->getName());
        }

        function testGetRestaurants()
        {
            //Arrange
            $name = "Mexican";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $test_cuisine_id = $test_cuisine->getId();

            $restaurant_name = "Santeria";
            $cuisine_id = $test_cuisine->getId();
            $phone = "503-999-9999";
            $price_range = "Cheap";
            $test_restaurant = new Restaurant($restaurant_name, $phone, $price_range, $id, $cuisine_id);
            $test_restaurant->save();

            $restaurant_name2 = "Los Pollos Hermanos";
            $cuisine_id = $test_cuisine->getId();
            $phone2 = "503-111-1111";
            $price_range2 = "Average";
            $test_restaurant2 = new Restaurant($restaurant_name2, $phone2, $price_range2, $id, $cuisine_id);
            $test_restaurant2->save();

            //Act
            $result = $test_cuisine->getRestaurants();

            //Assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Mexican";
            $name2 = "Chinese";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($name2);
            $test_cuisine2->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([$test_cuisine, $test_cuisine2], $result);
        }

        function test_UpdateCuisine()
        {
            //Arrange
            $name = "Mexican";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();
            $new_name = "Por Que No";

            //Act
            $test_cuisine->update($new_name);

            //Assert
            $this->assertEquals("Por Que No", $test_cuisine->getName());

        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Mexican";
            $name2 = "Chinese";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($name2);
            $test_cuisine2->save();

            //Act
            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function testDeleteCuisine()
        {
            //Arrange
            $name = "Mexican";
            $id = null;
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();

            $restaurant_name = "Santeria";
            $cuisine_id = $test_cuisine->getId();
            $phone = "503-999-9999";
            $price_range = "Cheap";
            $test_restaurant = new Restaurant($restaurant_name, $phone, $price_range, $id, $cuisine_id);
            $test_restaurant->save();

            //Act
            $test_cuisine->deleteCuisine();

            //Assert
            $this->assertEquals([], Restaurant::getAll());
        }

        function test_find()
        {
            //Arrange
            $name = "Mexican";
            $name2 = "Chinese";
            $test_Cuisine = new Cuisine($name);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($name2);
            $test_Cuisine2->save();

            //Act
            $result = Cuisine::find($test_Cuisine->getId());

            //Assert
            $this->assertEquals($test_Cuisine, $result);
        }
    }

?>
