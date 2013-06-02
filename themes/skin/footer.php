<?php 
	$tb_themeoptions = !is_array(get_option("tb_glisseo_theme_footer_options")) ?  get_option("tb_glisseo_theme_general_options") : array_merge(get_option("tb_glisseo_theme_general_options"),get_option("tb_glisseo_theme_footer_options"));?>

<?php if(isset($tb_themeoptions["tb_glisseo_footer"])){ //footer on/off ?>
<!-- Begin Footer -->
<div class="footer-wrapper">
  <div class="footer">
    <div class="one-fourth">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Widget Slot 1") ) : ?>
			<h3>Footer Widget Slot 1</h3>
            <p>
            Please configure this Widget in the <a href="wp-admin/widgets.php">Admin Panel</a> -> Appearance -> Widgets -> Footer Widget Slot 1
            </p>
	    <?php endif; ?>
    </div>
    <div class="one-fourth">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Widget Slot 2") ) : ?>
			<h3>Footer Widget Slot 2</h3>
            <p>
            Please configure this Widget in the <a href="wp-admin/widgets.php">Admin Panel</a> -> Appearance -> Widgets -> Footer Widget Slot 2
            </p>
	   <?php endif; ?>
    </div>
    <div class="one-fourth">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Widget Slot 3") ) : ?>
			<h3>Footer Widget Slot 3</h3>
            <p>
            Please configure this Widget in the <a href="wp-admin/widgets.php">Admin Panel</a> -> Appearance -> Widgets -> Footer Widget Slot 3
            </p>
	    <?php endif; ?>
    </div>
    <div class="one-fourth last">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Widget Slot 4") ) : ?>
			<h3>Footer Widget Slot 4</h3>
            <p>
            Please configure this Widget in the <a href="wp-admin/widgets.php">Admin Panel</a> -> Appearance -> Widgets -> Footer Widget Slot 4
            </p>
	    <?php endif; ?>    
	</div>
    <div class="clear"></div>
  </div>
</div>
<!-- End Footer --> 
<?php }
 
if(isset($tb_themeoptions["tb_glisseo_subfooter"])){ //subfooter on/off ?>
<!-- Begin Site Generator -->
<div class="site-generator-wrapper">
  <div class="site-generator">
    <div class="copyright one-half">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("SubFooter Widget Left") ) : ?>
			<p>Widget in <a href="wp-admin/widgets.php">Admin Panel</a> -> Appearance -> Widgets -> SubFooter Widget Left</p>
	    <?php endif; ?>
    </div>
    <div class="copyright one-half last">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("SubFooter Widget Right") ) : ?>
			<p>Widget in <a href="wp-admin/widgets.php">Admin Panel</a> -> Appearance -> Widgets -> SubFooter Widget Right</p>
	    <?php endif; ?>    
	</div>
    <div class="clear"></div>
  </div>
</div>
<!-- End Site Generator --> 
<?php } 

wp_footer(); ?>
<?php echo $tb_themeoptions["tb_glisseo_analytics"]; ?>
</body>
</html>