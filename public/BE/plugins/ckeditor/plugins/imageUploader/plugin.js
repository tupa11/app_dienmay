CKEDITOR.plugins.add( 'imageUploader', {
    requires: 'filetools',
    beforeInit: function( editor ) {
        if (!!!CKEDITOR.fileTools) {
            console.log("Please add the plugins fileTools and its requirements.")
        }
    },
    init: function( editor ) {

        // Add toolbar button for this plugin.
        editor.ui.addButton && editor.ui.addButton( 'Image', {
            label: 'Media Library',
            command: 'openDialog',
            toolbar: 'insert'
        } );

        // Add ACF rule to allow img tag
        editor.addCommand('openDialog', {
            exec: function(editor) {
                $('#uploadModal').addClass('editor').modal('show');
            }
        });
    }
});