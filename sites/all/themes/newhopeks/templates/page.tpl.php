<header role="banner" class="header">
	<div class="container">
		<div class="logo">
			<div class="row">
				<div class="span12">
					<h1>
						<?php if (!$is_front) { echo '<a href="/">'; } ?>
						<img src="/<?= path_to_theme(); ?>/img-src/logo.fw.png" alt="<?php print $site_name; ?>" />
						<?php if (!$is_front) { echo '</a>'; } ?>
					</h1>
				</div>
			</div> <!-- end .row -->
		</div> <!-- end .logo -->
		<div class="nav">
			<div class="row">
				<div class="span12">
					<?php if ($main_menu) : ?>
						<hr />
						<nav role="navigation">
							<?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('class' => 'links'))); ?>
						</nav>
					<?php endif; ?>
				</div>
			</div> <!-- end .row -->
		</div> <!-- end .nav -->
	</div> <!-- end .container -->
</header> <!-- end .header -->
<hr />
<?php if ($page['content_above']) : ?>
	<div class="content-top">
		<div class="container">
			<div class="row">
				<?php print render($page['content_above']); ?>
			</div> <!-- end .row -->
		</div> <!-- end .container -->
	</div> <!-- end .content-top -->
	<hr />
<?php endif; ?>
<div id="content" class="content">
	<div class="container">
		<div class="row">
			<div role="main" class="<?php if ($is_front) : ?>span12<?php else : ?>span8<?php endif; ?> main">
				<?php if (!$is_front && $title) : ?>
					<h1><?php print $title; ?></h1>
				<?php endif; ?>
				<?php $tabs && print render($tabs); ?>
				<?php if ($is_front) { unset($page['content']['system_main']); } ?>
				<?php print render($page['content']); ?>
			</div> <!-- end .main -->
			<?php if (!$is_front) : ?>
				<hr />
				<div class="span4 sidebar">
					<?php print render($page['content_sidebar']); ?>
				</div> <!-- end .sidebar -->
			<?php endif; ?>
		</div> <!-- end .row -->
	</div> <!-- end .container -->
</div> <!-- end .content -->
<?php if ($page['content_below']) : ?>
	<hr />
	<div class="content-bottom">
		<div class="container">
			<div class="row">
				<?php print render($page['content_below']); ?>
			</div> <!-- end .row -->
		</div> <!-- end .container -->
	</div> <!-- end .content-bottom -->
<?php endif; ?>
<hr />
<footer role="contentinfo" class="footer">
	<div class="container">
		<div class="row">
			<div class="span12">
				<?php print render($page['footer']); ?>
			</div> <!-- end .grid_12 -->
		</div> <!-- end .row -->
	</div> <!-- end .container -->
</footer> <!-- end .footer -->
