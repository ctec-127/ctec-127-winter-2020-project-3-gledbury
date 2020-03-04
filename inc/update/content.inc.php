<?php // Filename: connect.inc.php
// the following files are needed to process the db correctly
require_once __DIR__ . "/../db/mysqli_connect.inc.php";
// require_once __DIR__ . "/../functions/functions.inc.php";
require_once __DIR__ . "/../app/config.inc.php";

$error_bucket = [];

// http://php.net/manual/en/mysqli.real-escape-string.php
// set the following variables to an empty string
$yes = '';
$no = '';
$degree_program = '';

if($_SERVER['REQUEST_METHOD']=="POST"){
    // First insure that all required fields are filled in
    // series of ifelse statements to either add to error bucket or post input
    if (empty($_POST['first'])) {
        //no first name entered..into the error bucket you go
        array_push($error_bucket,"<p>A first name is required.</p>");
    } else {
        
        $first = $db->real_escape_string($_POST['first']);
    }
    // checking to see if a last name was filled in
    if (empty($_POST['last'])) {
        // if no last name entered..push to error bucket and ask for one
        array_push($error_bucket,"<p>A last name is required.</p>");
    } else {
        // assign the last name posted result to last name variable
        $last = $db->real_escape_string($_POST['last']);
    }
    if (empty($_POST['sid'])) {
        // no student id entered..into the bucket you go
        array_push($error_bucket,"<p>A student ID is required.</p>");
    } else {
        // assign the posted result of the id field to the id variable
        $sid = $db->real_escape_string($_POST['sid']);
    }
    if (empty($_POST['email'])) {
        // no email entered...into the bucket you go
        array_push($error_bucket,"<p>An email address is required.</p>");
    } else {
        //assign posted result of email to email variable
        $email = $db->real_escape_string($_POST['email']);
    }
    if (empty($_POST['phone'])) {
        // no phone # entered...into the bucket you go
        array_push($error_bucket,"<p>A phone number is required.</p>");
    } else {
        //assign posted result of phone# to phone variable
        $phone = $db->real_escape_string($_POST['phone']);
    }
    if (empty($_POST['degree_program'])) {
        // no degree selected...into the bucket you go
        array_push($error_bucket,"<p>A Degree program is required.</p>");
        $degree_program = '';
    } else {
        // assign selected degree program to degree_program variable
        $degree_program = $db->real_escape_string($_POST['degree_program']);
    }
        
    if (empty($_POST['gpa'])) { 
        //same results as above if not entered       
        array_push($error_bucket,"<p>A GPA is required.</p>");
    } else {
        //assign posted gpa to gpa variable
        $gpa = $db->real_escape_string($_POST['gpa']);
    }
    if (!isset($_POST['financial_aid'])) {       
        array_push($error_bucket,"<p>Financial Aid -  please check yes or no.</p>");

    } else {
        if ($_POST['financial_aid'] == '1') {
            $yes = 'checked';
            $no = '';
        } elseif ($_POST['financial_aid'] == '0') {
            $no = 'checked';
            $yes = '';
        }
        ;
        $financial_aid = $db->real_escape_string($_POST['financial_aid']);
        
    }
    
    // If we have no errors than we can try and insert the data
    if (count($error_bucket) == 0) {
        // Time for some SQL
        // entering the values entered into the corresponding fields
        $sql = "UPDATE $db_table SET first_name='$first', last_name='$last', student_id='$sid', email='$email', phone='$phone', degree_program='$degree_program', gpa='$gpa', financial_aid='$financial_aid' WHERE id=$id";
        // $sql .= "VALUES ('$first','$last',$sid,'$email','$phone','$degree_program','$gpa','$financial_aid')";

        // comment in for debug of SQL
        //echo $sql;

        // assign the database query results to the result variable
        $result = $db->query($sql); 

        // if entry error alert the following statement
        if (!$result) {
            echo '<div class="alert alert-danger" role="alert">
            I am sorry, but I could not save that record for you. ' .  
            $db->error . '.</div>';
        } else {
            // if successful data entry alert the following message
            echo '<div class="alert alert-success" role="alert">
            I saved that new record for you!
          </div>';
          // reset the following variable upon successful data entry
            unset($first);
            unset($last);
            unset($sid);
            unset($email);
            unset($phone);
            unset($degree_program);
            unset($gpa);
            unset($financial_aid);
            unset($id);
            $yes = '';
            $no = '';
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
    while($row = $result->fetch_assoc()) {
        $first = $row['first_name'];
        $last = $row['last_name'];
        $sid = $row['student_id'];
        $email = $row['email'];
        $phone = $row['phone'];
        $degree_program = $row['degreee_program'];
        $gpa = $row['gpa'];
        $financial_aid = $row['financial_aid'];
}
}

?>
