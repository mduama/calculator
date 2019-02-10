$(document).ready(function() {
    $("#calculator_form_input").focus();

    $(".numbers").on("click", "button", function() {
        $("#calculator_form_input").val($("#calculator_form_input").val() + $(this).text());
    });
});