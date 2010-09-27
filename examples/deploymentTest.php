#!/usr/bin/php -q
<?php
/**
 * CloudFrontJavascript Service
 * 
 * deploymentTest.php - Minimizes and copies source JavaScript files for use by CloudFrontJavaScriptService.
 * 
 */

define('NINJA_BASEPATH', dirname(__FILE__) . '/../../');

require_once(NINJA_BASEPATH . 'awsninja_cloudfrontjavascript/classes/JavaScriptScript.php');
require_once(NINJA_BASEPATH . 'awsninja_cloudfrontjavascript/JSMinService.php');

$javaScripts = JavaScriptScript::findAll();

$jsCt = count($javaScripts);
for($i=0; $i<$jsCt; $i++)
{
	$javaScript = $javaScripts[$i];
	$pathSource =	CDN_JAVASCRIPT_SOURCE_PATH . str_replace('_', '/', $javaScript->FileName);
	$pathDest = CDN_JAVASCRIPT_MIN_PATH . $javaScript->FileName;
	if(file_exists($pathSource))
	{
		$jsSource = file_get_contents($pathSource);
		$minJS = JSMinService::minify($jsSource);
		echo("Write to $pathDest\n");
		$dest = fopen($pathDest, 'w');
		$len = strlen($minJS);
		fwrite($dest, $minJS);
		fclose($dest);
	}
	else
	{
		echo("File not found: $pathSource\n");
	}
	usleep ( 250 );
}

echo("Deleting the version file\n");
if (file_exists(CDN_VERSION_FILE))
{
	unlink(CDN_VERSION_FILE);
}
echo("Done!\n");



?>
