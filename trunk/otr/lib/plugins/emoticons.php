<?php
/**
 * Damn Small Rich Text Editor v0.2 for jQuery
 * by Roi Avidan <roi@avidansoft.com>
 * Demo: http://www.avidansoft.com/dsrte/
 * Released under the GPL License
 *
 * Insert Emoticon Command class.
 */

class dsRTEEmoticonsPlugin extends dsRTECommandButton
{
    /**
     * Prepare the special hidden div for this command with a list of emoticon icons.
     */
    protected function getPanelHTML()
    {
        $smilies = array( 'cool' => t( 'Cool' ), 'cry' => t( 'Crying' ), 'embarassed' => t( 'Embarassed' ) );
        $icons = glob( 'images/smiley-*.gif' );

        $html = '<div class="rte panel" id="'.$this->id.'-'.$this->arguments.'">';
        for ( $i = 0; $i < count( $icons ); $i++ )
        {
            preg_match( '/smiley-([a-z-]+)\.gif$/', $icons[$i], $m );
            $html .= '<a class="emot" title="'.$smilies[$m[1]].'"><img src="'.$icons[$i].'" alt="smiley'.$i.'" /></a>';
        }
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
            '<script type="text/javascript" src="lib/plugins/emoticons.js"></script>',
        ) );
    }
}

?>