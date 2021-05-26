<?php

$recipient = elgg_extract('recipient', $vars);

if (!$recipient instanceof \ElggUser) {
	return;
}

$site = elgg_get_site_entity();

$site_link = elgg_view('output/url', array(
	'href' => $site->getURL(),
	'text' => $site->name,
));

$settings_link = elgg_view('output/url', array(
	'href' => elgg_generate_url('settings:notification:personal', [
		'username' => $recipient->username,
	]),
	'text' => elgg_echo('notifications:footer:link'),
));

echo elgg_echo('notifications:footer', array(
	$site_link,
	$settings_link,
));

$facebook_img = elgg_format_element('img', [
	'src' => elgg_get_site_url() . "mod/hypeNotifications/img/social-media/facebook.png",
	'alt' => 'Facebook',
]);

$linkedin_img = elgg_format_element('img', [
	'src' => elgg_get_site_url() . "mod/hypeNotifications/img/social-media/linkedin.png",
	'alt' => 'Linkedin',
]);

$facebook = elgg_view('output/url', array(
	'href' => "https://www.facebook.com/thegeekdigital/",
	'text' => $facebook_img,
	'title' => "Facebook",
));
$linkedin = elgg_view('output/url', array(
	'href' => "https://www.linkedin.com/thegeekdigital/",
	'text' => $linkedin_img,
	'title' => "Linkedin",
));

$socialFooter = '<br>' . $facebook . ' ' . $linkedin;

echo $socialFooter;
