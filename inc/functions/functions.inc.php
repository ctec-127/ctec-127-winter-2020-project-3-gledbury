<?php // Filename: function.inc.php

function display_message()
{
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        echo '<div class="mt-4 alert alert-success" role="alert">';
        echo $message;
        echo '</div>';
    }
}


function display_letter_filters($filter)
{
    echo '<span class="d-inline-block mr-3">Filter by <strong>Last Name</strong></span>';

    $letters = range('A', 'Z');

    // loop through all of the entries with the last name starting with the letter clicked 
    // and display the data for each one
    for ($i = 0; $i < count($letters); $i++) {
        if ($filter == $letters[$i]) {
            $class = 'class="d-inline-block text-light font-weight-bold p-1 mr-3 bg-dark"';
        } else {
            $class = 'class="d-inline-block text-secondary p-1 mr-3 bg-light border rounded"';
        }
        echo "<u><a $class href='?filter=$letters[$i]' title='$letters[$i]'>$letters[$i]</a></u>";
    }
    echo '<a class="text-secondary p-2 mr-2 bg-success text-light border rounded" href="?clearfilter" title="Reset Filter">Reset</a>&nbsp;&nbsp;';
}


function display_record_table($result)
{

    echo '<div class="table-responsive">';
    echo "<table class=\"table table-striped table-hover table-sm mt-3 table-bordered\">";
    echo '<thead class="thead-dark"><tr><th class="bg-primary">Actions</th><th><a href="?sortby=student_id">Student ID</a></th><th><a href="?sortby=first_name">First Name</a></th><th><a href="?sortby=last_name">Last Name</a></th><th><a href="?sortby=email">Email</a></th><th><a href="?sortby=phone">Phone</a></th><th><a href="?sortby=degree_program">Degree Program</a></th><th class="text-center"><a href="?sortby=gpa">GPA</a></th><th><a href="?sortby=financial_aid">Financial Aid</a></th><th><a href="?sortby=graduation_date">Graduation Date</a></th></tr></thead>';
    # $row will be an associative array containing one row of data at a time
    while ($row = $result->fetch_assoc()) {
        if ($row['financial_aid'] == '1') {
            $financial_aid = 'Y';
        } else {
            $financial_aid = 'N';
        }
        $gpa = number_format($row['gpa'], 2);
        if ($gpa <= 1.0) {
            $gpa = '<td class="bg-danger text-white text-center">' . $gpa . '</td>';
        } else if ($gpa == 4) {
            $gpa = "<td class=\"text-center text-white bg-success\">$gpa</td>";
        } else {
            $gpa = "<td class=\"bg-warning text-center\">$gpa</td>";
        }
        $graduation_date = $row['graduation_date'];
        if ($graduation_date == '0000-00-00') {
            $graduation_date = 'To be determined';
        }
        # display rows and columns of data
        echo '<tr>';
        echo "<td><a href=\"update-record.php?id={$row['id']}\">Update</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"delete-record.php?id={$row['id']}\" onclick=\"return confirm('Are you sure?');\">Delete</a></td>";
        echo "<td>{$row['sid']}</td>";
        echo "<td><strong>{$row['first_name']}</strong></td>";
        echo "<td><strong>{$row['last_name']}</strong></td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['phone']}</td>";
        echo ($row['degree_program']) ? "<td>{$row['degree_program']}</td>" : '<td>Undeclared</td>';
        echo $gpa;
        echo "<td class=\"text-center\">$financial_aid</td>";
        echo "<td>$graduation_date</td>";
        echo '</tr>';
    } // end while
    // closing table tag and div
    echo '</table>';
    echo '</div>';
}


function display_error_bucket($error_bucket)
{
    echo '<p>The following errors were detected:</p>';
    echo '<div class="pt-4 alert alert-warning" role="alert">';
    echo '<ul>';

    //loop through each of the errors in the error bucket and display on the page
    foreach ($error_bucket as $text) {
        echo '<li>' . $text . '</li>';
    }
    echo '</ul>';
    echo '</div>';
    echo '<p>All of these fields are required. Please fill them in.</p>';
}

function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'active';
}
