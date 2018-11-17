<?php 

require 'less-php/lessc.inc.php';

class rgenfactory {

	public $post        = array();
	public $get         = array();
	public $cssdata     = '';
	public $responseMsg = array();

	public $bgColors = array();

	public $btnColors = array();

	public $bdrColors = array();

	public $txtColors = array();

	public function __construct() {

		include('colortheme.php');

		$this->less = new lessc();

		$this->post = $_POST;
		$this->get  = $_GET;
		$route      = isset($this->get['route']) ? $this->get['route'] : null;

		$colortheme_file = file_get_contents("colortheme.json");
		$colortheme_data = json_decode($colortheme_file, true);

		foreach ($colorData as $demo_file => $demo_theme) {
			$this->colorthemeData($demo_theme);
			$this->themefile($demo_file);
		}
	}

	public function response($type, $result = '') {

		if ($type == 'success') {
			$this->responseMsg['data'] = $result;
			$this->responseMsg['status'] = 'success';

			/*header('Content-Type: application/json');
			echo json_encode($this->responseMsg);*/
			echo json_encode($this->responseMsg);
		}
		
		if ($type == 'error') {
			$this->responseMsg['data'] = $result;
			$this->responseMsg['status'] = 'error';

			/*header('Content-Type: application/json');
			echo json_encode($this->responseMsg);*/
			echo json_encode($this->responseMsg);
		}
		//$this->$responseMsg = $response;

		//return $this->$responseMsg;
	}

	public function objToArray($obj, &$arr=array()){
		if(!is_object($obj) && !is_array($obj)){
			$arr = $obj;
			return $arr;
		}
		foreach ($obj as $key => $value){
			if (!empty($value)){
				$arr[$key] = array();
				$this->objToArray($value, $arr[$key]);
			} else {
				$arr[$key] = $value;
			}
		}
		return $arr;
	}

	public function themefile($file) {
		try{
		    $this->less->compileFile("theme.less", "../css/themes/".$file.".css");
			
			/*$filePath_arr = array(
				'helper' => 'rgen/'.$helperCss_output, 
				'main' => 'rgen/'.$mainCss_output
			);*/
			//$this->response('success');
		}catch(Exception $e){
		    $error_message = $e->getMessage();
		    $this->response('error', $error_message);
		}
	}

	public function colorthemeData($themeData) {

		$file       = 'import-files/colors-variable.less';
		
		$main_str = '';

		/* 
		BACKGROUND COLORS
		********************************************/
		$bgColor_str  = '';
		$bgColor_var  = array();
		$bgColor_names  = array();

		foreach ($themeData['bgColors'] as $bg_name => $bg_val) {
			$bgColor_str .= '@'.$bg_name.': '.$bg_val . ";\n";
			$bgColor_var[] = '@'.$bg_name;
			
			if ($bg_name == "white") {
				$bgColor_names[] = '~"'.$bg_name.'"';
			} else if ($bg_name == "gray") {
				$bgColor_names[] = '~"'.$bg_name.'"';
			} else {
				$bgColor_names[] = $bg_name;
			}
		}

		$bgColor_str .= "\n\n";
		$bgColor_str .= '@all-bg-colors : '.implode(",", $bgColor_var).";\n";
		$bgColor_str .= '@all-bg-color-names : '.implode(",", $bgColor_names).";\n";
		$bgColor_str .= '@all-bg-color-length : length(@all-bg-colors);'."\n";
		$bgColor_str .= "\n\n\n";

		$bgColor_str .= "//===================================================";

		$bgColor_str .= "\n\n\n";


		/* 
		BUTTON COLORS
		********************************************/
		$btnColor_str  = '';
		$btnColor_var  = array();
		$btnColor_names  = array();

		foreach ($themeData['btnColors'] as $btn_name => $btn_val) {
			$btnColor_str .= '@btn-'.$btn_name.': '.$btn_val . ";\n";
			$btnColor_var[] = '@btn-'.$btn_name;
			
			if ($btn_name == "white") {
				$btnColor_names[] = '~"'.$btn_name.'"';
			} else if ($btn_name == "gray") {
				$bgColor_names[] = '~"'.$btn_name.'"';
			} else {
				$btnColor_names[] = $btn_name;
			}
		}

		$btnColor_str .= "\n\n";
		$btnColor_str .= '@all-btn-colors : '.implode(",", $btnColor_var).";\n";
		$btnColor_str .= '@all-btn-color-names : '.implode(",", $btnColor_names).";\n";
		$btnColor_str .= '@all-btn-color-length : length(@all-btn-colors);'."\n";
		$btnColor_str .= "\n\n\n";

		$btnColor_str .= "//===================================================";

		$btnColor_str .= "\n\n\n";


		/* 
		BORDER COLORS
		********************************************/
		$bdrColor_str  = '';
		$bdrColor_var  = array();
		$bdrColor_names  = array();

		foreach ($themeData['bdrColors'] as $bdr_name => $bdr_val) {
			$bdrColor_str .= '@bdr-'.$bdr_name.': '.$bdr_val . ";\n";
			$bdrColor_var[] = '@bdr-'.$bdr_name;
			
			if ($bdr_name == "white") {
				$bdrColor_names[] = '~"'.$bdr_name.'"';
			} else if ($bdr_name == "gray") {
				$bgColor_names[] = '~"'.$bdr_name.'"';
			} else {
				$bdrColor_names[] = $bdr_name;
			}
		}

		$bdrColor_str .= "\n\n";
		$bdrColor_str .= '@all-bdr-colors : '.implode(",", $bdrColor_var).";\n";
		$bdrColor_str .= '@all-bdr-color-names : '.implode(",", $bdrColor_names).";\n";
		$bdrColor_str .= '@all-bdr-color-length : length(@all-bdr-colors);'."\n";
		$bdrColor_str .= "\n\n\n";

		$bdrColor_str .= "//===================================================";

		$bdrColor_str .= "\n\n\n";


		/* 
		TEXT COLORS
		********************************************/
		$txtColor_str  = '';
		$txtColor_var  = array();
		$txtColor_names  = array();

		foreach ($themeData['txtColors'] as $txt_name => $txt_val) {
			$txtColor_str .= '@txt-'.$txt_name.': '.$txt_val . ";\n";
			$txtColor_var[] = '@txt-'.$txt_name;
			
			if ($txt_name == "white") {
				$txtColor_names[] = '~"'.$txt_name.'"';
			} else if ($txt_name == "gray") {
				$bgColor_names[] = '~"'.$txt_name.'"';
			} else {
				$txtColor_names[] = $txt_name;
			}
		}

		$txtColor_str .= "\n\n";
		$txtColor_str .= '@all-txt-colors : '.implode(",", $txtColor_var).";\n";
		$txtColor_str .= '@all-txt-color-names : '.implode(",", $txtColor_names).";\n";
		$txtColor_str .= '@all-txt-color-length : length(@all-txt-colors);'."\n";
		$txtColor_str .= "\n\n\n";

		$txtColor_str .= "//===================================================";

		$txtColor_str .= "\n\n\n";


		/* 
		MAIN FILE
		********************************************/
		$main_str .= $bgColor_str;
		$main_str .= $btnColor_str;
		$main_str .= $bdrColor_str;
		$main_str .= $txtColor_str;
		file_put_contents($file, $main_str.PHP_EOL, LOCK_EX);
		//return $main_str;
	}
}

$rgen = new rgenfactory();
include('colortheme.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style type="text/css">
body {
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size: 13px;
	color: #333;
	margin: 40px;
}
h2{
	font-size: 16px;
	margin: 0 0 15px 0;
}
ul {
	list-style-type: none;
	margin: 0px;
	padding: 0px;
}	
ul li {
	display: inline-block;
	padding-bottom: 15px;
	border: 1px solid rgba(0,0,0,0.2);
	padding: 4px;
	width: 150px;
	margin: 0 10px 10px 0;
	text-align: center;
}
ul li:last-child {
	margin-right: 0px;
}
ul li span {
	display: block;
	height: 50px;
	margin-bottom: 6px;
}
code {
	font-size: 11px;
	margin-bottom: 3px;
	display: block;
}
hr {
  height: 0;
  border: none;
  border-bottom: 1px solid rgba(0, 0, 0, 0.15);
  margin: 30px 0;
}
</style>

</head>
<body>
	
	<?php foreach ($colorData as $k => $v) { ?>
	<div style="padding: 30px; border: 1px solid rgba(0,0,0,0.1);">
		<h1 style="margin: 0px;"><?php echo $k; ?></h1>
		<hr>
		<h2>Background colors</h2>
		<ul>
			<?php foreach ($v['bgColors'] as $key => $value) { ?>
			<li>
				<span style="background-color: <?php echo $value; ?> ;"></span>
				<code><?php echo '.bg-'.$key; ?></code>
			</li>
			<?php } ?>
		</ul>

		<hr>

		<h2>Button colors</h2>
		<ul>
			<?php foreach ($v['btnColors'] as $key => $value) { ?>
			<li>
				<span style="background-color: <?php echo $value; ?> ;"></span>
				<code><?php echo '.btn-'.$key; ?></code>
				<code><?php echo '.hov-btn-'.$key; ?></code>
			</li>
			<?php } ?>
		</ul>

		<hr>

		<h2>Text colors</h2>
		<ul>
			<?php foreach ($v['txtColors'] as $key => $value) { ?>
			<li>
				<span style="background-color: <?php echo $value; ?> ;"></span>
				<code><?php echo '.txt-'.$key; ?></code>
				<code><?php echo '.hov-txt-'.$key; ?></code>
				
			</li>
			<?php } ?>
		</ul>

		<hr>

		<h2>Border colors</h2>
		<ul>
			<?php foreach ($v['bdrColors'] as $key => $value) { ?>
			<li>
				<span style="background-color: <?php echo $value; ?> ;"></span>
				<code><?php echo '.bdr-'.$key; ?></code>
				<code><?php echo '.hov-bdr-'.$key; ?></code>
			</li>
			<?php } ?>
		</ul>
	</div>
	<?php } ?>

</body>
</html>