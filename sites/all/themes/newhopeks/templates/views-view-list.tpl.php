<?php

$title && print $title;

print $list_type_prefix;

foreach ($rows as $id => $row) {
	print '<li class="' . $classes_array[$id] . '">' . $row . '</li>';
}

print $list_type_suffix;
