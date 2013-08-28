<?php
    // don't forget about this for custom templates, or errors will not show for server-side validation
    // $zf_error is automatically created by the library and it holds messages about SPAM or CSRF errors
    // $error is the name of the variable used with the set_rule method
    echo (isset($zf_error) ? $zf_error : (isset($error) ? $error : ''));
?>

<!-- elements are grouped in "rows" -->
<div class="row">

    <!-- things that need to be side-by-side go in "cells" and will be floated to the left -->
    <div class="cell"><?php echo $label_name . $name?></div>
    <div class="cell"><?php echo $label_email . $email . $note_email?></div>

</div>

<!-- notice the "even" class which is used to highlight even rows differently
from the odd rows -->
<div class="row even"><?php echo $label_website . $website . $note_website?></div>

<div class="row"><?php echo $label_subject . $subject?></div>

<div class="row even"><?php echo $label_message . $message?></div>

<!-- the submit button goes in the last row; also, notice the "last" class which
removes the bottom border which is otherwise present for any row -->
<div class="row last"><?php echo $btnsubmit?></div>