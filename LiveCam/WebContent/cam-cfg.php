<?php
/*****************************************************************************
 * 
 * Copyright (c) 2016, Martin Rosicky <martin.rosicky@techniarch.com>
 * All rights reserved
 * 
 * This file 'cam-cfg.php' is part of 'Camera Live Streamer Project'.
 *
 * 'Camera Live Streamer Project' is free software: you can redistribute it
 * and/or modify it under the terms of the GNU Lesser General Public License
 * as published by the Free Software Foundation,
 * either version 3 of the License, or (at your option) any later version.
 *
 * 'Camera Live Streamer Project' is distributed in the hope that it will
 * be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * in file LICENSE-LGPLv3 distributed with 'Camera Live Streamer Project'.
 * If not, see <http://www.gnu.org/licenses/>.
 *
 ******************************************************************************/

/******************************************************************************
 * file contains defintions for camera files manipulation tools
 ******************************************************************************/

// root folder of web server in OS filesystem
define('__ROOT__',dirname(dirname(dirname(__FILE__))));

// root folder for camera uploads
define('__CAMERA_ROOT__',__ROOT__ . DIRECTORY_SEPARATOR . 'camera');
//define('__CAMERA_ROOT__','.');

// define how many history images should be kept on the server
define('__KEEP_LAST__',5); 

// list of identification strings for cameras uploading images to server
//    image file MUST contain defined string
$CAMERAS = array("DEMOCAM-1","DEMOCAM-2");
?>
