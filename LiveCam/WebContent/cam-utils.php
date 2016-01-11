<?php
/*****************************************************************************
 * 
 * Copyright (c) 2016, Martin Rosicky <martin.rosicky@techniarch.com>
 * All rights reserved
 * 
 * This file 'cam-utils.php' is part of 'Camera Live Streamer Project'.
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
 * file contains utilities for camera files manipulation
 ******************************************************************************/

/******************************************************************************
 * Function getCameraFiles($dir,$CAMID) searches for files uploaded by camera
 * in defined parent folder and all day sudirectories 
 *
 * Params:
 *     $dir     parent folder
 *     $CAMID   identification string for camera @see cam-cfg.php#$CAMERAS
 *
 * Returns one dimesional array of filenames
 *
 ******************************************************************************/

function getCameraFiles($dir,$CAMID) {
 
   $result = array();
   $cdir = scandir($dir); 
   foreach ($cdir as $key => $value) 
   { 
         if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) 
         { 
	    if (preg_match("/^\d{8}$/",$value))
	    {
         $result = array_merge($result,getCameraFiles($dir . DIRECTORY_SEPARATOR . $value,$CAMID));
	    }
         } 
         else 
         { 
            if (strpos($value,$CAMID) !== false)
            {
               if (preg_match("/(\d{14}_[^\.]+)/",$value,$matches)) 
               {
                     $result[$matches[1]] = $dir . DIRECTORY_SEPARATOR . $value; 
               }
            }
         } 
   } 
  
   ksort($result); 
   return $result; 
} 
?>
