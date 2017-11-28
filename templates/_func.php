<?php namespace Processwire;

/**
 * @param string $class
 */
function searchForm($class = '') {
	$l_search = __('Search');
	$action = pages()->get('template=search')->url;
		return "<!-- search form -->
			<form class='{$class} search input-group input-inline p-2' action='{$action}' method='get'>
				<input class='form-input' type='text' name='q' id='search' placeholder='Search' value='' required>
				<button type='submit' name='submit' class='hide-md btn btn-primary input-group-btn'>{$l_search}</button>
			</form>";
	}

/**
* @param  Page $page
*/
	function breadCrumb($page) {
		$out = '';
		// breadcrumbs are the current page's parents
		foreach($page->parents() as $item) {
			$out .= "<li class='breadcrumb-item'><a href='$item->url'>$item->title</a></li>"; 
		}
		// optionally output the current page as the last item
			$out .= "<li class='text-bold breadcrumb-item'>$page->title</li> 
			         <li class='fa fa-eercast' aria-hidden='true'></li>"; 
		echo $out;
	}

/**
* @param  Page $page
*/
	function pageEdit($page) {
		if($page->editable()) {
			$edit = page()->editUrl;
			return "<a class='m-2 btn' href='{$edit}'>Edit</a>";
		}
	}

/**
 * Given a group of pages, render a simple <ul> navigation
 * This is here to demonstrate an example of a simple shared function.
 * Usage is completely optional.
 * @param PageArray $items
 */
function basicNav(PageArray $items, $page_child = []) {
// $page_child = ['blog'];

if(!$items->count()) return '';
$out = '';
// GET OTHER PAGES
	foreach($items as $item) {
		$item->id == wire('page')->id ? $class = 'btn bg-primary text-light' : $class = 'btn btn-link';
		if(!in_array($item->name, $page_child) || $item->id == 1) {
			// markup for the link
			$out .= "<a class='$class mr-1' href='$item->url'>$item->title</a>\n";
		} else {
			$out .= "\n<div class='dropdown mr-1 basic-nav'>
			  <div class='btn-group'>
				<a href='{$item->url}' class='$class'>
				    {$item->title}
				</a>\n
				<a href='#' class='btn dropdown-toggle' tabindex='0'>
				  <i class='icon icon-caret'></i>
				</a>
				<!-- menu component -->
				<ul class='menu drop'>\n";
				foreach ($item->children("limit='6'") as $child) {
					$out .= "\n<li><a href='{$child->url}'>{$child->title}</a></li>\n";
				}
		   $out .="</ul>
			  </div>
			</div>";
		}
	}
 echo $out;
}

/**
 * Given a group of pages, render a simple <ul> navigation
 * This is here to demonstrate an example of a simple shared function.
 * Usage is completely optional.
 * @param PageArray $items
 */
function mobileNav(PageArray $items, $page_child = []) {
    $out = '';
    $out .= "\n<ul class='mobile-nav nav'>\n\n";
    if(!$items->count()) return '';

    // GET OTHER PAGES
        foreach($items as $item) {
			$item->id == wire('page')->id ? $class = 'active' : $class = 'nav-item';
			if(!in_array($item->name, $page_child) || $item->id == 1) {
            // markup for the link
			$out .= "<li class='$class'><a href='{$item->url}'>{$item->title}</a></li>\n";
			} else {
	$out .="\n<li class='nav-item $class'>";
    $out .="\n<a href='{$item->url}'>{$item->title}</a>";
	$out .="\n\n<ul class='nav'>\n";
					foreach ($item->children("limit='6'") as $child) {
						$child->id == wire('page')->id ? $class = 'active' : $class = 'nav-item';
						$out .= "<li class='$class'>";
						$out .= "<a href='{$child->url}'>{$child->title}</a>";
						$out .= "</li>\n";
					}
	$out .= "</ul>";
	$out .= "\n\n</li>";
			}
        }
    $out .= "\n</ul><!-- /.mobile-nav -->";
    return $out;
}

/**
 * Given a group of pages render a tree of navigation
 * @param Page|PageArray $items Page to start the navigation tree from or pages to render
 * @param int $maxDepth How many levels of navigation below current should it go?
 */
function renderNavTree($items, $maxDepth = 3) {
	
		// if we've been given just one item, convert it to an array of items
		if($items instanceof Page) $items = array($items);
	
		// if there aren't any items to output, exit now
		if(!count($items)) return;
	
		// $out is where we store the markup we are creating in this function
		// start our <ul> markup
		echo "<ul class='nav'>";
	
		// cycle through all the items
		foreach($items as $item) {
	
			// markup for the list item...
			// if current item is the same as the page being viewed, add a "current" class and
			// visually hidden text for screen readers to it
			if($item->id == wire('page')->id) {
				echo "<li class='nav-item active'>";
			} else {
				echo "<li class='nav-item'>";
			}
	
			// markup for the link
			echo "<a href='$item->url'>$item->title</a>";
	
			// if the item has children and we're allowed to output tree navigation (maxDepth)
			// then call this same function again for the item's children 
			if($item->hasChildren() && $maxDepth) {
				renderNavTree($item->children, $maxDepth-1);
			}
	
			// close the list item
			echo "</li>";
		}
	
		// end our <ul> markup
		echo "</ul>";
	}

/**
 * @param Page $items Page Children to start the render pagination
 */
function pagination($items) {
	
		if($items->renderPager()) {
        $out = '';
			$out .= $items->renderPager(array(
				'nextItemLabel' => __('Next') . " &raquo;",
				'previousItemLabel' => "&laquo;" . __(' Previous'),
				'listMarkup' => "<ul class='pagination'>{out}</ul>",
				'itemMarkup' => "<li class='page-item'>{out}</li>",
				'separatorItemLabel' => " ... ",
				'linkMarkup' => "<a class='page-link' href='{url}'>{out}</a>",
				//CURRENT
				'currentLinkMarkup' => "<a class='bg-gray text-light' href='{url}'>{out}</a>",
			));
				return $out;
			}
		}

/**
 * @param string $options
 * SOCIAL PROFILES ( twitter,facebook,youtube, google-plus, 'rss' ) => USAGE:
 * echo socialProfiles($options->txtarea_1)
 */
function socialProfiles($options) {
	
		if($options) {
		  $profile = explode(",", $options);
		  $soc = ['twitter','facebook','youtube','plus','pinterest',
		          'linkedin','tumblr','medium','instagram','rss','@'];
		  $out = '';
	// START LISTS
	$out .= "\n\n<ul class='nav social-profile'>\n";
	
	foreach ($profile as $key) {
	
		for($i=0; $i<count($soc); $i++) {
	
			if (strpos(strtolower($key), $soc[$i]) !== false) {
				if($soc[$i] == 'rss') $key = pages()->get("/blog/")->httpUrl.'rss';
				if($soc[$i] == 'plus') $soc[$i] = 'google-plus';
				if($soc[$i] == '@') {
					$soc[$i] = 'envelope-open-o';
					$key = 'mailto:'.$key;
				}
					$out .= "\n\t<li>
					\n\t<li class='nav-item'><a href='$key' target='_blank'>
					\n\t\t<i class='px-2 fa fa-$soc[$i] fa-2x' aria-hidden='true'></i>
					\n\t</a>
					\n\t</li>\n";
			}
		}
	
	}
		  $out .= "</ul>\n";
		  return $out;
	
			} else {
				return '<h2>' . __('Add Some Social Profile Url') . '</h2>';
			}
	}

/**
 * @param Page $items Page Children to start the render images
 */
function imageChildren($items) {
	$out = '';
	foreach ($items as $children) {
		if(count($children->images)) {
			$out .= "\n<a class='tooltip column col-4 col-sm-12 col-md-6 text-center' "; 
			$out .= "href='{$children->url}' ";
			$out .= "data-tooltip='{$children->title}'>\n";
			$out .= "\t<img class='img-responsive d-inline-block p-1' src='{$children->images->first->url}' ";
			$out .= "width='300' "; 
			$out .= "height='300' "; 
			$out .= "alt='{$children->name}'>\n";
			$out .= "</a>\n";
	} 
}
	return $out;
}

/**
 * @param Page $items Page Children to start the render images
 */
function parallaxImage($items) {
	$out = '';
	foreach ($items as $children) {
		if(count($children->images)) {
		$out .= "\n<a class='tooltip column col-4 col-sm-12 col-md-6' "; 
		$out .= "href='{$children->url}' ";
		$out .= "data-tooltip='{$children->title}'>\n";
		$out .= "<div class='parallax m-1'>
		     <div class='parallax-top-left'></div>
		     <div class='parallax-top-right'></div>
		     <div class='parallax-bottom-left'></div>
		     <div class='parallax-bottom-right'></div>
		     <div class='parallax-content'>
		     <div class='parallax-front'></div>
		     <div class='parallax-back text-center'>";
			$out .="<img src='{$children->images->first->url}' class='img-responsive centered rounded d-block p-1' alt='{$children->name}'>";
		$out .="</div>
	        </div>
	      </div>
	    </a>\n";
	}
} 
	return $out;
}

// COMMENTS WITH PAGINATION => USAGE => echo commentsPagination();
function commentsPagination() {
	
			if (page()->comments) {
		$comm = '';
	
				$limit = 12;
				$start = (input()->pageNum - 1) * $limit;
				$comments = page()->comments->slice($start, $limit);
	
				$comm .= $comments->render(array(
				 'headline' => "<h3 class=''>" . __('Comments') . "</h3>",
				 'commentHeader' => __('Added ') . '{cite}' . __(' in day') . ' {created} {stars} {votes}',
				 'dateFormat' => 'm/d/y - H:i',
				 'encoding' => 'UTF-8',
				//  'admin' => false, // shows unapproved comments if true
				 'replyLabel' => __('Reply'),
			   ));
	
			   $comm .= page()->comments->renderForm(array(
				 'headline' => '<h2>' . __('Join The Discussion') . '</h2>',
				 'pendingMessage' => __('Your comment must be approved by admin'),
				 'successMessage' => __('Thanks Your comment has been saved'),
				 'errorMessage' => __('There were errors and the comment was not approved'),
				 'attrs' => array(
				 'id' => 'CommentForm',
				 'action' => './',
				 'method' => 'post',
				 'class' => 'comm-form',
				 'rows' => 5,
				 'cols' => 50,
				 ),
				 'labels' => array(
						 'cite' => __('Name'),
						 'email' => __('E-Mail'),
						 'text' => __('Comment'),
						 'submit' => __('Submit'),
					 ),
				 ));
	
				 $comm .= "<p class='link-pagination'>";
	
						  if(input()->pageNum > 1) {
							$comm .= "<a class='btn mx-1' href='./page" . (input()->pageNum - 1) . "'>" . __('&laquo; Previous Comments') . "</a>";
						  }
						  if($start + $limit < count(page()->comments)) {
							$comm .= "<a class='btn mx-1'  href='./page" . (input()->pageNum + 1) . "'>" . __('Next Comments &raquo;') . "</a>";
						  }
						  $comm .= "</p>";
	
					 return $comm;
			}
	
		 }

// COMMENTS COUNT => IF NOT DISABLE COMMENTS
// echo countComments($items, $options);
function countComments($item, $options) {
	$id = $item->comments->last() ? $item->comments->last()->id : '#';
	if($id == '#') return '';
	if(!$item->check_1 == false || !$options->check_1 == false) return '';
        $out = '';
            $out = "| <a href='$item->url#Comment$id'>";
            $out .= "<i class='comments fa fa-comment-o' aria-hidden='true'></i> ";
            $out .= count($item->comments);
            $out .= "</a>";
        return $out;
}

/**
 * @param Page $items Page Children to start the blog post items
 */
function blogPosts($items) {

$options = pages()->get('/options/');

	$out = '';
	foreach ($items as $key) {
// Some Translatable Text
	$read_m = __('Read More');

// Look _ready.php line: 9 https://processwire.com/blog/posts/pw-3.0.28/    
	$summary = $key->summarize('body', 200);
// Comments
	$comm = countComments($key, $options);

// CATEGORIES
	  $cat = $key->categories->each(
		"<li class='tab-item'><a href='{url}'>{title}</a></li>"
	  );
// AUTHORS	  
	  $auth = $key->authors->each(
		"<li class='tab-item'><a href='{url}'>{title}</a></li>"
	  );	

// Date Created
	$created = $key->date;

	$out .= "<div class='timeline mt-2'>
	  <div class='timeline-item'>
		<div class='timeline-left'>
		  <a class='timeline-icon icon-lg tooltip' href='{$key->url}' data-tooltip='{$created}'>
			<i class='icon icon-check'></i>
		  </a>
		</div>
	
	<div class='timeline-content columns blog-timeline'>";

$out .= "<div class='column col-sm-12 col-md-5 col-lg-6 col-3'>";
	
	if(count($key->images)) {
		$img_url = $key->images->first->url;
			$out .= "<a href='{$key->url}'>";
			$out .= "<img src='{$img_url}' class='img-responsive centered mt-2' alt='{$key->name}' >";
			$out .= "</a>";
		}

$out .= "</div>";

	$out .= "<div class='column col-sm-12 col-md-7 col-lg-6 col-9'>"; 
	$out .= "<h4 class='ml-2 mt-2'>{$key->title} <small>{$comm}</small></h4>";
	$out .= "<blockquote>{$summary} <a class='btn ml-2 mt-2' href='{$key->url}'>[ {$read_m} ]</a></blockquote>";
	
	$out .= "<ul class='tab category-list ml-2'>";
// CATEGORIES
	  $out .= $cat ? "<li class='icon icon-apps m-2'></li>" : '';
	  $out .= "$cat";
// AUTHORS
	  $out .= $auth ? "<li class='icon icon-people m-2'></li>" : '';
	  $out .= "$auth";
	$out .= "</ul>";
	
	$out .= "</div>";
	
	$out .= "</div>
	  </div>
	</div>";
	}
	
	return $out;
  }

/**
 * @param Page $items Page Children to start the blog post items
 * USAGE:
 * $cat = pages()->get('/categories/')->children("limit=12");
 * echo listChild( $cat, __('Show Categories'), 'icon icon-apps' );
 */
function listChild( $items, $heading = '', $icon = '' ) {
    // $icon = "<pre>" . var_dump($items) . "</pre>";
    $id = $items[0] ? $items[0]->parentID : '';
    $url = pages()->get($id)->url;
    if(count($items)) {
           $out = '';
           $out .= "<a class='list-c' href='$url'><h5><small><i class='$icon'></i></small> $heading</h5></a>";
           $out .= "<ul class='nav'>\n";
               foreach($items as $page) {
                $out .= "<li><a href='{$page->url}'>{$page->title}</a><br />";
                if(page()->template == 'home' && $page->headline) {
                  $out .= "<blockquote class='headline'>{$page->headline}</blockquote>";
                }
               }
            $out .= "</li>\n</ul>";
            return $out;
           }
        }

// PW DEBUG => USAGE => echo pwDebug()
function pwDebug() {
    if(config()->debug && user()->isSuperuser()) {
        // display region debugging info
        $out = "<div id='debug' class='debug-regions container p-2 m-2'>";
        $out .= "<!--PW-REGION-DEBUG-->";
        $out .= "</div>";
        return $out;
    }
}


// ADD TO ANY USAGE: echo toAny()
function toAny() {
	return"<!-- AddToAny BEGIN -->
	<div class='a2a_kit a2a_kit_size_32 a2a_default_style m-2'>
	<a class='a2a_dd' href='https://www.addtoany.com/share'></a>
	<a class='a2a_button_facebook'></a>
	<a class='a2a_button_twitter'></a>
	<a class='a2a_button_google_plus'></a>
	<a class='a2a_button_linkedin'></a>
	<a class='a2a_button_reddit'></a>
	<a class='a2a_button_email'></a>
	<a class='a2a_button_google_gmail'></a>
	</div>
	<script async src='https://static.addtoany.com/menu/page.js'></script>
	<!-- AddToAny END -->";
}

/**
 * @param string $code
 * https://developers.google.com/analytics/devguides/collection/analyticsjs/
 */
function gAnalitycs($code)
{
return"\n
<!-- Google Analytics -->
<script>
window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
ga('create', '$code', 'auto');
ga('send', 'pageview');
</script>
<script async src='https://www.google-analytics.com/analytics.js'></script>
<!-- End Google Analytics -->\n";
}

/**
 * @param string $code
 * https://developers.google.com/analytics/devguides/collection/analyticsjs/
 */
    // TRASH DEMO DATA => USAGE: trashDemoData($trash = true);
    function trashDemoData($trash = false) {
        // IF TRUE
        if($trash == true) {
            // GET ID ALL PAGES TO TRASH
            $arr_p = [
				'1034','1035','1038','1039','1041','1042','1054',
				'1060','1061','1062'
            ];
        
                foreach ($arr_p as $key) {
                    $trash_p = pages()->get($key);
                // IF PAGE EXSIST    
                    if($trash_p->name == true) {
                // PAGE TO TRASH      
                        pages()->trash($trash_p);
                // OR DELETE
                        // pages()->delete($trash_p);
                    }
                }
            }   
        
        }