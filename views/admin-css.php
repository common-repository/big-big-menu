<style type="text/css">
/* HNAV - HORIZONTAL NAVIGATION */
/* Turns a list or wrapped list into a horizontally floated navigation bar */
.hnav {}
ul.hnav,
ol.hnav,
.hnav ul,
.hnav ol {
	position: relative;
	float: left;
	margin: 0;
	border: 0;
	padding: 0;
	line-height: 1em;
	list-style: none;
	white-space: nowrap;
}
.hnav-right {
	float: right;
}
.hnav li {
	float: left;
	margin: 0;
	border: 0;
	padding: 0;
}
.hnav a,
.hnav strong {
	display: block;
	margin: 0;
	border: 0;
	padding: 0;
	width: auto; /* only IE 5.x */
	width/**/:/**/ .1em; /* only IE 6.0 */
}
.hnav li > a,
.hnav li > strong { width: auto; }  /* other browsers */

#BigBigMenu {
	padding: 1em 2em 2em;
}
#BigBigMenuMessage {
	display: none;
	margin: 0 0 .5em 0;
	padding: .5em;
	background: #FFFF00;
	color: #333;
}
#BigBigMenuSave {
	margin-bottom: .5em;
	padding: 4px;
	background: #58CD75;
	text-align: center;
	}
.BigBigMenuConfirmSave {
	display: none;
	position: absolute;
	height: 16px;
	right: .666em;
	top: .333em;
	padding: 0 22px 0 6px;
	background: yellow url('<?=$plugin_url?>/images/yes.png') no-repeat right center;
	font-size: .75em;
	text-decoration: none;
}
.column {
	position: relative;
	float: left;
	margin: 0 2% 0 0;
	padding: 0;
	font-size: 1.1em;
}
.column .column {
	font-size: 1em;
}
#BigBigMenuAssembled {
	width: 25%;
}
#BigBigMenuParts {
	width: 40%;
}
#BigBigMenuOptions {
	width: 25%;
}
.third {
	width: 30%;
}
.list {
	margin: 0;
	padding: 0;
	list-style-type: none;
}
.list li div,
#item_home {
	position: relative;
	margin: 0 0 .5em 0;
	padding: 6px 12px 9px 30px;
	background: #CCC;
	font-size: 1.1em;
	line-height: 1em;
}
#item_home.yes {
	color: #FFF;
	background: #D54E21;
}
#BigBigMenu h3 {
	margin: 0;
	padding: 0 0 .5em 0;
	font-size: 1.25em;
	line-height: 1em;
}
a {
	outline: none;
}
a.control {
	display: block;
	position: absolute;
	width: 16px;
	height: 16px;
	right: .5em;
	top: 1.4em;
	text-indent: -3000px;
	text-decoration: none;
}
a.toggle {
	background: url('<?=$plugin_url?>/images/add.png');
}
.yes a.toggle {
	background: url('<?=$plugin_url?>/images/no.png');
}
a.del {
	background: url('<?=$plugin_url?>/images/no.png');
}
a.add {
	left: .5em;
	background: url('<?=$plugin_url?>/images/add.png');
}
.list li .type {
	font-size: .75em;
	color: #FFF;
}

#item_home {
	padding-left: 30px;
}
#item_home small {
	display: block;
	color: #FFF;
	font-size: .75em;
}
#item_home.yes small {
	color: #F2C4AD;
}
.sortable li div {
	cursor: move;
	padding: 6px 12px 9px 30px;
	background: #D54E21 url('<?=$plugin_url?>/images/arrows_north_south.png') no-repeat 7px center;
	color: #FFF;
}
.sortable li .type {
	display: inline;
	color: #F2C4AD;
	line-height: 1em;
}
#BigBigMenuParts .tabs li {
	margin-right: .5em;
	font-size: 1.25em;
}
#BigBigMenuParts .tabs li a {
	display: block;
	padding: .375em .5em .5em;
	background: #EEE;
	font-size: .8em;
	line-height: 1em;
	font-weight: bold;
	text-decoration: none;
}
#BigBigMenuParts .tabs li.ui-tabs-selected a {
	background: #58CD75;
	color: #FFF;
}
#BigBigMenuParts .tab-content {
	border: 0;
	height: auto;
	margin: 0;
	overflow: auto;
	padding: 0;
}
#BigBigMenuOptions label em {
	color: #D54E21;
	font-size: .8em;
}
#BigBigMenuOptions .tip {
	color: #999;
	font-size: .8em;
}
#BigBigMenuOptions .tip pre {
	border: 1px solid #999;
	padding: .5em;
	background: #EEE;
}
#HorizTip {
	display: none;
}
#HorizTip p {
	margin: 0;
}

/* float clearing */
.clearfix:after, .container:after {content:".";display:block;height:0;clear:both;visibility:hidden;}
.clearfix, .container {display:inline-block;}
* html .clearfix, * html .container {height:1%;}
.clearfix, .container {display:block;}
.clear {clear:both;}

</style>