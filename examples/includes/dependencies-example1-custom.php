<h2>Dependencies</h2>

<p>Showcasing how elements can be validated only if other elements meet certain conditions and how callback functions for the "dependencies" rule work.</p>

<?php

     // include the Zebra_Form class
    require '../Zebra_Form.php';

    // instantiate a Zebra_Form object
    $form = new Zebra_Form('form');

    // add the "name" element
    $form->add('label', 'label_name', 'name', 'Your name');
    $obj = $form->add('text', 'name');

    // set rules
    $obj->set_rule(array(
        'required'  => array('error', 'Name is required!'),
    ));

    // "notifications"
    $form->add('label', 'label_notifications', 'notifications', 'Would you like to be informed about promotional offers?');
    $obj = $form->add('radios', 'notifications', array(
        'yes'   =>  'Yes',
        'no'    =>  'No',
    ));
    $obj->set_rule(array(
        'required'  =>  array('error', 'Please select an answer!'),
    ));

    // "method"
    $form->add('label', 'label_method', 'method', 'Please specify how you would like to be notified about promotional offers:');
    $obj = $form->add('checkboxes', 'method[]', array(
        'email' =>  'By e-mail',
        'phone' =>  'By phone',
        'post'  =>  'By land mail',
    ));
    $obj->set_rule(array(
        'required'  =>  array('error', 'Please specify how you would like to be notified about promotional offers!'),
        'dependencies'   =>  array(array(
            'notifications' =>  'yes',
        // whenever the value of "notification" changes, call this function and pass as second argument the value "1"
        ), 'mycallback, 1'),
    ));

    // "email"
    $form->add('label', 'label_email', 'email', 'Your email address:');
    $obj = $form->add('text', 'email');
    $obj->set_rule(array(
        'required'  =>  array('error', 'Email is required!'),
        'email'     =>  array('error', 'Email address seems to be invalid!'),
        'dependencies'   =>  array(array(
            'method'        =>  'email',
        ), 'mycallback, 2'),
    ));
    $form->add('note', 'note_email', 'email', 'Your email address will not be published.');

    // "phone"
    $form->add('label', 'label_phone', 'phone', 'Your telephone number:');
    $obj = $form->add('text', 'phone');
    $obj->set_rule(array(
        'required'  =>  array('error', 'Phone number is required!'),
        'digits'    =>  array('', 'error', 'Phone number must contain only digits!'),
        'dependencies'   =>  array(array(
            'method'    =>  'phone',
        ), 'mycallback, 3'),
    ));
    $form->add('note', 'note_phone', 'phone', 'Enter your phone number using digits only');

    // "post"
    $form->add('label', 'label_post', 'post', 'Your postal address:');
    $obj = $form->add('text', 'post');
    $obj->set_rule(array(
        'required'  =>  array('error', 'Postal address is required!'),
        'dependencies'   =>  array(array(
            'method'    =>  'post',
        ), 'mycallback, 4'),
    ));
    $form->add('note', 'note_post', 'post', 'Enter the address where the notifications about promotional offers should be delivered');

    // "why"
    $form->add('label', 'label_why', 'why', 'Please tell us why:');
    $obj = $form->add('textarea', 'why');
    $obj->set_rule(array(
        'required'  =>  array('error', 'Please leave us a message!'),
        'dependencies'   =>  array(array(
            'notifications' =>  'no',
        ), 'mycallback, 5'),
    ));

    // "submit"
    $form->add('submit', 'btnsubmit', 'Submit');

    // if the form is valid
    if ($form->validate()) {

        // show results
        show_results();

    // otherwise
    } else

        $form->render('includes/custom-templates/example1-dependencies.php');

?>
