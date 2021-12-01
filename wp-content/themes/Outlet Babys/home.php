<?php
/*
/ Template name: Home
*/
?>
<?php get_header(); ?>
<section id="banner">
			
			<div id="carouselExampleControls" class="carousel slide d-none d-lg-block" data-ride="carousel">
				<div class="carousel-inner">
					<?php
					$banner_cont = 1;
					$acti = "";
					if( have_rows('banner') ):
					while ( have_rows('banner') ) : the_row();?>
						<?php if ($banner_cont == 1){ ?>
							<?php $acti = "active"; ?>
						<?php }else{
							$acti = "";
						}; ?>
					<div class="carousel-item <?php echo $acti ?>">
						<a href="<?php the_sub_field('banner_link'); ?>">
							<img src="<?php the_sub_field('banner_desktop'); ?>" class="d-block w-100">
						</a>
					</div>
					<?php
					$banner_cont++;
					endwhile;endif;
					?>
				</div>
				<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
	
	<div id="carouselExampleControls" class="carousel slide d-md-none" data-ride="carousel">
				<div class="carousel-inner">
					<?php
					$banner_cont = 1;
					$acti = "";
					if( have_rows('banner') ):
					while ( have_rows('banner') ) : the_row();?>
						<?php if ($banner_cont == 1){ ?>
							<?php $acti = "active"; ?>
						<?php }else{
							$acti = "";
						}; ?>
					<div class="carousel-item <?php echo $acti ?>">
						<a href="<?php the_sub_field('banner_link'); ?>">
							<img src="<?php the_sub_field('banner_mobile'); ?>" class="d-block w-100">
						</a>
					</div>
					<?php
					$banner_cont++;
					endwhile;endif;
					?>
				</div>
				<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</section>
<section id="posts" class="py-5">
	<div class="container">
		<div class="row">
			<?php $cont = 1; ?>
			<?php
	        $args = array('post_type' => 'post', 'order' => 'DESC', 'posts_per_page' => 7);
	        $wp_query = new WP_Query($args);
	        if(have_posts()):
	        while ($wp_query -> have_posts()) : $wp_query -> the_post();?>
			<?php $categories = wp_get_post_terms($post->ID, 'category');?>
            <?php  $category_link = get_category_link( $post->term_id );?>
            <?php if ( $cont == 1 ) { ?>
			<div class="col-lg-8 mb-5">
				<a href="<?php the_permalink() ?>">
					<div class="post">
						<?php
						$thumb_id = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src($thumb_id,'730x395', true);
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
								<h3 class="mb-0"><?php the_title(); ?></h3>
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
			<?php $cont++ ?>
			<?php } elseif ($cont == 2) { ?>
			<div class="col-lg-4 mb-5">
				<a href="<?php the_permalink() ?>">
					<div class="post">
						<?php
						$thumb_id = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src($thumb_id,'350x395', true);
						?>
						<img src="<?php echo $thumb_url[0]; ?>" alt="" class="img-fluid w-100">
						<div class="date">
							<h5 class="mb-0 dia"><?php the_time('d') ?></h5>
							<p class="mb-0 mes"><?php the_time('M') ?></p>
						</div>
						<div class="post-footer">
							<div class="category">
								<h4 class="mb-0"><?php echo $categories[0]->name;?></h4>
							</div>
							<div class="post-title p-4">
								<h3 class="mb-0"><?php the_title(); ?></h3>
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

			<?php $cont++ ?>
			<?php } elseif ($cont == 3) { ?>
			
			<div class="col-lg-4 mb-5">
				<a href="<?php the_permalink() ?>">
					<div class="post">
						<?php
						$thumb_id = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src($thumb_id,'350x395', true);
						?>
						<img src="<?php echo $thumb_url[0]; ?>" alt="" class="img-fluid w-100">
						<div class="date">
							<h5 class="mb-0 dia"><?php the_time('d') ?></h5>
							<p class="mb-0 mes"><?php the_time('M') ?></p>
						</div>
						<div class="post-footer">
							<div class="category">
								<h4 class="mb-0"><?php echo $categories[0]->name;?></h4>
							</div>
							<div class="post-title p-4">
								<h3 class="mb-0"><?php the_title(); ?></h3>
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

			<?php $cont++ ?>
			<?php } elseif ($cont == 4) { ?>

			<div class="col-lg-4 mb-5">
				<a href="<?php the_permalink() ?>">
					<div class="post">
						<?php
						$thumb_id = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src($thumb_id,'350x395', true);
						?>
						<img src="<?php echo $thumb_url[0]; ?>" alt="" class="img-fluid w-100">
						<div class="date">
							<h5 class="mb-0 dia"><?php the_time('d') ?></h5>
							<p class="mb-0 mes"><?php the_time('M') ?></p>
						</div>
						<div class="post-footer">
							<div class="category">
								<h4 class="mb-0"><?php echo $categories[0]->name;?></h4>
							</div>
							<div class="post-title p-4">
								<h3 class="mb-0"><?php the_title(); ?></h3>
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

			<?php $cont++ ?>
			<?php } elseif ($cont == 5) { ?>

			<div class="col-lg-4 mb-5">
				<a href="<?php the_permalink() ?>">
					<div class="post">
						<?php
						$thumb_id = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src($thumb_id,'350x395', true);
						?>
						<img src="<?php echo $thumb_url[0]; ?>" alt="" class="img-fluid w-100">
						<div class="date">
							<h5 class="mb-0 dia"><?php the_time('d') ?></h5>
							<p class="mb-0 mes"><?php the_time('M') ?></p>
						</div>
						<div class="post-footer">
							<div class="category">
								<h4 class="mb-0"><?php echo $categories[0]->name;?></h4>
							</div>
							<div class="post-title p-4">
								<h3 class="mb-0"><?php the_title(); ?></h3>
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

			<?php $cont++ ?>
			<?php } elseif ($cont == 6) { ?>

			<div class="col-lg-4 mb-5">
				<a href="<?php the_permalink() ?>">
					<div class="post">
						<?php
						$thumb_id = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src($thumb_id,'350x395', true);
						?>
						<img src="<?php echo $thumb_url[0]; ?>" alt="" class="img-fluid w-100">
						<div class="date">
							<h5 class="mb-0 dia"><?php the_time('d') ?></h5>
							<p class="mb-0 mes"><?php the_time('M') ?></p>
						</div>
						<div class="post-footer">
							<div class="category">
								<h4 class="mb-0"><?php echo $categories[0]->name;?></h4>
							</div>
							<div class="post-title p-4">
								<h3 class="mb-0"><?php the_title(); ?></h3>
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

			<?php $cont++ ?>
			<?php } elseif ($cont == 7) { ?>

			<div class="col-lg-8 mb-5">
				<a href="<?php the_permalink() ?>">
					<div class="post">
						<?php
						$thumb_id = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src($thumb_id,'730x395', true);
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
								<h3 class="mb-0"><?php the_title(); ?></h3>
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
			<?php } ?>
			<?php endwhile?>
			<?php else: ?>
			<?php endif; ?>
			<?php wp_reset_query();?>
			<!-- <div class="col-12">
				<button class="btn-post">Ver mais</button>
			</div> -->
		</div>
	</div>
</section>
<section id="news">
	<div id="newsletter" class="container">
		<div class="row d-flex align-items-center">
			<div class="col-md-3 d-none d-md-flex justify-content-center">
				<img src="<?php bloginfo('template_directory');?>/assets/img/news-img.png" class="img-fluid">
			</div>
			<div class="col-md-6 text-center my-3 my-md-0">
				<h2 class="mr-0 mr-md-4 mb-0">Cadastre-se e receba novidades!</h2>
			</div>
			<div class="col-md-3 my-3 my-md-0">
				<?php echo do_shortcode('[contact-form-7 id="1741" title="Newsletter Home"]') ?>
			</div>
		</div>
	</div>
</section>
<section id="instagram">
	<div class="container py-5">
		<div class="row">
			<div class="col-12 text-center text-md-left">
				<h2><i class="fab fa-instagram mr-3"></i>Siga-nos no instagram <strong>@fmiligrama</strong></h2>
			</div>
			<script src="https://apps.elfsight.com/p/platform.js" defer></script>
			<div class="elfsight-app-df00f532-cef7-49fd-980c-0188a86720c8"></div>
		</div>
	</div>
</section>
<?php get_footer(); ?>