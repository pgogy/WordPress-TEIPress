<?PHP

	/**
	Plugin Name: TEIPress
	Description: Adds TEI editing and display capabilities to WordPress
	Author: pgogy
	Version: 0.1
	*/
	
	require_once( dirname(__FILE__) . "/code/tei/teipress_teiposttype.php" );
	require_once( dirname(__FILE__) . "/code/tei/teipress_teieditor.php" );	
	require_once( dirname(__FILE__) . "/code/tei/teipress_tei_display.php" );	
	
	require_once( dirname(__FILE__) . "/code/xslt/teipress_xsltposttype.php" );
	require_once( dirname(__FILE__) . "/code/xslt/teipress_xslteditor.php" );

	require_once( dirname(__FILE__) . "/code/css/teipress_cssposttype.php" );
	require_once( dirname(__FILE__) . "/code/css/teipress_csseditor.php" );
	
	require_once( dirname(__FILE__) . "/code/js/teipress_jsposttype.php" );
	require_once( dirname(__FILE__) . "/code/js/teipress_jseditor.php" );
	
	require_once( dirname(__FILE__) . "/code/head/teipress_headposttype.php" );
	require_once( dirname(__FILE__) . "/code/head/teipress_headeditor.php" );
	
	require_once( dirname(__FILE__) . "/code/tei/teipress_tei_settings.php" );
	require_once( dirname(__FILE__) . "/code/tei/teipress_tei_tag_settings.php" );
	
?>