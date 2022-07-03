<?php

/**
 *  Create `<input type="hidden">` form elements
 *
 *  @author     Stefan Gabos <contact@stefangabos.ro>
 *  @copyright  © 2006 - 2022 Stefan Gabos
 *  @package    Elements
 */
class Zebra_Form_Hidden extends Zebra_Form_Shared {

    /**
     *  Create `<input type="hidden">` form elements.
     *
     *  >   Do not instantiate this class directly!<br>
     *      Use the {@link Zebra_Form::add() add()} method instead!
     *
     *  <code>
     *
     *  // create a new form
     *  $form = new Zebra_Form('my_form');
     *
     *  // add a hidden element to the form
     *  $form->add('hidden', 'my_hidden', 'Secret value');
     *
     *  // this method needs to be called before rendering the form
     *  if ($form->validate()) {
     *
     *      // do stuff
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
     *                                  The element's `name` attribute will be the same as the `id` attribute.
     *
     *                                  This is the name to be used for accessing the element's value in {@link https://www.php.net/manual/en/reserved.variables.post.php $_POST} /
     *                                  {@link https://www.php.net/manual/en/reserved.variables.get.php $_GET}, after the
     *                                  form is submitted.
     *
     *                                  >   Hidden elements are automatically rendered when calling the
     *                                      {@link Zebra_Form::render() render()} method!<br>
     *                                      Do not output them manually in the template file!
     *
     *  @param  string  $default        (Optional) Default value of the element.
     *
     *  @return void
     */
    function __construct($id, $default = '') {

        // call the constructor of the parent class
        parent::__construct();

        // set private attributes, for internal use only
        // (will not be rendered by the _render_attributes() method)
        $this->private_attributes = array(
            'disable_xss_filters',
            'locked',
        );

        // set the default attributes

        // note that if the element's name is 'MAX_FILE_SIZE' we will generate a random ID attribute for the element
        // as, with multiple forms having file upload elements on them, this element will appear as many times as the
        // forms, and we don't want to have the same ID assigned to multiple elements
        $this->set_attributes(array(
            'type'  =>  'hidden',
            'name'  =>  $id,
            'id'    =>  ($id != 'MAX_FILE_SIZE' ? str_replace(array('[', ']'), '', $id) : 'mfs_' . rand(0, 100000)),
            'value' =>  $default,
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

        return '<input ' . $this->_render_attributes() . ($this->form_properties['doctype'] == 'xhtml' ? '/' : '') . '>';

    }

}
