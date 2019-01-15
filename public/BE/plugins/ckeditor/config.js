/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	config.autoParagraph = false;
	config.filebrowserBrowseUrl = '/ckfinder/ckfinder.html';
 	config.filebrowserUploadUrl = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';

 	config.extraPlugins = 'wordcount'; 
 	config.wordcount = {
 		// Whether or not you want to show the Word Count
        showWordCount: true,

        // Whether or not you want to show the Char Count
        showCharCount: true,
        
        // Maximum allowed Word Count
        // maxWordCount: 4,

        // Maximum allowed Char Count
        // maxCharCount: 10
 	};
};
