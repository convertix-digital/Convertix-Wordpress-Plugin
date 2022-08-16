<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @package    Convertix_Pixel
 * @subpackage Convertix_Pixel/public
 * @file       class-convertix-pixel-public.php
 */

/**
 * The public-facing functionality of the plugin.
 */
class Convertix_Pixel_Public {

	/**
	 * If no script tag is printed.
	 *
	 * @var bool
	 */
	public static $printed_noscript_tag = false;

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $convertix_pixel The ID of this plugin.
	 */
	private $convertix_pixel;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $convertix_pixel The name of the plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $convertix_pixel, $version ) {

		$this->convertix_pixel = $convertix_pixel;
		$this->version         = $version;

	}

	/**
	 * Add Convertix Head Code.
	 *
	 * @return void
	 */
	public function ctx_head() {
		if ( $this->is_convertix_off() ) {
			return;
		}

		echo "<!-- BEGIN Convertix Pixel -->
			<script language=\"text/javascript\">
			let fb_pixel1 = '". $this->get_option( CONVERTIX_PIXEL_META_PIXEL_ID_1 ) ."';
			let fb_pixel_api1 = '". $this->get_option( CONVERTIX_PIXEL_META_PIXEL_TOKEN_API_1 ) ."';
			let fb_pixel_testid1 = '". $this->get_option( CONVERTIX_PIXEL_META_PIXEL_TESTID_1 ) ."';
			let fb_pixel2 = '". $this->get_option( CONVERTIX_PIXEL_META_PIXEL_ID_2 ) ."';
			let fb_pixel_api2 = '". $this->get_option( CONVERTIX_PIXEL_META_PIXEL_TOKE_API_2 ) ."';
			let fb_pixel_testid2 = '". $this->get_option( CONVERTIX_PIXEL_META_PIXEL_TESTID_2 ) ."';
				
			let ga_pixel1 = '". $this->get_option( CONVERTIX_PIXEL_GOOGLE_UNIVERSAL_ANALYTICS_1 ) ."';
			let ga4_pixel1 = '". $this->get_option( CONVERTIX_PIXEL_GOOGLE_ANALYTICS4_1 ) ."';
			let gads_conversionID1 = '". $this->get_option( CONVERTIX_PIXEL_GOOGLE_ADWORDS_ID_1 ) ."';
			let gads_remarketing = 'AW-". $this->get_option( CONVERTIX_PIXEL_GOOGLE_ADWORDS_ID_1 ) ."';
			let ggOptimize = '". $this->get_option( CONVERTIX_PIXEL_GOOGLE_OPTIMIZE_1 ) ."';
				
			let ttk_pixel1 = '". $this->get_option( CONVERTIX_PIXEL_TIKTOK_PIXEL_1 ) ."';
			let ttk_pixel_api1 = '". $this->get_option( CONVERTIX_PIXEL_TIKTOK_PIXEL_TOKEN_API_1 ) ."';
			let ttk_pixel_testid1 = '". $this->get_option( CONVERTIX_PIXEL_TIKTOK_PIXEL_TESTID_1 ) ."';
				
			let in_pixel1 = '". $this->get_option( CONVERTIX_PIXEL_LINKEDIN_INSIGHT_TAG_1 ) ."';
				
			let activecampaign_pixel = '". $this->get_option( ACTIVECAMPAIGN_PIXEL_1 ) ."';
			let activecampaign_eventKey = '". $this->get_option( ACTIVECAMPAIGN_EVENTKEY_1 ) ."';
				
			let transportURLServer = '". $this->get_option( CONVERTIX_PIXEL_SERVER_CONTAINER_URL ) ."';
			let cli_GTMevent = '". $this->get_option( CONVERTIX_PIXEL_CLIENT_EVENT ) ."';
			let cli_GTMVariable = '". md5( $this->get_option( CONVERTIX_PIXEL_CLIENT_VARIABLE ) ) ."';
			let convertix_token = '". $this->get_option( CONVERTIX_PIXEL_CLIENT_TOKEN ) ."';

			let gtm_cli_container = '". esc_js( $this->get_option( CONVERTIX_PIXEL_WEB_CONTAINER_ID ) ) ."';
			let gtm_convertix_container = 'GTM-TBC3PNT';

			window.dataLayer = window.dataLayer || [];
			window.dataLayer.push({'event':'convertix','ctx.version':'". $this->version ."','ctx.cli_GTMevent' : cli_GTMevent,'ctx.TK' : convertix_token});
			
			(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!=='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','" . esc_js( $this->get_option( CONVERTIX_PIXEL_WEB_CONTAINER_ID ) ) . "');
			(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!=='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-TBC3PNT');
			</script>
			<!-- End Convertix Pixel -->
		";
	}

	/**
	 * Add Convertix Body Code
	 *
	 * @return void
	 */
	public function ctx_body() {
		// Make sure we only print the noscript tag once.
		// This is because we're trying for multiple hooks.
		if ( self::$printed_noscript_tag ) {
			return;
		}
		self::$printed_noscript_tag = true;

		if ( $this->is_convertix_off() ) {
			return;
		}

		echo '
			<!-- Convertix Pixel (noscript) -->
			<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' . esc_attr( $this->get_option( CONVERTIX_PIXEL_WEB_CONTAINER_ID ) ) . '" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
			<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TBC3PNT" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
			<!-- End Convertix Pixel (noscript) -->
		';
	}

	/**
	 * Is Convertix OFF.
	 *
	 * @return bool
	 */
	private function is_convertix_off() {
		return get_option( CONVERTIX_PIXEL_ADMIN_OPTIONS ) && CONVERTIX_PIXEL_WEB_CONTAINER_PLACEMENT_ON !== $this->get_option( CONVERTIX_PIXEL_WEB_CONTAINER_PLACEMENT );
	}

	/**
	 * Is Convertix ON.
	 *
	 * @return bool
	 */
	protected function is_convertix_on() {
		return get_option( CONVERTIX_PIXEL_ADMIN_OPTIONS ) && CONVERTIX_PIXEL_WEB_CONTAINER_PLACEMENT_OFF !== $this->get_option( CONVERTIX_PIXEL_WEB_CONTAINER_PLACEMENT );
	}

	/**
	 * Get attr option.
	 *
	 * @param string $id The option ID.
	 *
	 * @return string
	 */
	protected function get_option( $id ) {
		return isset( get_option( CONVERTIX_PIXEL_ADMIN_OPTIONS )[ $id ] ) ? get_option( CONVERTIX_PIXEL_ADMIN_OPTIONS )[ $id ] : '';
	}
}
