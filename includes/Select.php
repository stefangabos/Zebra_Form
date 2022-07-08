<?php

/**
 *  Create `<select>` form elements
 *
 *  @author     Stefan Gabos <contact@stefangabos.ro>
 *  @copyright  © 2006 - 2022 Stefan Gabos
 *  @package    Elements
 */
class Zebra_Form_Select extends Zebra_Form_Shared {

    /**
     *  Create `<select>` form elements.
     *
     *  >   Do not instantiate this class directly!<br>
     *      Use the {@link Zebra_Form::add() add()} method instead!
     *
     *  By default, unless the `multiple` attribute is set, the element will have a default first option automatically
     *  added telling users to select one of the available options. The default value for English is `- select -`, taken
     *  from the language file - see the {@link Zebra_Form::language() language()} method. If you don't want it or want
     *  to set it at runtime, set the `overwrite` argument to `TRUE` when calling the {@link add_options()} method.
     *
     *  <code>
     *  // create a new form
     *  $form = new Zebra_Form('my_form');
     *
     *  // add a label
     *  $form->add('label', 'label_my_select', 'my_select', 'Select an option');
     *
     *  // single-option select box
     *  $element = $form->add('select', 'my_select');
     *
     *  // add selectable options
     *  // values will be "0", "1" and "2", respectively
     *  // a default first value, "- select -" (language dependent) will also be added
     *  $element->add_options(array(
     *      'Value 1',
     *      'Value 2',
     *      'Value 3'
     *  ));
     *
     *  // single-option select box
     *  $element = $form->add('select', 'my_select2');
     *
     *  // add selectable options with specific values
     *  // values will be "v1", "v2" and "v3", respectively
     *  // a default first value, "- select -" (language dependent) will also be added
     *  $element->add_options(array(
     *      'v1' => 'Value 1',
     *      'v2' => 'Value 2',
     *      'v3' => 'Value 3'
     *  ));
     *
     *  // single-option select box with the second option pre-selected
     *  $element = $form->add('select', 'my_select3', 'v2');
     *
     *  // add selectable options with specific values
     *  // values will be "v1", "v2" and "v3", respectively
     *  // also, overwrite the language-specific default first value (notice the boolean TRUE at the end)
     *  // note that the first option's value *must* be "" (empty string)
     *  $element->add_options(array(
     *      ''   => '- select a value -',
     *      'v1' => 'Value 1',
     *      'v2' => 'Value 2',
     *      'v3' => 'Value 3'
     *  ), true);
     *
     *  // multi-option select box with the first two options selected
     *  $element = $form->add('select', 'my_select4[]', array('v1', 'v2'), array('multiple' => true));
     *
     *  // add selectable options with specific values
     *  // values will be "v1", "v2" and "v3", respectively
     *  $element->add_options(array(
     *      'v1' => 'Value 1',
     *      'v2' => 'Value 2',
     *      'v3' => 'Value 3'
     *  ));
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
     *  >   By default, for {@link Zebra_Form_Checkbox checkboxes}, {@link Zebra_Form_Radio radio buttons} and select boxes,
     *      the library will prevent the submission of other values than those declared when creating the elements, by
     *      triggering a **SPAM attempt detected!** error. Therefore, if you plan on adding/removing values dynamically
     *      from JavaScript, you will have to call {@link Zebra_Form_Shared::disable_spam_filter() disable_spam_filter()}
     *      in order to prevent that from happening!
     *
     *  @param  string  $id             Unique name to identify the element in the form.
     *
     *                                  >   `$id` needs to be suffixed with square brackets if the `multiple` attribute
     *                                      is set, so that PHP correctly treats the submitted values as an array.
     *
     *                                  The element's `name` attribute will the same as `$id`, while the element's `id`
     *                                  attribute will be the value of `$id`, stripped of square brackets (if any).
     *
     *                                  This is the name to be used for accessing the element's value in {@link https://www.php.net/manual/en/reserved.variables.post.php $_POST} /
     *                                  {@link https://www.php.net/manual/en/reserved.variables.get.php $_GET}, after the
     *                                  form is submitted.
     *
     *                                  This is also the name of the variable to be used in the template file for
     *                                  displaying the element.
     *
     *                                  <code>
     *                                  // in a template file, in order to print the generated HTML
     *                                  // for an element named "my_select", one would use:
     *                                  echo $my_select;
     *                                  </code>
     *
     *  @param  mixed   $default        (Optional) Default selected option(s).
     *
     *                                  This argument can also be an array in case the `multiple` attribute is set
     *                                  and multiple options need to be preselected by default.
     *
     *  @param  array   $attributes     (Optional) An array of attributes valid for
     *                                  {@link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/select select}
     *                                  form elements (like `disabled`, `readonly`, `style`, etc.).
     *
     *                                  Must be specified as an associative array, in the form of *attribute => value*.
     *
     *                                  <code>
     *                                  // setting the "multiple" attribute
     *                                  $form->add(
     *                                      'select',
     *                                      'my_select',
     *                                      '',
     *                                      array(
     *                                          'multiple' => true
     *                                      )
     *                                  );
     *                                  </code>
     *
     *                                  A special `other` attribute exists which, when set to `true`, will result in the
     *                                  automatic creation of a {@link Zebra_Form_Text text input} element having the
     *                                  name `[id]_other` where `[id]` is the select element's `id` attribute.
     *
     *                                  The text input will be hidden until the user selects the automatically added
     *                                  `Other...` option (language dependent) from the available options. The option's
     *                                  `value` will be `other`.
     *
     *                                  >   If the `other` attribute is present, you will have to add the automatically
     *                                      generated element to the template!
     *
     *                                  Attributes may also be set after the form element is created with the
     *                                  {@link Zebra_Form_Shared::set_attributes() set_attributes()} method.
     *
     *                                  The following attributes are automatically set when the form element is created
     *                                  and should not be altered manually: `id`, `name`.
     *
     *  @param  string  $default_other  The default value in the `other` field (if the `other` attribute is set to `true`,
     *                                  see above)
     *
     *  @return void
     */
    function __construct($id, $default = '', $attributes = '', $default_other = '') {

        // call the constructor of the parent class
        parent::__construct();

        // set private attributes, for internal use only
        // (will not be rendered by the _render_attributes() method)
        $this->private_attributes = array(
            'default_other',
            'disable_spam_filter',
            'disable_xss_filters',
            'locked',
            'options',
            'other',
            'overwrite',
            'type',
            'value',
		);

        // set the default attributes
        $this->set_attributes(array(
            'name'          =>  $id,
            'id'            =>  str_replace(array('[', ']'), '', $id),
            'class'         =>  'zebraform-control zebraform-select',
            'options'       =>  array(),
            'type'          =>  'select',
            'value'         =>  $default,
            'default_other' =>  $default_other,
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
     *  Adds options to the select box element.
     *
     *  >   If the `multiple` attribute is **not set**, the first option will always be considered as the `nothing is selected`
     *      state of the element!
     *
     *  @param  array   $options    An associative array of options where the `key` is the value of the option and the
     *                              `value` is the text to be displayed for the option.
     *
     *                              >   Option groups can be created by giving an array of associative arrays as argument:
     *
     *                              <code>
     *                              // add as groups:
     *                              $element->add_options(array(
     *                                  'group1' => array('option 1', 'option 2'),
     *                                  'group2' => array('option 3', 'option 4'),
     *                              ));
     *                              </code>
     *
     *  @param  boolean $overwrite  (Optional) By default, successive calls to this method will appended the options
     *                              given as arguments to the already existing ones.
     *
     *                              Setting this argument to `true` will instead overwrite the previously existing options.
     *
     *                              Default is `false`.
     *
     *  @return void
     */
    function add_options($options, $overwrite = false) {

        // continue only if parameter is an array
        if (is_array($options)) {

            // get some properties of the select control
            $attributes = $this->get_attributes(array('options', 'multiple'));

            // if there are no options so far AND
            // we're not overwriting existing options AND
            // the "multiple" attribute is not set
            if (empty($attributes['options']) && $overwrite === false && !isset($attributes['multiple']))

                // add the default value
                // we'll replace the value with the appropriate language
                $options = array('' => $this->form_properties['language']['select']) + $options;

            // set the options attribute of the control
            $this->set_attributes(array(
                'options'   =>  ($overwrite ? $options : $attributes['options'] + $options),
			));

            // if we overwrite the options, we set a flag so the default "- select -" is not added if $options array is empty
            $this->set_attributes(array(
                'overwrite'   =>    $overwrite,
            ));

        // if options are not specified as an array
        } else {

            // trigger an error message
            _zebra_form_show_error('
                Selectable values for the <strong>' . $this->attributes['id'] . '</strong> control must be specified as
                an array
            ');

        }

    }

    /**
     *  Generates the form element's HTML code.
     *
     *  >   This method is automatically called by the {@link Zebra_Form::render() render()} method.
     *
     *  @return string  Returns the form element's generated HTML code.
     */
    function toHTML() {

        // get the options of the select control
        $attributes = $this->get_attributes(array('options', 'value', 'multiple', 'other', 'overwrite'));

        // if select box is not "multi-select" and the "other" attribute is set
        if (!isset($attributes['multiple']) && isset($attributes['other']))

            // add an extra options to the already existing ones
            $attributes['options'] += array('other' => $this->form_properties['language']['other']);

        // if the default value, as added when instantiating the object is still there
        // or if no options were specified
        if (($key = array_search('#replace-with-language#', $attributes['options'])) !== false || (!$attributes['overwrite'] && empty($attributes['options'])))

            // put the label from the language file
            $attributes['options'][$key] = $this->form_properties['language']['select'];

        // use a private, recursive method to generate the select's content
        $optContent = $this->_generate($attributes['options'], $attributes['value']);

        // return generated HTML
        return '<select '. $this->_render_attributes() . '>' . $optContent . '</select>';

    }

    /**
     *  Takes the options array and recursively generates options and option groups
     *
     *  @return string  Resulted HTML code
     *
     *  @access private
     */
    private function _generate(&$options, &$selected, $level = 0) {

        $content = '';

        // character(s) used for indenting levels
        $indent = '&nbsp;&nbsp;';

        // iterate through the available options
        foreach ($options as $value => $caption) {

            // if option has child options
            if (is_array($caption)) {

                // create a dummy option group (for valid HTML/XHTML we are not allowed to create nested option groups
                // and also empty option groups are not allowed)
                // BUT because in IE7 the "disabled" attribute is not supported, and in all versions of IE these
                // can't be styled, we will remove them from JavaScript
                // having a dummy option in them (the option is disabled and, from CSS, rendered invisible)
                $content .= '
                    <optgroup label="' . str_repeat($indent, $level) . $value . '">
                        <option disabled="disabled" class="dummy"></option>
                    </optgroup>
                ';

                // call the method recursively to generate the output for the children options
                $content .= $this->_generate($caption, $selected, $level + 1);

            // if entry is a standard option
            } else {

                // create the appropriate code
                $content .= '<option value="' . $value . '"' .

                    // if anything was selected
					($selected !== '' && $value !== '' &&

                    	(

                            // and the current option is selected
    						(is_array($selected) && in_array($value, $selected)) ||

                    		(!is_array($selected) && (string)$value === (string)$selected)

                        // set the appropriate attribute
    					) ? ' selected="selected"' : ''

                    ) . '>' .

                // indent appropriately
                str_repeat($indent, $level) . $caption . '</option>';

            }

        }

        // return generated content
        return $content;

    }

}
