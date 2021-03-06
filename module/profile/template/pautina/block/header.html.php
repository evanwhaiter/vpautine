<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Profile
 * @version 		$Id: header.html.php 4495 2012-07-10 15:33:20Z Raymond_Benc $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
<?php $headerService = Phpfox::getService('pautina.header.header'); ?>
<?php if ($headerService->showMiniHeader($this->_aVars['sFullControllerName'])): ?>
    <div id="profile_small_header_block">
        <div>
            <h1>
                <a href="{url link=$aUser.user_name}" title="{$aUser.full_name|clean}">{$aUser.full_name|clean|split:30|shorten:50:'...'}</a>
                {foreach from=$aBreadCrumbs key=sLink item=sCrumb name=link}{if $phpfox.iteration.link == 1}
                <span class="profile_breadcrumb">-</span>
                <a href="{$sLink}">{$sCrumb}</a>{/if}{/foreach}
            </h1>
        </div>
        {module name='pautina.profile.image' image_size=true}
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
<?php else: ?>
<div id="profile_header_block">
    <div id="profile_header_logo">
       <div id="section_menu">
           {if defined('PHPFOX_IS_USER_PROFILE_INDEX') || defined('PHPFOX_PROFILE_PRIVACY') || Phpfox::getLib('module')->getFullControllerName() == 'profile.info'}
           <ul>
               {if Phpfox::getUserId() == $aUser.user_id}
               {if Phpfox::getUserParam('profile.can_change_cover_photo')}
               <li><a id="change_cover_2" href="#" onclick="$('#cover_section_menu_drop').toggle(); return false;">{if empty($aUser.cover_photo)}{phrase var='user.add_a_cover'}{else}{phrase var='user.change_cover'}{/if}</a>
                   <div id="cover_section_menu_drop">
                       <ul>
                           <li><a href="{url link='profile.photo'}">{phrase var='user.choose_from_photos'}</a></li>
                           <li><a href="#" onclick="$('#cover_section_menu_drop').hide(); $Core.box('profile.logo', 500); return false;">{phrase var='user.upload_photo'}</a></li>
                           {if !empty($aUser.cover_photo)}
                           <li><a href="{url link='profile' coverupdate='1'}">{phrase var='user.reposition'}</a></li>
                           <li><a href="#" onclick="$('#cover_section_menu_drop').hide(); $.ajaxCall('user.removeLogo'); return false;">{phrase var='user.remove'}</a></li>
                           {/if}
                       </ul>
                   </div>
               </li>
               {/if}
             {/if}
            </ul>
           {/if}
       </div>
        {module name='profile.logo'}
   </div>
    <div id="profile_header_image_title">
        {module name='pautina.profile.image'}

        <div{if Phpfox::getService('profile')->timeline()} class="profile_timeline_header_holder"{/if}>
            <div class="profile_header{if Phpfox::getService('profile')->timeline()} profile_timeline_header{/if}{if empty($aUser.cover_photo)} no_cover_photo{/if}">

                {if Phpfox::getService('profile')->timeline()}
                {module name='pautina.profile.image'}
                {/if}

                <div class="profile_header_inner_text profile_header_inner{if Phpfox::getService('profile')->timeline()} profile_header_timeline{/if}">
                    {if Phpfox::getUserBy('profile_page_id') <= 0}
                    <div id="section_menu_2">
                        {elseif Phpfox::getLib('module')->getFullControllerName() == 'friend.profile'}
                        {if Phpfox::getUserId() == $aUser.user_id}
                        <ul>
                            <li><a href="{url link='friend'}">{phrase var='profile.edit_friends'}</a></li>
                        </ul>
                        {/if}
                        {else}
        <!--				<ul>
                            {foreach from=$aSubMenus key=iKey name=submenu item=aSubMenu}
                            <li><a href="{url link=$aSubMenu.url)}" class="ajax_link">{if substr($aSubMenu.url, -4) == '.add' || substr($aSubMenu.url, -7) == '.upload' || substr($aSubMenu.url, -8) == '.compose'}{img theme='layout/section_menu_add.png' class='v_middle'}{/if}{phrase var=$aSubMenu.module'.'$aSubMenu.var_name}</a></li>
                            {/foreach}
                        </ul>	-->
                    </div>

                    <div id="section_menu_drop">
                        <ul>
                            {if Phpfox::getUserParam('user.can_block_other_members') && Phpfox::getUserGroupParam('' . $aUser.user_group_id . '', 'user.can_be_blocked_by_others')}
                            <li><a href="#?call=user.block&amp;height=120&amp;width=400&amp;user_id={$aUser.user_id}" class="inlinePopup js_block_this_user" title="{if $bIsBlocked}{phrase var='profile.unblock_this_user'}{else}{phrase var='profile.block_this_user'}{/if}">{if $bIsBlocked}{phrase var='profile.unblock_this_user'}{else}{phrase var='profile.block_this_user'}{/if}</a></li>
                            {/if}
                            {if isset($aUser.is_online) && $aUser.is_online && Phpfox::isModule('im') && Phpfox::getParam('im.enable_im_in_footer_bar') && $aUser.is_friend == 1}
                            <li><a href="#" onclick="$.ajaxCall('im.chat', 'user_id={$aUser.user_id}'); return false;">{phrase var='profile.instant_chat'}</a></li>
                            {/if}
                            {if Phpfox::getUserParam('user.can_feature')}
                            <li {if !$aUser.is_featured} style="display:none;" {/if} class="user_unfeature_member"><a href="#" title="{phrase var='profile.un_feature_this_member'}" onclick="$(this).parent().hide(); $(this).parents('#profile_nav_list:first').find('.user_feature_member:first').show(); $.ajaxCall('user.feature', 'user_id={$aUser.user_id}&amp;feature=0&amp;type=1'); return false;">{phrase var='profile.unfeature'}</a></li>
                            <li {if $aUser.is_featured} style="display:none;" {/if} class="user_feature_member"><a href="#" title="{phrase var='profile.feature_this_member'}" onclick="$(this).parent().hide(); $(this).parents('#profile_nav_list:first').find('.user_unfeature_member:first').show(); $.ajaxCall('user.feature', 'user_id={$aUser.user_id}&amp;feature=1&amp;type=1'); return false;">{phrase var='profile.feature'}</a></li>
                            {/if}
						{if Phpfox::getUserParam('core.can_gift_points')}
						<li>
							<a href="#?call=core.showGiftPoints&amp;height=120&amp;width=400&amp;user_id={$aUser.user_id}" class="inlinePopup js_gift_points" title="{phrase var='core.gift_points'}">
								{phrase var='core.gift_points'}
							</a>
						</li>
						{/if}
                            {plugin call='profile.template_block_menu'}
                        </ul>
                    </div>
                    {/if}
                    {if $aUser.is_online || $aUser.is_friend === 2 || $aUser.is_friend === 3}
                        <span class="profile_online_status">
                            {if $aUser.is_friend === 2}
                            <span class="js_profile_online_friend_request">{phrase var='profile.pending_friend_confirmation'}{if $aUser.is_online} &middot; {/if}</span>
                            {elseif $aUser.is_friend === 3}
                            <span class="js_profile_online_friend_request">{phrase var='profile.pending_friend_request'}{if $aUser.is_online} &middot; {/if}</span>
                            {/if}
                            {if $aUser.is_online}
                            ({phrase var='profile.online'})
                            {/if}
                        </span>
                    {/if}

                    <h1 style="width:400px;"><a href="{url link=$aUser.user_name}" title="{$aUser.full_name|clean}">{$aUser.full_name|clean|split:30|shorten:50:'...'}</a>{foreach from=$aBreadCrumbs key=sLink item=sCrumb name=link}{if $phpfox.iteration.link == 1}<span class="profile_breadcrumb">&#187;</span><a href="{$sLink}">{$sCrumb}</a>{/if}{/foreach}</h1>

                    <div class="profile_info">
                        <span class="user-city">
                             {if Phpfox::getService('user.privacy')->hasAccess('' . $aUser.user_id . '', 'profile.view_location') && (!empty($aUser.city_location) || !empty($aUser.country_child_id) || !empty($aUser.location))}
                                {phrase var='profile.lives_in'} {if !empty($aUser.city_location)}{$aUser.city_location}{/if}
                                {if !empty($aUser.city_location) && (!empty($aUser.country_child_id) || !empty($aUser.location))}{/if}<br />
                                {if !empty($aUser.country_child_id)}{$aUser.country_child_id|location_child}{/if} {if !empty($aUser.location)}{$aUser.location}{/if}
                            {/if}
                        </span>
                        <span class="user-age">
                            {if is_array($aUser.birthdate_display) && count($aUser.birthdate_display)}
                            {foreach from=$aUser.birthdate_display key=sAgeType item=sBirthDisplay}
                                {if $aUser.dob_setting == '2'}
                                {phrase var='profile.age_years_old' age=$sBirthDisplay}
                                {else}
                                {phrase var='profile.born_on_birthday' birthday=$sBirthDisplay}
                                {/if}
                            {/foreach}
                            {/if}
                        </span>
                        <span class="user-relationships">{if Phpfox::getParam('user.enable_relationship_status') && $sRelationship != ''}{$sRelationship} {/if}</span>
                    </div>
                </div>
                <div class="profile-detail-link"><a href="{url link=$aUser.user_name}info">{phrase var='profile.show_detail_info'}</a></div>
            </div>
            {if Phpfox::getService('profile')->timeline()}
            <div class="timeline_main_menu">
                <ul>
                    {foreach from=$aProfileLinks item=aProfileLink}
                        <li class="{if isset($aProfileLink.is_selected)} active{/if}">
                            <a href="{url link=$aProfileLink.url}" class="ajax_link">{$aProfileLink.phrase}{if isset($aProfileLink.total)}<span>({$aProfileLink.total|number_format})</span>{/if}</a>
                            {if isset($aProfileLink.sub_menu) && is_array($aProfileLink.sub_menu) && count($aProfileLink.sub_menu)}
                            {*
                            <ul>
                            {foreach from=$aProfileLink.sub_menu item=aProfileLinkSub}
                                <li class="{if isset($aProfileLinkSub.is_selected)} active{/if}"><a href="{url link=$aProfileLinkSub.url}">{$aProfileLinkSub.phrase}</a></li>
                            {/foreach}
                            </ul>
                            *}
                            {/if}
                        </li>
                    {/foreach}
                </ul>
                <div class="clear"></div>
            </div>
            {/if}
        </div>
    </div>
</div>
<div class="clear"></div>
<?php endif; ?>
{block location='12'}