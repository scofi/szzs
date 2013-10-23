<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="slideShow">
 <div class="slides">
  <!-- {foreach from=$index_ad name=ad_list item=ad_list} -->
  <div class="slide<!-- {if $smarty.foreach.ad_list.first} --> current<!-- {/if} -->" id="slide-{$smarty.foreach.ad_list.iteration}"> <a href="{$ad_list.ad_link}" target="_blank" ><img src="{$ad_list.ad_img}"/></a> </div>
  <!-- {/foreach} -->
 </div>
 <ul class="controlBase">
 </ul>
 <ul class="controls">
  <!-- {foreach from=$index_ad name=ad_list item=ad_list} -->
  <li<!-- {if $smarty.foreach.ad_list.first} --> class="active"<!-- {/if} -->><a href="#" rel="slide-{$smarty.foreach.ad_list.iteration}"></a></li>
  <!-- {/foreach} -->
 </ul>
</div>