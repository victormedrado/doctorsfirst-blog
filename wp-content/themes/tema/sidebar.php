<div id="sidebar">
	<div id="sidebar-core">
		<aside class="widget thinkup_widget_search">
			<h3 class="widget-title">Pesquisar:</h3>
			<?php get_search_form( ); ?>
		</aside>
		<aside class="widget thinkup_widget_categories">
			<h3 class="widget-title">categorias</h3>
			<?php
				$taxonomy = 'category';
				$terms = get_terms($taxonomy, 'hide_empty=0'); // Get all terms of a taxonomy
				if ( $terms && !is_wp_error( $terms ) ) :
			?>
			<ul>
				<?php foreach ( $terms as $term ) { ?>
				<li class="cat-item">
					<a href="<?php echo get_term_link($term->slug, $taxonomy); ?>">
						<span><?php echo $term->name; ?><span>(<?php echo $term->count; ?>)</span></span>
					</a>
				</li>
				<?php } ?>
			</ul>
			<?php endif;?>
			
		</aside>
		<aside class="widget thinkup_widget_search">
			<h3 class="widget-title">Entre para nossa lista:</h3>
			<?php echo do_shortcode('[contact-form-7 id="1315" title="Formulário de contato 1"]'); ?>
		</aside>
		<aside class="widget thinkup_widget_recentposts">
			<h3 class="widget-title">Posts Recentes</h3>
			<?php
				$wp_query = new WP_Query();
			query_posts( array('post_type' => 'post', 'posts_per_page' => 5,));
			if(have_posts()):
			while ($wp_query -> have_posts()) : $wp_query -> the_post();?>
			<div class="recent-posts">
				<div class="image">
					<a href="<?php the_permalink();?>" title="<?php the_title();?>">
						<?php the_post_thumbnail( '65x65' );?>
						<!-- <img width="65" height="65" src="http://www.nutridirect.com.br/blog/wp-content/uploads/2016/02/acordando-feliz1-150x150.jpg" class="attachment-65x65 wp-post-image" alt="acordando feliz"> -->
						<div class="image-overlay"></div>
					</a>
				</div>
				<div class="main">
					<a href="<?php the_permalink();?>"><?php the_title();?></a>
					<a href="<?php the_permalink();?>" class="date"><?php echo get_the_date();?></a>
				</div>
			</div>
			<?php endwhile?>
			<?php endif?>
			<?php wp_reset_query();?>			
		</aside>
		<aside class="widget thinkup_widget_popularposts">
			<h3 class="widget-title">Posts Mais Lidos</h3>
			<?php				
			$popular_posts = new WP_Query(array(
			    'posts_per_page' => 5,
			    'meta_key' => 'wpb_post_views_count',
			    'orderby' => 'meta_value_num',
			    'order' => 'DESC'
			));
			if($popular_posts->have_posts()):
			while ($popular_posts->have_posts()) : $popular_posts->the_post();?>
			<div class="popular-posts">
				<div class="image">
					<a href="<?php the_permalink();?>" title="<?php the_title();?>">
						<?php the_post_thumbnail( '65x65' );?>
						<div class="image-overlay"></div>
					</a>
				</div>
				<div class="main">
					<a href="<?php the_permalink();?>"><?php the_title();?></a>
					<a href="<?php the_permalink();?>" class="date"><?php echo get_the_date();?></a>
				</div>
			</div>
			<?php endwhile?>
			<?php endif?>
			<?php wp_reset_query();?>			
		</aside>
		
		<?php
			if ( is_active_sidebar('sidebar') ) {
				dynamic_sidebar('sidebar');
			}
		?>
	</div>
</div>