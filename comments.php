<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = 'class="alt" ';
?>
<!-- You can start editing here. -->

<!--Baidu Union-->
<br/>
<!--<iframe id="baiduSpFrame" border="0" vspace="0" hspace="0" marginwidth="0" marginheight="0" framespacing="0" frameborder="0" scrolling="no" width="640" height="60" src="http://spcode.baidu.com/spcode/spstyle/style3103.jsp?tn=yexiaozhou2003_sp&ctn=0&styleid=3103"></iframe>-->

<?php if ($comments) : ?>
<?php if (!('open' == $post-> comment_status)) : ?>
<span class="closecomment">
<?php _e('Comments are closed','minyx2Lite')?>
</span>
<?php else : ?>
<a href="#respond" class="addcomment">
<?php _e('Add your comment','minyx2Lite')?>
</a>
<?php endif; ?>

 <!--<h3 id="comments">
 <?php comments_number('No responses', 'One response', '% responses' );?>-->
  <h3 id="comments"><strong><span id="comment-num"><?php comments_number('0', '1', '%' );?></span> Responses to "<?php the_title(); ?>"</strong></h3>

<ol class="commentlist" id="commentlist">
<!--
 <?php foreach ($comments as $comment) : ?>
  <li <?php echo $oddcomment; ?>id="comment-<?php comment_ID() ?>">
<?php echo get_avatar( $comment, 32 ); ?>
     <cite class ="fn">
      <?php comment_author_link() ?>
      </cite><?php _e('说','minyx2Lite')?>: <div class="commentmetadata"><a href="#comment-<?php comment_ID() ?>" title="">
      <div class="comment-meta commentmetadata"><?php comment_date('y.m.d') ?>
       <?php _e('于 ','minyx2Lite')?><?php comment_time() ?></a><?php edit_comment_link('编辑','&nbsp;&nbsp;',''); ?>
      </div></div>
    <?php comment_text() ?>
    <?php if ($comment->comment_approved == '0') : ?>
    <span class="moderate"><?php _e('Your comment is awaiting moderation','minyx2Lite')?>.</span>
    <?php endif; ?>
  </li>
  <?php
		/* Changes every other comment to a different class */
		$oddcomment = ( empty( $oddcomment ) ) ? 'class="alt" ' : '';
	?>
  <?php endforeach; /* end for each comment */ ?> -->
  
  <?php  if(function_exists('wp_list_comments'))
      {
        wp_list_comments();
      } ?>
</ol>

<?php
	// 如果用户在后台选择要显示评论分页
	if (get_option('page_comments')) 
	{
		// 获取评论分页的 HTML
		$comment_pages = paginate_comments_links('echo=0');
		// 如果评论分页的 HTML 不为空, 显示导航式分页
		if ($comment_pages) 
		{
?>
	<div id="commentnavi">
		<?php echo $comment_pages; ?>
	</div>
<?php
		}
	}
?> 

<?php if (!('open' == $post-> comment_status)) : ?>
<p class="nocomments"><?php _e('Comments are closed','minyx2Lite')?>.</p>
<?php else : ?>
<?php endif; ?>


<?php else : // this is displayed if there are no comments so far ?>

<<?php if ('open' == $post->comment_status) : ?>
<p class="nocommentsadd"><?php _e('这篇文章还没有人评论...','minyx2Lite')?> <a href="#respond"><?php _e('赶快来抢沙发吧！','minyx2Lite')?></a>.</p>
<?php else : // comments are closed ?>
<p class="nocomments"><?php _e('Comments are closed','minyx2Lite')?>.</p>

<?php endif; ?>
<?php endif; ?>

<br/>
<?php if ('open' == $post->comment_status) : ?>
<div id="respond"><?php _e('Leave a Reply','minyx2Lite')?>
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php _e('You must be','minyx2Lite')?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in','minyx2Lite')?></a> <?php _e('to post a comment','minyx2Lite')?>.</p>
<?php else : ?>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<!--<form id="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" onsubmit="new Ajax.Updater({success: 'commentlist'}, '<?php bloginfo('stylesheet_directory') ?>/comments-ajax.php', {asynchronous: true, evalScripts: true, insertion: Insertion.Bottom, onComplete: function(request){complete(request)}, onFailure: function(request){failure(request)}, onLoading: function(request){loading()}, parameters: Form.serialize(this)}); return false;">-->

  <?php if ( $user_ID ) : ?>
  <p><?php _e('Logged in as','minyx2Lite')?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account"><?php _e('Logout','minyx2Lite')?> &raquo;</a></p>
  <?php else: ?>
  	  <!-- 资料输入框 -->
  <div id="author_info">
  <p>
    <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
    <label for="author"><small><?php _e('Name','minyx2Lite')?>
    <?php if ($req) echo "(required)"; ?>
    </small></label>
  </p>
  <p>
    <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
    <label for="email"><small><?php _e('Mail (will not be published)','minyx2Lite')?>
    <?php if ($req) echo "(required)"; ?>
    </small></label>
  </p>
  <p>
    <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
    <label for="url"><small><?php _e('Website','minyx2Lite')?></small></label>
  </p>
  </div>
  	  
	  <!-- 有资料的访客 -->
  <?php if ( $comment_author != "" ) : ?>
	<script type="text/javascript">function setStyleDisplay(id, status){document.getElementById(id).style.display = status;}</script>
	<div class="form_row small">
		<?php printf(__('Welcome back <strong>%s</strong>.'), $comment_author) ?>
		<span id="show_author_info"><a href="javascript:setStyleDisplay('author_info','');setStyleDisplay('show_author_info','none');setStyleDisplay('hide_author_info','');"><?php _e('Change &raquo;'); ?></a></span>
		<span id="hide_author_info"><a href="javascript:setStyleDisplay('author_info','none');setStyleDisplay('show_author_info','');setStyleDisplay('hide_author_info','none');"><?php _e('Close &raquo;'); ?></a></span>
	</div>
  <?php endif; ?>
  		
  
  <!-- 有资料的访客 -->
  <?php if (( $comment_author != "" ) || ( $user_ID )) : ?>
	<script type="text/javascript">setStyleDisplay('hide_author_info','none');setStyleDisplay('author_info','none');</script>
  <?php endif; ?>
  	  
  <?php endif;?>
  
  <!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
  <p>
  	<div id="custom_smiles">
    <?php include(TEMPLATEPATH . '/smiley.php'); ?>
      <span id="wordcount">
    您已输入<span id="str">0</span>字
    </span>
      </div>

    <textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea>
  </p>
  <p>
	<input align="center" name="submit" type="image" src="<?php bloginfo('stylesheet_directory'); ?>/pix/btncomment.gif" id="submit" tabindex="5" value="<?php _e('Submit Comment','minyx2Lite')?>" /><span>(Ctrl+Enter)</span>

    <input type="hidden" name="comment_post_ID" id="comment_post_ID"value="<?php echo $id; ?>" />
    <input name="comment_parent" id="comment_parent" type="hidden" value="0"/>
  </p>
  <?php do_action('comment_form', $post->ID); ?>
</form></div>
<?php endif; // If registration required and not logged in ?>
<?php endif; // if you delete this the sky will fall on your head ?>
