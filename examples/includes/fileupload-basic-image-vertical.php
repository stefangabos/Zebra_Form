<h2>Basic image upload</h2>

<p>We're checking for file types </p>

<?php

    // include the Zebra_Form class
    require '../Zebra_Form.php';

    // instantiate a Zebra_Form object
    $form = new Zebra_Form('form');

    // the label for the "file" element
    $form->add('label', 'label_file', 'file', 'Upload an image');

    // add the "file" element
    $obj = $form->add('file', 'file');

    // set rules
    $obj->set_rule(array(

        // error messages will be sent to a variable called "error", usable in custom templates
        'required'  =>  array('error', 'An image is required!'),
        'upload'    =>  array('tmp', ZEBRA_FORM_UPLOAD_RANDOM_NAMES, 'error', 'Could not upload file!<br>Check that the "tmp" folder exists inside the "examples" folder and that it is writable'),

        // notice how we use the "image" rule instead of the "filetype" rule (used in previous example);
        // the "image" rule does a thorough checking aimed specially for images
        'image'  =>  array('error', 'File must be a jpg, png or gif image!'),
        'filesize'  =>  array(102400, 'error', 'File size must not exceed 100Kb!'),

    ));

    // attach a note
    $form->add('note', 'note_file', 'file', 'File must have the .jpg, .jpeg, png or .gif extension, and no more than 100Kb!');

    // "submit"
    $form->add('submit', 'btnsubmit', 'Submit');

    // validate the form
    if ($form->validate()) {

        // do stuff here
        print_r('<pre>');
        print_r($form->file_upload);
        die();

    }

    // auto generate output, labels above form elements
    $form->render();

?>