<?php

elgg_gatekeeper();

$unseen = hypeapps_count_notifications([
	'status' => 'unread',//pessek old was unseen
]);

echo json_encode([
	'new' => $unseen,
]);
