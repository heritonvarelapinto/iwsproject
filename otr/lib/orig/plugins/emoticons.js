/**
 * Damn Small Rich Text Editor v0.2.2 for jQuery
 * by Roi Avidan <roi@avidansoft.com>
 * Demo: http://www.avidansoft.com/dsrte/
 * Released under the GPL License
 *
 * Insert Emoticon Plugin
 */

var dsRTE_emoticons = function() {

    /**
     * Execute Plugin.
     * Show the hidden panel.
     */
    this.ExecuteCommand = function( dsrte, arguments, panel ) {
        panel.slideToggle();
        return true;
    };

    /**
     * Prepare Plugin.
     * Attach a Click handler on every emoticon and fix hover behaviour in IE.
     */
    this.PrepareCommand = function( dsrte, arguments, panel, $this ) {
        $( dsrte.iframe ).parents( 'table:first' ).find( '.emot' ).each( function() {
            $(this).click( function() {
                dsrte.frame.focus();
                dsrte.doc.execCommand( 'insertimage', false, $(this).children()[0].src );
                dsrte.frame.focus();
                panel.slideUp();
                return false;
            });

            // IE hover fix
            if ( $.browser.msie )
                $( 'img', $(this) ).mouseover( function() { this.className = 'hvr' }).mouseout( function() { this.className = '' });
        });

        // signal callback was successfully processed.
        return true;
    };
};

// Register new plugin with dsRTE
dsRTE.RegisterPlugin( new dsRTE_emoticons(), 'emoticons' );
