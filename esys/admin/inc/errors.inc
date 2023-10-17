<?php
// general try again error
$tryagain = '<a href="javascript:history.back();">gå tillbaks och försök igen</a> eller <a href="?action=help">kontakta webmaster</a> om det fortfarande inte fungerar';

// file upload errors
if($file_error == "0") $file_error = "UPLOAD_ERR_OK, Value: 0; There is no error, the file uploaded with success.";
elseif($file_error == "1") $file_error = "UPLOAD_ERR_INI_SIZE, Value: 1; The uploaded file exceeds the upload_max_filesize directive in php.ini.";
elseif($file_error == "2") $file_error = "UPLOAD_ERR_FORM_SIZE, Value: 2; The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
elseif($file_error == "3") $file_error = "UPLOAD_ERR_PARTIAL, Value: 3; The uploaded file was only partially uploaded. ";
elseif($file_error == "4") $file_error = "UPLOAD_ERR_NO_FILE, Value: 4; No file was uploaded. ";
elseif($file_error == "5") $file_error = "Value: 5; Undocumented error";
elseif($file_error == "6") $file_error = "UPLOAD_ERR_NO_TMP_DIR, Value: 6; Missing a temporary folder.";
elseif($file_error == "7") $file_error = "UPLOAD_ERR_CANT_WRITE, Value: 7; Failed to write file to disk.";
else $file_error = "Unknown error";

?>