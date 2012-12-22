<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Feed
 * @version 		$Id: content.html.php 4545 2012-07-20 10:40:35Z Raymond_Benc $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>	
	{if !Phpfox::getService('profile')->timeline()}
	<div class="activity_feed_content">							
	{/if}
		<div class="activity_feed_content_text">
			{if !isset($aFeed.feed_mini) && !Phpfox::getService('profile')->timeline()}
			<div class="activity_feed_content_info">
				{$aFeed|user:'':'':50}
                {if !empty($aFeed.parent_module_id)}
                    <span class="feed-shared_block">{phrase var='feed.shared'}</span>
                {else}{if isset($aFeed.parent_user)}
                    <span class="parent_user_icon_block">&raquo;</span>
                    {$aFeed.parent_user|user:'parent_':'':50}
                {/if}
                <span class="feed_info_block">
                    {if !empty($aFeed.feed_info)}
                        <span class="feed_action_block">{$aFeed.feed_info}</span>
                    {/if}
                    {/if}
                    {if isset($aFeed.time_stamp)}
                        <span class="feed_entry_time_stamp">
                            <a href="{$aFeed.feed_link}" class="feed_permalink">{$aFeed.time_stamp|convert_time:'feed.feed_display_time_stamp'}</a>{if !empty($aFeed.app_link)} via {$aFeed.app_link}{/if}
                        </span>
                    {/if}
                </span>
			</div>
			{/if}			
			{if !empty($aFeed.feed_mini_content)}
			<div class="activity_feed_content_status">
				<div class="activity_feed_content_status_left">
					<img src="{$aFeed.feed_icon}" alt="" class="v_middle" /> {$aFeed.feed_mini_content} 
				</div>
				<div class="activity_feed_content_status_right">
					{template file='feed.block.link'}
				</div>
				<div class="clear"></div>
			</div>
			{/if}

			{if isset($aFeed.feed_status) && (!empty($aFeed.feed_status) || $aFeed.feed_status == '0')}
			<div class="activity_feed_content_status">
				{$aFeed.feed_status|feed_strip|shorten:200:'feed.view_more':true|split:55}				
			</div>
			{/if}
			
			<div class="activity_feed_content_link">
				
				{if $aFeed.type_id == 'friend' && isset($aFeed.more_feed_rows) && is_array($aFeed.more_feed_rows) && count($aFeed.more_feed_rows)}
					{foreach from=$aFeed.more_feed_rows item=aFriends}
						{$aFriends.feed_image}
					{/foreach}
					{$aFeed.feed_image}
				{else}
				{if !empty($aFeed.feed_image)}
				<div class="activity_feed_content_image"{if isset($aFeed.feed_custom_width)} style="width:{$aFeed.feed_custom_width};"{/if}>
					{if is_array($aFeed.feed_image)}
						<ul class="activity_feed_multiple_image">
							{foreach from=$aFeed.feed_image item=sFeedImage}
								<li>{$sFeedImage}</li>
							{/foreach}
						</ul>
						<div class="clear"></div>
					{else}
						<a href="{$aFeed.feed_link}"{if !isset($aFeed.no_target_blank)} target="_blank"{/if} class="{if isset($aFeed.custom_css)} {$aFeed.custom_css} {/if}{if !empty($aFeed.feed_image_onclick)}{if !isset($aFeed.feed_image_onclick_no_image)}play_link {/if} no_ajax_link{/if}"{if !empty($aFeed.feed_image_onclick)} onclick="{$aFeed.feed_image_onclick}"{/if}{if !empty($aFeed.custom_rel)} rel="{$aFeed.custom_rel}"{/if}{if isset($aFeed.custom_js)} {$aFeed.custom_js} {/if}>{if !empty($aFeed.feed_image_onclick)}{if !isset($aFeed.feed_image_onclick_no_image)}<span class="play_link_img">{phrase var='feed.play'}</span>{/if}{/if}{$aFeed.feed_image}</a>						
					{/if}
				</div>
				{/if}
				<div class="{if (!empty($aFeed.feed_content) || !empty($aFeed.feed_custom_html)) && empty($aFeed.feed_image)} activity_feed_content_no_image{/if}{if !empty($aFeed.feed_image)} activity_feed_content_float{/if}"{if isset($aFeed.feed_custom_width)} style="margin-left:{$aFeed.feed_custom_width};"{/if}>
					{if !empty($aFeed.feed_title)}
					{if isset($aFeed.feed_title_sub)}
					<span class="user_profile_link_span" id="js_user_name_link_{$aFeed.feed_title_sub|clean}">
					{/if}
					<a href="{$aFeed.feed_link}" class="activity_feed_content_link_title"{if isset($aFeed.feed_title_extra_link)} target="_blank"{/if}>{$aFeed.feed_title|clean|split:30}</a>
					{if isset($aFeed.feed_title_sub)}
					</span>
					{/if}
					{if !empty($aFeed.feed_title_extra)}
					<div class="activity_feed_content_link_title_link">
						<a href="{$aFeed.feed_title_extra_link}" target="_blank">{$aFeed.feed_title_extra|clean}</a>
					</div>
					{/if}
					{/if}			
					{if !empty($aFeed.feed_content)}
					<div class="activity_feed_content_display">
						{$aFeed.feed_content|feed_strip|shorten:200:'...'|split:55}				
					</div>
					{/if}
					{if !empty($aFeed.feed_custom_html)}
					<div class="activity_feed_content_display_custom">
						{$aFeed.feed_custom_html}
					</div>
					{/if}
					
					{if !empty($aFeed.parent_module_id)}
					{module name='feed.mini' parent_feed_id=$aFeed.parent_feed_id parent_module_id=$aFeed.parent_module_id}
					{/if}
					
				</div>	
				{if !empty($aFeed.feed_image)}
				<div class="clear"></div>
				{/if}		
				{/if}
			</div>
		</div><!-- // .activity_feed_content_text -->

        {if isset($aFeed.feed_view_comment)}
            {module name='feed.comment'}
		{else}
            {if empty($aFeed.feed_info)}
                {template file='feed.block.comment'}
            {elseif $aFeed.feed_info != 'обновляет  информацию в профиле.' &&
                    $aFeed.feed_info != 'обновляет  фотографию в профиле.' &&
                    $aFeed.feed_info != 'теперь дружит с'}
                {template file='feed.block.comment'}
            {/if}
		{/if}

		{if $aFeed.type_id != 'friend'}
		{if isset($aFeed.more_feed_rows) && is_array($aFeed.more_feed_rows) && count($aFeed.more_feed_rows)}
		{if $iTotalExtraFeedsToShow = count($aFeed.more_feed_rows)}{/if}
		<a href="#" class="activity_feed_content_view_more" onclick="$(this).parents('.js_feed_view_more_entry_holder:first').find('.js_feed_view_more_entry').show(); $(this).remove(); return false;">{phrase var='feed.see_total_more_posts_from_full_name' total=$iTotalExtraFeedsToShow full_name=$aFeed.full_name|first_name|shorten:40:'...'}</a>			
		{/if}			
		{/if}
	{if !Phpfox::getService('profile')->timeline()}
	</div><!-- // .activity_feed_content -->
	{/if}