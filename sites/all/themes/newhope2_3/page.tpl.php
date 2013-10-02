<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language ?>" xml:lang="<?php print $language ?>">
	<head>
		<title><?php print $head_title ?></title>
		<?php print $head ?>
		<?php print $styles ?>
		<?php print $scripts ?>
		<script type="text/javascript"><?php /* Needed to avoid Flash of Unstyle Content in IE */ ?></script>
		<!--<script type="text/javascript" src="<?php print base_path() . path_to_theme() ?>/js/interface.js"></script>
		<script type="text/javascript" src="<?php print base_path() . path_to_theme() ?>/js/sliders.js"></script>-->
		<script type="text/javascript">
			var themeDir = "<?php print base_path() . path_to_theme() ?>";
		</script>
		<meta name="designer" content="Jay Risner &lt;jay@icglink.com&gt;"/>
		<style type="text/css" media="all">
    @import url("<?php print base_path() . path_to_theme() ?>/common/styles.css");
		</style>

		<script type="text/javascript" src="<?php print base_path() . path_to_theme() ?>/js/modernizr.custom.00601.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('.field-type-file-audio').find('#playLink').hide();
				if ( Modernizr.audio.mp3 == '' ) {
					$('.field-type-file-audio').find('audio').hide();
					$('.field-type-file-audio').find('#playLink').show();
				}
			});
		</script>

		<!--
		<script src="<?php print base_path() . path_to_theme() ?>/mediaelementplayer/mediaelement-and-player.min.js"></script>
		<link rel="stylesheet" href="<?php print base_path() . path_to_theme() ?>/mediaelementplayer/mediaelementplayer.min.css" />
		<script>
		// using jQuery
		$(document).ready(function() {
			$('audio').mediaelementplayer({});
		});
		</script>
		-->

	</head>

	<body>
			<a name="pgtop"></a>

				<?php if ($sidebar_admin != ""): ?>
				<div id="admin">
					<div>
						<?php print $sidebar_admin ?>
					</div>
				</div>
				<?php endif; ?>

			<div id="container">
				<?php 
					global $_COOKIE;
					if ($_COOKIE['newhope_slider_image']) {
						$slider_image = base_path() . path_to_theme() . '/images/sliders/' . $_COOKIE['newhope_slider_image'];
						$slider_class = 'slider-up';
					}
					else {
						$slider_image = base_path() . path_to_theme() . '/images/sliders/pic_1.png';
						$slider_class = 'slider-down';
					}
				?>

				<div id="header">
					<div id="NHFlashyBanner">
						<a href="/">
							<img id="slider" class="<?php print $slider_class ?>" src="<?php print $slider_image ?>" />
						</a>
					</div>
				</div>

				<div id="wrapper">
          
          <div id="leftstuff">
            <div id="gizmobar"><?php print newhope2_3_user_bar() ?></div>
            <div id="main" class="content-<?php print $layout; ?>">
              <?php if ($mission) { ?>
                <div id="mission"><?php print $mission ?></div>
              <?php } ?>
              <div id="content">
                <?php print $breadcrumb ?>
                <?php if ($header): ?>
                  <?php print $header ?>
                <?php endif; ?>
                <h1 class="title"><?php print $title ?></h1>
                <div class="tabs"><?php print $tabs ?></div>
                <?php print $help ?>
                <?php print $messages ?>
                <?php print $content; ?>
                <?php if ($info_panel1 || $info_panel2 || $info_panel3): ?>
                <div id="infoarea">
                  <div class="infopanel"><?php print $info_panel1 ?></div>
                  <div class="infopanel"><?php print $info_panel2 ?></div>
                  <div class="infopanel"><?php print $info_panel3 ?></div>
                  <div class="infofooter"></div>
                </div>
                <?php endif; ?>
                <p id="totop">
                  <a href="#pgtop">to top</a>
                </p>
              </div>
            </div>
          </div>
				</div>

        <div id="nav">
          <?php print $sidebar_left ?>
        </div>
				<div id="footer">
          <?php print $footer_message ?> 
				</div>
			</div>
    <?php print $closure ?>
	</body>
</html>
