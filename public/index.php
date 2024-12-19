<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Define the routes
$routes = new RouteCollection();
$routes->add('frontend', new Route('/{reactRouting}', [
    'reactRouting' => null,
    '_controller' => function (Request $request) {
        return new Response(file_get_contents(__DIR__ . '/frontend/index.html'));
    }
], [], [], null, [], ['GET']));

// Create the context using the current request
$context = new RequestContext();
$context->fromRequest(Request::createFromGlobals());

// Initialize the URL matcher
$matcher = new UrlMatcher($routes, $context);

try {
    // Match the request to a route
    $request = Request::createFromGlobals();
    $parameters = $matcher->match($request->getPathInfo());

    // Call the controller associated with the route
    $response = $parameters['_controller']($request);
} catch (ResourceNotFoundException $e) {
    // Handle 404 errors
    $response = new Response('Page not found', 404);
}

// Send the response
$response->send();
