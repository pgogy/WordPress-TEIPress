<?PHP

	class teipress_teiposttype{
	
		function __construct(){
			add_action("init", array($this, "tei_posttype_create"));
		}
		
		function tei_posttype_create(){
	
			$labels = array(
				'name' => 'TEI Content',
				'singular_name' => 'TEI Content',
				'add_new' => 'Add new TEI',
				'add_new_item' => 'Add TEI Content',
				'edit_item' => 'Edit TEI Content',
				'new_item' => 'New TEI Content',
				'all_items' => 'All TEI Content',
				'view_item' => 'View TEI Content',
				'search_items' => 'Search TEI Content',
				'not_found' =>  'No TEI Content found',
				'not_found_in_trash' => 'No TEI Content found in trash', 
				'parent_item_colon' => '',
				'menu_name' => 'TEI Press'
			);
				
			$args = array(
				'labels' => $labels,
				'public' => true,
				'show_ui' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => true,
				'supports' => array('title', 'editor'),
				'menu_position' => 100,
				'exclude_from_search' => true,
				'show_in_nav_menus' => false
			);

			register_post_type( 'teipress' , $args );

		}	
	
	}
	
	$teipress_teiposttype = new teipress_teiposttype();