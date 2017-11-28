<?php namespace Processwire;?>

<div id='body' pw-append>

<?php
  $items = pages()->get('/blog/')->children("categories=$page, limit=12");
  echo blogPosts($items);
  echo pagination($items);
?>
  
</div><!-- /#body -->

<div id='sidebar' pw-append>
    <?php 
        $list = pages()->get('/categories/')->children("limit=12");
        echo listChild( $list, __('Categories'), 'icon icon-apps' );
    ?>
</div>