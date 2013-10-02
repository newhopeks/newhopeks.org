<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language ?>" xml:lang="<?php print $language ?>">
	<head>
		<title>
			<?php print $head_title ?></title>
		<?php print $head ?>
		<?php print $styles ?>
		<script type="text/javascript">
			<?php /* Needed to avoid Flash of Unstyle Content in IE */ ?></script>
		<style type="text/css" media="all">
			@import url("/themes/newhope2.1/common/styles.css");
		</style>
	</head>

<body>
<div id="holder">
<a name="pgtop"></a>
			<div id="container">
				
				<?php if ($sidebar_right != ""): ?>
				<div id="admin">
					<div>
						<?php print $sidebar_right ?>
					</div>
				</div>
				<?php endif; ?>
				
				<div id="header">
					<div id="NHFlashBanner">
						<a href="/home"></a>
					</div>
					<script type="text/javascript" src="/themes/newhope2.1/swfobject.js"></script>
					<script type="text/javascript">
						var so = new SWFObject("/themes/newhope2.1/flash/flshbnr.swf", "NHFlashBanner", "560", "108", "6", "#353535");
						so.write("NHFlashBanner");
					</script>
				</div>

				<div id="wrapper">

					<div id="main" class="content-<?php print $layout; ?>">


						<?php if (count($primary_links)) : ?>
						<div id="ministries">
							<ul id="topnav">
								<?php foreach ($primary_links as $link): ?>
								<li>
									<?php print $link?>
								</li>
								<?php endforeach; ?>
							</ul>
						</div>
						<?php endif; ?>

						<?php if ($mission) { ?>
						<div id="mission">
							<?php print $mission ?>
						</div>
						<?php } ?>
						<div id="main">
							<?php print $breadcrumb ?>
							<h1 class="title">
								<?php print $title ?>
							</h1>
							<div class="tabs">
								<?php print $tabs ?>
							</div>
							<?php print $help ?>
							<?php print $messages ?>
							<?php print $content; ?>
							<p id="totop">
								<a href="#pgtop">to top</a>
							</p>
						</div>
					<div id="nav">
						<?php print $search_box ?>

						<?php if (count($secondary_links)) : ?>
						<ul id="secondary">
							<?php foreach ($secondary_links as $link): ?>
							<li>
								<?php print $link?></li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
						<?php if ($sidebar_left != ""): ?>
						<!-- <div id="admin"> -->
							<div>
								<?php print $sidebar_left ?></div>
							</div>					
						<!-- </div> -->
						<?php endif; ?>

					<div id="footer">
						<?php print $footer_message ?> New Hope | 785-537-2389 | Office: 1600 Poyntz, Manhattan, KS 66502<br />
						<a href="mailto:info@newhopeks.org">info@newhopeks.org</a>
					</div>

<!-- <p id="src"><a href="mailto:jay@icglink.com">Site design by Jay Risner</a></p> -->
					<?php print $closure ?>
				</div>
			</div>
		</div>
	</body>
</html>
