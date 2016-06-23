<?PHP

	class teipress_jsposttype{
	
		function __construct(){
			add_action("init", array($this, "tei_jsposttype_create"));
			add_action("admin_menu", array($this, "tei_jsposttype_menu"));
		}
		
		function tei_jsposttype_create(){
	
			$labels = array(
				'name' => 'JS Content',
				'singular_name' => 'JS Content',
				'add_new' => 'Add new',
				'add_new_item' => 'Add JS Content',
				'edit_item' => 'Edit JS Content',
				'new_item' => 'New JS Content',
				'all_items' => 'All JS Content',
				'view_item' => 'View JS Content',
				'search_items' => 'Search JS Content',
				'not_found' =>  'No JS Content found',
				'not_found_in_trash' => 'No JS Content found in trash', 
				'parent_item_colon' => '',
				'menu_name' => 'JS Press'
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
		
			register_post_type( 'teipress_js' , $args );

		}	
	
		function tei_jsposttype_menu(){
		
			global $submenu, $menu;
			
			$submenu['edit.php?post_type=teipress_js'] = "";
			unset($submenu['edit.php?post_type=teipress_js']);
			$submenu = array_filter($submenu);
			
			foreach($menu as $index => $value){
			
				if($menu[$index][0] == "JS Press"){
					unset($menu[$index]);
				}
			
			}
			
			$submenu['edit.php?post_type=teipress'][35] = Array
                (
                    0 => "All JS",
                    1 => "edit_posts",
                    2 => "edit.php?post_type=teipress_js"
                );
				
			$submenu['edit.php?post_type=teipress'][40] = Array
                (
                    0 => "Add new JS",
                    1 => "edit_posts",
                    2 => "post-new.php?post_type=teipress_js"
                );
			
		}
	
	}
	
	$teipress_jsposttype = new teipress_jsposttype();