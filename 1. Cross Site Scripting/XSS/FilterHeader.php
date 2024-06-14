<?php

$value = 'This_is_a_Top-Secret_cookie_and_should_never_be_exposed...';

setcookie("TestCookie", $value);
header('X-XSS-Protection: 0;');

function RemoveXSS($val) 
{
	$val = preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $val);
	$search = 'abcdefghijklmnopqrstuvwxyz';
	$search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$search .= '1234567890!@#$%^&*()';
	$search .= '~`";:?+/={}[]-_|\'\\';

	for ($i = 0; $i < strlen($search); $i++) 
	{
		$val =
		preg_replace('/(&#[x|X]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val);
		$val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/',
		$search[$i], $val);
	}
	
	$ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta',
	'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame',
	'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
	$ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate',
	'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate',
	'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload',
	'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick',
	'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable',
	'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag',
	'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop',
	'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin',
	'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete',
	'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 
	'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove',
	'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange',
	'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit',
	'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange',
	'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
	
	$ra = array_merge($ra1, $ra2);
	
	$found = true;
	
		while ($found == true) 
		{
		$val_before = $val;
			for ($i = 0; $i < sizeof($ra); $i++) 
			{
				$pattern = '/';
					for ($j = 0; $j < strlen($ra[$i]); $j++) 
					{
						if ($j > 0) 
						{
						$pattern .= '(';
						$pattern .= '(&#[x|X]0{0,8}([9][a][b]);?)?';
						$pattern .= '|(&#0{0,8}([9][10][13]);?)?';
						$pattern .= ')?';
						}
					$pattern .= $ra[$i][$j];
					}
				$pattern .= '/i';
				$replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2);
				$val = preg_replace($pattern, $replacement, $val);
				if ($val_before == $val) 
				{
				$found = false;
				}
			}
		}
return $val;
}

function Sanitize($val){
	$sanitized = "";
	foreach (str_split($val) as $char) {
		switch($char){
			case '&':
				$sanitized .= "&amp;";
				break;
			case '<':
				$sanitized .= "&lt;";
				break;
			case '>':
				$sanitized .= "&gt;";
				break;
			case '"':
				$sanitized .= "&quot;";
				break;
			case '\'':
				$sanitized .= "&#x27;";
				break;
			case '/':
				$sanitized .= "&#x2F;";
				break;
			case '(':
				$sanitized .= "&#x00028;";
				break;
			case ')':
				$sanitized .= "&#x00029;";
				break;
			case '{':
				$sanitized .= "&lcub;";
				break;
			case '}':
				$sanitized .= "&rcub;";
				break;
			default:
				$sanitized .= $char;
				break;
		}
	}
	return $sanitized;
}

?>