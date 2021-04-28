<?php
/*
Plugin Name: WooCommerce Product Video Gallery
Description: Adding Product YouTube Video and Instantly transform the gallery on your WooCommerce Product page into a fully Responsive Stunning Carousel Slider.
Author: NikHiL Gadhiya
Author URI: https://www.technosoftwebs.com
Date: 24/12/2020
Version: 1.2.1
Text Domain: product-video-gallery-slider-for-woocommerce
WC requires at least: 2.3
WC tested up to: 4.8.0
-------------------------------------------------*/
if(!defined('ABSPATH')){
	exit; // Exit if accessed directly.
}
define('PLUGIN_URL','https://www.technosoftwebs.com/');
require_once(plugin_dir_path(__FILE__).'js/nickx_live.php');
register_activation_hook( __FILE__, 'nickx_activation_hook_callback');
function nickx_activation_hook_callback()
{
	set_transient( 'nickx-plugin_setting_notice', true, 0);
	if(empty(get_option('nickx_slider_layout'))){
		update_option('nickx_slider_layout','horizontal');
		update_option('nickx_sliderautoplay','no');
		update_option('nickx_arrowinfinite','yes');
		update_option('nickx_arrowdisable','no');
		update_option('nickx_hide_thumbnails','no');
		update_option('nickx_adaptive_height','no');
		update_option('nickx_place_of_the_video','no');
		update_option('nickx_videoloop','no');
		update_option('nickx_show_lightbox','yes');
		update_option('nickx_show_zoom','yes');
		update_option('nickx_related','yes');
		update_option('nickx_arrowcolor','#000');
		update_option('nickx_arrowbgcolor','#FFF');
		update_option('nickx_lazyLoad','progressive');
	}
}
class wc_product_video_gallery
{
	public $extend;
    function __construct(){
        $this->add_actions(new nickx_lic_class());
    }
    private function add_actions($extend){
    	$this->extend=$extend;
		add_action('admin_notices',array($this,'nickx_notice_callback_notice'));
		add_action('admin_menu', array($this,'wc_product_video_gallery_setup'));
        add_action('admin_init', array($this,'update_wc_product_video_gallery_options'));				
        add_action('add_meta_boxes', array($this,'add_video_url_field'));
        add_action('save_post', array($this,'save_wc_video_url_field'));
		add_action('wp_enqueue_scripts', array($this,'nickx_enqueue_scripts'));
    	add_filter('plugin_action_links_'.plugin_basename(__FILE__),array($this,'wc_prd_vid_slider_settings_link'));
    }
	function nickx_notice_callback_notice(){
	    if(get_transient( 'nickx-plugin_setting_notice')){
	        echo '<div class="notice-info notice is-dismissible"><p><strong>WooCommerce Product Video Gallery is almost ready.</strong> To Complete Your Configuration, <a href="'.admin_url().'edit.php?post_type=product&page=wc-product-video">Complete the setup</a>.</p></div>';
	        delete_transient('nickx-plugin_setting_notice');
	    }
	}
	function wc_product_video_gallery_setup()
	{
		add_submenu_page( 'edit.php?post_type=product', 'WooCommerce Product Video Gallery', 'WC Product Video', 'manage_options', 'wc-product-video', array($this,'wc_product_video_callback'));
	}
	function wc_product_video_callback()
	{		
        wp_enqueue_style( 'wp-color-picker');
        wp_enqueue_script( 'wp-color-picker');
		echo '<style type="text/css">
		.boxed{padding:30px 0}
		.techno_tabs label{font-family:sans-serif;font-weight:400;vertical-align:top;font-size:15px}
		.wc_product_video_aria .techno_main_tabs{float:left;border:1px solid #ccc;border-bottom:none;margin-right:.5em;font-size:14px;line-height:1.71428571;font-weight:600;background:#e5e5e5;text-decoration:none;white-space:nowrap}
		.wc_product_video_aria .techno_main_tabs a{display:block;padding:5px 10px;text-decoration:none;color:#555}
		.wc_product_video_aria .main-panel{overflow:hidden;border-bottom:1px solid #ccc}
		.wc_product_video_aria .techno_main_tabs.active a{background:#f1f1f1}
		.wc_product_video_aria .techno_main_tabs a:focus{box-shadow:none;outline:0 solid transparent}
		.wc_product_video_aria .techno_main_tabs{display:inline-block;float:left}
		.wc_product_video_aria .techno_main_tabs.active{margin-bottom:-1px}
		.techno_tabs.tab_premium label{vertical-align:middle}
		.col-50{width:46%;float:left}
		.submit_btn_cls p{text-align: right;}
		.col-50 img{width:183px;float:left}tr.primium_aria {opacity: 0.5;cursor: help;}
		.primium_aria label, .primium_aria input { pointer-events: none; cursor: not-allowed;}
		.content_right a{background:#00f;font-family:"Trebuchet MS",sans-serif!important;display:inline-block;text-decoration:none;color:#fff;font-weight:700;background-color:#538fbe;padding:10px 40px;font-size:20px;border:1px solid #2d6898;background-image:linear-gradient(bottom,#4984b4 0,#619bcb 100%);background-image:-o-linear-gradient(bottom,#4984b4 0,#619bcb 100%);background-image:-moz-linear-gradient(bottom,#4984b4 0,#619bcb 100%);background-image:-webkit-linear-gradient(bottom,#4984b4 0,#619bcb 100%);background-image:-ms-linear-gradient(bottom,#4984b4 0,#619bcb 100%);background-image:-webkit-gradient(linear,left bottom,left top,color-stop(0,#4984b4),color-stop(1,#619bcb));-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;text-shadow:0 -1px 0 rgba(0,0,0,.5);-webkit-box-shadow:0 0 0 #2b638f,0 3px 15px rgba(0,0,0,.4),inset 0 1px 0 rgba(255,255,255,.3),inset 0 0 3px rgba(255,255,255,.5);-moz-box-shadow:0 0 0 #2b638f,0 3px 15px rgba(0,0,0,.4),inset 0 1px 0 rgba(255,255,255,.3),inset 0 0 3px rgba(255,255,255,.5);box-shadow:0 0 0 #2b638f,0 3px 15px rgba(0,0,0,.4),inset 0 1px 0 rgba(255,255,255,.3),inset 0 0 3px rgba(255,255,255,.5);margin-top:10px}</style>
		<div class="wc-product-video-title">
			<h1>WooCommerce Product Video Gallery</h1>
		</div>';
		if (isset($_REQUEST['deactivate_techno_wc_product_video_license'])) 
	    {
	        if($this->extend->nickx_deactive())
	        {
	        	echo '<div id="message" class="updated fade"><p><strong>You license Deactivated successfuly...!!!</strong></p></div>';
	        }
	        else
	        {
	        	echo '<div id="message" class="updated fade" style="border-left-color:#a00;"><p><strong>'.$this->extend->err.'</strong></p></div>';
	        }
	    } 
	    $lic_chk_stateus = $this->extend->is_nickx_act_lic();
	    if (isset($_REQUEST['activate_license_techno']))
    	{
			$lic_chk_stateus = $this->extend->nickx_act_call($_POST['techno_wc_product_video_license_key']);
		}echo '
		<div class="wrap tab_wrapper wc_product_video_aria">
			<div class="main-panel">
				<div id="tab_dashbord" class="techno_main_tabs active"><a href="#dashbord">Dashbord</a></div>
				<div id="tab_premium" class="techno_main_tabs"><a href="#premium">Premium</a></div>
			</div>
			<div class="boxed" id="percentage_form">
				<div class="techno_tabs tab_dashbord">
					<div class="wrap woocommerce">          
            			<form method="post" action="options.php">';
							settings_fields('wc_product_video_gallery_options');
							do_settings_sections('wc_product_video_gallery_options'); echo '
							<h2>WC Product Video Gallery Settings</h2>
							<div id="wc_prd_vid_slider-description">
								<p>The following options are used to configure WC Product Video Gallery</p>
							</div>
							<table class="form-table">
								<tbody>
									<tr valign="top">
										<th scope="row" class="titledesc">
											<label for="nickx_slider_layout">Slider Layout </label>
										</th>
										<td class="forminp forminp-select">
											<select name="nickx_slider_layout" id="nickx_slider_layout" style="" class="">
												<option value="horizontal" '.selected( 'horizontal', get_option('nickx_slider_layout'),false).'>Horizontal</option>
												<option value="left" '.selected( 'left', get_option('nickx_slider_layout'),false).'>Vertical Left</option>
												<option value="right" '.selected( 'right', get_option('nickx_slider_layout'),false).'>Vertical Right</option>
											</select> 							
										</td>
									</tr>
									<tr valign="top">
										<th scope="row" class="titledesc">
											<label for="nickx_slider_layout">LazyLoad </label>
										</th>
										<td class="forminp forminp-select">
											<select name="nickx_lazyLoad" id="nickx_lazyLoad" style="" class="">
												<option value="progressive" '.selected('progressive', get_option('nickx_lazyLoad'),false).'>progressive</option>
												<option value="ondemand" '.selected('ondemand', get_option('nickx_lazyLoad'),false).'>ondemand</option>
											</select> 							
										</td>
									</tr>
									<tr valign="top" class="">
										<th scope="row" class="titledesc"><label for="nickx_sliderautoplay">Slider Auto-play</label></th>
										<td class="forminp forminp-checkbox">
											<input name="nickx_sliderautoplay" id="nickx_sliderautoplay" type="checkbox" class="" value="yes" '.checked('yes',get_option('nickx_sliderautoplay'),false).'>
										</td>
									</tr>
									<tr valign="top" class="">
										<th scope="row" class="titledesc"><label for="nickx_arrowinfinite">Slider Infinite Loop</label></th>
										<td class="forminp forminp-checkbox">
											<input name="nickx_arrowinfinite" id="nickx_arrowinfinite" type="checkbox" class="" value="yes" '.checked('yes',get_option('nickx_arrowinfinite'),false).'>
										</td>
									</tr>
									<tr valign="top" class="">
										<th scope="row" class="titledesc"><label for="nickx_arrowdisable">Arrow Disable</label></th>
										<td class="forminp forminp-checkbox">												 																
											<input name="nickx_arrowdisable" id="nickx_arrowdisable" type="checkbox" class="" value="yes" '.checked('yes',get_option('nickx_arrowdisable'),false).'>
										</td>
									</tr>
									<tr valign="top" class="">
										<th scope="row" class="titledesc"><label for="nickx_show_lightbox">Light-box</label></th>
										<td class="forminp forminp-checkbox">
											<input name="nickx_show_lightbox" id="nickx_show_lightbox" type="checkbox" class="" value="yes" '.checked('yes',get_option('nickx_show_lightbox'),false).'>
										</td>
									</tr>
									<tr valign="top" class="">
										<th scope="row" class="titledesc"><label for="nickx_show_zoom">Zoom</label></th>
										<td class="forminp forminp-checkbox">
											<input name="nickx_show_zoom" id="nickx_show_zoom" type="checkbox" class="" value="yes" '.checked('yes',get_option('nickx_show_zoom'),false).'>
										</td>
									</tr>
									<tr valign="top" class="">
										<th scope="row" class="titledesc"><label for="nickx_hide_thumbnails">Hide Thumbnails</label></th>
										<td class="forminp forminp-checkbox">
											<input name="nickx_hide_thumbnails" id="nickx_hide_thumbnails" type="checkbox" class="" value="yes" '.checked('yes',get_option('nickx_hide_thumbnails'),false).'>
										</td>
									</tr>
									<tr valign="top" class="">
										<th scope="row" class="titledesc"><label for="nickx_related">Related Video</label></th>
										<td class="forminp forminp-checkbox">
											<input name="nickx_related" id="nickx_related" type="checkbox" class="" value="yes" '.checked('yes',get_option('nickx_related'),false).'>
											<samll>(only for Youtube) If checked, then the player does show related videos.</samll>
										</td>
									</tr>
									<tr valign="top" '.(($lic_chk_stateus) ? '' : 'class="primium_aria" title="AVAILABLE IN PREMIUM VERSION"').'">
										<th scope="row" class="titledesc"><label for="nickx_adaptive_height">Adaptive Height</label></th>
										<td class="forminp forminp-checkbox">
											<input name="nickx_adaptive_height" id="nickx_adaptive_height" type="checkbox" class="" value="yes" '.checked('yes',get_option('nickx_adaptive_height'),false).'>
											<samll class="lbl_tc">slider height based on images automatically.</samll>
										</td>
									</tr>
									<tr valign="top" '.(($lic_chk_stateus) ? '' : 'class="primium_aria" title="AVAILABLE IN PREMIUM VERSION"').'">
										<th scope="row" class="titledesc"><label for="nickx_videoloop">Video Looping</label></th>
										<td class="forminp forminp-checkbox">
											<input name="nickx_videoloop" id="nickx_videoloop" type="checkbox" class="" value="yes" '.checked('yes',get_option('nickx_videoloop'),false).'>
											<samll class="lbl_tc">Looping a video is allowing the video to play in a repeat mode.</samll>
										</td>
									</tr>
									<tr valign="top" '.(($lic_chk_stateus) ? '' : 'class="primium_aria" title="AVAILABLE IN PREMIUM VERSION"').'">
										<th scope="row" class="titledesc"><label for="nickx_place_of_the_video">Place Of The Video</label></th>
										<td class="forminp forminp-checkbox">
											<input name="nickx_place_of_the_video" id="nickx_place_of_the_video" type="checkbox" class="" value="yes" '.checked('yes',get_option('nickx_place_of_the_video'),false).'>
											<samll class="lbl_tc">If checked, video display before the images.</samll>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row" class="titledesc"><label for="nickx_arrowcolor">Arrow Color</label></th>
										<td class="forminp forminp-color">‎
											<input name="nickx_arrowcolor" id="nickx_arrowcolor" type="text" value="'.get_option('nickx_arrowcolor').'" class="colorpick">
										</td>
									</tr>
									<tr valign="top">
										<th scope="row" class="titledesc"><label for="nickx_arrowbgcolor">Arrow Background Color</label></th>
										<td class="forminp forminp-color">‎											
											<input name="nickx_arrowbgcolor" id="nickx_arrowbgcolor" type="text" value="'.get_option('nickx_arrowbgcolor').'" class="colorpick">
										</td>
									</tr>
								</tbody>
								<tfoot><tr><td class="submit_btn_cls">';submit_button(); echo '</td></tr></tfoot>
							</table>							
						</form>
					</div>
				</div>
				<div class="techno_tabs tab_premium" style="display:none;">'; 			
					if (isset($_REQUEST['activate_license_techno']))
				    {
						if($lic_chk_stateus)
						{
						    echo '<div id="message" class="updated fade"><p><strong>You license Activated successfuly...!!!</strong></p></div>
						    <form method="POST">	    
								<div class="col-50">
									<h2> Thank You Phurchasing ...!!!</h2>
									<h4 class="paid_color">Deactivate Yore License:</h4>
									<p class="submit">
						               	<input type="submit" name="deactivate_techno_wc_product_video_license" value="Deactive" class="button button-primary">
						           	</p>
								</div>
				            </form>';
						}
						else
						{
							$this->techno_wc_product_video_pro_html();
						    echo '<div id="message" class="updated fade" style="border-left-color:#a00;"><p><strong>'.$this->extend->err.'</strong></p></div>';
						}	       
				    }	
				    elseif($this->extend->is_nickx_act_lic()){ echo'
						<form method="POST">	    
							<div class="col-50">
								<h2> Thank You Phurchasing ...!!!</h2>
								<h4 class="paid_color">Deactivate Yore License:</h4>
								<p class="submit">
					               	<input type="submit" name="deactivate_techno_wc_product_video_license" value="Deactive" class="button button-primary">
					           	</p>
							</div>
			            </form>';
					}
				    else
				    {
				    	$this->techno_wc_product_video_pro_html();
						echo $this->extend->err;
				    } echo '
				</div>
			</div>
		</div>
		<script type="text/javascript">			
			jQuery(document).ready(function(e) 
			{
				jQuery(".colorpick").each(function(w)
				{
                	jQuery(this).wpColorPicker();
                });
			   	jQuery("div.techno_main_tabs").click(function(e)
			   	{
			   		jQuery(".techno_main_tabs").removeClass("active");
			   		jQuery(this).addClass("active");
					jQuery(".techno_tabs").hide();
					jQuery("."+this.id).show();
				});
				jQuery("tr.primium_aria").click(function(e){
					jQuery("#tab_premium").trigger("click"); 
				});
			});
		</script>';
	}
	function techno_wc_product_video_pro_html() 
	{       
		$pugin_path =  plugin_dir_url( __FILE__ ); echo '
		<form method="POST">
    	<div class="col-50">
            <h2>WooCommerce Product Video Gallery</h2>
            <h4 class="paid_color">Premium Features:</h4>
			<p class="paid_color">01. You Can Use Vimeo And Html5 Video(MP4, WebM, and Ogg).</p>
			<p class="paid_color">02. Change The Place Of The Video(before Images Or After Images).</p>
			<p class="paid_color">03. Video Looping (Looping a video is allowing the video to play in a repeat mode).</p>
			<p class="paid_color">04. Adaptive Height (Slider Height Based On Images Automatically).</p>
            <p><label for="techno_wc_product_videokey">License Key : </label><input class="regular-text" type="text" id="techno_wc_product_video_license_key" name="techno_wc_product_video_license_key"></p>
            <p class="submit">
                <input type="submit" name="activate_license_techno" value="Activate" class="button button-primary">
            </p>
        </div>
        <div class="col-50">
			<div class="content_right" style="text-align: center;">
				<p style="font-size: 25px; font-weight: bold; color: #f00;">Buy Activation Key form Here...</p>
				<p><a href="https://www.technosoftwebs.com/wc-product-video-gallery/" target="_blank">Buy Now...</a></p>
			</div>
		</div>
        </form>';
	}
	function update_wc_product_video_gallery_options($value='')
	{
        register_setting( 'wc_product_video_gallery_options','nickx_slider_layout');
        register_setting( 'wc_product_video_gallery_options','nickx_sliderautoplay');
        register_setting( 'wc_product_video_gallery_options','nickx_arrowinfinite');
        register_setting( 'wc_product_video_gallery_options','nickx_arrowdisable');
        register_setting( 'wc_product_video_gallery_options','nickx_show_lightbox');
        register_setting( 'wc_product_video_gallery_options','nickx_show_zoom');
        register_setting( 'wc_product_video_gallery_options','nickx_arrowcolor');
        register_setting( 'wc_product_video_gallery_options','nickx_related');
        register_setting( 'wc_product_video_gallery_options','nickx_hide_thumbnails');
        register_setting( 'wc_product_video_gallery_options','nickx_lazyLoad');
        register_setting( 'wc_product_video_gallery_options','nickx_arrowbgcolor');if($this->extend->is_nickx_act_lic()){
        register_setting( 'wc_product_video_gallery_options','nickx_adaptive_height');
        register_setting( 'wc_product_video_gallery_options','nickx_videoloop');
        register_setting( 'wc_product_video_gallery_options','nickx_place_of_the_video');}
	}
	function wc_prd_vid_slider_settings_link( $links ){
		$links[] = '<a href="'.admin_url().'edit.php?post_type=product&page=wc-product-video">Settings</a>';
		return $links;
	}
    function add_video_url_field(){
      add_meta_box( 'video_url', 'Product Video Url', array($this,'video_url_field'), 'product');
    }
	function nickx_meta_extend_call($product_id)
	{
		wp_enqueue_script('media-upload');
		wp_enqueue_media();
		$product_video_type = get_post_meta($product_id,'_nickx_product_video_type',true);
		$product_video_url = get_post_meta($product_id,'_nickx_video_text_url',true); echo '
		<div class="nickx_product_video_url_section">
			<table>
				<thead><tr><th style="text-align: left;">Select Video Source</th></tr></thead>
				<tbody>
					<tr><td><ul>
						<li>
							<input type="radio" '.checked($product_video_type,'nickx_video_url_youtube',false).' '.((empty($product_video_type))? 'checked' : '').' name="nickx_product_video_type" value="nickx_video_url_youtube" id="nickx_video_url_youtube">
							<label class="tab active" for="nickx_video_url_youtube">Youtube</label>
						</li>
						<li>
							<input type="radio" '.checked($product_video_type,'nickx_video_url_vimeo',false).' name="nickx_product_video_type" value="nickx_video_url_vimeo" id="nickx_video_url_vimeo">
							<label class="tab" for="nickx_video_url_vimeo">Vimeo</label>
						</li>
						<li>
							<input type="radio" '.checked($product_video_type,'nickx_video_url_local',false).' name="nickx_product_video_type" value="nickx_video_url_local" id="nickx_video_url_local">
							<label class="tab" for="nickx_video_url_local">WP Library</label>
						</li>
					</ul></td></tr>
					<tr>
						<td>
							<input type="url" style="width:100%;" id="nickx_video_text_urls" value="'.esc_url($product_video_url).'" name="nickx_video_text_url" placeholder="URL of your video">
						</td>
						<td><label style="display: none;" onclick="nickx_open_video_uploader();" class="select_video_button button">Select Video</label><input type="hidden" name="video_attachment_id" id="video_attachment_id"></td>
					</tr>
					<tr>
						<td>
							<small style="display: none;" class="nickx_url_info nickx_video_url_youtube">https://www.youtube.com/embed/.....</small>
							<small style="display: none;" class="nickx_url_info nickx_video_url_vimeo">https://player.vimeo.com/video/......</small>
							<small style="display: none;" class="nickx_url_info nickx_video_url_local">'.get_site_url().'/wp-content/upload/......</small>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function(e){
				jQuery("input[name=nickx_product_video_type]").change(function(e){
					set_video_type(this.id);
				});
				jQuery("#nickx_video_text_urls").change(function(e){
					check_video_type(jQuery(this).val());
				});
				set_video_type(jQuery("input[name=nickx_product_video_type]:checked").val());
			});
			function check_video_type(video_url){
				if(video_url.indexOf("youtube") > 0){
					jQuery("#nickx_video_url_youtube").prop("checked", true);
					set_video_type("nickx_video_url_youtube");
				}
				else if(video_url.indexOf("vimeo") > 0){
					jQuery("#nickx_video_url_vimeo").prop("checked", true);
					set_video_type("nickx_video_url_vimeo");
				}
				else{
					jQuery("#nickx_video_url_local").prop("checked", true);
					set_video_type("nickx_video_url_local");
				}
			}
			function nickx_open_video_uploader()
			{
			  nickx_video_uploader = wp.media({ library: {type: "video"},title: "Add Video Source"});
			  nickx_video_uploader.on("select", function(e){
			    var file = nickx_video_uploader.state().get("selection").first();
			    var extension = file.changed.subtype;
			    var video_url = file.changed.url;
			    jQuery("#nickx_video_text_urls").val(video_url);
			  });
			  nickx_video_uploader.open();
			}
			function set_video_type(video_type){
				jQuery(".nickx_url_info,.select_video_button").hide();
				jQuery("."+video_type).show();
				jQuery("label.tab").removeClass("active");
				jQuery("label[for="+video_type+"]").addClass("active");
				if(video_type=="nickx_video_url_local"){
					jQuery(".select_video_button").show();
				}
			}
		</script>';
	}
    function video_url_field(){
		$product_video_url = get_post_meta(get_the_ID(),'_nickx_video_text_url',true);
		if(!$this->extend->is_nickx_act_lic())
		{
			echo '<style type="text/css"> .nickx_product_video_url_section ul li { display: inline-block; vertical-align: middle; padding: 0; margin: 0 auto; } </style>
			<div class="nickx_product_video_url_section">
			<ul>
				<li>
					<input type="radio" checked name="nickx_product_video_type" value="nickx_video_url_youtube" id="nickx_video_url_youtube">
					<label class="tab active" for="nickx_video_url_youtube">Youtube</label>
				</li>
				<li>
					<input type="radio" name="nickx_product_video_type" disabled>
					<label class="tab" for="nickx_video_url_vimeo">Vimeo'.wc_help_tip('<p style="font-size: 25px; font-weight: bold;>available in premium version<br>Buy Activation Key form Setting Page</p>',true).'</label>
				</li>
				<li>
					<input type="radio" name="nickx_product_video_type" disabled>
					<label class="tab" for="nickx_video_url_local">WP Library'.wc_help_tip('<p style="font-size: 25px; font-weight: bold;>available in premium version<br>Buy Activation Key form Setting Page</p>',true).'</label>
				</li>
			</ul><div class="video-url-cls"><p>Type the URL of your Youtube Video, supports URLs of videos in websites only Youtube.</p><input class="video_input" style="width:100%;" type="url" id="nickx_video_text_url" value="'.esc_url($product_video_url).'" name="nickx_video_text_url" Placeholder="https://www.youtube.com/embed/....."></div></div>';} else { $this->nickx_meta_extend_call(get_the_ID());}
	}
	function save_wc_video_url_field($post_id){
		if(isset($_POST['nickx_video_text_url'])){
        	update_post_meta( $post_id, '_nickx_video_text_url',esc_url($_POST['nickx_video_text_url']));
		}
        if (isset($_POST['nickx_product_video_type']))
        {
        	update_post_meta( $post_id, '_nickx_product_video_type',sanitize_text_field($_POST['nickx_product_video_type']));
        }
    }
    function nickx_enqueue_scripts(){
		if (!is_admin()){
			if (class_exists( 'WooCommerce' ) && is_product()){
				wp_enqueue_script('jquery');
				wp_enqueue_script('nickx-fancybox-js', plugins_url('js/jquery.fancybox.js', __FILE__),array('jquery'),'3.5.7', true);
				wp_enqueue_script('nickx-zoom-js', plugins_url('js/jquery.zoom.min.js', __FILE__),array('jquery'),'1.7.21', true);
				wp_enqueue_style('nickx-fancybox-css', plugins_url('css/fancybox.css', __FILE__),'3.5.7', true);
				wp_enqueue_style('nickx-fontawesome-css', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css','1.0', true);
				wp_enqueue_style('nickx-front-css', plugins_url('css/nickx-front.css', __FILE__),'1.0', true);
				wp_register_script('nickx-front-js', plugins_url('js/nickx.front.js', __FILE__),array('jquery'),'1.0', true);
				if(get_post_meta(get_the_ID(),'_nickx_product_video_type',true)=='nickx_video_url_vimeo' && strpos(get_post_meta(get_the_ID(),'_nickx_video_text_url',true), 'vimeo') > 0){
					wp_enqueue_script('nickx-vimeo-js', 'https://player.vimeo.com/api/player.js','1.0', true);
				}
				wp_enqueue_style( 'dashicons');
				$options = get_option('nickx_options');
				$translation_array = array(
					'nickx_slider_layout'=> get_option('nickx_slider_layout'),'nickx_sliderautoplay'=> get_option('nickx_sliderautoplay'),'nickx_lazyLoad'=> get_option('nickx_lazyLoad'),
					'nickx_arrowinfinite'=> get_option('nickx_arrowinfinite'),'nickx_arrowdisable'=> get_option('nickx_arrowdisable'),'nickx_hide_thumbnails'=> get_option('nickx_hide_thumbnails'),
					'nickx_show_lightbox'=> get_option('nickx_show_lightbox'),'nickx_show_zoom'=> get_option('nickx_show_zoom'),'nickx_related'=> get_option('nickx_related'),'nickx_videoloop'=> get_option('nickx_videoloop'),
					'nickx_arrowcolor'=> get_option('nickx_arrowcolor'),'nickx_arrowbgcolor'=> get_option('nickx_arrowbgcolor'),'nickx_lic'=> $this->extend->is_nickx_act_lic(),
				);
				if($this->extend->is_nickx_act_lic()){
					$translation_array['nickx_adaptive_height'] = get_option('nickx_adaptive_height');
					$translation_array['nickx_place_of_the_video'] = get_option('nickx_place_of_the_video');
				}
				wp_localize_script('nickx-front-js', 'wc_prd_vid_slider_setting', $translation_array);
				wp_enqueue_script('nickx-front-js');
			}
		}
	}
}
function nickx_error_notice_callback_notice(){
	echo '<div class="error"><p><strong>WooCommerce Product Video Gallery</strong> requires WooCommerce to be installed and active. You can download <a href="https://woocommerce.com/" target="_blank">WooCommerce</a> here.</p></div>';
}
add_action('plugins_loaded','nickx_remove_woo_hooks');
function nickx_remove_woo_hooks(){
	if (in_array('woocommerce/woocommerce.php',apply_filters('active_plugins',get_option('active_plugins')))){
		new wc_product_video_gallery();
		remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
		remove_action('woocommerce_before_single_product_summary_product_images', 'woocommerce_show_product_thumbnails', 20);
		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 10 );
		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
		if(get_option('nickx_hide_thumbnails')!='yes'){
			add_action( 'woocommerce_product_thumbnails', 'nickx_show_product_thumbnails', 20 );
		}
		add_action( 'woocommerce_before_single_product_summary', 'nickx_show_product_image', 10 );
	}
	else{
		add_action( 'admin_notices', 'nickx_error_notice_callback_notice');
		return;
	}
}
function nickx_show_product_image(){
	global $post, $product, $woocommerce; $version = '3.0'; $extend = new nickx_lic_class();
	echo '<div class="images">';
	if (has_post_thumbnail()){
		if(version_compare($woocommerce->version, $version, ">=" )){
			$attachment_ids = $product->get_gallery_image_ids();
		}else{
			$attachment_ids = $product->get_gallery_attachment_ids();
		}
		$attachment_count = count($attachment_ids);
		$gallery          = $attachment_count > 0 ? '[product-gallery]' : '';
		$image_link       = wp_get_attachment_url(get_post_thumbnail_id());
		$props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );$htmlvideo='';
		$product_video_url = get_post_meta(get_the_ID(),'_nickx_video_text_url',true);
		if($product_video_url!=''){
			if (strpos($product_video_url, 'youtube') > 0 || strpos($product_video_url, 'youtu') > 0) {
	   			$htmlvideo = '<div class="tc_video_slide"><iframe style="display:none;" data-skip-lazy="" width="100%" height="100%" id="product_video_iframe" video-type="youtube" data_src="'.$product_video_url.'" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><a id="product_video_iframe_light" class="nickx-popup fa fa-expand fancybox-media" data-fancybox="product-gallery"></a></div>';
		    } elseif (strpos($product_video_url, 'vimeo') > 0 && $extend->is_nickx_act_lic()) {
	   			$htmlvideo = '<div class="tc_video_slide"><iframe style="display:none;" data-skip-lazy="" width="100%" height="450px" id="product_video_iframe" video-type="vimeo" src="'.$product_video_url.'" frameborder="0" allow="autoplay; fullscreen" allowfullscreen=""></iframe><a href="'.$product_video_url.'?enablejsapi=1&wmode=opaque" class="nickx-popup fa fa-expand fancybox-media" data-fancybox="product-gallery"></a></div>';
		    } elseif($extend->is_nickx_act_lic()){
	   			$htmlvideo = '<div class="tc_video_slide"><video style="display:none;" width="100%" height="100%" id="product_video_iframe" video-type="html5" controls><source src="'.$product_video_url.'"><p>Your browser does not support HTML5</p></video><a href="'.$product_video_url.'?enablejsapi=1&wmode=opaque" class="nickx-popup fa fa-expand fancybox-media" data-fancybox="product-gallery"></a></div>';
		    }
		    else{
	   			$htmlvideo = '<div class="tc_video_slide"><iframe style="display:none;" data-skip-lazy="" width="100%" height="100%" id="product_video_iframe" video-type="youtube" data_src="'.$product_video_url.'" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';
		    }
		}
		$image            = get_the_post_thumbnail($post->ID, apply_filters('single_product_large_thumbnail_size', 'shop_single'),array('title' => $props['title'],'alt' => $props['alt'],'data-skip-lazy' => 'true'));
		$fullimage = get_the_post_thumbnail($post->ID, 'full', array('title' => $props['title'],'alt' => $props['alt'],'data-skip-lazy' => 'true'));
		$html  = '<div class="slider nickx-slider-for">'.((get_option('nickx_place_of_the_video')=='yes' && $extend->is_nickx_act_lic()) ? $htmlvideo : '');
		$html .= sprintf('<div class="zoom">%s%s<a href="%s" class="nickx-popup fa fa-expand" data-fancybox="product-gallery"></a></div>',$fullimage,$image,$image_link);
		foreach($attachment_ids as $attachment_id){
		   $imgfull_src = wp_get_attachment_image_src($attachment_id,'full');
		   $image_src   = wp_get_attachment_image_src($attachment_id,'shop_single');
		   $html .= '<div class="zoom"><img data-skip-lazy="" src="'.$imgfull_src[0].'" /><img data-skip-lazy="" data-lazy="'.$image_src[0].'" /><a href="'.$imgfull_src[0].'" class="nickx-popup fa fa-expand" data-fancybox="product-gallery"></a></div>';
		}
		$html .= ((get_option('nickx_place_of_the_video')!='yes' || !$extend->is_nickx_act_lic()) ? $htmlvideo : '').'</div>';
		echo apply_filters('woocommerce_single_product_image_html',$html,$post->ID);
	} else {
		echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img data-skip-lazy="" src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
	}
	do_action( 'woocommerce_product_thumbnails' );
	echo '</div>';
}
function nickx_show_product_thumbnails(){
	global $post, $product, $woocommerce; $version = '3.0'; $extend = new nickx_lic_class();
	if(version_compare($woocommerce->version, $version, ">=" )){
		$attachment_ids = $product->get_gallery_image_ids();
	}else{
		$attachment_ids = $product->get_gallery_attachment_ids();
	}
	if (has_post_thumbnail()){
		$thumbanil_id   = array(get_post_thumbnail_id());
		$attachment_ids = array_merge($thumbanil_id,$attachment_ids);
	}
	if ($attachment_ids){
		$attachment_count = count($attachment_ids);
		if($attachment_count>1 || !empty(get_post_meta(get_the_ID(),'_nickx_video_text_url',true))){
			$htmlthumb = '';		
			if(get_post_meta(get_the_ID(),'_nickx_video_text_url',true)!=''){
				$htmlthumb = apply_filters('woocommerce_single_product_image_thumbnail_html','<li title="video" class="video-thumbnail"><img class="video_icon_img" src="'.plugins_url('css/transparent-video-play.png', __FILE__).'"><img data-skip-lazy="" width="150" height="150" src="'.wc_placeholder_img_src().'" class="product_video_img attachment-thumbnail size-thumbnail" alt="" sizes="(max-width: 150px) 100vw, 150px"></li>','',$post->ID);
			}
			echo '<div id="nickx-gallery" class="slider nickx-slider-nav">'.((get_option('nickx_place_of_the_video')=='yes' && $extend->is_nickx_act_lic()) ? $htmlthumb : '');
			foreach ($attachment_ids as $attachment_id){
				$props = wc_get_product_attachment_props($attachment_id, $post);
				if (!$props['url']){
					continue;
				}
				echo apply_filters('woocommerce_single_product_image_thumbnail_html',sprintf('<li class="product_thumbnail_item" title="%s">%s</li>',esc_attr( $props['caption'] ),wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'thumbnail' ), 0,array('data-skip-lazy' => 'true'))),$attachment_id,$post->ID);
			}
			echo ((get_option('nickx_place_of_the_video')!='yes' || !$extend->is_nickx_act_lic()) ? $htmlthumb : '').'</div>';
		}
	}
}