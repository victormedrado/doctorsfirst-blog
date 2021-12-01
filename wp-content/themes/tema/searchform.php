<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<input type="text" class="search" name="s" value="<?php echo get_search_query(); ?>">
	<input type="submit" class="searchsubmit" name="submit" value="Procurar">
</form>