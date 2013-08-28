<?php
    // don't forget about this for custom templates, or errors will not show for server-side validation
    // $zf_error is automatically created by the library and it holds messages about SPAM or CSRF errors
    // $error is the name of the variable used with the set_rule method
    echo (isset($zf_error) ? $zf_error : (isset($error) ? $error : ''));
?>

<!-- elements are grouped in "rows" -->
<div class="row">

    <!-- things that need to be side-by-side go in "cells" and will be floated to the left -->
    <div class="cell"><?php echo $label_firstname . $firstname?></div>
    <div class="cell"><?php echo $label_lastname . $lastname?></div>

</div>

<!-- notice the "even" class which is used to highlight even rows differently
from the odd rows -->
<div class="row even"><?php echo $label_email . $email . $note_email?></div>

<div class="row">
    <div class="cell"><?php echo $label_password . $password . $note_password?></div>
    <div class="cell"><?php echo $label_confirm_password . $confirm_password?></div>
</div>

<div class="row even">
    <?php echo $captcha_image . $label_captcha_code . $captcha_code . $note_captcha?>
</div>

<!-- the submit button goes in the last row; also, notice the "last" class which
removes the bottom border which is otherwise present for any row -->
<div class="row even last"><?php echo $btnsubmit?></div>