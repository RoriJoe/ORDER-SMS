function _menuver_(var_objid){
	this.var_menu = document.getElementById(var_objid);
	this.var_submenus = this.var_menu.getElementsByTagName("div");
	this.var_remember = true;
	this.var_speed = 3;
	this.var_mark = true;
	this.var_oneonly = false;
}

_menuver_.prototype._init_ = function(){
	var var_main = this;
	
	for(var var_counter=0; var_counter < this.var_submenus.length; var_counter++){
		this.var_submenus[var_counter].getElementsByTagName("span")[0].onclick = function(){
			var_main._toggle_menu_(this.parentNode);
		};
	}
	
	if(this.var_mark){
		var var_links = this.var_menu.getElementsByTagName("a");
		
		for(var_counter=0; var_counter < var_links.length; var_counter++){
			if(var_links[var_counter].href == document.location.href){
				var_links[var_counter].className = "mymenuvercurrent";
				
				break;
			}
		}
	}
	
	if(this.var_remember){
		var var_regex = new RegExp("_menuver_" + encodeURIComponent(this.var_menu.id) + "=([01]+)");
		var var_match = var_regex.exec(document.cookie);
		
		if(var_match){
			var var_states = var_match[1].split("");
			
			for(var_counter=0; var_counter < var_states.length; var_counter++){
				this.var_submenus[var_counter].className = (var_states[var_counter] == 0 ? "collapsed" : "");
			}
		}
	}
};

_menuver_.prototype._toggle_menu_ = function(var_submenu){
	if(var_submenu.className == "collapsed"){
		this._expand_menu_(var_submenu);
	}else{
		this._collapse_menu_(var_submenu);
	}
};

_menuver_.prototype._expand_menu_ = function(var_submenu){
	var var_fullheight = var_submenu.getElementsByTagName("span")[0].offsetHeight;
	var var_links = var_submenu.getElementsByTagName("a");
	
	for(var var_counter=0; var_counter < var_links.length; var_counter++){
		var_fullheight += var_links[var_counter].offsetHeight;
	}
	
	var var_moveby = Math.round(this.var_speed * var_links.length);
	
	var var_main = this;
	
	var var_intid = setInterval(function(){
		var var_curheight = var_submenu.offsetHeight;
		var var_newheight = var_curheight + var_moveby;
		
		if(var_newheight < var_fullheight){
			var_submenu.style.height = var_newheight + "px";
		}else{
			clearInterval(var_intid);
			var_submenu.style.height = "";
			var_submenu.className = "";
			var_main._memorize_();
		}
	}, 30);
	
	this._collapse_others_(var_submenu);
};

_menuver_.prototype._collapse_menu_ = function(var_submenu){
	var var_minheight = var_submenu.getElementsByTagName("span")[0].offsetHeight;
	var var_moveby = Math.round(this.var_speed * var_submenu.getElementsByTagName("a").length);
	var var_main = this;
	
	var var_intid = setInterval(function(){
		var var_curheight = var_submenu.offsetHeight;
		var var_newheight = var_curheight - var_moveby;
		
		if(var_newheight > var_minheight){
			var_submenu.style.height = var_newheight + "px";
		}else{
			clearInterval(var_intid);
			var_submenu.style.height = "";
			var_submenu.className = "collapsed";
			var_main._memorize_();
		}
	}, 30);
};

_menuver_.prototype._collapse_others_ = function(var_submenu){
	if(this.var_oneonly){
		for(var var_counter=0; var_counter < this.var_submenus.length; var_counter++){
			if(this.var_submenus[var_counter] != var_submenu && this.var_submenus[i].className != "collapsed"){
				this._collapse_menu_(this.var_submenus[var_counter]);
			}
		}
	}
};

_menuver_.prototype._expand_all_ = function(){
	var var_oldoneonly = this.var_oneonly;
	
	this.var_oneonly = false;
	
	for(var var_counter=0; var_counter < this.var_submenus.length; var_counter++){
		if(this.var_submenus[var_counter].className == "collapsed"){
			this._expand_menu_(this.var_submenus[var_counter]);
		}
	}
	
	this.var_oneonly = var_oldoneonly;
};

_menuver_.prototype._collapse_all_ = function(){
	for(var var_counter=0; var_counter < this.var_submenus.length; var_counter++){
		if (this.var_submenus[var_counter].className != "collapsed"){
			this._collapse_menu_(this.var_submenus[var_counter]);
		}
	}
};

_menuver_.prototype._memorize_ = function(){
	if(this.var_remember){
		var var_states = new Array();
		
		for(var var_counter=0; var_counter < this.var_submenus.length; var_counter++){
			var_states.push(this.var_submenus[var_counter].className == "collapsed" ? 0 : 1);
		}
		
		var var_date = new Date();
		var_date.setTime(var_date.getTime() + (30 * 24 * 60 * 60 * 1000));
		document.cookie = "_menuver_" + encodeURIComponent(this.var_menu.id) + "=" + var_states.join("") + "; expires=" + var_date.toGMTString() + "; path=/";
	}
};