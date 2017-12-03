<?php namespace Processwire;
// trashDemoData($trash = true); // TRASH DEMO DATA ( Uncomment below to move the demo content to the trash ); 
$home = pages()->get('/');
$templ_url = urls()->templates;
$def_lang = 'en' // SET DEFAULT LANGUAGE;
?>
<!doctype html>
<html lang="<?= multLang($def_lang,'html-lang') // Default Language en | Show attribute Lang ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=page()->summary?>">
    <link rel="icon" href="<?=$options->favicon ? $options->favicon->url : $templ_url . 
                          'assets/img/favicon.png'?>"/>
    <title><?=page()->get("headline|title")?></title>
    <?php include 'inc/_seo.php'; ?>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $templ_url?>assets/css/master.min.css">
    <pw-region id="top-region"></pw-region>
    <?= multLang($def_lang,'link') // Default Language en | Show output the <link> tag?>
</head>
<body class='<?=page()->name?>'>

<header id='header' class='container mt-2'>

<div id='off-c' class="off-canvas">
<!-- off-screen toggle button -->
<a class="fixed off-canvas-toggle btn btn-primary btn-action show-md" href="#sidebar-id">
   <i class="icon icon-menu"></i>
</a>

<div id="sidebar-id" class="off-canvas-sidebar show-md">
    <div class="navbar-section p-2">
    <?php
        echo mobileNav($home->and($home->children),['about']);
        echo socialProfiles($options->headline);?>
    </div>
</div>

<a class="off-canvas-overlay" href="#close"></a>

    <div class="off-canvas-content">
        <nav id='nav' class="navbar">

            <div class="navbar-section hide-md">
            
        <?php // BASIC NAV
                echo basicNav($home->and($home->children),['about']);
              // output an "Edit" link if this page happens to be editable by the current user
                echo pageEdit($page);?>

            </div>

            <div class="navbar-center logo">

            <?= multLang($def_lang,'lang-menu') // Default Language en | Show Menu multilanguage?>

                <a class='p-2' href='<?=$home->url?>'>
                    <img class='responsive' src="<?=$options->logo ? $options->logo->url : $templ_url . 
                                'assets/img/logo.png'?>" style='height: auto; width: 100%;' alt="logo">
                </a>
                
            </div>

            <div class="navbar-section hide-md social-right">
 
                <?php
                    echo socialProfiles($options->headline);
                ?>

            </div>

        </nav>
    </div><!-- /.off-canvas-content -->
</div><!-- /#off-c -->

<div id="bredcrumb">
    <ul class="breadcrumb text-uppercase text-large">
      <?= breadCrumb($page); ?>
    </ul>
</div>

</header>   

<div id="main" class='content-main container  <?=!$dis_sid ? 'sidebar grid-xl' : 'grid-lg';?>'>

    <div id='content' class="<?=!$dis_sid ? 'columns' : 'grid-xl';?>">

        <div id='body' class="<?=!$dis_sid ? 'column col-md-12 col-9' : 'content-body';?>">
            <?=page()->body?>
        </div>

<?php if(!$dis_sid): ?>
            <div id='sidebar' class='content-sidebar column col-md-12 col-3 centered'>

                <?php if(page()->images->first && $page->parent->name != 'blog'):?>
                    <a class='text-center' href='<?=page()->images->first->url?>'>
                        <img class='img-responsive centered d-block p-1' src="<?=page()->images->first->url?>" alt="<?=page()->name?>">
                    </a>
                <?php endif;
        
                if($gl_sid) echo $options->sidebar;

                if(page()->sidebar) echo page()->sidebar;
                ?>

            </div>
<?php endif; ?>

    </div><!-- /#content -->

</div><!-- /#main -->

<footer id='footer' class="content-footer container p-2 m-2">

<div class="columns">

    <p class='text-center column col-6 col-xs-12 mt-2'>
            <?= __('Powered by');?> &copy;
            <a class='mt-2' href='http://processwire.com'><?= __('ProcessWire Open Source CMS/CMF'); ?></a>
    </p>

    <div class="search-footer column col-6 col-xs-12 text-center">
        <?= searchForm();?>
    </div>

</div>

</footer>
<?php
// DEBUG REGIONS
  echo pwDebug();
// GOGLE ANALYTICS CODE 
 // echo gAnalitycs('XAA120');
?>
<!-- <script src="<?php // echo $templ_url?>assets/js/custom.js"></script> -->
<!-- COOKIE BAR FROM https://cookie-bar.eu/ -->
<script  type="text/javascript" src="https://cdn.jsdelivr.net/npm/cookie-bar/cookiebar-latest.min.js?showNoConsent=1&hideDetailsBtn=1" defer></script>
<pw-region id="bottom-region"></pw-region>
</body>
</html>
