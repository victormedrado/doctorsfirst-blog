<?php get_header();?>
<div class="slider-home ">
	<div class="">
		<?php echo do_shortcode('[cycloneslider id="home"]');?>
	</div>
	<!-- /.content-core -->
</div>
<!-- /.slider -->
<div class="clearboth"></div>
<div id="introaction"><div id="introaction-core"><div class="action-text three_fourth action-teaser">
	<h3><?php the_field('titulo_call', 'option'); ?></h3>
	<p><?php the_field('subtitulo_call', 'option'); ?></p>
</div>
<div class="action-button one_fourth last">
	<a href="<?php the_field('url_botao', 'option'); ?>">
		<h4 class="themebutton"><?php the_field('label_botao', 'option'); ?>
		</h4>
	</a>
</div>
</div>
</div>
<div id="content">
<div id="content-core">
<div id="main">
	
	<div id="main-core">
		<?php
		$wp_query = new WP_Query();		
		// echo '<h1>paged ' . $paged . '</h1>';
		// echo '<h1>page ' . $page . '</h1>';
		// echo '<h1>pages ' . $pages . '</h1>';
		query_posts( array( 'post_type' => 'post', 'showposts' => 10, 'paged' => $page ));
		if(have_posts()):
			while ($wp_query -> have_posts()) : $wp_query -> the_post();
		?>
		<article class="blog-article">
			<header class="entry-header two_fifth">
				<div class="blog-thumb">
					<a href="<?php the_permalink();?>">
						<?php the_post_thumbnail( '480x360' );?>
						<!-- <img width="480" height="360" src="http://www.escoteiros.org.br/wpsitenacional/wp-content/uploads/2016/02/detalhe_122.jpg" class="attachment-column2-3/4 wp-post-image" alt="I Am Worth Loving Wallpaper"> -->
					</a>
				</div>
			</header>
			<div class="entry-content three_fifth last">
				<h2 class="blog-title">
				<a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a>
				</h2>
				<div class="entry-meta">
					<span class="author">
						<i class="icon-pencil"></i>Por: <?php the_author_link(); ?>
					</span>
					<span class="date">
						<i class="icon-calendar-empty"></i><?php echo get_the_date();?>
					</span>
					<?php
					$categoria = get_the_category();
					$nomeCategoria = $categoria[0]->cat_name;
					$slugCategoria = $categoria[0]->category_nicename;
					?>
					<span class="category">
						<i class="icon-folder-open"></i>
						<?php the_category( ', ' ); ?>
					</span>
					<span class="tags">
						<i class="icon-tags"></i>
						<?php the_tags(); ?>
					</span>
				</div>
				<?php the_excerpt();?>
				</p><p><a href="<?php the_permalink();?>" class="more-link themebutton">Leia Mais</a></p>
			</div>
			<div class="clearboth"></div>
		</article>
		<?php endwhile; else:?>
		<?php endif;?>
		<?php wp_pagination();?>
		<?php wp_reset_query();?>
		
		<!-- <ul class="pag">
					<li class="current">
								<span>1</span>
					</li>
					<li>
								<a href="page/2/index.html">2</a>
					</li>
					<li>
								<a href="page/3/index.html">3</a>
					</li>
					<li>
								<a href="page/4/index.html">4</a>
					</li>
		</ul> -->
		
		</div><!-- #main-core -->
		
		</div><!-- #main -->
		
		<?php get_template_part('sidebar');?>
		
	</div>
	</div><!-- #content -->
	<?php get_footer();?>