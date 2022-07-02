<?php

/**
 *  Create `<input type="file">` form elements
 *
 *  @author     Stefan Gabos <contact@stefangabos.ro>
 *  @copyright  © 2006 - 2022 Stefan Gabos
 *  @package    Elements
 */
class Zebra_Form_File extends Zebra_Form_Shared {

    /**
     *  Create `<input type="file">` form elements.
     *
     *  >   Do not instantiate this class directly!<br>
     *      Use the {@link Zebra_Form::add() add()} method instead!
     *
     *  <code>
     *
     *  // create a new form
     *  $form = new Zebra_Form('my_form');
     *
     *  // add a label
     *  $form->add('label', 'label_my_file_upload', 'my_file_upload', 'Upload a file');
     *
     *  // add a file upload element to the form
     *  $element = $form->add('file', 'my_file_upload');
     *
     *  // the "upload" rule is always required!
     *  $element->set_rule(array(
     *      'upload'    =>  array('path/to/upload', ZEBRA_FORM_UPLOAD_RANDOM_NAMES, 'error', 'Could not upload file!'),
     *      'filetype'  =>  array('doc, docx', 'error', 'File must be a Word document!'),
     *      'filesize'  =>  array(1024000, 'error', 'File size must not exceed 1MB!'),
     *  ));
     *
     *  // this method needs to be called before rendering the form
     *  if ($form->validate()) {
     *
     *      // all the information about the uploaded file will be
     *      // available in the "file_upload" property
     *      print_r('<pre>');
     *      print_r($form->file_upload['my_file_upload']);
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
     *                                  This is also the name of the variable to be used in the template file for
     *                                  displaying the element.
     *
     *                                  <code>
     *                                  // in a template file, in order to output the element's HTML code
     *                                  // for an element named "my_file_upload", one would use:
     *                                  echo $my_file_upload;
     *                                  </code>
     *
     *  @param  array   $attributes     (Optional) An array of attributes valid for
     *                                  {@link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/file file input}
     *                                  form elements (like `disabled`, `readonly`, etc.).
     *
     *                                  Must be specified as an associative array, in the form of *attribute => value*.
     *
     *                                  <code>
     *                                  // setting the "disabled" attribute
     *                                  $element = $form->add(
     *                                      'file',
     *                                      'my_file_upload',
     *                                      array(
     *                                          'disabled'  =>  true,
     *                                      )
     *                                  );
     *
     *                                  Attributes may also be set after the form element is created with the
     *                                  {@link Zebra_Form_Shared::set_attributes() set_attributes()} method.
     *
     *                                  The following attributes are automatically set when the form element is created
     *                                  and should not be altered manually: `id`, `name`, `type`.
     *
     *  @return void
     */
    function __construct($id, $attributes = '') {

        // call the constructor of the parent class
        parent::__construct();

        // set private attributes, for internal use only
        // (will not be rendered by the _render_attributes() method)
        $this->private_attributes = array(
            'disable_xss_filters',
            'files',
            'locked',
        );

        // set the default attributes
        $this->set_attributes(array(
            'type'  =>  'file',
            'name'  =>  $id,
            'id'    =>  str_replace(array('[', ']'), '', $id),
            'class' =>  'zebraform-file',
        ));

        // if "class" is amongst user specified attributes
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

        // all file upload elements must have the "upload" rule set or we trigger an error
        if (!isset($this->rules['upload'])) _zebra_form_show_error('The element named <strong>"' . $this->attributes['name'] . '"</strong> in form <strong>"' . $this->form_properties['name'] . '"</strong> must have the <em>"upload"</em> rule set', E_USER_ERROR);

        // if the "image" rule is set
        if (isset($this->rules['image']))

            // these are the allowed file extensions
            $allowed_file_types = array('jpe', 'jpg', 'jpeg', 'png', 'gif', 'webp');

        // if the "filetype" rule is set
        elseif (isset($this->rules['filetype']))

            // get the array of allowed file extensions
            $allowed_file_types = array_map('trim', explode(',', $this->rules['filetype'][0]));

        // if file selection should be restricted to certain file types
        if (isset($allowed_file_types)) {

            $mimes = array();

            // iterate through allowed extensions
            foreach ($allowed_file_types as $extension)

                // get the mime type for each extension
                if (isset($this->form_properties['mimes'][$extension]))

                    $mimes = array_merge($mimes, (array)$this->form_properties['mimes'][$extension]);

            // set the "accept" attribute
            // see https://html.spec.whatwg.org/multipage/input.html#file-upload-state-%28type=file%29
            $this->set_attributes(array('accept' => '.' . implode(',.', $allowed_file_types) . ',' . implode(',', $mimes)));

        }

        // show the file upload element
        $output = '<input ' . $this->_render_attributes() . ($this->form_properties['doctype'] == 'xhtml' ? '/' : '') . '>';

        // return the generated output
        return $output;

    }

}
