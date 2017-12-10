<?php namespace Processwire;?>

<div id='body'>

 <h3>
     <?=page()->title?> 
        <small class='label'> <i class="fa fa-calendar"></i> <?=page()->date?></small>
</h3>

<?php if(count(page()->images)): ?>
    <a href="<?=page()->images->first->url?>">
        <img class='centered mt-2 mb-2 img-responsive px-2rem' src="<?=page()->images->first->url?>" alt="<?=page()->name?>">
    </a>
<?php endif; ?>

<ul class='tab category-list ml-2'>
    <li class='icon icon-apps m-2'></li>
        <?php 
            echo page()->categories->each(
                "<li class='tab-item'><a href='{url}'>{title}</a></li>"
            ); ?>

        <li class="icon icon-people m-2"></li>

        <?php
            echo page()->authors->each(
                "<li class='tab-item'><a href='{url}'>{title}</a></li>"
            );

           echo "<li class='mb-2'>" . countComments($page, $options) . "</li>";
        ?>
        
</ul>


<?php 
// SHARE BUTTONS
echo toAny();
// Page Body
echo page()->body;

// Youtobe Video
 if(page()->txt_1): ?>
<div class="home-youtobe px-2rem">
    <?= lazyYoutobe('txt_1')?>
</div>
<br>
<?php endif;

// PAGE COMMENTS
if(page()->check_1 == false && $options->check_1 == false) echo commentsPagination();
?>

</div><!-- /#body -->

<div id='sidebar' pw-append>
<?php 
        $list = pages()->get('/categories/')->children("limit=12");
        echo listChild( $list, __('Categories'), 'icon icon-apps' );
    echo '<br>';
        $list = pages()->get('/authors/')->children("limit=12");
        echo listChild( $list, __('Authors'), 'icon icon-people' );
?>
</div>

<pw-region id="bottom-region">
  <?php if(page()->comments): ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="<?=urls()->FieldtypeComments?>comments.css">
    <script defer src='<?=urls()->FieldtypeComments?>comments.min.js'></script>
    <script defer src="https://static.addtoany.com/menu/page.js"></script>
  <?php endif; ?>
</pw-region>