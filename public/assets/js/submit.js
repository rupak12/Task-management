$(document).on("submit", "form.universal-post", function (e) {
    e.preventDefault();
    let $this = $(this);
    let url = $this.prop("action");
    let fd = $this.serialize();
    let modalSelector = $this.closest(".modal");

    let $button = $(this).find('button[type="submit"]');
    let orgButtonHtml = $button.html();
    let spinnerTimeout;
    $button.prop("disabled", true); // Button Disabled after submission the form
    spinnerTimeout = setTimeout(function () {
        $button.html(
            '<span class="spinner-border spinner-border-sm" style="color: #ffffff" role="status" aria-hidden="true"></span><span style="color: #ffffff"> Processing...</span>'
        );
    }, 300);

    $.ajax({
        type: "POST",
        url: url,
        data: fd,
        dataType: "json",
        success: function (response) {
            clearTimeout(spinnerTimeout);
            $button.prop("disabled", false).html(orgButtonHtml);

            if (response.status) {
                localStorage.setItem("auth_token", response.token);
                toastr.success(response.message, "Success!");
                $(modalSelector).modal("hide");
                setTimeout(function () {
                    window.location.href = response.redirect_url;
                }, 1000);
            } else {
                toastr.error(response.message ?? "Login failed", "Error!");
            }
        },
        error: function (response) {
            clearTimeout(spinnerTimeout);
            $button.prop("disabled", false).html(orgButtonHtml);

            console.log(response);
            let responseJSON = response.responseJSON;
            $(".err_message").removeClass("d-block").remove();
            $("form.universal-post .form-control").removeClass("is-invalid");
            toastr.error("Please fill carefully!", "Error");

            if (responseJSON && responseJSON.errors) {
                $.each(responseJSON.errors, function (index, valueMessage) {
                    $("#" + index).addClass("is-invalid");
                    $("#" + index).after(
                        "<p class='d-block text-danger err_message'>" +
                            valueMessage +
                            "</p>"
                    );
                });
            }
        },
    });
});
