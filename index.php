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
$f3->route('GET|POST /form1', function($f3){
    if(isset($_POST['submit']))
    {
        // Include validate file
        include 'model/validate.php';

        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];

       $errorArray = validateFormOne($fName, $lName, $age, $phone, $f3);

       $success = sizeof($errorArray) == 0;

       // Send to hive for templating
        $f3->set('fName', $fName);
        $f3->set('lName', $lName);
        $f3->set('age', $age);
        // Gender not set because it is not sticky
        $f3->set('phone', $phone);
        $f3->set('errors', $errorArray);

        if($success)
        {
            // Create member object
            if(isset($_POST['premium']))
            {
                $member = new Premium($fName, $lName, $age, $gender, $phone);
            }
            else
            {
                $member = new Member($fName, $lName, $age, $gender, $phone);
            }

            $f3->set('SESSION.member', $member);
            $f3->reroute('./form2');
        }

    }
    $template = new Template();
    echo $template->render('views/personalinfo.html');
});

$f3->route('GET|POST /form2', function($f3) {
    if(isset($_POST['submit']))
    {
        // Include validate file
        include 'model/validate.php';

        $email = $_POST['email'];
        $state = $_POST['state'];
        $seeking = $_POST['seeking'];
        $bio = $_POST['bio'];

        $errorArray = validateFormTwo($email);
        $success = sizeof($errorArray) == 0;

        // send to hive for templating
        $f3->set('email', $email);
        // State not sticky
        // Seeking not sticky
        $f3->set('bio', $bio);
        $f3->set('errors', $errorArray);
    }

    $template = new Template();
    echo $template->render('views/profile.html');
});

$f3->run();