<footer>
	<div id="footer">
		<div id="footer-core" class="option4">
			<?php
			if ( is_active_sidebar('sidebar_footer') ) {
				dynamic_sidebar('sidebar_footer');
			}
			?>
		</div>
		</div><!-- #footer -->
		<div id="sub-footer">
			<div id="sub-footer-core">
				<div class="logo text-center">
					<!-- <a rel="home" href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo-footer.png"><br /></a> -->
				</div>
				<div id="footer-menu" class="sub-footer-links">
					<!-- <?php
					wp_nav_menu (
						array(
							'theme_location'  => 'menu_footer',
							'menu'            => 'menu_footer',
							'container'       => '',
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => '',
							'menu_id'         => '',
							'echo'            => true,
								//'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
						'items_wrap'      => '<ul id="menu-pre-header-2" class="menu">%3$s</ul>',
						'depth'           => 2
						)
					);
				?> -->
			</div>
			<!-- #footer-menu -->
			<p class="text-center"><small class="copy">&copy; Fmiligrama 2016 - Todos os direitos reservados.</small></p>
		</div>
	</div>
</footer>
</div><!-- #body-core -->
<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/js/extentions/prettyPhoto/js/jquery.prettyPhoto.js'></script>
<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/js/scripts/main-frontend.js'></script>
<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/js/extentions/bootstrap/js/bootstrap.js'></script>
<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/js/scripts/modernizr.js'></script>
<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/js/scripts/plugins/ResponsiveSlides/responsiveslides.min.js'></script>
<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/js/scripts/plugins/ResponsiveSlides/responsiveslides-call.js'></script>
<!-- Google Analytics: change UA-15416150-5 to be your site's ID. -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-15416150-5', 'auto');
  ga('send', 'pageview');

</script>
<?php wp_footer(); ?>
</body>
</html>