<header role="banner" class="header">
  <div class="container">
    <div class="wrapper">
      <div class="logo">
        <?php if (!$is_front) { echo '<a href="/">'; } ?>
          <h1 class="logo__title">
            <img src="/<?= path_to_theme(); ?>/img/logo.svg" alt="<?php print $site_name; ?>" />
          </h1>
        <?php if (!$is_front) { echo '</a>'; } ?>
      </div><!-- .logo -->

      <nav role="navigation" class="nav">
        <?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('class' => 'main-menu'))); ?>
        <div class="top-bar">
          <div class="container">
            <?php if ($secondary_menu) : ?>
              <?php print theme('links__menu_secondary_menu', array('links' => $secondary_menu, 'attributes' => array('class' => 'secondary-menu'))); ?>
            <?php endif; ?>

            <?php print $search_form; ?>
          </div><!-- .container -->
        </div><!-- .top-bar -->
      </nav><!-- .navbar-main -->
    </div><!-- .wrapper -->
  </div><!-- .container -->
</header><!-- .header -->

<?php if ($breadcrumb) : ?>
  <div class="breadcrumbs">
    <div class="container">
      <div class="wrapper">
        <div class="row">
          <nav class="col-xs-12">
            <p><?php print $breadcrumb; ?><span class="current"> &raquo; <span class="title"><?php print $title; ?></span></span></p>
          </nav>
        </div><!-- .row -->
      </div><!-- .wrapper -->
    </div><!-- .container -->
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
      </div><!-- .row -->
    </div><!-- .container -->
  </div><!-- .content-above -->
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
              <?php if ((!empty($node) && ($node->type == 'message' || $node->type == 'newsletter')) || !empty($pre_title)) : ?>
                <p class="main__header__pre-title">
                  <?php if (!empty($node) && $node->type == 'message') { print $date; } ?>
                  <?php if (!empty($node) && $node->type == 'newsletter') : ?>
                    <a href="/newsletter">Newsletter</a>
                    <?php if (!empty($field_newsletter_title)) : ?>
                      / <a href="<?php print $field_newsletter_link; ?>"><?php print $field_newsletter_title . ', ' . $field_newsletter_date; ?></a>
                    <?php endif; ?>
                  <?php endif; ?>
                  <?php if (!empty($pre_title)) { print $pre_title; } ?>
                </p>
              <?php endif; ?>
              <h1 class="main__header__title"><?php print $title; ?></h1>
              <?php if (isset($field_subtitle)) : ?>
                <p class="main__header__subtitle"><?php print $field_subtitle; ?></p>
              <?php endif; ?>
              <?php if (isset($node) && ($node->type == 'news' || isset($field_author))) : ?>
                <p class="main__header__post-title">
                  <?php if ($node->type == 'news') { print $date; } ?>
                  <?php if (!empty($field_author)) : ?>
                    By <?php print $field_author; ?>
                  <?php endif; ?>
                </p>
              <?php endif; ?>
            </header>
          <?php endif; ?>

          <?php print render($page['content']); ?>

          <?php if ($page['content_below']) : ?>
            <div class="content-below">
              <div class="row">
                <?php print render($page['content_below']); ?>
              </div><!-- .row -->
            </div><!-- .content-below -->
          <?php endif; ?>
        </div><!-- .wrapper -->
      </main><!-- .main -->

      <?php if (!$is_front && $page['content_sidebar']) : ?>
        <div class="sidebar col-xs-12 col-sm-3 col-sm-pull-9">
          <?php print render($page['content_sidebar']); ?>
        </div><!-- .sidebar -->
      <?php endif; ?>
    </div><!-- .row -->
  </div><!-- .container -->
</div><!-- .content -->

<footer role="contentinfo" class="footer">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <?php print render($page['footer']); ?>
      </div><!-- .grid_12 -->
    </div><!-- .row -->
  </div><!-- .container -->
</footer><!-- .footer -->
