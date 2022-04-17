wp.domReady( () => {
    /*
    * Register Blocks Styles
    */
    wp.blocks.registerBlockStyle( 'core/paragraph', [
        {
            name: 'message',
            label: 'Message',
        },
        {
            name: 'message-warning',
            label: 'Warning',
        },
        {
            name: 'message-danger',
            label: 'Danger',
        }
    ]);

    wp.blocks.registerBlockStyle( 'core/list', [
        {
            name: 'two-col',
            label: 'Two Column',
        }
    ]);
} );
