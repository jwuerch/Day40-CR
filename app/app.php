<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Client.php";
    require_once __DIR__."/../src/Stylist.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path'=>__DIR__."/../views"));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();


    $app->get("/", function() use ($app) {
        $stylists = Stylist::getAll();
        return $app['twig']->render('index.html.twig', array('stylists' => $stylists));
    });

    $app->post("/add_stylist", function() use ($app) {
        $stylist_name = $_POST['stylist_name'];
        $stylist_location = $_POST['stylist_location'];
        $new_stylist = new Stylist($stylist_name, $stylist_location);
        $new_stylist->save();
        $stylists = Stylist::getAll();
        return $app['twig']->render('index.html.twig', array('stylists' => $stylists));
    });

    $app->post("/delete_stylists", function() use ($app) {
        Stylist::deleteAll();
        $stylists = Stylist::getAll();
        return $app['twig']->render('index.html.twig', array('stylists' => $stylists));
    });

    $app->get("/stylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $clients = $stylist->getClients();
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $clients));
    });

    $app->post("/add_client", function() use ($app) {
        $client_name = $_POST['client_name'];
        $stylist_id = $_POST['stylist_id'];
        $new_client = new Client($client_name, $stylist_id);
        $new_client->save();
        $stylist = Stylist::find($stylist_id);
        $clients = $stylist->getClients();
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $clients));
    });

    $app->get("/clients", function() use ($app) {
        $clients = Client::getAll();
        $stylists = Stylist::getAll();
        return $app['twig']->render('clients.html.twig', array('clients' => $clients, 'stylists' => $stylists));
    });

    $app->get("/client/{id}", function($id) use ($app) {
        $client = Client::find($id);
        $stylists = Stylist::getAll();
        $stylist = Stylist::find($client->getStylistId());
        return $app['twig']->render('client.html.twig', array('client' => $client, 'stylists' => $stylists, 'stylist' => $stylist));
    });

    $app->get("/stylists", function() use ($app) {
        $stylists = Stylist::getAll();
        return $app['twig']->render('stylists.html.twig', array('stylists' => $stylists));
    });

    $app->patch("/client_update/{id}", function($id) use ($app) {
        $client = (Client::find($id));
        $new_name = $_POST['update_client_name'];
        $updated_stylist = $_POST['update_stylist'];
        $client->update($new_name, $updated_stylist);
        $new_client = $client;
        return $app['twig']->render('client.html.twig', array('client' => (Client::find($id)), 'stylists' => Stylist::getAll(), 'stylist' => Stylist::find($new_client->getStylistId())));
    });

    $app->delete("/client_delete{id}", function($id) use ($app) {
        $client = Client::find($id);
        $client->delete();
        return $app['twig']->render('clients.html.twig', array('clients' => Client::getAll()));
    });

    $app->post("/delete_clients", function() use ($app) {
        Client::deleteAll();
        return $app['twig']->render('clients.html.twig', array('clients' => Client::getAll()));
    });

    return $app;

 ?>
