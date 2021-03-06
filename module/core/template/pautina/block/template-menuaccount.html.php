<?php
/**
 * [PHPFOX_HEADER]
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: template-menuaccount.html.php 4371 2012-06-27 07:43:48Z Raymond_Benc $
 */

defined('PHPFOX') or exit('NO DICE!');

?>
{if Phpfox::getUserBy('profile_page_id') > 0}
<ul>
    <li>
        <a href="#" class="has_drop_down">{phrase var='pages.account'}</a>
        <ul>
            <li class="header_menu_user_link">
                <div id="header_menu_user_image">
                    {img user=$aGlobalUser suffix='_50_square' max_width=50 max_height=50}
                </div>
                <div id="header_menu_user_profile">
                    {$aGlobalUser|user|split:10|shorten:20:'...'}
                </div>
            </li>
            <li class="header_menu_user_link_page">
                <a href="#" onclick="$.ajaxCall('pages.logBackIn'); return false;">
                    <div class="page_profile_image">
                        {img user=$aGlobalProfilePageLogin suffix='_50_square' max_width=32 max_height=32 no_link=true}
                    </div>
                    <div class="page_profile_user">
                        {phrase var='core.log_back_in_as_global_full_name' global_full_name=$aGlobalProfilePageLogin.full_name|clean}
                    </div>
                </a>
            </li>
            <li><a href="{url link='pages.add' id=$iGlobalProfilePageId}">{phrase var='core.edit_page'}</a></li>
        </ul>
    </li>
</ul>
{else}
<?php
$profileUrl = Phpfox::getParam('core.url_user');
$profileUrl .= Phpfox::getUserBy('user_image');
$profileUrl = str_replace("%s","_50_square",$profileUrl);
$profileName = Phpfox::getUserBy('user_name');
?>
<ul>
    <li>
        <a class="right-menu-profile" href="<?php echo Phpfox::getLib('url')->makeUrl('profile', Phpfox::getUserBy('user_name')); ?>">
            <span class="right-menu-profile">
                <img width="30" src="<?php  echo $profileUrl; ?>" alt="" />
            </span>
        </a>
    </li>
    {foreach from=$aRightMenus key=iKey item=aMenu}
    <li>
        <a href="{url link=$aMenu.url}" class="{if isset($aMenu.children) && count($aMenu.children) && is_array($aMenu.children)} has_drop_down no_ajax_link{/if} {if Phpfox::isUser() && $aMenu.url == 'user.setting'}menu-settings{/if}">
            {if Phpfox::isUser() && $aMenu.url == 'profile.my'}
                {elseif Phpfox::isUser() && $aMenu.url == 'user.setting'}

            <span class="center-menu-profile profile-link"><div class="center-menu-profile-bg"></div></span>
                {else}
            {phrase var=$aMenu.module'.'$aMenu.var_name}{if isset($aMenu.suffix)}{$aMenu.suffix}{/if}
                {/if}
        </a>
        {if isset($aMenu.children) && count($aMenu.children) && is_array($aMenu.children)}
        <ul>
	        <div class="js_box_close" style="display: block;"><a href="#"></a></div>
            {if Phpfox::isUser() && $aMenu.url == 'user.setting'}
            {if Phpfox::isModule('pages') && Phpfox::getUserParam('pages.can_add_new_pages')}
            <li><a href="#" onclick="$Core.box('pages.login', 400); return false;">{phrase var='core.login_as_page'}</a></li>
            {/if}
            {/if}
            {foreach from=$aMenu.children item=aChild name=child_menu}
            <li{if $phpfox.iteration.child_menu == 1} class="first"{/if}><a {if $aChild.url == 'pages.login'}id="js_login_as_page"{/if} href="{url link=$aChild.url}"{if $aChild.url == 'profile.designer' || $aChild.url == 'pages.login'} class="no_ajax_link"{/if}>{phrase var=$aChild.module'.'$aChild.var_name}</a></li>
    {/foreach}
</ul>
{/if}
</li>
{/foreach}
{if Phpfox::isUser()}
<li>
    <a href="{url link='user.logout'}" class="menu-exit"><span class="exit-menu-profile profile-link"><div class="exit-menu-profile-bg"></div></span></a>
</li>
{/if}
{unset var=$aRightMenus var1=$aMenu}
</ul>
{/if}
