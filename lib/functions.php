<?php

use hypeJunction\Notifications\Notification;
use hypeJunction\Notifications\SiteNotificationsService;

/**
 * Returns user notifications
 *
 * @param array $options Options:
 *                       - limit
 *                       - offset
 *                       - status (read|seen|unread|unseen|all)
 *                       - recipient_guid
 *
 * @return Notification[]|false
 * @throws DatabaseException
 */
function hypeapps_get_notifications(array $options = []) {
	if (!isset($options['recipient_guid'])) {
		$options['recipient_guid'] = elgg_get_logged_in_user_guid();
	}

	$svc = elgg()->{'notifications.site'};

	/* @var $svc SiteNotificationsService */

	return $svc->getTable()->getAll($options);
}

/**
 * Count user notifications
 *
 * @param array $options Options:
 *                       - status (read|seen|unread|unseen|all)
 *                       - recipient_guid
 *
 * @return int
 * @throws DatabaseException
 */
function hypeapps_count_notifications(array $options = []) {
	if (!isset($options['recipient_guid'])) {
		$options['recipient_guid'] = elgg_get_logged_in_user_guid();
	}

	$svc = elgg()->{'notifications.site'};

	/* @var $svc SiteNotificationsService */

	return $svc->getTable()->count($options);
}

/**
 * Load notification by its ID
 *
 * @param int $id ID
 *
 * @return Notification|false
 * @throws DatabaseException
 */
function hypeapps_get_notification_by_id($id) {
	$svc = elgg()->{'notifications.site'};

	/* @var $svc SiteNotificationsService */

	return $svc->getTable()->get($id) ? : false;
}

/**
 * Mark all notification as read for recipient
 *
 * @param int $recipient_guid Recipient guid
 *
 * @return bool
 * @throws DatabaseException
 */
function hypeapps_mark_all_notifications_read($recipient_guid) {
	$svc = elgg()->{'notifications.site'};

	/* @var $svc SiteNotificationsService */

	return $svc->getTable()->markAllRead($recipient_guid);
}

//---added by pessek
function make_urls_into_links($plain_text) {
    return preg_replace(
        '@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-~]*(\?\S+)?)?)?)@',
        '<a href="$1">$1</a>', $plain_text);
}
//--added by pessek

function html_email_normalize_urls($text) {
	static $pattern = '/\s(?:href|src)=([\'"]\S+[\'"])/i';
	
	if (empty($text)) {
		return $text;
	}
	
	// find all matches
	$matches = [];
	preg_match_all($pattern, $text, $matches);
	
	if (empty($matches) || !isset($matches[1])) { 
		return $text;
	}
	
	// go through all the matches
	$urls = $matches[1];
	$urls = array_unique($urls);
	
	foreach ($urls as $url) {
		// remove wrapping quotes from the url
		$real_url = substr($url, 1, -1);
		// normalize url
		$new_url = elgg_normalize_url($real_url);
		// make the correct replacement string
		$replacement = str_replace($real_url, $new_url, $url);
		// replace the url in the content
		$text = str_replace($url, $replacement, $text);
	}
	
	return $text;
}
