<?php

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
}
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
}
if ( $i  == 0 )  echo '<li>没有相关文章!</li>';
}
}

?>