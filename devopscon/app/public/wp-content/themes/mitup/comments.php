<?php 
if (post_password_required()) return;

?>

<div class="container-fluid">
    <div class="row">
        
        <div class="content_comments">
            <div id="comments" class="comments">

                <?php if(have_comments()){ ?>
                    <div>
                        <h4 class="block-title"> 
                            <?php comments_number( esc_html__('0 Comment', 'mitup'), esc_html__( '1 Comment', 'mitup' ), esc_html__( '% Comments', 'mitup' ) ); ?>
                        </h4>
                    </div>

                <?php } ?>

                <?php if (have_comments()) { ?>
                    
                    <ul class="commentlists">
                        <?php wp_list_comments('callback=mitup_theme_comment'); ?>

                    </ul>

                   

                    <?php
                    if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
                        <footer class="navigation comment-navigation" role="navigation">
                            <div class="nav_comment_text"><?php esc_html_e( 'Comment navigation', 'mitup' ); ?></div>
                            <div class="previous"><?php previous_comments_link(__('&larr; Older Comments', 'mitup')); ?></div>
                            <div class="next right"><?php next_comments_link(__('Newer Comments &rarr;', 'mitup')); ?></div>
                        </footer>
                    <?php endif;?>

                    <?php if (!comments_open() && get_comments_number()) : ?>
                        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'mitup' ); ?></p>
                    <?php endif; ?>

                <?php } ?>

                <?php

                $aria_req = ($req ? " aria-required='true'" : '');
                $comment_args = array(
                    'title_reply' => wp_kses('<h4 class="block-title">' . esc_html__( 'Leave a reply', 'mitup' ) . '</h4>', true),
                    'fields' => apply_filters('comment_form_default_fields', array(
                        'author' => '<div class="col-md-6 comment_right"><input type="text" name="author" value="' . esc_attr($commenter['comment_author']) . '" ' . esc_attr($aria_req) . ' class="form-control" placeholder="'. esc_html__('Name','mitup') .'" />',
                        'email' => '<input type="text" name="email" value="' . esc_attr($commenter['comment_author_email']) . '" ' . esc_attr($aria_req) . ' class="form-control" placeholder="'. esc_html__('Email','mitup') .'" />',
                        'phone' => '<input type="text" name="url" value="' . esc_url($commenter['comment_author_url']) . '" ' . esc_attr($aria_req) . ' class="form-control" placeholder="'. esc_html__('Website','mitup') .'" /></div>',            
                        
                    )),
                    'comment_field' => '<div class="col-md-6 comment_left ">                               
                                                <textarea class="form-control" rows="7" name="comment" placeholder="'. esc_html__('Your Comment ...','mitup') .'"></textarea>
                                        </div>',
                    'label_submit' => esc_html__('Submit Comment','mitup'),
                    'comment_notes_before' => '',
                    'comment_notes_after' => '',
                );
                ?>

                <?php global $post; ?>
                <?php if ('open' == $post->comment_status) { ?>
                    <div class="commentform">
                        
                            <?php comment_form($comment_args); ?>
                        
                    </div><!-- end commentform -->
                <?php } ?>


            </div><!-- end comments -->
        </div>
        
    </div>
</div>


