<?php
/*
* Template Name: Home Page
*/
?>
<?php get_header(); 
$gardenia_options = get_option( 'gardenia_theme_options' ); ?>
<section class="section-titel">
<?php $gardenia_loop_active = 0; ?>
<!-- Slider Section -->
<div class="banner">    		
	<div id="slider-carousel" class="carousel zoomIn garden-slider" data-ride="carousel">
		<div class="carousel-inner slider">
			<?php $indicators=0;
			for($gardenia_loop=1 ; $gardenia_loop <=5 ; $gardenia_loop++):			
				$sliderimage_image = get_theme_mod ( 'gardenia_homepage_sliderimage'.$gardenia_loop.'_image',gardenia_get_image_id($gardenia_options['slider-img-'.$gardenia_loop]));

				$sliderimage_title = get_theme_mod ( 'gardenia_homepage_sliderimage'.$gardenia_loop.'_title');
				$sliderimage_content = get_theme_mod ( 'gardenia_homepage_sliderimage'.$gardenia_loop.'_content');
				
				$sliderimage_link  = get_theme_mod ( 'gardenia_homepage_sliderimage'.$gardenia_loop.'_link',$gardenia_options['slidelink-'.$gardenia_loop] );
			?>

			<?php if($sliderimage_image!=''){
				$gardenia_loop_active++;
				$sliderimage_image_url = wp_get_attachment_image_src($sliderimage_image,'full');
			?>
			<div class="item <?php if($gardenia_loop_active == 1) { echo "active"; } ?>">
				<?php if($sliderimage_link!='') { ?>
				
					<img src="<?php echo esc_url($sliderimage_image_url[0]); ?>" alt="<?php echo $gardenia_loop;?>" />
					<div class="effect-hover">
						<h3><?php echo esc_html($sliderimage_title); ?></h3>
						<p><?php echo esc_html($sliderimage_content);?></p>
						<p><a href="<?php echo esc_url($sliderimage_link);?>" target="_blank"><?php esc_html_e('Read More','gardenia'); ?></a></p>
					</div>
				
				<?php } else { ?>                          
					<img src="<?php echo esc_url($sliderimage_image_url[0]); ?>" alt="<?php echo $gardenia_loop;?>" />
					<div class="effect-hover">
						<h3><?php echo esc_html($sliderimage_title); ?></h3>
					</div>
				<?php } ?>	
			</div>  
			<?php $indicators++;}  endfor; ?>
		</div>
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<?php for($gardenia_loop=1 ; $gardenia_loop<=$indicators ; $gardenia_loop++):  ?>
		    <li data-target="#slider-carousel" data-slide-to="<?php echo ($gardenia_loop-1); ?>"></li>
		    <?php endfor; ?>
	  	</ol>
		<?php if($gardenia_loop_active >= 2) { ?>		
		<a class="left carousel-control slider_button" href="#slider-carousel" data-slide="prev">
			<i class="fa fa-angle-left"></i>
		</a>
		<a class="right carousel-control slider_button" href="#slider-carousel" data-slide="next">
			<i class="fa fa-angle-right"></i>
		</a>
		<?php } ?>
	</div>
</div>
<!-- Slider Section -->
<!-- Below Slider Section -->
<div class="portfolio-bg">
<div class="container webpage-container">
<?php  if(get_theme_mod ( 'gardenia_homepage_section_title',$gardenia_options['home-title'])!='' || get_theme_mod ( 'gardenia_homepage_section_desc',$gardenia_options['home-content'] )!='' ) { ?>
	<!-- Title Bar Section -->
    <div class="section_row_1 text-center title-main">
		<?php if(get_theme_mod ( 'gardenia_homepage_section_title',$gardenia_options['home-title'] )) {?>
      <h2><span><?php echo esc_html(get_theme_mod ( 'gardenia_homepage_section_title',$gardenia_options['home-title'] ));?></span></h2>
		<?php } ?>		
			<?php if(get_theme_mod ( 'gardenia_homepage_section_desc',$gardenia_options['home-content'] )) {?>
				<p class="fet-p">
		  <?php echo esc_html(get_theme_mod ( 'gardenia_homepage_section_desc',$gardenia_options['home-content'] ));?>
				</p>
			<?php } ?>		
    </div>
    <!-- Title Bar Section -->
    <!-- First Section -->
<?php } if(get_theme_mod ( 'gardenia_homepage_first_sectionswitch',1)==1){   ?> 
    <div class="row">
      <div class="section_row_2 clearfix">	
		   <?php for($gardenia_loop=1 ; $gardenia_loop <5 ; $gardenia_loop++):?>
		   <?php if(get_theme_mod ( 'gardenia_homepage_first_section'.$gardenia_loop.'_image',gardenia_get_image_id($gardenia_options['home-icon-'.$gardenia_loop]))) { ?>
        <div class="col-xs-12 col-sm-6 col-md-3 circle-box">
          <div class="img_inline text-center center-block our-feat">
			   <div class="row_img">
			   <?php if(get_theme_mod ( 'gardenia_homepage_first_section'.$gardenia_loop.'_image',gardenia_get_image_id($gardenia_options['home-icon-'.$gardenia_loop]))){ 
			   		 $gardenia_id = get_theme_mod ( 'gardenia_homepage_first_section'.$gardenia_loop.'_image',gardenia_get_image_id($gardenia_options['home-icon-'.$gardenia_loop]));
					 $gardenia_image = wp_get_attachment_image_src( $gardenia_id, 'gardenia-home-tab-size' ); 
			   ?>           
				<img alt="<?php echo esc_attr($gardenia_loop);?>" class="img-circle" src="<?php echo esc_url($gardenia_image[0]); ?>" width="<?php  echo esc_attr($gardenia_image[1]); ?>" height="<?php  echo esc_attr($gardenia_image[2]); ?>">			
				<?php } ?>
				</div>
            <div class="row_content">				
			<?php if(get_theme_mod ( 'gardenia_homepage_first_section'.$gardenia_loop.'_title',$gardenia_options['section-title-'.$gardenia_loop])!=''){
						if(get_theme_mod ( 'gardenia_homepage_first_section'.$gardenia_loop.'_link',$gardenia_options['section-link-'.$gardenia_loop])!=''){	  ?>
							<a href="<?php echo esc_url(get_theme_mod ( 'gardenia_homepage_first_section'.$gardenia_loop.'_link',$gardenia_options['section-link-'.$gardenia_loop])) ?>">  
								<?php echo '<h4>'. esc_html(get_theme_mod ( 'gardenia_homepage_first_section'.$gardenia_loop.'_title',$gardenia_options['section-title-'.$gardenia_loop])) . '</h4>';?>
							</a>  
						<?php } else {
								 echo '<h4>'. esc_html(get_theme_mod ( 'gardenia_homepage_first_section'.$gardenia_loop.'_title',$gardenia_options['section-title-'.$gardenia_loop])) . '</h4>';
						} 	
				   } ?>              
				  <?php if(get_theme_mod ( 'gardenia_homepage_first_section'.$gardenia_loop.'_desc',$gardenia_options['section-content-'.$gardenia_loop])!=''){ ?>
				   <p><?php echo esc_html(get_theme_mod ( 'gardenia_homepage_first_section'.$gardenia_loop.'_desc',$gardenia_options['section-content-'.$gardenia_loop])); ?></p>
				  <?php } ?>             
            </div>
          </div>
        </div> 
        <?php  } ?>
        <?php endfor; ?>           
      </div>
    </div>
    <?php } ?> 
    <!-- First Section -->
  </div>  
</div>
<!-- below Slider Section -->
<!-- Second Section -->
  <div class="section_row_3 clearfix portfolio-bg  blog">
    <div class="container">
      <div class="section_row_1 text-center title-main">
			<?php if(get_theme_mod ( 'gardenia_homepage_second_section_title',$gardenia_options['post-title'])!='') {?>
				<h2><span><?php echo esc_html(get_theme_mod ( 'gardenia_homepage_second_section_title',$gardenia_options['post-title'])); ?></span></h2>
			<?php } ?>
        <p class="fet-p2">
			<?php if(get_theme_mod ( 'gardenia_homepage_second_section_desc',$gardenia_options['post-content'])!='') { ?>
				<?php echo esc_html(get_theme_mod ( 'gardenia_homepage_second_section_desc',$gardenia_options['post-content'])); ?>
			<?php } ?>
		</p>
      </div>    
      <div class="fancy_list_wrapper">
		  <?php $category= get_theme_mod ( 'gardenia_homepage_second_section_category',$gardenia_options['post-category-latest']); ?>
<?php	$gardenia_args = array(
	    'cat'  => $category,
	    'posts_per_page' => '3',
	    'ignore_sticky_posts' => '1',	   
		'meta_query' => array(
			array(
			 'key' => '_thumbnail_id',
			 'compare' => 'EXISTS'
			),
		)
	  );	
    	$gardenia_query=new WP_Query($gardenia_args); ?>
		<?php if ( $gardenia_query->have_posts() ) { ?> 
			 <?php while($gardenia_query->have_posts()) {  $gardenia_query->the_post(); ?>  
        <div class="col-md-4 col-sm-4 fancy_list_item">
          <?php $gardenia_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'gardenia-frontpage-size' ); ?>          
			  <?php if(has_post_thumbnail()) { ?> 
          <div class="fancy_image">
			 <a href="<?php echo esc_url( get_permalink() );?>">				
				<?php the_post_thumbnail('gardenia-frontpage-size'); ?>
			 </a> 
		  </div>
			  <?php } ?>
          <h3><a class="animate1" href="<?php echo esc_url( get_permalink() );?>"><?php echo get_the_title(); ?></a></h3>
          <div class="fancy_categories">
          	<?php $gardenia_date = sprintf( '<time datetime="%1$s">%2$s</time>',	
					sanitize_text_field( get_the_date( 'c' ) ),
					esc_html( get_the_date() )
				); ?>  
          	<div class="glyphicon glyphicon-calendar color"><a href="<?php echo esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'))); ?>" rel="tag"><?php echo wp_kses_post($gardenia_date); ?></a></div>  
          </div>
          <?php the_excerpt(); ?>
          <p><span><a href="<?php echo esc_url( get_permalink() );?>" title="<?php esc_attr_e('Read More', 'gardenia');?>"><?php esc_html_e('Read More', 'gardenia');?></a></span></p>
        </div>       
           <?php } }?> 
        <div class="clear"></div>
      </div>
    </div>
  </div>  
</section>
<?php get_footer(); ?>
