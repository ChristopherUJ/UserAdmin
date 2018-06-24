$(document).ready(function () {

    // Get form in order to update action to reference specific user id
    var form = document.getElementById("userUpdateForm");
    var emailForm = document.getElementById("emailForm");

    // Determine which row was clicked - edit
    $(document).on('click', "#edit-item", function () {
        $(this).addClass('edit-item-trigger-clicked');

        var options = {
            'backdrop': 'static'
        };
        $('#edit-modal').modal(options)
    });

    // Determine which row was clicked - mail
    $(document).on('click', "#mail-item", function () {
        $(this).addClass('mail-item-trigger-clicked');

        var options = {
            'backdrop': 'static'
        };
        $('#mail-modal').modal(options)
    });

    // Modal show - edit
    $('#edit-modal').on('show.bs.modal', function () {
        var el = $(".edit-item-trigger-clicked");
        var row = el.closest(".data-row");

        // Get data for current row from table
        var id = el.data('item-id');
        var company = row.children(".company").text();
        var name_first = row.children(".name_first").text();
        var name_last = row.children(".name_last").text();
        var telNum = row.children(".telNum").text();
        var email = row.children(".email").text();

        // Modify form action for current user id
        form.action = form.action.concat(id);

        // Populate form in modal
        $("#company").val(company);
        $("#name_first").val(name_first);
        $("#name_last").val(name_last);
        $("#telNum").val(telNum);
        $("#email").val(email);
    });

    // Modal show - mail
    $('#mail-modal').on('show.bs.modal', function () {
        var el = $(".mail-item-trigger-clicked");
        var row = el.closest(".data-row");

        // Get data for current row from table
        var id = el.data('item-id');

        // Modify form action for current user id
        emailForm.action = emailForm.action.concat(id);

    });

    // on modal hide - edit
    $('#edit-modal').on('hide.bs.modal', function () {
        $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
        $("#edit-form").trigger("reset");
        // Update form action to remove reference to user id
        form.action = form.action.substr(0, form.action.lastIndexOf('/') + 1);
    });

    // on modal hide - mail
    $('#mail-modal').on('hide.bs.modal', function () {
        $('.mail-item-trigger-clicked').removeClass('mail-item-trigger-clicked')
        $("#mail-form").trigger("reset");
        // Update form action to remove reference to user id
        emailForm.action = emailForm.action.substr(0, emailForm.action.lastIndexOf('/') + 1);
        // Clear contents of textarea when modal is closed
        document.getElementById("emailBody").value = "";
    });
})