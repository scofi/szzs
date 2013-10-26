<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="incBox">
 <h3><div  class='my_mode_head'><a href="{$index.article_link}"><img src="images/news_title.gif"></a></div></h3>
 <ul class="recommendArticle">
  <!-- {foreach from=$recommend_article name=recommend_article item=article} -->
  <li<!-- {if $smarty.foreach.recommend_article.last} --> class="last"<!-- {/if} -->><a href="{$article.url}">{$article.title}</a></li>
  <!-- {/foreach} -->
 </ul>
</div>
