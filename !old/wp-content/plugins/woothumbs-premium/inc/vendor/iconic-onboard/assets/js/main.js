( function ( $, document ) {
    var iconic_core_onboard = {
        modal: null,
        current_step: null,
        total_steps: null,
        sliding_timeout: null,
        /**
         * On ready.
         */
        on_ready: function () {
            var $modal = $( "#iconic-onboard-modal" );

            if ( $modal.length <= 0 ) {
                return;
            }

            if ( ! $modal.hasClass( "iconic-onboard-modal--disable-auto-popup" ) ) {
                iconic_core_onboard.open_modal();
            }
            
            //iconic_core_onboard.setup_toggle_switch();
            iconic_core_onboard.setup_next_prev();
            iconic_core_onboard.setup_modal_bullets();
            iconic_core_onboard.setup_submit();
            iconic_core_onboard.dismiss_handler();
            iconic_core_onboard.next_button();
            iconic_core_onboard.setup_image_fields_list();
            
            $( document ).on( 'iconic_onboard_disable_next', iconic_core_onboard.disable_next );
            $( document ).on( 'iconic_onboard_enable_next', iconic_core_onboard.enable_next );
            $( document ).on( 'iconic_onboard_next_slide', iconic_core_onboard.next_slide );
            $( document ).on( 'iconic_onboard_prev_slide', iconic_core_onboard.prev_slide );
        },

        /**
         * Open onboarding modal.
         */
        open_modal: function () {
            $.magnificPopup.open( {
                mainClass: 'iconic-onboard-modal-wrapper',
                closeOnBgClick: false,
                showCloseBtn: false,
                items: [
                    {
                        src: '#iconic-onboard-modal',
                        type: 'inline'
                    }
                ],
            } );

            iconic_core_onboard.modal = $.magnificPopup.instance;
        },

        /**
         * Setup toggle switch
         */
        setup_toggle_switch: function () {
            $( ".iconic-onboard-modal__body input" ).not( ".iconic-onboard-modal--disable-switch" ).toggleSwitch();
        },

        /**
         * Setup modal bullets.
         */
        setup_modal_bullets: function () {
            var bullets_html = this.generate_bullets_html();
            $( "#iconic-onboard-modal" ).append( bullets_html );
            iconic_core_onboard.show_slide( 0 );

            $( document ).on( 'click', '.iconic-onboard-modal-bullets__bullet', function ( e ) {
                e.preventDefault();
                if( ! $(this).hasClass( "iconic-onboard--disabled" ) ) {   
                    var step = parseInt( $( this ).data( 'step' ) );
                    iconic_core_onboard.show_slide( step );
                }
            } );
        },

        /**
         * Setup Next and Previous buttons
         */
        setup_next_prev: function () {
            var next_prev_html = `<div class='iconic-onboard-modal__next_prev'>
                                    <div class='iconic-onboard-modal__next'>
                                    </div>
                                    <div class='iconic-onboard-modal__prev'>
                                    </div>
                                   </div>`;
            $( "#iconic-onboard-modal" ).append( next_prev_html );

            $( document ).on( "click", ".iconic-onboard-modal__next", function () {
                if( ! $( ".iconic-onboard-modal__next" ).hasClass( "iconic-onboard--disabled" ) ) {   
                    iconic_core_onboard.next_slide();
                }
            } );

            $( document ).on( "click", ".iconic-onboard-modal__prev", function () {
                if( ! $(this).hasClass( "iconic-onboard--disabled" ) ) {
                    iconic_core_onboard.prev_slide();
                }
            } );
        },

        /**
         * Generates HTML for the modal bullets depending on the number of slides there are.
         */
        generate_bullets_html: function () {
            var html = `<ul class="iconic-onboard-modal-bullets">`;
            this.total_steps = $( ".iconic-onboard-modal__slide" ).length;

            for ( i = 0; i < this.total_steps; i++ ) {
                html += `<li >
                            <button class="iconic-onboard-modal-bullets__bullet" data-step="${i}">${i + 1}</button>
                        </li>`;
            }
            html += "</ul>";
            return html;
        },

        /**
         * Hides the current slide and shows the given slide.
         * 
         * @param string step. The index of slide to be shown.
         */
        show_slide: function ( step ) {
            // Do nothing if target step is current step.
            if ( step === this.current_step ) {
                return;
            }

            var $modal = $( "#iconic-onboard-modal" ),
                $bullets = $( ".iconic-onboard-modal-bullets li" ),
                $slides = $( ".iconic-onboard-modal__slides .iconic-onboard-modal__slide" ),
                $next = $( ".iconic-onboard-modal__next" ),
                $prev = $( ".iconic-onboard-modal__prev" );

            // Stop previous transition.
            clearTimeout( this.sliding_timeout );
            $modal.removeClass( 'iconic-onboard-modal--animate-right iconic-onboard-modal--animate-left' );
            
            var oldStep = this.current_step;
            
            // Bullets
            $bullets.removeClass( "iconic-onboard-modal-bullets__active" );
            $bullets.eq( step ).addClass( "iconic-onboard-modal-bullets__active" );

            // Slide content
            $slides.hide();
            var upcomingSlide = $slides.eq( step );
            upcomingSlide.fadeIn();
            
            // Animation
            var animation_class = this.current_step < step || this.current_step === null ? "iconic-onboard-modal--animate-right" : "iconic-onboard-modal--animate-left";
            $modal.addClass( animation_class );

            // Hide left navigation for first slide, and right navigation for last slide
            if ( step === 0 ) {
                $prev.hide();
                $next.show();
            }
            else if ( step === this.total_steps - 1 ) {
                $next.hide();
                $prev.show();
            }
            else {
                $prev.show();
                $next.show();
            }

            this.current_step = step;

            // Remove the animation class after animation has ended.
            this.sliding_timeout = setTimeout( function () {
                $modal.removeClass( animation_class );
            }, 1000 );
            
            $( document ).trigger( "iconic_onboard_step_change" , { from: oldStep, to: step } );
        },

        /**
         * Go to the next slide.
         */
        next_slide: function () {
            var next_step = iconic_core_onboard.current_step + 1;
            iconic_core_onboard.show_slide( next_step );
        },

        /**
         * Go to the previous slide.
         */
        prev_slide: function () {
            var prev_step = this.current_step - 1;
            iconic_core_onboard.show_slide( prev_step );
        },

        /**
         * Setup form submission.
         */
        setup_submit: function () {
            $( document ).on( 'click', '.iconic-onboard-modal__submit', function ( e ) {
                e.preventDefault();
                
                var $loader = $( this ).find( ".iconic-onboard-modal__loader" );
                $loader.css( "display" , "inline-block" );
                
                var data = {
                    action: "iconic_onboard_" + iconic_onboarding_params.plugin_slug + "_save_modal",
                    plugin_slug: iconic_onboarding_params.plugin_slug,
                    security: iconic_onboarding_params.nonce,
                    fields: $( '.iconic-onboard-modal__form' ).serialize(),
                };
                
                $.post( ajaxurl, data)
                .done(function( response ) {
                    try{
                        if( response.success ) {   
                            location.reload();
                        }
                    }
                    catch(ex) {
                        console.log( response );
                        console.log( ex );
                        alert( "Couldn't save." );
                    }
                })
                .fail(function() {
                    alert( "Couldn't save. Are you connected to the internet? " );
                })
                .always(function() {
                    $loader.css( "display" , "none" );
                });
                
                
            } );
        },

        /**
         * Handles the action when user clicks on "Skip" button.
         */
        dismiss_handler: function () {
            $( document ).on( "click", ".iconic-onboard-modal__dismiss_a", function ( e ) {
                e.preventDefault();
                iconic_core_onboard.modal.close();
                var data = {
                    action: "iconic_onboard_" + iconic_onboarding_params.plugin_slug + "_dismiss_modal",
                    plugin_slug: iconic_onboarding_params.plugin_slug,
                    security: iconic_onboarding_params.nonce,
                };
                $.post( ajaxurl, data, function () {
                    console.log( "OK" );
                } );
            } );
        },

        /**
         * Handles click for '.iconic-onboard-modal__nextslide'
         */
        next_button: function () {
            $( document ).on( "click", ".iconic-onboard-modal__nextslide", function () {
                var hasDisabledClass = $( ".iconic-onboard-modal__next" ).hasClass( "iconic-onboard--disabled" );
                if( ! hasDisabledClass ) {   
                    iconic_core_onboard.next_slide();
                }
            } );
        },

        /**
         * Handles click for '.iconic-onboard-modal__prevslide'
         */
        prev_button: function () {
            $( document ).on( "click", ".iconic-onboard-modal__prevslide", function () {
                iconic_core_onboard.prev_slide();
            } );
        },

        /**
         * Add checked class when radio button changes.
         */
        setup_image_fields_list: function() {
            var checked_class = 'iconic-onboard-fields-list__item--checked';

            $( document ).on( 'change', '.iconic-onboard-fields-list input[type="radio"]', function () {
                var $this = $( this ),
                    $list = $this.closest( '.iconic-onboard-fields-list' ),
                    $list_item = $this.closest( '.iconic-onboard-fields-list__item' ),
                    $checked = $list.find( '.' + checked_class );

                $checked.removeClass( checked_class );
                $list_item.addClass( checked_class );
            } );
        },
        
        /**
         * Disable the next slide button
         */
        disable_next: function() {
            $( ".iconic-onboard-modal__next" ).addClass( "iconic-onboard--disabled" );
            $( ".iconic-onboard-modal-bullets__bullet" ).addClass( "iconic-onboard--disabled" );
        },
        
        /**
         * Enable the next slide button
         */
        enable_next: function() {
            $( ".iconic-onboard-modal__next" ).removeClass( "iconic-onboard--disabled" );
            $( ".iconic-onboard-modal-bullets__bullet" ).removeClass( "iconic-onboard--disabled" );
        }

    };

    $( document ).ready( iconic_core_onboard.on_ready );
}( jQuery, document ) );