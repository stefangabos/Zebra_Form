<?php
    // don't forget about this for custom templates, or errors will not show for server-side validation
    // $zf_error is automatically created by the library and it holds messages about SPAM or CSRF errors
    // $error is the name of the variable used with the set_rule method
    echo (isset($zf_error) ? $zf_error : (isset($error) ? $error : ''));
?>

<table cellspacing="0" cellpadding="0">

    <!-- elements are grouped in "rows" -->
	<tr class="row">
		<td><?php echo $label_email?></td>
		<td><?php echo $email?></td>
	</tr>

    <!-- notice the "even" class which is used to highlight even rows differently
    from the odd rows -->
	<tr class="row even">
		<td><?php echo $label_password?></td>
		<td><?php echo $password?></td>
	</tr>

    <tr class="row">
        <td></td>
        <td>

            <!-- this is the preffered way of displaying checkboxes and
            radio buttons and their associated label -->
            <div class="cell"><?php echo $remember_me_yes?></div>
            <div class="cell"><?php echo $label_remember_me_yes?></div>

            <!-- once we're done with "cells" we *must* place a "clear" div -->
            <div class="clear"></div>

        </td>
    </tr>

    <!-- the submit button goes in the last row; also, notice the "last" class which
    removes the bottom border which is otherwise present for any row -->
    <tr class="row even last">
        <td></td>
        <td><?php echo $btnsubmit?></td>
    </tr>

</table>