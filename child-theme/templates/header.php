<input type="checkbox" id="toogleMenu">
    <header class="header" style="background-image:url(<?= get_stylesheet_directory_uri(); ?>/layout/assets/images/banner-demo.jpg)">
        <div class="overlay">
            <!--nav-->
            <nav class="navbar navbar-default">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
					<?php if(has_logo()): ?>
                        <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>">
                            <img alt="Logo" src="<?php the_logo(); ?>">							
                        </a>
					<?php endif; ?>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div id="primary-menu">
                        <ul class="nav navbar-nav navbar-right">
                          <li><a href="<?= get_theme_mod('title_tagline[facebook_link]') ?>"><i class="fa fa-facebook"></i></a></li>
                          <li><a href="<?= get_theme_mod('title_tagline[twitter_link]') ?>"><i class="fa fa-twitter"></i></a></li>
                          <li><a href="<?= get_theme_mod('title_tagline[youtube_link]') ?>"><i class="fa fa-youtube-play"></i></a></li>
                          <li><a href="<?= get_theme_mod('title_tagline[instagram_link]') ?>"><i class="fa fa-instagram"></i></a></li>
                          <li class="toogleMenuWrap">
                            <label for="toogleMenu" class="navbar-toggle">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </label>
                          </li>
                        </ul>
						<?php
						  if (has_nav_menu('primary_navigation')) :
							wp_nav_menu(array(
								'theme_location' => 'primary_navigation',
								'menu_class' => 'nav navbar-nav navbar-left'
							));
						  endif;
						?>
                    </div>
                </div>
            </nav>
            <div class="container">
                <h1 class="heading"><?= get_bloginfo( 'description', 'display' ); ?></h1>
                <a href="" class="btn btn-lg btn-default"><?php _e('About me','queenie'); ?></a>
            </div>
        </div>
        <div class="banner-front">
            <img src="<?= get_stylesheet_directory_uri(); ?>/layout/assets/images/banner-front.png" alt="">
        </div>
    </header>

