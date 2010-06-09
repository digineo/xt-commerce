<?
/**
 * Image Manager configuration file.
 * @author $Author: Wei Zhuo $
 * @version $Id: config.inc.php 27 2004-04-01 08:31:57Z Wei Zhuo $
 * @package ImageManager
 */

   if (!$script_filename = str_replace('\\', '/', getenv('PATH_TRANSLATED'))) {
    $script_filename = getenv('SCRIPT_FILENAME');
  }
  $script_filename = str_replace('//', '/', $script_filename);

  if (!$request_uri = getenv('REQUEST_URI')) {
    if (!$request_uri = getenv('PATH_INFO')) {
      $request_uri = getenv('SCRIPT_NAME');
    }

    if (getenv('QUERY_STRING')) $request_uri .=  '?' . getenv('QUERY_STRING');
  }

  $dir_fs_www_root_array = explode('/', dirname($script_filename));
  $dir_fs_www_root = array();
  for ($i=0; $i<sizeof($dir_fs_www_root_array)-2; $i++) {
    $dir_fs_www_root[] = $dir_fs_www_root_array[$i];
  }
  $dir_fs_www_root = implode('/', $dir_fs_www_root);

  $dir_ws_www_root_array = explode('/', dirname($request_uri));
  $dir_ws_www_root = array();
  for ($i=0; $i<sizeof($dir_ws_www_root_array)-1; $i++) {
    $dir_ws_www_root[] = $dir_ws_www_root_array[$i];
  }
  $dir_ws_www_root = implode('/', $dir_ws_www_root);

  $dir =explode('/includes/',$dir_ws_www_root);

  if (file_exists($_SERVER['DOCUMENT_ROOT'].$dir[0].'/includes/local/configure.php')) {
    include($_SERVER['DOCUMENT_ROOT'].$dir[0].'/includes/local/configure.php');
  } else {
    require($_SERVER['DOCUMENT_ROOT'].$dir[0].'/includes/configure.php');
  }
// base url for images

/* 
 File system path to the directory you want to manage the images
 for multiple user systems, set it dynamically.

 NOTE: This directory requires write access by PHP. That is, 
       PHP must be able to create files in this directory.
	   Able to create directories is nice, but not necessary.
*/

$IMConfig['base_dir'] = DIR_FS_CATALOG.'media/products/';

/*
 The URL to the above path, the web browser needs to be able to see it.
 It can be protected via .htaccess on apache or directory permissions on IIS,
 check you web server documentation for futher information on directory protection
 If this directory needs to be publicly accessiable, remove scripting capabilities
 for this directory (i.e. disable PHP, Perl, CGI). We only want to store assets
 in this directory and its subdirectories.
*/
$IMConfig['base_url'] = HTTP_CATALOG_SERVER.DIR_WS_CATALOG.'media/products/';

/*
  Possible values: true, false

  TRUE - If PHP on the web server is in safe mode, set this to true.
         SAFE MODE restrictions: directory creation will not be possible,
		 only the GD library can be used, other libraries require
		 Safe Mode to be off.

  FALSE - Set to false if PHP on the web server is not in safe mode.
*/
$IMConfig['safe_mode'] = false;

/*
 Possible values: 'GD', 'IM', or 'NetPBM'

 The image manipulation library to use, either GD or ImageMagick or NetPBM.
 If you have safe mode ON, or don't have the binaries to other packages, 
 your choice is 'GD' only. Other packages require Safe Mode to be off.
*/
define('IMAGE_CLASS', 'GD');


/*
 After defining which library to use, if it is NetPBM or IM, you need to
 specify where the binary for the selected library are. And of course
 your server and PHP must be able to execute them (i.e. safe mode is OFF).
 GD does not require the following definition.
*/
define('IMAGE_TRANSFORM_LIB_PATH', 'C:/"Program Files"/ImageMagick-5.5.7-Q16/');


/* ==============  OPTIONAL SETTINGS ============== */


/*
  The prefix for thumbnail files, something like .thumb will do. The
  thumbnails files will be named as "prefix_imagefile.ext", that is,
  prefix + orginal filename.
*/
$IMConfig['thumbnail_prefix'] = '.';

/*
  Thumbnail can also be stored in a directory, this directory
  will be created by PHP. If PHP is in safe mode, this parameter
  is ignored, you can not create directories. 

  If you do not want to store thumbnails in a directory, set this
  to false or empty string '';
*/
$IMConfig['thumbnail_dir'] = '.thumbs';

/*
  Possible values: true, false

 TRUE -  Allow the user to create new sub-directories in the
         $IMConfig['base_dir'].

 FALSE - No directory creation.

 NOTE: If $IMConfig['safe_mode'] = true, this parameter
       is ignored, you can not create directories
*/
$IMConfig['allow_new_dir'] = true;

/*
  Possible values: true, false

  TRUE - Allow the user to upload files.

  FALSE - No uploading allowed.
*/
$IMConfig['allow_upload'] = true;

/*
 Possible values: true, false

 TRUE - If set to true, uploaded files will be validated based on the 
        function getImageSize, if we can get the image dimensions then 
        I guess this should be a valid image. Otherwise the file will be rejected.

 FALSE - All uploaded files will be processed.

 NOTE: If uploading is not allowed, this parameter is ignored.
*/
$IMConfig['validate_images'] = true;

/*
 The default thumbnail if the thumbnails can not be created, either
 due to error or bad image file.
*/
$IMConfig['default_thumbnail'] = 'img/default.gif';

/*
  Thumbnail dimensions.
*/
$IMConfig['thumbnail_width'] = 96;
$IMConfig['thumbnail_height'] = 96;

/*
  Image Editor temporary filename prefix.
*/
$IMConfig['tmp_prefix'] = '.editor_';
?>