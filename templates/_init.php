<?php namespace ProcessWire;

/**
 * This _init.php file is called automatically by ProcessWire before every page render
 * 
 */

/** @var ProcessWire $wire */
// PAGE OPTIONS
$options = pages()->get('/options/');

// CUSTOM PAGE OPTIONS 
$opt_p = page()->custom_options;
// DISABLE ENABLE SIDEBAR
$dis_sid = $opt_p ? $opt_p->get("name=disable-sidebar") : '';
// GLOBAL SIDEBAR
$gl_sid = $opt_p ? $opt_p->get("name=enable-global-sidebar") : '';

// RSS FEED BLOG PAGE
if($page->id == 1037 && $input->urlSegment1 == 'rss') {
    $rss = $modules->get("MarkupRSS");
    $rss->render($page->children("limit=12"));
die();
}

include_once('./_func.php'); 