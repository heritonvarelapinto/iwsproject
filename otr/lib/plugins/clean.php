<?php
/**
 * Damn Small Rich Text Editor v0.2 for jQuery
 * by Roi Avidan <roi@avidansoft.com>
 * Demo: http://www.avidansoft.com/dsrte/
 * Released under the GPL License
 *
 * Clean HTML Command class.
 */

class dsRTECleanPlugin extends dsRTECommandButton
{
    /**
     * This plugin requires additional JavaScript files to operate.
     * Return them for inclusion.
     */
    public function getScripts()
    {
        return implode( "\n", array(
            '<script type="text/javascript" src="lib/plugins/clean.js"></script>',
        ) );
    }
}

?>