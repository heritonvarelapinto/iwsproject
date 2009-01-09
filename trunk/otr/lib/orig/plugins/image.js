/**
 * Damn Small Rich Text Editor v0.2.2 for jQuery
 * by Roi Avidan <roi@avidansoft.com>
 * Demo: http://www.avidansoft.com/dsrte/
 * Released under the GPL License
 *
 * Image Upload Plugin
 */

var dsRTE_insertImage = function() {

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
     * Basically we need to attach a click handler on the Upload button.
     */
    this.PrepareCommand = function( dsrte, arguments, panel, $this ) {
        var args = arguments;
        $( '#'+arguments+'-ok' ).click( function() {
            dsrte.frame.focus();
            $.ajaxFileUpload({
                url: $this.attr( 'path' ),
                secureuri: false,
                fileElementId: args,
                dataType: 'json',
                success: function( data, s ) {
                    if ( data.error ) {
                        alert( data.error );
                    } else {
                        dsrte.frame.focus();
                        $( '#'+arguments ).val( '' );
                        panel.slideUp();
                        dsrte.doc.execCommand( 'insertimage', false, data.path+'/'+encodeURIComponent( data.file ) );
                    }
                },
                error: function( data, s, e ) {
                    alert( e + ': ' + data.responseText );
                }
            });
        } );

        // signal callback was successfully processed.
        return true;
    };
};

// Register new plugin with dsRTE
dsRTE.RegisterPlugin( new dsRTE_insertImage(), 'image' );
