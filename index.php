<?php
/**
 * User: Raine Padilla
 * Date: 1/23/2018
 * Description: The fat-free "controller" or routing page for the dating website
 */
error_reporting(E_ALL);
require_once ('vendor/autoload.php');

session_start();
// Create the fat-free base instance and set debug level for development
$f3 = Base::instance();
$f3->set('DEBUG', 3);

// Set first route - view home page
$f3->route('GET /', function(){
    $view = new View();
    echo $view->render('views/home.html');
});

// Form 1 route - able to get, post to self until form validates
$f3->route('GET|POST /form1', function(){

    $template = new Template();
    echo $template->render('views/personalinfo.html');
});

$f3->run();