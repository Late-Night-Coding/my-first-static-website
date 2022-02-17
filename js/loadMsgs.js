
$(document).ready (function () {
    $("#load-more-msgs").click (function () {
        $(".sent").load("includes/load-more-msgs.php", {

        });
    });
});