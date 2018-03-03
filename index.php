<?php
/**
 * User: Raine Padilla
 * Date: 1/23/2018
 * Description: The fat-free "controller" or routing page for the dating website
 */
error_reporting(E_ALL);
require_once ("vendor/autoload.php");
require_once("/home/epadilla/config.php");

require("model/db-functions.php");


// Create the fat-free base instance and set debug level for development
$f3 = Base::instance();
session_start();
$f3->set('DEBUG', 3);

$dbh = connect();

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
        $premium = isset($_POST['premium']);

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
            if($premium)
            {
                $member = new Premium($fName, $lName, $age, $gender, $phone);
            }
            else
            {
                $member = new Member($fName, $lName, $age, $gender, $phone);
            }

            // Add member to hive
            $f3->set('SESSION.member', $member);

            // Add premium to hive for later routing
            $_SESSION['premium'] = $premium;

            // Continue to form2
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

        // If the form validates
        if($success)
        {
            // Update the member object
            $member = $f3->get('SESSION.member');
            // Update the member object
            $member->setEmail($email);
            $member->setState($state);
            $member->setSeeking($seeking);
            $member->setBio($bio);

            // update member in the hive

            $f3->set('SESSION.member', $member);

            // Set premium in hive for results page
            $f3->set('premium', $_SESSION['premium']);

            // If the member is a premium user
            if($_SESSION['premium'])
            {
                //re-route to interest's page
                $f3->reroute('/form3');
            }
            else
            {
                // re-route to results page
                $f3->reroute('/results');
            }
        }
    }

    $template = new Template();
    echo $template->render('views/profile.html');
});

$f3->route('GET|POST /form3', function($f3){
    print_r($_POST);

    if(isset($_POST))
    {
        $_SESSION['indoors'] = $_POST['indoors'];
        $_SESSION['outdoors'] = $_POST['outdoors'];

        $indoor = $_SESSION['indoors'];
        $outdoor = $_SESSION['outdoors'];


        $member = $f3->get('SESSION.member');
        $member->setIndoorInterests($indoor);
        $member->setOutdoorInterests($outdoor);

        $f3->set('SESSION.member', $member);
    }
    $template = new Template();
    echo $template->render('views/interests.html');
});

$f3->route('GET|POST /results', function($f3){
    $member = $f3->get('SESSION.member');
    if($member instanceof Premium)
        addMember($member->getFName(), $member->getLName(), $member->getAge(), $member->getGender(), $member->getPhone(), $member->getEmail(), $member->getState(),
            $member->getSeeking(), $member->getBio(), 1, '', $member->getInDoorInterests() . $member->getOutDoorInterests());
    else
        addMember($member->getFName(), $member->getLName(), $member->getAge(), $member->getGender(), $member->getPhone(), $member->getEmail(), $member->getState(),
            $member->getSeeking(), $member->getBio(), 0, '', '');
    $template = new Template();
    echo $template->render('views/results.html');
});

$f3->route('GET|POST /admin', function($f3){
   $members = getMembers();
   $f3->set('members', $members);
   $template = new Template();
   echo $template->render('views/admin-table.html');
});

$f3->run();