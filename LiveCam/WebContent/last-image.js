/*****************************************************************************
 * 
 * Copyright (c) 2016, Martin Rosicky <martin.rosicky@techniarch.com>
 * All rights reserved
 * 
 * This file 'last-image.js' is part of 'Camera Live Streamer Project'.
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
 * Script downloads last img from defined camera every 5sec
 ******************************************************************************/

var TAimgLoader = function () {
  var imgUrl = "./last-image.php?cam=0";

  // <div id="camera_img_wrapper"> element is parent for image from camera in the page
  var imageElmId = "camera_img_wrapper";

  var imgWrapper = document.getElementById(imageElmId);
  var imgSelf = document.createElement("IMG");

  var reloadImg = function() {
    //attribute 'id' is used to force browser to download the file
    imgSelf.setAttribute("src",imgUrl + "&id=" + (new Date().getTime()));
  }

  document.getElementById(imageElmId).appendChild(imgSelf);
  window.setInterval(reloadImg,5000);
  reloadImg();
}
