<?php get_header(); ?>

<div id="content" class="narrowcolumn">
  <?php if (have_posts()) : ?>
  <?php $post = $posts[0];  ?>
  <?php if (is_category()) { ?>
  <h2 class="pagetitle">&#8216;
    <?php single_cat_title(); ?>
    &#8217;
    <?php _e('category archive','minyx2Lite')?>
  </h2>
  <?php  } elseif (is_day()) { ?>
  <h2 class="pagetitle">
    <?php _e('Archive for','minyx2Lite')?>
    <?php the_time('F jS, Y'); ?>
  </h2>
  <?php  } elseif (is_month()) { ?>
  <h2 class="pagetitle">
    <?php _e('Archive for','minyx2Lite')?>
    <?php the_time('F, Y'); ?>
  </h2>
  <?php } elseif (is_year()) { ?>
  <h2 class="pagetitle">
    <?php _e('Archive for','minyx2Lite')?>
    <?php the_time('Y'); ?>
  </h2>
  <?php  } elseif (is_search()) { ?>
  <h2 class="pagetitle">
    <?php _e('Search results for','minyx2Lite')?>
    &#8216;&#8216;<?php echo($s); ?> &#8217;&#8217; </h2>
  <?php } ?>
  <script type="text/javascript">
		$("#loading div").animate({width:"40%"});
</script>
  <?php while (have_posts()) : the_post(); ?>

  <div class="post" id="post-<?php the_ID(); ?>">
    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','minyx2Lite')?> <?php the_title(); ?>">
      <?php the_title(); ?>
      </a></h2>
    <?php if(!is_page()) {  ?>
    <small>
    <?php if(function_exists('the_views')) { the_views(); } ?>
    <?php the_time('F d, y') ?>
    <?php _e('by','minyx2Lite')?>
    <?php the_author() ?>
    <?php edit_post_link('edit', ' - ', '  '); ?>
    </small>
	
	
    <?php }  ?>
    <?php if(!is_search()) :  
	if(is_single())
	{ ?>
	<div id="page_ad">
	<a href="http://www.xiaozhou.net/go/linode" target="blank" title="现在就开始体验高性能的Linode VPS!" rel="nofollow">
	<img src="http://www.xiaozhou.net/wp-content/themes/minyx-20-lite/pix/linode_banner.jpg" alt="现在就开始体验高性能的Linode VPS!" />
	</a>
	</div>
	<?php
	}
	?>
	
	
    <div class="entry">
      <?php the_content(__('Read More')); ?>
    </div>
    <?php endif;  ?>
    <?php if(!is_page()) {  ?>
    <?php if(is_single()) : ?>
    
		<h3>你可能也对下列文章感兴趣</h3>
<ul>
<?php related_posts(); ?>
</ul>


    <?php else :  ?>
    <ul class="postmetadata">
      <li class="icon_comment icon_r">
        <?php comments_popup_link(__('No Comments','minyx2Lite'),__('1 Comment','minyx2Lite'),__('% Comments','minyx2Lite')); ?>
      </li>
      <li class="icon_cat"><strong>
        <?php _e('Posted in','minyx2Lite')?>
        </strong>
        <?php the_category(', ') ?>
      </li>
    </ul>
    <?php endif; ?>
    <?php }  ?>
  </div>
  <?php if(is_single()) :   ?>
  <?php comments_template(); ?>
  <?php endif;  ?>
  <?php endwhile; ?>
  <script type="text/javascript">
		$("#loading div").animate({width:"60%"});
  </script>
  <?php if(is_single() || is_page() ) :  ?>
  <?php else: ?>
  <div>
    <?php if(function_exists('pagenavi')) { pagenavi(); } ?>
   </div>
    <br/>
  <?php endif;  ?>
  <?php else : ?>
  <?php include (TEMPLATEPATH . '/notfound.php');?>
  <?php endif; ?>
</div>
<?php get_sidebar(); ?>
<script type="text/javascript">
		$("#loading div").animate({width:"80%"});
</script>
<div class="clear"></div>
<?php get_footer(); ?>
