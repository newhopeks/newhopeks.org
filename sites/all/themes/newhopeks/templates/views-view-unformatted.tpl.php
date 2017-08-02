<?php

$title && print $title;

foreach ($rows as $id => $row) {
  if ($classes_array[$id]) {
    print '<div class="' . $classes_array[$id] .'">' . $row . '</div>';
  } else {
    print $row;
  }
}
