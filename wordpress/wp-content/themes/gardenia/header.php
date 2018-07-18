<?php
/**
 * The Header template file
 */
$gardenia_options = get_option('gardenia_theme_options');
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
    <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width">	
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">	 
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="themepage">
	<?php if (!empty($gardenia_options) || get_theme_mod('theme_phone_number',$gardenia_options['phone']) || (get_theme_mod('theme_email_id',$gardenia_options['email'])) ) { ?>
		<div class="section-content">
			<div class="container">
				<div class="row header-top">
					<?php if(get_theme_mod('theme_phone_number',$gardenia_options['phone']) || (get_theme_mod('theme_email_id',$gardenia_options['email'])) ) { ?>
					<div class="col-md-6 left-head">
						<?php if (get_theme_mod('theme_phone_number',$gardenia_options['phone'])) { ?>
							<div class="phone"><?php echo esc_attr(get_theme_mod('theme_phone_number',$gardenia_options['phone'])); ?></div>
						<?php }
						if (get_theme_mod('theme_email_id',$gardenia_options['email'])) { ?>
							<div class="mail"><a href="mailto:<?php echo esc_attr(get_theme_mod('theme_email_id',$gardenia_options['email'])); ?>"><?php echo esc_attr(get_theme_mod('theme_email_id',$gardenia_options['email'])); ?></a></div>
						<?php } ?>
					</div>
					<?php } ?>
					<?php if(true) { ?>
					<div class="col-md-6 right-head <?php if(get_theme_mod('theme_email_id',$gardenia_options['email'])=='' && get_theme_mod('theme_phone_number',$gardenia_options['phone'])=='' ) { echo "col-md-offset-6";}?>">
						<ol class="social">
							<?php for($i=1; $i<=6; $i++) : ?>
	                            <?php if(true ): ?>
                                   <li><a href="<?php echo esc_url(get_theme_mod('TopHeaderSocialIconLink'.$i)); ?>" class="icon" title="" target="_blank">
                                        <i class="fa <?php echo esc_attr(get_theme_mod('TopHeaderSocialIcon'.$i)); ?>"></i>
                                    </a></li>
	                            <?php endif; ?>
                            <?php endfor; ?>							
						</ol>
					</div>
					<?php } ?>
				</div>
			</div></div>
	<?php } ?>
	<div class="container gardenia-container">
		<div class="col-md-12"> 
			<div class="header-main row">
				<div class="col-md-3 col-sm-3 logo">		 
					<?php if(has_custom_logo()){
                       		the_custom_logo();
						 }  
						if (display_header_text()) : ?>
						<a class="home-link" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
							<h2 class="site-title"><?php bloginfo('name'); ?></h2>	
						</a>
						<p class="site-description"><?php echo esc_html(get_bloginfo('description')); ?></p>
					<?php endif;
					 ?>
				</div>
				<div class="col-md-9 col-sm-9 theme-menu">
					<nav class="gg-nav">          
						<div class="navbar-header">
							<?php if (has_nav_menu('primary')) { ?>
								<button type="button" class="navbar-toggle navbar-toggle-top sort-menu-icon collapsed" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only"><?php esc_html_e('Toggle navigation', 'gardenia'); ?></span> <span class="icon_menu-square_alt"></span></button>
							<?php } ?>
						</div>			  
						<?php
						$gardenia_defaults = array(
							'theme_location' => 'primary',
							'container' => 'div',
							'container_class' => 'navbar-collapse collapse gg-navbar main-menu',
							'container_id' => '',
							'menu_class' => 'navbar-collapse collapse gg-navbar',
							'menu_id' => '',
							'submenu_class' => '',
							'echo' => true,							
							'before' => '',
							'after' => '',
							'link_before' => '',
							'link_after' => '',
							'items_wrap' => '<ul id="menu" class="gg-menu">%3$s</ul>',
							'depth' => 0,
							'walker' => ''
						);
						if (has_nav_menu('primary')) {
							wp_nav_menu($gardenia_defaults);
						}
						?>        
					</nav>
				</div>      
			</div>
		</div>
	</div>  
	<?php if (get_header_image()) { ?>
	    <div class="custom-header-img">
	        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
	            <img src="<?php esc_url(header_image()); ?>" width="<?php echo esc_attr(get_custom_header()->width); ?>" height="<?php echo esc_attr(get_custom_header()->height); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
	        </a>
	    </div>
	<?php } ?>   
</header>