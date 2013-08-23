<h2>More validation rules</h2>

<?php

    // include the Zebra_Form class
    require '../Zebra_Form.php';

    // instantiate a Zebra_Form object
    $form = new Zebra_Form('form');

    // "alphabet"
    $form->add('label', 'label_alphabet', 'alphabet', 'Alphabet:');

    $obj = $form->add('text', 'alphabet');

    // set rules
    $obj->set_rule(array(

        // error messages will be sent to a variable called "error", usable in custom templates
        'required'  => array('error', 'This field is required!'),
        'alphabet'  => array('', 'error', 'Accepts only characters from the alphabet (case-insensitive a to z)')

    ));

    // attach a note
    $form->add('note', 'note_alphabet', 'alphabet', 'Accepts only characters from the alphabet (case-insensitive a to z)');

    // "alphanumeric"
    $form->add('label', 'label_alphanumeric', 'alphanumeric', 'Alphanumeric:');
    $obj = $form->add('text', 'alphanumeric');
    $obj->set_rule(array(
        'required'      => array('error', 'This field is required!'),
        'alphanumeric'  => array('', 'error', 'Accepts only characters from the alphabet (case-insensitive a to z) and digits (0 to 9)')
    ));
    $form->add('note', 'note_alphanumeric', 'alphanumeric', 'Accepts only characters from the alphabet (case-insensitive a to z) and digits (0 to 9)');

    // "digits"
    $form->add('label', 'label_digits', 'digits', 'Digits:');
    $obj = $form->add('text', 'digits');
    $obj->set_rule(array(
        'required'  => array('error', 'This field is required!'),
        'digits'    => array('', 'error', 'Accepts only digits (0 to 9)')
    ));
    $form->add('note', 'note_digits', 'digits', 'Accepts only digits (0 to 9)');

    // "float"
    $form->add('label', 'label_float', 'float', 'Float:');
    $obj = $form->add('text', 'float');
    $obj->set_rule(array(
        'required'  => array('error', 'This field is required!'),
        'float'     => array('', 'error', 'Accepts only digits (0 to 9) and/or one dot (but not as the very first character) and/or one minus sign (but only if it is the very first character)')
    ));
    $form->add('note', 'note_float', 'float', 'Accepts only digits (0 to 9) and/or one dot (but not as the very first character) and/or one minus sign (but only if it is the very first character)');

    // "length"
    $form->add('label', 'label_length', 'length', 'Length:');
    $obj = $form->add('text', 'length');
    $obj->set_rule(array(
        'required'  => array('error', 'This field is required!'),
        'length'    => array(6, 12, 'error', 'Must contain between 6 and 12 characters!')
    ));
    $form->add('note', 'note_length', 'length', 'Must contain between 6 and 12 characters');

    // "number"
    $form->add('label', 'label_number', 'number', 'Number:');
    $obj = $form->add('text', 'number');
    $obj->set_rule(array(
        'required'  => array('error', 'This field is required!'),
        'number'    => array('', 'error', 'Accepts only digits (0 to 9) and/or one minus sign (but only if it is the very first character)')
    ));
    $form->add('note', 'note_number', 'number', 'Accepts only digits (0 to 9) and/or one minus sign (but only if it is the very first character)');

    // "regular expression"
    $form->add('label', 'label_regexp', 'regexp', 'Regular expression:');
    $obj = $form->add('text', 'regexp');
    $obj->set_rule(array(
        'required'  => array('error', 'This field is required!'),
        'regexp'    => array('^07[0-9]{8}$', 'error', 'Validates only if the value matches the following regular expression: ^07[0-9]{8}$')
    ));
    $form->add('note', 'note_regexp', 'regexp', 'Validates if the value satisfies the following regular expression: ^07[0-9]{8}$');

    // "change case"
    $form->add('label', 'label_case', 'case', 'Change case:');
    $obj = $form->add('text', 'case');
    $obj->set_rule(array(
        'required'  => array('error', 'This field is required!'),
    ));
    // force all characters to be upper-case
    $obj->change_case('upper');
    $form->add('note', 'note_case', 'case', 'All entered characters will be upper-case');

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