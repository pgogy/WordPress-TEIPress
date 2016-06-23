<?PHP

	class teipress_headposttype{
	
		function __construct(){
			add_action("init", array($this, "tei_headposttype_create"));
			add_action("admin_menu", array($this, "tei_headposttype_menu"));
		}
		
		function tei_headposttype_create(){
	
			$labels = array(
				'name' => 'HTML Header Content',
				'singular_name' => 'HTML Header Content',
				'add_new' => 'Add new',
				'add_new_item' => 'Add HTML header Content',
				'edit_item' => 'Edit HTML header Content',
				'new_item' => 'New HTML header Content',
				'all_items' => 'All HTML header Content',
				'view_item' => 'View HTML header Content',
				'search_items' => 'Search HTML header Content',
				'not_found' =>  'No HTML header Content found',
				'not_found_in_trash' => 'No HTML header Content found in trash', 
				'parent_item_colon' => '',
				'menu_name' => 'HTML header'
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
		
			register_post_type( 'teipress_head' , $args );

		}	
	
		function tei_headposttype_menu(){
		
			global $submenu, $menu;
			
			$submenu['edit.php?post_type=teipress_head'] = "";
			unset($submenu['edit.php?post_type=teipress_head']);
			$submenu = array_filter($submenu);
			
			foreach($menu as $index => $value){
			
				if($menu[$index][0] == "HTML header"){
					unset($menu[$index]);
				}
			
			}
			
			$submenu['edit.php?post_type=teipress'][45] = Array
                (
                    0 => "All HTML header",
                    1 => "edit_posts",
                    2 => "edit.php?post_type=teipress_head"
                );
				
			$submenu['edit.php?post_type=teipress'][50] = Array
                (
                    0 => "Add new HTML header",
                    1 => "edit_posts",
                    2 => "post-new.php?post_type=teipress_head"
                );
			
		}
	
	}
	
	$teipress_headposttype = new teipress_headposttype();