﻿<?php

/* Mini Pagenavi v1.0 by Willin Kan. */
if ( !function_exists('pagenavi') ) {
	function pagenavi( $p = 4 ) { // 取当前页前后各 2 页，根据需要改
		if ( is_singular() ) return; // 文章与插页不用
		global $wp_query, $paged;
		$max_page = $wp_query->max_num_pages;
		if ( $max_page == 1 ) return; // 只有一页不用
		if ( empty( $paged ) ) $paged = 1;
		echo '<span class="pages">Page: ' . $paged . ' of ' . $max_page . ' </span> '; // 显示页数
		if ( $paged > $p + 1 ) p_link( 1, '最前页' );
		if ( $paged > $p + 2 ) echo '... ';
		for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { // 中间页
			if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-navi-numbers page-navi-current-page'>{$i}</span> " : p_link( $i );
		}
		if ( $paged < $max_page - $p - 1 ) echo '... ';
		if ( $paged < $max_page - $p ) p_link( $max_page, '最后页' );
	}
	function p_link( $i, $title = '' ) {
		if ( $title == '' ) $title = "第 {$i} 页";
		echo "<a class='page-navi-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$i}</a> ";
	}
}


if( !function_exists('related_posts')) {
function related_posts() {
$post_num = 10; // 數量設定.
$exclude_id = $post->ID; // 單獨使用要開此行 //zww: edit
$posttags = get_the_tags(); $i = 0;
if ( $posttags ) {
	$tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->term_id . ','; //zww: edit
	$args = array(
		'post_status' => 'publish',
		'tag__in' => explode(',', $tags), // 只選 tags 的文章. //zww: edit
		'post__not_in' => explode(',', $exclude_id), // 排除已出現過的文章.
		'caller_get_posts' => 1,
		'orderby' => 'comment_date', // 依評論日期排序.
		'posts_per_page' => $post_num
	);
	query_posts($args);
	while( have_posts() ) { the_post(); ?>
		<li><a rel="bookmark" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
	<?php
		$exclude_id .= ',' . $post->ID; $i ++;
	} wp_reset_query();
}/*
if ( $i < $post_num ) { // 當 tags 文章數量不足, 再取 category 補足.
	$cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
	$args = array(
		'category__in' => explode(',', $cats), // 只選 category 的文章.
		'post__not_in' => explode(',', $exclude_id),
		'caller_get_posts' => 1,
		'orderby' => 'comment_date',
		'posts_per_page' => $post_num - $i
	);
	query_posts($args);
	while( have_posts() ) { the_post(); ?>
		<li><a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
	<?php $i++;
	} wp_reset_query();
}*/
if ( $i  == 0 )  echo '<li>没有相关文章!</li>';
}
}


if( !function_exists('recent_comments'))
{
	function recent_comments()
	{
global $wpdb;
$limit_num = '5'; //这里定义显示的评论数量
$my_email = "'" . get_bloginfo ('admin_email') . "'"; //这里是自动检测博主的邮件，实现博主的评论不显示
$rc_comms = $wpdb->get_results("
 SELECT ID, post_title, comment_ID, comment_author, comment_author_email, comment_content
 FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts
 ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID)
 WHERE comment_approved = '1'
 AND comment_type = ''
 AND post_password = ''
 AND comment_author_email != $my_email
 ORDER BY comment_date_gmt
 DESC LIMIT $limit_num
 ");
$rc_comments = '';
foreach ($rc_comms as $rc_comm) { //get_avatar($rc_comm,$size='50')
$rc_comments .= "<li>". get_avatar($rc_comm,$size='50') ."<span class='zsnos_comment_author'>" . $rc_comm->comment_author . ": </span><a href='"
. get_permalink($rc_comm->ID) . "#comment-" . $rc_comm->comment_ID
//. htmlspecialchars(get_comment_link( $rc_comm->comment_ID, array('type' => 'comment'))) // 可取代上一行, 会显示评论分页ID, 但较耗资源
. "' title='on " . $rc_comm->post_title . "'>" . strip_tags($rc_comm->comment_content)
. "</a></li>\n";
}
$rc_comments = convert_smilies($rc_comments);
echo $rc_comments;
	}
}

//Auto add copyright info at the end of articles
function insertFootNote($content) {
	if(is_single() || is_feed()) { //如果不想feed输出就去掉“|| is_feed()”
		$wzbt = get_the_title();
		$wzlj = get_permalink($post->ID);
		$content.= '<p class="announce">';

		$content.= '<span style="font-weight:bold;text-shadow:0 1px 0 #ddd;">声明:</span> 此Blog中的文章和随笔仅代表作者在某一特定时间内的观点和结论，对其完全的正确不做任何担保或假设 <br /> 本站文章均采用 <a rel="nofollow" href="http://creativecommons.org/licenses/by-nc-sa/3.0/" title="署名-非商业性使用-相同方式共享">知识共享署名-相同方式共享3.0</a> 协议进行授权，';
		$content.= '除非注明，本站文章均为原创，转载请注明转自  <a href="'.home_url().'">'.get_bloginfo('name').'</a> 并应以链接形式标明本文地址!';
>>>>>>> minyx-lite-xiaozhou-net
		$content.= '</p>';
	}
	return $content;
}
add_filter ('the_content', 'insertFootNote');

?>
