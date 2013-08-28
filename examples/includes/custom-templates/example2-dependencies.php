<?php echo (isset($zf_error) ? $zf_error : (isset($error) ? $error : ''))?>

<div class="row">
    <div class="cell"><?php echo $label_name . $name?></div>
    <div class="cell"><?php echo $label_surname . $surname?></div>
</div>

<div class="row even">
    <h6><strong>Add new person</strong></h6><br>
    <div class="cell"><?php echo $label_add_name . $add_name?></div>
    <div class="cell"><?php echo $label_add_surname . $add_surname?></div>
    <div class="cell"><br><?php echo $btnadd?></div>
</div>

<div class="row last"><?php echo $btnsubmit?></div>