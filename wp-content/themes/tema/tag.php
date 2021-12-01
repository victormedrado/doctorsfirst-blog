<?php get_header();?>
<div id="content">
	<div id="content-core">
		<div id="main">
			<div id="intro" class="option1">
				<div id="intro-core"><h1 class="page-title"><span><?php echo single_cat_title(); ?></span></h1>
				<div id="breadcrumbs">
					<div id="breadcrumbs-core">
						<?php wp_custom_breadcrumbs(); ?>
					</div>
				</div>
			</div>
		</div>
		<div id="main-core">
			
			<?php
			if(have_posts()):
			while (have_posts()) : the_post();
			?>
			<article class="blog-article">
				<header class="entry-header two_fifth">
					<div class="blog-thumb">
						<a href="<?php the_permalink();?>">
							<?php the_post_thumbnail( '480x360' );?>
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
							<a href="<?php bloginfo('url'); ?>/<?php echo $slugCategoria;?>" rel="category tag"><?php echo $nomeCategoria;?></a>
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
			<h2 class="blog-title">
			Nenhum post encontrado nessa categoria
			</h2>
			<?php endif;?>
			<?php wp_pagination();?>
			<?php wp_reset_query();?>
			
			</div><!-- #main-core -->
			
			</div><!-- #main -->
			
			<?php get_template_part('sidebar');?>
			
		</div>
		</div><!-- #content -->
		<?php get_footer();?>