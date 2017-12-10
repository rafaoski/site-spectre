<?php namespace Processwire;?>

<div id='body' pw-append>

<?php if(page()->txt_1): ?>
    <div class="page-youtobe px-2rem">
        <?= lazyYoutobe('txt_1')?>
    </div>
    <br>
<?php endif; ?>

<?php if(page()->hasChildren): ?>
<h3 class='mt-2 text-uppercase'>
        <i class="fa fa-free-code-camp" aria-hidden="true"></i>
            <?= __('Show More Pages');?>
</h3>

    <div id='content-images' class='cont-img columns'>
        <?php echo imageChildren($page->children("limit=3, images.count>0"));?>
    </div><!-- /#content-images -->
<?php endif; ?>

</div><!-- /#body -->