<?php

/**
 *  Create `notes` (helper texts) for form elements
 *
 *  @author     Stefan Gabos <contact@stefangabos.ro>
 *  @copyright  © 2006 - 2022 Stefan Gabos
 *  @package    Elements
 */
class Zebra_Form_Note extends Zebra_Form_Shared {

    /**
     *  Create `notes` for form elements.
     *
     *  >   Do not instantiate this class directly!<br>
     *      Use the {@link Zebra_Form::add() add()} method instead!
     *
     *  >   The note will be explicitly associated with the form element it is attached to using the `aria-describedby`
     *      attribute. This will ensure that assistive technologies such as screen readers will announce this help text when
     *      the user focuses or enters the control.
     *
     *  <code>
     *
     *  // create a new form
     *  $form = new Zebra_Form('my_form');
     *
     *  // add a text input to the form
     *  $obj = $form->add('text', 'my_input');
     *
     *  // associate a note with the input element
     *  $form->add('note', 'note_my_input', 'my_input', 'Enter anything in the above input');
     *
     *  // this method needs to be called before rendering the form
     *  if ($form->validate()) {
     *
     *      // do stuff
     *
     *  }
     *
     *  // generate and render the form
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
     *                                  // for an element named "my_note", one would use:
     *                                  echo $my_note;
     *                                  </code>
     *
     *  @param  string  $element        The `id` attribute of the element to attach the note to.
     *
     *                                  >   Note that this must be the `id` attribute of the element you are attaching
     *                                      the note to and not the `name` attribute!<br><br>
     *                                      This is important because while most of the elements have identical `id` and
     *                                      `name` attributes, for {@link Zebra_Form_Checkbox checkboxes},
     *                                      {@link Zebra_Form_Select select boxes with the `multiple` attribute set} and
     *                                      {@link Zebra_Form_Radio radio buttons}, this is different.
     *
     *                                  **Exception to the rule:**
     *
     *                                  Just like in the case of {@link Zebra_Form_Label labels}, if you want a `master`
     *                                  note - a note that is attached to a `group` of checkboxes/radio buttons
     *                                  rather than to individual elements - this attribute must instead refer to the `name`
     *                                  of the elements (which, for groups of checkboxes/radio buttons, is one and the same).
     *
     *  @param  string  $content        Content of the note (can be HTML markup)
     *
     *  @param  array   $attributes     (Optional) An array of attributes valid for
     *                                  {@link https://html.spec.whatwg.org/multipage/grouping-content.html#the-div-element div}
     *                                  elements (like `class` or `style`).
     *
     *                                  Must be specified as an associative array, in the form of *attribute => value*.
     *
     *                                  <code>
     *                                  // setting inline style
     *                                  $form->add(
     *                                      'note',
     *                                      'note_my_input',
     *                                      'my_input',
     *                                      'I am a note'
     *                                      array(
     *                                          'style'  =>  'color: red',
     *                                      )
     *                                  );
     *                                  </code>
     *
     *  @return void
     */
    function __construct($id, $element, $content, $attributes = '') {

        // call the constructor of the parent class
        parent::__construct();

        // set private attributes, for internal use only
        // (will not be rendered by the _render_attributes() method)
        $this->private_attributes = array(
            'caption',
            'disable_xss_filters',
            'locked',
            'for',
            'name',
            'type',
        );

        // set the default attributes
        $this->set_attributes(array(
            'class'     =>  'zebraform-note',
            'caption'   =>  $content,
            'for'       =>  $element,
            'id'    	=>  $id,
            'name'      =>  $id,
            'type'  	=>  'note',
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

        $attributes = $this->get_attributes('caption');

        return '<div ' . $this->_render_attributes() . '>' . $attributes['caption'] . '</div>';

    }

}
