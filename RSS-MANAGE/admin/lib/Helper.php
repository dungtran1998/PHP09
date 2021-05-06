<?php
class Helper
{
	// Create Slect box
	public static function cmsSelectBox($class, $name, $arrValue, $keySelect)
	{
		$xhtml = '
        <select class="' . $class . '" name="' . $name . '">';
		foreach ($arrValue as $key => $value) {
			$select = '';
			if ($key == $keySelect) {
				$select = 'selected';
			};
			$xhtml .= '
            <option value="' . $value . '" ' . $select . '>' . $key . '</option>
        ';
		}

		$xhtml .= '</select>';
		return $xhtml;
	}
	// Show icon Status
	public static function showStatus($status, $id)
	{
		$icon = ($status == 1) ? "fa-check" : "fa-minus";
		$class = ($status == 1) ? "btn-success" : "btn-danger";
		$xhtml = '
        <a href="javascript:changeStatus(\'/PHP09/b11/admin/function-button/change-status.php?id=' . $id . '&status=' . $status . '\')" class="btn btn-sm ' . $class . ' waves-effect waves-light">
        <i class="fas ' . $icon . '"></i></a>
        ';
		return $xhtml;
	}


	public static function checkEmpty($value)
	{
		$flag = false;
		if (!isset($value) || trim($value) == "") {
			$flag = true;
		}
		return $flag;
	}

	// Kiem tra chieu dai du lieu
	public static function checkLength($value, $min, $max)
	{
		$flag 	= false;
		$length	= strlen($value);
		if ($length < $min || $length > $max) {
			$flag = true;
		}
		return $flag;
	}

	// Tao ra ten file
	public static function randomString($length = 5)
	{

		$arrCharacter = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
		$arrCharacter = implode(" ", $arrCharacter);
		$arrCharacter = str_shuffle($arrCharacter);

		$result		= substr($arrCharacter, 0, $length);
		return $result;
	}

	// Size
	public static function convertSize($size, $totalDigit = 2, $ditance = ' ')
	{
		$units	= array('B', 'KB', 'MB', 'GB', 'TB');

		$length	= count($units);
		for ($i = 0; $i < $length; $i++) {
			if ($size > 1024) {
				$size	= $size / 1024;
			} else {
				$unit	= $units[$i];
				break;
			}
		}

		$result = round($size, $totalDigit) . $ditance . $unit;
		return $result;
	}

	// Label
	public static function createLabel($class = 'font-weight-bold', $content)
	{
		$xhtml = '
		<label class="' . $class . '">' . $content . '</label>';
		return $xhtml;
	}

	// input
	public static function createInput($name, $type, $value, $class = 'form-control',$addition = null)
	{
		$xhtml = '
		<input class="' . $class . '" type="' . $type . '" name="' . $name . '" value="' . $value . '" '.$addition.'>';
		return $xhtml;
	}

	// CMS ROW
	public static function createRowForm($class, $lable, $input)
	{
		$xhtml = '
		<div class="' . $class . '">
		' . $lable . $input . '
		</div>';
		return $xhtml;
	}
}
