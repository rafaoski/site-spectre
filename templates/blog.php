<?php namespace Processwire;?>

<div id='body' pw-append>

<?php 
$items = $page->children("limit=12");

  echo blogPosts($items);

  echo pagination($items);
?>

</div><!-- /#body -->

<div id='sidebar' pw-append>
<?php 
    echo '<hr>';
        $list = pages()->get('/categories/')->children("limit=12");
        echo listChild( $list, __('Categories'), 'icon icon-apps' );
    echo '<br>';
        $list = pages()->get('/authors/')->children("limit=12");
        echo listChild( $list, __('Authors'), 'icon icon-people' );
?>
</div>