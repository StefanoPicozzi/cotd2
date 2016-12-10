

$( document ).on( 'pageinit', "[data-role='page'].demo-page", function() {
    
    next = null;
    prev = null;
    rating = null;
    var item = $(this).attr("id");
    var page = "#" + item;

    next = $( this ).jqmData( "next" );    
    prev = $( this ).jqmData( "prev" );    
    rating = $( this ).jqmData( "rating" );

    if ( next != null ) {

        // alert("Page="+page+" Next="+next);

        $( document ).on( "swipeleft", page, function() {
            // pageContainer causing problems
            // $.mobile.pageContainer.pagecontainer('change', 'item.php?nextpage='+next, { transition: 'slide' });
            location.href= "item.php?nextpage="+next;
        });

        $( document ).on( "swiperight", page, "[data-role='page'].demo-page", function() {
            // $.mobile.pageContainer.pagecontainer('change', 'item.php?nextpage='+next, { transition: 'slide', reverse: 'true' });
            location.href= "item.php?nextpage="+prev;
        });

        $( ".control .next", page ).on( "click", function() {
            location.href= "item.php?nextpage="+next;
        });

        $( ".control .prev", page ).on( "click", function() {
            location.href= "item.php?nextpage="+prev;
        });

        $( ".control .save", page ).on( "click", function() {
            // alert("You have chosen " + favorite + " as a favorite with " + rating + " hearts.");            
            // $.mobile.pageContainer.pagecontainer('change', 'item.php?nextpage='+item+'&favourite='+item+'&rating='+rating, { transition: 'fade' });
            location.href= 'item.php?nextpage='+item+'&favorite='+item+'&rating='+rating;
        });

        $( ".control .cancel", page ).on( "click", function() {
            rating = 0;
            // alert("You have chosen " + favorite + " as a favorite with " + rating + " hearts.");            
            // $.mobile.pageContainer.pagecontainer('change', 'item.php?nextpage='+item+'&favourite='+item+'&rating='+rating, { transition: 'fade' });
            location.href= 'item.php?nextpage='+item+'&favorite='+item+'&rating='+rating;
        });

    }

});
