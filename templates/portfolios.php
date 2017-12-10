<?php namespace Processwire;?>

<div id='body'>

<div class="columns">

<?php
$items = $page->children("limit=12");
echo simpleCard($items, $col = 'col-6 col-sm-12')
?>
</div>

<?php echo pagination($items);?>

</div><!-- /#body -->