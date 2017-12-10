<?php namespace Processwire;?>

<div id='body'>

<div class="container">

  <div class="columns">

    <div class="column col-5 col-lg-12">
        <a href="<?=page()->images->first->url?>">
            <img class='img-responsive' src="<?=page()->images->first->url?>" alt="<?=page()->name?>"> 
        </a>
    </div>

    <div class="column col-7 col-lg-12">
        <?= page()->body; ?>
    </div>

  </div>

<?php if(page()->txt_1): ?>
    <div class="portfolio-youtobe px-2rem my-2">
        <?= lazyYoutobe('txt_1')?>
    </div>
    <br>
<?php endif; ?>  

</div>

</div><!-- /#body -->

<div id='sidebar' pw-append>
    <?php 
        $list = pages()->get('/portfolios/')->children("limit=12");
        echo listChild( $list, __('Show More Portfolios'), 'icon icon-share' );
    ?>
</div>