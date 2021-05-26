<?php
/**
 * The main CSS for all outgoing email notifications
 */
?>

* {
	margin: 0;
	font-family: Roboto, "Helvetica Neue", Helvetica, Arial, sans-serif;
	box-sizing: border-box;
}

img {
	max-width: 100%;
}

body {
	-webkit-font-smoothing: antialiased;
	-webkit-text-size-adjust: none;
	width: 100% !important;
	height: 100%;
	line-height: 1.6em;
}

table td {
	vertical-align: top;
}

body {
	background-color: #f6f6f6;
}

.body-wrap {
	background-color: #f6f6f6;
	width: 100%;
}

.container {
	display: block !important;
	max-width: 900px !important;
	margin: 0 auto !important;
	clear: both !important;
}

.content {
	max-width: 900px;
	margin: 0 auto;
	display: block;
	padding: 20px;
}

h1, h2, h3 {
	font-family: Roboto, "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
	color: #000;
	margin: 10px 0;
	line-height: 1.2em;
	font-weight: 600;
}

h1 {
	font-size: 30px;
	font-weight: 600;
}

h2 {
	font-size: 20px;
}

h3 {
	font-size: 16px;
}

h4 {
	font-size: 12px;
	font-weight: 600;
}

p, ul, ol {
	margin-bottom: 10px;
	font-weight: normal;
	padding-left: 0;
}

p li, ul li, ol li {
	margin-left: 5px;
	list-style-position: inside;
}

.main {
	background-color: #fff;
	border: 1px solid #e9e9e9;
	border-radius: 3px;
}

.content-wrap {
	padding: 20px;
}

.content-block {
	padding: 0 0 20px;
}

.header {
	width: 100%;
	margin-bottom: 10px;
}
.header h1 {
	margin: 5px auto;
}
.header a {
	font-size: inherit;
	text-decoration: none;
	color: inherit;
}
.header img {
	max-width: 300px;
	height: auto;
}
.footer {
	width: 100%;
	clear: both;
	color: #999;
	padding: 20px 0;
}
.footer p, .footer a, .footer td {
	color: #999;
	font-size: 12px;
}

a {
	color: #348eda;
	text-decoration: underline;
}

button {
	text-decoration: none;
	color: #FFF;
	background-color: #348eda;
	border: solid #348eda;
	border-width: 10px 20px;
	line-height: 2em;
	font-weight: bold;
	text-align: center;
	cursor: pointer;
	display: inline-block;
	border-radius: 5px;
	text-transform: capitalize;
}

.last {
	margin-bottom: 0;
}

.first {
	margin-top: 0;
}

.aligncenter {
	text-align: center;
}

.alignright {
	text-align: right;
}

.alignleft {
	text-align: left;
}

.clear {
	clear: both;
}

.alert {
	font-size: 16px;
	color: #fff;
	font-weight: 600;
	padding: 20px;
	text-align: center;
	border-radius: 3px 3px 0 0;
}
.alert a {
	color: #fff;
	text-decoration: none;
	font-weight: 600;
	font-size: 16px;
}
.alert.alert-warning {
	background-color: #FF9F00;
}
.alert.alert-bad {
	background-color: #D0021B;
}
.alert.alert-good {
	background-color: #68B90F;
}

.invoice {
	margin: 40px auto;
	text-align: left;
	width: 80%;
}
.invoice td {
	padding: 5px 0;
}
.invoice .invoice-items {
	width: 100%;
}
.invoice .invoice-items td {
	border-top: #eee 1px solid;
}
.invoice .invoice-items .total td {
	border-top: 2px solid #333;
	border-bottom: 2px solid #333;
	font-weight: 700;
}

@media only screen and (max-width: 640px) {
	body {
		padding: 0 !important;
	}

	h1, h2, h3, h4 {
		font-weight: 800 !important;
		margin: 20px 0 5px !important;
	}

	h1 {
		font-size: 22px !important;
	}

	h2 {
		font-size: 18px !important;
	}

	h3 {
		font-size: 16px !important;
	}

	.container {
		padding: 0 !important;
		width: 100% !important;
	}

	.content {
		padding: 0 !important;
	}

	.content-wrap {
		padding: 10px !important;
	}

	.invoice {
		width: 100% !important;
	}
}

.user-icon {
	border-radius: 1000px;
	overflow: hidden;
}
.user-icon img {
	border-radius: 1000px;
}

.elgg-list {
	list-style: none;
	padding: 0;
	margin: 0;
}
.elgg-list > li {
	padding: 20px;
}
.image-block td {
	padding: 10px;
}

.elgg-button {
	text-decoration: none;
}

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
    font-weight: 600;
}


