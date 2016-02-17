<?php
/**
 * WordPress settings API demo class
 *
 * @author Tareq Hasan
 */
require_once AVMA_DIR . 'admin/includes/class-settings-api.php' ; 
if ( !class_exists('Avma_Settings' ) ):
class Avma_Settings {
    private $settings_api;
    function __construct() {
        $this->settings_api = new Avma_Settings_API;
        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }
    function admin_init() {
        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );
        //initialize settings
        $this->settings_api->admin_init();
    }
    function admin_menu() {
        add_menu_page( 'Maintenance Page Plugin ', 'Averta Maintenance', 'delete_posts', 'avma-maintenace', array($this, 'plugin_page'),'dashicons-welcome-view-site',79
);
    }
    function get_settings_sections() {
        $sections = array(
            array(
                'id' => 'general_tab',
                'title' => __( 'General Settings', 'avla-maintenance' )
            ),
            array(
                'id' => 'design_tab',
                'title' => __( 'Design Settings', 'avla-maintenance' )
            ),
            array(
                'id' => 'com_tab',
                'title' => __( 'Contact Settings', 'avla-maintenance' )
            )
        );
        return $sections;
    }
    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            'general_tab' => array(
                array(
                    'name'              => 'avma_active',
                    'label'             => __( 'Plugin Activation', 'avla-maintenance' ),
                    'type'              => 'radio',
                    'options'           => array(
                                        'Active' => 'Active',
                                        'Deactive'  => 'Deactive'
                )),
                array(
                    'name'              => 'avma_notif',
                    'label'             => __( 'Dashboard Notifaction', 'avla-maintenance' ),
                    'desc'              => __( 'Reminder notifaction message appear on dashboard', 'avla-maintenance' ),
                    'type'              => 'checkbox'
                ),
                array(
                    'name'              => 'avma_exclude',
                    'label'             => __( 'Exclude', 'avla-maintenance' ),
                    'desc'              => __( 'Exclude Page From Maintenance Mode ( Seprate With Comma )', 'avla-maintenance' ),
                    'type'              => 'textarea'
                ), 
                array(
                    'name'              => 'avma_count',
                    'label'             => __( 'CountDown Activation', 'avla-maintenance' ),
                    'type'              => 'radio',
                    'options'           => array(
                                        'Active' => 'Active',
                                        'Deactive'  => 'Deactive'
                                        )
                ),
                array(
                    'name'              => 'avma_start_date',
                    'label'             => __( 'Date', 'avla-maintenance' ),
                    'desc'              => __( 'Automatically disable maintenace mode at this date(mm/dd/yyyy)', 'avla-maintenance' ),
                    'type'              => 'date',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_count_time',
                    'label'             => __( 'Count Timer', 'avla-maintenance' ),
                    'desc'              => __( 'Day/Hour/Minute (seprate with comma).', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_count_color',
                    'label'             => __( 'CountDown Color', 'avla-maintenance' ),
                    'desc'              => __( 'Pick CountDown Color ', 'avla-maintenance' ),
                    'type'              => 'color',
                    'default'           => ''
                ), 
            ),
            'design_tab' => array(
                array(
                    'name'              => 'avma_logo',
                    'label'             => __( 'Logo', 'avla-maintenance' ),
                    'desc'              => __( 'Choose logo for your maintenace page', 'avla-maintenance' ),
                    'type'              => 'file',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_title',
                    'label'             => __( 'Message Title', 'avla-maintenance' ),
                    'desc'              => __( 'Title of message that you want to display on your maintenace page.', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'vma_title_color',
                    'label'             => __( 'Message Title Color', 'avla-maintenance' ),
                    'desc'              => __( 'Pick Message Color ', 'avla-maintenance' ),
                    'type'              => 'color',
                    'default'           => ''
                ),
                array(
                    'name'              => 'vma_title_font',
                    'label'             => __( 'Message Title Font', 'avla-maintenance' ),
                    'type'              => 'select',
                    'options'           => array(
                        'source_sans' => 'Source Sans Pro',
                        'Raleway'     => 'Raleway',
                        'Droid_Sans'  => 'Droid Sans',
                        'Ubuntu'      => 'Ubuntu'
                    )
                ),               
                array(
                    'name'              => 'avma_describ',
                    'label'             => __( 'Maintenance Message', 'avla-maintenance' ),
                    'desc'              => __( '', 'avla-maintenance' ),
                    'type'              => 'textarea'
                ),
                array(
                    'name'              => 'avma_body_color',
                    'label'             => __( 'Message Title Color', 'avla-maintenance' ),
                    'desc'              => __( 'Pick Message Color ', 'avla-maintenance' ),
                    'type'              => 'color',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_body_font',
                    'label'             => __( 'Message Title Font', 'avla-maintenance' ),
                    'type'              => 'select',
                    'options'           => array(
                        'source_sans' => 'Source Sans Pro',
                        'Raleway'     => 'Raleway',
                        'Droid_Sans'  => 'Droid Sans',
                        'Ubuntu'      => 'Ubuntu'
                    )
                ),
                array(
                    'name'              => 'avma_bg',
                    'label'             => __( 'Background Image', 'avla-maintenance' ),
                    'desc'              => __( 'Choose background image for maintenace page', 'avla-maintenance' ),
                    'type'              => 'file',
                    'default'           => ''
                ),                   
                array(
                    'name'              => 'avma_bg_st',
                    'label'             => __( 'Strech Image', 'avla-maintenance' ),
                    'desc'              => __( 'Strech background image', 'avla-maintenance' ),
                    'type'              => 'checkbox'
                ),
                array(
                    'name'              => 'avma_effect',
                    'label'             => __( 'Background Effect', 'avla-maintenance' ),
                    'type'              => 'multicheck',
                    'options'           => array(
                        'blur'        => 'Blur',
                        'noise'       => 'Noise'
                    )
                ),                
            ),    
            'com_tab' => array(
                array(
                    'name'              => 'avma_contact_active',
                    'label'             => __( 'Contact Form Activation', 'avla-maintenance' ),
                    'type'              => 'radio',
                    'options'           => array(
                                        'Active' => 'Active',
                                        'Deactive'  => 'Deactive'
                )),
                array(
                    'name'              => 'avma_contact_email',
                    'label'             => __( 'Admin E-mail', 'avla-maintenance' ),
                    'desc'              => __( 'Users message will be sent to this address.', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_newsle_active',
                    'label'             => __( 'NewsLetter Activation', 'avla-maintenance' ),
                    'type'              => 'radio',
                    'options'           => array(
                        'active'      => 'Active',
                        'deactive'    => 'Deactive'
                )),
                array(
                    'name'              => 'avma_news_select',
                    'label'             => __( 'Feed Burnuer', 'avla-maintenance' ),
                    'desc'              => __( 'Select Mailing System.', 'avla-maintenance' ),
                    'type'              => 'select',
                    'options'           => array(
                        'avma'        => 'Averta Subscriber',
                        'Feed'        => 'FeedBurner'
                    )
                ),
                array(
                    'name'               => 'avma_social',
                    'label'              => __( 'Social Networks', 'avla-maintenance' ),
                    'desc'               => __( 'Show your social networks link.', 'avla-maintenance' ),
                    'type'               => 'radio',
                    'options'            => array(
                        'active'       => 'Active',
                        'Deactive'     => 'Deactive'
                    )
                ),
                array(
                    'name'              => 'avma_social_fa',
                    'label'             => __( 'Facebook', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_social_tw',
                    'label'             => __( 'Twitter', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_social_in',
                    'label'             => __( 'Instagram', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_social_yo',
                    'label'             => __( 'You Tube', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_social_g',
                    'label'             => __( 'Google +', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_social_pi',
                    'label'             => __( 'Pinterest', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_social_li',
                    'label'             => __( 'Linked In', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_social_dr',
                    'label'             => __( 'Dribbble', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
                array(
                    'name'              => 'avma_social_gi',
                    'label'             => __( 'Github', 'avla-maintenance' ),
                    'type'              => 'text',
                    'default'           => ''
                ),
            )
        );
        return $settings_fields;
    }
    function plugin_page() {
        echo '<div class="wrap">';
        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();
        echo '</div>';
    }
    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }
        return $pages_options;
    }
}
endif;