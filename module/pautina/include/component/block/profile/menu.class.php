<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

require_once(PHPFOX_DIR_MODULE . 'profile' . PHPFOX_DS . 'include' . PHPFOX_DS . 'component' . PHPFOX_DS . 'block' . PHPFOX_DS . 'pic.class.php');

class Pautina_Component_Block_Profile_Menu extends Profile_Component_Block_Pic
{
    public function process() {
        parent::process();
    }
}

?>