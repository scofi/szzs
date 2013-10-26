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
<div class='my_index_banner'>
	<a href="javascript:void(0)"><img src="images/zx_01.gif" target="_blank" border="0" height="23px" width="440px"></a>
	<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1101322632&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:1101322632:50" alt="点击这里给我发消息" title="点击这里给我发消息"></a>
	<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1101322632site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:1101322632:50" alt="点击这里给我发消息" title="点击这里给我发消息"></a>
</div>