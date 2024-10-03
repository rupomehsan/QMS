var credentials = JSON.parse(localStorage.getItem("credentials")) || null;
var editDataCategoryId = "";
var editDataCategoryArray = [];

function formSubmitLanding(url, method, form, button, cb = false) {
    let form_data = JSON.stringify(form.serializeJSON());
    let formData = JSON.parse(form_data);

    if (formData.id) {
        method = "patch";
    }
    $.ajax({
        method: method,
        url: url,
        data: formData,
        dataType: "json",
        headers: {
            Authorization: credentials ? credentials.token : "",
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        beforeSend: function () {
            $(button.submitButton).prop("disabled", true);
            $(button.loaderButton).removeClass("d-none");
        },
        success: function (response) {
            if (response.status === "success") {
                toastr.success(response.message);
                $(button.submitButton).prop("disabled", false);
                $(button.loaderButton).addClass("d-none");
                form[0].reset();
                if (window.location.pathname == "/register") {
                    window.location.href = "/login";
                }
                if (response.data) {
                    localStorage.setItem(
                        "credentials",
                        JSON.stringify({
                            token: response.data.token || "",
                            information: response.data.user || "",
                        })
                    );

                    if (response.data.user.is_Admin == 1) {
                        window.location.href = "admin/dashboard";
                    } else {
                        window.location.href = "student/profile";
                    }
                }

                if (cb) {
                    if (formData.id) {
                        url = url.replace(formData.id, "");
                    }

                    getAllData(url, "data_list", headers, actions);
                    $("#createModal").modal("hide");
                }

                if (response.redirect) {
                    window.location.href = window.origin + response.redirect;
                }
            } else if (response.status == "error") {
                toastr.warning(response.message);
            }
        },
        error: function (xhr, resp, text) {
            console.log("err", xhr);
            if (xhr && xhr.responseText) {
                let response = JSON.parse(xhr.responseText);

                if (response.status === "validate_error") {
                    $error = Object.entries(response.data);
                    $.each($error, function (index, message) {
                        $("#" + message[0]).addClass("is-invalid");
                        $("." + message[0]).addClass("border border-danger");
                        $("#" + message[0] + "_label").addClass("text-danger");
                        $("#" + message[0] + "_error").html(message[1]);
                    });
                } else if (response.status === "error") {
                    toastr.error(response.message);
                }
            } else {
                toastr.error(
                    "Something went wrong",
                    "Please try again after sometime."
                );
            }
        },
        complete: function (xhr, status) {
            $(button.submitButton).prop("disabled", false);
            $(button.loaderButton).addClass("d-none");
        },
    });
}

/***
 * getAllStudents
 * **/

function getAllStudents() {
    $.ajax({
        url: "api/users?get_all",
        method: "get",
        dataType: "json",
        headers: {
            "Content-Type": "application/json",
        },
        success: function (res) {
            if (res.status === "success" && res.data.length > 0) {
                $("#tableData").empty();
                res.data.forEach((item) => {
                    $("#tableData").append(`
                        <tr class="${
                            item.email == "admin@gmail.com"
                                ? "bg-primary text-white"
                                : ""
                        }">
                            <th>${item.email}</th>
                            <td>******</td>
                            <td><button class="btn btn-secondary btn-sm"
                                    onclick="setCredential('${
                                        item.email
                                    }','123456')">Copy</button>
                            </td>
                        </tr>
                     `);
                });
            } else {
                $("#tableData").append(`
                    <div class="alert alert-warning text-center fw-bold">data not found..........</div>
              `);
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
}
/***
 * getStatistics
 * **/

function getStatistics() {
    $.ajax({
        url: window.origin + "/api/statistics",
        method: "get",
        dataType: "json",
        headers: {
            "Content-Type": "application/json",
        },
        success: function (res) {
            if (res.status === "success") {
                $(".users").text(res.data.allUsers);
                $(".subjects").text(res.data.allSubjects);
                $(".questions").text(res.data.allQuestions);
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
}

/**
 * checkDeliveryBoy
 */
function isAuthenticate() {
    if (credentials) {
        if (credentials.information.is_Admin == 1) {
            window.location.href = window.origin + "/admin/dashboard";
        } else {
            window.location.href = window.origin + "/student/profile";
        }
    }
}

/***
 * clearError
 * **/
function clearError(input) {
    $("." + input.id).removeClass("border border-danger");
    $("#" + input.id).removeClass("is-invalid");
    $("#" + input.id + "_label").removeClass("text-danger");
    $("#" + input.id + "_icon").removeClass("text-danger");
    $("#" + input.id + "_icon_border").removeClass("field-error");
    $("#" + input.id + "_error").html("");
}

//Global Variable section
//Global Variable section
var answer = "";
function getEditContent(url) {
    $.ajax({
        url: url,
        dataType: "json",
        method: "get",
        headers: {
            "Content-Type": "application/json",
        },
        success: function (res) {
            if (res.status === "success") {
                editDataCategoryId = res.data.category_id || "";
                answer = res.data.answer || "";
                $(".hide-password").remove();
                Object.entries(res.data).forEach(function (item) {
                    $("#" + item[0]).val(item[1]);

                    if (item[0] == "options") {
                        $("#options").empty();
                        if (item[1].length > 0) {
                            item[1].forEach((option, index) => {
                                $("#options").append(
                                    `
                                                 <div class="col-md-6">
                                                    <div class="d-flex gap-2">
                                                        <input type="checkbox" name="answer[]" value="${index}" ${optionChecked(
                                        index,
                                        answer
                                    )}>
                                                        <input type="text" class="form-control my-2" name="options[]" id="name" value="${option}">
                                                    </div>
                                                </div>
                                        `
                                );
                            });
                        }
                    }
                });

                function optionChecked(index, answer) {
                    let checked = "";
                    answer.forEach((item) => {
                        if (item == index) {
                            checked = "checked";
                        }
                    });

                    return checked;
                }
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
}

/**
 * Generate Table Data
 */
function generateTable(id, headers, data, actions = []) {
    let container = document.getElementById(id);
    container.innerHTML = "";
    console.log("my data", data.data?.length);
    if (data.data?.length > 0) {
        data.data.forEach(function (item, index) {
            let tableRow = document.createElement("tr");

            headers.forEach((header) => {
                Object.keys(item).forEach((key) => {
                    if (key === header.field) {
                        let tableData = document.createElement("td");

                        if (typeof item[key] == "object") {
                            console.log("key", item[key].name);
                            tableData.innerHTML = item[key].name;
                        } else {
                            tableData.innerHTML = item[key];
                        }

                        if (key === "image") {
                            if (item[key] !== null) {
                                // console.log("yes")
                                let image = item[key];
                                // console.log("iamgeeeeee", image)
                                let imageDiv = `<div class="sidebar-logo"><img src="${image}" class="" alt="logo.png" height="40" width="70"></div>`;
                                let imageTag = document.createElement("div");
                                imageTag.innerHTML = imageDiv;
                                tableData.innerHTML = "";
                                tableData.appendChild(imageTag);
                            } else {
                                console.log("no");
                                let imageDiv = `<div class="sidebar-logo"><img src="" class="logo-lg" alt="logo.png"></div>`;
                                let imageTag = document.createElement("div");
                                imageTag.innerHTML = imageDiv;
                                tableData.appendChild(imageTag);
                            }
                        }
                        if (key === "status") {
                            let div = `<div class="switch"> <label class=""> <input class="form-check-input" ${
                                item[key] === "active" ? "checked" : ""
                            }  id="approval" data-id="${
                                item.id
                            }" type="checkbox"  > <div class="slider round"></div></label></div>`;
                            let status = document.createElement("div");
                            status.innerHTML = div;
                            tableData.innerHTML = "";
                            tableData.appendChild(status);
                        }
                        if (key === "id") {
                            let sl = index + 1;
                            let cehkbox = `<input type="checkbox" class="checkbox-item" name="" value="${item.id}"/> ${sl}`;
                            tableData.innerHTML = cehkbox;
                        }
                        tableRow.appendChild(tableData);
                    }
                });

                if (header.field === "action" && actions.length) {
                    let tableData = document.createElement("td");

                    actions.forEach((actionItem) => {
                        let actionBtn = document.createElement("button");
                        actionBtn.textContent = actionItem.label;

                        if (actionItem.label.toLowerCase() === "edit") {
                            actionBtn.setAttribute(
                                "class",
                                "btn btn-success mx-1"
                            );

                            actionBtn.addEventListener("click", function () {
                                if (
                                    actionItem.modal &&
                                    actionItem.modal == true
                                ) {
                                    let url = actionItem.url.replace(
                                        ":id",
                                        item.id
                                    );
                                    getEditContent(url);
                                    $("#id").val(item.id);
                                    $("#createModal").modal("show");
                                    $("#actionTitle").text("Edit");
                                    $(".submit-button").text("Update");
                                    $(".password").addClass("d-none");
                                    $(".text-danger").text("");
                                    $(".form-control").removeClass(
                                        "is-invalid"
                                    );
                                } else {
                                    window.location.href =
                                        actionItem.url.replace(":id", item.id);
                                }

                                // console.log(item.id)
                                // actionItem.url.replace(':id', item.id)
                                // getEditData(actionItem.url.replace(':id', item.id))
                            });
                        } else if (
                            actionItem.label.toLowerCase() === "delete"
                        ) {
                            actionBtn.setAttribute(
                                "class",
                                "btn btn-danger me-1"
                            );

                            actionBtn.addEventListener("click", function () {
                                let params = "";
                                if (actionItem.param) {
                                    params = actionItem.param;
                                    deleteItem(
                                        actionItem.url.replace(":id", item.id),
                                        actionItem.url.replace(
                                            "/:id",
                                            "" + params
                                        )
                                    );
                                } else {
                                    deleteItem(
                                        actionItem.url.replace(":id", item.id),
                                        actionItem.url.replace("/:id", "")
                                    );
                                }

                                // console.log(item.id)
                            });
                        } else if (actionItem.label.toLowerCase() === "view") {
                            actionBtn.setAttribute(
                                "class",
                                "btn btn-primary me-1"
                            );
                        } else if (
                            actionItem.label.toLowerCase() === "result"
                        ) {
                            actionBtn.setAttribute(
                                "class",
                                "btn btn-primary me-1"
                            );
                            actionBtn.addEventListener("click", function () {
                                if (
                                    actionItem.modal &&
                                    actionItem.modal == true
                                ) {
                                    getAllExamsByStudentID(item.id);
                                    $("#resultModal").modal("show");
                                }
                            });
                        }

                        tableData.appendChild(actionBtn);
                    });

                    tableRow.appendChild(tableData);
                }
            });

            container.appendChild(tableRow);
        });
    } else {
        let tableRow = document.createElement("tr");
        let tableData = document.createElement("td");
        tableData.setAttribute("colspan", "6");
        tableData.classList.add("text-center", "text-danger", "fw-bold");
        tableData.innerHTML = "Data Not Found";
        tableRow.appendChild(tableData);
        container.appendChild(tableRow);
    }
}

/**
 * GET all Data
 */
function getAllData(url, id, headers, actions = [], searchData = null) {
    $.ajax({
        type: "GET",
        url: url,
        dataType: "json",
        headers: {
            "Content-Type": "application/json",
        },
        beforeSend: function () {
            // $("#data_list").addClass("d-none");
            // $(".product_placeholder").removeClass("d-none");
        },
        success: function (response) {
            if (response.status === "success") {
                let data = response.data;
                generateTable(id, headers, data, actions);
                setPagination(
                    response.data.total,
                    response.data.per_page,
                    response.data.current_page,
                    response.data.next_page_url,
                    response.data.prev_page_url
                );

                paginateItemClick(
                    url,
                    id,
                    headers,
                    actions,
                    searchData,
                    "",
                    "getall"
                );
            }
        },
        error: function (xhr, resp, text) {
            console.log(xhr, resp);
        },
        complete: function () {
            setTimeout(() => {
                endLoading();
            }, 1000);
        },
    });
}
/**
 * skelytone loader
 */
function endLoading() {
    $(".product_placeholder").fadeOut();
    $(".product_placeholder").addClass("d-none");
    $("#data_list").removeClass("d-none");
}

/**
 * GET date search Data
 */
function getDateSearchData(
    url,
    value,
    id,
    headers,
    actions = [],
    searchData = null
) {
    $.ajax({
        method: "post",
        url: url,
        dataType: "json",
        data: { value: value },
        headers: {
            "Content-Type": "application/json",
        },
        success: function (response) {
            if (response.status === "success") {
                let res = response.data;
                generateTable(id, headers, res, actions);
                setPagination(
                    response.data.total,
                    response.data.per_page,
                    response.data.current_page,
                    response.data.next_page_url,
                    response.data.prev_page_url
                );
                paginateItemClick(
                    url,
                    id,
                    headers,
                    actions,
                    searchData,
                    value,
                    "searchDate"
                );
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
}

/**
 * GET  search Data
 */
function getSearchData(
    url,
    value,
    id,
    headers,
    actions = [],
    searchData = null
) {
    $.ajax({
        method: "get",
        url: url,
        dataType: "json",
        data: { search: value },
        headers: {
            "Content-Type": "application/json",
        },
        success: function (response) {
            if (response.status === "success") {
                let res = response.data;
                generateTable(id, headers, res, actions);
                setPagination(
                    response.data.total,
                    response.data.per_page,
                    response.data.current_page,
                    response.data.next_page_url,
                    response.data.prev_page_url
                );
                paginateItemClick(
                    url,
                    id,
                    headers,
                    actions,
                    searchData,
                    value,
                    "searchData"
                );
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
}

// start
// pagination
// start
function setPagination(
    totalItem,
    perPageItem,
    currentPage,
    nextPage,
    prevPage
) {
    let pages = Math.ceil(totalItem / perPageItem);
    let nextPageId = nextPage;
    let prevPageId = prevPage;
    if (prevPageId !== null) {
        prevPageId = prevPage.split("=");
        prevPageId = prevPageId[1];
    }
    if (nextPageId !== null) {
        nextPageId = nextPage.split("=");
        nextPageId = nextPageId[1];
    }
    $("#paginateNav").empty();
    $("#paginateNav").append(`
               <li class="page-item ${
                   prevPageId === null ? "disabled" : ""
               }" data-id=${prevPageId}><a class="page-link "  href="javascript:void(0)">Previous</a></li>
            `);
    for (let i = 0; i < pages; i++) {
        $("#paginateNav").append(`
            <li data-id="${i + 1}" class="page-item ${
            i + 1 === currentPage ? "active" : ""
        }"><a class="page-link" href="javascript:void(0)">${i + 1}</a></li>
             `);
    }
    $("#paginateNav").append(`
               <li class="page-item ${
                   nextPageId === null ? "disabled" : ""
               }" data-id=${nextPageId}><a class="page-link next-page " href="javascript:void(0)" >Next</a></li>
            `);
}

function paginateItemClick(
    url,
    id,
    headers,
    actions,
    searchData,
    value = null,
    setfunct
) {
    let selectPage = 1;
    $(".page-item").click(function () {
        selectPage = "?page=" + $(this).attr("data-id");
        var pageUrl = url + selectPage;
        var mainpage = pageUrl.split("?")[0];
        if (selectPage !== "null") {
            if (setfunct === "getall") {
                getAllData(
                    mainpage + selectPage,
                    id,
                    headers,
                    actions,
                    searchData
                );
            } else if (setfunct === "searchDate") {
                getDateSearchData(
                    mainpage + selectPage,
                    value,
                    id,
                    headers,
                    actions,
                    searchData
                );
            } else if (setfunct === "searchData") {
                getSearchData(
                    mainpage + selectPage,
                    value,
                    id,
                    headers,
                    actions,
                    searchData
                );
            } else if (setfunct === "searchDateRange") {
                getDateRangeSearchData(
                    mainpage + selectPage,
                    value,
                    id,
                    headers,
                    actions,
                    searchData
                );
            }
        }
    });
}

// end
// pagination
// end

function deleteItem(url, cbUrl) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "DELETE",
                dataType: "json",
                headers: {
                    Authorization: credentials ? credentials.token : "",
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                    "Content-Type": "application/json",
                },

                success: function (res) {
                    console.log(res);
                    if (res.status === "success") {
                        Swal.fire(
                            "Deleted!",
                            "Your file has been deleted.",
                            "success"
                        );
                        getAllData(cbUrl, "data_list", headers, actions);
                    }
                },
                error: function (xhr, resp, text) {
                    console.log(xhr);
                    // on error, tell the failed
                },
            });
        }
    });
}
// end
// pagination
// end

function resetHandler() {
    $("#actionTitle").text("Add");
    $(".submit-button").text("Save");
    $("#formSubmit")[0].reset();
    $("#id").val("");
    $(".password").removeClass("d-none");
    $("#options").empty();
    $(".text-danger").text("");
    $(".form-control").removeClass("is-invalid");
    $(".password-section").empty();
    $(".password-section").append(`
        <div class="hide-password">
            <label for="name">Password</label>
            <input type="password" class="form-control my-2" name="password" id="password"
                onkeyup="clearError(this)">
            <div class="text-danger" id="password_error"></div>
        </div>
    `);
}

function checkStudentPermission() {
    if (credentials) {
        if (credentials.information.is_Admin != 0) {
            window.location.href = "/";
        }
    } else {
        window.location.href = "/";
    }
}

function logout() {
    let text = "Are you want to logedout\nEither Yes or Cancel.";
    if (confirm(text) == true) {
        localStorage.removeItem("credentials");
        window.location.href = "/";
    }
}

function getAllExams() {
    $.ajax({
        method: "get",
        url: window.origin + "/api/get-all-exams",
        dataType: "json",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Authorization: credentials ? credentials.token : "",
        },
        success: function (response) {
            if (response.status === "success") {
                response.data.forEach((item) => {
                    if (item.exam_results.length > 0) {
                        $("#allExam").append(`
                        <div class="card col-md-4 bg-info text-dark" style="width: 18rem;">
                            <div class="card-body text-center">
                                <h5 class="bg-secondary text-white py-2">${item.name}</h5>
                                <p class="card-text mt-3 fw-bold">Total Marks : ${item.questions.length} </p>
                                <p class="card-text mt-3 fw-bold">Result : ${item.exam_results[0].result} </p>
                                <a href="${window.origin}/student/result/${item.id}/${item.name}" class="btn btn-success">See Result</a>
                            </div>
                        </div>
                    `);
                    } else {
                        $("#allExam").append(`
                        <div class="card col-md-4 bg-info text-dark" style="width: 18rem;">
                            <div class="card-body text-center">
                                <h5 class="bg-secondary text-white py-2">${item.name}</h5>
                                <p class="card-text mt-3 fw-bold">Total Marks : ${item.questions.length} </p>
                                <a href="${window.origin}/student/exam/${item.id}/${item.name}" class="btn btn-warning">Start Test</a>
                            </div>
                        </div>
                    `);
                    }
                });
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function getAllExamsByStudentID(id) {
    $.ajax({
        method: "get",
        url: window.origin + "/api/get-all-exams-by-student-id/" + id,
        dataType: "json",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Authorization: credentials ? credentials.token : "",
        },
        success: function (response) {
            if (response.status === "success") {
                $("#allExam").empty();
                response.data.forEach((item) => {
                    if (item.exam_results.length > 0) {
                        $("#allExam").append(`
                        <div class="card col-md-4 bg-info text-dark" style="width: 18rem;">
                            <div class="card-body text-center">
                                <h5 class="bg-secondary text-white py-2">${item.name}</h5>
                                <p class="card-text mt-3 fw-bold">Total Marks : ${item.questions.length} </p>
                                <p class="card-text mt-3 fw-bold">Result : ${item.exam_results[0].result} </p>
                                <a href="${window.origin}/admin/student-result/${item.id}/${id}/${item.name}" class="btn btn-success">See Result</a>
                            </div>
                        </div>
                    `);
                    } else {
                        $("#allExam").append(`
                        <div class="card col-md-4 bg-info text-dark" style="width: 18rem;">
                            <div class="card-body text-center">
                                <h5 class="bg-secondary text-white py-2">${item.name}</h5>
                                <p class="card-text mt-3 fw-bold">Total Marks : ${item.questions.length} </p>
                                <button type="button" class="btn btn-warning">Do not attempt</button>
                            </div>
                        </div>
                    `);
                    }
                });
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function getAllQuestionBySubject(id) {
    $.ajax({
        method: "get",
        url: window.origin + "/api/get-all-questions-by-subject/" + id,
        dataType: "json",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Authorization: credentials ? credentials.token : "",

        },
        success: function (response) {
            if (response.status === "success") {
                console.log("data", response.data);
                var questionsHtml = "";
                if (response.data.length > 0) {
                    $("#examName").text(response.data[0].subject.name);
                    response.data.forEach(function (question, index) {
                        questionsHtml += "<div>";
                        questionsHtml += `<p class="fw-bold mt-3">${
                            index + 1
                        }. ${question.question}</p>`;
                        questionsHtml += '<div class="row">';
                        question.options.forEach(function (option, index) {
                            questionsHtml += `
                        <div class="col-md-6">

                           <label for="${option}" class="box  w-100 d-flex gap-3">
                           <input type="checkbox" class="d-inline-block " name="answer[${question.id}][]" id="${option}" value="${index}">
                                <div class="course">
                                    <span class="circle"></span>
                                    <span class="subject">${option}</span>
                                </div>
                           </label>
                        </div>`;
                        });
                        questionsHtml += " </div> </div>";
                    });
                }
                $("#examQuestions").html(questionsHtml);
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function getResultBySubject(id) {
    $.ajax({
        method: "get",
        url: window.origin + "/api/exam-result-by-subject/" + id,
        dataType: "json",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Authorization: credentials ? credentials.token : "",
        },
        success: function (response) {
            if (response.status === "success") {
                var questionsHtml = "";
                if (response.data.length > 0) {
                    $("#examName").text(response.data[0].subject.name);
                    response.data.forEach(function (question, index) {
                        questionsHtml += "<div>";
                        questionsHtml += `<p class="fw-bold mt-3">${
                            index + 1
                        }. ${question.question}</p>`;
                        questionsHtml += '<div class="row">';
                        question.options.forEach(function (option, index) {
                            questionsHtml += `
                        <div class="col-md-6">

                           <label for="${
                               question.id + index
                           }" class="box  w-100 d-flex gap-3
                           ${justifyResult(
                               question.id,
                               question.answer,
                               response.result[question.id],
                               index
                           )}
                        ">
                           <input disabled type="checkbox" class="d-inline-block " name="answer[${
                               question.id
                           }]" id="${question.id + index}" value="${index}">
                                <div class="course">
                                    <span class="circle"></span>
                                    <span class="subject">${option}</span>
                                </div>
                           </label>
                        </div>`;
                        });

                        questionsHtml += " </div> </div>";
                    });
                }
                $("#examResults").html(questionsHtml);

                function justifyResult(
                    quesionId,
                    answerIndex,
                    result,
                    optionIndex
                ) {
                    var justify = "";
                    var rightAns = false;
                    answerIndex.forEach((ans) => {
                        if (ans == optionIndex) {
                            justify = "bg-success";
                            rightAns = true;
                        }
                    });
                    console.log(result);
                    result.forEach((res) => {
                        console.log(res);
                        if (res == optionIndex) {
                            if (!rightAns) {
                                justify += " bg-danger";
                            }
                            if (rightAns) {
                                justify += " border border-3 border-warning";
                            }
                        }
                    });

                    return justify;
                }
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function getResultBySubjectWithStudentID(id, stID) {
    $.ajax({
        method: "get",
        url: window.origin + "/api/get-result-by-student-id/" + id + "/" + stID,
        dataType: "json",
        headers: {
            "Content-Type": "application/json",
        },
        success: function (response) {
            if (response.status === "success") {
                var questionsHtml = "";
                $(".student_name").text(response.studentInfo.user_name);
                $(".obtained_mark").text(response.result.result);
                if (response.data.length > 0) {
                    $("#examName").text(response.data[0].subject.name);
                    response.data.forEach(function (question, index) {
                        questionsHtml += "<div>";
                        questionsHtml += `<p class="fw-bold mt-3">${
                            index + 1
                        }. ${question.question}</p>`;
                        questionsHtml += '<div class="row">';
                        question.options.forEach(function (option, index) {
                            questionsHtml += `
                        <div class="col-md-6">

                           <label for="${
                               question.id + index
                           }" class="box  w-100 d-flex gap-3
                           ${justifyResult(
                               question.id,
                               question.answer,
                               response.result["answers"][question.id],
                               index
                           )}
                        ">
                           <input disabled type="radio" class="d-inline-block " name="answer[${
                               question.id
                           }]" id="${question.id + index}" value="${index}">
                                <div class="course">
                                    <span class="circle"></span>
                                    <span class="subject">${option}</span>
                                </div>
                           </label>
                        </div>`;
                        });

                        questionsHtml += " </div> </div>";
                    });
                }
                $("#examResults").html(questionsHtml);

                function justifyResult(
                    quesionId,
                    answerIndex,
                    result,
                    optionIndex
                ) {
                    var justify = "";
                    var rightAns = false;
                    answerIndex.forEach((ans) => {
                        if (ans == optionIndex) {
                            justify = "bg-success";
                            rightAns = true;
                        }
                    });
                    console.log(result);
                    result.forEach((res) => {
                        console.log(res);
                        if (res == optionIndex) {
                            if (!rightAns) {
                                justify += " bg-danger";
                            }
                            if (rightAns) {
                                justify += " border border-3 border-warning";
                            }
                        }
                    });

                    return justify;
                }
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function fetchMe() {
    $.ajax({
        method: "get",
        url: window.origin + "/api/fetch-me",
        dataType: "json",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Authorization: credentials ? credentials.token : "",
        },
        success: function (response) {
            if (response.status === "success") {
                $(".user_name").text(response.data.user_name);
                $(".email").text(response.data.email);
                $(".phone").text(response.data.phone);
                $(".image").attr(
                    "src",
                    response.data.image ?? "/assets/images/avatar.png"
                );
                Object.entries(response.data).forEach((element) => {
                    $("#" + element[0]).val(element[1]);
                });
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
}
