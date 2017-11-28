<?php namespace ProcessWire;
// SIMPLE EXAMPLE HOW TO USE HOOKS FROM => https://processwire.com/talk/topic/17195-customise-ckeditor-toolbar-per-role/
// $this->addHookBefore('Field(name=body)::getInputfield', function(HookEvent $event) {
// $field = $event->object;
// Define toolbar for a particular role
// if($this->user->hasRole('editor')) $field->toolbar = 'Format, Bold, Italic, -, NumberedList, BulletedList, Outdent, Indent';
// });

$wire->addHook('Page::summarize', function($event) {
    
      $fieldName = $event->arguments(0);
      if(!$fieldName) throw new WireException("No field provided");
    
      // get max length or use 300 as default if none provided
      $maxLength = (int) $event->arguments(1);
      if(!$maxLength) $maxLength = 300;
    
      $page = $event->object;
      $value = $page->get($fieldName);
    
      if(!strlen($value)) {
        // requested value is blank, nothing more to do
        $event->return = '';
        return;
      }
    
      // get beginning of value, without any HTML in it (if any)
      $value = mb_substr(strip_tags($value), 0, $maxLength);
    
      // if output formatting on, make sure value is entity encoded
      if($page->of()) $value = $event->sanitizer->entities1($value);
    
      if(strlen($value) >= $maxLength) {
        // limit length of returned value between words
        // by truncating to the last space character
        $value = substr($value, 0, strrpos($value, ' '));
        // append an ellipsis to indicate there is more
        $value .= '&hellip;';
      }
    
      $event->return = $value;
    });

/** @var ProcessWire $wire */

/**
 * Example of a custom hook method
 * 
 * This hook adds a “numPosts” method to pages using template “category”.
 * The return value is the quantity of posts in category.
 *
 * Usage:
 * ~~~~~
 * $numPosts = $page->numPosts(); // returns integer
 * numPosts = $page->numPosts(true); // returns string like "5 posts"
 * ~~~~~
 *
 */
    $wire->addHook('Page(template=category)::numPosts', function($event) {
        /** @var Page $page */
        $page = $event->object;
    
        // only category pages have numPosts
        if($page->template != 'category') return;
    
        // find number of posts
        $numPosts = $event->pages->count("template=blog-post, categories=$page");
    
        $event->return = $numPosts;
    }); 
    
    $wire->addHook('Page(template=author)::numPostsAuth', function($event) {
        /** @var Page $page */
        $page = $event->object;
    
        // only authors pages have numPosts
        if($page->template != 'author') return;
    
        // find number of posts
        $numPosts = $event->pages->count("template=blog-post, authors=$page");
    
        $event->return = $numPosts;
    }); 