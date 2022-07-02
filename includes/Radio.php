<?php

/**
 *  Create `<input type="radio">` form elements
 *
 *  @author     Stefan Gabos <contact@stefangabos.ro>
 *  @copyright  © 2006 - 2022 Stefan Gabos
 *  @package    Elements
 */
class Zebra_Form_Radio extends Zebra_Form_Shared {

    /**
     *  Create `<input type="radio">` form elements.
     *
     *  >   Do not instantiate this class directly!<br>
     *      Use the {@link Zebra_Form::add() add()} method instead!
     *
     *  <code>
     *  // create a new form
     *  $form = new Zebra_Form('my_form');
     *
     *  // single radio button
     *  $form->add('radio', 'my_radio', 'value');
     *
     *  // multiple radio buttons
     *  // note that is "radios" instead of "radio"
     *  // the "value" attribute will be "0", "1" and "2", respectively,
     *  // and will be available in the template file like
     *  // "my_radio_0", "my_radio_1" and "my_radio_2".
     *  // label elements will be automatically created having the names "label_my_radio_0", "label_my_radio_1" and
     *  // "label_my_radio_2" (the word "label" + underscore + element name + underscore + value, with anything else
     *  // other than alphanumeric characters replaced with underscores - also, note that multiple consecutive underscores
     *  // will be replaced by a single one)
     *  $form->add('radios', 'my_radio',
     *      array(
     *          'Value 1',
     *          'Value 2',
     *          'Value 3',
     *      )
     *  );
     *
     *  // multiple radio buttons with specific value attributes
     *  // the "value" attribute will be "v1", "v2" and "v3", respectively,
     *  // and will be available in the template file like
     *  // "my_radio_v1", "my_radio_v2" and "my_radio_v3".
     *  // label elements will be automatically created having the names "label_my_radio_v1", "label_my_radio_v2" and
     *  // "label_my_radio_v3" (the word "label" + underscore + element name + underscore + value, with anything else
     *  // other than alphanumeric characters replaced with underscores - also, note that multiple consecutive underscores
     *  // will be replaced by a single one)
     *  $form->add('radios', 'my_radio',
     *      array(
     *          'v1' => 'Value 1',
     *          'v2' => 'Value 2',
     *          'v3' => 'Value 3',
     *      )
     *  );
     *
     *  // multiple radios with preselected value
     *  $form->add('radios', 'my_radio',
     *      array(
     *          'v1' => 'Value 1',
     *          'v2' => 'Value 2',,
     *          'v3' => 'Value 3'
     *      ),
     *      'v2'    // "Value 2" will be preselected
     *  );
     *
     *  // multiple radio buttons with preselected value
     *  $form->add('radios', 'my_radio',
     *      array(
     *          'Value 1',
     *          'Value 2',
     *          'Value 3'
     *      ),
     *      1    // "Value 2" will be preselected
     *  );
     *
     *  // multiple radio buttons with multiple preselected values
     *  $form->add('radios', 'my_radio[]',
     *      array(
     *          'v1' => 'Value 1',
     *          'v2' => 'Value 2',
     *          'v3' => 'Value 3',
     *      ),
     *      array('v2', 'v3')
     *  );
     *
     *  // custom classes (or other attributes) can also be added to all of the elements by specifying a 4th argument;
     *  // this needs to be specified in the same way as you would by calling the set_attributes() method:
     *  $form->add('radios', 'my_radio[]',
     *      array(
     *          '1' => 'Value 1',
     *          '2' => 'Value 2',
     *          '3' => 'Value 3',
     *      ),
     *      '', // no default value
     *      array('class' => 'my_custom_class')
     *  );
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
     *  >   By default, for {@link Zebra_Form_Checkbox checkboxes}, radio buttons and {@link Zebra_Form_Select select boxes},
     *      the library will prevent the submission of values other than those declared when creating the elements, by
     *      triggering a **SPAM attempt detected!** error. Therefore, if you plan on adding/removing values dynamically
     *      from JavaScript, you will have to call {@link Zebra_Form_Shared::disable_spam_filter() disable_spam_filter()}
     *      in order to prevent that from happening!
     *
     *  @param  string  $id             Unique name to identify the element in the form.
     *
     *                                  >   `$id` needs to be suffixed with square brackets if there are more radio
     *                                      buttons sharing the same name, so that PHP treats them as an array.
     *
     *                                  The element's `name` attribute will the same as `$id`, while the element's `id`
     *                                  attribute will be the value of `$id`, stripped of square brackets (if any), followed
     *                                  by an underscore and followed by the element's `$value` with any spaces replaced
     *                                  by *underscores*.
     *
     *                                  So, if `$id` is "my_radio" and `$value` is "value 1", the element's `id`
     *                                  attribute will be `my_radio_value_1`.
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
     *                                  // for an element named "my_radio" and having the value of "value 1",
     *                                  // one would use:
     *                                  echo $my_radio_value_1;
     *                                  </code>
     *
     *                                  >   Note that when adding the **"required"** {@link set_rule() rule} to a group
     *                                      of radio buttons (radio buttons sharing the same name), it is sufficient to
     *                                      add the rule to the first radio button.
     *
     *  @param  mixed   $value          Value of the radio button.
     *
     *  @param  array   $attributes     (Optional) An array of attributes valid for
     *                                  {@link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/radio radio input}
     *                                  form elements (like `disabled`, `readonly`, `style`, etc.).
     *
     *                                  Must be specified as an associative array, in the form of *attribute => value*.
     *
     *                                  <code>
     *                                  // setting the "checked" attribute
     *                                  $form->add(
     *                                      'radio',
     *                                      'my_radio',
     *                                      'radio_value',
     *                                      array(
     *                                          'checked'  =>  true,
     *                                      )
     *                                  );
     *                                  </code>
     *
     *                                  Attributes may also be set after the form element is created with the
     *                                  {@link Zebra_Form_Shared::set_attributes() set_attributes()} method.
     *
     *                                  The following attributes are automatically set when the form element is created
     *                                  and should not be altered manually: `id`, `name`, `type`, `value`, `class`.
     *
     *  @return void
     */
    function __construct($id, $value, $attributes = '') {

        // call the constructor of the parent class
        parent::__construct();

        // set private attributes, for internal use only
        // (will not be rendered by the _render_attributes() method)
        $this->private_attributes = array(
            'disable_spam_filter',
            'disable_xss_filters',
            'locked',
        );

        // set the default attributes
        $this->set_attributes(array(
            'type'  =>  'radio',
            'name'  =>  $id,
            'id'    =>  str_replace(array(' ', '[', ']'), array('_', ''), $id) . '_' . preg_replace('/[^a-z0-9\_]/i', '_', $value),
            'value' =>  $value,
            'class' =>  'zebraform-control zebraform-radio',
        ));

        // if "class" is among user specified attributes
        if (is_array($attributes) && isset($attributes['class'])) {

            // we need to set the "class" attribute like this, so it doesn't overwrite previous values
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

        return '<input ' . $this->_render_attributes() . ($this->form_properties['doctype'] == 'xhtml' ? '/' : '') . '>';

    }

}
