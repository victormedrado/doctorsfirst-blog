<?php get_header(); ?>

<?php $categories = wp_get_post_terms($post->ID, 'category');?>
<?php  $category_link = get_category_link( $post->term_id );?>

<section id="post">
	
	<div class="container py-5">
		
		<div class="row">
			
			<div class="col-md-7 offset-2">
				
				<h1 class="title"><?php the_title(); ?></h1>

			</div>

		</div>

	</div>

	<div class="container post-content pb-5">
		
		<div class="row">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
			<div class="col-md-2 order-2 order-md-0">
				
				<div class="post-date">
					
					<h5>Postado dia</h5>
					<p><?php the_time('d/M') ?></p>

					<h5>Em</h5>
					<p><?php echo $categories[0]->name;?></p>

				</div>

			</div>

			<div class="col-md-7">
				
				<?php the_post_thumbnail('full', array( 'class' => 'img-fluid mb-5' )); ?>

				<?php the_content(); ?>

			</div>

			<div class="col-md-3 barra-lateral order-3 order-md-0">
				
				<div class="search p-4 mb-4 mb-md-0">
					
					<h3>Pesquisar</h3>

					<?php get_search_form(); ?>

				</div>

				<div class="banner-lateral py-4 d-none d-md-block d-flex justify-content-center">

					<a href="https://www.fmiligrama.com.br/" target="_blank">
						<img src="<?php bloginfo('template_directory');?>/assets/img/banner-lateral.jpg" class="img-fluid">
					</a>

				</div>

				<div class="categorias p-4 d-flex flex-column">
					
					<h3>Categorias</h3>

					<?php wp_list_categories(array('title_li' => '', 'exclude' => array( 1 ) )) ?>

				</div>

				<div class="new my-4 p-4">
					
					<h3>Newsletter</h3>

					<?php echo do_shortcode('[contact-form-7 id="1742" title="Newsletter Single"]') ?>

				</div>

				<div class="recente p-4 d-none d-md-block">
					
					<h3 class="mb-0">Recentes</h3>

					<?php 
					// the query
					$the_query = new WP_Query( array( 'posts_per_page' => 3 ) ); ?>
					 
					<?php if ( $the_query->have_posts() ) : ?>
					 
				    <!-- pagination here -->
				 
				    <!-- the loop -->
				    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

					<a href="<?php the_permalink() ?>">
						
						<div class="d-flex align-items-center py-3">
							
							<?php
							$thumb_id = get_post_thumbnail_id();
							$thumb_url = wp_get_attachment_image_src($thumb_id,'50x50', true);
							?>
							<img src="<?php echo $thumb_url[0]; ?>" alt="" class="img-fluid mr-3">

							<div>
								
								<p class="mb-2"><?php the_title(); ?></p>

								<p class="mb-0"><?php the_time('d/M/Y') ?></p>

							</div>

						</div>
						
					</a>

					<?php endwhile?>
					<?php else: ?>
					<?php endif; ?>

				</div>

			</div>

			<?php endwhile?>
			<?php else: ?>
			<?php endif; ?>

		</div>

	</div>

</section>

<section id="leia-tambem">
	
	<div class="container">

		<div class="row">

			<div class="col-12 text-center text-md-left">

				<h2>Leia Também</h2>

			</div>

		</div>

		<div class="row pt-5">

			<?php
	        $args = array('post_type' => 'post', 'order' => 'DESC', 'posts_per_page' => 3);
	        $wp_query = new WP_Query($args);
	        if(have_posts()):
	        while ($wp_query -> have_posts()) : $wp_query -> the_post();?>
			
			<div class="col-lg-4 mb-5">
				<a href="<?php the_permalink() ?>">
					<div class="post">
						<?php
						$thumb_id = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src($thumb_id,'350x395', true);
						?>
						<img src="<?php echo $thumb_url[0]; ?>" alt="" class="img-fluid">
						<div class="date">
							<h5 class="mb-0 dia"><?php the_time('d') ?></h5>
							<p class="mb-0 mes"><?php the_time('M') ?></p>
						</div>
						<div class="post-footer">
							<div class="category">
								<h4 class="mb-0"><?php echo $categories[0]->name;?></h4>
							</div>
							<div class="post-title p-4">
								<h2 class="mb-0"><?php the_title(); ?></h2>
								<div class="post-description">
									<p><?php the_excerpt(); ?></p>
									<button class="btn-post">Continue lendo</button>
								</div>
							</div>
							<div class="like">
								<a href="<?php the_permalink() ?>"><i class="far fa-heart"></i></a>
							</div>
						</div>
					</div>
				</a>
			</div>

			<?php endwhile?>
			<?php else: ?>
			<?php endif; ?>

		</div>

	</div>

</section>

<?php get_footer(); ?>