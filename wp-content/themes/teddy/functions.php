<?php
/**
 * The theme functions file
 *
 * @package Simple Blog Theme
 */

/* enqueue styles and scripts */
function jpen_enqueue_assets() {
  /* theme's primary style.css file */
  wp_enqueue_style( 'main-css' , get_stylesheet_uri() );

  /* template's primary css file */
  wp_enqueue_style( 'startup-boostrap-css' , get_template_directory_uri() . './css/blog-post.css' );

  /* boostrap resources from theme files */
  wp_enqueue_style( 'bootstrap-css' , get_template_directory_uri() . '/css/bootstrap.min.css' );

  wp_enqueue_style( 'bootstrap-css2' , get_template_directory_uri() . '/css/animate.css' );

  wp_enqueue_style( 'bootstrap-css3' , get_template_directory_uri() . '/css/blog-post.css' );

  wp_enqueue_style( 'bootstrap-css4' , get_template_directory_uri() . '/css/blue.css' );

  wp_enqueue_style( 'bootstrap-css5' , get_template_directory_uri() . '/css/icomoon.css' );

  wp_enqueue_style( 'bootstrap-css6' , get_template_directory_uri() . '/css/magnific-popup.css' );

  wp_enqueue_style( 'bootstrap-css2' , get_template_directory_uri() . '/css/simple-line-icons.css' );

  wp_enqueue_style( 'bootstrap-css3' , get_template_directory_uri() . '/css/style.css' );

  wp_enqueue_style( 'bootstrap-css4' , get_template_directory_uri() . '/css/style2.css' );

  wp_enqueue_style( 'bootstrap-css5' , get_template_directory_uri() . '/css/style3.css' );

  wp_enqueue_style( 'bootstrap-css6' , get_template_directory_uri() . '/css/style4.css' );








  wp_enqueue_script( 'bootstrap-js' , get_template_directory_uri() . '/js/bootstrap.min.js' , array( 'jquery' ) , false , true );

  wp_enqueue_script( 'google-map-js' , get_template_directory_uri() . '/js/google_map.js' , "" , false , true );

  wp_enqueue_script( 'jquery-countTo' , get_template_directory_uri() . '/js/jquery.countTo.js' , array( 'jquery' ) , false , true );


  wp_enqueue_script( 'jquery-magnific-popup-js' , get_template_directory_uri() . '/js/jquery.magnific-popup.min.js' , array( 'jquery' ) , false , true );

  wp_enqueue_script( 'jquery-stellar-min' , get_template_directory_uri() . '/js/jquery.stellar.min.js' , array( 'jquery' ) , false , true );

  wp_enqueue_script( 'jquery-easing-1-3' , get_template_directory_uri() . '/js/jquery.easing.1.3.js' , array( 'jquery' ) , false , true );



  wp_enqueue_script( 'jquery-style-switcher' , get_template_directory_uri() . '/js/jquery.style.switcher.js' , array( 'jquery' ) , false , true );

  wp_enqueue_script( 'jquery-waypoints-min' , get_template_directory_uri() . '/js/jquery.waypoints.min.js' , array( 'jquery' ) , false , true );

  wp_enqueue_script( 'magnific-popup-options' , get_template_directory_uri() . '/js/magnific-popup-options.js' , array( 'jquery' ) , false , true );



  wp_enqueue_script( 'main-js' , get_template_directory_uri() . '/js/main.js' , array( 'jquery' ) , false , true );

  wp_enqueue_script( 'modernizr-js' , get_template_directory_uri() . '/js/modernizr-2.6.2.min.js' , array( 'jquery' ) , false , true );

  wp_enqueue_script( 'respond-js' , get_template_directory_uri() . '/js/respond.min.js' , array( 'jquery' ) , false , true );






  /*conditional resources for IE 9 */
  wp_enqueue_script( 'simple-blog-html5', 'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js' , array(), '3.7.0' );
  wp_script_add_data( 'simple-blog-html5', 'conditional', 'lt IE 9' );
  wp_enqueue_script( 'simple-blog-respondjs', 'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js' , array(), '1.4.2' );
  wp_script_add_data( 'simple-blog-respondjs', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts' , 'jpen_enqueue_assets' );


/* add theme menu area */
register_nav_menus (array(
  'primary' => 'Primary Menu',
));


/* add theme supports */
add_theme_support( 'post-thumbnails' );


/* add img-responsive class to all images */
function jpen_add_responsive_class($content){

  $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
  $document = new DOMDocument();
  libxml_use_internal_errors(true);
  $document->loadHTML(utf8_decode($content));

  $imgs = $document->getElementsByTagName('img');
  foreach ($imgs as $img) {
     $img->setAttribute('class','img-responsive');
  }

  $html = $document->saveHTML();
  return $html;
}
add_filter( 'the_content', 'jpen_add_responsive_class');


/* register widget areas */
function jpen_sidebar_widget_area() {
  register_sidebar( array(
    'name'          => 'Sidebar Widget Area',
    'id'            => 'jpen-sidebar-widgets',
    'before_widget' => '<div class="well">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
    ));
}
add_action( 'widgets_init' , 'jpen_sidebar_widget_area' );



/*return formatted excerpt */
/* code courtesy of Pieter Goosen at WordPress StackExchange */
/* http://wordpress.stackexchange.com/questions/141125/allow-html-in-excerpt#answer-141136 */
function jpen_allowedtags() {
    // Add custom tags to this string
        return '<table>,<thead>,<tbody>,<tfoot>,<tr>,<td>,<th>,<h1>,<h2>,<h3>,<script>,<style>,<br>,<em>,<i>,<ul>,<ol>,<li>,<a>,<p>,<img>,<video>,<audio>';
    }

if ( ! function_exists( 'jpen_custom_wp_trim_excerpt' ) ) :

  function jpen_custom_wp_trim_excerpt($jpen_excerpt) {
  $raw_excerpt = $jpen_excerpt;
    if ( '' == $jpen_excerpt ) {

      $jpen_excerpt = get_the_content('');
      $jpen_excerpt = strip_shortcodes( $jpen_excerpt );
      $jpen_excerpt = apply_filters('the_content', $jpen_excerpt);
      $jpen_excerpt = str_replace(']]>', ']]&gt;', $jpen_excerpt);
      $jpen_excerpt = strip_tags($jpen_excerpt, jpen_allowedtags()); /*IF you need to allow just certain tags. Delete if all tags are allowed */

      //Set the excerpt word count and only break after sentence is complete.
      $excerpt_word_count = 75;
      $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count);
      $tokens = array();
      $excerptOutput = '';
      $count = 0;

      // Divide the string into tokens; HTML tags, or words, followed by any whitespace
      preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $jpen_excerpt, $tokens);

      foreach ($tokens[0] as $token) {

        if ($count >= $excerpt_length && preg_match('/[\,\;\?\.\!]\s*$/uS', $token)) {
        // Limit reached, continue until , ; ? . or ! occur at the end
          $excerptOutput .= trim($token);
          break;
        }

        // Add words to complete sentence
        $count++;

        // Append what's left of the token
        $excerptOutput .= $token;
      }

      $jpen_excerpt = trim(force_balance_tags($excerptOutput));

      //$excerpt_end = ' <a href="'. esc_url( get_permalink() ) . '">' . '&nbsp;&raquo;&nbsp;' . sprintf(__( 'Read more about: %s &nbsp;&raquo;', 'jpen' ), get_the_title()) . '</a>';
      $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);

      //$pos = strrpos($jpen_excerpt, '</');
      //if ($pos !== false)
      // Inside last HTML tag
      //$jpen_excerpt = substr_replace($jpen_excerpt, $excerpt_end, $pos, 0); /* Add read more next to last word */
      //else
      // After the content
      $jpen_excerpt .= $excerpt_more; /*Add read more in new paragraph */

    return $jpen_excerpt;

    }
  return apply_filters('jpen_custom_wp_trim_excerpt', $jpen_excerpt, $raw_excerpt);
  }

endif;

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'jpen_custom_wp_trim_excerpt');



/* Walker class for comments */
/* Adapted from GitHub Gist by Georgie Luhur */
/* Original: https://gist.github.com/georgiecel/9445357 */
class comment_walker extends Walker_Comment {
  var $tree_type = 'comment';
  var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );

  // constructor – wrapper for the comments list
  function __construct() { ?>
    <section class="comments-list">
  <?php }

  // start_lvl – wrapper for child comments list
  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $GLOBALS['comment_depth'] = $depth + 2; ?>
    <div class="media">
  <?php }

  // end_lvl – closing wrapper for child comments list
  function end_lvl( &$output, $depth = 0, $args = array() ) {
    $GLOBALS['comment_depth'] = $depth + 2; ?>
    </div>
  <?php }

  // start_el – HTML for comment template
  function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
    $depth++;
    $GLOBALS['comment_depth'] = $depth;
    $GLOBALS['comment'] = $comment;
    $parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' );

    if ( 'article' == $args['style'] ) {
      $tag = 'article';
      $add_below = 'comment';
    } else {
      $tag = 'article';
      $add_below = 'comment';
    } ?>

    <div class="media" <?php comment_class(empty( $args['has_children'] ) ? '' :'parent') ?> id="comment-<?php comment_ID() ?>" itemprop="comment" itemscope itemtype="http://schema.org/Comment">
      <a class="pull-left comment-author-link" href="<?php comment_author_url(); ?>" itemprop="author">
        <figure class="media-object gravatar"><?php echo get_avatar( $comment, 65, '[default gravatar URL]', 'Author’s gravatar' ); ?></figure>
      </a>
      <div class="media-body comment-meta post-meta" role="complementary">
        <h4 class="media-heading comment-author">
          <?php comment_author(); ?>
          <small><time class="comment-meta-item" datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished"><?php comment_date('jS F Y') ?> at <a href="#comment-<?php comment_ID() ?>" itemprop="url"><?php comment_time() ?></a></time></small>
        </h4>
        <?php if ($comment->comment_approved == '0') : ?>
        <p class="comment-meta-item">Your comment is awaiting moderation.</p>
        <?php endif; ?>
        <?php comment_text() ?>
        <small><?php edit_comment_link('Edit this comment','You can ',' or '); ?><?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></small>

    <?php }

  // end_el – closing HTML for comment template
  function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>
    </div></div>
  <?php }

  // destructor – closing wrapper for the comments list
  function __destruct() { ?>
    </section>
  <?php }

  }



/* Sidebar Categories Widget */

// create category list widget
class jpen_Category_List_Widget extends WP_Widget {

  // php classnames and widget name/description added
  function __construct() {
    $widget_options = array(
      'classname' => 'jpen_category_list_widget',
      'description' => 'Add a nicely formatted list of categories to your sidebar.'
    );
    parent::__construct(
      'jpen_category_list_widget',
      'Simple Blog Theme Category List',
      $widget_options
    );
  }


  // create the widget output
  function widget( $args, $instance ) {

    $title = apply_filters( 'widget_title', $instance[ 'title' ] );
    $categories = get_categories( array(
      'orderby' => 'name',
      'order'   => 'ASC'
      ) );
    $cat_count = 0;
    $cat_col_one = [];
    $cat_col_two = [];
    foreach( $categories as $category ) {
      $cat_count ++;
      $category_link = sprintf(
          '<li class="list-unstyled"><a href="%1$s" alt="%2$s">%3$s</a></li>',
          esc_url( get_category_link( $category->term_id ) ),
          esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
          esc_html( $category->name )
      );
      if ($cat_count % 2 != 0 ) {
        $cat_col_one[] = $category_link;
      } else {
        $cat_col_two[] = $category_link;
      }
    }

    echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];

    ?><div class="row">
      <div class="col-lg-6"><?php
        foreach( $cat_col_one as $cat_one ) {
          echo $cat_one;
        } ?>
      </div>

      <div class="col-lg-6"><?php
        foreach( $cat_col_two as $cat_two ) {
          echo $cat_two;
        } ?>
      </div>

    </div><?php
    echo $args['after_widget'];
  }

  function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : ''; ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
      <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <p>This widget displays all of your post categories as a two-column list (or a one-column list when rendered responsively).</p>
  <?php }

  // Update database with new info
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
    return $instance;
  }
}


// register the widget
function jpen_register_widgets() {
  register_widget( 'jpen_Category_List_Widget' );
}
add_action( 'widgets_init', 'jpen_register_widgets' );

?>
