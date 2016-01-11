<?php
/*****************************************************************************
 * 
 * Copyright (c) 2016, Martin Rosicky <martin.rosicky@techniarch.com>
 * All rights reserved
 * 
 * This file 'last-image.php' is part of 'Camera Live Streamer Project'.
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
 * Script returns to browser last img from defined camera
 *
 * Params:
 *    cam   index of camera in $CAMERAS array /default is 0/
 ******************************************************************************/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
error_reporting(0); // disable error reporting

require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cam-cfg.php');
require_once(__CAMERA_ROOT__ . DIRECTORY_SEPARATOR . 'cam-utils.php');

$dir = __CAMERA_ROOT__;
$CAMID = (isset($_GET['cam']) && is_numeric($_GET['cam']) && isset($CAMERAS[$_GET['cam']])) ? $CAMERAS[$_GET['cam']] : $CAMERAS[0];

$files = getCameraFiles($dir,$CAMID);

$last_file = end($files);

/*******
// debug only
print_r($files);
echo "Last file is: <$last_file>";
exit;
*/

// open the file in a binary mode
$fp = fopen($last_file, 'rb');

// send the right headers
header("Content-Type: image/jpg");
header("Content-Length: " . filesize($last_file));
header("Timestamp: " . key($files));

// dump the picture and stop the script
fpassthru($fp);
exit;
?>
