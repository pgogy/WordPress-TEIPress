<?PHP

	class teipress_xslteditor{
	
		function __construct(){
			add_action( 'admin_head', array($this, 'prepare_editor') );	  
			add_action( 'admin_print_footer_scripts',  array($this, 'xslt_enable'));
			add_filter( 'quicktags_settings', array($this, 'remove_buttons'));
			add_action( 'admin_enqueue_scripts', array($this, 'scripts_admin') );
		}
		
		function remove_buttons( $qt  ) {
			if(isset($_GET['post_type'])){
				if($_GET['post_type']=="teipress_xslt"){
					$qt['buttons'] = ',';
				}
			}else{
				global $post;
				if($post->post_type=="teipress_xslt"){
					$qt['buttons'] = ',';
				}
			}
			return $qt;
		}
		
		function scripts_admin() {
			wp_enqueue_script( 'teipress-tab-override', plugins_url() . '/teipress/pluginjs/tei-tab.js', array( 'jquery' ) );
		}
		
		function prepare_editor( ) {
			if(isset($_GET['post_type'])){
				if($_GET['post_type']=="teipress_xslt"){
					add_filter( 'user_can_richedit' , '__return_false', 50 );	
					add_meta_box( "teipress_buttons", "Add / Remove new TEI tag buttons", array($this, "tei_tags_actions"), "teipress");
				}
			}else{
				global $post;
				if(isset($post->post_type)){
					if($post->post_type=="teipress_xslt"){
						add_filter( 'user_can_richedit' , '__return_false', 50 );	
						add_meta_box( "teipress_buttons", "Add / Remove new TEI tag buttons", array($this, "tei_tags_actions"), "teipress");
					}
				}
			}
		}
		
		function show_tags(){
		
			$content = '<script type="text/javascript">';
			
			$terms = explode("\n", file_get_contents(dirname(__FILE__) . "/../../tagdata/xslt_data.txt"));
			
			foreach($terms as $row){
				
				$term = explode(",", $row);
				 
				if($term[1] == "empty"){
					
					$content .= "QTags.addButton( 'btn_tei_" . $term[0] . "', 'XML " . $term[0] . "', '<xsl:" . $term[0] . "/>', '' );"; 
					
				}else{
					
					$content .= "QTags.addButton( 'btn_tei_" . $term[0] . "', 'XML " . $term[0] . "', '<xsl:" . $term[0] . ">', '</" . $term[0] . ">' );";
					
				}
			
			}
			
			$terms = explode("\n", file_get_contents(dirname(__FILE__) . "/../../tagdata/xslt_functions.txt"));
			
			foreach($terms as $row){
				
				$term = explode(",", $row);
				 
				$content .= "QTags.addButton( 'btn_tei_" . $term[0] . "', 'Function " . $term[0] . "', '" . $term[0] . "()', '' );"; 
			
			}
			
			$content .= "</script>";
			  
			echo $content;
		
		}
		
		function xslt_enable(){ 
		
			if(isset($_GET['post_type'])){
			
				if($_GET['post_type']=="teipress_xslt"){
			  
					echo $this->show_tags();
					
				}
				
			}else{
			
				if(isset($_GET['post'])){
				
					$post = get_post($_GET['post']);
					
					if($post->post_type == "teipress_xslt"){
					
						echo $this->show_tags();
					
					}
				
				}
				
			}
			  
		}
		
	}
	
	$teipress_xslteditor = new teipress_xslteditor();