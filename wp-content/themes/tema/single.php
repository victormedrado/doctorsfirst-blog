<?php get_header();?><div id="content">	<div id="content-core">		<?php			if(have_posts()):			while ($wp_query -> have_posts()) : $wp_query -> the_post(); ?> <?php wpb_set_post_views(get_the_ID()); ?>		<div id="main">			<div id="intro" class="option1">				<div id="intro-core">					<h1 class="page-title">					<span><?php the_title();?></span>					</h1>					<div id="breadcrumbs">						<div id="breadcrumbs-core">							<?php wp_custom_breadcrumbs(); ?>						</div>					</div>				</div>			</div>			<div id="main-core">				<header class="entry-header entry-meta">					<span class="author">						<i class="icon-pencil"></i>Por: <?php the_author_link(); ?>					</span>					<span class="date">						<i class="icon-calendar-empty"></i><?php echo get_the_date();?>					</span>					<?php						$categoria = get_the_category();						$nomeCategoria = $categoria[0]->cat_name;						$slugCategoria = $categoria[0]->category_nicename;					?>					<span class="category">						<i class="icon-folder-open"></i>						<a href="<?php bloginfo('url'); ?>/<?php echo $slugCategoria;?>" rel="category tag"><?php echo $nomeCategoria;?></a>					</span>					<span class="tags">						<i class="icon-tags"></i>						<?php the_tags();?>					</span>					</header><!-- .entry-header -->					<div class="entry-content">						<?php the_post_thumbnail();?>						<br>						<?php the_content();?>						</div><!-- .entry-content -->												<nav role="navigation" id="nav-below">							<div class="nav-previous">								<?php previous_post( '%', '&laquo; ', 'yes' ); ?>								<!-- <a href="http://www.nutridirect.com.br/blog/comer-de-forma-saudavel-fora-de-casa/" rel="prev"><span class="meta-icon"><i class="icon-angle-left icon-large"></i></span>									<span class="meta-nav">Comer de forma saudável fora de casa é possível</span>							</a> -->						</div>						<div class="nav-next">							<?php next_post('%', '', 'yes') ?>							<!-- <a href="http://www.nutridirect.com.br/blog/graos-milagrosos-para-a-saude/" rel="next">									<span class="meta-nav">Grãos milagrosos para a saúde</span>									<span class="meta-icon"><i class="icon-angle-right icon-large"></i></span>							</a> -->						</div>												</nav><!-- #nav-below -->						</div><!-- #main-core -->					</div>					<?php endwhile; else:?>					<?php endif;?>					<?php get_template_part('sidebar');?>									</div>				</div><!-- #content -->				<?php get_footer();?>