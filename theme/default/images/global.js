/**
 +----------------------------------------------------------
 * 下拉菜单
 +----------------------------------------------------------
 */
$(document).ready(function() {
    $('#mainNav li').hover(function() {
        $(this).children('dl').show()
    },
    function() {
        $(this).children('dl').hide()
    })
});

/**
 +----------------------------------------------------------
 * 收藏本站
 +----------------------------------------------------------
 */
function AddFavorite(sURL, sTitle) {
    try {
        window.external.addFavorite(sURL, sTitle)
    } catch(e) {
        try {
            window.sidebar.addPanel(sTitle, sURL, "")
        } catch(e) {
            alert("加入收藏失败，请使用Ctrl+D进行添加")
        }
    }
}

/**
 * 设为首页
 */
function SetHome(obj,vrl){
        try{
                obj.style.behavior='url(#default#homepage)';obj.setHomePage(vrl);
        }
        catch(e){
                if(window.netscape) {
                        try {
                                netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
                        }
                        catch (e) {
                                alert("此操作被浏览器拒绝！\n请在浏览器地址栏输入“about:config”并回车\n然后将 [signed.applets.codebase_principal_support]的值设置为'true',双击即可。");
                        }
                        var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
                        prefs.setCharPref('browser.startup.homepage',vrl);
                 }
        }
}
/**
 +----------------------------------------------------------
 * 在线客服
 +----------------------------------------------------------
 */
$(document).ready(function(e) {
    $("#onlineService").css("right", "0px");
    var button_toggle = true;
    $(".service").live("mouseover",
    function() {
        button_toggle = false;
        $("#pop").show();
    }).live("mouseout",
    function() {
        button_toggle = true;
        hideRightTip()
    });
    $("#pop").live("mouseover",
    function() {
        button_toggle = false;
        $(this).show()
    }).live("mouseout",
    function() {
        button_toggle = true;
        hideRightTip()
    });
    function hideRightTip() {
        setTimeout(function() {
            if (button_toggle) $("#pop").hide()
        },
        500)
    }
    $(".goTop").live("click",
    function() {
        var _this = $(this);
        $('html,body').animate({
            scrollTop: 0
        },
        500,
        function() {
            _this.hide()
        })
    });
    $(window).scroll(function() {
        var htmlTop = $(document).scrollTop();
        if (htmlTop > 0) {
            $(".goTop").show()
        } else {
            $(".goTop").hide()
        }
    })
});
/**
 * 作品案例或者在建工地缩略图左移
 */
function thumb_img_ml(){
	var thumb_img_array = $("#goodcase_spic li");
	for(var i=0; i<thumb_img_array.length;i++){
		if($("#spicli_"+i).css('display')=="block"){
			if(i+4<thumb_img_array.length){
				var id = i+4;
				$("#spicli_"+id).css('display','block');
				$("#spicli_"+i).css('display','none');
			}
			return;
		}
	}
}

/**
 * 作品案例或者在建工地缩略图右移
 */
function thumb_img_mr(){
	var thumb_img_array = $("#goodcase_spic li");
	for(var i=thumb_img_array.length; i>=0;i--){
		if($("#spicli_"+i).css('display')=="block"){
			if(i-4>=0){
				var id = i-4;
				$("#spicli_"+id).css('display','block');
				$("#spicli_"+i).css('display','none');
			}
			return;
		}
	}
}

/**
 * 作品案例或者在建工地点击多略图时显示大图
 */
function display_thumb_big_img(obj){
	
	$("#c_bpic").attr('src',$("#"+obj.id).attr('real_img'));
}