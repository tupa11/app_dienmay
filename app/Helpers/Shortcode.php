<?php 
namespace App\Helpers;

class Shortcode
{
	protected $block = ['product', 'category', 'promotion'];

	public function content($full, $tag, $value, $str) {
		switch ($block) {
			case 'product':
				
				break;
			
			default:
				# code...
				break;
		}
	}

	public static function replace($str) {
		$re = '/\[([^\]]+)\](.*?)\[\/\1\]/uis';

		preg_match_all($re, $str, $matches);

		// 0 - full, 1 - tag, 2 - value
		if ($matches && isset($matches[0]) && isset($matches[1]) && isset($matches[2])) {
			foreach ($matches[1] as $k => $m) {
				if (in_array($m, $block)) {
					$str = $this->content($matches[0][$k], $matches[1][$k], $matches[2][$k], $str);
					// $str = str_replace($matches[0][$k], 'OK', $str);
				}
			}
		}
		echo $str;
	}
}