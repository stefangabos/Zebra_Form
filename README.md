##Zebra_Form

####A jQuery augmented PHP library for creating and validating HTML forms

Zebra_Form is a PHP library that greatly simplifies the process of creating and validating HTML forms. Its object-oriented structure promotes rapid HTML forms development and encourages developers to write clean and easily maintainable code and it frees the developers from the repetitive task of writing the code for validating forms by offering powerful built-in client-side and server-side validation.

Zebra_Form has integrated [cross-site scripting](http://en.wikipedia.org/wiki/Cross-site_scripting) (XSS) prevention mechanism that automatically strips out potentially malicious code from the submitted data, and also features protection against [cross-site request forgery](http://en.wikipedia.org/wiki/Cross-site_request_forgery) (CSRF) attacks. It also prevents automated SPAM posts, out of the box and without relying on CAPTCHA by using [honeypots](http://haacked.com/archive/2007/09/11/honeypot-captcha.aspx).

Forms layout can be generated either automatically or manually – using templates. When generated automatically, the generated output validates as HTML 4.01 Strict, XHTML 1.0 Strict or HTML5, and has the same look & feel across all major browsers like Firefox, Chrome, Opera, Safari and Internet Explorer 6+.

It provides all the controls you’d expect in an HTML form and, additionally, date/time pickers, CAPTCHA and advanced AJAX-like file upload controls – see the [documentation](http://stefangabos.ro/wp-content/docs/Zebra_Form/Generic/Zebra_Form_Control.html#methodset_rule) for validation rules that can be used out of the box.

The client-side validation is done using jQuery 1.5.2+

Zebra\_Form's code is heavily commented and generates no warnings/errors/notices when PHP’s error reporting level is set to E_ALL.

##Features

- provides protection against cross-site scripting (XSS) and cross-site request forgery (CSRF) attacks out of the box
it automatically prevents automated SPAM posts using the “honeypot” technique (CAPTCHAs can also be used for even stronger protection)
- provides both server-side and client-side validation (client-side validation is done using jQuery 1.5.2+) and has a lot of predefined rules that can be used out of the box; custom validation rules (including AJAX-based) can easily be added
- forms’ layout can be generated either automatically or manually using templates
- generated output validates as HTML 4.01 Strict, XHTML 1.0 Strict or HTML5
- works in all major browsers like Firefox, Chrome, Opera, Safari and Internet Explorer 6+
- code is heavily commented and generates no warnings/errors/notices when PHP’s error reporting level is set to E_ALL
- has comprehensive documentation

## Requirements

PHP 5.0.2+ (preferably PHP 5.3.0 compiled with the “fileinfo” extension for more secure file uploads – read more at the change log for version 2.7.3)

jQuery 1.5.2+

## How to use

#####The HTML

```html
<!-- must be in strict mode! -->
<!DOCTYPE html>

<html>

    <head>

        <title>Zebra_Form Example</title>

        <meta charset="utf-8">

        <!-- load Zebra_Form's stylesheet file -->
        <link rel="stylesheet" href="path/to/zebra_form.css">

    </head>

    <body>

        <!-- the PHP code below goes here -->

        <!-- load jQuery -->
        <script src="path/to/jquery.js"></script>

        <!-- load Zebra_Form's JavaScript file -->
        <script src="path/to/zebra_form.js"></script>

    </body>

</html>
```

#####The PHP

```php
<?php

// include the Zebra_Form class
require 'path/to/Zebra_Form.php';

// instantiate a Zebra_Form object
$form = new Zebra_Form('form');

// the label for the "email" field
$form->add('label', 'label_email', 'email', 'Email');

// add the "email" field
$obj = $form->add('text', 'email', '', array('autocomplete' => 'off'));

// set rules
$obj->set_rule(array(

    // error messages will be sent to a variable called "error", usable in custom templates
    'required'  =>  array('error', 'Email is required!'),
    'email'     =>  array('error', 'Email address seems to be invalid!'),

));

// "password"
$form->add('label', 'label_password', 'password', 'Password');

$obj = $form->add('password', 'password', '', array('autocomplete' => 'off'));

$obj->set_rule(array(

    'required'  => array('error', 'Password is required!'),
    'length'    => array(6, 10, 'error', 'The password must have between 6 and 10 characters'),

));

// "remember me"
$form->add('checkbox', 'remember_me', 'yes');

$form->add('label', 'label_remember_me_yes', 'remember_me_yes', 'Remember me');

// "submit"
$form->add('submit', 'btnsubmit', 'Submit');

// validate the form
if ($form->validate()) {

    // do stuff here

}

// auto generate output, labels above form elements
$form->render();

?>
```

For demos and more information visit the **[project's homepage](http://stefangabos.ro/php-libraries/zebra-form/)**