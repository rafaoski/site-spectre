<?php namespace Processwire;?>

<div id='body' pw-append>

<?php if(page()->txt_1): ?>
    <div class="home-youtobe px-2rem">
        <?= lazyYoutobe('txt_1')?>
    </div>
    <br>
<?php endif; ?>

<h3 class='mt-2 text-uppercase'>
        <i class="fa fa-book" aria-hidden="true"></i>
            <?= __('Browse the site');?>
</h3>

    <div id='content-images' class='cont-img columns col-gapless'>
       <?php echo parallaxImage($page->children("limit=3, images.count>0, name!=sitemap|contact"));?>
    </div><!-- /#content-images -->

<br>

<?php $items = $pages->get('/portfolios/')->children("limit=2,images.count>0, sort=random"); ?>
    <h3 class='mt-2 text-uppercase'>
        <a href="<?=$items[0]->parent->url?>">
            <i class="fa fa-free-code-camp" aria-hidden="true"></i>
                <?= __('See our portfolio');?> <i class="fa fa-share" aria-hidden="true"></i>
        </a>
    </h3>
    
<?= basicCard($items, 'col-6 col-sm-12'); ?>

</div><!-- /#body -->