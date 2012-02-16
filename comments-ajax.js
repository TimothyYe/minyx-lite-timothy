/*
 * WordPress 內置嵌套評論專用 Ajax comments >> WordPress-jQuery-Ajax-Comments v1.26(no-edit) by Willin Kan.

原作者是 John Wrana, 德國人, http://jowra.com/journal/2007/01/wordpress-plugin-jquery-ajax-comments/, 插件從 2007-02-09 到現在都沒更新, 當然早已不能用.
這麼好的插件丟了可惜啊! 所以, willin 以他的插件為骨架, 用新手法重新編寫, 針對 WordPress 內置嵌套評論的特性, 讓它起死回生...
　
功能:
　1. 使用 Ajax 異步傳輸, 評論後不用刷新頁面, 即可看到評論內容出現於嵌套之中. (這是 Ajax comments 主要功能)
　2. 錯誤偵測也使用 Ajax 提示, 出錯不必跳轉頁面.
　3. 套用你所使用模板的 class 屬性. (感謝 Lorz 在先前已找到好方法, 我又在 js 中加了判斷式)
　4. 評論數量即時更新顯示. (感謝 zwwooooo 提供想法, 我做了大幅修改)
　5. 評論提交成功, 評論框自動回底層. (參考 WP 2.8 comment-reply.dev.js 的方法)
　6. 我另加了 "重覆評論" 和 "評論太快" 的預檢查功能, 因 WP 送出評論前可沒這兩項檢查, 它是在送出後才檢查的.
　7. 刷新頁面之前可以再編輯. (在 WP Ajax Edit Comments 這個優秀插件中, 這原本是個大工程, 但還是被我簡單地和諧了)(no-edit 版無此功能)
　
安裝方式:
　解壓縮後, 將 comments-ajax.js 及 comments-ajax.php 放在模板所在目錄. comments-ajax.dev.js 只是提供研發及學習用.
　在 header.php 找到 <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
　用下面幾行取代:
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.3/jquery.min.js"></script>
<?php if ( is_singular() ){ ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
<?php } ?>
　因為 comments-ajax.js 已合併了 WP 的 comment-reply.js, 所以不必再叫用原來的 wp_enqueue_script( 'comment-reply' )
　如果你的模板夠標準, 這樣就可以正常工作了.
　
如果有任何運行不正常, 請繼續看以下注意事項:
　1. 安裝前, 請先確認 WordPress 內置嵌套評論已正常運作.
　2. 各式模板設計不同, 請檢查 comments.php 是否夠標準, 儘量不修改模板, 只要對應修改本文件, 以免 css 亂套.
　　◎標準模板是指:
　　　"評論數" id="comments"
　　　　例: <h3 id="comments"><?php comments_number( ...有%條評論... </h3>
　　　　已知有不少模板用的不是 "comments", 它的 "comments" 已用到別地方,
　　　　如果評論提交後, 評論數位置出現很多源代碼, 通常是這問題, 要特別留意!
　　　"評論列表" id="commentlist"
　　　　例: <ol id="commentlist"> 注意是 ol 不是 ul.
　　　"表單" id="commentform"
　　　　例: <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
　　　"評論框" id="respond" (是含 author, email, url, comment)
　　　　例: <div id="respond" ... >
　　　"評論" id="comment"
　　　　例: <textarea name="comment" id="comment" ... >
　　　"提交" id="submit"
　　　　例: <input ... id="submit" ... >
　　※以上所用的 id 標簽是 js 運作的重要關鍵! 請確認與模板對應無誤!
　3. comments-ajax.js 如果要放在子目錄, 或是要合併於其它 js, 請自行修改路徑.
　　　例: 當 comments-ajax.php 不動, comments-ajax.js 改放於 .../(模板)/js/comments-ajax.js
　　　要將 js_url.replace('-ajax.js','-ajax.php') 改為 js_url.replace('js/comments-ajax.js','comments-ajax.php')
　4. 本程式主要提供 Ajax comments 功能, css 已儘量配合原模板輸出. 如果還有 css 需求, 請自行修改.
　5. 在 comments-ajax.php 最下方有評論格式, 若你的 functions.php 有 mytheme_comment(), 請對應覆蓋, 且拿掉 "回覆" 鏈接.
　6. 新評論沒 "回覆" 鏈接, 自己的留言就不必回覆了吧! 免得多了程式佔空間, 又幾乎用不到. 要回覆的話, 刷新頁面就有了!
　7. 第 140 行, 提交按鈕 15 秒後才出現, 是防止快評功能. 可以不用這功能, 因為 comments-ajax.php 也寫了檢查快評功能.

最後, 特地感謝 Leo.N 及 蒋良军 在百忙中測試本程式, 讓本程式更趨完美.

注意: 本程式完全開源, 請遵守 GPL 協議. GPL 的出發點是代碼的開源/免費使用和引用/修改/衍生代碼的開源/免費使用, 但不允許修改後和衍生的代碼做爲閉源的商業軟件發布和銷售.
一旦發現引用本程式產生商業行為, 將依法起訴. 哈~ 這將是我設計本程式的唯一收入來源, 請特別留意.
 	 如果還有問題, 請移步 http://willin.atbhost.net/ 作者: Willin Kan, 2009/8/12
 */
jQuery(document).ready(function($){																					//啟用 jQ

var i = 0, got = -1, len = document.getElementsByTagName('script').length;//讀取網頁找 script 數量
while ( i <= len && got == -1){
	var js_url = document.getElementsByTagName('script')[i].src,		//判斷哪一個 script 是 comments-ajax.js
			got = js_url.indexOf('comments-ajax.js'); i++ ;							//找到 comments-ajax.js 文件路徑
}
var	ajax_php_url = js_url.replace('-ajax.js','-ajax.php'),				//將 -ajax.js 替換為 -ajax.php, 找到 comments-ajax.php 路徑
		wp_url = js_url.substr(0,js_url.indexOf('/wp-content/')),			//找到 WP 安裝路徑
		pic_sb_url = wp_url + '/wp-admin/images/wpspin_dark.gif',			//提交 icon 位址
		pic_no_url = wp_url + '/wp-admin/images/no.png', 							//錯誤 icon 位址
		pic_ys_url = wp_url + '/wp-admin/images/yes.png', 						//成功 icon 位址
		txt1 = ' style="display: none;background: url(',							//--------------- 以下是過程所用的 html 字段, 儘量不去動它.
		txt2 = ') no-repeat left;padding-left:20px;',
		txt3 = '<div id="commentload"'+ txt1 + pic_sb_url + txt2 + '">正在提交, 請稍候...</div>',
		txt4 = '<div id="commenterror"'+ txt1 + pic_no_url + txt2 + 'margin: 0 auto;">#</div>',
		txt5 = '\n<ol class="commentlist" id="new_comm_',
		txt6 = '\n<ul class="children" id="new_comm_',
		txt7 = '" style="display: none;">',
		txt8 = '\n<span id="success_',
		txt9 = '" style="margin-left:20px; background: url(' + pic_ys_url + txt2 + '">提交成功</span>\n',
		txtb, num = 1, $new_comm;
				$('#submit').attr("disabled",false); 											//確定提交按鈕功能沒取消
				$('#comment').after( txt3 + txt4 );												//添加提交和錯誤提示, 在#comment 或 #submit 後添加, 視模板設計而定
				
$('#commentform').submit(function(){															//id='commentform' submit時的動作
				$('#submit').attr("disabled",true).fadeTo('slow', 0.3);		//防範再次按提交按鈕

	$.ajax({																						//啟用 Ajax
				url: ajax_php_url,																				//comments-ajax.php 位址
				data: $('#commentform').serialize(),											//發送的數據 id='commentform'
				type: 'POST',																							//請求類型為 POST

		beforeSend: function(){																	//提交時的動作
				$('#commenterror').hide();																//隱藏:錯誤提示
				$('#bottom_ad').hide();
				$('#commentload').slideDown();														//拉下顯示:正在提交
				},

		error: function(request){																//錯誤時的動作
				$('#commentload').slideUp();															//推上隱藏:正在提交
				$('#commenterror').show('slow').html(request.responseText);//顯示:錯誤提示
				setTimeout(function(){$('#submit').attr('disabled',false).fadeTo('slow', 1);$('#commenterror').slideUp();}, 3000);//恢復: 提交按鈕
				},

		success: function(data){																//成功時的動作
				$('textarea').each(function(){this.value=''});						//清空: textarea 《使用 $('#comment').val(''); 也可以, 但有些模板不動作》
				$('#commentload').hide();																	//隱藏:正在提交
				$('#bottom_ad').show('slow');
		var t = addComment, /*cancel = t.I('cancel-comment-reply-link'),*/ //評論框 & 取消回覆鏈接定義
				temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId),//評論框的臨時節點定義
				post = t.I('comment_post_ID').value, parent = t.I('comment_parent').value,//傳回父層值
		 		num_text = num.toString();																//數字轉文字, 給編號

	if ($('#comments').length){																			//如果已有 id='comments'	--------------- 評論數變化
		tmp_txt = t.I('comments').innerHTML,													//取 id='comments' 內容
		n = parseInt(tmp_txt.match(/\d+/)),														//在字串中找數字
		tmp_txt = tmp_txt.replace( n, n + 1 );												//替換評論數字串
		$('#comments').text(tmp_txt)}																	//顯示:新評論數
	else {tmp_txt = '<h3 id="comments">已有 '+ num +' 條評論: </h3>';//沒有時, 產生新 id='comments'
		$('#respond').before(tmp_txt);																//將新 id 加入
	}

	if ( parent == '0'){new_htm = txt5 + num_text + txt7 + '</ol>' }//如果是底層, 加:ol	-------------- 顯示新評論
	else {new_htm = txt6 + num_text + txt7 + '</ul>';								//子層加:ul
		is_div = document.getElementsByTagName('ol')[0].innerHTML.indexOf('div-');//找尋 div- 字頭的 id
		if ( is_div == -1 ){txtb = ''} else {txtb = 'div-'};					//如果找到, comment 的 id 也要加 div- 字頭, 因 WP 默認的的有字頭, 但一般模板設計沒字頭.
			 }
				new_htm = new_htm + txt8 + num_text + txt9;								//加:提交成功

				$('#respond').before(new_htm);														//在 #respond 前加入 new_htm
		var $new_comm = $('#new_comm_' + num_text);										//定義新評論的 div
				$new_comm.append(data).fadeIn(4000);											//將新評論內容傳入$new_comm, 以淡入效果顯示新評論, (4000)表示4秒
				countdown();																							//(倒計時函式在最下面)
				num++ ;																										//編號累進, 目的是不讓 id 重覆

		//cancel.style.display = 'none';																//隱藏:取消回覆	-------------- 評論框回底層
		//cancel.onclick = null;																				//清空:回覆鏈接
		t.I('comment_parent').value = '0';														//回底層
if ( temp && respond ){																						//如果有節點和回覆框
		temp.parentNode.insertBefore(respond, temp);									//temp 節點前加評論框
		temp.parentNode.removeChild(temp)}														//刪除 temp 節點	------------------- end --
				}
			});																										//結束Ajax
  return false;																				//終止submit動作
	});

addComment = {																		//回覆時的動作, 以下參考 wp-includes\js\comment-reply.dev.js
	moveForm : function(commId, parentId, respondId, postId) {
		var t = this, div, comm = t.I(commId), respond = t.I(respondId), /*cancel = t.I('cancel-comment-reply-link'),*/ parent = t.I('comment_parent'), post = t.I('comment_post_ID');

		$('#commenterror').hide();																		//隱藏:錯誤提示
		$('#bottom_ad').hide();

		t.respondId = respondId;
		postId = postId || false;

		if ( ! t.I('wp-temp-form-div') ) {
			div = document.createElement('div');
			div.id = 'wp-temp-form-div';
			div.style.display = 'none';
			respond.parentNode.insertBefore(div, respond)
		}

		if ( post && postId && comm )
			comm.parentNode.insertBefore(respond, comm.nextSibling);
			post.value = postId;
			parent.value = parentId;
			//cancel.style.display = '';
/*
		cancel.onclick = function() {														//取消回覆時的動作
			var t = addComment, temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId);

			$('#commenterror').hide();																	//隱藏:錯誤提示

			this.style.display = 'none';
			this.onclick = null;
			t.I('comment_parent').value = '0';
		if ( temp && respond ){
			temp.parentNode.insertBefore(respond, temp);
			temp.parentNode.removeChild(temp)}
			return false;
		}; */

		try { t.I('comment').focus(); }
		catch(e) {}
		return false;
	},
	I : function(e) {
		return document.getElementById(e)
	}
};		//結束addComment

var wait = 5, submit_val = $('#submit').val();										//時間設15秒, 暫存:按鈕上的字
function countdown(){																							//倒計時函式
	if ( wait == 0 ){																								//如果時間到
		$('#submit').val(submit_val).attr('disabled',false).fadeTo('slow', 1);//恢復:提交按鈕
		wait = 5;																										//重置時間
	} else {
		$('#submit').val(wait); wait--; setTimeout(countdown,1000);		//顯示:秒數, 秒數遞減, 1秒延遲
  }
};
})																										//結束jQuery