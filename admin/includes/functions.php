<?php

/**
 * @link              http://averta.net
 * @since             1.0.0
 * @package           averta-maintenance
 */

/**
 * [prefix_get_option description]
 * @param  [type] $option  [description]
 * @param  [type] $section [description]
 * @param  string $default [description]
 * @return [type]          [description]
 */
function prefix_get_option( $option, $section, $default = '' ) {
	if ( empty( $option ) )
		return;
    $options = get_option( $section );
    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }
    return $default;
}

add_action( 'wsa_form_bottom_action', 'test' );
function test() {
	?>
	<script>
		jQuery(document).ready(function($) {
		    jQuery('#mec_add_ticket_button').on('click', function()
		    {
		    	console.log('h');
		        var key = jQuery('#mec_new_ticket_key').val();
		        var html = jQuery('#mec_new_ticket_raw').html().replace(/:i:/g, key);
		        
		        jQuery('#mec_tickets').append(html);
		        jQuery('#mec_new_ticket_key').val(parseInt(key)+1);
		    });
		});
		    function mec_ticket_remove(i) {
			    jQuery("#mec_ticket_row"+i).remove();
			}

	</script>
	    <div class="mec-meta-box-fields" id="mec-tickets">
            <h4 class="mec-meta-box-header"><?php _e('Tickets', 'mec'); ?></h4>
            <div class="mec-meta-box-fields" id="mec_meta_box_tickets_form">
                <div class="mec-form-row">
                    <button class="button" type="button" id="mec_add_ticket_button"><?php _e('Add', 'mec'); ?></button>
                </div>
                <div id="mec_tickets">
                    <?php $i = 0; foreach($tickets as $key=>$ticket): if(!is_numeric($key)) continue; $i = max($i, $key); ?>
                    <div class="mec-box" id="mec_ticket_row<?php echo $key; ?>">
                        <div class="mec-form-row">
                            <input type="text" class="mec-col-12" name="mec[tickets][<?php echo $key; ?>][name]" placeholder="<?php esc_attr_e('Ticket Name', 'mec'); ?>" value="<?php echo (isset($ticket['name']) ? esc_attr($ticket['name']) : ''); ?>" />
                        </div>
                        <div class="mec-form-row">
                            <span class="mec-col-4">
                                <input type="text" name="mec[tickets][<?php echo $key; ?>][price]" placeholder="<?php esc_attr_e('Price', 'mec'); ?>" value="<?php echo (isset($ticket['price']) ? esc_attr($ticket['price']) : ''); ?>" />
                                <a class="mec-tooltip" title="<?php esc_attr_e('Insert 0 for free ticket. Only numbers please.', 'mec'); ?>"><i title="" class="dashicons-before dashicons-editor-help"></i></a>
                            </span>
                            <span class="mec-col-8">
                                <input type="text" name="mec[tickets][<?php echo $key; ?>][price_label]" placeholder="<?php esc_attr_e('Price Label', 'mec'); ?>" value="<?php echo (isset($ticket['price_label']) ? esc_attr($ticket['price_label']) : ''); ?>" class="mec-col-12" />
                                <a class="mec-tooltip" title="<?php esc_attr_e('For showing on website. e.g. $15', 'mec'); ?>"><i title="" class="dashicons-before dashicons-editor-help"></i></a>
                            </span>
                        </div>
                        <div class="mec-form-row">
                            <input class="mec-col-4" type="text" name="mec[tickets][<?php echo $key; ?>][limit]" placeholder="<?php esc_attr_e('Available Tickets', 'mec'); ?>" value="<?php echo (isset($ticket['limit']) ? esc_attr($ticket['limit']) : '100'); ?>" />
                            <label class="mec-col-2" for="mec_tickets_unlimited_<?php echo $key; ?>" id="mec_bookings_limit_unlimited_label<?php echo $key; ?>">
                                <input type="hidden" name="mec[tickets][<?php echo $key; ?>][unlimited]" value="0" />
                                <input id="mec_tickets_unlimited_<?php echo $key; ?>" type="checkbox" value="1" name="mec[tickets][<?php echo $key; ?>][unlimited]" <?php if(isset($ticket['unlimited']) and $ticket['unlimited']) echo 'checked="checked"'; ?> />
                                <?php _e('Unlimited', 'mec'); ?>
                            </label>
                            <button class="button" type="button" onclick="mec_ticket_remove(<?php echo $key; ?>);"><?php _e('Remove', 'mec'); ?></button>
                        </div>
					</div>
                    <?php endforeach; ?>
                </div>
            </div>
            <input type="hidden" id="mec_new_ticket_key" value="<?php echo $i+1; ?>" />
            <div class="mec-util-hidden" id="mec_new_ticket_raw">
                <div class="mec-box" id="mec_ticket_row:i:">
                    <div class="mec-form-row">
                        <input class="mec-col-12" type="text" name="mec[tickets][:i:][name]" placeholder="<?php esc_attr_e('Ticket Name', 'mec'); ?>" />
                    </div>
					<div class="mec-form-row">
                        <span class="mec-col-4">
                            <input type="text" name="mec[tickets][:i:][price]" placeholder="<?php esc_attr_e('Price', 'mec'); ?>" />
                            <a class="mec-tooltip" title="<?php esc_attr_e('Insert 0 for free ticket. Only numbers please.', 'mec'); ?>"><i title="" class="dashicons-before dashicons-editor-help"></i></a>
                        </span>
                        <span class="mec-col-8">
                            <input type="text" name="mec[tickets][:i:][price_label]" placeholder="<?php esc_attr_e('Price Label', 'mec'); ?>" class="mec-col-12" />
                            <a class="mec-tooltip" title="<?php esc_attr_e('For showing on website. e.g. $15', 'mec'); ?>"><i title="" class="dashicons-before dashicons-editor-help"></i></a>
                        </span>
					</div>
					<div class="mec-form-row">
                        <input class="mec-col-4" type="text" name="mec[tickets][:i:][limit]" placeholder="<?php esc_attr_e('Available Tickets', 'mec'); ?>" />
                        <label class="mec-col-4" for="mec_tickets_unlimited_:i:" id="mec_bookings_limit_unlimited_label">
                            <input type="hidden" name="mec[tickets][:i:][unlimited]" value="0" />
                            <input id="mec_tickets_unlimited_:i:" type="checkbox" value="1" name="mec[tickets][:i:][unlimited]" />
                            <?php _e('Unlimited', 'mec'); ?>
                        </label>
                        <button class="button" type="button" onclick="mec_ticket_remove(:i:);"><?php _e('Remove', 'mec'); ?></button>
					</div>
                </div>
            </div>
        </div>
        <?php
}
