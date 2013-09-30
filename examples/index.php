<?php
    error_reporting(E_ALL);
    session_start()
?>

<?php
/**
 *  Dumps information about a variable in a human readable format
 *
 *  @param  mixed   $variable   Variable to print information about
 *
 *  @param  boolean $stop       Whether to stop script execution after outputting the variable.
 *
 *                              Default is FALSE
 *
 *  @return void
 */
function dump()
{
    // get the arguments passed to the function
    $arguments = func_get_args();

    // if last argument is boolean TRUE
    if ($arguments[count($arguments) - 1] === true)

        // set a flag telling the script that it needs to die() after output
        $stop = array_pop($arguments);

    // iterate through the arguments
    foreach ($arguments as $argument) {

        // print each argument
        print_r('<pre style="text-align:left">');
        print_r($argument);
        print_r('</pre>');

    }

    // if script needs to die() after output, die
    if (isset($stop)) die();

}
?>

<!doctype html>

<html>

    <head>

        <meta charset="utf-8">

        <title>Zebra_Form, a jQuery augmented PHP library for HTML form building and validation</title>

        <link rel="stylesheet" href="libraries/highlight/public/css/ir_black.css" type="text/css">
        <link rel="stylesheet" href="public/css/reset.css" type="text/css">
        <link rel="stylesheet" href="public/css/style.css" type="text/css">
        <link rel="stylesheet" href="../public/css/zebra_form.css" type="text/css">

    </head>

    <body>

        <div class="header"><a href="http://stefangabos.ro/">Stefan Gabos | <span>webdeveloper</span></a></div>

        <div class="example">
            Example for: <a href="http://stefangabos.ro/php-libraries/zebra-form/">Zebra_Form, a jQuery augmented PHP
            library for HTML form building and validation</a>
        </div>

        <table>

        	<tr>

        		<td valign="top">

                    <?php

                        function show_results() {

                            echo '<table class="results"><thead><tr><td colspan="2">Submitted values</td></tr></thead>';

                            foreach ($_POST as $key => $value) {

                                if (strpos($key, 'name_') !== 0 && strpos($key, 'timer_') !== 0 && strpos($key, 'response_') !== 0)

                                    echo '<tr><th>' . $key . '</th><td>' . (is_array($value) ? '<pre>' . print_r($value, true) . '</pre>' : $value) . '</td></tr>';

                            }

                            echo '</table>';

                        }

                        $demos = array(
                            'A login form'  =>  array('login', array(
                                'Auto template, vertical'       =>  'vertical',
                                'Auto template, horizontal'     =>  'horizontal',
                                'Auto template, labels inside'  =>  'labels-inside',
                                'Custom template - divs'        =>  'divs-custom',
                                'Custom template - tables'      =>  'tables-custom',
                            )),
                            'A contact form'  =>  array('contact', array(
                                'Auto template, vertical'       =>  'vertical',
                                'Auto template, horizontal'     =>  'horizontal',
                                'Custom template'               =>  'custom',
                            )),
                            'A registration form'  =>  array('registration', array(
                                'Auto template, vertical'       =>  'vertical',
                                'Auto template, horizontal'     =>  'horizontal',
                                'Custom template'               =>  'custom',
                            )),
                            'A reservation form'  =>  array('reservation', array(
                                'Auto template, vertical'       =>  'vertical',
                                'Auto template, horizontal'     =>  'horizontal',
                                'Custom template'               =>  'custom',
                                'Auto-fill'                     =>  'autofill-vertical',
                            )),
                            'Dependencies'  =>  array('dependencies', array(
                                'Example 1'                     =>  'example1-custom',
                                'Example 2'                     =>  'example2-custom',
                            )),
                            'File upload'  =>  array('fileupload', array(
                                'Basic file upload'             =>  'basic-vertical',
                                'Basic image upload'            =>  'basic-image-vertical',
                            )),
                            'More rules'  =>  array('validation', array(
                                'Auto template, vertical'       =>  'vertical',
                            )),
                        );

                        $current_template = isset($_GET['template']) ? strtolower($_GET['template']) : '';

                        if (isset($_GET['example']) && is_file('includes/' . $_GET['example'] . '-' . $current_template . '.php')) {

                            $current_example = strtolower($_GET['example']);

                        } else {

                            $current_template = 'vertical';

                            $current_example = 'login';

                        }

                    ?>

                    <ul class="navigation default">

                        <?php foreach ($demos as $title => $values):?>

                        <li><?php echo $title?>

                            <ul>

                            <?php foreach ($values[1] as $example => $template):?>

                                <li>

                                    <a href="?example=<?php echo $values[0]?>&amp;template=<?php echo $template?>"<?php echo ($current_example == $values[0] && $current_template == $template ? ' class="selected"' : '')?>><?php echo $example?></a>

                                </li>

                            <?php endforeach?>

                            </ul>

                        </li>

                        <?php endforeach?>
                    </ul>

                </td>

                <td valign="top">

                    <?php if ($example != ''):?>

                    <ul class="tabs float clearfix">

                        <li><a href="javascript:void(0)" class="selected">Demo</a></li>

                        <li><a href="javascript:void(0)">PHP source</a></li>

                        <li><a href="javascript:void(0)">Template source</a></li>

                        <li><a href="javascript:void(0)">Container HTML</a></li>

                    </ul>

                    <?php for ($i = 0; $i < 5; $i++):?>

                    <div class="tab clearfix"<?php echo $i == 0 ? ' style="display:block"' : ''?>>

                        <?php if ($i == 0):?>

                            <?php require 'includes/' . $current_example . '-' . $current_template . '.php'?>

                        <?php elseif ($i == 1):?>

                        <?php

                            $php_source = file_get_contents('includes/' . $current_example . '-' . $current_template . '.php');

                            $patterns = array(
                                '/^.*?\<\?php/is',
                                '/require \'.*?Zebra\_Form\.php\'/',
                                '/\$form\-\>render\(\'includes\/custom\-templates\/.*?\'\)\;/',
                            );

                            $replacements = array(
                                '<?php',
                                'require \'path/to/Zebra_Form.php\'',
                                '$form->render(\'path/to/custom-template.php\');',
                            );

                            $php_source = preg_replace($patterns, $replacements, $php_source);

                        ?>

                        <pre><code><?php

                            echo trim(htmlentities($php_source));

                        ?></code></pre>

                        <?php elseif ($i == 2):?>

                            <?php if (strpos($current_template, 'custom') === false):?>

                                <p>In this example, the output is automatically generated by Zebra_Form's <strong>render</strong> method.</p>

                            <?php elseif (is_file('includes/custom-templates/' . str_replace('custom-', '', $current_template . '-' . $current_example) . '.php')):?>

                            <pre><code><?php

                                echo trim(htmlentities(file_get_contents('includes/custom-templates/' . str_replace('custom-', '', $current_template . '-' . $current_example) . '.php')));

                            ?></code></pre>

                            <?php else:?>

                                <?php echo 'includes/custom-templates/' . str_replace('custom-', '', $current_template . '-' . $current_example) . '.php' ?>

                            <?php endif?>

                        <?php elseif ($i == 3):?>

                        <?php

                            $html_container_source = file_get_contents('includes/container-html/container.html');

                        ?>

                        <pre><code><?php

                            echo trim(htmlentities($html_container_source));

                        ?></code></pre>

                        <?php endif?>

                        <?php if ($i == 0):?>

                        <ul class="notes default">
                        	<li>
                                try clicking on the submit button without filling the form and then, as you fill the form, to see the
                                JavaScript validation in action
                            </li>
                            <li>for each example, notice how the PHP code of the form remains basically unchanged, despite the template variations</li>
                        	<li>
                                disable JavaScript to see the server-side validation in action
                            </li>
                        	<li>
                                although in all my examples I use HTML output, you can switch to XHTML output by using the
                                <strong>doctye</strong> method
                            </li>
                        	<li>
                                try the example in another browser and see that it works, out of the box. including IE6!
                            </li>
                        </ul>

                        <?php endif?>

                    </div>

                    <?php endfor?>

                    <?php else:?>

                    Use the links to the left to navigate between examples.

                    <?php endif?>

                </td>

        	</tr>

        </table>

        <div class="clear"></div>

        <script type="text/javascript" src="libraries/highlight/public/javascript/highlight.js"></script>
        <script type="text/javascript" src="public/javascript/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="../public/javascript/zebra_form.js"></script>
        <script type="text/javascript" src="public/javascript/core.js"></script>

    </body>

</html>
