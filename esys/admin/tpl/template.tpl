<?php
//////////////////////////////////////
// ZEDIT 3.0 TEMPLATE
// templates options

//////////////////////////////////////
// template 1 options
// template 1 (addlist)
$template1 = <<<HTML
<a class="listlink" href="?action=add&cat_id={ID}">{title}</a>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 2 options
// template 2 (editlist)
$template2 = <<<HTML
<a class="listlink" href="?action=list&cat_id={ID}">{title}</a>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 3 options
// template 3 (headline)
$template3 = <<<HTML
<div id="header">{title}</div>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 4 options
// template 4 (selectlist)
$template4 = <<<HTML
<a class="listlink" href="?action=select&cat_id={ID}">{title}</a>
HTML;
//////////////////////////////////////

?>