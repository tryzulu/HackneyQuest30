<?php 
require_once('src/Minify.php');
require_once('src/CSS.php');
require_once('src/JS.php');
require_once('src/Exception.php');
require_once('src/Converter.php');

use MatthiasMullie\Minify;

class assets {
	public $ncCssFonts = array(
		"../lib/font-awesome/css/font-awesome.min.css",
		"../lib/themify-icons/themify-icons.css",
		"../lib/Icon-font-7-stroke-PIXEDEN/css/pe-icon-7-stroke.css",
		"../lib/et-line-font/style.css"
	);

	public $ncCssLib = array(
		"../lib/animation/animate.css",
		"../css/custom-animation.css",
		"../lib/owl-carousel/owl.carousel.css",
		"../lib/sweetalert/sweetalert.css",
		"../lib/Magnific-Popup/magnific-popup.css",
		"../lib/Swiper/css/swiper.min.css"
	);

	public $ncCssMain = array(
		"../lib/bootstrap/css/bootstrap.min.css",
		"../css/nc-grids.css",
		"../css/main.css",
		"../css/helper.css",
		"../css/responsive.css"
	);

	public $ncJsFiles = array(
		"../lib/jquery/jquery-1.12.4.min.js",
		"../lib/bootstrap/js/bootstrap.min.js",
		"../lib/jquery-validation/jquery.validate.min.js",
		"../js/plugins.js",
		"../lib/Swiper/js/swiper.jquery.min.js"
	);

	public function cssMinify($cssList, $inlineCSS = '', $fileKey = ''){
		$cssMinifier = new Minify\CSS();

		if (sizeof($cssList) > 0) {
			// All CSS files
			foreach ($cssList as $key => $value) {
				$cssMinifier->add($value);
			}
			
			// In-line CSS minify
			$cssMinifier->add($inlineCSS);

			$minifiedPath = $fileKey.'.css';
			$cssMinifier->minify($minifiedPath);
		}
	}

	public function jsMinify($jsList, $fileKey = ''){
		$jsMinifier = new Minify\JS();

		if (sizeof($jsList) > 0) {
			// All JS files
			foreach ($jsList as $key => $value) {
				$jsMinifier->add($value);
			}

			$minifiedPath = $fileKey.'.js';
			$jsMinifier->minify($minifiedPath);
		}
	}
}

$assetClass =  new assets();
$assetClass->cssMinify($assetClass->ncCssFonts, '', 'nc_font_min');
$assetClass->cssMinify($assetClass->ncCssLib, '', 'nc_lib_min');
$assetClass->cssMinify($assetClass->ncCssMain, '', 'nc_main_min');
$assetClass->jsMinify($assetClass->ncJsFiles, 'nc_js_min');

?>