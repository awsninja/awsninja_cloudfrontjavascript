#!/usr/bin/php -q
<?php
/**
 * CloudFrontJavascript Service
 * 
 * serviceTest.php - Uses CloudFrontJavaScriptService to generate the script HTML tags to insert into web pages.
 * 
 */
define('NINJA_BASEPATH', dirname(__FILE__) . '/../../');
require_once(NINJA_BASEPATH . 'awsninja_cloudfrontjavascript/CloudFrontJavaScriptService.php');
$cfjss = new CloudFrontJavaScriptService();

echo("\n\n");

echo("Here's the uncombined script:\n");
$res = $cfjss->getScriptHTML('25', true);
echo($res . "\n\n");

echo("Here's the combined uncompressed script:\n");
$res = $cfjss->getScriptHTML('25', false, false);
echo($res . "\n\n");

echo("Here's the combined compressed script:\n");
$res = $cfjss->getScriptHTML('25', false, true);
echo($res . "\n\n");


echo("Here's how to let the web browser determine whether to compress or not:\n");
echo '<?php 
	$cfjss = new CloudFrontJavaScriptService();
	echo($cfjss->getScriptHTML(\'25\'));
?>

';

$res = $cfjss->getScriptHTML('25');

echo("In the current context, that code produces this:\n");
echo($res . "\n\n");

?>
