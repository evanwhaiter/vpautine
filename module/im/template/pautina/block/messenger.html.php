<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: messenger.html.php 4717 2012-09-21 11:39:07Z Raymond_Benc $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
<div id="js_footer_im_holder" class="im_holder js_footer_holder">
   <div  class="im_header" id="js_main_chat_header">
       <div class="close-chat"><a onclick="$Core.im.toggleMessengerLink(); return false;" href="#"><img src="/theme/frontend/pautina/style/default/image/layout/im_close.png" alt="" class="v_middle close_panel"></a></div>
          {phrase var='im.chat'}
   </div>
        <div style="overflow:auto; height:355px;" id="js_im_friend_list">
            {module name='im.list'}
        </div>
</div>