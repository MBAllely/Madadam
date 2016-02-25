<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Restaurant.php";
    require_once __DIR__."/../src/Cuisine.php";
    require_once __DIR__."/../src/Reviews.php";

    $app = new Silex\Application();

    $app['debug'] = true;

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

    $app->get("/cuisines/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        $restaurant = Restaurant::find($id);
        $reviews = Review::getAll();

        return $app['twig']->render('cuisines.html.twig',
        array(
            'cuisine' => $cuisine,
            'restaurants' => $cuisine->getRestaurants(),
            'reviews' => $reviews
        ));
    });

    $app->get("/restaurants/{id}/edit", function($id) use ($app) {
        $restaurant = Restaurant::find($id);
        return $app['twig']->render('restaurant_edit.html.twig', array('restaurant' => $restaurant));
    });

    $app->get("/restaurants/{id}/review", function($id) use ($app) {
        $restaurant = Restaurant::find($id);
        $reviews = Review::getAll();
        return $app['twig']->render('restaurant_review.html.twig',
        array(
            'restaurant' => $restaurant,
            'reviews' => $reviews

        ));
    });

    $app->get("/restaurants/{restaurant_id}/review/{id}/edit", function($restaurant_id, $id) use ($app) {
        $restaurant = Restaurant::find($restaurant_id);
        $review = Review::find($id);
        return $app['twig']->render('restaurant_review_edit.html.twig',
        array(
            'review' => $review,
            'restaurant' => $restaurant
        ));
    });

    $app->get("/restaurants/{restaurant_id}/review/{id}/delete", function($restaurant_id, $id) use ($app) {
            $restaurant = Restaurant::find($restaurant_id);
            $review = Review::find($id);
            var_dump($review);
            $review->deleteOneReview();
            return $app['twig']->render('restaurant_review_edit.html.twig',
            array(
                'review' => $review,
                'restaurant' => $restaurant
            ));
    });


    $app->post("/restaurants/{id}/review", function($id) use ($app) {
        $description = $_POST['description'];
        if ($_POST['rating'] == "*") {
            $rating = "*";
        } elseif ($_POST['rating'] == "**") {
            $rating = "**";
        } elseif ($_POST['rating'] == "***") {
            $rating = "***";
        } elseif ($_POST['rating'] == "****") {
            $rating = "****";
        } elseif ($_POST['rating'] == "*****") {
            $rating = "*****";
        }
        $restaurant_id = $_POST['restaurant_id'];
        $new_review = new Review($description, $rating, $restaurant_id, $id = null);
        $new_review->save();
        $restaurant = Restaurant::find($restaurant_id);

        return $app['twig']->render('restaurant_review.html.twig',
        array(
            'restaurant' => $restaurant,
            'reviews' => $restaurant->getReviews()
        ));
    });

    $app->post("/cuisines", function() use ($app) {
        $cuisine = new Cuisine($_POST['cuisine_name']);
        $cuisine->save();
        return $app['twig']->render('index.html.twig',
        array(
            'cuisines' => Cuisine::getAll()
        ));
    });

    $app->post("/restaurants", function() use ($app) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $price_range = $_POST['price_range'];
        $cuisine_id = $_POST['cuisine_id'];
        $restaurant = new Restaurant($name, $phone, $price_range, $id = null, $cuisine_id);
        $restaurant->save();
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('cuisines.html.twig',
        array(
            'cuisine' => $cuisine,
            'restaurants' => $cuisine->getRestaurants()
        ));
    });

    $app->post("/delete_cuisines", function() use ($app) {
       Cuisine::deleteAll();
       return $app['twig']->render('index.html.twig',
       array(
           'cuisines' => Cuisine::getAll()
       ));
    });

    $app->patch("/restaurants/{id}/name", function($id) use ($app) {
        $new_name = $_POST['name'];
        $restaurant = Restaurant::find($id);
        $restaurant->updateName($new_name);
        $cuisine_id = $restaurant->getCuisineId();
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('cuisines.html.twig',
        array(
            'cuisine' => $cuisine,
            'restaurants' => $cuisine->getRestaurants()
        ));
    });

    $app->patch("/restaurants/{id}/phone", function($id) use ($app) {
        $new_phone = $_POST['phone'];
        $restaurant = Restaurant::find($id);
        $restaurant->updatePhone($new_phone);
        $cuisine_id = $restaurant->getCuisineId();
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('cuisines.html.twig',
        array(
            'cuisine' => $cuisine,
            'restaurants' => $cuisine->getRestaurants()
        ));
    });

    $app->patch("/restaurants/{id}/price_range", function($id) use ($app) {
        $new_price_range = $_POST['price_range'];
        $restaurant = Restaurant::find($id);
        $restaurant->updatePriceRange($new_price_range);
        $cuisine_id = $restaurant->getCuisineId();
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('cuisines.html.twig',
        array(
            'cuisine' => $cuisine,
            'restaurants' => $cuisine->getRestaurants()
        ));
    });

    $app->delete("/restaurants/{id}/delete", function($id) use ($app) {
        $restaurant = Restaurant::find($id);
        $cuisine_id = $restaurant->getCuisineId();
        $cuisine = Cuisine::find($cuisine_id);
        $restaurant->deleteOneRestaurant();
        return $app['twig']->render('cuisines.html.twig',
        array(
            'cuisine' => $cuisine,
            'restaurants' => $cuisine->getRestaurants()
        ));
    });

    $app->delete("/delete_restaurants/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        var_dump($cuisine->getRestaurants());
        Restaurant::delete($id);
        return $app['twig']->render('cuisines.html.twig',
        array(
            'cuisine' => $cuisine,
            'restaurants' => $cuisine->getRestaurants()
        ));
    });

    return $app;

?>
