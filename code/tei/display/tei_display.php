<html>
	<head>
		<title>
			<?PHP

				global $post;
				echo $post->post_title; 
					
			?>
		</title>
		<?PHP
			$head = get_post_meta($post->ID, "head_attached");
			$head_post = get_post($head[0]);
			echo $head_post->post_content;
		?>
		<style>
			<?PHP
				$css = get_post_meta($post->ID, "css_attached");
				$css_post = get_post($css[0]);
				echo $css_post->post_content;
			?>
		</style>	
		<script type="text/javascript">
			<?PHP
				$js = get_post_meta($post->ID, "js_attached");
				$js_post = get_post($js[0]);
				echo $js_post->post_content;
			?>
		</script>
	</head>
	<body>
		<?PHP
		
			$xml = new DOMDocument;
			
			$data = str_replace('&', "&amp;", str_replace('xmlns="http://www.tei-c.org/ns/1.0"', "", $post->post_content));				
			$xml->loadXML($data);

			$xslt = get_post_meta($post->ID, "xslt_attached");
			$xslt_post = get_post($xslt[0]);
			
			$xsl = new DOMDocument;
			$xsl->loadXML($xslt_post->post_content);
			
			$proc = new XSLTProcessor;
			$proc->importStyleSheet($xsl); 

			$dom = $proc->transformToDoc($xml);
			echo $dom->saveXML();
			
		?>
	</body>	
</html>