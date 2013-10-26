<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="incBox">
 <h3><div  class='my_mode_head'><a href="{$index.ask_question_link}"><img src="images/process_title.gif"></a></div></h3>
 <ul class="recommend_ask_question">
  <!-- {foreach from=$recommend_ask_question name=recommend_ask_question item=article} -->
  <li<!-- {if $smarty.foreach.recommend_ask_question.last} --> class="last"<!-- {/if} -->><a href="{$article.url}">{$article.title}</a></li>
  <!-- {/foreach} -->
 </ul>
</div>
