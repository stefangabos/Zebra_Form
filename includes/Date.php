<?php

/**
 *  Create `date` form elements
 *
 *  Used datepicker is {@link https://github.com/stefangabos/Zebra_Datepicker Zebra DatePicker}.
 *
 *  @author     Stefan Gabos <contact@stefangabos.ro>
 *  @copyright  © 2006 - 2022 Stefan Gabos
 *  @package    Elements
 */
class Zebra_Form_Date extends Zebra_Form_Shared {

    /**
     *  Create `date picker` form elements.
     *
     *  >   Do not instantiate this class directly!<br>
     *      Use the {@link Zebra_Form::add() add()} method instead!
     *
     *  The output of this element will be a {@link Zebra_Form_Text text input} with a calendar icon.
     *
     *  <code>
     *  // create a new form
     *  $form = new Zebra_Form('my_form');
     *
     *  // add a label
     *  $form->add('label', 'label_my_date', 'my_date', 'Pick a date');
     *
     *  // add a date picker element to the form
     *  $datepicker = $form->add('date', 'my_date', date('Y-m-d'));
     *
     *  // setting the "date" rule is required
     *  $datepicker->set_rule(array(
     *      'date'  =>  array('error', 'Invalid date specified!'),
     *  ));
     *
     *  // set the date format
     *  $datepicker->format('M d, Y');
     *
     *  // this method needs to be called before rendering the form
     *  if ($form->validate()) {
     *
     *      // get the date in YYYY-MM-DD format so you can play with is easily
     *      $date = $datepicker->get_date();
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
     *                                  // for an element named "my_date", one would use:
     *                                  echo $my_date;
     *                                  </code>
     *
     *  @param  string  $default        (Optional) Default date, formatted according to {@link format() format}.
     *
     *  @param  array   $attributes     (Optional) An array of attributes valid for
     *                                  {@link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/text text input}
     *                                  form elements (like `disabled`, `readonly`, `style`, etc.).
     *
     *                                  Must be specified as an associative array, in the form of *attribute => value*.
     *
     *                                  <code>
     *                                  // setting the "readonly" attribute
     *                                  $form->add(
     *                                      'date',
     *                                      'my_date',
     *                                      '',
     *                                      array(
     *                                          'readonly' => true
     *                                      )
     *                                  );
     *                                  </code>
     *
     *                                  Attributes may also be set after the form element is created with the
     *                                  {@link Zebra_Form_Shared::set_attributes() set_attributes()} method.
     *
     *                                  The following attributes are automatically set when the form element is created
     *                                  and should not be altered manually: `id`, `name`, `type`.
     *
     *  @return void
     */
    function __construct($id, $default = '', $attributes = '') {

        // call the constructor of the parent class
        parent::__construct();

        // set private attributes, for internal use only
        // (will not be rendered by the _render_attributes() method)
        $this->private_attributes = array(
            'locked',
            'disable_xss_filters',
            'disable_zebra_datepicker',
            'date',
            'always_visible',
            'container',
            'custom_classes',
            'days',
            'days_abbr',
            'default_position',
            'direction',
            'disable_time_picker',
            'disabled_dates',
            'enabled_ampm',
            'enabled_dates',
            'enabled_hours',
            'enabled_minutes',
            'enabled_seconds',
            'fast_navigation',
            'first_day_of_week',
            'format',
            'header_captions',
            'icon_position',
            'icon_margin',
            'inside',
            'lang_clear_date',
            'months',
            'months_abbr',
            'navigation',
            'offset',
            'open_icon_only',
            'open_on_focus',
            'pair',
            'readonly_element',
            'rtl',
            'show_clear_date',
            'show_icon',
            'show_other_months',
            'show_select_today',
            'show_week_number',
            'select_other_months',
            'start_date',
            'strict',
            'view',
            'weekend_days',
            'zero_pad',
        );

        // set the javascript attributes of this control
        // these attributes will be used by the JavaScript date picker object
        $this->javascript_attributes = array(
            'always_visible',
            'container',
            'current_date',
            'custom_classes',
            'days',
            'days_abbr',
            'default_position',
            'direction',
            'disable_time_picker',
            'disabled_dates',
            'enabled_ampm',
            'enabled_dates',
            'enabled_hours',
            'enabled_minutes',
            'enabled_seconds',
            'fast_navigation',
            'first_day_of_week',
            'format',
            'header_captions',
            'icon_position',
            'icon_margin',
            'inside',
            'lang_clear_date',
            'months',
            'months_abbr',
            'navigation',
            'open_icon_only',
            'open_on_focus',
            'offset',
            'pair',
            'readonly_element',
            'rtl',
            'show_clear_date',
            'show_icon',
            'show_other_months',
            'show_select_today',
            'show_week_number',
            'select_other_months',
            'start_date',
            'strict',
            'view',
            'weekend_days',
            'zero_pad',
        );

        // set the default attributes
        $this->set_attributes(array(
            'type'                      =>  'text',
            'name'                      =>  $id,
            'id'                        =>  $id,
            'value'                     =>  $default,
            'class'                     =>  'zebraform-control zebraform-text zebraform-date',

            'always_visible'            =>  null,
            'current_date'              =>  null,
            'days'                      =>  null,
            'days_abbr'                 =>  null,
            'direction'                 =>  null,
            'disable_time_picker'       =>  null,
            'disable_zebra_datepicker'  =>  false,
            'disabled_dates'            =>  null,
            'enabled_ampm'              =>  null,
            'enabled_dates'             =>  null,
            'enabled_hours'             =>  null,
            'enabled_minutes'           =>  null,
            'enabled_seconds'           =>  null,
            'fast_navigation'           =>  null,
            'first_day_of_week'         =>  null,
            'format'                    =>  'Y-m-d',
            'header_captions'           =>  null,
            'icon_position'             =>  null,
            'icon_margin'               =>  null,
            'inside'                    =>  null,
            'months'                    =>  null,
            'months_abbr'               =>  null,
            'navigation'                =>  null,
            'offset'                    =>  null,
            'open_icon_only'            =>  null,
            'open_on_focus'             =>  null,
            'pair'                      =>  null,
            'readonly_element'          =>  null,
            'rtl'                       =>  null,
            'show_clear_date'           =>  null,
            'show_other_months'         =>  null,
            'show_select_today'         =>  null,
            'show_week_number'          =>  null,
            'select_other_months'       =>  null,
            'start_date'                =>  null,
            'strict'                    =>  null,
            'view'                      =>  null,
            'weekend_days'              =>  null,
            'zero_pad'                  =>  null,
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
     *  Should the date picker be always visible?
     *
     *  Setting this property to a `jQuery selector` will result in the date picker being always visible, the indicated
     *  element acting as the date picker's container.
     *
     *  Setting this property to boolean `true` will result in the date picker not closing when selecting a date, but
     *  only when the user clicks outside the date picker.
     *
     *  <code>
     *  $datepicker = $form->add('date', 'my_date');
     *
     *  // an element having the ID "container"
     *  // will be the date picker's container
     *  $datepicker->always_visible('$("#container")');
     *  </code>
     *
     *  @param  mixed   $selector   A `jQuery selector` pointing to an existing element from the page to be used as the
     *                              date picker's container.
     *
     *                              May also be a boolean `true` resulting in the date picker not closing when selecting
     *                              a date, but only when the user clicks outside the date picker.
     *
     *                              Default is `false`.
     *
     *  @return void
     */
    function always_visible($selector = false) {

        // set the date picker's attribute
        $this->set_attributes(array('always_visible' => $selector));

    }

    /**
     *  By default, the date picker is injected into the document's `<body>` element. Use this property to tell the
     *  library to inject the date picker into a custom element - useful when you want the date picker to open at a
     *  specific position.
     *
     *  <code>
     *  $datepicker = $form->add('date', 'my_date');
     *
     *  // the date picker will open inside this element
     *  $datepicker->container('$("#container")');
     *  </code>
     *
     *  @param  string  $selector   A `jQuery selector` pointing to an existing element from the page to be used as the
     *                              date picker's container.
     *
     *                              Default is `$('body')`.
     *
     *  @since 2.9.8
     *
     *  @return void
     */
    function container($selector) {

        // set the date picker's attribute
        $this->set_attributes(array('container' => $selector));

    }

    /**
     *  By default, the current date (the value of *Today*) is taken from the system where the date picker is run on.<br>
     *  Set this to a date in the format of `YYYY-MM-DD` to use a different date.
     *
     *  <code>
     *  $datepicker = $form->add('date', 'my_date');
     *
     *  // custom value of "today"
     *  $datepicker->current_date('2021-06-28');
     *  </code>
     *
     *  @param  string  $date       A date in `YYYY-MM-DD` format.
     *
     *  @since 2.10.0
     *
     *  @return void
     */
    function current_date($date) {

        // set the date picker's attribute
        $this->set_attributes(array('current_date' => $date));

    }

    /**
     *  List of dates that should have custom classes applied to them.
     *
     *  <code>
     *  $datepicker = $form->add('date', 'my_date');
     *
     *  // apply "myclass1" custom class to the first day, of every month, of every year
     *  $datepicker->custom_classes(array(
     *      'myclass1'  =>  array('01 * *'),
     *  ));
     *  </code>
     *
     *  @param  array   $custom_classes An array in the form of
     *
     *                                  <code>
     *                                  array(
     *                                      'myclass1'  =>  array(dates_to_apply_myclass1_to),
     *                                      'myclass2'  =>  array(dates_to_apply_myclass2_to),
     *                                  )
     *                                  </code>
     *
     *                                  ...where `dates_to_apply_the_custom_class_to` is an array of dates in the same
     *                                  format as required by {@link disabled_dates}.
     *
     *                                  >   Custom classes will be applied **only in the day picker view** and not on
     *                                      month/year views!<br><br>
     *                                      The class name will have the `_disabled` suffix added if the day the class
     *                                      is applied to is disabled.
     *
     *                                  In order for the styles in your custom classes to be applied, make sure you are
     *                                  using the following syntax:
     *
     *                                  <code>
     *                                  .Zebra_DatePicker .dp_daypicker td.myclass1 { .. }
     *                                  .Zebra_DatePicker .dp_daypicker td.myclass1_disabled { .. }
     *                                  </code>
     *
     *                                  Default is `false`, no custom classes
     *
     *  @since 2.9.8
     *
     *  @return void
     */
    function custom_classes($custom_classes) {

        // set the date picker's attribute
        $this->set_attributes(array('custom_classes' => $custom_classes));

    }

    /**
     *  The position of the date picker relative to the element it is attached to.
     *
     *  Note that, regardless of this setting, the date picker's position will be automatically adjusted to fit in the
     *  view port, if needed.
     *
     *  >   This property will be ignored if {@link always_visible} or {@link container} properties are set.
     *
     *  <code>
     *  $datepicker = $form->add('date', 'my_date');
     *
     *  // the date picker will open *below* the element is attached to
     *  $datepicker->default_position('below');
     *  </code>
     *
     *  @param  string  $position   The position of the date picker relative to the element it is attached to.
     *
     *                              Possible values are `above` and `below`.
     *
     *                              Default is `above`.
     *
     *  @since 2.9.8
     *
     *  @return void
     */
    function default_position($position = 'above') {

        // set the date picker's attribute
        $this->set_attributes(array('default_position' => $position));

    }

    /**
     *  Direction of the calendar.
     *
     *  <code>
     *  $datepicker = $form->add('date', 'datepicker')
     *
     *  // calendar starts tomorrow and ends seven days after that
     *  $datepicker = direction(array(1, 7));
     *
     *  // calendar starts on the *reference date* and ends seven days after that
     *  $datepicker->direction(array(true, 7));
     *
     *  // calendar starts on January 1st 2013 and has no ending date
     *  // (assuming "format" is YYYY-MM-DD)
     *  $datepicker->direction(array('2013-01-01', false));
     *
     *  // calendar ends on the *reference date* and starts on January 1st 2022
     *  // assuming "format" is YYYY-MM-DD)
     *  $datepicker->direction(array(false, '2022-01-01'));
     *  </code>
     *
     *  @param  mixed   $direction      A positive or negative integer:
     *
     *                                  -   `n` (a positive integer) creates a future-only calendar beginning at n days
     *                                      after the reference date
     *
     *                                  -   `-n` (a negative integer) creates a past-only calendar ending at n days
     *                                      before the reference
     *
     *                                  -   `0` creates a calendar with no restrictions
     *
     *                                  -   boolean `TRUE` creates a future-only calendar starting with the reference date
     *
     *                                  -   boolean `FALSE` for a past-only calendar ending on the reference date
     *
     *                                  You may also set this property to an array with two elements in the following
     *                                  combinations:
     *
     *                                  -   first item is boolean `TRUE` (calendar starts on the reference date), a
     *                                      `positive integer` (calendar starts n days after the reference date), or a
     *                                      `valid date` given in the format defined by {@link format} (calendar starts
     *                                      at the specified date), and the second item is boolean `FALSE` (the calendar
     *                                      has no ending date), a `positive integer` (calendar ends n days after the
     *                                      starting date), or a `valid date` defined by {@link format} and which occurs
     *                                      after the starting date (calendar ends at the specified date)
     *
     *                                  -   first item is boolean `FALSE` (calendar ends on the reference date), a
     *                                      `negative integer` (calendar ends n days before the reference date), or a
     *                                      `valid date` given by {@link format} (calendar ends at the specified date),
     *                                      and the second item is a `positive integer` (calendar ends n days before the
     *                                      ending date), or a `valid date` given by {@link format} and which occurs
     *                                      before the starting date (calendar starts at the specified date)
     *
     *                                  Note that {@link disabled_dates} will still apply!
     *
     *                                  >   The `reference date` is the current date unless the date picker is the
     *                                      {@link pair} of another date picker, case in which the reference date is the
     *                                      date selected in that date picker.
     *
     *                                  Default is `0` (no restrictions).
     *
     *  @return void
     */
    function direction($direction = 0) {

        // set the date picker's attribute
        $this->set_attributes(array('direction' => $direction));

    }

    /**
     *  Disables selection of specific dates or range of dates in the calendar.
     *
     *  <code>
     *  $datepicker = $form->add('date', 'datepicker')
     *
     *  // disable January 1, 2022
     *  $datepicker->disabled_dates(array('1 1 2022'));
     *
     *  // disable all days in January 2022
     *  $datepicker->disabled_dates(array('* 1 2022'));
     *
     *  // disable January 1 through 10 in 2022
     *  $datepicker->disabled_dates(array('1-10 1 2022'));
     *
     *  // disable January 1 and 10 in 2022
     *  $datepicker->disabled_dates(array('1,10 1 2022'));
     *
     *  // disable 1 through 10, and then 20th, 22nd and 24th
     *  // of January through March for every year
     *  $datepicker->disabled_dates(array('1-10,20,22,24 1-3 *'));
     *
     *  // disable all Saturdays and Sundays
     *  $datepicker->disabled_dates(array('* * * 0,6'));
     *
     *  // disable 1st and 2nd of July 2022,
     *  // and all of August of 2022;
     *  $datepicker->disabled_dates(array('01 07 2022', '02 07 2022', '* 08 2022'));
     *  </code>
     *
     *  @param  array   $disabled_dates     An array of disabled dates in the following format:<br>
     *                                      `day month year weekday` where *weekday* is optional and can be a value from
     *                                      `0` to `6` (Saturday to Sunday).
     *
     *                                      The syntax is similar to that of `cron`: the values are separated by spaces
     *                                      and may contain `*` (asterisk) `-` (dash) and `,` (comma) delimiters.
     *
     *  @return void
     */
    function disabled_dates($disabled_dates) {

        // set the date picker's attribute
        $this->set_attributes(array('disabled_dates' => $disabled_dates));

    }

    /**
     *  By default, setting a format that also involves time (`h`, `H`, `g`, `G`, `i`, `s`, `a`, `A`) will automatically
     *  enable the time picker. If you want to use a format that involves time but you don't want the time picker, set
     *  this property to `true`.
     *
     *  @since  2.10.0
     *
     *  @return void
     */
    function disable_time_picker() {

        // set the date picker's attribute
        $this->set_attributes(array('disable_time_picker' => true));

    }

    /**
     *  By default, this library relies on {@link https://github.com/stefangabos/Zebra_Datepicker Zebra_DatePicker} for
     *  {@link Zebra_Form_Date date} elements. If you want to use a different date/time picker, you have to disable the
     *  built-in one by calling this method.
     *
     *  >   Make sure the language used by the custom date picker is the same as the {@link Zebra_Form::language() language}
     *      used for the library, or validation of the date will fail.
     *
     *  >   Also, note that {@link format}, {@link direction} and {@link disabled_dates} will still apply and will be
     *      taken into account when validating the date. The other properties will be ignored as these are specific
     *      to Zebra_DatePicker.
     *
     *  @since  2.8.7
     *
     *  @return void
     */
    function disable_zebra_datepicker() {

        $this->set_attributes(array('disable_zebra_datepicker' => true));

    }

    /**
     *  An array of selectable value for `am` / `pm`.
     *
     *  @param  mixed   $enabled_ampm   An array of selectable am/pm.
     *
     *                                  Allowed values are `['am']`, `['pm']`, or `['am', 'pm']`.
     *
     *                                  >   Applies only when format contains `A` or `a`. Note that even when only one
     *                                      is enabled, the `onChange()` event will still be triggered when clicking the
     *                                      up/down buttons next to AM/PM on the timepicker.
     *
     *                                  Default is `false` (both `am` and `pm` are selectable).
     *
     *  @since 2.10.0
     *
     *  @return void
     */
    function enabled_ampm($enabled_ampm = false) {

        // set the date picker's attribute
        $this->set_attributes(array('enabled_ampm' => $enabled_ampm));

    }

    /**
     *  Enables selection of specific dates or range of dates in the calendar, after dates have been previously disabled
     *  via {@link disabled_dates}.
     *
     *  @param  array   $enabled_dates      An array of enabled dates in the same format as required by {@link disabled_dates}.
     *
     *                                      To be used together with {@link disabled_dates} by first setting the {@link disabled_dates}
     *                                      property to something like `[&#42; &#42; &#42; &#42;]` (which will disable
     *                                      everything) and then setting the `enabled_dates` property to, say,
     *                                      `[&#42; &#42; &#42; 0,6]` to enable just weekends.
     *
     *                                      Default is `false`, all dates are enabled (unless, explicitly disabled via
     *                                      {@link disabled_dates}).
     *
     *  @since 2.9.3
     *
     *  @return void
     */
    function enabled_dates($enabled_dates = false) {

        // set the date picker's attribute
        $this->set_attributes(array('enabled_dates' => $enabled_dates));

    }

    /**
     *  An array of selectable hours.
     *
     *  >   Applies only when format contains one of the following characters: `H`, `G`, `h`, `g`.
     *
     *  @param  mixed   $enabled_hours      Valid values are between `0-24` (not padded with `0`!) when format  contains
     *                                      `H` or `G` characters, and between `1-12` (not padded with `0`!) when format
     *                                      contains `h` or `g` characters.
     *
     *                                      Default is `false`, all hours are enabled.
     *
     *  @since 3.0.0
     *
     *  @return void
     */
    function enabled_hours($enabled_hours = false) {

        // set the date picker's attribute
        $this->set_attributes(array('enabled_hours' => $enabled_hours));

    }

    /**
     *  An array of selectable minutes.
     *
     *  >   Applies only when format contains the `i` character.
     *
     *  @param  mixed   $enabled_minutes    Valid values are between `0-59` (not padded with `0`!)
     *
     *                                      Default is `false`, all minutes are enabled.
     *
     *  @since 3.0.0
     *
     *  @return void
     */
    function enabled_minutes($enabled_minutes = false) {

        // set the date picker's attribute
        $this->set_attributes(array('enabled_minutes' => $enabled_minutes));

    }

    /**
     *  An array of selectable seconds.
     *
     *  >   Applies only when format contains the `s` character.
     *
     *  @param  mixed   $enabled_seconds    Valid values are between `0-59` (not padded with `0`!)
     *
     *                                      Default is `false`, all minutes are enabled.
     *
     *  @since 3.0.0
     *
     *  @return void
     */
    function enabled_seconds($enabled_seconds = false) {

        // set the date picker's attribute
        $this->set_attributes(array('enabled_seconds' => $enabled_seconds));

    }

    /**
     *  Allows users to quickly navigate through months and years by clicking on the date picker's top label.
     *
     *  @param  boolean $enabled            Allows or disallow users to quickly navigate through months and years by
     *                                      clicking on the date picker's top label.
     *
     *                                      Default is `true`.
     *
     *  @since 3.0.0
     *
     *  @return void
     */
    function fast_navigation($enabled = true) {

        // set the date picker's attribute
        $this->set_attributes(array('fast_navigation' => $enabled));

    }

    /**
     *  Week's starting day.
     *
     *  @param  integer $day    Valid values are `0` to `6` (`Sunday` to `Saturday`).
     *
     *                          Default is `1` (`Monday`).
     *
     *  @return void
     */
    function first_day_of_week($day = '1') {

        // set the date picker's attribute
        $this->set_attributes(array('first_day_of_week' => $day));

    }

    /**
     *  Sets the format of the returned date.
     *
     *  @param  string  $format     Format of the returned date.
     *
     *                              Accepts the following characters for date formatting: `d`, `D`, `j`, `l`, `N`, `w`,
     *                              `S`, `F`, `m`, `M`, `n`, `Y` and `y`, borrowing syntax from ({@link http://www.php.net/manual/en/function.date.php PHP's date function}).
     *
     *                              If format property contains time-related characters (`g`, `G`, `h`, `H`, `i`, `s`, `a`, `A`),
     *                              the time picker will be automatically enabled.
     *
     *                              >   If you want to use a format that involves time but you don't want the time picker,
     *                                  set the {@link disable_time_picker} property to true.
     *
     *                              Note that when setting a date format without days (`d`, `j`), the users will be able
     *                              to select only years and months, and when setting a format without months and days
     *                              (`F`, `m`, `M`, `n`, `t`, `d`, `j`), the users will be able to select only years.
     *
     *                              >   Setting a time format containing `a` or `A` (12-hour format) but using `H` or `G`
     *                                  as the hour's format will result in the hour's format being automatically changed
     *                                  to `h` or `g`, respectively.
     *
     *                              Also note that the value of {@link view} may be overridden if it is the case: a value
     *                              of `days` for the `view` property makes no sense if the date format doesn't allow the
     *                              selection of days.
     *
     *                              Default format is `Y-m-d`
     *
     *  @return void
     */
    function format($format = 'Y-m-d') {

        // set the date picker's attribute
        $this->set_attributes(array('format' => $format));

    }

    /**
     *  >   To be used after the form is submitted!
     *
     *  Returns submitted date in the `YYYY-MM-DD` format so that it's directly usable with a database engine or with
     *  PHP's {@link http://php.net/manual/en/function.strtotime.php strtotime} function.
     *
     *  @return string  Returns submitted date in the `YYYY-MM-DD` format, or *an empty string* if control was submitted
     *                  with no value (empty).
     */
    function get_date() {

        $result = $this->get_attributes('date');

        // if control had a value return it, or return an empty string otherwise
        return (isset($result['date'])) ? $result['date'] : '';

    }

    /**
     *  Captions in the datepicker's header, for the 3 possible views: `days`, `months`, `years`.
     *
     *  <code>
     *  header_captions(array(
     *      'days'      =>  'Departure:<br>F, Y',
     *      'months'    =>  'Departure:<br>Y',
     *      'years'     =>  'Departure:<br>Y1 - Y2'
     *  ));
     *  </code>
     *
     *  Default is
     *
     *  <code>
     *  header_captions(array(
     *      'days'      =>  'F, Y',
     *      'months'    =>  'Y',
     *      'years'     =>  'Y1 - Y2'
     *  ));
     *  </code>
     *
     *  @param  array   $captions   An associative array containing captions in the datepicker's header, for the 3 possible
     *                              views: days, months, years.
     *
     *                              For each of the 3 views the following special characters may be used borrowing from
     *                              {@link http://www.php.net/manual/en/function.date.php PHP's date function}'s syntax:
     *                              `m`, `n`, `F`, `M`, `y` and `Y`; any of these will be replaced at runtime with the
     *                              appropriate date fragment, depending on the currently viewed date.
     *
     *                              Two more special characters are also available `Y1` and `Y2` (upper case representing
     *                              years with 4 digits, lowercase representing years with 2 digits) which represent
     *                              *currently selected year - 7* and *currently selected year + 4*, and which only make
     *                              sense used in the `years` view.
     *
     *                              Even though any of these special characters may be used in any of the 3 views, you
     *                              should use `m`, `n`, `F`, `M` for the `days` view and `y`, `Y`, `Y1`, `Y2`, `y1`, `y2`
     *                              for the `months` and `years` view, or you may get unexpected results!
     *
     *                              Text and HTML can also be used, and will be rendered as it is, as in the example below
     *                              (the library is smart enough to not replace special characters when used in words or
     *                              HTML tags).
     *
     *  @return void
     */
    function header_captions($captions) {

        // set the date picker's attribute
        $this->set_attributes(array('header_captions' => $captions));

    }

    /**
     *  The left and right white-space around the icon.
     *
     *  <code>
     *  $datepicker = $form->add('date', 'my_date');
     *
     *  // 5px margins on the left and right of the icon
     *  $datepicker->icon_margin(5);
     *  </code>
     *
     *  @param  mixed   $margin     If {@link inside} is `true` then the target element's padding will be altered so that
     *                              the element's left or right padding (depending on the value of icon_position) will be
     *                              `2 x icon_margin` plus the icon's width.
     *
     *                              If {@link inside} is `false`, then this will be the distance between the element and
     *                              the icon.
     *
     *                              Leave it to `false` to use the element's existing padding.
     *
     *  @since 3.0.0
     *
     *  @return void
     */
    function icon_margin($margin = 'false') {

        // set the date picker's attribute
        $this->set_attributes(array('icon_margin' => $margin));

    }

    /**
     *  The position of the date picker's icon inside the element it is attached to.
     *
     *  <code>
     *  $datepicker = $form->add('date', 'my_date');
     *
     *  // position the date picker's icon to the left
     *  $datepicker->icon_position('left');
     *  </code>
     *
     *  @param  string  $position   The position of the date picker's icon inside the element it is attached to.
     *
     *                              Possible values are `left` and `right`.
     *
     *                              Default is `right`.
     *
     *  @since 2.9.8
     *
     *  @return void
     */
    function icon_position($position = 'right') {

        // set the date picker's attribute
        $this->set_attributes(array('icon_position' => $position));

    }

    /**
     *  Sets whether the icon for opening the datepicker should be inside or outside the element.
     *
     *  @param  boolean $value      If set to `false`, the icon will be placed to the right (or left, depending on
     *                              {@link icon_position}) of the parent element, while if set to `true` it will be
     *                              placed to the right (or left) of the parent element, but `inside` the element itself.
     *
     *                              Default is `true`.
     *
     *  @return void
     */
    function inside($value = true) {

        // set the date picker's attribute
        $this->set_attributes(array('inside' => $value));

    }

    /**
     *  Sets the HTML to be used for previous/next and up/down buttons, in that order.
     *
     *  @param array    $navigation     An array with 4 elements containing the HTML to be used for previous/next and
     *                                  up/down buttons, in that order.
     *
     *                                  Default is `array('&#9664;', '&#9654;', '&#9650;', '&#9660;')`
     *
     *  @return void
     */
    function navigation($navigation = array('&#9664;', '&#9654;', '&#9650;', '&#9660;')) {

        // set the date picker's attribute
        $this->set_attributes(array('navigation' => $navigation));

    }

    /**
     *  Sets the offset, in pixels (x, y), to shift the date picker's position relative to the top-right of the icon that
     *  toggles the date picker or, if the icon is disabled, relative to the top-right corner of the element the date picker
     *  is attached to.
     *
     *  @param  array  $value       An array indicating the offset, in pixels (x, y), to shift the date picker's position
     *                              relative to the top-right of the icon that toggles the date picker or, if the icon is
     *                              disabled, relative to the top-right corner of the element the date picker is attached to.
     *
     *                              >   Note that this only applies if the position of the calendar, relative to the
     *                                  browser's viewport, doesn't require the date picker to be placed automatically
     *                                  so that it is visible!
     *
     *                              Default is `array(5, -5)`.
     *
     *  @return void
     */
    function offset($value = array(-5, 5)) {

        // set the date picker's attribute
        $this->set_attributes(array('offset' => $value));

    }

    /**
     *  Sets whether the date picker should be shown *only* when clicking the icon.
     *
     *  @param  boolean $value      When set to `true`, the date picker will show *only* when users click on the associated
     *                              icon, and not also when clicking the associated element.
     *
     *                              Default is `false`.
     *
     *  @return void
     */
    function open_icon_only($value) {

        // set the date picker's attribute
        $this->set_attributes(array('open_icon_only' => $value));

    }

    /**
     *  Sets whether the date picker should be shown when parent element and or calendar icon receives focus.
     *
     *  @param  boolean $value      Set this property to `true` if you want the date picker to be shown when the parent
     *                              element (if {@link open_icon_only} is **not** set to `false`) or the associated calendar
     *                              icon (if {@link show_icon} is **not** set to `false`) receive focus.
     *
     *                              Default is `false`.
     *
     *  @since 3.0.0
     *
     *  @return void
     */
    function open_on_focus($value) {

        // set the date picker's attribute
        $this->set_attributes(array('open_on_focus' => $value));

    }

    /**
     *  Pairs the current date element with another one and the other date picker will use the current date picker's
     *  value as starting date.
     *
     *  <code>
     *  // let's assume this will be the starting date
     *  $start = $form->add('date', 'starting_date');
     *
     *  // dates are selectable in the future, starting with today
     *  $start->direction(true);
     *
     *  // indicate another date element that will use this
     *  // element's value as starting date
     *  $start->pair('ending_date');
     *
     *  // the other date element
     *  $end = $form->add('date', 'ending_date');
     *
     *  // start one day after the reference date
     *  // (that is, one day after whatever is selected in the first element)
     *  $end->direction(1);
     *  </code>
     *
     *  @param  string  $value      The `id` of another {@link Zebra_Form_Date date element} which will use the current
     *                              date element's value as starting date.
     *
     *                              >   The rules set in {@link direction} will still apply, but the reference date
     *                                  will not be the current system date but the value selected in the current date
     *                                  picker.
     *
     *                              >   Use this property only on the date picker containing the **starting date** and
     *                                  not also on the one with the **ending date**, or the direction property of the
     *                                  second date picker will not work as expected!
     *
     *                              Default is `false` (not paired with another date picker)
     *
     *  @return void
     */
    function pair($value) {

        // set the date picker's attribute
        $this->set_attributes(array('pair' => '$(\'#' . $value . '\')'));

    }

    /**
     *  Whether text should be drawn from right to left.
     *
     *  @param  boolean $value      If set to `true`, all text in the datepicker will be written from right to left.
     *
     *                              Default is `false`.
     *
     *  @since 3.0.0
     *
     *  @return void
     */
    function rtl($value = false) {

        // set the date picker's attribute
        $this->set_attributes(array('rtl' => $value));

    }

    /**
     *  Sets whether the element the calendar is attached to should be read-only.
     *
     *  @param  boolean $value      If set to `true`, a date can be set only through the date picker and cannot be entered
     *                              manually.
     *
     *                              Default is `true`.
     *
     *  @return void
     */
    function readonly_element($value) {

        // set the date picker's attribute
        $this->set_attributes(array('readonly_element' => $value));

    }

    /**
     *  Should days from previous and/or next month be selectable when visible?
     *
     *  @param  string  $value      The setting's value
     *
     *                              >   Note that if set to `true`, the value of {@link show_other_months} will be considered
     *                                  `true` regardless of the actual value!
     *
     *                              Default is `true`.
     *
     *  @since 2.9.3
     *
     *  @return void
     */
    function select_other_months($value) {

        // set the date picker's attribute
        $this->set_attributes(array('select_other_months' => $value));

    }

    /**
     *  Should the `Clear date` button be visible?
     *
     *  @param  string  $value      The setting's value
     *
     *                              Accepted values are:
     *
     *                              -   `0` - the button for clearing a previously selected date is shown only if a
     *                                  previously selected date already exists; this means that if there's no date selected,
     *                                  this button will not be visible; once the user picked a date and opens the date
     *                                  picker again, this time the button will be visible.
     *
     *                              -   `true` will make the button visible all the time
     *
     *                              -   `false` will disable the button
     *
     *                              Default is `0`
     *
     *  @return void
     */
    function show_clear_date($value = 0) {

        // set the date picker's attribute
        $this->set_attributes(array('show_clear_date' => $value));

    }

    /**
     *  Should a calendar icon be added to the elements the plugin is attached to?
     *
     *  <code>
     *  $datepicker = $form->add('date', 'my_date');
     *
     *  // do not show the icon
     *  $datepicker->show_icon(false);
     *  </code>
     *
     *  @param  boolean $visible    Set this property's value to boolean `false` if you don't want the calendar icon.
     *
     *                              Note that the text is not visible by default since `text-indentation` is set to a big
     *                              negative value in the CSS, so you might want to change that in case you want to make
     *                              the text visible.
     *
     *                              When **not** set to boolean `false`, the plugin will attach a calendar icon to the
     *                              elements the plugin is attached to.
     *
     *                              Default is `Pick a date`
     *
     *  @since 2.9.8
     *
     *  @return void
     */
    function show_icon($visible) {

        // set the date picker's attribute
        $this->set_attributes(array('show_icon' => $visible));

    }

    /**
     *  Should days from previous and/or next month be visible?
     *
     *  @param  string  $value      The setting's value
     *
     *                              Default is `true`
     *
     *  @since 2.9.3
     *
     *  @return void
     */
    function show_other_months($value = true) {

        // set the date picker's attribute
        $this->set_attributes(array('show_other_months' => $value));

    }

    /**
     *  Should the "Today" button be visible?
     *
     *  @param  string  $value      The setting's value
     *
     *                              Setting this property to anything but a boolean FALSE will enable the button and
     *                              will use the property's value as caption for the button; setting it to FALSE will
     *                              disable the button.
     *
     *                              Default is "Today"
     *
     *  @since 2.9.4
     *
     *  @return void
     */
    function show_select_today($value = 'Today') {

        // set the date picker's attribute
        $this->set_attributes(array('show_select_today' => $value));

    }

    /**
     *  Sets whether an extra column should be shown, showing the number of each week.
     *
     *  @param  string  $value      Anything other than FALSE will enable this feature, and use the given value as column
     *                              title. For example, show_week_number: ‘Wk’ would enable this feature and have "Wk" as
     *                              the column’s title.
     *
     *                              Default is FALSE.
     *
     *  @return void
     */
    function show_week_number($value) {

        // set the date picker's attribute
        $this->set_attributes(array('show_week_number' => $value));

    }

    /**
     *  Sets a default date to start the date picker with.
     *
     *  @param  date    $value      A default date to start the date picker with,
     *
     *                              Must be specified in the format defined by the "format" property, or it will be
     *                              ignored!
     *
     *                              Note that this value is used only if there is no value in the field the date picker
     *                              is attached to!
     *
     *                              Default is FALSE.
     *
     *  @return void
     */
    function start_date($value) {

        // set the date picker's attribute
        $this->set_attributes(array('start_date' => $value));

    }

    /**
     *  Sets whether default values, in the input field the date picker is attached to, be deleted if they are not valid
     *  according to {@link direction() direction} and/or {@link disabled_dates() disabled_dates}.
     *
     *  @param  boolean $value      If set to TRUE, default values, in the input field the date picker is attached to,
     *                              will be deleted if they are not valid according to {@link direction() direction}
     *                              and/or {@link disabled_dates() disabled_dates}.
     *
     *                              Default is FALSE.
     *
     *  @return void
     */
    function strict($value) {

        // set the date picker's attribute
        $this->set_attributes(array('strict' => $value));

    }

    /**
     *  Sets how should the date picker start.
     *
     *  @param  string  $view       How should the date picker start.
     *
     *                              Valid values are "days", "months" and "years".
     *
     *                              Note that the date picker is always cycling days-months-years when clicking in the
     *                              date picker's header, and years-months-days when selecting dates (unless one or more
     *                              of the views are missing due to the date's format)
     *
     *                              Also note that the value of the "view" property may be overridden if the date's format
     *                              requires so! (i.e. "days" for the "view" property makes no sense if the date format
     *                              doesn't allow the selection of days)
     *
     *                              Default is "days".
     *
     *  @return void
     */
    function view($view) {

        // set the date picker's attribute
        $this->set_attributes(array('view' => $view));

    }

    /**
     *  Sets the days of the week that are to be considered  as "weekend days".
     *
     *  @param  array   $days       An array of days of the week that are to be considered  as "weekend days".
     *
     *                              Valid values are 0 to 6 (Sunday to Saturday).
     *
     *                              Default is array(0,6) (Saturday and Sunday).
     *
     *  @return void
     */
    function weekend_days($days) {

        // set the date picker's attribute
        $this->set_attributes(array('weekend_days' => $days));

    }

    /**
     *  Should day numbers < 10 be padded with zero?
     *
     *  @param  boolean $state      When set to TRUE, day numbers < 10 will be prefixed with 0.
     *
     *                              Default is FALSE.
     *
     *  @return void
     */
    function zero_pad($state) {

        // set the date picker's attribute
        $this->set_attributes(array('zero_pad' => $state));

    }

    /**
     *  Generates the control's HTML code.
     *
     *  <i>This method is automatically called by the {@link Zebra_Form::render() render()} method!</i>
     *
     *  @return string  Returns the form element's generated HTML code.
     */
    function toHTML() {

        // all date controls must have the "date" rule set or we trigger an error
        if (!isset($this->rules['date'])) _zebra_form_show_error('The control named <strong>"' . $this->attributes['name'] . '"</strong> in form <strong>"' . $this->form_properties['name'] . '"</strong> must have the <em>"date"</em> rule set', E_USER_ERROR);

        return '
            <input ' . $this->_render_attributes() . ($this->form_properties['doctype'] == 'xhtml' ? '/' : '') . '>
        ';

    }

    /**
     *  Initializes the datepicker's data so calculations for disabled dates can be done.
     *
     *  Returns an array with two values: the first and the last selectable dates, as UNIX timestamps.
     *
     *  If a value does not apply (i.e. no starting or no ending date), the value will be "0".
     *
     *  @return array   Returns an array with two values: the first and the last selectable dates,
     *                  as UNIX timestamps.
     *
     *  @access private
     */
    function _init() {

        // do these calculations only once
        if (!isset($this->limits)) {

            // get current system date
            $system_date = time();

            // check if the calendar has any restrictions

            // calendar is future-only, starting today
            // it means we have a starting date (the current system date), but no ending date
            if ($this->attributes['direction'] === true) $this->first_selectable_date = $system_date;

            // calendar is past only, ending today
            // it means we have an ending date (the reference date), but no starting date
            else if ($this->attributes['direction'] === false) $this->last_selectable_date = $system_date;

            else if (

                // if direction is not given as an array and the value is an integer > 0
                (!is_array($this->attributes['direction']) && (int)($this->attributes['direction']) > 0) ||

                // or direction is given as an array
                (is_array($this->attributes['direction']) && (

                    // and first entry is boolean TRUE
                    $this->attributes['direction'][0] === true ||
                    // or a valid date
                    ($tmp_start_date = $this->_is_format_valid($this->attributes['direction'][0])) ||
                    // or an integer > 0
                    (is_numeric($this->attributes['direction'][0]) && $this->attributes['direction'][0] > 0)

                ) && (

                    // and second entry is boolean FALSE
                    $this->attributes['direction'][1] === false ||
                    // or a valid date
                    ($tmp_end_date = $this->_is_format_valid($this->attributes['direction'][1])) ||
                    // or integer >= 0
                    (is_numeric($this->attributes['direction'][1]) && $this->attributes['direction'][1] >= 0)

                ))

            ) {

                // if an exact starting date was given, use that as a starting date
                if (isset($tmp_start_date)) $this->first_selectable_date = $tmp_start_date;

                // otherwise
                else

                    // figure out the starting date
                    $this->first_selectable_date = strtotime('+' . (!is_array($this->attributes['direction']) ? (int)($this->attributes['direction']) : (int)($this->attributes['direction'][0] === true ? 0 : $this->attributes['direction'][0])) . ' day', $system_date);

                // if an exact ending date was given and the date is after the starting date, use that as a ending date
                if (isset($tmp_end_date) && $tmp_end_date >= $this->first_selectable_date) $this->last_selectable_date = $tmp_end_date;

                // if have information about the ending date
                else if (!isset($tmp_end_date) && $this->attributes['direction'][1] !== false && is_array($this->attributes['direction']))

                    // figure out the ending date
                    $this->last_selectable_date = strtotime('+' . (int)($this->attributes['direction'][1]) . ' day', $system_date);

            } else if (

                // if direction is not given as an array and the value is an integer < 0
                (!is_array($this->attributes['direction']) && is_numeric($this->attributes['direction']) && $this->attributes['direction'] < 0) ||

                // or direction is given as an array
                (is_array($this->attributes['direction']) && (

                    // and first entry is boolean FALSE
                    $this->attributes['direction'][0] === false ||
                    // or an integer < 0
                    (is_numeric($this->attributes['direction'][0]) && $this->attributes['direction'][0] < 0)

                ) && (

                    // and second entry is integer >= 0
                    (is_numeric($this->attributes['direction'][1]) && $this->attributes['direction'][1] >= 0) ||
                    // or a valid date
                    ($tmp_start_date = $this->_is_format_valid($this->attributes['direction'][1]))

                ))

            ) {

                // figure out the ending date
                $this->last_selectable_date = strtotime('+' . (!is_array($this->attributes['direction']) ? (int)($this->attributes['direction']) : (int)($this->attributes['direction'][0] === false ? 0 : $this->attributes['direction'][0])) . ' day', $system_date);

                // if an exact starting date was given, and the date is before the ending date, use that as a starting date
                if (isset($tmp_start_date) && $tmp_start_date < $this->last_selectable_date) $this->first_selectable_date = $tmp_start_date;

                // if have information about the starting date
                else if (!isset($tmp_start_date) && is_array($this->attributes['direction']))

                    // figure out the staring date
                    $this->first_selectable_date = strtotime('-' . (int)($this->attributes['direction'][1]) . ' day');

            }

            // if a first selectable date exists
            if (isset($this->first_selectable_date)) {

                // extract the date parts
                $first_selectable_year = date('Y', $this->first_selectable_date);
                $first_selectable_month = date('m', $this->first_selectable_date);
                $first_selectable_day = date('d', $this->first_selectable_date);

            }

            // if a last selectable date exists
            if (isset($this->last_selectable_date)) {

                // extract the date parts
                $last_selectable_year = date('Y', $this->last_selectable_date);
                $last_selectable_month = date('m', $this->last_selectable_date);
                $last_selectable_day = date('d', $this->last_selectable_date);

            }

            // if a first selectable date exists but is disabled, find the actual first selectable date
            if (isset($this->first_selectable_date) && $this->_is_disabled($first_selectable_year, $first_selectable_month, $first_selectable_day)) {

                // loop until we find the first selectable year
                while ($this->_is_disabled($first_selectable_year)) {

                    // if calendar is past-only, decrement the year
                    if ($this->first_selectable_date < 0 || $this->first_selectable_date === false) $first_selectable_year--;

                    // otherwise, increment the year
                    else $first_selectable_year++;

                    // because we've changed years, reset the month to January
                    $first_selectable_month = 1;

                }

                // loop until we find the first selectable month
                while ($this->_is_disabled($first_selectable_year, $first_selectable_month)) {

                    // if calendar is past-only, decrement the month
                    if ($this->first_selectable_date < 0 || $this->first_selectable_date === false) $first_selectable_month--;

                    // otherwise, increment the month
                    else $first_selectable_month++;

                    // if we moved to a following year
                    if ($first_selectable_month > 12) {

                        // increment the year
                        $first_selectable_year++;

                        // reset the month to January
                        $first_selectable_month = 1;

                    // if we moved to a previous year
                    } else if ($first_selectable_month < 1) {

                        // decrement the year
                        $first_selectable_year--;

                        // reset the month to January
                        $first_selectable_month = 1;

                    }

                    // because we've changed months, reset the day to the first day of the month
                    $first_selectable_day = 1;

                }

                // loop until we find the first selectable day
                while ($this->_is_disabled($first_selectable_year, $first_selectable_month, $first_selectable_day))

                    // if calendar is past-only, decrement the day
                    if ($this->first_selectable_date < 0 || $this->first_selectable_date === false) $first_selectable_day--;

                    // otherwise, increment the day
                    else $first_selectable_day++;

                // use mktime() to normalize the date
                // for example, 2011 05 33 will be transformed to 2011 06 02
                $this->first_selectable_date = mktime(12, 0, 0, $first_selectable_month, $first_selectable_day, $first_selectable_year);

                // re-extract date parts from the normalized date
                // as we use them in the current loop
                // extract the date parts
                $first_selectable_year = date('Y', $this->first_selectable_date);
                $first_selectable_month = date('m', $this->first_selectable_date);
                $first_selectable_day = date('d', $this->first_selectable_date);

            }

            // save first and last selectable dates, as UNIX timestamps (or "0" if does not apply)
            $this->limits = array(isset($this->first_selectable_date) ? $this->first_selectable_date : 0, isset($this->last_selectable_date) ? $this->last_selectable_date : 0);

        }

        // return first and last selectable dates, as UNIX timestamps (or "0" if does not apply)
        return $this->limits;

    }

    /**
     *  Checks if the enetered value is a valid date in the right format.
     *
     *  @return mixed   Returns the UNIX timestamp of the checked date, if the date has the correct format,
     *                  or FALSE otherwise.
     *
     *  @access private
     */
    function _is_format_valid($date) {

        // the format we expect the date to be
        // escape characters that would make sense as regular expression
        $format = preg_quote($this->attributes['format']);

        // parse the format and extract the characters that define the format
        // (note that we're also capturing the offsets)
        preg_match_all('/[dDjlNSwFmMnYyGHghaAisU]{1}/', $format, $matches, PREG_OFFSET_CAPTURE);

        $regexp = array();

        // iterate through the found characters
        // and create the regular expression that we will use to see if the entered date is ok
        foreach ($matches[0] as $match) {

            switch ($match[0]) {

                // day of the month, 2 digits with leading zeros, 01 to 31
                case 'd': $regexp[] = '0[1-9]|[12][0-9]|3[01]'; break;

                // a textual representation of a day, three letters, mon through sun
                case 'D': $regexp[] = '[a-z]{3}'; break;

                // day of the month without leading zeros, 1 to 31
                case 'j': $regexp[] = '[1-9]|[12][0-9]|3[01]'; break;

                // a full textual representation of the day of the week, sunday through saturday
                case 'l': $regexp[] = '[a-z]+'; break;

                // ISO-8601 numeric representation of the day of the week (added in PHP 5.1.0), 1 (for Monday) through 7 (for Sunday)
                case 'N': $regexp[] = '[1-7]'; break;

                // english ordinal suffix for the day of the month, 2 characters: st, nd, rd or th. works well with j
                case 'S': $regexp[] = 'st|nd|rd|th'; break;

                // numeric representation of the day of the week, 0 (for sunday) through 6 (for saturday)
                case 'w': $regexp[] = '[0-6]'; break;

                // a full textual representation of a month, such as january or march
                case 'F': $regexp[] = '[a-z]+'; break;

                // numeric representation of a month, with leading zeros, 01 through 12
                case 'm': $regexp[] = '0[1-9]|1[012]+'; break;

                // a short textual representation of a month, three letters, jan through dec
                case 'M': $regexp[] = '[a-z]{3}'; break;

                // numeric representation of a month, without leading zeros, 1 through 12
                case 'n': $regexp[] = '[1-9]|1[012]'; break;

                // a full numeric representation of a year, 4 digits examples: 1999 or 2003
                case 'Y': $regexp[] = '[0-9]{4}'; break;

                // a two digit representation of a year examples: 99 or 03
                case 'y': $regexp[] = '[0-9]{2}'; break;

                // 24-hour format of an hour without leading zeros, 0 through 23
				case 'G': $regexp[] = '[0-9]|1[0-9]|2[0-3]'; break;

                // 24-hour format of an hour with leading zeros, 00 through 23
				case 'H': $regexp[] = '0[0-9]|1[0-9]|2[0-3]'; break;

                // 12-hour format of an hour without leading zeros, 1 through 12
				case 'g': $regexp[] = '[0-9]|1[0-2]'; break;

                // 12-hour format of an hour with leading zeros, 01 through 12
				case 'h': $regexp[] = '0[0-9]|1[0-2]'; break;

                // lowercase ante meridiem and post meridiem am or pm
				case 'a':
				case 'A': $regexp[] = '(am|pm)'; break;

                // minutes with leading zeros, 00 to 59
				case 'i': $regexp[] = '[0-5][0-9]'; break;

                // seconds, with leading zeros 00 through 59
				case 's': $regexp[] = '[0-5][0-9]'; break;

            }

        }

        // if format is defined
        if (!empty($regexp)) {

            // we will replace every format-related character in the format expression with
            // the appropriate regular expression in order to see that valid data was entered
            // as required by the character
            // we are replacing from finish to start so that we don't mess up the offsets
            // therefore, we need to reverse the array first
            $matches[0] = array_reverse($matches[0]);

            // how many characters to replace
            $chars = count($matches[0]);

            // iterate through the characters
            foreach ($matches[0] as $index => $char)

                // and replace them with the appropriate regular expression
                $format = substr_replace($format, '(' . $regexp[$chars - $index - 1] . ')', $matches[0][$index][1], 1);

            // the final regular expression to math the date against
            $format = '/^' . str_replace('/', '\/', $format) . '$/i';

            // if entered value seems to be ok
            if (preg_match($format, $date, $segments)) {

                $original_day = $original_month = $original_year = 0;
                $original_hour = $original_minute = $original_second = $original_format = -1;

                // english names for days and months
                $english_days   = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
                $english_months = array('January','February','March','April','May','June','July','August','September','October','November','December');

                // reverse the characters in the format (remember that we reversed them above)
                $matches[0] = array_reverse($matches[0]);

                $valid = true;

                // iterate through the characters in the format
                // to see if years, months, days, hours, minutes and seconds are correct
                // i.e. if for month we entered "abc" it would pass our regular expression but
                // now we will check if the three letter text is an actual month
                foreach ($matches[0] as $index => $match) {

                    switch ($match[0]) {

                        // numeric representation of a month, with leading zeros, 01 through 12
                        case 'm':
                        // numeric representation of a month, without leading zeros, 1 through 12
                        case 'n':

                            $original_month = (int)($segments[$index + 1] - 1);

                            break;

                        // day of the month, 2 digits with leading zeros, 01 to 31
                        case 'd':
                        // day of the month without leading zeros, 1 to 31
                        case 'j':

                            $original_day = (int)($segments[$index + 1]);

                            break;

                        // a textual representation of a day, three letters, mon through sun
                        case 'D':
                        // a full textual representation of the day of the week, sunday through saturday
                        case 'l':
                        // a full textual representation of a month, such as january or march
                        case 'F':
                        // a short textual representation of a month, three letters, jan through dec
                        case 'M':

                            // by default, we assume that the text is invalid
                            $valid = false;

                            // iterate through the values in the language file
                            foreach ($this->form_properties['language'][($match[0] == 'F' || $match[0] == 'M' ? 'months' : 'days')] as $key => $value) {

                                // if value matches the value from the language file
                                if (strtolower($segments[$index + 1]) == strtolower(substr($value, 0, ($match[0] == 'D' || $match[0] == 'M' ? 3 : strlen($value))))) {

                                    // replace with the english value
                                    // this is because later on we'll run strtotime of the entered value and strtotime parses english dates
                                    switch ($match[0]) {
                                        case 'D': $segments[$index + 1] = substr($english_days[$key], 0, 3); break;
                                        case 'l': $segments[$index + 1] = $english_days[$key]; break;
                                        case 'F': $segments[$index + 1] = $english_months[$key]; $original_month = $key; break;
                                        case 'M': $segments[$index + 1] = substr($english_months[$key], 0, 3); $original_month = $key; break;
                                    }

                                    // flag the value as valid
                                    $valid = true;

                                    // don't look further
                                    break;

                                }

                            }

                            // if an invalid was found don't look any further
                            if (!$valid) break 2;

                            break;

                        // a full numeric representation of a year, 4 digits examples: 1999 or 2003
                        case 'Y':

                            $original_year = (int)($segments[$index + 1]);

                            break;

                        // a two digit representation of a year examples: 99 or 03
                        case 'y':

                            $original_year = (int)('19' . $segments[$index + 1]);

                            break;

                        // 24-hour format of an hour without leading zeros, 0 through 23
        				case 'G':
                        // 24-hour format of an hour with leading zeros, 00 through 23
        				case 'H':
                        // 12-hour format of an hour without leading zeros, 1 through 12
        				case 'g':
                        // 12-hour format of an hour with leading zeros, 01 through 12
        				case 'h':

                            $original_hour = (int)($segments[$index + 1]);

                            break;

                        // lowercase ante meridiem and post meridiem am or pm
        				case 'a':
        				case 'A':

                            $original_format = $segments[$index + 1];

                            break;

                        // minutes with leading zeros, 00 to 59
        				case 'i':

                            $original_minute = (int)($segments[$index + 1]);

                            break;

                        // seconds, with leading zeros 00 through 59
        				case 's':

                            $original_second = (int)($segments[$index + 1]);

                            break;

                    }

                }

                // if entered value seems valid
                if ($valid) {

                    // if date format does not include day, make day = 1
                    if ($original_day == 0) $original_day = 1;

                    // if date format does not include month, make month = 0 (January)
                    if ($original_month == 0) $original_month = 0;

                    // if date format does not include year, use the current year
                    if ($original_year == 0) $original_year = date('Y');

                    // if date is still valid after we process it with strtotime
                    // (we do this because, so far, a date like "Feb 31 2010" would be valid
                    // but strtotime would turn that to "Mar 03 2010")
                    if (

                        $english_months[$original_month] . ' ' . str_pad($original_day, 2, '0', STR_PAD_LEFT) . ', ' . $original_year ==
                        date('F d, Y', strtotime($english_months[$original_month] . ' ' . $original_day . ', ' . $original_year))

                    ) {

                        // make sure we also return the date as YYYY-MM-DD so that it can be
                        // easily used with a database or with PHP's strtotime function
                        $this->attributes['date'] = $original_year . '-' . str_pad($original_month + 1, 2, '0', STR_PAD_LEFT) . '-' . str_pad($original_day, 2, '0', STR_PAD_LEFT);

                        return strtotime($original_year . '-' . ($original_month + 1) . '-' . $original_day);

                    }

                }

            }

        }

        // if script gets this far, return FALSE as something must've been wrong
        return false;

    }

    /**
     *  Checks if, according to the restrictions of the calendar and/or the values defined by the "disabled_dates"
     *  property, a day, a month or a year needs to be disabled.
     *
     *  @param  integer     $year   The year to check
     *  @param  integer     $month  The month to check
     *  @param  integer     $day    The day to check
     *
     *  @return boolean         Returns TRUE if the given value is not disabled or FALSE otherwise
     *
     *  @access private
     */
    function _is_disabled($year, $month = '', $day = '') {

        // parse the rules for disabling dates and turn them into arrays of arrays
        if (!isset($this->disabled_dates)) {

            // array that will hold the rules for disabling dates
            $this->disabled_dates = array();

            // if disabled dates is an array and is not empty
            if (is_array($this->attributes['disabled_dates']) && !empty($this->attributes['disabled_dates']))

                // iterate through the rules for disabling dates
                foreach ($this->attributes['disabled_dates'] as $value) {

                    // split the values in rule by white space
                    $rules = explode(' ', $value);

                    // there can be a maximum of 4 rules (days, months, years and, optionally, day of the week)
                    for ($i = 0; $i < 4; $i++) {

                        // if one of the values is not available
                        // replace it with a * (wildcard)
                        if (!isset($rules[$i])) $rules[$i] = '*';

                        // if rule contains a comma, create a new array by splitting the rule by commas
                        // if there are no commas create an array containing the rule's string
                        $rules[$i] = (strpos($rules[$i], ',') !== false ? explode(',', $rules[$i]) : (array)$rules[$i]);

                        // iterate through the items in the rule
                        for ($j = 0; $j < count($rules[$i]); $j++)

                            // if item contains a dash (defining a range)
                            if (strpos($rules[$i][$j], '-') !== false) {

                                // get the lower and upper limits of the range
                                // if range is valid
                                if (preg_match('/^([0-9]+)\-([0-9]+)/', $rules[$i][$j], $limits) > 0) {

                                    // remove the range indicator
                                    array_splice($rules[$i], $j, 1);

                                    // iterate through the range
                                    for ($k = $limits[1]; $k <= $limits[2]; $k++)

                                        // if value is not already among the values of the rule
                                        // add it to the rule
                                        if (!in_array($k, $rules[$i])) $rules[$i][] = (int)$k;

                                }

                            // make sure to convert things like "01" to "1"
                            } elseif ($rules[$i][$j] != '*') $rules[$i][$j] = (int)$rules[$i][$j];

                    }

                    // add to the list of processed rules
                    $this->disabled_dates[] = $rules;

                }

        }

        // if calendar has direction restrictions
        if (!(!is_array($this->attributes['direction']) && (int)($this->attributes['direction']) === 0)) {

            // if a first selectable date exists
            if (isset($this->first_selectable_date)) {

                // extract the date parts
                $first_selectable_year = date('Y', $this->first_selectable_date);
                $first_selectable_month = date('m', $this->first_selectable_date);
                $first_selectable_day = date('d', $this->first_selectable_date);

            }

            // if a last selectable date exists
            if (isset($this->last_selectable_date)) {

                // extract the date parts
                $last_selectable_year = date('Y', $this->last_selectable_date);
                $last_selectable_month = date('m', $this->last_selectable_date);
                $last_selectable_day = date('d', $this->last_selectable_date);

            }

            // normalize and merge arguments then transform the result to an integer
            $now = $year . ($month != '' ? str_pad($month, 2, '0', STR_PAD_LEFT) : '') . ($day != '' ? str_pad($day, 2, '0', STR_PAD_LEFT) : '');

            // if we're checking days
            if (strlen($now) == 8 && (

                // day is before the first selectable date
                (isset($this->first_selectable_date) && $now < $first_selectable_year . $first_selectable_month . $first_selectable_day) ||

                // or day is after the last selectable date
                (isset($this->last_selectable_date) && $now > $last_selectable_year . $last_selectable_month . $last_selectable_day)

            // day needs to be disabled
            )) return true;

            // if we're checking months
            else if (strlen($now) == 6 && (

                // month is before the first selectable month
                (isset($this->first_selectable_date) && $now < $first_selectable_year . $first_selectable_month) ||

                // or month is after the last selectable month
                (isset($this->last_selectable_date) && $now > $last_selectable_year . $last_selectable_month)

            // month needs to be disabled
            )) return true;

            // if we're checking years
            else if (strlen($now) == 4 && (

                // year is before the first selectable year
                (isset($this->first_selectable_date) && $now < $first_selectable_year) ||

                // or year is after the last selectable year
                (isset($this->last_selectable_date) && $now > $last_selectable_year)

            // year needs to be disabled
            )) return true;

        }

        // if there are rules for disabling dates
        if (isset($this->disabled_dates)) {

            // by default, we assume the day/month/year is not to be disabled
            $disabled = false;

            // iterate through the rules for disabling dates
            foreach ($this->disabled_dates as $rule) {

                // if the date is to be disabled, don't look any further
                if ($disabled) return;

                // if the rules apply for the current year
                if (in_array($year, $rule[2]) || in_array('*', $rule[2], true))

                    // if the rules apply for the current month
                    if (($month != '' && in_array($month, $rule[1])) || in_array('*', $rule[1], true))

                        // if the rules apply for the current day
                        if (($day != '' && in_array($day, $rule[0])) || in_array('*', $rule[0], true)) {


                            // if day is to be disabled whatever the day
                            // don't look any further
                            if (in_array('*', $rule[3], true)) return ($disabled = true);

                            // get the weekday
                            $weekday = date('w', mktime(12, 0, 0, $month, $day, $year));

                            // if weekday is to be disabled
                            // don't look any further
                            if (in_array($weekday, $rule[3])) return ($disabled = true);

                        }

            }

            // if the day/month/year needs to be disabled
            if ($disabled) return true;

        }

        // if script gets this far it means that the day/month/year doesn't need to be disabled
        return false;

    }

}
