<?php
class Helper
{
    public static function cmsSelectBox($class, $name, $arrValue,$keySelect)
    {
        $xhtml = '
        <select class="' . $class . '" name="' . $name . '">';
        foreach ($arrValue as $key => $value) {
            $select = '';
            if($key == $keySelect){
                $select = 'selected';
            };
            $xhtml .= '
            <option value="'.$value.'" '.$select.'>'.$key.'</option>
        ';
        }
        
        $xhtml .= '</select>'; 
        return $xhtml;
    }
}
