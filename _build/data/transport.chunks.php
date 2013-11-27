<?php
/**
 * BrowserServe transport chunks
 *
 * Copyright 2011-2012 Gold Coast Media Ltd
 *
 * BrowserServe is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * BrowserServe is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * BrowserServe; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package     browserserve
 * @subpackage  build
 * @author      Dan Gibbs <dan@goldcoastmedia.co.uk>
 */

$chunks = array();

$chunks[1]= $modx->newObject('modChunk');
$chunks[1]->fromArray(array(
    'id' => 1,
    'name' => 'browserserve_useragent',
    'description' => 'User Agent',
    'snippet' => file_get_contents($sources['source_core'] . '/elements/chunks/useragent.chunk.tpl'),
    'properties' => '',
),'',true,true);


return $chunks;
