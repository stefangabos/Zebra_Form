<?php

/**
 *  Class for raw HTML output.
 *  Allow to easily insert fieldsets opening and closing tags.
 *
 *  @author     Stefan Gabos <contact@stefangabos.ro>
 *  @copyright  (c) 2006 - 2013 Stefan Gabos
 *  @package    Controls
 */
class Zebra_Form_Raw extends Zebra_Form_Control
{

    /**
     *  Adds raw html to the form.
     *
     *  <b>Do not instantiate this class directly! Use the {@link Zebra_Form::add() add()} method instead!</b>
     *
     *  <code>
     *  // create a new form
     *  $form = new Zebra_Form('my_form');
     *
     *  // Open a fieldset.
     *  $form->add('raw', 'my_fieldset_opening_tag', '<fieldset><legend>Example fieldset</legend>');
     *
     *  // add a text control to the form
     *  $obj = $form->add('text', 'my_text');
     *
     *  // Close a fieldset.
     *  $form->add('raw', 'my_fieldset_closing_tag', '</fieldset>');
     *
     *  // don't forget to always call this method before rendering the form
     *  if ($form->validate()) {
     *      // put code here
     *  }
     *
     *  // output the form using an automatically generated template
     *  $form->render();
     *  </code>
     *
     *  @param  string  $id             Unique name to identify the control in the form.
     *
     *                                  This is the name of the variable to be used in the template file, containing
     *                                  the generated HTML for the control.
     *
     *                                  <code>
     *                                  // in a template file, in order to print the generated HTML
     *                                  // for a control named "my_note", one would use:
     *                                  echo $my_note;
     *                                  </code>
     *
     *  @param  string  $contents       Raw HTML contents of the control.
     *
     *  @return void
     */
    function __construct($id, $contents)
    {

        // call the constructor of the parent class
        parent::__construct();

        // set the private attributes of this control
        // these attributes are private for this control and are for internal use only
        $this->private_attributes = array(

            'contents',
            'disable_xss_filters',
            'locked',
            'name',
            'type'

        );


        // set the default attributes for the HTML control
        $this->set_attributes(

            array(

                'class'     =>  'raw',
                'contents'   =>  $contents,
                'id'    	=>  $id,
                'name'      =>  $id,
                'type'  	=>  'raw'

            )

        );
    }

    /**
     *  Generates the control's HTML code.
     *
     *  <i>This method is automatically called by the {@link Zebra_Form::render() render()} method!</i>
     *
     *  @return string  The control's HTML code
     */
    function toHTML()
    {

        $attributes = $this->get_attributes('contents');

        return $attributes['contents'];

    }

}
