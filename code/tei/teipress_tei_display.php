<?PHP

	class teipress_tei_display{
	
		function __construct(){
		
			$display_options = get_option('teipress');
			$display_html = $display_options['display_inside_wordpress'];
		
			if($display_html = "no_wp"){
				add_filter( "single_template", array($this, "custom_post_type_template" ));
			}else{
				add_filter( 'the_content', array($this, 'display'));
			}
			
		}
		
		function custom_post_type_template($single_template) {

			global $post;

			if ($post->post_type == 'teipress') {
			
				$display_options = get_option('teipress');
				$display_raw = $display_options['allow_raw_display'];
			 
				if($display_raw == "raw" && isset($_GET['raw'])){
				
					$single_template = dirname( __FILE__ ) . '/display/raw_tei_display.php';
				
				}else{
				
					$single_template = dirname( __FILE__ ) . '/display/tei_display.php';
					
				}
			
			}
			 
			return $single_template;
			 
		}
		
		function display($content){
		
			global $post;
			
			if($post->post_type == "teipress"){
				
				$xml = new DOMDocument;
				
				$data = str_replace('xmlns="http://www.tei-c.org/ns/1.0"', "", $post->post_content);				
				$xml->loadXML($data);

				$xslt = get_post_meta($post->ID, "xslt_attached");
				$xslt_post = get_post($xslt[0]);
				
				$xsl = new DOMDocument;
				$xsl->loadXML($xslt_post->post_content);
				
				$proc = new XSLTProcessor;
				$proc->importStyleSheet($xsl); 

				$dom = $proc->transformToDoc($xml);
				echo $dom->saveXML();

			}else{
			
				return $content;
			
			}
			
		}
		
	}
	
	$teipress_tei_display = new teipress_tei_display();