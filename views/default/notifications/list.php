<?php

/**
 * View a list of items
 *
 * @package Elgg
 *
 * @uses $vars['items']        Array of ElggEntity, ElggAnnotation or ElggRiverItem objects
 * @uses $vars['offset']       Index of the first list item in complete list
 * @uses $vars['limit']        Number of items per page. Only used as input to pagination.
 * @uses $vars['count']        Number of items in the complete list
 * @uses $vars['base_url']     Base URL of list (optional)
 * @uses $vars['url_fragment'] URL fragment to add to links if not present in base_url (optional)
 * @uses $vars['pagination']   Show pagination? (default: true)
 * @uses $vars['position']     Position of the pagination: before, after, or both
 * @uses $vars['full_view']    Show the full view of the items (default: false)
 * @uses $vars['list_class']   Additional CSS class for the <ul> element
 * @uses $vars['item_class']   Additional CSS class for the <li> elements
 * @uses $vars['item_view']    Alternative view to render list items
 * @uses $vars['no_results']   Message to display if no results (string|Closure)
 */
$items = $vars['items'];
$count = elgg_extract('count', $vars);
$pagination = elgg_extract('pagination', $vars, true);
$position = elgg_extract('position', $vars, 'after');
$no_results = elgg_extract('no_results', $vars, '');
$full = elgg_extract('full_view', $vars, false);

if (!$items && $no_results) {
	echo elgg_view('page/components/no_results', $vars);
	return;
}

if (!is_array($items) || count($items) == 0) {
	return;
}

$list_classes = ['elgg-list', 'notifications-list'];
if (isset($vars['list_class'])) {
	$list_classes[] = $vars['list_class'];
}

$item_classes = ['elgg-item'];
if (isset($vars['item_class'])) {
	$item_classes[] = $vars['item_class'];
}

$nav = ($pagination) ? elgg_view('navigation/pagination', $vars) : '';

$index = 0;
$list_items = '';
foreach ($items as $item) {
	$item_view_vars = $vars;
	$item_view_vars['list_item_index'] = $index;
	$item_view = elgg_view('notifications/notification', [
		'item' => $item,
		'full_view' => $full,
	]);
	if (!$item_view) {
		continue;
	}

	$li_attrs = ['class' => $item_classes];

	if ($item instanceof \ElggEntity) {
		$guid = $item->guid;
		$type = $item->type;
		$subtype = $item->getSubtype();

		$li_attrs['id'] = "elgg-$type-$guid";

		$li_attrs['class'][] = "elgg-item-$type";
		if ($subtype) {
			$li_attrs['class'][] = "elgg-item-$type-$subtype";
		}
	} else if (is_callable(array($item, 'getType'))) {
		$li_attrs['id'] = "item-{$item->getType()}-{$item->id}";
	}

	$list_items .= elgg_format_element('li', $li_attrs, $item_view);
	$index++;
}

if ($position == 'before' || $position == 'both') {
	echo $nav;
}

if (empty($list_items) && $no_results) {
	// there are scenarios where item views do not output html. In those cases show the no results info
	echo elgg_view('page/components/no_results', $vars);
} else {
	echo elgg_format_element('ul', ['class' => $list_classes], $list_items);
	//echo elgg_view('page/components/list', $vars);
}

if ($position == 'after' || $position == 'both') {
	echo $nav;
}
