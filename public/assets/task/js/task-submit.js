// Fetch tasks and display them
function fetchTasks() {
    $.ajax({
        url: fetchTasksUrl,
        method: "GET",
        headers: {
            Authorization: `Bearer ${localStorage.getItem("auth_token")}`,
        },
        success: function (response) {
            if (response.data.length > 0) {
                let tasksHtml = "<tr>";
                $.each(response.data, function (k, v) {
                    tasksHtml += `
                    <td>${k + 1}</td>
                    
                    <td>
                        <div class="d-flex align-items-center gap-3 cursor-pointer">
                        <div class="">
                            <p class="mb-0">${v.title}</p>
                        </div>
                        </div>
                    </td>

                    <td>${v.description}</td>
                    <td>${v.due_date}</td>
                    <td>${v.display_priority}</td>
                    
                    <td>
                        <div class="table-actions d-flex align-items-center gap-3 fs-6">
                        <a href="javascript:;" class="text-primary viewTask" data-title="${
                            v.title
                        }" data-description="${v.description}" data-priority="${
                        v.display_priority
                    }" data-due_date="${v.due_date}" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Views"><i class="bi bi-eye-fill"></i></a>
                        <a href="${editTaskUrl.replace(
                            ":id",
                            v.id
                        )}" class="text-warning" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                        <a href="javascript:;" class="text-danger destroyTask" data-id="${
                            v.id
                        }" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
                        </div>
                    </td>
                `;
                    tasksHtml += "</tr>";
                });
                $("#tasksList").html(tasksHtml);
            } else {
                $("#tasksList").html(
                    "<tr><td class='text-center' colspan='6'>No record found<td></tr>"
                );
            }
        },
        error: function (response) {
            console.log(response);
            toastr.error(
                "Failed to fetch tasks. Please check your authentication.",
                "Error!"
            );
        },
    });

    $(document).on("click", ".viewTask", function () {
        let title = $(this).data("title");
        let description = $(this).data("description");
        let priority = $(this).data("priority");
        let due_date = $(this).data("due_date");
        $("#viewTaskModal").modal("show");
        $("#taskTitle").val(title);
        $("#taskDescription").val(description);
        $("#taskDueDate").val(priority);
        $("#taskPriority").val(due_date);
    });

    $(document).on("click", ".destroyTask", function () {
        let id = $(this).data("id");
        $("#destroyTaskModal").modal("show");
        $("#destroyTaskId").val(id);
    });
}

$(document).on("submit", "form.adv-task-filter", function (e) {
    e.preventDefault();
    var formData = $(this).serialize();

    $.ajax({
        url: fetchTasksFilteredUrl,
        method: "GET",
        data: formData,
        headers: {
            Authorization: `Bearer ${localStorage.getItem("auth_token")}`,
        },
        success: function (response) {
            $("#advFilterTaskModal").modal("hide");
            if (response.status) {
                if (response.data.length > 0) {
                    let tasksHtml = "";
                    $.each(response.data, function (k, v) {
                        tasksHtml += `
                        <td>${k + 1}</td>
                        
                        <td>
                            <div class="d-flex align-items-center gap-3 cursor-pointer">
                            <div class="">
                                <p class="mb-0">${v.title}</p>
                            </div>
                            </div>
                        </td>

                        <td>${v.description}</td>
                        <td>${v.due_date}</td>
                        <td>${v.display_priority}</td>
                        
                        <td>
                            <div class="table-actions d-flex align-items-center gap-3 fs-6">
                            <a href="javascript:;" class="text-primary viewTask" data-title="${
                                v.title
                            }" data-description="${
                            v.description
                        }" data-priority="${
                            v.display_priority
                        }" data-due_date="${
                            v.due_date
                        }" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" title="Views"><i class="bi bi-eye-fill"></i></a>
                            <a href="${editTaskUrl.replace(
                                ":id",
                                v.id
                            )}" class="text-warning" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                            <a href="javascript:;" class="text-danger destroyTask" data-id="${
                                v.id
                            }" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
                            </div>
                        </td>
                    `;

                        tasksHtml += "</tr>";
                    });
                    $("#tasksList").html(tasksHtml);
                } else {
                    $("#tasksList").html(
                        "<tr><td class='text-center' colspan='6'>No record found<td></tr>"
                    );
                }
            }
        },
        error: function (response) {
            $("#advFilterTaskModal").modal("hide");
            console.log(response);
            toastr.error(
                "Failed to fetch tasks. Please check your authentication.",
                "Error!"
            );
        },
    });
});

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
        headers: {
            Authorization: `Bearer ${localStorage.getItem("auth_token")}`,
        },
        success: function (response) {
            clearTimeout(spinnerTimeout);
            $button.prop("disabled", false).html(orgButtonHtml);

            if (response.status) {
                toastr.success(response.message, "Success!");
                $(modalSelector).modal("hide");
                setTimeout(function () {
                    window.location.href = response.redirect_url;
                }, 1000);
            } else {
                toastr.error(
                    response.message ?? "Something went wrong",
                    "Error!"
                );
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

function fetchAuthUser() {
    $.ajax({
        type: "GET",
        url: fetchAuthUserUrl,
        headers: {
            Authorization: `Bearer ${localStorage.getItem("auth_token")}`,
        },
        success: function (response) {
            if (response.status) {
                $("#userName").text(response.user.name);
            } else {
                toastr.error(response.message, "Unauthorized!");
                setTimeout(function () {
                    window.location.href = response.redirect_url;
                }, 1000);
            }
        },
        error: function (response) {
            console.log(response);
            toastr.error(
                "An error occurred while fetching user data.",
                "Error"
            );
            setTimeout(function () {
                window.location.href = loginPageUrl;
            }, 1000);
        },
    });
}

function logoutAuthUser() {
    $.ajax({
        type: "POST",
        url: logoutAuthUserUrl,
        data: {
            _token: csrfToken,
        },
        dataType: "json",
        headers: {
            Authorization: `Bearer ${localStorage.getItem("auth_token")}`,
        },
        success: function (response) {
            if (response.status) {
                localStorage.removeItem("auth_token");
                toastr.success(response.message, "Success!");
                setTimeout(function () {
                    window.location.href = response.redirect_url;
                }, 1000);
            } else {
                setTimeout(function () {
                    toastr.error(response.message ?? "Logout failed", "Error!");
                }, 1000);
            }
        },
        error: function (response) {
            console.log(response);
            toastr.error("An error occurred while logging out.", "Error");
        },
    });
}

function fetchTask(fetchTaskUrl) {
    $.ajax({
        url: fetchTaskUrl,
        method: "GET",
        headers: {
            Authorization: `Bearer ${localStorage.getItem("auth_token")}`,
        },
        success: function (response) {
            if (response.status) {
                $("#title").val(response.task.title);
                $("#description").val(response.task.description);
                $("#priority").val(response.task.priority);
                $("#due_date").val(response.task.due_date);
            } else {
                toastr.error(
                    response.message ?? "Failed to fetch task.",
                    "Error!"
                );
            }
        },
        error: function (response) {
            console.log(response);
            toastr.error("Something went wrong.", "Error!");
        },
    });
}
