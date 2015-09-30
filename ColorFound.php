<?php
/**
 * ColorFound : Find the basic color name from a HEX code
 *
 * @author  Tuan Nguyen <nganhtuan63@gmail.com>
 * @link    https://github.com/nganhtuan63/Color-Found
 * @since   1.0.0
 */

/**
 * Class Color Found
 */
class ColorFound {

	public $baseColors = [
		'ee0202' => 'red',
		'fbef00' => 'yellow',
		'1e15f6' => 'blue',
		'f47200' => 'orange',
		'2e9102' => 'green',
		'9e0bf6' => 'purple',
		'ffffff' => 'white',
		'000000' => 'black',
		'd20797' => 'pink',
		'ff00f6' => 'pink',
		'9a0005' => 'brown'
	];

	function __construct($baseColors = false) {
		if ($baseColors && is_array($baseColors)) {
			$this->baseColors = $baseColors;
		}
	}

	/**
	 * Convert A HEX Code to an array of RGB values
	 * @param  string $color Hex Code of Color with or without "#"
	 * @return array|boolean Array of RGB values
	 */
	public function hex2RGB($color) {
		if ($color != "") {
			$color = ltrim($color, '#');
			list($r,$g,$b) = array_map('hexdec',str_split($color,2));
	        return array(
	        	'r' => $r,
	        	'g' => $g,
	        	'b'=>$b
	        );
		}
		return false;
	}

	/**
	 * Calculate distance between the 2 colors
	 *
	 * @param  array $color1 RGB values of Color 1
	 * @param  array $color RGB values of Color 2
	 * @return int Distance of the 2 RGB values
	 */
	public function dist2Colors($color1, $color2) {
		if (is_array($color1) && is_array($color2)) {
			$delta_r = $color1['r'] - $color2['r'];
  			$delta_g = $color1['g'] - $color2['g'];
  			$delta_b = $color1['b'] - $color2['b'];
  			return $delta_r * $delta_r + $delta_g * $delta_g + $delta_b * $delta_b;
		} else {
			return false;
		}

	}

	/**
	 * Get the color name from the pre-defined base colors
	 *
	 * @param  string $color1 Hex Code of Color 1
	 * @param  array $baseColors Base Colors to check from
	 * @return array|string Color name or False
	 */
	public function getName($color, $baseColors = false) {
		$dist_arr = [];
		$nearest = false;
		if ($baseColors && is_array($baseColors)) {
			$this->baseColors = $baseColors;
		}
		foreach ($this->baseColors as $k => $v) {
			$dist = $this->dist2Colors($this->hex2RGB($color), $this->hex2RGB($k));
			if ($nearest === false) {
				$nearest = $dist;
			} else {
				if ($nearest > $dist) {
					$nearest = $dist;
				}
			}
			$dist_arr[$dist] = $v;
		}
		if (isset($dist_arr[$nearest])) {
			return $dist_arr[$nearest];
		} else {
			return false;
		}
	}
}
