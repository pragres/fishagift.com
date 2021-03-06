<?php

// including the model
include_once framework::resolve('packages/base/model/Security.php');

// loading internacionalization
$lang = framework::session_get('language');
$languages = Security::getLanguages();
include_once framework::resolve("packages/base/i18n/$lang/login.php");

// redirecting to home if session is started
$isSessionStarted = Security::isSessionStarted();
if ($isSessionStarted) {
	framework::redirect('store/home');
	exit();
}

// passing variables to the view
$title = $i18n['title'];

// checking where to return
$returnTo = framework::getValue('returnTo');

if (empty($returnTo)) {
	
	/*$returnTo = Tracer::returnLastTrace()->getLocation();
	
	if ($returnTo == 'base/logout_submit')
		$returnTo = null;
	
	if (is_null($returnTo))*/
		$returnTo = "store/home";
}

// getting errors
$errorWrongCredentials = false;
$errorEmailNoExist = false;
$errorUserExist = false;
if (isset($_GET["error"]))
	$errorWrongCredentials = $_GET["error"] == "wrongCredentials"; // &error=wrongCredentials when credentials are wrong
if (isset($_GET["error"]))
	$errorEmailNoExist = $_GET["error"] == "emailNoExist"; // &error=emailNoExist when email no exist reseting the password
if (isset($_GET["error"]))
	$errorUserExist = $_GET["error"] == "userExist"; // &error=userExits when email exists registering
		                                                 
// calling the view
include_once framework::resolve('packages/base/view/login.tpl');
