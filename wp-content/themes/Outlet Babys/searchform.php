<form action="<?php bloginfo('siteurl') ?>" method="get">
	<input type="hidden" value="post" name="post_type" id="post_type" />
	<input type="search" name="s" class="form-control" placeholder="Busque no Blog" value="<?php the_search_query(); ?>">
	<button><i class="fas fa-search"></i></button>
</form>