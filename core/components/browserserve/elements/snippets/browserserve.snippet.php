<?php
/**
 * BrowserServe - Serve resources to individual browsers
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
 * @authors  Dan Gibbs <dan@goldcoastmedia.co.uk>
 * @package  browserserve
 */

require_once $modx->getOption('core_path') . 'components/browserserve/model/browserserve/browserserve.class.php';
$browserserve = new browserServe($modx, $scriptProperties);

$result = $browserserve->run();
unset($browserserve);
return $result;
