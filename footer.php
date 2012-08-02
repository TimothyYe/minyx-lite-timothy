</div>
</div>
<div id="footer">
  <div id="footContent">
    <!-- please don't remove -->
    <p id="logoFoot"> <a target="_blank" href="http://www.spiga.com.mx/">www.spiga.com.mx</a> </p>
    <!-- please don't remove -->
    <div class="footText">
      <!-- you can edit this -->
      <p>Copyright &copy; <?php echo date('Y'); ?> <a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name'); ?></a>  2004-2012 | <a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a> &amp; <a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a></p>
      <p>Theme by <a target="_blank" href="http://www.spiga.com.mx">Spiga</a> (Modified by <a target="_blank" href="http://www.xiaozhou.net">Timothy</a>)| Powered by: <a target="_blank" href="http://wordpress.org/">Wordpress</a>  <script language="javascript" src="http://count24.51yes.com/click.aspx?id=242284288&logo=1" charset="gb2312"></script></p>
    <p><?php echo get_num_queries(); ?> queries in <?php timer_stop(3); ?> seconds</p>
      <!-- you can edit this -->
      <ul>
        <li id="currentFoot"><a href="<?php echo get_settings('home'); ?>">home</a></li>
        <?php wp_list_pages('sort_column=menu_order&title_li='.$page_sort)?>
      </ul>
    </div>
  </div>
</div>
<div id="scroller">
	<div id="scroller-top"></div>
	<div id="scroller-bottom"></div>
</div>
<?php wp_footer() ?>
</body>
	
<script type="text/javascript">
$("#loading div").animate({width:"100%"},function(){
setTimeout(function(){$("#loading").hide();},1000);
}); 
</script>

</html>