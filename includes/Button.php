<?php

/**
 *  Creates `<button>` form elements
 *
 *  @author     Stefan Gabos <contact@stefangabos.ro>
 *  @copyright  © 2006 - 2022 Stefan Gabos
 *  @package    Elements
 */
class Zebra_Form_Button extends Zebra_Form_Shared {

    /**
     *  Create `<button>` form elements.
     *
     *  >   Do not instantiate this class directly!<br>
     *      Use the {@link Zebra_Form::add() add()} method instead!
     *
     *  <code>
     *
     *  // create a new form
     *  $form = new Zebra_Form('my_form');
     *
     *  // add a submit button to the form
     *  $form->add('button', 'my_button', 'Click me!', 'submit');
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
     *                                  >   The name must resolve to a valid `PHP` variable. As per PHP documentation, a
     *                                      valid variable name starts with a letter or underscore, followed by any number
     *                                      of letters, numbers, or underscores
     *
     *                                  The element's `name` attribute will be the same as the `id` attribute (with `[`
     *                                  and `]` removed, if it is the case).
     *
     *                                  This is the name to be used for accessing the element's value in {@link https://www.php.net/manual/en/reserved.variables.post.php $_POST} /
     *                                  {@link https://www.php.net/manual/en/reserved.variables.get.php $_GET}, after the
     *                                  form is submitted.
     *
     *                                  This is also the name of the variable to be used in the template file for
     *                                  displaying the element.
     *
     *                                  <code>
     *                                  // in a template file, in order to output the element's HTML code
     *                                  // for an element named "my_button", one would use:
     *                                  echo $my_button;
     *                                  </code>
     *
     *  @param  string  $content        Content of the button element.
     *
     *                                  Can be HTML markup.
     *
     *  @param  string  $type           (Optional) Type of the button.
     *
     *                                  Valid values are `button`, `submit` and `reset`.
     *
     *                                  Default is `button`.
     *
     *  @param  array   $attributes     (Optional) An array of attributes valid for
     *                                  {@link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/button#attributes button}
     *                                  form elements (like `disabled`, `readonly`, `style`, etc.).
     *
     *                                  Must be specified as an associative array, in the form of *attribute => value*.
     *
     *                                  <code>
     *                                  // setting the "disabled" attribute
     *                                  $form->add(
     *                                      'button',
     *                                      'my_button',
     *                                      'Click me!',
     *                                      'submit'  // <- make this a submit button
     *                                      array(
     *                                          'disabled'  =>  true,
     *                                      )
     *                                  );
     *                                  </code>
     *
     *                                  Attributes may also be set after the form element is created with the
     *                                  {@link Zebra_Form_Shared::set_attributes() set_attributes()} method.
     *
     *                                  The following attributes are automatically set when the form element is created
     *                                  and should not be altered manually: `id`, `name`.
     *
     *  @return void
     */
    function __construct($id, $content, $type = 'button', $attributes = '') {

        // call the constructor of the parent class
        parent::__construct();

        // set private attributes, for internal use only
        // (will not be rendered by the _render_attributes() method)
        $this->private_attributes = array(
            'disable_xss_filters',
            'locked',
            'value',
        );

        // set the default attributes
        $this->set_attributes(array(
            'type'  =>  $type,
            'name'  =>  $id,
            'id'    =>  str_replace(array('[', ']'), '', $id),
            'value' =>  $content,
            'class' =>  'zebra-form-button' . ($type != 'button' ? ' ' . $type : ''),
        ));

        // if "class" is among the user specified attributes
        if (is_array($attributes) && isset($attributes['class'])) {

            // we need to set the "class" attribute like this, so it doesn't overwrite the default values
            $this->set_attributes(array('class' => $attributes['class']), false);

            // make sure we don't set it again below
            unset($attributes['class']);

        }

        // set user specified attributes
        $this->set_attributes($attributes);

    }

    /**
     *  Generates the form element's HTML code.
     *
     *  >   This method is automatically called by the {@link Zebra_Form::render() render()} method.
     *
     *  @return string  Returns the form element's generated HTML code.
     */
    function toHTML() {

        return '<button ' . $this->_render_attributes() . ($this->form_properties['doctype'] == 'xhtml' ? '/' : '') . '>' . $this->attributes['value'] . '</button>';

    }

}
