<?php

namespace hypeJunction\Notifications;

use Elgg\Includer;
use Elgg\PluginBootstrap;

class Bootstrap extends PluginBootstrap {

	public function getPath() {
		return $this->plugin->getPath();
	}

	public function load() {
		Includer::requireFileOnce($this->getPath() . '/autoloader.php');
		Includer::requireFileOnce($this->getPath() . '/lib/functions.php');
	}

	public function boot() {

	}

	public function init() {

		$hooks = $this->elgg()->hooks;
		$events = $this->elgg()->events;

		// Digests
		$hooks->registerHandler('send', 'all', \hypeJunction\Notifications\ScheduleDigest::class, 100);
		$hooks->registerHandler('cron', 'hourly', \hypeJunction\Notifications\SendDigest::class);

		// Site notifications
		elgg_register_notification_method('site');
		$hooks->registerHandler('send', 'notification:site', \hypeJunction\Notifications\SendSiteNotification::class, 400);

		$events->registerHandler('update', 'all', \hypeJunction\Notifications\SyncEntityUpdate::class, 999);
		$events->registerHandler('delete', 'all', \hypeJunction\Notifications\SyncEntityDelete::class, 999);
		$events->registerHandler('create', 'user', \hypeJunction\Notifications\SyncNewUser::class);
		$events->registerHandler('create', 'relationship', \hypeJunction\Notifications\SyncNewMember::class);

		$hooks->registerHandler('view', 'profile/details', \hypeJunction\Notifications\DismissProfileNotifications::class);
		$hooks->registerHandler('view', 'groups/profile/layout', \hypeJunction\Notifications\DismissProfileNotifications::class);

		$hooks->registerHandler('view', 'object/default', \hypeJunction\Notifications\DismissObjectNotifications::class);
		$hooks->registerHandler('view', 'post/elements/full', \hypeJunction\Notifications\DismissObjectNotifications::class);

		$subtypes = (array) get_registered_entity_types('object');
		foreach ($subtypes as $subtype) {
			$hooks->registerHandler('view', "object/$subtype", \hypeJunction\Notifications\DismissObjectNotifications::class);
		}

		$hooks->registerHandler('elgg.data', 'site', \hypeJunction\Notifications\SetClientConfig::class);

		// Email notifications and transport
		elgg_set_email_transport(elgg()->{'email.transport'}->build());
		$hooks->registerHandler('format', 'notification:email', \hypeJunction\Notifications\FormatEmailNotification::class, 999);
		$hooks->registerHandler('prepare', 'system:email', \hypeJunction\Notifications\PrepareEmail::class, 999);
		$hooks->registerHandler('validate', 'system:email', \hypeJunction\Notifications\ValidateEmail::class);
		//$hooks->registerHandler('zend:message', 'system:email', \hypeJunction\Notifications\AddHtmlEmailPart::class); //remove by pessek because we use html_email_handler


		// Menus
		$hooks->registerHandler('register', 'menu:topbar', \hypeJunction\Notifications\TopbarMenu::class);
		$hooks->registerHandler('register', 'menu:page', \hypeJunction\Notifications\PageMenu::class);

		// Views
		elgg_extend_view('page/elements/topbar', 'notifications/popup');
		elgg_extend_view('elgg.css', 'notifications/notifications.css');
		elgg_extend_view('admin.css', 'notifications/notifications.css');

	}

	public function ready() {

	}

	public function shutdown() {

	}

	public function activate() {
		$root = dirname(dirname(dirname(dirname(__FILE__))));
		//run_sql_script($root . '/install/mysql.sql');
		_elgg_services()->db->runSqlScript($root . '/install/mysql.sql');
	}

	public function deactivate() {

	}

	public function upgrade() {

	}
}
