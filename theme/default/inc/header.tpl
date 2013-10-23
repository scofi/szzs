<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="top">
 <div style="float:left;padding-left:200px;color:#333333">欢迎光临杭州尚宅装饰官方网站！公司联系电话:12345678,传真:0513-12323444,地址：杭州</div>
 <div class="wrap"> <a href="javascript:AddFavorite('{$root_url}', '{$site.site_name}')">{$lang.add_favorite}</a><!-- {foreach from=$nav_top_list name=nav_top_list item=nav_top} --> |<a style='cursor:pointer' onclick="SetHome(this,window.location)">设为首页</a>| <a href="{$nav_top.url}">{$nav_top.nav_name}</a><!-- {/foreach} --> </div>
</div>
<div id="header">
 <div class="wrap">
  <div class="logo">
  		<div><a href="{$root_url}"><img src="../images/{$site.site_logo}" alt="{$site.site_name}" title="{$site.site_name}" /></a>
  			<div style="float:right;padding-top:22px"><img src='images/topright.gif'</div>
  		</div>
  </div>
 
 </div>
</div>
<div id="mainNav">
 <ul class="wrap">
  <li class="first"><a href="{$root_url}"<!-- {if $index} --> class="cur"<!-- {/if} -->>{$lang.home}</a></li>
  <!-- {foreach from=$nav_list name=nav item=nav_list} -->
  <li<!-- {if $smarty.foreach.nav.iteration eq 7} --> class="last"<!-- {/if} -->><a href="{$nav_list.url}"<!-- {if $nav_list.cur} --> class="cur"<!-- {/if} -->>{$nav_list.nav_name}</a>
   <dl>
    <!-- {foreach from=$nav_list.child item=child} -->
    <dd><a href="{$child.url}">{$child.nav_name}</a></dd>
    <!-- {/foreach} -->
   </dl>
  </li>
  <!-- {/foreach} -->
  <div class="clear"></div>
 </ul>
</div>
