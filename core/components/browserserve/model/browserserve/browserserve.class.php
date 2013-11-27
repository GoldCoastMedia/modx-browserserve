<?php
/*
 * BrowserServe - Serve resources for individual browsers
 *
 * Copyright (c) 2011-2013 Gold Coast Media
 *
 * This file is part of BrowserServe.
 *
 * BrowserServe is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * BrowserServe is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * BrowserServe; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package  browserserve
 * @authors  Dan Gibbs <dan@goldcoastmedia.co.uk>
 */

class browserServe {

	private $modx;
	private $user_agent;

	public $config = array(
		'css'       => array(),
		'js'        => array(),
		'jsbody'    => array(),
		'match'     => TRUE,
		'return'    => FALSE,
		'snippet'   => array(),
		'tpl'       => 'browserserve_useragent',
		'useragent' => NULL,
	);

	public function __construct(modX &$modx, array &$config)
	{
		$this->modx =& $modx;
		$this->modx->setLogLevel(modX::LOG_LEVEL_DEBUG);

		// Force all parameters to lowercase
		$config = array_change_key_case($config, CASE_LOWER);
		$this->config = array_merge($this->config, $config);

		// Set the user agent
		$this->user_agent = $_SERVER['HTTP_USER_AGENT'];
	}


	public function run()
	{
		// Return the user agent string
		if($this->config['return'])
			return $this->return_agent($this->user_agent, $this->config['tpl']);

		// Match 
	}
	
	/**
	 * Return raw user agent.
	 *
	 * @param   string  $useragent  The useragent
	 * @param   string  $chunk      The chunk name
	 *
	 * @return  string  returns raw user agent in a chunk
	 */
	private function return_agent($useragent, $chunk = NULL)
	{
		if($chunk) {
			$properties = array('useragent' => $useragent);
			
			return $this->get_chunk($chunk, $properties);
		}
		else
			return $useragent;
	}

	/**
	 * Return whether the clients user agent matches (or doesn't)
	 *
	 * @param  array   $match       array of matches to make
	 * @param  string  $type        match type
	 * @param  string  $useragent   the useragent
	 *
	 * @return  bool   $found       whether a match has been made
	 */	
	private function match_user_agent($match = array(), $type, $useragent)
	{
		$found = FALSE;
		
		foreach($match as $search) {
			if( stristr($useragent, $search) )
				$match = TRUE;
		}
		
		// Reverse matches if match type is set to 0
		$found = (!$found AND $type == 0) ? TRUE : FALSE;
		$found = ($found AND $type == 0) ? FALSE : TRUE;
			
		return $found;
	}

	/**
	 * Insert CSS into the a documents head
	 *
	 * @param   array  $stylesheets  css files
	 */
	private function insert_css($stylesheets = array())
	{
		if( !is_array($stylesheets)) {
			// FIXME: A better way to do this
			$stylesheet = str_split($stylesheet, strlen($stylesheet));
		}

		foreach ($stylesheets as $css) {
			$this->modx->regClientCSS($css);
		}
	}

	/**
	 * Insert JavaScript into the MODx document template head
	 *
	 * @param  array  $scripts  javascript files
	 */
	private function insert_js($scripts = array())
	{
		if( !is_array($scripts)) {
			// FIXME: A better way to do this
			$script = str_split($script, strlen($script));
		}

		foreach ($scripts as $script) {
			$this->modx->regClientStartupScript($css);
		}
	}
	
	/**
	 * Insert JavaScript into document body
	 *
	 * @param  array  $scripts  javascript files
	 */
	private function insert_body_js($scripts = array())
	{
		if( !is_array($scripts)) {
			// FIXME: A better way to do this
			$script = str_split($script, strlen($script));
		}

		foreach ($scripts as $script) {
			$this->modx->regClientScript($css);
		}
	}

	/**
	 * Run snippets
	 *
	 * @param   array  $snippets  snippets to run
	 */
	private function run_snippet($snippets = array())
	{
		foreach ($snippets as $snippet) {
			$this->modx->runSnippet($snippet, array());
		}
	}

	/**
	 * Get a MODx chunk
	 *
	 * @param   string  $name	     chunk name
	 * @param   array   $properties	 chunk properties
	 *
	 * @return  object  returns	     modChunk
	 */
	private function get_chunk($name, $properties = array())
	{
		$chunk = $this->modx->getChunk($name, $properties);
		return $chunk;
	}

	/**
	 * Return array from comma separated arguments
	 *
	 * @param   string       $string  comma separated string
	 *
	 * @return  array|FALSE
	 */	
	private function prepare_array($string)
	{
		$csv = array_map('trim', explode(',', $string));
		$csv = ( is_array($csv) ) ? $csv : FALSE;

		return $csv;
	}
}
