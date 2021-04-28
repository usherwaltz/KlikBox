<?php 
/**
 * Single field 
 */
?>
<div id='<?php echo esc_attr( $field['id'] ); ?>' class='iconic-onboard-modal-setting__setting iconic-onboard-modal-setting--type-<?php echo esc_attr( $field["type"] ) ?>'  >
    <p class='iconic-onboard-modal-setting__title'>
        <?php echo esc_html( $field['title'] );?>
    </p>
    <div class='iconic-onboard-modal-setting__field'>
		<?php Iconic_WooThumbs_Onboard_Settings::do_field_method( $field ); ?>
	</div>
</div>