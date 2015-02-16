<!DOCTYPE html>

<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

	<head>

		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?php print $head_title; ?></title>

		<link rel="shortcut icon" href="/<?= path_to_theme(); ?>/favicon.ico" />
		<link rel="apple-touch-icon" href="/<?= path_to_theme(); ?>/apple-touch-icon.png" />
		<link rel="alternate" type="application/rss+xml" title="RSS" href="/feed" />

		<!--[if gt IE 7]><!-->
		<?php print $styles; ?>
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<!--<![endif]-->

		<!--[if lt IE 8]>
		<link rel="stylesheet" href="/<?= path_to_theme(); ?>/css/libs/ie6.1.1.css" media="screen, projection">
		<![endif]-->

		<script src="/<?= path_to_theme(); ?>/js/libs/modernizr-2.8.3.min.js"></script>

		<script>
			// save the theme path for use in Javascript
			themePath = '<?= path_to_theme(); ?>';
		</script>

		<meta name="author" content="New Hope Church" />

		<?php print $head; ?>

	</head>

	<body class="<?php print get_section(); ?>">

		<?php print $page_top; ?>

		<?php print $page; ?>

		<?php print $scripts; ?>

		<?php print $page_bottom; ?>

	</body>

</html>
