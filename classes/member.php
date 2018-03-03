<?php
/**
 * The Member class represents a member for the dating site.
 *
 * The Member class represents a normal member. It has nine
 * values; first name, last name, age, gender, phone number,
 * email, state, seeking, and bio.
 *
 * @author Raine Padilla <epadilla7@mail.greenriver.edu>
 * @copyright 2018
 */

class Member
{
    protected $fName;
    protected $lName;
    protected $age;
    protected $gender;
    protected $phone;
    protected $email;
    protected $state;
    protected $seeking;
    protected $bio;

    function __construct($fName, $lName, $age, $gender, $phone)
    {
        $this->fName = $fName;
        $this->lName = $lName;
        $this->age = $age;
        $this->gender = $gender;
        $this->phone = $phone;
    }

    /**
     * Function that retrieves the first name from the object.
     *
     * @return  a String fName from form1
     */
    public function getFName()
    {
        return $this->fName;
    }

    /**
     * Function that changes the first name from the object.
     *
     * @param String $fName represents the first name from form1.
     * @return void
     */
    public function setFName($fName)
    {
        $this->fName = $fName;
    }

    /**
     * Function that retrieves the last name from the object.
     *
     * @return  a String lName from form1
     */
    public function getLName()
    {
        return $this->lName;
    }

    /**
     * Function that changes the last name value.
     *
     * @param String $fName represents the last name from form1
     * @return void
     */
    public function setLName($lName)
    {
        $this->lName = $lName;
    }

    /**
     * Function that retrieves the age value.
     *
     * @return  an int representing age from form1
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Function that changes the age from the object.
     *
     * @param Int $age is an integer above 18.
     * @return void
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * Function that retrieves the gender from the object.
     *
     * @return  a String gender from form1
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Function that changes the gender value.
     *
     * @param String $gender is from form1
     * @return void
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * Function that retrieves the phone number from the object.
     *
     * @return  a String phone from form1. Must be formatted 123-456-7890
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Function that changes the phone number from the object.
     *
     * @param String $phone is from form1
     * @return void
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Function that retrieves the email address from the object.
     *
     * @return  String from form2.
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Function that changes the email-address
     *
     * @param String $email is from form2
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Function that retrieves the State from the object.
     *
     * @return  String state from form2
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Function that changes the State value.
     *
     * @param String $state is from form2
     * @return void
     */
    public function setState($state)
    {
        $this->state = $state;
    }
    /**
     * Function that retrieves the gender this member is seeking.
     *
     * @return  a string M/F
     */
    public function getSeeking()
    {
        return $this->seeking;
    }

    /**
     * Function that changes the gender seeking.
     *
     * @param String $seeking is from form2
     * @return void
     */
    public function setSeeking($seeking)
    {
        $this->seeking = $seeking;
    }

    /**
     * Function that retrieves a biography paragraph from the object.
     *
     * @return  a large string. Will cut off at 600 characters.
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Function that changes the biography string.
     *
     * @param String $bio is from form2
     * @return void
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
    }
}