$(document).ready(function () {
    $("#add_option").click(function () {
        $("<input/>", {
            type: "text",
            name: "option[]",
            class: "form-control",
        }).appendTo("#options_list");
        return false;
    });

    $(".confirm_delete").click(function () {
        return confirm("Вы действительно хотите удалить?");
    });

    $("#url_input").hide();
    $("#upload_image_input").hide();
    $("#document_type_id").on("change", function (e) {
        let type_id = this.value;
        if (type_id == 1) {
            $("#upload_image_input").show();
            $("#url_input").hide();
        } else if (type_id == 2) {
            $("#url_input").show();
            $("#upload_image_input").hide();
        }
    });
});
