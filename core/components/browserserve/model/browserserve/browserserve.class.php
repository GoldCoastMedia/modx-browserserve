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

		// Case insensitivity on snippet parameters
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


		// Return the user agent in a chunk
		if($this->config['returnagent']) {
			return $this->_user_agent;
		}
	}
	
	/**
	 * Return raw user agent.
	 *
	 * @return  string     returns raw user agent in a chunk
	 */
	protected function return_agent()
	{}

	/**
	 * Return array from comma seperated arguments
	 *
	 * @param   string     $cs_str  comma seperated string
	 * @return  array      
	 */	
	protected function prepare_array($cs_str)
	{
		$arr = array_map('trim', explode(',', $cs_str));
		
		if(is_array($arr))
			return $arr;
	}

	/**
	 * Return whether the clients user agent matches
	 *
	 * @return  boolean    whether a match has been made
	 */	
	protected function match_user_agent()
	{}

	/**
	 * Inserts CSS into the socument head
	 *
	 * @param   array      $arr  css files
	 */
	protected function insert_css(array $stylesheets)
	{
		foreach ($stylesheets as $css) {
			$this->modx->regClientCSS($css);
		}
	}

	/**
	 * Insert JavaScript into the MODx document template head
	 *
	 * @param   array      $arr  javascript files
	 */
	protected function insert_js(array $scripts)
	{
		foreach ($scripts as $javascript) {
			$this->modx->regClientStartupScript($javascript);
		}
	}

	/**
	 * Insert JavaScript into document body
	 *
	 * @param   array       $arr  javascript files
	 */
	protected function insert_body_js(array $scripts)
	{
		foreach ($scripts as $javascript) {
			$this->modx->regClientScript($javascript);
		}
	}

	/**
	 * Run snippets
	 *
	 * @param   array      $arr  snippets to run
	 */
	protected function run_snippet(array $snippets)
	{
		foreach ($snippets as $snippet) {
			$this->modx->runSnippet($snippet, array());
		}
	}

	/**
	 * Get a MODx chunk
	 *
	 * @param   string     $name	        chunk name
	 * @param   array      $properties	chunk properties
	 * @return  object     returns modChunk
	 */
	protected function get_chunk($name, array $properties)
	{
		$chunk = $this->modx->getChunk($name, $properties);
		
		return $chunk;
	}
}

