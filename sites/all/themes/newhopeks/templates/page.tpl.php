<header role="banner" class="header">
    <div class="container">
        <div class="row">
    		<div class="logo col-xs-12 col-sm-3">
    			<h1>
    				<?php if (!$is_front) { echo '<a href="/">'; } ?>
    				    <img src="/<?= path_to_theme(); ?>/img/logo.png" alt="<?php print $site_name; ?>" />
    				<?php if (!$is_front) { echo '</a>'; } ?>
    			</h1>
    		</div> <!-- end .logo -->

            <nav role="navigation" class="navbar navbar-main col-xs-12 col-sm-9">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
    	        <div class="collapse navbar-collapse" id="main-navbar-collapse">
    	            <?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('class' => 'nav navbar-nav main-menu'))); ?>
    				<form class="navbar-form" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
    				<?php if ($secondary_menu) : ?>
                        <?php print theme('links__menu_secondary_menu', array('links' => $secondary_menu, 'attributes' => array('class' => 'nav navbar-nav secondary-menu'))); ?>
    				<?php endif; ?>
    	        </div>
            </nav>
        </div>
    </div>
</header> <!-- end .header -->

<?php if ($page['content_above']) : ?>
	<div class="content-above">
		<div class="container">
			<div class="row">
				<?php print render($page['content_above']); ?>
			</div> <!-- end .row -->
		</div> <!-- end .container -->
	</div> <!-- end .content-above -->
<?php endif; ?>

<div id="content" class="content">
	<div class="container">
		<div class="row">
			<div role="main" class="main col-xs-12 <?php if ($is_front) : ?>col-sm-12<?php else : ?>col-sm-9 col-sm-push-3<?php endif; ?>">
				<?php if (!$is_front && $title) : ?>
					<h1><?php print $title; ?></h1>
				<?php endif; ?>
				<?php $tabs && print render($tabs); ?>
				<?php if ($is_front) { unset($page['content']['system_main']); } ?>
				<?php print render($page['content']); ?>
			</div> <!-- end .main -->

			<?php if (!$is_front) : ?>
				<div class="sidebar col-xs-12 col-sm-3 col-sm-pull-9">
					<?php print render($page['content_sidebar']); ?>
				</div> <!-- end .sidebar -->
			<?php endif; ?>
		</div> <!-- end .row -->
	</div> <!-- end .container -->
</div> <!-- end .content -->

<?php if ($page['content_below']) : ?>
	<div class="content-below">
		<div class="container">
			<div class="row">
				<?php print render($page['content_below']); ?>
			</div> <!-- end .row -->
		</div> <!-- end .container -->
	</div> <!-- end .content-below -->
<?php endif; ?>

<footer role="contentinfo" class="footer">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php print render($page['footer']); ?>
			</div> <!-- end .grid_12 -->
		</div> <!-- end .row -->
	</div> <!-- end .container -->
</footer> <!-- end .footer -->
