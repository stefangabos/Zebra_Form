<?php

/**
 *  Creates {@link https://en.wikipedia.org/wiki/CAPTCHA CAPTCHA} form elements
 *
 *  @author     Stefan Gabos <contact@stefangabos.ro>
 *  @copyright  © 2006 - 2022 Stefan Gabos
 *  @package    Elements
 */
class Zebra_Form_Captcha extends Zebra_Form_Shared {

    /**
     *  Adds a `CAPTCHA` image to the form.
     *
     *  >   Do not instantiate this class directly!<br>
     *      Use the {@link Zebra_Form::add() add()} method instead!
     *
     *  >   You must also place a {@link Zebra_Form_Text text input} element on the form and configure the `captcha`
     *      rule for it via {@link set_rule()}.
     *
     *  Default properties of the CAPTCHA image can be altered by editing the file `process.php`.
     *
     *  Captcha values are hashed and stored, by default, in `cookies`. When the user enters the captcha value, the entered
     *  value is also hashed and then compared against the stored value. Users may have restrictive cookie policies and
     *  cookies might not be allowed, resulting in users never being able to get past the CAPTCHA test. If so, use
     *  {@link Zebra_Form::captcha_storage() captcha_storage} and set the storage method to `session`.
     *
     *  <code>
     *
     *  // create a new form
     *  $form = new Zebra_Form('my_form');
     *
     *  // add a CAPTCHA image
     *  $form->add('captcha', 'my_captcha', 'user_input');
     *
     *  // add a label for the text input
     *  $form->add('label', 'label_user_input', 'user_input', 'Are you a human?');
     *
     *  // add a text input where the user will input the
     *  // characters shown in the CAPTCHA image
     *  $element = $form->add('text', 'user_input');
     *
     *  // set the "captcha" rule
     *  $element->set_rule(array(
     *      'captcha' => array('error', 'Characters not entered correctly!')
     *  ));
     *
     *  // this method needs to be called before rendering the form
     *  if ($form->validate()) {
     *
     *      // do stuff here
     *
     *  }
     *
     *  // generate the form
     *  $output = $form->render('my-template', true);
     *
     *  </code>
     *
     *  @param  string  $id             Unique name to identify the element in the form.
     *
     *                                  >   The name must resolve to a valid `PHP` variable. As per PHP documentation, a
     *                                      valid variable name starts with a letter or underscore, followed by any number
     *                                      of letters, numbers, or underscores
     *
     *                                  This is the name of the variable to be used in the template file for displaying
     *                                  the element.
     *
     *                                  <code>
     *                                  // in a template file, in order to output the element's HTML code
     *                                  // for an element named "my_captcha", one would use:
     *                                  echo $my_captcha;
     *                                  </code>
     *
     *  @param  string  $input_element  The `id` attribute of an {@link Zebra_Form_Text text input} element to associate
     *                                  the CAPTCHA image with.
     *
     *  @return void
     */
    function __construct($id, $input_element) {

        // call the constructor of the parent class
        parent::__construct();

        // set private attributes, for internal use only
        // (will not be rendered by the _render_attributes() method)
        $this->private_attributes = array(
            'disable_xss_filters',
            'for',
            'locked',
        );

        // set the default attributes
        $this->set_attributes(array(
            'type'  =>  'captcha',
            'name'  =>  $id,
            'id'    =>  $id,
            'for'   =>  $input_element,
        ));

    }

    /**
     *  Generates the form element's HTML code.
     *
     *  >   This method is automatically called by the {@link Zebra_Form::render() render()} method.
     *
     *  @return string  Returns the form element's generated HTML code.
     */
    function toHTML() {

        return '<div class="zebraform-captcha"><img src="' . $this->form_properties['assets_url'] . 'process.php?captcha=' . ($this->form_properties['captcha_storage'] == 'session' ? 2 : 1) . '&amp;nocache=' . time() . '" alt=""' . ($this->form_properties['doctype'] == 'xhtml' ? '/' : '') . '><a href="javascript:void(0)" title="' . $this->form_properties['language']['new_captcha'] . '">' . $this->form_properties['language']['new_captcha'] . '</a></div>';

    }

}
