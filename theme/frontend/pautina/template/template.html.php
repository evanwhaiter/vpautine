<?php
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author			Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: template.html.php 4256 2012-06-13 07:37:36Z Raymond_Benc $
 */
defined('PHPFOX') or exit('NO DICE!');
?>{if !PHPFOX_IS_AJAX_PAGE}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="{$sLocaleDirection}" lang="{$sLocaleCode}">
    <head>
        <title>{title}</title>	
        {header}
    </head>
    <body class="<?php if (isset($this->_aVars['sTagType'])) echo $this->_aVars['sTagType']; ?> <?php if (isset($this->_aVars['sFullControllerName'])) echo $this->_aVars['sFullControllerName']; ?>">
        {body}
        {block location='9'}
        {if Phpfox::isUser()}
        {module name='pautina.profile.usermenu'}
        {/if}
        <div id="header" class="pautina">
            <div class="header-wrapper">
                <div class="header-content">
                    <div class="holder">
                        {block location='10'}
                        <div id="header_holder" {if !Phpfox::isUser()} class="header_logo"{/if}>				
                             <div id="header_left">
                                {logo}
                            </div>
                            {if Phpfox::isUser() && !Phpfox::getUserBy('profile_page_id')}
                            <div id="holder_notify">
                                {notification}
                                
                                {module name='setbonus.panel'}
                                
                                <div class="clear"></div>
                            </div>
                            {/if}
                            <div id="header_right">
                                <div id="header_top">
                                    {if Phpfox::isUser() && !Phpfox::getUserBy('profile_page_id') && Phpfox::isModule('search')}
                                    <div id="header_search">
                                        <div id="header_menu_space">
                                            <div id="header_sub_menu_search">
                                                <form method="post" id='header_search_form' action="{url link='search'}">
                                                    <input type="text" name="q" value="{phrase var='core.search_dot'}" id="header_sub_menu_search_input" autocomplete="off" class="js_temp_friend_search_input" />
                                                    <div id="header_sub_menu_search_input"></div>
                                                    <a href="#" onclick='$("#header_search_form").submit();
                                                            return false;' id="header_search_button">{phrase var='core.search'}</a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {/if}

                                    <div id="header_menu_holder">
                                        {if Phpfox::isUser()}
                                        {menu_account}
                                        <div class="clear"></div>	
                                        {else}
                                        {module name='user.login-header'}
                                        {/if}
                                    </div>
                                </div>
                            </div>
                            {block location='6'}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="{if Phpfox::isUser()}main_core_body_holder{else}main_core_body_holder_guest{/if}">

            {block location='11'}
            <div id="main_content_holder">
                {/if}
                <div {holder_name}>
                    <div {is_page_view} class="holder">

                        {if defined('PHPFOX_IS_USER_PROFILE')}
                        {module name='profile.header'}
                        {/if}
                        <div id="content_holder">		

                            {block location='7'}				
                            {if !defined('PHPFOX_IS_USER_PROFILE') && !defined('PHPFOX_IS_PAGES_VIEW')}
                            {breadcrumb}
                            {block location='12'}
                            {/if}

                            {if !$bUseFullSite && (count($aBlocks1) || count($aAdBlocks1)) || (isset($aFilterMenus) && is_array($aFilterMenus) && count($aFilterMenus))}
                            <div id="left">
                                {block location='1'}
                            </div>
                            {/if}

                            <div id="main_content">
                                {if isset($aFilterMenus) && is_array($aFilterMenus) && count($aFilterMenus)}
                                <?php if (isset($this->_aVars['sFullControllerName'])): ?>
                                    <?php if ($this->_aVars['sFullControllerName'] != 'photo_index'): ?>
                                        {menu_sub}
                                    <?php endif; ?>
                                <?php endif; ?>
                                {/if}
                                {if !defined('PHPFOX_IS_USER_PROFILE') && !defined('PHPFOX_IS_PAGES_VIEW')}
                                {search}
                                {/if}
                                <div id="main_content_padding">
                                    {if defined('PHPFOX_IS_USER_PROFILE')}
                                    {block location='12'}
                                    {/if}
                                    {if defined('PHPFOX_IS_PAGES_VIEW')}
                                    {block location='12'}
                                    {module name='pages.header'}							
                                    {/if}							

                                    <div id="content_load_data">
                                        {if isset($bIsAjaxLoader) || defined('PHPFOX_IS_USER_PROFILE') || defined('PHPFOX_IS_PAGES_VIEW')}
                                        {search}
                                        {/if}								

                                        {if isset($aBreadCrumbTitle) && count($aBreadCrumbTitle)}
                                        <h1><a href="{$aBreadCrumbTitle[1]}">{$aBreadCrumbTitle[0]|clean|split:30}</a></h1>
                                        {/if}

                                        <div id="content" {content_class}>
                                            {error}
                                            {block location='2'}
                                            {content}
                                            {block location='4'}
                                        </div>

                                        {if !$bUseFullSite && (count($aBlocks3) || count($aAdBlocks3))}
                                        <div id="right">
                                            {module name='pages.header'}
                                            {block location='3'}
                                        </div>
                                        {/if}

                                        <div class="clear"></div>							
                                    </div>												
                                </div>				
                            </div>
                            <div class="clear"></div>			
                        </div>		
                        {block location='8'}
                    </div>							
                </div>			
                {if !PHPFOX_IS_AJAX_PAGE}
            </div>		
            <div id="main_footer_holder">
                <div class="holder">
                    <div id="footer">		
                        {menu_footer}					
                        <div id="copyright">
                            {copyright}
                        </div>
                        <div class="clear"></div>				
                        {block location='5'}
                    </div>				
                </div>			
            </div>		
            {footer}		
        </div>
    </body>
</html>
{/if}
