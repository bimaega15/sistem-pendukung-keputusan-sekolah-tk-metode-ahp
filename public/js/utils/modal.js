const showModal = ({
    url = "",
    data = {},
    title = "",
    type = "",
    modalId = "",
}) => {
    $.ajax({
        url,
        data,
        type,
        dataType: "text",
        success: function (html) {
            $(`#${modalId} .modal-title`).text(title);
            $(`#${modalId} .modal-body-content`).html(html);
            $(`#${modalId}`).modal('show');

        },
        error: function (jqXHR, exception) {
            ajaxErrorMessage(jqXHR, exception);
        },
    });
};
