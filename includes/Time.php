<?php

/**
 *  Create `time picker` form elements
 *
 *  @author     Stefan Gabos <contact@stefangabos.ro>
 *  @copyright  (c) 2006 - 2022 Stefan Gabos
 *  @package    Elements
 */
class Zebra_Form_Time extends Zebra_Form_Shared {

    /**
     *  Adds a `time picker` element to the form.
     *
     *  >   Do not instantiate this class directly!<br>
     *      Use the {@link Zebra_Form::add() add()} method instead!
     *
     *  The output of this element will be one, two, three or four {@link Zebra_Form_Select select} elements, for hour,
     *  minutes, seconds and AM/PM respectively, according to the given format as set through the `format` attribute.
     *
     *  Note that even though there will be more select boxes, the submitted values will be available as a single merged
     *  value (in the form of hh:mm:ss AM/PM, depending on the format), with the name as defined through the `id` argument.
     *
     *  <code>
     *  // create a new form
     *  $form = new Zebra_Form('my_form');
     *
     *  // add a label
     *  $form->add('label', 'label_my_time', 'my_time', 'Pick a time');
     *
     *  // add a time picker element, for hour and minutes
     *  $element = $form->add('time', 'my_time', date('H:i'), array('format' => 'hm'));
     *
     *  // make it required
     *  $element->set_rule(array(
     *      'required'  =>  array('error', 'You must pick a time!'),
     *  ));
     *
     *  // this method needs to be called before rendering the form
     *  if ($form->validate()) {
     *
     *      // note that even though there will be more select boxes, the submitted
     *      // values will be available as a single merged value (in the form of
     *      // mm:mm:ss AM/PM, depending on the format), with the name as given by
     *      // the "id" argument:
     *      echo $_POST['my_time'];
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
     *                                  // for an element named "my_time", one would use:
     *                                  echo $my_time;
     *                                  </code>
     *
     *  @param  string  $default        (Optional) String representing the default time to be shown. Must be set according
     *                                  to the format of the time, as specified through the `format` attribute. For example,
     *                                  for a time format of "hm", one would set the default time in the form of "hh:mm"
     *                                  while for a time format of "hms", one would set the time in the form of "hh:mm:ss".
     *
     *                                  Default is current system time.
     *
     *  @param  array   $attributes     (Optional) An array of user specified attributes valid for a time picker
     *                                  element (format, hours, minutes, seconds, am/pm).
     *
     *                                  Must be specified as an associative array, in the form of *attribute => value*.
     *
     *                                  Available attributes are:
     *
     *                                  -   `format` - format of time; a string a combination of the four allowed characters:
     *                                      `h` (for hours), `m` (for minutes), `s` (for seconds) and `g` for using 12-hours
     *                                      format instead of the default 24-hours format; (i.e. setting the format to `hm`
     *                                      would allow the selection of hours and minutes, setting the format to `hms`
     *                                      would allow the selection of hours, minutes and seconds, and setting the format
     *                                      to `hmg` would allow the selection of hours and minutes using the 12-hours
     *                                      format instead of the default 24-hours format).
     *
     *                                  -   `hours` - an array of selectable hours (i.e. `array(10, 11, 12)`)
     *
     *                                  -   `minutes` - an array of selectable minutes (i.e. `array(15, 30, 45)`)
     *
     *                                  -   `seconds` - an array of selectable seconds
     *
     *                                  Attributes may also be set after the form element is created with the
     *                                  {@link Zebra_Form_Shared::set_attributes() set_attributes()} method.
     *
     *  @return void
     */
    function __construct($id, $default = '', $attributes = '') {

        // call the constructor of the parent class
        parent::__construct();

        // these will hold the default selectable hours, minutes and seconds
        $hours = $minutes = $seconds = array();

        // all the 24 hours are available by default
        for ($i = 0; $i < 24; $i++) $hours[] = $i;

        // all the minutes and seconds are available by default
        for ($i = 0; $i < 60; $i++) $minutes[] = $seconds[] = $i;

        // set private attributes, for internal use only
        // (will not be rendered by the _render_attributes() method)
        $this->private_attributes = array(
            'disable_xss_filters',
            'locked',
            'type',
            'name',
            'id',
            'format',
            'hours',
            'minutes',
            'seconds',
            'value',
        );

        // set the default attributes
        $this->set_attributes(array(
            'type'      =>  'time',
            'name'      =>  $id,
            'id'        =>  $id,
            'value'     =>  $default,
            'class'     =>  'zebraform-control zebraform-time',
            'format'    =>  'hm',
            'hours'     =>  $hours,
            'minutes'   =>  $minutes,
            'seconds'   =>  $seconds,
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

        // get some attributes of the element
        $attributes = $this->get_attributes(array('name', 'value', 'class', 'format', 'hours', 'minutes', 'seconds'));

        // make sure format is in lower characters
        $attributes['format'] = strtolower($attributes['format']);

        // if invalid format specified, revert to the default "hm"
        if (preg_match('/^[hmsg]+$/i', $attributes['format']) == 0 || strlen(preg_replace('/([a-z]{2,})/i', '$1', $attributes['format'])) != strlen($attributes['format'])) $attributes['format'] = 'hm';

        // see what have we specified as default time
        $time = array_diff(explode(':', trim(str_replace(array('am', 'pm'), '', strtolower($attributes['value'])))), array(''));

        // if, according to the time format, we have to show the hours, and the hour is given in the default time
        if (($hour_position = strpos($attributes['format'], 'h')) !== false && isset($time[$hour_position]))

            // the default selected hour
            $selected_hour = $time[$hour_position];

        // if, according to the time format, we have to show the minutes, and the minutes are given in the default time
        if (($minutes_position = strpos($attributes['format'], 'm')) !== false && isset($time[$minutes_position]))

            // the default selected minute
            $selected_minute = $time[$minutes_position];

        // if, according to the time format, we have to show the seconds, and the seconds are given in the default time
        if (($seconds_position = strpos($attributes['format'], 's')) !== false && isset($time[$seconds_position]))

            // the default selected minute
            $selected_second = $time[$seconds_position];

        // if 12-hours format is to be used
        if (strpos($attributes['format'], 'g')) {

            // set a flag
            $ampm = true;

            // if this is also present in the default time
            if (preg_match('/\bam\b|\bpm\b/i', $attributes['value'], $matches))

                // extract the format from the default time
                $ampm = strtolower($matches[0]);

        }


        $output = '';

        // if the hour picker is to be shown
        if ($hour_position !== false) {

            // generate the hour picker
            $output .= '
                <select name="' . $attributes['name'] . '_hours" id="' . $attributes['name'] . '_hours" ' . $this->_render_attributes() . '>
                    <option value="">-</option>';

            foreach ($attributes['hours'] as $hour)

                // show 12 or 24 hours depending on the format
                if (!isset($ampm) || ($hour > 0 && $hour < 13))

                    $output .= '<option value="' . str_pad($hour, 2, '0', STR_PAD_LEFT) . '"' . (isset($selected_hour) && ltrim($selected_hour, '0') == ltrim($hour, '0') ? '  selected="selected"' : '') . '>' . str_pad($hour, 2, '0', STR_PAD_LEFT) . '</option>';

            $output .= '
                </select>
            ';

        }

        // if the minute picker is to be shown
        if ($minutes_position !== false) {

            // generate the minute picker
            $output .= '
                <select name="' . $attributes['name'] . '_minutes" id="' . $attributes['name'] . '_minutes" ' . $this->_render_attributes() . '>
                    <option value="">-</option>';

            foreach ($attributes['minutes'] as $minute)
                $output .= '<option value="' . str_pad($minute, 2, '0', STR_PAD_LEFT) . '"' . (isset($selected_minute) && ltrim($selected_minute, '0') == ltrim($minute, '0') ? ' selected="selected"' : '') . '>' . str_pad($minute, 2, '0', STR_PAD_LEFT) . '</option>';

            $output .= '
                </select>
            ';

        }

        // if the seconds picker is to be shown
        if ($seconds_position !== false) {

            // generate the seconds picker
            $output .= '
                <select name="' . $attributes['name'] . '_seconds" id="' . $attributes['name'] . '_seconds" ' . $this->_render_attributes() . '>
                    <option value="">-</option>';

            foreach ($attributes['seconds'] as $second)
                $output .= '<option value="' . str_pad($second, 2, '0', STR_PAD_LEFT) . '"' . (isset($selected_second) && ltrim($selected_second, '0') == ltrim($second, '0') ? ' selected="selected"' : '') . '>' . str_pad($second, 2, '0', STR_PAD_LEFT) . '</option>';

            $output .= '
                </select>
            ';

        }

        // if am/pm picker is to be shown
        if (isset($ampm)) {

            // generate the AM/PM picker
            $output .= '
                <select name="' . $attributes['name'] . '_ampm" id="' . $attributes['name'] . '_ampm" ' . $this->_render_attributes() . '>
                    <option value="">-</option>';

            $output .= '<option value="AM"' . ($ampm === 'am' ? ' selected="selected"' : '') . '>AM</option>';
            $output .= '<option value="PM"' . ($ampm === 'pm' ? ' selected="selected"' : '') . '>PM</option>';

            $output .= '
                </select>
            ';

        }

        $output .= '<div class="clear"></div>';

        return $output;

    }

}
