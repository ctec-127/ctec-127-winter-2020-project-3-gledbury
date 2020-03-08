<?php // Filename: form.inc.php 
?>

<!-- Note the use of sticky fields below -->
<!-- Note the use of the PHP Ternary operator
Scroll down the page
http://php.net/manual/en/language.operators.comparison.php#language.operators.comparison.ternary
-->
<?php

//var_dump($_POST);
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <label class="col-form-label" for="first">First Name </label>
    <!-- the echo issets ternaries make the textboxes sticky -->
    <input class="form-control" type="text" id="first" name="first" value="<?php echo (isset($first) ? $first : ''); ?>">
    <br>
    <label class="col-form-label" for="last">Last Name </label>
    <input class="form-control" type="text" id="last" name="last" value="<?php echo (isset($last) ? $last : ''); ?>">
    <br>
    <label class="col-form-label" for="sid">Student ID </label>
    <input class="form-control" type="text" id="sid" name="sid" value="<?php echo (isset($sid) ? $sid : ''); ?>">
    <br>
    <label class="col-form-label" for="email">Email </label>
    <input class="form-control" type="text" id="email" name="email" value="<?php echo (isset($email) ? $email : ''); ?>">
    <br>
    <label class="col-form-label" for="phone">Phone </label>
    <input class="form-control" type="text" id="phone" name="phone" value="<?php echo (isset($phone) ? $phone : ''); ?>">
    <br>
    <label class="col-form-label" for="degree_program">Degree Program </label>
    <br>
    <select name="degree_program" id="degree_program">
        <!-- the echo issets ternaries make the form selections sticky  -->
        <option value="" <?php echo (isset($degree_program) ? $degree_program : ''); ?>>--Select--</option>
        <option value="Web Development" <?php echo ($degree_program == 'Web Development' ? 'selected' : ''); ?>>Web Development</option>
        <option value="Web Design" <?php echo ($degree_program == 'Web Design' ? 'selected' : ''); ?>>Web Design</option>
        <option value="Network Technology" <?php echo ($degree_program == 'Network Technology' ? 'selected' : ''); ?>>Network Technology</option>
        <option value="Computer Support" <?php echo ($degree_program == 'Computer Support' ? 'selected' : ''); ?>>Computer Support</option>
        <option value="Digital Media Arts" <?php echo ($degree_program == 'Digital Media Arts' ? 'selected' : ''); ?>>Digital Media Arts</option>
    </select>
    <br><br>
    <label class="col-form-label" for="gpa">GPA </label>
    <input class="form-control" type="text" id="gpa" name="gpa" value="<?php echo (isset($gpa) ? $gpa : ''); ?>">
    <br>
    <label class="col-form-label" for="financial_aid">Do You Receive Financial aid </label>
    <br>
    <!-- the echo issets ternaries make the buttons sticky   -->
    <input type="radio" class="form-check-input" name="financial_aid" title="select yes or no" value="1" <?php echo $yes; ?>>Yes
    <br><br>
    <input type="radio" class="form-check-input" name="financial_aid" title="select yes or no" value="0" <?php echo $no; ?>>No
    <br>
    <label class="col-form-label" for="grdate">Graduation Date </label>
    <input class="form-control" type="date" id="grdate" name="grdate" value="<?php echo (isset($grdate) ? $grdate : ''); ?>">
    <a href="display-records.php">Cancel</a>&nbsp;&nbsp;
    <button class="btn btn-primary" type="submit">Save Record</button>
    <input type="hidden" name="id" value="<?php echo (isset($id) ? $id : ''); ?>">
</form>