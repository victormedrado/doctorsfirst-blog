<?php 
/**
 * The template for displaying Search Results pages.
 *
 * @package Shape
 * @since Shape 1.0
 */

 get_header(); ?>
<section id="news" class="py-5">
	<div id="newsletter" class="container">
		<div class="row d-flex align-items-center">
			<div class="col-md-3 d-none d-md-block">
				
				<img src="<?php bloginfo('template_directory');?>/assets/img/news-img.png" class="img-fluid mx-4">
			</div>
			<div class="col-md-6 text-center my-3 my-md-0">
				<h2 class="mr-0 mr-md-4 mb-0">Cadastre-se e receba novidades!</h2>
			</div>
			<div class="col-md-3 my-3 my-md-0">
				<form class="news">
					<input type="text" class="form-control px-0" placeholder="E-mail">
					<button class="cadastrar">Cadastrar</button>
				</form>
			</div>
		</div>
	</div>
</section>
<section id="posts" class="pb-0 pb-lg-5">
	<div class="container">
		<div class="row">
			<?php $cont = 1; ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php $categories = wp_get_post_terms($post->ID, 'category');?>
            <?php  $category_link = get_category_link( $post->term_id );?>
            <?php if ( $cont == 1 ) { ?>
			<div class="col-lg-8 mb-5">
				<a href="<?php the_permalink() ?>">
					<div class="post">
						<?php the_post_thumbnail('full', array( 'class' => 'img-fluid' ) ); ?>
						<div class="date">
							<h5 class="mb-0 dia"><?php the_time('d') ?></h5>
							<p class="mb-0 mes"><?php the_time('M') ?></p>
						</div>
						<div class="post-footer">
							<div class="category">
								<h4 class="mb-0"><?php echo $categories[0]->name;?></h4>
							</div>
							<div class="post-title p-4">
								<h1 class="mb-0"><?php the_title(); ?></h1>
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
								<h1 class="mb-0"><?php the_title(); ?></h1>
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
								<h1 class="mb-0"><?php the_title(); ?></h1>
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
								<h1 class="mb-0"><?php the_title(); ?></h1>
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
								<h1 class="mb-0"><?php the_title(); ?></h1>
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
								<h1 class="mb-0"><?php the_title(); ?></h1>
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
						<?php the_post_thumbnail('full', array( 'class' => 'img-fluid' ) ); ?>
						<div class="date">
							<h5 class="mb-0 dia"><?php the_time('d') ?></h5>
							<p class="mb-0 mes"><?php the_time('M') ?></p>
						</div>
						<div class="post-footer">
							<div class="category">
								<h4 class="mb-0"><?php echo $categories[0]->name;?></h4>
							</div>
							<div class="post-title p-4">
								<h1 class="mb-0"><?php the_title(); ?></h1>
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
			<div class="col-12">
				<button class="btn-post">Ver mais</button>
			</div>
		</div>
	</div>
</section>
<section id="instagram">
	<div class="container py-5">
		<div class="row">
			<div class="col-12 text-center text-md-left">
				<h1><i class="fab fa-instagram mr-3"></i>Siga-nos no instagram <strong>@fmiligrama</strong></h1>
			</div>
			<script src="https://apps.elfsight.com/p/platform.js" defer></script>
			<div class="elfsight-app-df00f532-cef7-49fd-980c-0188a86720c8"></div>
		</div>
	</div>
</section>
<?php get_footer(); ?>