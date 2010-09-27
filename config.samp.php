<?php

define('AWS_ACCESS_KEY', 'YOUR_AWS_ACCESS_KEY');
define('AWS_SECRET_KEY', 'YOUR_AWS_SECRET_KEY');

define('CDN_BUCKET', 'YOUR_CDN_BUCKET');  ///The S3 bucket that you use for your Cloudfront Distuibution
define('CDN_DOMAIN_NAME', 'YOUR_CDN_DOMAIN_NAME');  //The domain name you use for your Cloudfront Distribution


//These are for the built-in data access for the Classes.
define('DB_CONNECTION_STRING', 'mysql:host=localhost;dbname=yourdb');
define('DB_USERNAME', 'db_user');
define('DB_PASSWORD', 'your_password');

//CloudfrontFrontEnd
define('CDN_JAVASCRIPT_MIN_PATH', NINJA_BASEPATH . 'awsninja_cloudfrontjavascript/js-minified/');
define('CDN_JAVASCRIPT_SOURCE_PATH', NINJA_BASEPATH . 'awsninja_cloudfrontjavascript/javascript/');

define('CDN_MAINTENANCE_MODE', false);  //true= development server  false=production server
define('CDN_VERSION_FILE', NINJA_BASEPATH . 'awsninja_cloudfrontjavascript/version/version');  //That last "version" is a file, not a directory.



?>
