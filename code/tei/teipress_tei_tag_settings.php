<?PHP

	class teipress_tei_tag_settings{
	
		function __construct(){
			add_action("admin_menu", array($this, "add_settings_menu"));
			add_action( 'admin_init', array( $this, 'page_init' ) );
		}
		
		function add_settings_menu(){
			add_submenu_page( "edit.php?post_type=teipress", "teipress-tags", "TEI Tags", "manage_options", "teipress-tags", array($this, "settings_menu") );
		}
		
		function settings_menu(){
			
			// Set class property
			$this->options = get_option( 'teipress_tags' );
			
			?>
			<div class="wrap">           
				<form method="post" action="options.php">
				<?php
					// This prints out all hidden setting fields
					settings_fields( 'teipress_tags_settings' );   
					do_settings_sections( 'teipress-tags' );
					submit_button(); 
				?>
				</form>
			</div>
			<?php
			
		}
		
		public function page_init(){   

			register_setting(
				'teipress_tags_settings', // Option group
				'teipress_tags', // Option name
				array( $this, 'sanitize' ) // Sanitize
			);

			add_settings_section(
				'teipress_setting_section_id', // ID
				'TEIPress Settings', // Title
				array( $this, 'main_settings' ), // Callback
				'teipress-tags' // Page
			);

			add_settings_field(
				'display_tei_tags', // ID
				'Which tags to display on the editor', // Title 
				array( $this, 'editor_display' ), // Callback
				'teipress-tags', // Page
				'teipress_setting_section_id' // Section           
			);
			
		}
		
		public function editor_display(){	
		
			$tag_setting = $this->options['display_tei_tags'];
			
			$terms = json_decode(file_get_contents(dirname(__FILE__) . "/../../tagdata/terms.json"));
			
			?><select style="height:500px" name="teipress_tags[display_tei_tags][]" multiple><?PHP
			
			foreach($terms as $name => $term){
			
				?><option <?PHP if(in_array($name, $tag_setting)){ echo "selected"; } ?> value="<?PHP echo $name; ?>"><?PHP echo $name; ?>   <?PHP
			
			}
			
			?></select><?PHP
			
		}
		
		public function main_settings(){
			?>Use this page to configure which custom TEI tags to display on the editor<?PHP
		}
		
		
		public function sanitize( $input ){

		
			return $input;
		}
		
	}
	
	$teipress_tei_tag_settings = new teipress_tei_tag_settings();