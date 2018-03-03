<?php
function connect()
{
    try {
        //Instantiate a database object
        $dbh = new PDO(DB_DSN, DB_USERNAME,
            DB_PASSWORD);
        // echo "Connected to database!!!";
        return $dbh;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return;
    }
}

function getMembers()
{
    global $dbh;
    $sql = "SELECT * FROM members";
    $statement = $dbh->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function addMember($fname, $lname, $age, $gender, $phone, $email, $state, $seeking, $bio, $premium, $image = '', $interests = '')
{
    global $dbh;

    echo "First: " . $fname . " Last: " . $lname . " Age: " . $age . " Gender: " . $gender . " Phone: " . $phone . " Email: " . $email
        . " State: " . $state . " Seeking: " . $seeking . " Bio: " . $bio . " Premium: " . $premium;
    //1. Define the query
    $sql = "INSERT INTO members (fname, lname, age, gender, phone, email, state, seeking, bio, premium, image, interests) VALUES (:fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :image, :interests)";

    //2. Prepare the statement
    $statement = $dbh->prepare($sql);

    //3. Bind parameters
    $statement->bindParam(':fname', $fname);
    $statement->bindParam(':lname', $lname);
    $statement->bindParam(':age', $age);
    $statement->bindParam(':gender', $gender);
    $statement->bindParam(':phone', $phone);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':state', $state);
    $statement->bindParam(':seeking', $seeking);
    $statement->bindParam(':bio', $bio);
    $statement->bindParam(':premium', $premium);
    $statement->bindParam(':image', $image);
    $statement->bindParam(':interests', $interests);

    //4. Execute the query
    $result = $statement->execute();

    //5. Return the result
    return $result;
}