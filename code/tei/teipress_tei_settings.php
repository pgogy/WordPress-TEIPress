<?PHP

	class teipress_tei_settings{
	
		function __construct(){
			add_action("admin_menu", array($this, "add_settings_menu"));
			add_action( 'admin_init', array( $this, 'page_init' ) );
		}
		
		function add_settings_menu(){
			add_submenu_page( "edit.php?post_type=teipress", "teipress-settings", "TEI Settings", "manage_options", "teipress-settings", array($this, "settings_menu") );
		}
		
		function settings_menu(){
			
			// Set class property
			$this->options = get_option( 'teipress' );
			
			?>
			<div class="wrap">           
				<form method="post" action="options.php">
				<?php
					// This prints out all hidden setting fields
					settings_fields( 'teipress_settings' );   
					do_settings_sections( 'teipress-settings' );
					submit_button(); 
				?>
				</form>
			</div>
			<?php
			
		}
		
		public function page_init(){   

			register_setting(
				'teipress_settings', // Option group
				'teipress', // Option name
				array( $this, 'sanitize' ) // Sanitize
			);

			add_settings_section(
				'teipress_setting_section_id', // ID
				'TEIPress Settings', // Title
				array( $this, 'main_settings' ), // Callback
				'teipress-settings' // Page
			);

			add_settings_field(
				'display_tei_tags', // ID
				'Which tags to display on the editor', // Title 
				array( $this, 'editor_display' ), // Callback
				'teipress-settings', // Page
				'teipress_setting_section_id' // Section           
			);

			add_settings_field(
				'display_tei_html_tags', // ID
				'Change HTML tags to text (so as to not display)', // Title 
				array( $this, 'html_display' ), // Callback
				'teipress-settings', // Page
				'teipress_setting_section_id' // Section           
			);
			
			add_settings_field(
				'indent_tei_html_tags', // ID
				'Indent tags when displaying', // Title 
				array( $this, 'indent_display' ), // Callback
				'teipress-settings', // Page
				'teipress_setting_section_id' // Section           
			);
			
			add_settings_field(
				'validate_xml_save', // ID
				'Validate XML when saving', // Title 
				array( $this, 'xml_save' ), // Callback
				'teipress-settings', // Page
				'teipress_setting_section_id' // Section           
			);
			
			add_settings_field(
				'attach_xslt', // ID
				'Attach an XSLT', // Title 
				array( $this, 'attach_xslt' ), // Callback
				'teipress-settings', // Page
				'teipress_setting_section_id' // Section           
			);
			
			add_settings_field(
				'attach_css', // ID
				'Attach a CSS', // Title 
				array( $this, 'attach_css' ), // Callback
				'teipress-settings', // Page
				'teipress_setting_section_id' // Section           
			);
			
			add_settings_field(
				'attach_js', // ID
				'Attach JavaScript', // Title 
				array( $this, 'attach_js' ), // Callback
				'teipress-settings', // Page
				'teipress_setting_section_id' // Section           
			);
			
			add_settings_field(
				'attach_head', // ID
				'Attach HTML Header', // Title 
				array( $this, 'attach_head' ), // Callback
				'teipress-settings', // Page
				'teipress_setting_section_id' // Section           
			);
			
			add_settings_field(
				'display_inside_wordpress', // ID
				'Display inside WordPress', // Title 
				array( $this, 'tei_display' ), // Callback
				'teipress-settings', // Page
				'teipress_setting_section_id' // Section           
			);
			
			add_settings_field(
				'allow_raw_display', // ID
				'Allow display of Raw XML', // Title 
				array( $this, 'raw_display' ), // Callback
				'teipress-settings', // Page
				'teipress_setting_section_id' // Section           
			);
			
		}
		
		public function editor_display(){	

			$tag_setting = $this->options['display_tei_tags'];
			
			?><input type="radio" name="teipress[display_tei_tags]" value="all_tei" <?PHP if($tag_setting=="all_tei"){ echo "checked"; } ?> >All TEI tags<br />
			<input type="radio" name="teipress[display_tei_tags]" value="tei_lite" <?PHP if($tag_setting=="tei_lite"){ echo "checked"; } ?>>All TEI lite tags<br />
			<input type="radio" name="teipress[display_tei_tags]" value="tei_list" <?PHP if($tag_setting=="tei_list"){ echo "checked"; } ?>>TEI tags from list (<a href="edit.php?post_type=teipress&page=teipress-tags">set here</a>)<br />
			<input type="radio" name="teipress[display_tei_tags]" value="tei_file" <?PHP if($tag_setting=="tei_file"){ echo "checked"; } ?>>Only tags in file<br /><?PHP
		
		}
		
		public function html_display(){	

			$tag_setting = $this->options['display_tei_html_tags'];
			
			?><input type="radio" name="teipress[display_tei_html_tags]" value="no_html" <?PHP if($tag_setting=="no_html"){ echo "checked"; } ?> >Don't render HTML tags<br />
			<input type="radio" name="teipress[display_tei_html_tags]" value="html" <?PHP if($tag_setting=="html"){ echo "checked"; } ?>>Render HTML tags<?PHP
		
		}
		
		public function indent_display(){	

			$tag_setting = $this->options['indent_tei_html_tags'];
			
			?><input type="radio" name="teipress[indent_tei_html_tags]" value="no_indent" <?PHP if($tag_setting=="no_indent"){ echo "checked"; } ?> >No Indent<br />
			<input type="radio" name="teipress[indent_tei_html_tags]" value="indent" <?PHP if($tag_setting=="indent"){ echo "checked"; } ?>>Indent<?PHP
		
		}
		
		public function xml_save(){	

			$tag_setting = $this->options['validate_xml_save'];
			
			?><input type="radio" name="teipress[validate_xml_save]" value="no_validate" <?PHP if($tag_setting=="no_validate"){ echo "checked"; } ?> >No Warnings<br />
			<input type="radio" name="teipress[validate_xml_save]" value="validate" <?PHP if($tag_setting=="validate"){ echo "checked"; } ?>>Warnings<?PHP
		
		}
		
		public function attach_xslt(){	

			$tag_setting = $this->options['attach_xslt'];
			
			?><input type="radio" name="teipress[attach_xslt]" value="no_xslt" <?PHP if($tag_setting=="no_xslt"){ echo "checked"; } ?> >No XSLT<br />
			<input type="radio" name="teipress[attach_xslt]" value="xslt" <?PHP if($tag_setting=="xslt"){ echo "checked"; } ?>>XSLT<?PHP
		
		}
		
		public function attach_js(){	

			$tag_setting = $this->options['attach_js'];
			
			?><input type="radio" name="teipress[attach_js]" value="no_js" <?PHP if($tag_setting=="no_js"){ echo "checked"; } ?> >No JavaScript<br />
			<input type="radio" name="teipress[attach_js]" value="js" <?PHP if($tag_setting=="js"){ echo "checked"; } ?>>JavaScript<?PHP
		
		}
		
		public function attach_css(){	

			$tag_setting = $this->options['attach_css'];
			
			?><input type="radio" name="teipress[attach_css]" value="no_css" <?PHP if($tag_setting=="no_css"){ echo "checked"; } ?> >No CSS<br />
			<input type="radio" name="teipress[attach_css]" value="css" <?PHP if($tag_setting=="css"){ echo "checked"; } ?>>CSS<?PHP
		
		}
		
		public function attach_head(){	

			$tag_setting = $this->options['attach_head'];
			
			?><input type="radio" name="teipress[attach_head]" value="no_head" <?PHP if($tag_setting=="no_head"){ echo "checked"; } ?> >No header HTML<br />
			<input type="radio" name="teipress[attach_head]" value="head" <?PHP if($tag_setting=="head"){ echo "checked"; } ?>>Add header HTML<?PHP
		
		}
		
		public function tei_display(){	

			$tag_setting = $this->options['display_inside_wordpress'];
			
			?><input type="radio" name="teipress[display_inside_wordpress]" value="wp" <?PHP if($tag_setting=="wp"){ echo "checked"; } ?> >Display Inside WP<br />
			<input type="radio" name="teipress[display_inside_wordpress]" value="not_wp" <?PHP if($tag_setting=="not_wp"){ echo "checked"; } ?>>Display in own format<?PHP
		
		}
		
		public function raw_display(){	

			$tag_setting = $this->options['allow_raw_display'];
			
			?><input type="radio" name="teipress[allow_raw_display]" value="raw" <?PHP if($tag_setting=="raw"){ echo "checked"; } ?> >Allow Raw Display (access TEI directly)<br />
			<input type="radio" name="teipress[allow_raw_display]" value="not_raw" <?PHP if($tag_setting=="not_raw"){ echo "checked"; } ?>>No Raw Display<?PHP
		
		}
		
		public function main_settings(){
			?>Use this page to configure TEIPress<?PHP
		}
		
		
		public function sanitize( $input ){
			return $input;
		}
		
	}
	
	$teipress_tei_settings = new teipress_tei_settings();