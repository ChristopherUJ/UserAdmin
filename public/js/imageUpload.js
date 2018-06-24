<!-- allows clicking the visible image to "click" the hidden file upload -->
$(document).ready(function () {

    $("#profile_image").click(function(){
        $("input[id='profile']").click();
    });

});
