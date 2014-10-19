<?php

print '<div class="' . $classes . '">';

print render($title_prefix);
$title && print $title;
print render($title_suffix);
isset($admin_links) && print $admin_links;
$header && print str_replace('[script]', '<script>', $header);
$exposed && print $exposed;
$attachment_before && print $attachment_before;
$rows ? print $rows : $empty && print $empty;
$pager && print $pager;
$attachment_after && print $attachment_after;
$more && print $more;
$footer && print str_replace('[/script]', '</script>', $footer);
$feed_icon && print $feed_icon;

print '</div> <!-- end .view -->';
