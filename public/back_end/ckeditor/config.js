/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
    config.toolbarGroups = [
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
        { name: 'document', groups: [ 'document', 'mode', 'doctools' ] },
        { name: 'editing', groups: [ 'selection', 'find', 'spellchecker', 'editing' ] },
        { name: 'forms', groups: [ 'forms' ] },
        '/',
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
        { name: 'links', groups: [ 'links' ] },
        { name: 'insert', groups: [ 'insert' ] },
        '/',
        { name: 'styles', groups: [ 'styles' ] },
        { name: 'colors', groups: [ 'colors' ] },
        { name: 'tools', groups: [ 'tools' ] },
        { name: 'others', groups: [ 'others' ] },
        { name: 'about', groups: [ 'about' ] }
    ];
    config.removePlugins = 'elementspath';
    config.resize_enabled = true;
    config.removeButtons = 'Save,NewPage,ExportPdf,Preview,Print,Source,Templates,Anchor,Iframe,Flash,Image,Cut,Copy,Paste,PasteText,PasteFromWord,About,ShowBlocks,Radio,Checkbox,Form,Textarea,Button,Select,ImageButton,HiddenField,CreateDiv,SelectAll,Find,Replace,Scayt,TextField,Language,Smiley,Redo,Undo,PageBreak';
};
