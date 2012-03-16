<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2003 - 2011, EllisLab, Inc.
 * @license		http://expressionengine.com/user_guide/license.html
 * @link		http://expressionengine.com
 * @since		Version 2.0
 */

/**
 * Pitch No Code Plugin
 *
 * @package		ExpressionEngine
 * @subpackage	Addons
 * @category	Plugin
 * @author		Pitch
 * @link		http://pitch.net.nz
 */

$plugin_info = array(
	'pi_name'		=> 'Pitch No Code',
	'pi_version'	=> '1.0.0',
	'pi_author'		=> 'Pitch',
	'pi_author_url'	=> 'http://pitch.net.nz',
	'pi_description'=> 'A plugin to strip code such as html and js.',
	'pi_usage'		=> Pitch_no_code::usage()
);

  
class Pitch_no_code
{
	function pitch_no_code()
	{
		
		// Give us access to EE functions please.
		$this->EE =&get_instance();
		
		// Grab everything inside our tag pair and put into content var.
		$content = $this->EE->TMPL->tagdata;
		
		// Strip out all content which matches our regex.
		$content = preg_replace('@<(script|style)[^>]*?>.*?@si', '', $content);
		
		// Now for extra safety run this content through the native PHP strip_tags function (php.net/manual/en/function.strip-tags.php)
		$content = strip_tags($content);		
		
		// Finally lets return our clean content to the user. If no content exists die quietly.
		$this->return_data = (isset($content)) ? $content : '';
		
	}

	function usage()
	{
		ob_start(); 
?>

	This simple plugin is designed to strip out any html, css, js and php code from the content inside the tag pair. This is helpful when you want clean text with no mark up from a field which is a WYSIWYG for example.
	{exp:pitch_no_code}{your-field-goes-here}{/exp:pitch_no_code}

<?php
		$buffer = ob_get_contents();
		ob_end_clean(); 
		return $buffer;
	}
}

/* End of file pi.pitch_no_code.php */
/* Location: /system/expressionengine/third_party/pitch_no_code/pi.pitch_no_code.php */