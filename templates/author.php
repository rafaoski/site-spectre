<?php namespace Processwire;?>

<div id='body' pw-append>

<?php
  $items = pages()->get('/blog/')->children("authors=$page, limit=12");
  echo blogPosts($items);
  echo pagination($items);
?>
  
</div><!-- /#body -->

<div id='sidebar' pw-append>
    <?php 
        $list = pages()->get('/categories/')->children("limit=12");
        echo listChild( $list, __('Categories'), 'icon icon-apps' );
    echo '</br>';
        $list = pages()->get('/authors/')->children("limit=12");
        echo listChild( $list, __('All Authors'), 'icon icon-apps' );
    ?>
</div>