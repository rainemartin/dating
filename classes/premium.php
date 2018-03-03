<?php
/**
 * The Premium class represents a Premium member for the dating site.
 *
 * The Premium class represents a Premium member. In addition to the
 * member fields, the Premium member adds two arrays for Indoor and
 * Outdoor interests.
 *
 * @author Raine Padilla <epadilla7@mail.greenriver.edu>
 * @copyright 2018
 */

class Premium extends Member
{
    private $_indoorInterests;
    private $_outdoorInterests;

    function __construct($fName, $lName, $age, $gender, $phone)
    {
        Parent::__construct($fName, $lName, $age, $gender, $phone);
    }


    /**
     * Function that retrieves the indoorInterests from the object.
     *
     * @return  an array of strings
     */
    public function getIndoorInterests()
    {
        return $this->_indoorInterests;
    }

    /**
     * Function that changes the indoorInterests array.
     *
     * @param Array $indoorInterests is an array of values from form3
     * @return Array
     */
    public function setIndoorInterests($indoorInterests)
    {
        $this->_indoorInterests = $indoorInterests;
    }

    /**
     * Function that retrieves the outdoorInterests from the object.
     *
     * @return  an array of strings
     */
    public function getOutdoorInterests()
    {
        return $this->_outdoorInterests;
    }

    /**
     * Function that changes the outdoorInterests array.
     *
     * @param Array $outdoorInterests is an array of values from form3
     * @return Array
     */
    public function setOutdoorInterests($outdoorInterests)
    {
        $this->_outdoorInterests = $outdoorInterests;
    }
}