<?php

function escape($expr)
{
	return addslashes ($expr);
}




function reverse_escape($str)
{
	$search=array("\\\\","\\0","\\n","\\r","\Z","\'",'\"');
	$replace=array("\\","\0","\n","\r","\x1a","'",'"');
	return str_replace($search,$replace,$str);
}





function generate_select_options ($data, $title_field, $value_field, $selected_value = false)
{
	$html = '';
	foreach ($data as $record) {
		$title = $record[$title_field];
		$value = $record[$value_field];
		
		$selected = ($value == $selected_value) ? 'selected="selected"' : "";
		
		$html .= "<option value='$value' $selected>$title</option>\n";
	}
	
	return $html;	
}





function generate_select_options_simple ($data, $selected_item = false, $use_local = false)
{
	$html = '';
	foreach ($data as $item) {
		
		$selected = ($item == $selected_item) ? 'selected="selected"' : "";
		
		$display_item = ($use_local) ? l($item) : $item;
		$html .= "<option value=\"{$item}\" {$selected}>{$display_item}</option>\n";
	}
	
	return $html;	
}








// ---------------------------------- array saving, loading using file -------------------------------------------
function read_array_from_file($file_name)
{
	// if data file exists, load 
	if (! file_exists($file_name)) return array();
	
	$body = file_get_contents ($file_name);
	$array = unserialize($data);
	
	if (! is_array($array)) return array();
	return $array;
}





function save_array_to_file($file_name, $array)
{
	$body = serialize($array);
	$result = file_put_contents ($file_name, $body);
	return $result;
}








// ---------------------------------- date functions -------------------------------------------
// date time formating
function format_short_datetime($expr)
{
	$expr = strtotime($expr);
	//return date('Y/m/d h:i a', $expr);
	return iconv('windows-1256', 'UTF-8', strftime('%d/%m/%Y %H:%M %p', $expr));
}


function format_long_datetime($expr)
{
	$expr = strtotime($expr);
	//return date('D d/m/Y h:i a', $expr);
	return iconv('windows-1256', 'UTF-8', strftime('%a %d %b %Y %H:%M %p', $expr));
}

function format_short_date($expr)
{
	$expr = strtotime($expr);
	//return date('Y/m/d', $expr);
	return iconv('windows-1256', 'UTF-8', strftime('%d/%m/%Y', $expr));
}


function format_long_date($expr)
{
	$expr = strtotime($expr);
	//return date('D d/m/Y', $expr);
	return iconv('windows-1256', 'UTF-8', strftime('%a %d %b %Y', $expr));
}



// date parsing functions
function date_parse_dmy($expr)
{
	$date = explode("/", $expr);
	return mktime(0,0,0,$date[1],$date[0],$date[2]);
}



// date conversion functions
function dmy2ymd($expr)
{
	if (! $expr) return false;
	
	$date = explode("/", $expr);
	$date = mktime(0,0,0,$date[1],$date[0],$date[2]);
	return date("Y/m/d", $date);
}








// ------------------------------------- validation functions ----------------------------------------
// any empty changed to be false
function empty2false ($var) {
	if (empty($var)) 
		return false;
	else
		return $var;
}




// check empty
function ifempty ($var, $empty_value, $not_empty_value = 'x.x') {
	if (empty($var)) 
		return $empty_value;
	else
		return ($not_empty_value != 'x.x') ? $not_empty_value : $var;
}



// for each element if element is emty remove from array
function array_empty ($array) {
	$ret_array = array();
	foreach($array as $key => $value){
		if(isset($value) && $value != null && $value != '')
		$ret_array[$key] = $value;
	}
	return $ret_array;
}




// email checking
function is_valid_email($email){
	return (preg_match("/^[^@]*@[^@]*\.[^@]*$/", $email));	
}









// --------------------------------------- math --------------------------------------
// calculate total of field in data
function total ($data, $field) {
	$result = 0;
	if (is_array($data))
		foreach ($data as $record)
			$result += (float) $record[$field];
			
	return $result;
}




// ------------------------------------- file ----------------------------------------
// file functions

function file_ext ($filename) {
	$pos = strrpos ($filename, '.');
	$ext = substr ($filename, $pos + 1, strlen($filename) - $pos);
	$ext = strtolower ($ext);
	return $ext;
}


function file_base ($filename) {
	// where / or \ starts
	$pos1 = strrpos($filename, '/');
	$pos2 = strrpos($filename, '\\');
	$pos1 = ($pos1 > $pos2) ? $pos1 : $pos2;
	
	// where . starts
	$pos2 = strrpos($filename, '.');
	
	return substr($filename, $pos1, $pos2 - $pos1);	
}


function file_delete_if_exist ($filename) {
	if (file_exists ($filename)) return unlink ($filename);
	return true;
}









// ---------------------- simple template engine solutions ----------------------

// ---------------------- render, simple template engine ---------------------- 
function render ($template_file, $global_variable_names = '') {
	
	// activiate global variables
	if ($global_variable_names) {
		$vars = explode (',', $global_variable_names);
		foreach ($vars as $var) {
			$var = trim($var);
			if ($var) global $$var;
		}		
	} else {
		foreach ($GLOBALS as $key => $value) {
			$$key = $value;
		}
	}
	
	// start caching the results
	ob_start();
	
	include ($template_file);

	$result = ob_get_contents();
	ob_end_clean();
	
	return $result;
}






// ---------------------- another template engine idea, by start_rebder then do our work, ----------------------
// ---------------------- then end_render, this gives our work html as a seperate variable ----------------------
function start_render () {
	ob_start();
}

function end_render () {
	$result = ob_get_contents();
	ob_end_clean();
	
	return $result;
}







/* ----------------- clean all html ----------------- */
function clean_html (&$var) {
	if (is_array ($var)) {
		foreach ($var as $key => $value) {
			if (! is_array ($value))
				$var[$key] = strip_tags ($value);
		}
	} else $var = strip_tags ($var);
}






/* ----------------- Lookup data ----------------- */
function getLookup ($data, $keyField, $lookupField, $keyValue) {
	foreach ($data as $record) {
		$key = $record[$keyField];
		if ($key == $keyValue) return $record[$lookupField];
	}
	return false;
}







/* ----------------- is_image_ext ----------------- */
function is_image_ext ($filename)
{
	$types = array('jpg', 'gif', 'jpeg', 'png');
	
	$ext = file_ext ($filename);
	return in_array ($ext, $types);	
}








// ------------------------------------- strings ----------------------------------------
// extract 1st 20 character of long string
function brief ($expr, $char_count = 100, $strip_tags = true)
{
	if ($strip_tags) $expr = strip_tags($expr);
	if (mb_strlen ($expr) > $char_count) $expr = mb_substr ($expr, 0, $char_count) . ' ...';

	return $expr; 
}






// ------------------------------------- youtube_id ----------------------------------------
function youtube_id ($youtube_url)
{
	preg_match ('/[\\?\\&]v=([^\\?\\&]+)/', $youtube_url, $matches);
	return $matches[1];
}











/* -----------------  ----------------- */
function generate_paging_links ($url, $pages_count, $page_no, $class="")
{
	if ($pages_count <= 1) return '';
	$buffer = '';
	
	if ($page_no > 1) $buffer .= '<a href="' . $url . ($page_no-1) . '" class="' . $class . '">Prev</a> ';
	
	for ($i = 1; $i <= $pages_count; $i++) {
		$current = ($page_no == $i) ? 'current' : '';
		$buffer .= '<a href="' . $url . $i . '" class="' . $class . ' ' . $current . '">' . $i . '</a> ';
	}
	
	if ($page_no < $pages_count) $buffer .= '<a href="' . $url . ($page_no+1) . '" class="' . $class . '">Next</a> ';
	
	return $buffer;	
}









/* -----------------  ----------------- */
/* -----------------  ----------------- */
/* -----------------  ----------------- */
/* -----------------  ----------------- */
/* -----------------  ----------------- */
/* -----------------  ----------------- */
/* -----------------  ----------------- */

?>