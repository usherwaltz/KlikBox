<div style="display:none;">
    <div id="iconic-onboard-modal" class="iconic-onboard-modal <?php echo $model_class; ?>">
        <form action="" class="iconic-onboard-modal__form">
            <div class="iconic-onboard-modal__slides">
                <?php 
                foreach( $slides as $slide_index => $slide ) {
                    $slide       = wp_parse_args( $slide, $defaults );
                    $action_data = array(
                        "slide_index" => $slide_index,
                        "slide" => $slide,
                        "plugin_slug" => $plugin_slug
                    );
                    $is_first    = $slide_index === 0;
                    $is_last     = $slide_index === count( $slides ) - 1;
                    $has_fields  = ! empty( $slide["fields"] );
                    $btn_class   = $is_last ? "iconic-onboard-modal__submit " : "iconic-onboard-modal__nextslide ";
                    $btn_class  .= isset( $slide["button_class"] ) ? $slide["button_class"] : "";
                ?>
                    <!-- slide starts -->
                    <div class="iconic-onboard-modal__slide iconic-onboard-modal__slide_<?php echo $slide_index + 1; ?>">
                        <?php do_action( "iconic_onboard_{$plugin_slug}_slide_before_header" , $action_data ); ?>

                        <?php if( ! empty( $slide["header_image"] ) ) { ?>
                            <div class="iconic-onboard-modal__header" style="background-image: url( '<?php echo esc_url( $slide["header_image"] ); ?>' );">
                                <?php do_action( "iconic_onboard_{$plugin_slug}_slide_header" , $action_data ); ?>
                            </div>
                        <?php } ?>
                        
                        <div class="iconic-onboard-modal__body" style="text-align:center;">
                            <?php do_action( "iconic_onboard_{$plugin_slug}_slide_body_starts", $action_data ); ?>
                            
                            <h2><?php echo $slide["title"]; ?></h2>
                                                    
                            <?php echo apply_filters( 'the_content', $slide["description"] ); ?>
                            
                            <?php if( $has_fields ) { ?> 
                                <div class="iconic-onboard-modal-setting" >
                                    <?php do_action( "iconic_onboard_{$plugin_slug}_slide_settings", $action_data ); ?>
                                </div >
                            <?php } ?>
                            
                            <a href="#" class="button button-large button-primary iconic-onboard-modal__button <?php echo $btn_class; ?>">
                                <?php echo strip_tags( $slide["button_text"] , "<span>"); ?>
                                <div class="iconic-onboard-modal__loader">Loading...</div>
                            </a>
                            
                            <?php do_action( "iconic_onboard_{$plugin_slug}_slide_after_button" , $action_data ); ?>
                        </div>
                        
                        <?php do_action( "iconic_onboard_{$plugin_slug}_slide_end", $action_data ); ?>
                    </div>
                    <!-- slide ends -->
                <?php } ?>
            </div> <!-- .iconic-onboard-modal__slides -->
        </form>
        
        <?php if( ! $disable_skip ) { ?>
            <div class="iconic-onboard-modal__dismiss">
                <a href="#" class="iconic-onboard-modal__dismiss_a"><?php _e( "Skip this, I'll set it up later.", "iconic-onboard" );?> </a>
            </div>
        <?php } ?>
    </div> <!-- .iconic-onboard-modal -->
</div>