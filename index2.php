<?php

require 'Router.php';

$router = new Router();

$router->addRoute('/', 'home.php');
$router->addRoute('/~witness', 'vote-for-witnesses.php');
$router->addRoute('/welcome', 'welcome.php');
$router->addRoute('/validate', 'welcome.php');
$router->addRoute('/explorer', 'explorer.php');
$router->addRoute('^\/([\w\d\-\/]+)\/?$', 'home.php');
$router->addRoute('^\/(@[\w\.\d-]+)\/(feed)\/?$', 'home.php');
$router->addRoute('^\/(@[\w\.\d-]+)\/?$', 'profile.php');
$router->addRoute('^\/(@[\w\.\d-]+)\/(projects|notifications|curation-rewards|author-rewards|blocked|wallet|settings)\/?$', 'profile.php');
$router->addRoute('^\/([\w\d\-\/]+)\/(\@[\w\d\.-]+)\/([\w\d-]+)\/?$', 'post-view.php');

echo include $router->match($_SERVER['REQUEST_URI']);