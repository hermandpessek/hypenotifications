<?php
/**
 * Saves global plugin settings.
 *
 * This action can be overriden for a specific plugin by creating the
 * <plugin_id>/settings/save action in that plugin.
 *
 * @uses array $_REQUEST['params']    A set of key/value pairs to save to the ElggPlugin entity
 * @uses int   $_REQUEST['plugin_id'] The ID of the plugin
 */

$params = get_input('params');
$plugin_id = get_input('plugin_id');
$plugin = elgg_get_plugin_from_id($plugin_id);

if (!$plugin) {
	return elgg_error_response(elgg_echo('plugins:settings:save:fail', [$plugin_id]));
}

$plugin_name = $plugin->getDisplayName();

$result = false;

$config = [
	'transport',
	'smtp_host_name',
	'smtp_host',
	'smtp_port',
	'smtp_connection',
	'smtp_username',
	'smtp_password',
	'smtp_ssl',
	'sparkpost_apikey',
	'sendgrid_apikey',
	'mailgun_apikey',
	'mailgun_domain',
];

foreach ($params as $k => $v) {
	if (in_array($k, $config)) {
		elgg_save_config("email.$k", $v);
	} else {
		$result = $plugin->setSetting($k, $v);
		if (!$result) {
			return elgg_error_response(elgg_echo('plugins:settings:save:fail', [$plugin_name]));
		}
	}
}

return elgg_ok_response('', elgg_echo('plugins:settings:save:ok', [$plugin_name]));
