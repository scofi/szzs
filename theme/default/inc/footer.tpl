<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="footer">
 <div class="wrap">
  <div class="footNav"><!-- {foreach from=$nav_bottom_list name=nav_bottom_list item=nav_bottom} --><a href="{$nav_bottom.url}">{$nav_bottom.nav_name}</a><!-- {if !$smarty.foreach.nav_bottom_list.last} --><i>|</i><!-- {/if} --><!-- {/foreach} --></div>
  <div class="copyRight">{$lang.copyright} {$lang.powered_by} <!-- {if $site.icp} -->{$site.icp}<!-- {/if} --></div>
  </div>
</div>
<!-- {if $site.code} -->
<div style="display:none">{$site.code}</div>
<!-- {/if} -->