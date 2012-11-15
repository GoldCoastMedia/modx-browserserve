<?php
/*
 * BrowserServe - Serve resources for individual browsers
 *
 * Copyright (c) 2011-2012 Gold Coast Media
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

	protected $_modx;
	protected $_user_agent;

	public $config = array(
		'insertbodyjs' => array(),
		'insertcss'    => array(),
		'insertjs'     => array(),
		'matchtype'    => 1,
		'returnagent'  => 0,
		'runsnippet'   => array(),
		'tpl'          => 'useragent',
		'useragent'    => NULL,
	);

	public function __construct(modX &$modx, array &$config)
	{
		$this->modx =& $modx;
		$this->modx->setLogLevel(modX::LOG_LEVEL_DEBUG);

		// Force all parameters to lowercase
		$config = array_change_key_case($config, CASE_LOWER);

		// Merge snippet parameters with default config
		$this->config = array_merge($this->config, $config);

		// Set the user agent
		$this->_user_agent = $_SERVER['HTTP_USER_AGENT'];
	}
	
	/**
	 * Main snippet call
	 *
	 * @return  string  output specified by snippet call
	 */
	public function run()
	{
		
	}
	
	/**
	 * Return raw user agent.
	 *
	 * @return  string     returns raw user agent in a chunk
	 */
	protected function return_agent()
	{
		if($chunk = $this->config['tpl'])
		{
			$properties = array(
				'useragent' => $this->_user_agent;
			);
			
			return $this->get_chunk($chunk, $properties);
		}
		else
			return $this->_user_agent;
	}

	/**
	 * Return whether the clients user agent matches (or doesn't)
	 *
	 * @return  boolean    whether a match has been made
	 */	
	protected function match_user_agent($to_match = array())
	{
		$match = FALSE;
		
		foreach($to_match as $user_agent) {
			if(stristr($this->_user_agent, $user_agent)){
				$match = TRUE;
			}
		}
		
		if( !$match AND $this->matchtype === 0)
			$match = TRUE;
		if($match AND $this->matchtype === 0)
			$match = FALSE;
			
		return $match;
	}

	/**
	 * Insert CSS into the a documents head
	 *
	 * @param   array  $arr  css files
	 * @return  void
	 */
	protected function insert_css($stylesheets = array())
	{
		if( !is_array($stylesheets))
		{
			// FIXME: A better way to do this
			$stylesheet = str_split($stylesheet, strlen($stylesheet));
		}

		foreach ($stylesheets as $css)
		{
			$this->modx->regClientCSS($css);
		}
	}

	/**
	 * Insert JavaScript into the MODx document template head
	 *
	 * @param  array  $arr  javascript files
	 */
	protected function insert_js($scripts = array())
	{
		if( !is_array($scripts))
		{
			// FIXME: A better way to do this
			$script = str_split($script, strlen($script));
		}

		foreach ($scripts as $script)
		{
			$this->modx->regClientStartupScript($css);
		}
	}
	
	/**
	 * Insert JavaScript into document body
	 *
	 * @param  array  $arr  javascript files
	 */
	protected function insert_body_js($scripts = array())
	{
		if( !is_array($scripts))
		{
			// FIXME: A better way to do this
			$script = str_split($script, strlen($script));
		}

		foreach ($scripts as $script)
		{
			$this->modx->regClientScript($css);
		}
	}

	/**
	 * Run snippets
	 *
	 * @param  array  $arr  snippets to run
	 */
	protected function run_snippet($snippets = array())
	{
		foreach ($snippets as $snippet)
		{
			$this->modx->runSnippet($snippet, array());
		}
	}

	/**
	 * Get a MODx chunk
	 *
	 * @param   string  $name	 chunk name
	 * @param   array   $properties	 chunk properties
	 * @return  object  returns	 modChunk
	 */
	protected function get_chunk($name, $properties = array())
	{
		$chunk = $this->modx->getChunk($name, $properties);
		return $chunk;
	}

	/**
	 * Return array from comma separated arguments
	 *
	 * @param   string       $string  comma separated string
	 * @return  array|FALSE
	 */	
	protected function prepare_array($string)
	{
		$csv = array_map('trim', explode(',', $string));
		$csv = ( is_array($csv) ) ? $csv : FALSE;

		return $csv;
	}
}

