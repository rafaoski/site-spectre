<?php namespace Processwire; ?>

<div id='body' pw-prepend>
<?php 
	$maxDepth = 4; 
	renderNavTree($pages->get('/'), $maxDepth); 
	// see the _init.php for the renderNavTree function
?>
</div>