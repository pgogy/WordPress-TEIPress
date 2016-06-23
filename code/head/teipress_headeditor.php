<?PHP

	class teipress_headeditor{
	
		function __construct(){
			add_action( 'admin_head', array($this, 'prepare_editor') );	  
			add_filter( 'quicktags_settings', array($this, 'remove_buttons'));
			add_action( 'admin_enqueue_scripts', array($this, 'scripts_admin') );
		}
		
		function scripts_admin(){
			wp_enqueue_script( 'teipress-tab-override', plugins_url() . '/teipress/pluginjs/tei-tab.js', array( 'jquery' ) );
		}
		
		function remove_buttons( $qt  ) {
			if(isset($_GET['post_type'])){
				if($_GET['post_type']=="teipress_head"){
					$qt['buttons'] = ',';
				}
			}else{
				global $post;
				if(isset($post->post_type)){
					if($post->post_type=="teipress_head"){
						$qt['buttons'] = ',';	
					}
				}
			}
			return $qt;
		}
		
		function prepare_editor( ) {
			if(isset($_GET['post_type'])){
				if($_GET['post_type']=="teipress_head"){
					add_filter( 'user_can_richedit' , '__return_false', 50 );				
				}
			}else{
				global $post;
				if(isset($post->post_type)){
					if($post->post_type=="teipress_head"){
						add_filter( 'user_can_richedit' , '__return_false', 50 );	
					}
				}
			}
		}
		
	}
	
	$teipress_headeditor = new teipress_headeditor();