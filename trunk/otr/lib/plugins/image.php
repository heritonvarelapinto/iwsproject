<?php
/**
 * Damn Small Rich Text Editor v0.2.2 for jQuery
 * by Roi Avidan <roi@avidansoft.com>
 * Demo: http://www.avidansoft.com/dsrte/
 * Released under the GPL License
 *
 * Image Upload Command class.
 */

class dsRTEImagePlugin extends dsRTECommandButton
{
    /**
     * Prepare the special hidden div for this command with a file browse and upload buttons.
     */
    protected function getPanelHTML()
    {
        $this->attributes[] = '"path":"uploadhandler.php"';

        $html = '<div class="rte panel" id="'.$this->id.'-'.$this->arguments.'">';
        $html .= t( 'Image' ).': ';
        $html .= '<input type="file" size="25" id="'.$this->arguments.'" name="'.$this->arguments.'-file" />';
        $html .= '<input type="button" id="'.$this->arguments.'-ok" value="'.t( 'Upload' ).'" />';
        $html .= '<input type="button" value="'.t( 'Cancel' ).'" onclick="$(\'#'.$this->id.'-'.$this->arguments.'\').slideUp()" />';
        $html .= '</div>';

        return $html;
    }

    /**
     * This plugin requires additional JavaScript files to operate.
     * Return them for inclusion.
     */
    protected function getScripts()
    {
        return implode( "\n", array(
            '<script type="text/javascript" src="lib/plugins/image.js"></script>',
            '<script type="text/javascript" src="lib/plugins/ajaxfileupload.min.js"></script>',
        ) );
    }
}

?>