<?php
/**
* Good News Plus Customization options
**/

function gardenia_sanitize_checkbox( $checked ) {
  return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function gardenia_field_sanitize_input_choice( $input, $setting ) {

  // Ensure input is a slug.
  $input = sanitize_key( $input );

  // Get list of choices from the control associated with the setting.
  $choices = $setting->manager->get_control( $setting->id )->choices;

  // If the input is a valid key, return it; otherwise, return the default.
  return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
function gardenia_posts_category(){
  $args = array('parent' => 0);
  $categories = get_categories($args);
  $category = array();
  $i = 0;
  foreach($categories as $categorys){
      if($i==0){
          $default = $categorys->slug;
          $i++;
      }
      $category[$categorys->term_id] = $categorys->name;
  }
  return $category;
}


function gardenia_customize_register( $wp_customize ) {
$gardenia_options = get_option( 'gardenia_theme_options' );


  $wp_customize->add_panel(
    'general',
    array(
        'title' => __( 'General', 'gardenia' ),
        'description' => __('styling options','gardenia'),
        'priority' => 20, 
    )
  );
  
   //All our sections, settings, and controls will be added here
  $wp_customize->add_section(
    'TopHeaderSocialLinks',
    array(
      'title' => __('Top Header Social Accounts', 'gardenia'),
      'priority' => 120,
      'description' => __( 'In first input box, you need to add FONT AWESOME shortcode which you can find ' ,  'gardenia').'<a target="_blank" href="'.esc_url('https://fortawesome.github.io/Font-Awesome/icons/').'">'.__('here' ,  'gardenia').'</a>'.__(' and in second input box, you need to add your social media profile URL.', 'gardenia').'<br />'.__(' Enter the URL of your social accounts. Leave it empty to hide the icon.' ,  'gardenia'),
      'panel' => 'general'
    )
  );

$TopHeaderSocialIconDefault = array(
  array('url'=>$gardenia_options['fburl'],'icon'=>'fa-facebook'),
  array('url'=>$gardenia_options['twitter'],'icon'=>'fa-twiter'),
  array('url'=>$gardenia_options['gplus'],'icon'=>'fa-gplus'),
  array('url'=>$gardenia_options['linkedin'],'icon'=>'fa-linkedin'),
  array('url'=>$gardenia_options['pinterest'],'icon'=>'fa-pinterest'),
  array('url'=>$gardenia_options['rss'],'icon'=>'fa-rss'),
  );

$TopHeaderSocialIcon = array();
  for($i=1;$i <= 6;$i++):  
    $TopHeaderSocialIcon[] =  array( 'slug'=>sprintf('TopHeaderSocialIcon%d',$i),   
      'default' => $TopHeaderSocialIconDefault[$i-1]['icon'],   
      'label' => esc_html__( 'Social Account ', 'gardenia') .$i,   
      'priority' => sprintf('%d',$i) );  
  endfor;
  foreach($TopHeaderSocialIcon as $TopHeaderSocialIcons){
    $wp_customize->add_setting(
      $TopHeaderSocialIcons['slug'],
      array( 
       'default' => $TopHeaderSocialIcons['default'],       
        'capability'     => 'edit_theme_options',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
      )
    );
    $wp_customize->add_control(
      $TopHeaderSocialIcons['slug'],
      array(
        'type'  => 'text',
        'section' => 'TopHeaderSocialLinks',
        'input_attrs' => array( 'placeholder' => esc_attr__('Enter Icon','gardenia') ),
        'label'      =>   $TopHeaderSocialIcons['label'],
        'priority' => $TopHeaderSocialIcons['priority']
      )
    );
  }
  $TopHeaderSocialIconLink = array();
  for($i=1;$i <= 6;$i++):  
    $TopHeaderSocialIconLink[] =  array( 'slug'=>sprintf('TopHeaderSocialIconLink%d',$i),   
      'default' => $TopHeaderSocialIconDefault[$i-1]['url'],   
      'label' => esc_html__( 'Social Link ', 'gardenia' ) .$i,
      'priority' => sprintf('%d',$i) );  
  endfor;
  foreach($TopHeaderSocialIconLink as $TopHeaderSocialIconLinks){
    $wp_customize->add_setting(
      $TopHeaderSocialIconLinks['slug'],
      array(
        'default' => $TopHeaderSocialIconLinks['default'],
        'capability'     => 'edit_theme_options',
        'type' => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
      )
    );
    $wp_customize->add_control(
      $TopHeaderSocialIconLinks['slug'],
      array(
        'type'  => 'text',
        'section' => 'TopHeaderSocialLinks',
        'priority' => $TopHeaderSocialIconLinks['priority'],
        'input_attrs' => array( 'placeholder' => esc_html__('Enter URL','gardenia')),
      )
    );
  }
  
  $wp_customize->get_section('title_tagline')->panel = 'general';
  $wp_customize->get_section('static_front_page')->panel = 'general';
  $wp_customize->get_section('header_image')->panel = 'general';
  $wp_customize->get_section('title_tagline')->title = __('Header & Logo','gardenia');
  
$wp_customize->add_section(
  'headerNlogo',
  array(
    'title' => __('Header & Logo','gardenia'),
    'panel' => 'general'
  )
);

$wp_customize->add_setting(
  'theme_logo_height',
  array(
    'default' => '',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'absint',
    )
  );
$wp_customize->add_control(
  'theme_logo_height',
  array(
    'section' => 'title_tagline',
    'label'      => __('Enter Logo Size', 'gardenia'),
    'description' => __("Use if you want to increase or decrease logo size (optional) Don't enter `px` in the string. e.g. 20 (default: 10px)",'gardenia'),
    'type'       => 'text',
    'priority'    => 50,
    )
  );

$wp_customize->add_setting(
  'theme_email_id',
  array(
    'default' => $gardenia_options['email'],
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
  );
$wp_customize->add_control(
  'theme_email_id',
  array(
    'section' => 'title_tagline',
    'label'      => __('Enter Email id', 'gardenia'),
    'description' => __("Enter e-mail id for your site , you would like to display in the Top Header.",'gardenia'),
    'type'       => 'text',
    'priority'    => 50,
    )
  );

$wp_customize->add_setting(
  'theme_phone_number',
  array(
    'default' => $gardenia_options['phone'],
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
  );
$wp_customize->add_control(
  'theme_phone_number',
  array(
    'section' => 'title_tagline',
    'label'      => __('Enter Phone Number', 'gardenia'),
    'description' => __("Enter phone number for your site , you would like to display in the Top Header.",'gardenia'),
    'type'       => 'text',
    'priority'    => 54,
    )
  );


/*-------------------- Home Page Option Setting --------------------------*/
$wp_customize->add_panel(
    'frontpage_section',
    array(
        'title' => __( 'Front Page Options', 'gardenia' ),
        'description' => __('Front Page options','gardenia'),
        'priority' => 20, 
    )
  );



$wp_customize->add_section( 'frontpage_slider_section' ,
   array(
      'title'       => __( 'Front Page : Banner Slider', 'gardenia' ),
      'priority'    => 32,
      'capability'     => 'edit_theme_options', 
      'panel' => 'frontpage_section'   
  )
);
 for($i=1;$i <= 5;$i++):  

    $wp_customize->add_setting(
        'gardenia_homepage_sliderimage'.$i.'_image',
        array(
            'default' => gardenia_get_image_id($gardenia_options['slider-img-'.$i]),
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'gardenia_homepage_sliderimage'.$i.'_image', array(
        'section'     => 'frontpage_slider_section',
        'label'       => __( 'Upload Slider Image ' ,'gardenia').$i,
        'flex_width'  => true,
        'flex_height' => true,
        'width'       => 1350,
        'height'      => 550,   
        'default-image' => '',
    ) ) );

    $wp_customize->add_setting( 'gardenia_homepage_sliderimage'.$i.'_title',
        array(
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'priority' => 20, 
        )
    );
    $wp_customize->add_control( 'gardenia_homepage_sliderimage'.$i.'_title',
        array(
            'default' => esc_html__('Slider Title','gardenia') . $i,
            'section' => 'frontpage_slider_section',                
            'label'   => __('Enter Slider Title ','gardenia').$i,
            'type'    => 'text',
            'input_attrs' => array( 'placeholder' => esc_html__('Enter Slider Title','gardenia')),
        )
    ); 
    $wp_customize->add_setting( 'gardenia_homepage_sliderimage'.$i.'_content',
        array(
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'priority' => 22, 
        )
    );
    $wp_customize->add_control( 'gardenia_homepage_sliderimage'.$i.'_content',
        array(
            'default' => esc_html__('Slider Content','gardenia') . $i,
            'section' => 'frontpage_slider_section',                
            'label'   => __('Enter Slider Content ','gardenia').$i,
            'type'    => 'textarea',
            'input_attrs' => array( 'placeholder' => esc_html__('Enter Slider Content','gardenia')),
        )
    );   
    $wp_customize->add_setting( 'gardenia_homepage_sliderimage'.$i.'_link',
        array(
            'default' => $gardenia_options['slidelink-'.$i],
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw',
            'priority' => 20, 
        )
    );
    $wp_customize->add_control( 'gardenia_homepage_sliderimage'.$i.'_link',
        array(
            'section' => 'frontpage_slider_section',                
            'label'   => __('Enter Slider Link ','gardenia').$i,
            'type'    => 'text',
            'input_attrs' => array( 'placeholder' => esc_html__('Enter Slider URL','gardenia')),
        )
    );
 endfor;

//Title Bar
$wp_customize->add_section( 'frontpage_title_bar_section' ,
   array(
      'title'       => __( 'Front Page : Title Bar', 'gardenia' ),
      'priority'    => 32,
      'capability'     => 'edit_theme_options', 
      'panel' => 'frontpage_section'   
  )
);
$wp_customize->add_setting( 'gardenia_homepage_section_title',
    array(
        'default' => $gardenia_options['home-title'],
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'priority' => 20, 
    )
);
$wp_customize->add_control( 'gardenia_homepage_section_title',
    array(
        'section' => 'frontpage_title_bar_section',                
        'label'   => __('Enter Title ','gardenia'),
        'description' => __("Enter home page title for your site , you would like to display in the Home Page.",'gardenia'),
        'type'    => 'text',
        'input_attrs' => array( 'placeholder' => esc_html__('Enter Title','gardenia')),
    )
);

$wp_customize->add_setting( 'gardenia_homepage_section_desc',
    array(  
        'default' => $gardenia_options['home-content'],    
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'wp_kses_post',
        'priority' => 20, 
    )
);
$wp_customize->add_control( 'gardenia_homepage_section_desc',
    array(
        'section' => 'frontpage_title_bar_section',                
        'label'   => __('Enter Short Description ','gardenia'),
        'description' => __("Enter content for your site , you would like to display in the Home Page.",'gardenia'),
        'type'    => 'textarea',
        'input_attrs' => array( 'placeholder' => esc_html__('Enter Description','gardenia')),
    )
); 

/* Front page First section */
$wp_customize->add_section( 'frontpage_first_section' ,
   array(
      'title'       => __( 'Front Page : First Section', 'gardenia' ),
      'priority'    => 32,
      'capability'     => 'edit_theme_options', 
      'panel' => 'frontpage_section'   
  )
);

/*gardenia_homepage_sectionswitch*/
$wp_customize->add_setting(
    'gardenia_homepage_first_sectionswitch',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'gardenia_field_sanitize_input_choice',
    )
);
$wp_customize->add_control(
    'gardenia_homepage_first_sectionswitch',
    array(
        'section' => 'frontpage_first_section',
        'label'      => __('Service Section', 'gardenia'),
        'description' => __('Service Section hide or show .','gardenia'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Show", 'gardenia' ),
          "2"   => esc_html__( "Hide", 'gardenia' ),      
        ),
    )
);

for($i=1;$i <= 4;$i++):
   $wp_customize->add_setting(
        'gardenia_homepage_first_section'.$i.'_image',
        array(
            'default' => gardenia_get_image_id($gardenia_options['home-icon-'.$i]),
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'gardenia_homepage_first_section'.$i.'_image', array(
        'section'     => 'frontpage_first_section',
        'label'       => __( 'Upload Service Image ' ,'gardenia').$i,
        'flex_width'  => true,
        'flex_height' => true,
        'width'       => 150,
        'height'      => 150,   
        'default-image' => '',
    ) ) );

  $wp_customize->add_setting( 'gardenia_homepage_first_section'.$i.'_title',
      array(
          'default' => $gardenia_options['section-title-'.$i],
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'priority' => 20, 
      )
  );
  $wp_customize->add_control( 'gardenia_homepage_first_section'.$i.'_title',
      array(
          'section' => 'frontpage_first_section',                
          'label'   => __('Enter Service Title ','gardenia').$i,
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter title','gardenia')),
      )
  );

  $wp_customize->add_setting( 'gardenia_homepage_first_section'.$i.'_desc',
      array( 
          'default' => $gardenia_options['section-content-'.$i],     
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'wp_kses_post',
          'priority' => 20, 
      )
  );
  $wp_customize->add_control( 'gardenia_homepage_first_section'.$i.'_desc',
      array(
          'section' => 'frontpage_first_section',                
          'label'   => __('Enter Service Description ','gardenia').$i,
          'type'    => 'textarea',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Description','gardenia')),
      )
  );

  $wp_customize->add_setting( 'gardenia_homepage_first_section'.$i.'_link',
      array(
          'default' => $gardenia_options['section-link-' . $i],
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'esc_url_raw',
          'priority' => 20, 
      )
  );
  $wp_customize->add_control( 'gardenia_homepage_first_section'.$i.'_link',
      array(
          'section' => 'frontpage_first_section',                
          'label'   => __('Enter Service Link ','gardenia').$i,
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter URL','gardenia')),
      )
  ); 
endfor;

/* Front page Second section */
$wp_customize->add_section( 'frontpage_second_section' ,
   array(
      'title'       => __( 'Front Page : Second Section', 'gardenia' ),
      'priority'    => 32,
      'capability'     => 'edit_theme_options', 
      'panel' => 'frontpage_section'   
  )
);

/*gardenia_homepage_sectionswitch*/
$wp_customize->add_setting(
    'gardenia_homepage_second_sectionswitch',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'gardenia_field_sanitize_input_choice',
    )
);
$wp_customize->add_control(
    'gardenia_homepage_second_sectionswitch',
    array(
        'section' => 'frontpage_second_section',
        'label'      => __('Second Section', 'gardenia'),
        'description' => __('Second Section hide or show .','gardenia'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Show", 'gardenia' ),
          "2"   => esc_html__( "Hide", 'gardenia' ),      
        ),
    )
);

$wp_customize->add_setting( 'gardenia_homepage_second_section_title',
      array(
          'default' => $gardenia_options['post-title'],
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'priority' => 20, 
      )
  );
  $wp_customize->add_control( 'gardenia_homepage_second_section_title',
      array(
          'section' => 'frontpage_second_section',                
          'label'   => __('Enter Second Section Title ','gardenia'),
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Title','gardenia')),
      )
  );

  $wp_customize->add_setting( 'gardenia_homepage_second_section_desc',
      array( 
          'default' => $gardenia_options['post-content'],     
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'wp_kses_post',
          'priority' => 20, 
      )
  );
  $wp_customize->add_control( 'gardenia_homepage_second_section_desc',
      array(
          'section' => 'frontpage_second_section',                
          'label'   => __('Enter Short Description','gardenia'),
          'type'    => 'textarea',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Description','gardenia')),
      )
  );
  $wp_customize->add_setting(
    'gardenia_homepage_second_section_category',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'gardenia_field_sanitize_input_choice',
    )
);
$wp_customize->add_control(
    'gardenia_homepage_second_section_category',
    array(
        'section' => 'frontpage_second_section',
        'label'      => __('Select Category', 'gardenia'),
        'description' => __('Select Categories of posts for your site , you would like to display in the Home Page.','gardenia'),
        'type'       => 'select',
        'choices' => gardenia_posts_category(),
    )
);


//Footer Section
$wp_customize->add_section( 'footerCopyright' , array(
    'title'       => __( 'Footer', 'gardenia' ),
    'priority'    => 100,
    'capability'     => 'edit_theme_options',
  ) );

$wp_customize->add_setting(
    'footertext',
    array(
        'default' => $gardenia_options['footertext'],
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'wp_kses_post',
        'priority' => 20, 
    )
);
$wp_customize->add_control(
    'footertext',
    array(
        'section' => 'footerCopyright',                
        'label'   => __('Enter Copyright Text','gardenia'),
        'type'    => 'textarea',
    )
);

// Text Panel Starts Here 

}
add_action( 'customize_register', 'gardenia_customize_register' );

function gardenia_custom_css(){
  wp_enqueue_style('gardenia-style',get_stylesheet_uri(),array(),NULL);  
  $custom_css='';
  
  $theme_logo_height = (get_theme_mod('theme_logo_height'))?(get_theme_mod('theme_logo_height')):50;
  $custom_css.= ".logo img{ max-height: ".esc_attr($theme_logo_height)."px;   }";

  wp_add_inline_style( 'gardenia-style', $custom_css ); 
}