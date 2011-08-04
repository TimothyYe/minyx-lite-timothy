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

?>