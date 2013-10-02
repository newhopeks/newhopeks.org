<?php

/**
 * Wrapper function for _file_check_directory that accepts a form element
 * to validate - if user specified one. Won't allow form submit unless the
 * directory exists & is writable
 *
 * @param $form_element
 *   The form element containing the name of the directory to check.
 */
function _file_form_check_directory($form_element) {
  if(!empty($form_element['#value'])) {
    _file_check_directory($form_element['#value'], $form_element);
  }
  return $form_element;
}

/**
 * Create the directory relative to the 'files' dir recursively for every
 * directory in the path.
 *
 * @param $directory
 *   The directory path under files to check, such as 'media/path/here'
 * @param $form_element
 *   A form element to throw an error on if the directory is not writable
 */
function _file_check_directory($directory, $form_element = array()) {
  foreach (explode('/', $directory) as $dir) {
    $dirs[] = $dir;
    file_check_directory(file_create_path(implode($dirs,'/')), FILE_CREATE_DIRECTORY, $form_element['#parents'][0]);
  }
  return TRUE;
}

/**
 * Protects server from uploading files like file.php.mp3. Should be moved into core.
 */
function _file_munge_filename($filename, $extensions, $alerts = 1) {
  $original = $filename;
  $whitelist = array_unique(explode(' ', trim($extensions)));

  $filename_parts = explode('.', $filename);

  $new_filename = array_shift($filename_parts); // Remove file basename.
  $final_extension = array_pop($filename_parts); // Remove final extension.

  foreach($filename_parts as $filename_part) {
    $new_filename .= ".$filename_part";
    if (!in_array($filename_part, $whitelist) && preg_match("/^[a-zA-Z]{2,5}\d?$/", $filename_part)) {
      $new_filename .= '_';
    }
  }
  $filename = "$new_filename.$final_extension";

  if ($alerts && $original != $filename) {
    $message = t('Your filename has been renamed to conform to site policy.');
    drupal_set_message($message, 'warning');
  }

  return $filename;
}

/**
 * Insert a file into the database.
 *
 * @param $node
 *    node object file will be associated with.
 * @param $file
 *    file to be inserted, passed by reference since fid should be attached.
 *
 */
function _field_file_insert($node, &$file, $field) {
  $fieldname = $field['field_name'];
  $safe_filename = _file_munge_filename($file['filename'], trim($field['widget']['file_extensions']));
  $filepath = file_create_path($field['widget']['upload_path']) . '/' . $safe_filename;

  if (_file_check_directory($field['widget']['upload_path']) && $file = file_save_upload((object)$file,  $filepath)) {
    $file = (array)$file;
    $file['fid'] = db_next_id('{files}_fid');
    db_query(
      "INSERT into {files} (fid, nid, filename, filepath, filemime, filesize) VALUES (%d, %d, '%s', '%s', '%s', %d)",
      $file['fid'], $node->nid, $file['filename'], $file['filepath'], $file['filemime'], $file['filesize']
    );
    return (array)$file;
  }
  else {
    form_set_error(NULL, t('File upload was unsuccessful!'));
    return FALSE;
  }
}

/**
 * Update the video file record if necessary.
 */
function _field_file_update($node, &$file, $field) {
  $file = (array)$file;
  if ($file['flags']['delete'] == TRUE) {
     _field_file_delete($file, $field['field_name'], $field['type']);
     return array();
  }
  if ($file['fid'] == 'upload') {
    return _field_file_insert($node, $file, $field);
  }
  else {
  }
  return $file;
}

/**
 * Delete a file from the files table and disk.
 */
function _field_file_delete($file, $fieldname, $type) {
  if (is_numeric($file['fid'])) {
    db_query('DELETE FROM {files} WHERE fid = %d', $file['fid']);
  }
  else {
    unset($_SESSION[$type][$fieldname][$file['sessionid']]);
  }
  return file_delete($file['filepath']);
}

function _field_clear_session($type) {
  if (is_array($_SESSION[$type]) && count($_SESSION[$type])) {
    foreach (array_keys($_SESSION[$type]) as $fieldname) {
      _field_clear_field_session($fieldname, $type);
    }
    unset($_SESSION[$type]);
  }
}

function _field_clear_field_session($fieldname, $type) {
  if (count($_SESSION[$type][$fieldname])) {
    foreach ($_SESSION[$type][$fieldname] as $files) {
      if (is_file($file['filepath'])) {
        file_delete($file['filepath']);
      }
    }
    unset($_SESSION[$type][$fieldname]);
  }
}

/**
 * Load file information from files table.
 */
function _field_file_load($fid = NULL) {
  if (isset($fid)) {
    if (is_numeric($fid)) {
      $result = db_query('SELECT * FROM {files} WHERE fid = %d', $fid);
      $file = db_fetch_array($result);
      return ($file) ? $file : array();
    }
  }
  return array();
}

/**
 * Create and initialize an instance of getid3 class.
 */
function &getID3Instance() {
  $lib = 'misc/lib/getid3/getid3/getid3.php';
  $id3 = null;

  if (file_exists($lib)) {
    require_once($lib);
    $id3 = new getID3();
    $id3-> option_md5_data = true;
    $id3-> option_md5_data_source = true;
    $id3-> encoding = 'UTF-8';
 }
 else {
  drupal_set_message('getid3 library not found!', 'error');
 }

 return $id3;
}

/**
 * Analyze file and return its media information.
 */
function &getID3Analyze($path) {
  $info = array();
  if($id3 = &getID3Instance()) {
    $info = $id3-> analyze($path);
    unset($id3);
  }

  return $info;
}

/**
 * Formats audio sample rate.
 */
function format_samplerate($samplerate) {
  return sprintf("%.1f kHz", $samplerate/1000);
}

/**
 * Formats audio bit rate.
 */
function format_bitrate($bitrate) {
  return sprintf("%d Kbps", $bitrate/1000);
}

/**
 * Formats file size.
 */
function format_filesize($size) {
  $size = $size/1024;
  $result = '';
  if ($size > 0) {
    $result = sprintf("%.02f MB", $size/1024);
  } else {
    $result = sprintf("%.02f Kb", $size);
  }
  return $result;
}

/**
 * Searchs is there a specified resource in the current theme directory.
 * If not, get the path of the parent module.
 *
 * @param string $filename
 *   File name to search for.
 * @param string $module
 *   A name of the module which is a parent module of this file.
 * @param string $ext
 *   File extension.
 * @return string
 *   A path of the file.
 */
function _file_get_resource_path($filename, $module, $ext = 'png') {
  $resource = path_to_theme() .'/mediaicons/'. "$filename.$ext";
  if (!file_exists($resource)) {
    $resource = drupal_get_path('module', $module) .'/mediaicons/'. "$filename.$ext";
  }
  return $resource;
//  return check_url(base_path(). $resource);
}
