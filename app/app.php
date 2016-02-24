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

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->post("/cuisines", function() use ($app) {
        $cuisine = new Cuisine($_POST['cuisine_name']);
        $cuisine->save();
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });


    // $app->get("/cuisines", function() use ($app) {
    //     return $app['twig']->render('cuisines.html.twig', array('cuisines' => Cuisine::getAll()));
    // });

//     $app->get("/restaurants", function() use ($app) {
//         return $app['twig']->render('restaurants.html.twig', array('restaurants' => Restaurant::getAll()));
//     });
//
//
//     $app->get("/cuisines/{id}", function($id) use ($app) {
//         $cuisine = Cuisine::find($id);
//         return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
//     });
//
//
//     $app->post("/restaurants", function() use ($app) {
//         $description = $_POST['description'];
//         $due_date = $_POST['due_date'];
//         $cuisine_id = $_POST['cuisine_id'];
//         $task = new Restaurant($description, $due_date, $id = null, $cuisine_id);
//         $task->save();
//         $cuisine = Cuisine::find($cuisine_id);
//         return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
// });
//
//     $app->post("/delete_restaurants/{id}", function($id) use ($app) {
//         $cuisine_id = Cuisine::find($id);
//         Restaurant::deleteFromCuisine($cuisine_id->getId());
//         return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine_id));
//     });
//
//     $app->post("/delete_cuisines", function() use ($app) {
//        Cuisine::deleteAll();
//        return $app['twig']->render('index.html.twig');
//    });

    return $app;

?>
