jQuery(document).ready(
	function(){
		jQuery(".tei-tag-click")
			.on("click", function(event){
				console.log(event.target);
				if(jQuery(event.target).attr("checked")=="checked"){
					if(jQuery(event.target).attr("empty")==""){	
						QTags.addButton( 'btn_' + jQuery(event.target).attr("id"), 
										 jQuery(event.target).attr("id").split("tei_").join(""), 
										 '<' + jQuery(event.target).attr("id").split("tei_").join("") + " " + jQuery(event.target).attr("attributes_data").split(",").join('="" ') + "=\"\" >\n", 
										 '</' + jQuery(event.target).attr("id").split("tei_").join("") + ">");
						QTags.addButton( 'btn_' + jQuery(event.target).attr("id") + "_na", 
										 jQuery(event.target).attr("id").split("tei_").join("") + " (no attribs) ", 
										 '<' + jQuery(event.target).attr("id").split("tei_").join("") + ">\n", 
										 '</' + jQuery(event.target).attr("id").split("tei_").join("") + ">");
					}else{
						QTags.addButton( 'btn_' + jQuery(event.target).attr("id").split("tei_").join(""), 
										 jQuery(event.target).attr("id").split("tei_").join("")    , 
										 '<' + jQuery(event.target).attr("id") + "' " + jQuery(event.target).attr("attributes_data").split(",").join('="" ') + "=\"\" />\n", 
										 "");
						QTags.addButton( 'btn_' + jQuery(event.target).attr("id") + "_na", 
										 jQuery(event.target).attr("id").split("tei_").join("") + " (no attribs) ", 
										 '<' + jQuery(event.target).attr("id").split("tei_").join("") + " />\n", 
										 "");
					}
				}else{
					jQuery( '#qt_content_' + 'btn_' + jQuery(event.target).attr("id") )
						.remove();
					
					jQuery( '#qt_content_' + 'btn_' + jQuery(event.target).attr("id") + "_na" )
						.remove();
				}
			}
		);
	}
);