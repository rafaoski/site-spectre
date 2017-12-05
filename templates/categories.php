<?php namespace Processwire;?>

<div id='body' pw-append>

<div class="columns container">

<?php 
$items = $page->children("limit=22");
foreach ($items as $category) {
$img = count($category->images) ? "<img src='{$category->images->first->width('260')->url}' alt='{$category->name}'>" : '';
    $data_badge = $category->numPosts(true);
    $d_initial = $sanitizer->text($category->title,['maxLength' => 2]);

echo "<a class='p-2 m-2' href='{$category->url}'>
    <div class='chip m-2'>
        <figure class='avatar avatar-xl badge' data-badge='{$data_badge}' 
                data-initial='{$d_initial}' style='background-color: #5755d9;'>{$img}</figure>
        {$category->title}
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