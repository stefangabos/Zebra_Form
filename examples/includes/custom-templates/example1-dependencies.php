<!--
    in reality you'd have this in an external stylesheet;
    i am using it like this for the sake of the example
-->
<style type="text/css">
    .Zebra_Form .optional { padding: 10px 50px; display: none }
</style>

<!--
    again, in reality you'd have this in an external JavaScript file;
    i am using it like this for the sake of the example
-->
<script type="text/javascript">
    var mycallback = function(value, segment) {
        $segment = $('.optional' + segment);
        if (value) $segment.show();
        else $segment.hide();
    }
</script>

<?php echo (isset($zf_error) ? $zf_error : (isset($error) ? $error : ''))?>

<div class="row">
    <?php echo $label_name . $name?>
</div>

<div class="row">

    <?php echo $label_notifications?>
    <div class="cell"><?php echo $notifications_yes?></div>
    <div class="cell"><?php echo $label_notifications_yes?></div>
    <div class="clear"></div>

    <div class="optional optional1">

        <?php echo $label_method?>
        <div class="cell"><?php echo $method_email?></div>
        <div class="cell"><?php echo $label_method_email?></div>
        <div class="clear"></div>

        <div class="optional optional2">
            <?php echo $label_email . $email . $note_email?>
        </div>

        <div class="cell"><?php echo $method_phone?></div>
        <div class="cell"><?php echo $label_method_phone?></div>
        <div class="clear"></div>

        <div class="optional optional3">
            <?php echo $label_phone . $phone . $note_phone?>
        </div>

        <div class="cell"><?php echo $method_post?></div>
        <div class="cell"><?php echo $label_method_post?></div>
        <div class="clear"></div>

        <div class="optional optional4">
            <?php echo $label_post . $post . $note_post?>
        </div>

    </div>

    <div class="cell"><?php echo $notifications_no?></div>
    <div class="cell"><?php echo $label_notifications_no?></div>
    <div class="clear"></div>

    <div class="optional optional5">
        <?php echo $label_why . $why?>
    </div>

</div>

<div class="row last"><?php echo $btnsubmit?></div>