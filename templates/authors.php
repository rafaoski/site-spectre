<?php namespace Processwire;?>

<div id='body' pw-append>

<div class="columns container">

<?php 
$items = $page->children("limit=22");
foreach ($items as $author) {
    $img = count($author->images) ? "<img src='{$author->images->first->width('260')->url}' alt='{$author->name}'>" : '';
// numPostsAuth() => _ready.php
    $data_badge = $author->numPostsAuth(true);
    $d_initial = $sanitizer->text($author->title,['maxLength' => 2]);

echo "<a class='p-2 m-2' href='{$author->url}'>
    <div class='chip m-2'>
        <figure class='avatar avatar-xl badge' data-badge='{$data_badge}' 
                data-initial='{$d_initial}' style='background-color: #5755d9;'>{$img}</figure> 
        {$author->title}
    </div>
</a>";

} 

?>

</div>

<?php echo pagination($items);?>

</div><!-- /#body -->

<div id='sidebar' pw-append>
    <?php 
        $list = pages()->get(1)->children("limit=12");
        echo listChild( $list, __('Show More Pages'), 'icon icon-share' );
    ?>
</div>