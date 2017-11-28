<?php namespace Processwire;?>

<div id='body' pw-append>

    <div id='content-images' class='cont-img columns'>
        <?php echo imageChildren($page->children);?>       
    </div><!-- /#content-images -->

</div><!-- /#body -->