<?php
/**
 * Template part content filter listing repositories
 */
?>

<section class="alignwide" id="wpr">
	<div class="entry-content">
      <form role="search" class="search-form">
			  <label for="filter"><?php _e( 'Repositório', 'twentytwentyone' ); ?></label>
			  <input type="search" id="filter" class="search-field" value="<?=$_GET['q']?>" name="q" onkeyup="getRepositories()" />
		</form>
	</div>

	<div class="wpr-content" id="wpr_listing"></div>
		
</section>
