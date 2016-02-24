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

        function test_getId()
        {
            //Arrange
            $name = "Mexican";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name = "Santeria";
            $phone = "503-555-5555";
            $price_range = "Cheap";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $phone, $price_range, $id, $cuisine_id);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_getCuisineId()
        {
            //Arrange
            $name = "Mexican";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name = "Santeria";
            $phone = "503-555-5555";
            $price_range = "Cheap";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $phone, $price_range, $id, $cuisine_id);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getCuisineId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $name = "Mexican";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name = "Santeria";
            $phone = "503-555-5555";
            $price_range = "Cheap";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $phone, $price_range, $id, $cuisine_id);

            //Act
            $test_restaurant->save();
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals($test_restaurant, $result[0]);
        }

        function testUpdateName()
        {
            //Arrange
            $name = "Mexican";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name = "Santeria";
            $phone = "503-555-5555";
            $price_range = "Cheap";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $phone, $price_range, $id, $cuisine_id);

            $new_name = "Santeria 2.0";

            //Act
            $test_restaurant->updateName($new_name);

            //Assert
            $this->assertEquals("Santeria 2.0", $test_restaurant->getName());
        }

        function testUpdatePhone()
        {
            //Arrange
            $name = "Mexican";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name = "Santeria";
            $phone = "503-555-5555";
            $price_range = "Cheap";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $phone, $price_range, $id, $cuisine_id);

            $new_phone = "203-555-5555";

            //Act
            $test_restaurant->updatePhone($new_phone);

            //Assert
            $this->assertEquals("203-555-5555", $test_restaurant->getPhone());
        }

        function testUpdatePriceRange()
        {
            //Arrange
            $name = "Mexican";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name = "Santeria";
            $phone = "503-555-5555";
            $price_range = "Cheap";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $phone, $price_range, $id, $cuisine_id);

            $new_price_range = "Average";

            //Act
            $test_restaurant->updatePriceRange($new_price_range);

            //Assert
            $this->assertEquals("Average", $test_restaurant->getPriceRange());
        }

        function test_getAll()
        {
            //Arrange
            $name = "Mexican";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name = "Santeria";
            $phone = "503-555-5555";
            $price_range = "Cheap";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $phone, $price_range, $id, $cuisine_id);
            $test_restaurant->save();


            $name2 = "Los Pollos Hermanos";
            $phone2 = "503-111-1111";
            $price_range2 = "Average";
            $test_restaurant2 = new Restaurant($name2, $phone2, $price_range2, $id, $cuisine_id);
            $test_restaurant2->save();

            //Act
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Mexican";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name = "Santeria";
            $phone = "503-555-5555";
            $cuisine_id = $test_cuisine->getId();
            $price_range = "Cheap";
            $test_restaurant = new Restaurant($name, $phone, $price_range, $id, $cuisine_id);
            $test_restaurant->save();

            $name2 = "Los Pollos Hermanos";
            $phone2 = "503-111-1111";
            $price_range2 = "Average";
            $test_restaurant2 = new Restaurant($name2, $phone2, $price_range2, $id, $cuisine_id);
            $test_restaurant2->save();

            //Act
            Restaurant::deleteAll();

            //Assert
            $result = Restaurant::getAll();
            $this->assertEquals([], $result);
        }

        function testDeleteRestaurants()
        {
            //Arrange
            $name = "Mexican";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name = "Santeria";
            $phone = "503-555-5555";
            $cuisine_id = $test_cuisine->getId();
            $price_range = "Cheap";
            $test_restaurant = new Restaurant($name, $phone, $price_range, $id, $cuisine_id);
            $test_restaurant->save();

            //Act
            $test_restaurant->delete();

            //Assert
            $this->assertEquals([], Restaurant::getAll());
        }

        function test_find()
        {
            //Arrange
            $name = "Mexican";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name = "Santeria";
            $phone = "503-555-5555";
            $cuisine_id = $test_cuisine->getId();
            $price_range = "Cheap";
            $test_restaurant = new Restaurant($name, $phone, $price_range, $id, $cuisine_id);
            $test_restaurant->save();

            $name2 = "Los Pollos Hermanos";
            $phone2 = "503-111-1111";
            $price_range2 = "Average";
            $test_restaurant2 = new Restaurant($name2, $phone2, $price_range2, $id, $cuisine_id);
            $test_restaurant2->save();

            //Act
            $result = Restaurant::find($test_restaurant->getId());

            //Assert
            $this->assertEquals($test_restaurant, $result);
        }
    }
?>
