function nl2br(text) {
    return text.replace(/\n/g, "<br />");
}

function htmlspecialchars(text) {
    return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

function ajaxFunc(url, data) {
    $.ajax({
        method: "POST",
        url: url,
        data: data,
        success: function(result) {
            closeModalWindow();

            let messageResult = result['message'];
            let urlResult = result['url'];

            if (urlResult.indexOf("review.php?id_review") !== -1) {
                $('.home_create').append(`<div class=\"success\">${messageResult}</div>`);
                setTimeout(function () {
                    location.reload();
                }, 1000);
            } else {
                $('#header').load("../header.php #header > *");
                $('.home_create').append(`<div class=\"success\">${messageResult}</div>`);
            }
        },
        error: function(result) {
            console.log("error", result);
            $('.errors_output').show();
            $('.errors_output_text').text(result.responseJSON);
        }
    });
}