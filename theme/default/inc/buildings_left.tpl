<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="treeBox">
	<div id="case_left">
		<!--该案例信息资料 开始-->
	    <div id="left_1">
	           <h2>该案例的信息资料</h2>
	           		<div class="bg">
	                 	<dl>
	                 		<dd>楼盘：<strong class="orange">{$buildings.houses}</strong></dd>
	                        <dd>房屋类型：<span class="gray">{$buildings.house_type}</span></dd>
	                        <dd>户型结构：<span class="gray">{$buildings.house_structure}</span></dd>
	                        <dd>房屋面积：<span class="gray">{$buildings.house_proportion}</span></dd>
	                        <dd>设计风格：<span class="gray">{$buildings.design_style}</span></dd>
	                        <dd>空间场所：<span class="gray">{$buildings.house_place}</span></dd>
	                        <dd>设计风格 / 色调：<span class="gray">{$buildings.house_hue}</span></dd>
	                            
	                    </dl>
	                    <dl class="ilove_sjs">
	   						<dt><a href="team.php?id={$designer.id}"><img src="{$designer.image}" alt=""></a></dt>
	   						<dd>
	   							<div>设计师：<strong><a href="{$designer.url}" title="">{$designer.name}</a></strong></div>
	 							<div>职务：<span class="gray">{$designer.position}</span></div>
								<div><a href="Mflf.aspx" class="ilove_sub"></a></div>
							</dd>
						</dl>
	 				    <dl>
						     <dd> 在线咨询：
	                              <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin={$webhome.qq.0}&amp;site=qq&amp;menu=yes" style="margin-right: 5px;">
	                                    <img src="http://wpa.qq.com/pa?p=2:{$webhome.qq.0}:46" alt="点击在线咨询" title="点击在线咨询" style="vertical-align: 0px;" border="0"></a>
	                                
	                              <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin={$webhome.qq.1}&amp;site=qq&amp;menu=yes" style="margin-right: 5px;">
	                                    <img src="http://wpa.qq.com/pa?p=2:{$webhome.qq.1}:46" alt="点击在线咨询" title="点击在线咨询" style="vertical-align: 0px;" border="0"></a>
	                          </dd>
	                          <dd>联系电话：<span class="gray">{$webhome.tel}</span></dd>
	                          <dd>联系传真：<span class="gray">{$webhome.fax}</span></dd>
	                          <dd>联系地址：<span class="gray">{$webhome.site_address}</span></dd>
	                    </dl>
	                    <!-- JiaThis Button BEGIN -->
	     <div id="ckepop">
	              <span class="fr"><a href="#" onclick="AddFavorite('http://hzszzs.cn','尚宅装饰')" class="shouchang">+ 加入收藏</a></span>
	              </div>
	              <p class="b_bg">
	              </p>
	    	</div>
	    </div>
	    <a href="order.php?" title="免费咨询装修报价" class="free_phone_zx"></a>
	    <div class="clear">
	    </div>
	    <!--土拨鼠为您提供相关分类 -->
	    <!-- 看过该案例的用户还看过 开始 -->
	   	<div id="left_2" style="display: none">
	   		<div class="left_2_title">
	                       	 看过该案例的用户还看过
	    	</div>
	                    
		</div>
	    <!-- 看过该案例的用户还看过 结束 -->
	<!--该案例信息资料 结束-->
	</div>
</div>