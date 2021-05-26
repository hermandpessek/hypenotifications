<?php

$subject = elgg_extract('subject', $vars);
$message = elgg_extract('body', $vars);

$language = elgg_extract('language', $vars, get_current_language());
$recipient = elgg_extract('recipient', $vars);

$head = elgg_format_element('meta', [
	'http-equiv' => 'Content-Type',
	'content' => 'text/html; charset=UTF-8',
]);
$head .= elgg_format_element('base', [
	'target' => '_blank',
]);

if (!empty($subject)) {
	$head .= elgg_format_element('title', [], $subject);
}

$css = elgg_view('css/html_email_handler/notification');

$site = elgg_get_site_entity();
$site_link = elgg_view('output/url', [
	'text' => $site->getDisplayName(),
	'href' => $site->getURL(),
	'is_trusted' => true,
]);

$body_title = !empty($subject) ? elgg_view_title($subject) : '';

$notification_footer = '';
if ($recipient instanceof ElggUser) {
	$language = $recipient->getLanguage($language);
	$route_name = 'settings:account';
	if (elgg_is_active_plugin('notifications')) {
		$route_name = 'settings:notification:personal';
	}
	$settings_url = elgg_generate_url($route_name, [
		'username' => $recipient->username,
	]);
	$notification_footer = elgg_echo('html_email_handler:notification:footer:settings', [
		"<a href='{$settings_url}'>",
		'</a>',
	], $language);
}

//--

$css .= elgg_view('elements/fonts.css');
$css .= elgg_view('css/hypeNotifications/notification');
 
$css .= elgg_view('elements/components/image_block.css', $vars);
$css .= elgg_view('elements/components/list.css', $vars);
$css .= elgg_view('elements/components/gallery.css', $vars);
$css .= elgg_view('elements/components/river.css', $vars);
$css .= elgg_view('elements/components/tags.css', $vars);
$css .= elgg_view('elements/buttons.css');

$header = elgg_view('notifications/wrapper/html/template/header', $vars);
$footer = elgg_view('notifications/wrapper/html/template/html_email_handler_footer', $vars);

$message = elgg_autop($message);
$body = <<<__BODY
<style type="text/css">{$css}</style>
	<table class="body-wrap">
	    <tr>
		<td></td>
		<td class="container" width="1000">
		    <div class="content">
		        <div class="header">
		            <table width="100%">
		                <tr>
		                    <td class="aligncenter">{$header}</td>
		                </tr>
		            </table>
		        </div>
		        <table class="main" width="100%" cellpadding="0" cellspacing="0">
			     <tr bgcolor="#ebeef1">
				     <td style="padding-bottom: 10px; padding-top: 10px; padding-left: 20px; font-size: 16px; font-weight: bold; text-align:center;">
					{$body_title}
				     </td>
			     </tr>
		            <tr>
		                <td class="content-wrap">{$message}</td>
		            </tr>
		        </table>
		        <div class="footer">
		            <table width="100%">
		                <tr>
		                    <td class="aligncenter content-block">
					{$footer}		
		                    </td>
		                </tr>
		            </table>
		        </div>
		    </div>
		</td>
		<td>
		</td>
	    </tr>
	</table>
__BODY;
//--








/*$body = <<<__BODY
<style type="text/css">{$css}</style>

<div id="notification_container">
	<div id="notification_header">{$site_link}</div>
	<div id="notification_wrapper">
		{$body_title}
	
		<div id="notification_content">
			{$message}
		</div>
	</div>
	
	<div id="notification_footer">
		{$notification_footer}
		<div class="clearfloat"></div>
	</div>
</div>
__BODY;*/

echo elgg_view('page/elements/html', [
	'head' => $head,
	'body' => $body,
]);
