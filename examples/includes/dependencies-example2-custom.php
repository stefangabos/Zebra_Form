<h2>Dependencies</h2>

<p>Notice how the elements from the "Add new person" section are validated *only* when the "Add new" button is clicked</p>

<?php

     // include the Zebra_Form class
    require '../Zebra_Form.php';

    // instantiate a Zebra_Form object
    $form = new Zebra_Form('form');

    // add the "name" element
    $form->add('label', 'label_name', 'name', 'Name');
    $obj = $form->add('text', 'name');

    // set rules
    $obj->set_rule(array(
        'required'  => array('error', 'Name is required!'),
    ));

    // add the "surname" element
    $form->add('label', 'label_surname', 'surname', 'Surname');
    $obj = $form->add('text', 'surname');

    // set rules
    $obj->set_rule(array(
        'required'  => array('error', 'Surname is required!'),
    ));

    // elements for adding a new person

    // add the "name" element
    $form->add('label', 'label_add_name', 'add_name', 'Name');
    $obj = $form->add('text', 'add_name');

    // set rules
    // validate *only* if the "Add new" button is clicked
    $obj->set_rule(array(
        'required'  => array('error', 'Name is required!'),
        'dependencies'  =>  array(
            'btnadd'    =>  'click',
        ),
    ));

    // add the "surname" element
    $form->add('label', 'label_add_surname', 'add_surname', 'Surame');
    $obj = $form->add('text', 'add_surname');

    // set rules
    $obj->set_rule(array(
        'required'  => array('error', 'Surname is required!'),
        'dependencies'  =>  array(
            'btnadd'    =>  'click',
        ),
    ));

    // "add"
    $form->add('submit', 'btnadd', 'Add new');

    // "submit"
    $form->add('submit', 'btnsubmit', 'Finish');

    // if the form is valid
    if ($form->validate()) {

        // show results
        show_results();

    // otherwise
    } else

        $form->render('includes/custom-templates/example2-dependencies.php');

?>
