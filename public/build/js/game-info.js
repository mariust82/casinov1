setTimeout(function() {

    var ResizeGameplay = function (iframe) {
        // Find iframe
        var $iframe = $(iframe);

        //Calculate the height of extra elements
        var $elements = $iframe.parent().children().not(iframe);
        var elHeight = 0;
        $elements.each(function () {
            elHeight += $(this).height();
        });

        // Find and save the aspect ratio for iframe
        $iframe.data("ratio", $iframe.height() / $iframe.width());

        // Resize the iframe when the window is resized
        $(window).resize(function () {
            console.log($iframe.data("ratio"))
            //Get the parent container's width and height
            // var width = $iframe.parent().width();
            // var height = $iframe.parent().outerHeight() - elHeight;
            //
            // $iframe.width(width).height(width * $iframe.data("ratio"));
            // $iframe.parent().height(width * $iframe.data("ratio"));
            //Adding width and height on iframe keeping proportions
            // if ($iframe.data("ratio") < height / width) {
            //     $iframe.width(width).height(width * $iframe.data("ratio"));
            //     $iframe.parent().height(width * $iframe.data("ratio"));
            // } else {
            //     $iframe.width(height / $iframe.data("ratio")).height(height);
            // }

            // Resize to fix iframe on page load.
        }).resize();
    }

    ResizeGameplay("iframe");

}, 3000);