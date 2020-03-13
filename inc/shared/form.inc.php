<?php // Filename: form.inc.php 
?>

<!-- Note the use of sticky fields below -->
<!-- Note the use of the PHP Ternary operator
Scroll down the page
http://php.net/manual/en/language.operators.comparison.php#language.operators.comparison.ternary
-->

<?php
if (basename($_SERVER['PHP_SELF']) == 'create-record.php') {
    $button_label = "Save New Record";
} else if (basename($_SERVER['PHP_SELF']) == 'update-record.php') {
    $button_label = "Save Updated Record";
} else if (basename($_SERVER['PHP_SELF']) == 'advanced-search.php') {
    $button_label = "Search...";
}
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <!-- <form action="<?php echo $where ?>" method="POST"> -->
    <label class="col-form-label" for="first">First Name </label>
    <!-- the echo issets ternaries make the textboxes sticky -->
    <input class="form-control" type="text" id="first" name="first" placeholder="Enter first name here" value="<?php echo (isset($first) ? $first : ''); ?>">
    <br>
    <label class="col-form-label" for="last">Last Name </label>
    <input class="form-control" type="text" id="last" name="last" placeholder="Enter last name here" value="<?php echo (isset($last) ? $last : ''); ?>">
    <br>
    <label class="col-form-label" for="student_id">Student ID </label>
    <input class="form-control" type="text" id="student_id" name="sid" placeholder="Enter student ID here" value="<?= (isset($sid) ? $sid : ''); ?>">
    <br>
    <label class="col-form-label" for="email">Email </label>
    <input class="form-control" type="email" id="email" name="email" placeholder="Enter a valid email here" value="<?php echo (isset($email) ? $email : ''); ?>">
    <br>
    <label class="col-form-label" for="phone">Phone </label>
    <input class="form-control" type="tel" id="phone" name="phone" placeholder="Phone number 000-000-0000" value="<?php echo (isset($phone) ? $phone : ''); ?>">
    <br>
    <label class="col-form-label" for="degree_program">Degree Program </label>
    <select class="form-control" name="degree_program" id="degree_program">
        <!-- the echo issets ternaries make the form selections sticky  -->
        <option value="" <?= ($degree_program == 'Undeclared') ? 'selected' : '' ?>>Undeclared</option>
        <option value="Web Development" <?php echo ($degree_program == 'Web Development' ? 'selected' : ''); ?>>Web Development</option>
        <option value="Web Design" <?php echo ($degree_program == 'Web Design' ? 'selected' : ''); ?>>Web Design</option>
        <option value="Network Technology" <?php echo ($degree_program == 'Network Technology' ? 'selected' : ''); ?>>Network Technology</option>
        <option value="Computer Support" <?php echo ($degree_program == 'Computer Support' ? 'selected' : ''); ?>>Computer Support</option>
        <option value="Digital Media Arts" <?php echo ($degree_program == 'Digital Media Arts' ? 'selected' : ''); ?>>Digital Media Arts</option>
    </select>
    <br><br>
    <label class="col-form-label" for="gpa">GPA </label>
    <!-- <input class="form-control" type="text" id="gpa" name="gpa" value=""> -->
    <input class="form-control" type="number" step="0.1" min="0" max="4" id="gpa" name="gpa" placeholder="Enter gpa here" value="<?php echo (isset($gpa) ? $gpa : ''); ?>">

    <br>
    <!-- <label class="col-form-label" for="financial_aid">Does the student receive Financial aid </label> -->
    <p>Financial Aid</p>
    <!-- the echo issets ternaries make the buttons sticky   -->
    <!-- <input type="radio" class="form-check-input" name="financial_aid" title="select yes or no" value="yes">Yes -->
    <input type="radio" name="financial_aid" title="select yes or no" id="financial_aid_yes" value="yes" <?php echo $financial_aid_yes == 1 ? 'checked' : '' ?>> Yes
    <br><br>
    <input type="radio" name="financial_aid" title="select yes or no" id="financial_aid_no" value="no" <?php echo $financial_aid_no == 1 ? 'checked' : '' ?>> No
    <br><br>
    <br>
    <label class="col-form-label" for="graduation_date">Graduation Date </label>
    <input class="form-control" type="date" id="graduation_date" name="graduation_date" value="<?= isset($graduation_date) ? $graduation_date : ''; ?>">
    <a href="display-records.php">Cancel</a>&nbsp;&nbsp;
    <button class="btn btn-primary" type="submit"><?= $button_label ?></button>
    <button class="btn btn-info" type="reset">Clear Form</button>
    <input type="hidden" name="id" value="<?php echo (isset($id) ? $id : ''); ?>">
</form>