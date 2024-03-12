//jquery check when input is focused, apply style to the input field, if not focused, remove style
$(document).ready(function () {
    $("#input-email").focus(function () {
        $("#label-email").addClass("has-focus");
    });
    $("#input-email").blur(function () {
        $("#label-email").removeClass("has-focus");
    });
    $("#input-pass").focus(function () {
        $("#label-pass").addClass("has-focus");
    });
    $("#input-pass").blur(function () {
        $("#label-pass").removeClass("has-focus");
    });
});

//jquery check if there is input in the input fields everytime the user types, if not empty, then apply style to the input field
$(document).ready(function () {
    $("#input-email").keyup(function () {
        if ($(this).val() != "") {
            $("#label-email").addClass("has-content");
        } else {
            $("#label-email").removeClass("has-content");
        }
    });
    $("#input-pass").keyup(function () {
        if ($(this).val() != "") {
            $("#label-pass").addClass("has-content");
        } else {
            $("#label-pass").removeClass("has-content");
        }
    });
});
