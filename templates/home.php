<?php namespace Processwire;?>

<div id='body' pw-append>

    <div id='content-images' class='cont-img columns col-gapless'>
       <?php echo parallaxImage($page->children("limit=3, images.count>0"));?>
    </div><!-- /#content-images -->

<?php $items = $pages->get('/blog/')->children("limit=6,images.count>0, sort=-date"); ?>
    <h3 class='mt-2 text-uppercase'>
        <a href="<?=$child[0]->parent->url?>">
            <i class="fa fa-free-code-camp" aria-hidden="true"></i>
                <?= __('Show Latest Posts');?>
        </a>
    </h3>
<?= basicCard($items, 'col-6 col-sm-12'); ?>

</div><!-- /#body -->