<?php
/*****************************************************************************
 * 
 * Copyright (c) 2016, Martin Rosicky <martin.rosicky@techniarch.com>
 * All rights reserved
 * 
 * This file 'clean-camera-files.php' is part of 'Camera Live Streamer Project'.
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
 * Script clears files uploaded to subfolders of by all defined cameras
 * - newest __KEEP_LAST__ files are not deleted
 * - empty day folders are deleted
 ******************************************************************************/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
error_reporting(0); // disable error reporting

// update path to config file (cron scripts are usualy outside standard web folder)
require_once(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'camera' . DIRECTORY_SEPARATOR . 'cam-cfg.php');
require_once(__CAMERA_ROOT__ . DIRECTORY_SEPARATOR . 'cam-utils.php');

foreach($CAMERAS as $key => $camera) {
  $files = getCameraFiles(__CAMERA_ROOT__,$camera); //get list of camera files

//debug  print_r($files);

  if (count($files)>__KEEP_LAST__) {
//debug    echo "unlink(".reset($files).");" . PHP_EOL;
    unlink(reset($files));
    for ($ii = 0; $ii<(count($files)-__KEEP_LAST__-1); ++$ii) {
//debug      echo "unlink(".next($files).");" . PHP_EOL;
      unlink(next($files));
    }
  }
}

$cdir = scandir(__CAMERA_ROOT__);
foreach ($cdir as $key => $value) 
{ 
  if (is_dir(__CAMERA_ROOT__ . DIRECTORY_SEPARATOR . $value)) 
  { 
    if (preg_match("/^\d{8}$/",$value))
    {
      try {
        // try to remove day subfolder
        rmdir(__CAMERA_ROOT__ . DIRECTORY_SEPARATOR . $value);
      } catch (Exception $ignore) {
	      //do nothing; folder is not empty probably
      }
    }
  } 
} 

?>
