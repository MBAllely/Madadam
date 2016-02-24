<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Restaurant.php";
    require_once __DIR__."/../src/Cuisine.php";

    $app = new Silex\Application();

    // $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=restaurants';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->post("/cuisines", function() use ($app) {
        $cuisine = new Cuisine($_POST['cuisine_name']);
        $cuisine->save();
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->get("/cuisines/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('cuisines.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });


    $app->post("/restaurants", function() use ($app) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $price_range = $_POST['price_range'];
        $cuisine_id = $_POST['cuisine_id'];
        $restaurant = new Restaurant($name, $phone, $price_range, $id = null, $cuisine_id);
        $restaurant->save();
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('cuisines.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    $app->delete("/delete_restaurants/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        Restaurant::delete($id);
        return $app['twig']->render('cuisines.html.twig', array('cuisine' => $cuisine));
    });

    $app->get("/restaurants/{id}/edit", function($id) use ($app) {
        $restaurant = Restaurant::find($id);
        return $app['twig']->render('restaurant_edit.html.twig', array('restaurant' => $restaurant));
    });

    $app->patch("/restaurants/{id}/name", function($id) use ($app) {
        $new_name = $_POST['name'];
        $restaurant = Restaurant::find($id);
        $restaurant->updateName($new_name);
        $cuisine_id = $restaurant->getCuisineId();
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('cuisines.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    $app->patch("/restaurants/{id}/phone", function($id) use ($app) {
        $new_phone = $_POST['phone'];
        $restaurant = Restaurant::find($id);
        $restaurant->updatePhone($new_phone);
        $cuisine_id = $restaurant->getCuisineId();
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('cuisines.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    $app->post("/delete_cuisines", function() use ($app) {
       Cuisine::deleteAll();
       return $app['twig']->render('index.html.twig');
   });

    return $app;

?>
