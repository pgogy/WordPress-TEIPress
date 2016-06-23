<?PHP

	class teipress_editor{
	
		function __construct(){
			add_action( 'admin_enqueue_scripts', array($this, 'scripts_admin') );
			add_action( 'admin_head', array($this, 'prepare_editor') );
			add_action( 'admin_footer', array($this, 'html_edit_footer') );	  
			add_action( 'admin_print_footer_scripts',  array($this, 'tei_tags_enable'));
			add_action( 'save_post',  array($this, 'save_post'));
			add_action( 'admin_notices',  array($this, 'admin_notices'));
			add_filter( 'quicktags_settings', array($this, 'remove_buttons'));
		}
		
		function remove_buttons( $qt  ) {
			if(isset($_GET['post_type'])){
				if($_GET['post_type']=="teipress"){
					$qt['buttons'] = ',';
				}
			}else{
				global $post;
				if($post->post_type=="teipress"){
					$qt['buttons'] = ',';
				}
			}
			return $qt;
		}
		
		function scripts_admin() {
			wp_enqueue_style('tei-tags-accordion',"//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css");
			wp_enqueue_style('tei-tags-selector', plugins_url() . '/teipress/plugincss/tei-tag-selector.css');
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery-ui-accordion');
			wp_enqueue_script( 'teipress-tag-click', plugins_url() . '/teipress/pluginjs/tei-tag-click.js', array( 'jquery' ) );
			wp_enqueue_script( 'teipress-tag-accordion', plugins_url() . '/teipress/pluginjs/tei-tag-accordion.js', array( 'jquery' ) );
			wp_enqueue_script( 'teipress-tab-override', plugins_url() . '/teipress/pluginjs/tei-tab.js', array( 'jquery' ) );
		} 
		
		function prepare_editor( ) {
		
			$editor_options = get_option( 'teipress' );	
		
			if($editor_options['attach_xslt']=="xslt"){
				$xslt = true;
			}else{
				$xslt = false;
			}
			
			if($editor_options['attach_css']=="css"){
				$css = true;
			}else{
				$css = false;
			}
			
			if($editor_options['attach_js']=="js"){
				$js = true;
			}else{
				$js = false;
			}
			
			if($editor_options['attach_head']=="head"){
				$head = true;
			}else{
				$head = false;
			}
		
			if(isset($_GET['post_type'])){
				if($_GET['post_type']=="teipress"){
					if(isset($_GET['post']) || (strpos($_SERVER['REQUEST_URI'], "post-new.php") != FALSE)){
						add_filter( 'user_can_richedit' , '__return_false', 50 );
						if($xslt){
							add_meta_box( "teipress_xslt", "Attach an XSLT", array($this, "tei_xslt_add"), "teipress");
						}
						if($css){
							add_meta_box( "teipress_css", "Attach CSS", array($this, "tei_css_add"), "teipress");
						}
						if($js){
							add_meta_box( "teipress_js", "Attach Javascript", array($this, "tei_js_add"), "teipress");
						}
						if($head){
							add_meta_box( "teipress_head", "Attach HTML header", array($this, "tei_head_add"), "teipress");
						}
						add_meta_box( "teipress_buttons", "Add / Remove new TEI tag buttons", array($this, "tei_tags_actions"), "teipress");
					}
				}
			}else{
				global $post;
				if(isset($post->post_type)){
					if($post->post_type=="teipress"){
						add_filter( 'user_can_richedit' , '__return_false', 50 );	
						if($xslt){
							add_meta_box( "teipress_xslt", "Attach an XSLT", array($this, "tei_xslt_add"), "teipress");
						}
						if($css){
							add_meta_box( "teipress_css", "Attach CSS", array($this, "tei_css_add"), "teipress");
						}
						if($js){
							add_meta_box( "teipress_js", "Attach Javascript", array($this, "tei_js_add"), "teipress");
						}
						if($head){
							add_meta_box( "teipress_head", "Attach HTML header", array($this, "tei_head_add"), "teipress");
						}
						add_meta_box( "teipress_buttons", "Add / Remove new TEI tag buttons", array($this, "tei_tags_actions"), "teipress");
					}
				}
			}
			
		}
		
		function tei_xslt_add(){
		
			global $post;
		
			$args = array(
				'posts_per_page'   => 99,
				'orderby'          => 'post_title',
				'order'            => 'ASC',
				'post_type'        => 'teipress_xslt',
				'post_status'      => 'publish',
				'suppress_filters' => true 
			);
			$posts = get_posts( $args );
			
			$xslt = get_post_meta($post->ID, "xslt_attached");
			
			?><select name="teipress_attached_xslt"><option>Select an XSLT</option><?PHP
			foreach($posts as $post_xslt){
				?><option <?PHP if($xslt[0] == $post_xslt->ID){ echo "selected"; } ?> value="<?PHP echo $post_xslt->ID; ?>"><?PHP echo $post_xslt->post_title; ?></option><?PHP
			}
			?></select><?PHP
		}
		
		function tei_css_add(){
		
			global $post;
		
			$args = array(
				'posts_per_page'   => 99,
				'orderby'          => 'post_title',
				'order'            => 'ASC',
				'post_type'        => 'teipress_css',
				'post_status'      => 'publish',
				'suppress_filters' => true 
			);
			$posts = get_posts( $args );
			
			$xslt = get_post_meta($post->ID, "css_attached");
			
			?><select name="teipress_attached_css"><option>Select CSS</option><?PHP
			foreach($posts as $post_css){
				?><option <?PHP if($xslt[0] == $post_css->ID){ echo "selected"; } ?> value="<?PHP echo $post_css->ID; ?>"><?PHP echo $post_css->post_title; ?></option><?PHP
			}
			?></select><?PHP
		}
		
		function tei_js_add(){
		
			global $post;
		
			$args = array(
				'posts_per_page'   => 99,
				'orderby'          => 'post_title',
				'order'            => 'ASC',
				'post_type'        => 'teipress_js',
				'post_status'      => 'publish',
				'suppress_filters' => true 
			);
			$posts = get_posts( $args );
			
			$js = get_post_meta($post->ID, "js_attached");
			
			?><select name="teipress_attached_js"><option>Select HTML Header</option><?PHP
			foreach($posts as $post_js){
				?><option <?PHP if($js[0] == $post_js->ID){ echo "selected"; } ?> value="<?PHP echo $post_js->ID; ?>"><?PHP echo $post_js->post_title; ?></option><?PHP
			}
			?></select><?PHP
		}
		
		function tei_head_add(){
		
			global $post;
		
			$args = array(
				'posts_per_page'   => 99,
				'orderby'          => 'post_title',
				'order'            => 'ASC',
				'post_type'        => 'teipress_head',
				'post_status'      => 'publish',
				'suppress_filters' => true 
			);
			$posts = get_posts( $args );
			
			$head = get_post_meta($post->ID, "head_attached");
			
			?><select name="teipress_attached_head"><option>Select Javascript</option><?PHP
			foreach($posts as $post_head){
				?><option <?PHP if($head[0] == $post_head->ID){ echo "selected"; } ?> value="<?PHP echo $post_head->ID; ?>"><?PHP echo $post_head->post_title; ?></option><?PHP
			}
			?></select><?PHP
		}
		
		function tei_tags_actions(){
		
			$first_letter = "a";
		
			$terms = json_decode(file_get_contents(dirname(__FILE__) . "/../../tagdata/terms.json"));
			
			?><div id="accordion"><h3>A</h3>
						<div><?PHP
			
			foreach($terms as $name => $term){
				if(strtolower(substr($name,0,1))!=$first_letter){
					?>
						</div>
						<h3><?PHP echo ucfirst(substr($name,0,1)); ?></h3>
						<div>
					<?PHP
					$first_letter = substr($name,0,1);
				}
				?>
					<input <?PHP 
					
						$editor_options = get_option( 'teipress' );			
						$display_tags = $editor_options['display_tei_tags'];
					 
						if($display_tags == "tei_all"){ 
							echo " checked ";
						}
						if($display_tags == "tei_lite"){ 
							if(isset($term->lite)){
								echo " checked ";
							}
						}
						if($display_tags == "tei_list"){ 						
							$tag_options = get_option( 'teipress_tags' );							
							if(in_array($name, $tag_options['display_tei_tags'])){						
								echo " checked ";								
							}						
						}
						
					?> 
					empty="<?PHP if(isset($term->empty)){ echo "empty"; } ?>" type="checkbox" id="<?PHP echo "tei_" . $name; ?>" attributes_data="<?PHP echo $term->attribute; ?>" class="tei-tag-click" /><a href="<?PHP echo $term->url; ?>"><?PHP echo $name; ?></a>
				<?PHP
			}
			
			?></div><?PHP
			
		}
		
		function html_edit_footer() {
			remove_filter( 'user_can_richedit' , '__return_false', 50 );	
		}
		
		function tei_tags_enable(){ 
		
			if(isset($_GET['post_type'])){
			
				if($_GET['post_type']=="teipress"){
			  
					echo $this->show_tags();
					
				}
				
			}else{
			
				if(isset($_GET['post'])){
				
					$post = get_post($_GET['post']);
					
					if($post->post_type == "teipress"){
					
						echo $this->show_tags();
					
					}
				
				}
				
			}
			
		}
		
		function show_tags(){
			
			$content = '<script type="text/javascript">';
			
			$display_options = get_option('teipress');
			$display_tags = $display_options['display_tei_tags'];
	
			$terms = json_decode(file_get_contents(dirname(__FILE__) . "/../../tagdata/terms.json"));
			
			foreach($terms as $name => $term){						 
				if($display_tags == "tei_lite"){ 						 
					if(isset($term->lite)){			
						if($term->empty != ""){								
							$content .= "QTags.addButton( 'btn_tei_" . $name . "', '" . $name . "', '<" . $name . "/>', '' );"; 								
						}else{								
							$content .= "QTags.addButton( 'btn_tei_" . $name . "', '" . $name . "', '<" . $name . ">', '</" . $name . ">' );";								
						}								
					}							
				}
				
				if($display_tags == "all_tei"){ 						 
					if($term->empty != ""){								
						$content .= "QTags.addButton( 'btn_tei_" . $name . "', '" . $name . "', '<" . $name . "/>', '' );"; 								
					}else{								
						$content .= "QTags.addButton( 'btn_tei_" . $name . "', '" . $name . "', '<" . $name . ">', '</" . $name . ">' );";								
					}							
				}
				
				if($display_tags == "tei_list"){ 						
					$tag_options = get_option( 'teipress_tags' );							
					if(in_array($name, $tag_options['display_tei_tags'])){						
						if($term->empty != ""){									
							$content .= "QTags.addButton( 'btn_tei_" . $name . "', '" . $name . "', '<" . $name . "/>', '' );"; 									
						}else{									
							$content .= "QTags.addButton( 'btn_tei_" . $name . "', '" . $name . "', '<" . $name . ">', '</" . $name . ">' );";									
						}								
					}						
				}
				
				if($display_tags == "tei_file"){ 				
					global $post;
					if(strpos($post->post_content, "<" . strtolower($name) . " ")!=FALSE || strpos($post->post_content, "<" . strtolower($name) . ">")!=FALSE){
						if($term->empty != ""){									
							$content .= "QTags.addButton( 'btn_tei_" . $name . "', '" . $name . "', '<" . $name . "/>', '' );"; 									
						}else{									
							$content .= "QTags.addButton( 'btn_tei_" . $name . "', '" . $name . "', '<" . $name . ">', '</" . $name . ">' );";									
						}									
					}
				}
			
			}
			
			$content .= "</script>";
			  
			return $content;
			  
		}
		
		function admin_notices(){
			global $post;
			if(isset($post->ID)){
				$error = get_post_meta($post->ID, "save_error", false);
				if(isset($error[0])){
					?><div class="error"><?PHP echo $error[0] ?></div><?PHP
					delete_post_meta($post->ID, "save_error");
				}
			}
		}
		
		function save_post($id){
		
			$post = get_post($id);
			
			if($post->post_type=="teipress"){
			
				update_post_meta($id, "xslt_attached", $_POST['teipress_attached_xslt']);
				update_post_meta($id, "css_attached", $_POST['teipress_attached_css']);
				update_post_meta($id, "js_attached", $_POST['teipress_attached_js']);
				update_post_meta($id, "head_attached", $_POST['teipress_attached_head']);
			
				//&amp;
			
				$editor_options = get_option( 'teipress' );
				
				if($editor_options['validate_xml_save']=="validate"){
					$dom = new DOMDocument;
					ob_start();
					$dom->loadXML($post->post_content);
					if (!$dom->validate()) {				
						$error = explode("<br />", ob_get_contents());
						$errors = array_filter(array_unique($error));
						$error_message = "";
						foreach($errors as $error){
							if(trim($error)!=""){
								$message = explode(":", $error);
								$error_message .= "<p>" . strip_tags($message[4] . $message[5]) . "</p>";
							}
						}
						update_post_meta($id, "save_error", $error_message);
					}
					ob_end_clean();
				}
			}
		}
		
	}
	
	$teipress_editor = new teipress_editor();