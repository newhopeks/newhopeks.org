<header role="banner" class="header">
	<div class="container">
		<div class="logo">
			<div class="row">
				<div class="col-xs-12">
					<h1>
						<?php if (!$is_front) { echo '<a href="/">'; } ?>
						<?php print $site_name; ?>
						<?php if (!$is_front) { echo '</a>'; } ?>
					</h1>
				</div>
			</div> <!-- end .row -->
		</div> <!-- end .logo -->

		<div class="nav">
			<div class="row">
				<div class="col-xs-12">
					<?php if ($main_menu) : ?>
						<nav role="navigation">
							<?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('class' => 'links'))); ?>
						</nav>
					<?php endif; ?>
				</div>
			</div> <!-- end .row -->
		</div> <!-- end .nav -->
	</div> <!-- end .container -->

	<div class="secondary-menu">
	    <div class="container">
    		<div class="row">
    			<div class="col-xs-12">
    				<?php if ($secondary_menu) : ?>
                        <?php print theme('links__menu_secondary_menu', array('links' => $secondary_menu, 'attributes' => array('class' => 'links'))); ?>
    				<?php endif; ?>
    			</div>
    		</div> <!-- end .row -->
        </div> <!-- end .container -->
	</div> <!-- end .secondary-menu -->
</header> <!-- end .header -->

<?php if ($page['content_above']) : ?>
	<div class="content-top">
		<div class="container">
			<div class="row">
				<?php print render($page['content_above']); ?>
			</div> <!-- end .row -->
		</div> <!-- end .container -->
	</div> <!-- end .content-top -->
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
	<div class="content-bottom">
		<div class="container">
			<div class="row">
				<?php print render($page['content_below']); ?>
			</div> <!-- end .row -->
		</div> <!-- end .container -->
	</div> <!-- end .content-bottom -->
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
