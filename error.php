
<?php
/*
Dynamic Error Pages v1.01
Created by: Sabre Web Design - Copyright (c) 2004 modified by Henry Stark

A dynamic PHP script which returns different error messages depending on the error received.
The script will also send an e-mail to your e-mail address with the time, error received,
requested page and the page they came from. (Optional). (Please note: To use this script
you need to be allowed use custom error pages on your host.)

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions
are met:

* Redistributions of source code must retain the above copyright
notice, this list of conditions and the following disclaimer.
* Redistributions in binary form must reproduce the above
copyright notice, this list of conditions and the following
disclaimer in the documentation and/or other materials
provided with the distribution.
* Redistributions of this script is free for Non-Commercial use ONLY!
* Neither the name of Sabre Web Design nor the names of its
contributors may be used to endorse or promote products
derived from this software without specific prior
written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND
CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES,
INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS
BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY
OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
POSSIBILITY OF SUCH DAMAGE.
*/

// Setup
$email = 'chocolatkey@gmail.com';  //Change to your e-mail address

// Get Variables
$error = $_SERVER['REDIRECT_STATUS'];
$referring_url = $_SERVER['HTTP_REFERER'];
$requested_url = $_SERVER['REQUEST_URI'];
$referring_ip = $_SERVER['REMOTE_ADDR'];
$server_name = $_SERVER['SERVER_NAME'];

// Different error messages to display
switch ($error) {

# Error 400 - Bad Request
case 400:
$errorname = 'Error 400 - Bad Request';
$errordesc = '<h1>Bad Request</h1>
  <p>
  The URL that you requested &#8212; '.$server_name.$requested_url.' &#8212; does not exist on this server. You might want to re-check the spelling and the path.</p>';
break;

# Error 401 - Authorization Required
case 401:
$errorname = 'Error 401 - Authorization Required';
$errordesc = '<h1>Authorization Required</h1>
  <p>
  The URL that you requested requires pre-authorization to access.</p>';
break;

# Error 403 - Access Forbidden
case 403:
$errorname = 'Error 403 - Access Forbidden';
$errordesc = '<h1>Access Forbidden</h1>
  <p>
  Access to the URL that you requested is forbidden.</p>';
break;

# Error 404 - Page Not Found
case 404:
$errorname = 'Error 404 - Page Not Found';
$errordesc = '<h1>File Not Found</h1>
  <p>
  Ooops! The page you are looking for &#8212; http://'.$server_name.$requested_url.' &#8212; cannot be found. This may be because:</p>
  <ul>
    <li>the path to the page was entered wrong;</li>
    <li>the page no longer exists; or</li>
    <li>there has been an error on the Web site.</li>
  </ul>';
break;

# Error 500 - Server Configuration Error
case 500:
$errorname = 'Error 500 - Server Configuration Error';
$errordesc = '<h1>Server Configuration Error</h1>
  <p>
  The URL that you requested &#8212; <a href="http://'.$server_name.$requested_url.'">http://'.$server_name.$requested_url.'</a> &#8212; resulted in a server configuration error. It is possible that the condition causing the problem will be gone by the time you finish reading this.</p>';
break;

# Unknown error
default:
$errorname = 'Unknown Error';
$errordesc = '<h2>Unknown Error</h2>
  <p>The URL that you requested &#8212; <a href="http://'.$server_name.$requested_url.'">http://'.$server_name.$requested_url.'</a> &#8212; resulted in an unknown error. It is possible that the condition causing the problem will be gone by the time you finish reading this. </p>';

}

?>
<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width">
<title>Error <?php echo $errorname; ?></title>
<link rev="made" href="mailto:<?php echo $email; ?>" />
<link href="/css/status.css" rel="stylesheet">
</head>
<body>
<div id="container">
<div class="leds">
<div class="green led"></div>
<div class="red led"></div>
</div>
<div class="leds">
<div class="green active led"></div>
<div class="red active blink led"></div>
</div>
<div class="flip">
Error<?php echo ' '.$error; ?>
<div class="break">
<div class="link left"></div>
<div class="link right"></div>
</div>
</div>
<div class="sorry">
<?php
// Display selected error message
echo($errordesc);
if (!$referring_url == '') {
echo '<p><a href="'.$referring_url.'"><< Go back to previous page.</a></p>';
} else {
echo '<p><a href="javascript:history.go(-1)"><< Go back to previous page.</a></p>';

}
?>
</div>
</div>
</body>
</html>