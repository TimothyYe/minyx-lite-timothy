<div id="sidebar">
    	
  <div id="about">
    <div>
      <h2>
        <div>Tips</div>
      </h2>

      <p>
      	<div>本站基于<a href="http://www.linode.com/?r=ac16f810d6f6c2b64d9f4cd6f9d08634db3d7b5c" target="_blank">Linode VPS</a>构建,由Ubuntu强力驱动</div></br>
		<div>本站提供Linode与BurstNET的VPS代购服务，欢迎访问<a href="http://idigital.taobao.com" target="_blank">数字时代淘宝店</a></div></br>
    	<div><strong><font color="red">手机访问: </font></strong><a href="http://m.xiaozhou.net" target="_blank">http://m.xiaozhou.net</a> </br>
    <br/>
    <br>此Blog中的文章和随笔仅代表作者在某一特定时间内的观点和结论，对其完全的正确不做任何担保或假设。</br>
    <br>本站作品采用<a rel="license" href="http://creativecommons.org/licenses/by-sa/2.5/cn/">&#30693;&#35782;&#20849;&#20139;&#32626;&#21517;-&#30456;&#21516;&#26041;&#24335;&#20849;&#20139; 2.5 &#20013;&#22269;&#22823;&#38470;&#35768;&#21487;&#21327;&#35758;</a>&#36827;&#34892;&#35768;&#21487;&#12290;</br>
    	</div>
      </p>
		 <!-- you can edit this -->
    </div>
  </div>
<!--赞助商链接-->
<div id="about">
    <div>
      <h2>
        <div>赞助商链接</div>
      </h2>
	<div>
	<ul>
	<li id="linkcat-2" class="linkcat">
	<ul class="xoxo blogroll">

	<li><a href="http://www.xiaozhou.net/go/ask2link" target="_blank">用博客赚美元</a></li>
	</ul>
	</li>
	</ul>
		  
		  <!--ADs-->
		   <?php   
 function ask2link_ad_helper($url)  
 {  
   $content = '';  
   $done=false;  
   if (ini_get('allow_url_fopen') == '1') {  
     if ($fp = @fopen($url, 'r')) {  
       while ($line = @fread($fp, 1024)) {  
         $content .= $line;  
     $done=true;  
       }  
     }  
   }   
   if (!$done) {  
     // get the host name and url path  
     $parsedUrl = parse_url($url);  
     $host = $parsedUrl['host'];  
     if (isset($parsedUrl['path'])) {  
       $path = $parsedUrl['path'];  
     }  
       
     $timeout = 10;  
     // connect to the remote server   
     $fp = @fsockopen($host, '80', $errno, $errstr, $timeout );   
       
     if( !$fp ) {   
       // echo "Cannot retrieve $url";  
     } else {  
       // send the necessary headers to get the file   
       @fputs($fp, "GET $path HTTP/1.0\r\n" .  
         "Host: $host\r\n\r\n");   
         
       // retrieve the response from the remote server   
       while ( $line = @fread( $fp, 4096 ) ) {   
         $content .= $line;  
       }         
       @fclose( $fp );        
       // strip the headers  
       $pos      = strpos($content, "\r\n\r\n");  
       $content = substr($content, $pos + 4);  
     }  
   }  
       
   // return the file content   
   return $content;  
 }  
   
 function ask2link_ad($url) {  
   $h = urlencode($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);  
   $content=ask2link_ad_helper($url."?x-h=".$h);  
   if (!preg_match('/\<Error/',$content)) {  
     echo $content;  
   }    
 }  
   
 echo ask2link_ad('http://s3.amazonaws.com/mf1/ad/007b8f8892ed151b80901301823397/ad_content');  
   
 ?> 
		  
	</div>
    </div>
  </div>
 <!--google ad-->
 <div align="center">
<script type="text/javascript"><!--
google_ad_client = "pub-2308560106736257";
/* sidebar-250x250, 创建于 10-7-2 */
google_ad_slot = "3175129389";
google_ad_width = 250;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
  </div>
  
   <!--baidu union ad-->
 <div align="center">
  <script type="text/javascript"> /*250*250，创建于2010-8-24 xiaozhou.net - sidebar*/ var cpro_id = 'u166249';</script>
<script type="text/javascript" src="http://cpro.baidu.com/cpro/ui/c.js"></script>
 </div>
	 
  <!--Search Form-->
  <!--<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
    <div>
      <input type="image" src="<?php bloginfo('stylesheet_directory');?>/pix/btnsearch.gif" id="searchsubmit"  />
      <label>
      <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
      </label>
    </div>
  </form>-->
  
  
<form action="http://www.google.com/cse" id="cse-search-box" target="_blank">
  <div>
    <input type="hidden" name="cx" value="partner-pub-2308560106736257:k159ut-jbxr" />
    <input type="hidden" name="ie" value="UTF-8" />
	<label>
    <input type="text" name="q" size="20" id="s" />
	</label>
    <input type="submit" name="sa" value="&#x641c;&#x7d22;" id="searchsubmit" />
  </div>
</form>
<script type="text/javascript" src="http://www.google.com/cse/brand?form=cse-search-box&amp;lang=zh-Hans"></script>

  		   
    <!--Twitter Sidebar-->
   <div>
  <iframe id="sina_widget_1401699537" style="width:100%; height:350px;" frameborder="0" scrolling="no" src="http://v.t.sina.com.cn/widget/widget_blog.php?uid=1401699537&height=350&skin=wd_01&showpic=1"></iframe>
  </div>
  		
   <!--recent comments-->
   <?php if (function_exists('get_recent_comments')) { ?>
   <div>
    <div>
      <h2>
        Recent Comments
      </h2>
    	<div>
			<?php get_recent_comments(); ?>
    	</div>
    	<br/>
    </div>
  </div>
    <?php } ?>
    
  	  
  <!--Recent Post-->
  <div id="recent"> <a href="<?php bloginfo('rss2_url'); ?>" class="mini_rss">
    <?php _e('RSS2.0 Entries','minyx2Lite')?>
    </a>
    <h2>
      <?php _e('Recent Post','minyx2Lite')?>
    </h2>
    <ul>
      <?php wp_get_archives('type=postbypost&limit=5&format=html'); ?>
    </ul>
  </div>
  	  
   <!--Tags Cloud-->
   <div>
    <div>
      <h2>
        Tags Cloud
      </h2>
    	<div align="center">
			<?php wp_cumulus_insert(); ?>
    	</div>
    	<br/>
    </div>
  </div>
  	  
  <div class="sideR">
    <ul>
      <li>
      <?php wp_list_bookmarks(); ?>
      </li>
      <!--
      <li class="archives">
        <h2>
          <?php _e('Archives','minyx2Lite')?>
        </h2>
        <ul>
          <?php wp_get_archives('type=monthly'); ?>
        </ul>
      </li>
      <?php if (function_exists('get_theme_switcher')) { ?>
      <li>
        <h2>
          <?php _e('Themes','minyx2Lite')?>
        </h2>
        <?php get_theme_switcher(); ?>
      </li>
      <?php } ?> -->
      
    </ul>
  </div>
  <div class="sideL">
    <ul>
      <?php wp_list_categories('show_count=1&title_li=<h2>Categories</h2>'); ?>
      <li>
       <!--
         <h2>
          <?php _e('Meta','minyx2Lite')?>
        </h2>
        <ul>
          <?php wp_register(); ?>
          <li>
            <?php wp_loginout(); ?>
          </li>
          <?php wp_meta(); ?>
        -->
          
        </ul>
      </li>
    </ul>
  </div>
</div>