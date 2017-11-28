<?php namespace Processwire; 
if($options->txt_1){ echo "<meta property='og:site_name' content='{$options->txt_1}'/>\n\t";}?>
<meta property="og:url" content="<?=page()->httpUrl?>" />
    <meta property="og:type" content="website" /> 
    <meta property="og:title" content="<?=page()->headline ? page()->headline : page()->title;?>" />
<?php if(page()->summary) : ?>
    <meta property="og:description" content="<?=page()->summary?>">
<?php endif; ?>
<?php if (count(page()->images) ) : ?>
    <meta property="og:image" content="<?=page()->images->first->httpUrl();?>" />
<?php endif; ?>