<?php 
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Utility\Inflector;

/**
 *    Farbtastic helper
 *    @author     Curtis Gibby
 *    @desc       This helper does everything you need related to Farbtastic within CakePHP
 *
 *                Like Farbtastic, requires jQuery to function properly.
 *                jQuery: http://jquery.com
 *
 *                Also requires a Color Wheel icon (color.png in this example)
 *                like the one from Mark James' Silk set
 *                http://www.iconfinder.net/icondetails/5185/16/
 *
 *    @version    5 March 2010
 */

class FarbtasticHelper extends Helper  { 
    var $helpers = array('Javascript', 'Html');  

    /** 
    *    Add the JS/CSS to your header  
    *     
    */ 

    function includeHead() { 
        $str = ''; 
        $str .= $this->Html->script('farbtastic'); 
        $str .= $this->Html->css('farbtastic'); 
        return $str; 
    }

    /** 
    *    Generate a form input and related div and icon 
    *     
    *    may need to customize $icon_file (relative to webroot) 
    * 
    *    Adapted from April Hodge Silver's "Simple Colorpicker" input function 
    *    http://bakery.cakephp.org/articles/view/simple-colorpicker 
    */ 

    function input($name,$color_value='#000000',$label='') { 
        $icon_file = '/img/color.png'; // update to wherever your icon is. 
        list($model, $fieldname) = split('\.', $name); 

        if (empty($label)) { 
            $label = Inflector::Humanize($fieldname); 
        } 

      $str = ''; 
      $str .= '<div class="input text colorpicker">'; 
      $str .= '<label for="'.$model.Inflector::Camelize($fieldname).'">'.$label.'</label>';      $str .= '<input name="'.$fieldname.'" type="text" maxlength="7" value="'.$color_value.'" id="'.$model.Inflector::Camelize($fieldname).'" class="farbtastic-input" />'; 

      $str .= '<img id="farbtastic-picker-icon-'.Inflector::Camelize($fieldname).'" src="'.$icon_file.'" alt="Color Picker" title="Color Picker" class="farbtastic-picker-icon">'; 

      $str .= '<div style="display:none;" class="farbtastic-picker" id="farbtastic-picker-'.Inflector::Camelize($fieldname).'"></div>'; 

      $str .= '</div>'; 
      return $str; 
    } 

    /** 
    *    Add the jQuery magic to the $(document).ready function 
    *    Farbtastic-ize the input, make the button show/hide the color picker div 
    */
function readyJS($name) { 
        list($model,$fieldname) = split('\.',$name); 
        $str = ''; 
        $str .= ' $("#farbtastic-picker-'.Inflector::Camelize($fieldname).'").farbtastic("#'.$model.Inflector::Camelize($fieldname).'"); '; 
        $str .= ' $("#farbtastic-picker-icon-'.Inflector::Camelize($fieldname).'").click( function() { $("#farbtastic-picker-'.Inflector::Camelize($fieldname).'").toggle("slow"); }); '; 
       return $str; 
    } 
}?>
