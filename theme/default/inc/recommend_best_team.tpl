<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="incBox">
 <h3><div  class='my_mode_head'><a href="{$index.bestteam_link}"><img src="images/works_titleJytd.gif"></a></div></h3>
 <ul class="recommendBestteam">
  <!-- {foreach from=$recommend_bestteam name=recommend_bestteam item=product} -->
  <li<!-- {if $smarty.foreach.recommend_bestteam.iteration % 4 eq 0} --> class="clearBorder"<!-- {/if} -->>
  <p class="img"><a href="{$product.url}"><img src="{$product.thumb}"  width="203" height="145" /></a></p>
  <p class="name"><a href="{$product.url}">{$product.name}</a></p>
  </li>
  <!-- {/foreach} -->
  <div class="clear"></div>
 </ul>
</div>
