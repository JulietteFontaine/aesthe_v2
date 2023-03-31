<form class="site-search-form" method="get" id="form">
<div class="input">
  <?php include('wp-content/themes/aesthe/assets/img/loupe.svg'); ?> 
  <input type="text" value="<?php the_search_query() ?>" name="s" id="s" placeholder="Recherche par mots-clés">
</div>
  <button type="submit"><?php include('wp-content/themes/aesthe/assets/img/fleche-FFFFFF.svg'); ?>OK</button>
</form>