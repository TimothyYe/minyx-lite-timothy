<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>
<?php if ( function_exists('optimal_title') ) : ?>
<?php optimal_title('|'); bloginfo('name'); ?>
<?php else : ?>
<?php if ( is_home() ) : ?>
	<?php bloginfo('name'); wp_title('|');  ?> | <?php bloginfo('description');  ?>
<?php else :?>
	<?php wp_title('');  ?> | <?php bloginfo('description');  ?> | <?php bloginfo('name'); ?>
<?php endif; ?>
<?php endif; ?>
</title>
	
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/timothy.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.lazyload.mini.js"></script>
<script type="text/javascript" charset="utf-8">
      $(function() {
          $("img").lazyload({
             placeholder : "<?php bloginfo('template_directory'); ?>/pix/grey.gif",
             effect: "fadeIn"
          });
      });
</script>
	
<?php if ( is_singular() ){ ?>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
<?php } ?> 
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<?php
//判断是否为首页
if (is_home()) {
    $description ="Timothy Space | Timothy的技术博客,原VC源动力站点,关注程序开发,IT技术,VPS技术,Wordpress技术,计算机与互联网,以及生活点滴记录";
    $keywords ="Timothy,Space,Blog,博客,计算机,互联网,IT技术,VC源动力,DotNet开发,VC开发,DotNET教程,VPS教程,Wordpress";
//判断是否为文章页
} else if (is_single()) {
    if ($post->post_excerpt) {
        $description = $post->post_excerpt;
    } else {
        $description = mb_strimwidth(strip_tags(
    apply_filters('the_content',$post->post_content)
    ),0,220);
    }
    $keywords = "";
    $tags = wp_get_post_tags($post->ID);
    foreach ($tags as $tag ) {
       $keywords = $keywords . $tag->name . ",";
    }
//判断是否为分类页
} else if (is_category()) {
  $description = category_description();
}
?>
<meta content="<?php echo $keywords; ?>" name="keywords" />
<meta content="<?php echo $description; ?>"name="description" />

<!-- leave this for stats 2-->
<link href="<?php bloginfo('template_directory'); ?>/pix/favicon.ico" rel="shortcut icon">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>

<?php if ( is_singular() ){ /* 只在单个页面加载 */ ?>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/thickbox/thickbox.css">
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/thickbox/thickbox-compressed.js"></script>
<?php } ?>

<!--Google Analysis-->	
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-17048089-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!--End-->

</head>
<body>
<!--loding progress bar-->
<div id="loading" style="display: none;"><div style="width: 0%; display: block;"></div></div>
<div id="container">
<ul id="topMnu">
  <?php wp_register(); ?>
  <li>
    <?php wp_loginout(); ?>
  </li>
</ul>
<div id="header">
  <ul id="menu">
    <li <?php if(is_home()) { ?><?php echo 'id="current"';?><?php }?>><a href="<?php echo get_option('home'); ?>/">首页</a></li>
    <li><a target="blank" href="http://album.xiaozhou.net">相册</a></li>
    <?php wp_list_pages('sort_column=menu_order&title_li='.$page_sort)?>
    <li id="twitter"><a href="http://twitter.com/timothyye" target="blank" title="Follow Timothy on twitter!">
    	</a></li>
    <li id="facebook"><a href="http://zh-cn.facebook.com/people/Timothy-Ye/645939393" target="_blank" title="Find Timothy on facebook!">
    	</a></li>
    <li id="rss"><a href="http://www.xiaozhou.net/feed" target="_blank" title="Subscript this blog via FeedSky!"><?php _e('Entries (RSS)','minyx2Lite')?>
    	</a></li>
  </ul>
  <h1><a href="<?php echo get_option('home'); ?>/">
    <?php bloginfo('name'); ?>
    </a> <small>
    <?php bloginfo('description'); ?>
    </small></h1>
</div>
<script type="text/javascript">
		$("#loading").show();
		$("#loading div").animate({width:"20%"});
</script>
<div id="wrapper">
