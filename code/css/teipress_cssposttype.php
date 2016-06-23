<?PHP

	class teipress_cssposttype{
	
		function __construct(){
			add_action("init", array($this, "tei_cssposttype_create"));
			add_action("admin_menu", array($this, "tei_cssposttype_menu"));
		}
		
		function tei_cssposttype_create(){
	
			$labels = array(
				'name' => 'CSS Content',
				'singular_name' => 'CSS Content',
				'add_new' => 'Add new',
				'add_new_item' => 'Add CSS Content',
				'edit_item' => 'Edit CSS Content',
				'new_item' => 'New CSS Content',
				'all_items' => 'All CSS Content',
				'view_item' => 'View CSS Content',
				'search_items' => 'Search CSS Content',
				'not_found' =>  'No CSS Content found',
				'not_found_in_trash' => 'No CSS Content found in trash', 
				'parent_item_colon' => '',
				'menu_name' => 'CSS Press'
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
		
			register_post_type( 'teipress_css' , $args );

		}	
	
		function tei_cssposttype_menu(){
		
			global $submenu, $menu;
			
			$submenu['edit.php?post_type=teipress_css'] = "";
			unset($submenu['edit.php?post_type=teipress_css']);
			$submenu = array_filter($submenu);
			
			foreach($menu as $index => $value){
			
				if($menu[$index][0] == "CSS Press"){
					unset($menu[$index]);
				}
			
			}
			
			$submenu['edit.php?post_type=teipress'][25] = Array
                (
                    0 => "All CSS",
                    1 => "edit_posts",
                    2 => "edit.php?post_type=teipress_css"
                );
				
			$submenu['edit.php?post_type=teipress'][30] = Array
                (
                    0 => "Add new CSS",
                    1 => "edit_posts",
                    2 => "post-new.php?post_type=teipress_css"
                );
			
		}
	
	}
	
	$teipress_cssposttype = new teipress_cssposttype();