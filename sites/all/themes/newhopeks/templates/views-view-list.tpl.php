<?php

$wrapper_prefix && print $wrapper_prefix;

$title && print $title;

print $list_type_prefix;

foreach ($rows as $id => $row) {
  print '<li class="' . $classes_array[$id] . '">' . $row . '</li>';
}

print $list_type_suffix;

$wrapper_suffix && print $wrapper_suffix;
