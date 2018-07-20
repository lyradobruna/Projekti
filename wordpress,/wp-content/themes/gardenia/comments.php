<?php
/**
 * The Comments template file
 *
**/
?>
<div class="clearfix"></div>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : 	?>	
	<h2>
		<?php 
	     $comment = sprintf( 'Response to "%1$s"', get_the_title()); 
	     echo esc_html($comment);?>	
	</h2>
	<div class="comments-box clearfix ">		
		<?php wp_list_comments( array( 'short_ping' => true) );
		paginate_comments_links(); ?>	
	</div>	
	<?php else : ?>
	<p id="comments_status"><?php esc_html_e('No comments.','gardenia');?></p>
	<?php endif;  ?>
</div>
<?php comment_form(); ?>