function GooglePlayButton() {
	return "[googleplay ]";
}

(function() {
	tinymce.create('tinymce.plugins.GooglePlayButton', {

		init : function(ed, url){
			ed.addButton('GooglePlayButton', {
			title : 'Google Play App Box',
				onclick : function() {
					ed.execCommand(
						'mceInsertContent',
						false,
						GooglePlayButton()
					);
				},
				image: url + "/mcebutton.png"
			});
		}
	});

	tinymce.PluginManager.add('googleplay', tinymce.plugins.GooglePlayButton);
})();