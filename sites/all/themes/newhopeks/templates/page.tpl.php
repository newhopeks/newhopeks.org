<header role="banner" class="header">
    <div class="container">
        <div class="wrapper">
            <div class="row">
        		<div class="logo col-xs-9 col-sm-3">
    				<?php if (!$is_front) { echo '<a href="/">'; } ?>
        				<h1 class="logo__title"><img src="/<?= path_to_theme(); ?>/img/logo@2x.png" width="270" alt="<?php print $site_name; ?>" /></h1>
    				<?php if (!$is_front) { echo '</a>'; } ?>
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
	        			<div class="top-bar">
		        			<div class="container">
			        			<div class="row">
				        			<div class="secondary-menu-container col-sm-8 col-md-9">
				        				<?php if ($secondary_menu) : ?>
											<?php print theme('links__menu_secondary_menu', array('links' => $secondary_menu, 'attributes' => array('class' => 'nav navbar-nav secondary-menu'))); ?>
				        				<?php endif; ?>
				        			</div>
				        			<div class="search-form-container col-sm-4 col-md-3">
										<?php print $search_form; ?>
				        			</div>
			        			</div> <!-- end .row -->
		        			</div>
	        			</div>
        	        </div>
                </nav>
            </div> <!-- end .row -->
        </div> <!-- end .wrapper -->
    </div> <!-- end .container -->
</header> <!-- end .header -->

<?php if ($breadcrumb) : ?>
    <div class="breadcrumbs">
        <div class="container">
            <div class="wrapper">
                <div class="row">
    			    <nav class="col-xs-12">
    			        <p><?php print $breadcrumb; ?><span class="current"> &raquo; <span class="title"><?php print $title; ?></span></span></p>
    			    </nav>
                </div> <!-- end .row -->
            </div> <!-- end .wrapper -->
        </div> <!-- end .container -->
    </div>
<?php endif; ?>

<?php if (($is_front && isset($hero)) || $page['content_above']) : ?>
	<div class="content-above">
		<div class="container">
			<div class="row">
			    <?php if ($is_front) : ?>
			        <?php print $hero; ?>
                <?php else : ?>
    				<?php print render($page['content_above']); ?>
                <?php endif; ?>
			</div> <!-- end .row -->
		</div> <!-- end .container -->
	</div> <!-- end .content-above -->
<?php endif; ?>

<div id="content" class="content">
	<div class="container">
		<div class="row">
			<main role="main" class="main col-xs-12 <?php if ($is_front || !$page['content_sidebar']) : ?>col-sm-12<?php else : ?>col-sm-9 col-sm-push-3<?php endif; ?>">
			    <div class="wrapper clearfix">
    				<?php $tabs && print render($tabs); ?>

    				<?php if ($is_front) : ?>
    				    <?php unset($page['content']['system_main']); ?>
                    <?php endif; ?>

                    <?php if ($title) : ?>
                        <header class="main__header">
                            <?php if (isset($node) && $node->type == 'message') : ?>
                                <p class="main__header__date main__header__date--messages"><?php print $date; ?></p>
                            <?php endif; ?>
                            <h1 class="main__header__title"><?php print $title; ?></h1>
                            <?php if (isset($field_subtitle)) : ?>
                                <p class="main__header__subtitle"><?php print $field_subtitle; ?></p>
                            <?php endif; ?>
                            <?php if (isset($node) && $node->type == 'news') : ?>
                                <p class="main__header__date"><?php print $date; ?></p>
                            <?php endif; ?>
                        </header>
                    <?php endif; ?>

    				<?php print render($page['content']); ?>

                    <?php if ($page['content_below']) : ?>
                    	<div class="content-below">
                			<div class="row">
                                <?php print render($page['content_below']); ?>
                			</div> <!-- end .row -->
                    	</div> <!-- end .content-below -->
                    <?php endif; ?>
			    </div> <!-- end .wrapper -->
			</main> <!-- end .main -->

			<?php if (!$is_front && $page['content_sidebar']) : ?>
				<div class="sidebar col-xs-12 col-sm-3 col-sm-pull-9">
					<?php print render($page['content_sidebar']); ?>
				</div> <!-- end .sidebar -->
			<?php endif; ?>
		</div> <!-- end .row -->
	</div> <!-- end .container -->
</div> <!-- end .content -->

<footer role="contentinfo" class="footer">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php print render($page['footer']); ?>
			</div> <!-- end .grid_12 -->
		</div> <!-- end .row -->
	</div> <!-- end .container -->
</footer> <!-- end .footer -->
