<?PHP

	class teipress_xsltposttype{
	
		function __construct(){
			add_action("init", array($this, "tei_xsltposttype_create"));
			add_action("admin_menu", array($this, "tei_xsltposttype_menu"));
		}
		
		function tei_xsltposttype_create(){
	
			$labels = array(
				'name' => 'XSLT Content',
				'singular_name' => 'XSLT Content',
				'add_new' => 'Add new',
				'add_new_item' => 'Add XSLT Content',
				'edit_item' => 'Edit XSLT Content',
				'new_item' => 'New XSLT Content',
				'all_items' => 'All XSLT Content',
				'view_item' => 'View XSLT Content',
				'search_items' => 'Search XSLT Content',
				'not_found' =>  'No XSLT Content found',
				'not_found_in_trash' => 'No XSLT Content found in trash', 
				'parent_item_colon' => '',
				'menu_name' => 'XSLT Press'
			);
				
			$args = array(
				'labels' => $labels,
				'public' => true,
				'show_ui' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => true,
				'supports' => array('title', 'editor'),
				'menu_position' => 99,
				'exclude_from_search' => true,
				'publically_queryable' => true,
			);
		
			register_post_type( 'teipress_xslt' , $args );

		}	
	
		function tei_xsltposttype_menu(){
		
			global $submenu, $menu;
			
			$submenu['edit.php?post_type=teipress_xslt'] = "";
			unset($submenu['edit.php?post_type=teipress_xslt']);
			$submenu = array_filter($submenu);
			
			foreach($menu as $index => $value){
			
				if($menu[$index][0] == "XSLT Press"){
					unset($menu[$index]);
				}
			
			}
			
			$submenu['edit.php?post_type=teipress'][15] = Array
                (
                    0 => "All XSLT",
                    1 => "edit_posts",
                    2 => "edit.php?post_type=teipress_xslt"
                );
				
			$submenu['edit.php?post_type=teipress'][20] = Array
                (
                    0 => "Add new XSLT",
                    1 => "edit_posts",
                    2 => "post-new.php?post_type=teipress_xslt"
                );
			
		}
	
	}
	
	$teipress_xsltposttype = new teipress_xsltposttype();