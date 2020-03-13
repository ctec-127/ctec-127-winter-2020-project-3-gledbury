<?php // Filename: connect.inc.php
// the following files are needed to process the db correctly
require_once __DIR__ . "/../db/mysqli_connect.inc.php";
require_once __DIR__ . "/../functions/functions.inc.php";
require_once __DIR__ . "/../app/config.inc.php";


$error_bucket = [];

// http://php.net/manual/en/mysqli.real-escape-string.php
// set the following variables to an empty string
$financial_aid_yes = '';
$financial_aid_no = '';
$degree_program = '';


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // get id from POST

    $id = $_POST['id'];

    // First insure that all required fields are filled in
    // series of ifelse statements to either add to error bucket or post input

    if (empty($_POST['first'])) {
        //no first name entered..into the error bucket you go
        array_push($error_bucket, "<p>A first name is required.</p>");
    } else {

        $first = $db->real_escape_string($_POST['first']);
    }
    // checking to see if a last name was filled in
    if (empty($_POST['last'])) {
        // if no last name entered..push to error bucket and ask for one
        array_push($error_bucket, "<p>A last name is required.</p>");
    } else {
        // assign the last name posted result to last name variable
        $last = $db->real_escape_string($_POST['last']);
    }
    if (empty($_POST['sid'])) {
        // no student id entered..into the bucket you go
        array_push($error_bucket, "<p>A student ID is required.</p>");
    } else {
        // assign the posted result of the id field to the id variable
        $sid = $db->real_escape_string($_POST['sid']);
    }
    if (empty($_POST['email'])) {
        // no email entered...into the bucket you go
        array_push($error_bucket, "<p>An email address is required.</p>");
    } else {
        //assign posted result of email to email variable
        $email = $db->real_escape_string($_POST['email']);
    }
    if (empty($_POST['phone'])) {
        // no phone # entered...into the bucket you go
        array_push($error_bucket, "<p>A phone number is required.</p>");
    } else {
        //assign posted result of phone# to phone variable
        $phone = $db->real_escape_string($_POST['phone']);
    }

    $degree_program = $db->real_escape_string(strip_tags($_POST['degree_program']));

    if (empty($_POST['gpa'])) {
        //same results as above if not entered       
        array_push($error_bucket, "<p>A GPA is required.</p>");
    } else {
        //assign posted gpa to gpa variable
        $gpa = $db->real_escape_string($_POST['gpa']);
    }

    if (!isset($_POST['financial_aid'])) {
        array_push($error_bucket, "<p>Financial Aid -  please check yes or no.</p>");
    } else {
        if ($_POST['financial_aid'] == 'yes') {
            $financial_aid_yes = 1;
            $financial_aid_no = 0;
            $financial_aid = 1;
        } elseif ($_POST['financial_aid'] == 'no') {
            $financial_aid_no = 1;
            $financial_aid_yes = 0;
            $financial_aid = 0;
        }
    }

    $graduation_date = $_POST['graduation_date'];

    // If we have no errors than we can try and insert the data
    if (count($error_bucket) == 0) {
        // Time for some SQL
        // entering the values entered into the corresponding fields
        $sql = "UPDATE $db_table SET first_name='$first',last_name='$last',sid=$sid,email='$email',phone='$phone',gpa=$gpa,degree_program='$degree_program',financial_aid=$financial_aid,graduation_date='$graduation_date' WHERE id=$id";
        // assign the database query results to the result variable
        // echo $sql;
        $result = $db->query($sql);

        // if entry error alert the following statement
        if (!$result) {
            echo '<div class="alert alert-danger" role="alert">
            I am sorry, but I could not save that record for you. ' .
                $db->error . '.</div>';
        } else {
            // if successful data entry alert the following message
            header("location: display-records.php?message=The record was successfully updated for $first.");
        }
    } else {
        display_error_bucket($error_bucket);
    } // end of error bucket
} else {
    // check for record id (primary key)
    $id = $_GET['id'];
    // now we need to query the database and get the data for the record
    // note limit 1
    $sql = "SELECT * FROM $db_table WHERE id=$id LIMIT 1";

    // query database
    $result = $db->query($sql);
    // get the one row of data
    while ($row = $result->fetch_assoc()) {
        $first = $row['first_name'];
        $last = $row['last_name'];
        $sid = $row['sid'];
        $email = $row['email'];
        $phone = $row['phone'];
        $degree_program = $row['degree_program'];
        $gpa = $row['gpa'];
        $financial_aid = $row['financial_aid'];
        $graduation_date = $row['graduation_date'];
        if ($financial_aid == 1) {
            $financial_aid_yes = 1;
            $financial_aid_no = 0;
        } else if ($financial_aid == 0) {
            $financial_aid_no = 1;
            $financial_aid_yes = 0;
        }
    }
}
