# LiveCam
The goal of this small project is to provide as simple as possible way for integration of live camera feed to web page. Main idea is based on fact that IP cameras are able to upload static picture to FTP server in configurable time interval and web page itself can regularly download last uploaded image. Package contains cron script for cleaning of old camera files from filesystem as well.

Tools have been devveloped in using php and Javascript, so that solution can be used on most of web hostings.

## Prequisities
1. Web server with PHP
2. FTP access to web server /it's recommended to define dedicated access directly to sub-folder for camera/
3. CRON feature on the web server to execute cleaning php script

## Expected directory structure on web server
```
<main_camera_folder>
|-- cam-cfg.php
|-- cam-utils.php
|-- clean-camera-files.php
|-- last-image.js
|-- last-image.php
|-- live.html
|-- 20160111
|   |-- DEMOCAM-1_20160111081000.jpg
|   |-- DEMOCAM-1_20160111081005.jpg
|   |-- DEMOCAM-1_20160111081010.jpg
|   |-- DEMOCAM-2_20160111081000.jpg
|   |-- DEMOCAM-2_20160111081005.jpg
|   |-- DEMOCAM-2_20160111081010.jpg
```

## Quick Start
1. upload files form [LiveCam/webContent](https://github.com/TechniArch/LiveCam/tree/master/LiveCam/WebContent) to subfolder /let say `camera`/ of your web server
2. check file 'cam-cfg.php' and update subfolder name in `define('__CAMERA_ROOT__',__ROOT__ . DIRECTORY_SEPARATOR . 'camera');`
3. define identificator of your camera in array `$CAMERAS = array("DEMOCAM-1","DEMOCAM-2");` *tool can work with more cameras, but it requires some modifications in last-image.js* - camera identificatior is any constant substring in filename of imige uploaded by camera
4. configure your camera to upload files to your server; it's expected that camera uploads images to the subfolder of our camera folder - name of subfolder is day timestamp
5. open link `http://<your_server>/camera/live.html` in your browser
6. configure  CRON to run `clean-camera-files.php` regularly; just ensure that `require_once(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'camera' . DIRECTORY_SEPARATOR . 'cam-cfg.php');` can reach configuration

