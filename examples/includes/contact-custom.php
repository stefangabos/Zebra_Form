<h2>A contact form</h2>

<p>Note the uneditable prefixes (text and images) for some of the fields.</p>

<p>Check the "Template source" tab to see how it's done!</p>

<?php

    // include the Zebra_Form class
    require '../Zebra_Form.php';

    // instantiate a Zebra_Form object
    $form = new Zebra_Form('form');

    // the label for the "name" element
    $form->add('label', 'label_name', 'name', 'Your name:');

    // add the "name" element
    $obj = $form->add('text', 'name', '', array('style' => 'width: 195px', 'data-prefix' => 'img:public/images/user.png'));

    // set rules
    $obj->set_rule(array(

        // error messages will be sent to a variable called "error", usable in custom templates
        'required' => array('error', 'Name is required!')

    ));

    // "email"
    $form->add('label', 'label_email', 'email', 'Your email address:');
    $obj = $form->add('text', 'email', '', array('style' => 'width: 195px', 'data-prefix' => 'img:public/images/letter.png'));
    $obj->set_rule(array(
        'required'  =>  array('error', 'Email is required!'),
        'email'     =>  array('error', 'Email address seems to be invalid!'),
    ));
    $form->add('note', 'note_email', 'email', 'Your email address will not be published.');

    // "website"
    $form->add('label', 'label_website', 'website', 'Your website:');
    $obj = $form->add('text', 'website', '', array('style' => 'width: 400px', 'data-prefix' => 'http://'));
    $obj->set_rule(array(
        'url'   =>  array(true, 'error', 'Invalid URL specified!'),
    ));
    $form->add('note', 'note_website', 'website', 'Enter the URL of your website, if you have one.');

    // "subject"
    $form->add('label', 'label_subject', 'subject', 'Subject');
    $obj = $form->add('text', 'subject', '', array('style' => 'width: 400px', 'data-prefix' => 'img:public/images/comment.png'));
    $obj->set_rule(array(
        'required' => array('error', 'Subject is required!')
    ));

    // "message"
    $form->add('label', 'label_message', 'message', 'Message:');
    $obj = $form->add('textarea', 'message');
    $obj->set_rule(array(
        'required'  => array('error', 'Message is required!'),
        'length'    => array(0, 140, 'error', 'Maximum length is 140 characters!', true),
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
        $form->render('includes/custom-templates/contact.php');

?>