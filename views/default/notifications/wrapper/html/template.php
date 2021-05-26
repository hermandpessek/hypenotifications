<?php
/**
 * Template borrowed from https://github.com/mailgun/transactional-email-templates
 */
$email = elgg_extract('email', $vars);
if (!$email instanceof \Elgg\Email) {
	return;
}

$title = $email->getSubject();
$body = $email->getBody();
$body = elgg_autop($body);

$body_title = !empty($title) ? elgg_view_title($title) : '';//added by pessek

$header = elgg_view('notifications/wrapper/html/template/header', $vars);
$footer = elgg_view('notifications/wrapper/html/template/footer', $vars);

$allowed = [
	'a',
	'b',
	'blockquote',
	'code',
	'del',
	'dd',
	'dl',
	'dt',
	'em',
	'h1',
	'h2',
	'h3',
	'h4',
	'h5',
	'i',
	'img',
	'kbd',
	'li',
	'ol',
	'p',
	'pre',
	's',
	'sup',
	'sub',
	'strong',
	'strike',
	'ul',
	'br',
	'hr',
	'table',
	'thead',
	'tbody',
	'th',
	'td',
	'tr'
];

foreach ($allowed as &$tag) {
	$tag = "<$tag>";
}

$body = strip_tags($body, implode('', $allowed)); 

//$body = elgg()->html_formatter->formatBlock($body);
//$body = html_email_normalize_urls($body);
//added by pessek
/*
$body  = str_replace("</p>"," </p> ",$body);
$body  = str_replace("<p>"," <p> ",$body);
$body = make_urls_into_links($body);
*/
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

$socialFooter = '<br>' . $facebook . ' ' . $linkedin ;

//-- end Pessek

$header = strip_tags($header, implode('', $allowed));
$footer = strip_tags($footer, implode('', $allowed));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title><?php echo $title ?></title>
    <style type="text/css">
.elgg-image-block {
	display: -ms-flexbox;
	display: -webkit-flex;
	display: flex;
	-webkit-align-items: flex-start;
	-ms-flex-align: start;
	align-items: flex-start
}

.elgg-image-block:after {
	display: none
}

.elgg-image-block .elgg-image {
	margin-right: 1rem
}

.elgg-avatar {
    position: relative;
    display: inline-block;
}

.elgg-avatar>a {
	display: inline-block
}

.elgg-avatar>a img {
	display: inline-block;
	vertical-align: middle;
	width: 100%;
	height: auto
}

.elgg-avatar-tiny img,
.elgg-avatar-small img,
.elgg-avatar-medium img {
	border-radius: 50%
}

.elgg-avatar-small img {
	max-width: 40px;
	max-height: 40px
}

.elgg-anchor * {
    display: inline;
}
.elgg-anchor img {
	vertical-align: middle
}

.elgg-image-block>.elgg-body {
	-webkit-flex: 1;
	-ms-flex: 1;
	flex: 1
}

.elgg-listing-summary-title {
    line-height: 1.5rem;
    margin-bottom: .25rem;
}

h3 {
    font-size: 1.2rem;
}

h1, h2, h3, h4, h5, h6 {
    font-weight: 500;
}
        <?= elgg_view('elements/fonts.css') ?>
    </style>
</head>
<body itemscope itemtype="http://schema.org/EmailMessage">
<table class="body-wrap">
    <tr>
        <td></td>
        <td class="container" width="1000">
            <div class="content">
                <div class="header">
                    <table width="100%">
                        <tr>
                            <td class="aligncenter">
								<?php echo $header ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <table class="main" width="100%" cellpadding="0" cellspacing="0">
		     <tr bgcolor="#ebeef1">
			     <td style="padding-bottom: 10px; padding-top: 10px; padding-left: 20px; font-size: 16px; font-weight: bold; text-align:center;">
				<?php echo $title ?>
			     </td>
		     </tr>
                    <tr>
                        <td class="content-wrap">
							<?php echo $body ?>
                        </td>
                    </tr>
                </table>
                <div class="footer">
                    <table width="100%">
                        <tr>
                            <td class="aligncenter content-block">
				<?php echo $footer ?>
				<?php echo $socialFooter ?>			
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
</body>
</html>

