jQuery(document).ready(
	function(){
		jQuery(".post-type-teipress_js .wp-editor-area")
			.on("keydown", function(event){
				if(event.keyCode==9){			
				
					var startPos = this.selectionStart;
					var endPos = this.selectionEnd;
					if(startPos == endPos){
						endPos = this.value.length;
					}
					
					this.value = this.value.substring(0,startPos) + "	" + this.value.substring(startPos,endPos);
		
					this.selectionStart = startPos + 1;
					this.selectionEnd = startPos + 1;
		
					if (event.preventDefault) {
						event.preventDefault();
					} else {
						event.returnValue = false;
						return false;
					}
				}
			}
		);
		
		jQuery(".post-type-teipress_css .wp-editor-area")
			.on("keydown", function(event){
				if(event.keyCode==9){			
				
					var startPos = this.selectionStart;
					var endPos = this.selectionEnd;
					if(startPos == endPos){
						endPos = this.value.length;
					}
					
					this.value = this.value.substring(0,startPos) + "	" + this.value.substring(startPos,endPos);
		
					this.selectionStart = startPos + 1;
					this.selectionEnd = startPos + 1;
		
					if (event.preventDefault) {
						event.preventDefault();
					} else {
						event.returnValue = false;
						return false;
					}
				}
			}
		);
		
		jQuery(".post-type-teipress_xslt .wp-editor-area")
			.on("keydown", function(event){
				if(event.keyCode==9){			
				
					var startPos = this.selectionStart;
					var endPos = this.selectionEnd;
					if(startPos == endPos){
						endPos = this.value.length;
					}
					
					this.value = this.value.substring(0,startPos) + "	" + this.value.substring(startPos,endPos);
		
					this.selectionStart = startPos + 1;
					this.selectionEnd = startPos + 1;
		
					if (event.preventDefault) {
						event.preventDefault();
					} else {
						event.returnValue = false;
						return false;
					}
				}
			}
		);
		
		jQuery(".post-type-teipress .wp-editor-area")
			.on("keydown", function(event){
				if(event.keyCode==9){			
				
					var startPos = this.selectionStart;
					var endPos = this.selectionEnd;
					if(startPos == endPos){
						endPos = this.value.length;
					}
					
					this.value = this.value.substring(0,startPos) + "	" + this.value.substring(startPos,endPos);
		
					this.selectionStart = startPos + 1;
					this.selectionEnd = startPos + 1;
		
					if (event.preventDefault) {
						event.preventDefault();
					} else {
						event.returnValue = false;
						return false;
					}
				}
			}
		);
		
		jQuery(".post-type-teipress_head .wp-editor-area")
			.on("keydown", function(event){
				if(event.keyCode==9){			
				
					var startPos = this.selectionStart;
					var endPos = this.selectionEnd;
					if(startPos == endPos){
						endPos = this.value.length;
					}
					
					this.value = this.value.substring(0,startPos) + "	" + this.value.substring(startPos,endPos);
		
					this.selectionStart = startPos + 1;
					this.selectionEnd = startPos + 1;
		
					if (event.preventDefault) {
						event.preventDefault();
					} else {
						event.returnValue = false;
						return false;
					}
				}
			}
		);
	}
);