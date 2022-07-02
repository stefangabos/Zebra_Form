<?php

/**
 *  Create `<label>` form elements
 *
 *  @author     Stefan Gabos <contact@stefangabos.ro>
 *  @copyright  © 2006 - 2022 Stefan Gabos
 *  @package    Elements
 */
class Zebra_Form_Label extends Zebra_Form_Shared {

    /**
     *  Create `<label>` form elements.
     *
     *  >   Do not instantiate this class directly!<br>
     *      Use the {@link Zebra_Form::add() add()} method instead!
     *
     *  <code>
     *
     *  // create a new form
     *  $form = new Zebra_Form('my_form');
     *
     *  // add a label, attached to a text input element
     *  $form->add('label', 'label_my_input', 'my_input', 'Enter some text:');
     *
     *  // add a text input element to the form
     *  $obj = $form->add('text', 'my_input');
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
     *                                  This is the name of the variable to be used in the template file for displaying
     *                                  the element.
     *
     *                                  <code>
     *                                  // in a template file, in order to output the element's HTML code
     *                                  // for an element named "my_label", one would use:
     *                                  echo $my_label;
     *                                  </code>
     *
     *  @param  string  $element        The `id` attribute of the element to attach the label to.
     *
     *                                  >   Note that this must be the `id` attribute of the element you are attaching
     *                                      the label to and not the `name` attribute!<br><br>
     *                                      This is important because while most of the elements have identical `id` and
     *                                      `name` attributes, for {@link Zebra_Form_Checkbox checkboxes},
     *                                      {@link Zebra_Form_Select select boxes with the `multiple` attribute set} and
     *                                      for {@link Zebra_Form_Radio radio buttons}, this is different.
     *
     *                                  **Exception to the rule:**
     *
     *                                  Just like in the case of {@link Zebra_Form_Note notes}, if you want a `master`
     *                                  label - a label that is attached to a `group` of checkboxes/radio buttons
     *                                  rather than to individual elements - this attribute must instead refer to the `name`
     *                                  of the elements (which, for groups of checkboxes/radio buttons, is one and the same).
     *                                  This is important because if the group of checkboxes/radio buttons have the
     *                                  `required` rule set, this is the only way in which the "required" symbol
     *                                  (the red asterisk) will be attached to the master label instead of being attached
     *                                  to the first checkbox/radio button from the group.
     *
     *  @param  mixed   $caption        Caption of the label.
     *
     *                                  >   Putting a $ (dollar) sign before a character will turn that specific character
     *                                      into the {@link https://developer.mozilla.org/en-US/docs/Web/HTML/Global_attributes/accesskey accesskey}<br>
     *                                      If you need the dollar sign in the label, escape it with `\` (backslash).
     *
     *  @param  array   $attributes     (Optional) An array of attributes valid for
     *                                  {@link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/label label}
     *                                  form elements (like `disabled`, `alt`, `style`, etc.).
     *
     *                                  Must be specified as an associative array, in the form of *attribute => value*.
     *
     *                                  <code>
     *                                  // setting the "disabled" attribute
     *                                  $form->add(
     *                                      'label',
     *                                      'label_my_input',
     *                                      'my_input',
     *                                      'I am a label'
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
     *                                  and should not be altered manually: `id`, `for`.
     *
     *  @return void
     */
    function __construct($id, $element, $caption, $attributes = '') {

        // call the constructor of the parent class
        parent::__construct();

        // set private attributes, for internal use only
        // (will not be rendered by the _render_attributes() method)
        $this->private_attributes = array(
            'disable_xss_filters',
            'for_group',
            'label',
            'locked',
            'name',
            'type',
        );

        // set the default attributes
        $this->set_attributes(array(
            'for'   =>  preg_replace('/[^a-z0-9\_]/i', '_', $element),
            'id'    =>  preg_replace('/[^a-z0-9\_]/i', '_', $id),
            'class' =>  'zebraform-label',
            'label' =>  $caption,
            'name'  =>  $id,
            'type'  =>  'label',
        ));

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

        // get private attributes
        $attributes = $this->get_attributes('label');

        // if access key needs to be showed
        if (preg_match('/(?<!\\\)\$(.{1})/', $attributes['label'], $matches) > 0) {

            // set the requested accesskey
            $this->set_attributes(array('accesskey' => strtolower($matches[1])));

            // make the accesskey visible
            $attributes['label'] = preg_replace('/\$(.{1})/', '<span class="zf-underline">$1</span>', $attributes['label']);

        }

        return '<label ' . $this->_render_attributes() . '>' . preg_replace('/\\\\\$/', '$', $attributes['label']) . '</label>';

    }

}
