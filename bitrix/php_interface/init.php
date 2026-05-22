<?
AddEventHandler("main", "OnBeforeHTMLEditorScriptRuns", function (&$editorConfig) {

    $editorConfig['allowSvg'] = true;

});
define("BX_DISABLE_HTML_EDITOR_SANITIZE", true);
// $GLOBALS['BX_DISABLE_HTML_EDITOR_SANITIZE'] = true;