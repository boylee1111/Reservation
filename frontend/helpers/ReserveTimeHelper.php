<?php

namespace frontend\helpers;

use yii\helpers\ArrayHelper;

class ReserveTimeHelper
{
	public static function timeSectionArray()
	{
		$sections = array();

		for ($i = 0; $i < 48; ++$i) {
			$temp = 100;

			$leftHour = floor($i / 2) + $temp;
			$leftMin = $i % 2 * 30 + $temp;
			$rightHour = floor(($i + 1) / 2) + $temp;
			$rightMin = ($i + 1) % 2 * 30 + $temp;

			$sections[$i] = substr($leftHour, 1, 2).':'.substr($leftMin, 1, 2).' - '.substr($rightHour, 1, 2).':'.substr($rightMin, 1, 2);
		}
		return $sections;
	}
}