<h2>A registration form</h2>

<?php

    // include the Zebra_Form class
    require '../Zebra_Form.php';

    // instantiate a Zebra_Form object
    $form = new Zebra_Form('form', 'post', '', array('autocomplete' => 'off'));

    // the label for the "first name" element
    $form->add('label', 'label_firstname', 'firstname', 'First name:');

    // add the "first name" element
    $obj = $form->add('text', 'firstname');

    // set rules
    $obj->set_rule(array(

        // error messages will be sent to a variable called "error", usable in custom templates
        'required'  =>  array('error', 'First name is required!'),

    ));

    // "last name"
    $form->add('label', 'label_lastname', 'lastname', 'Last name:');
    $obj = $form->add('text', 'lastname');
    $obj->set_rule(array(
        'required' => array('error', 'Last name is required!')
    ));

    // "email"
    $form->add('label', 'label_email', 'email', 'Email address:');
    $obj = $form->add('text', 'email');
    $obj->set_rule(array(
        'required'  => array('error', 'Email is required!'),
        'email'     => array('error', 'Email address seems to be invalid!')
    ));

    // attach a note to the email element
    $form->add('note', 'note_email', 'email', 'Please enter a valid email address. An email will be sent to this
    address with a link you need to click on in order to activate your account', array('style'=>'width:200px'));

    // "password"
    $form->add('label', 'label_password', 'password', 'Choose a password:');
    $obj = $form->add('password', 'password');
    $obj->set_rule(array(
        'required'  => array('error', 'Password is required!'),
        'length'    => array(6, 10, 'error', 'The password must have between 6 and 10 characters'),
    ));
    $form->add('note', 'note_password', 'password', 'Password must be have between 6 and 10 characters.');

    // "confirm password"
    $form->add('label', 'label_confirm_password', 'confirm_password', 'Confirm password:');
    $obj = $form->add('password', 'confirm_password');
    $obj->set_rule(array(
        'compare' => array('password', 'error', 'Password not confirmed correctly!')
    ));

    // "captcha"
    $form->add('captcha', 'captcha_image', 'captcha_code');
    $form->add('label', 'label_captcha_code', 'captcha_code', 'Are you human?');
    $obj = $form->add('text', 'captcha_code');
    $form->add('note', 'note_captcha', 'captcha_code', 'You must enter the characters with black color that stand
    out from the other characters', array('style'=>'width: 200px'));
    $obj->set_rule(array(
        'required'  => array('error', 'Enter the characters from the image above!'),
        'captcha'   => array('error', 'Characters from image entered incorrectly!')
    ));

    // "submit"
    $form->add('submit', 'btnsubmit', 'Submit');

    // if the form is valid
    if ($form->validate()) {

        // show results
        show_results();

    // otherwise
    } else

        // generate output using a custom template
        $form->render();

?>