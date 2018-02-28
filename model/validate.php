<?php

$errors = array();


function validFirst($fName)
{
    return ctype_alpha($fName);
}

function validLast($lName)
{
    return ctype_alpha($lName);
}

function validAge($age)
{
    return is_numeric($age) && $age > 18;
}

function validPhone($phone)
{
    // Phone format 111-222-3333 has a total of 13 characters
    return !is_numeric($phone) && strlen($phone) < 14;
}

function validEmail($email)
{
    if(filter_var($email, FILTER_VALIDATE_EMAIL) == false)
        return false;
    else
        return true;
}

function validIndoor($indoor)
{

    return sizeof($indoor) != 0;
}

function validOutdoor($outdoor)
{
    return sizeof($outdoor) != 0;
}

function validateFormOne($fName, $lName, $age, $phone)
{
    global $errors;
    if(!validFirst($fName))
    {
        $errors['first'] = "Please enter a valid string for first name.";
    }
    if(!validLast($lName))
    {
        $errors['last'] = "Please enter a valid string for last name.";
    }
    if(!validAge($age))
    {
        $errors['age'] = "You must be over 18 to join this site. This field accepts numbers only.";
    }
    if(!validPhone($phone))
    {
        $errors['phone'] = "Phone number should be formatted as 123-456-7890";
    }
    return $errors;
}

function validateFormTwo($email)
{
    global $errors;
    if(!validEmail($email))
    {
        $errors['email'] = "Please enter a valid email address, such as bob@gmail.com";
    }

    return $errors;
}