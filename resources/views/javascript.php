(function(){
	var APPURL = {
		current: function(){
			return '<?php echo url('/') ?>';
		},
		get: function(action){
			return '<?php echo url('/') ?>' + action;
		}
	};
	window.APPURL = APPURL;
}());