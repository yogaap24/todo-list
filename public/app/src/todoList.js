'use strict'

import {createData, deleteData, verifyData, getResult} from "../api";

var DataUser = function () {
    var initTable1 = function () {
        var table = $('#kt_datatable_todolist');

        // begin first table
        table.DataTable({
            "responsive": true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            autoWidth: true,
            ajax: '/list_todolist',
            columns: [
                { data: 'title' },
                { data: 'description' },
                { data: 'due_date' },
                {},
                {},
            ],
            columnDefs: [
                {
                    "defaultContent": "-",
                    "targets": "_all"
                },
                {
                    targets: -2,
                    orderable: false,
                    render: function (data, type, row, meta) {
                        if (row.completed == true) {
                            return `
                                <p class="btn btn btn-light btn-clean" style="font-size:12px">Todo List Complete</p>
                            `;
                        } else if (row.completed == false) {
                            return (
                                `
                            <a data=` +
                                row.id +
                                ` href="#" onclick="verifyList(this)"  class="btn btn-sm btn btn-success btn-clean btn-icon btn-icon-md" title="Completed Todo List">
                                <i class="fa fa-check"></i>
                            </a>`
                            );
                        }
                    },
                },
                {
                    targets: -1,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return `
                        <a data=` + full.id + ` href="#" onclick="openModalEdit(this, event)" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">
                          <i class="fa fa-pencil-alt"></i>
                        </a>
                        <a data=` + full.id +` href="#" onclick="deleteList(this)"  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">
                          <i class="fa fa-trash"></i>
                        </a>`;
                    },
                },
            ],
        });
    };
    return {
        //main function to initiate the module
        init: function () {
            initTable1();
        },
    };
}();

jQuery(document).ready(function () {
    DataUser.init();
});

window.openModal = (evt) => {
    evt.preventDefault();
    $("#inputTodoList").modal("show");
    $("#todo-list").empty();
    addOrders(evt);
};

window.addOrders = (evt) => {
    $("#todo-list").append(`
                            <div class="form-group row">
                                <div class="col-lg-2">
                                    <label>Title </label>
                                    <input type="text" class="form-control title" id="title" placeholder="Title" />
                                </div>
                                <div class="col-lg-4">
                                    <label>Description </label>
                                    <input type="text" class="form-control description" id="description" placeholder="Description" />
                                </div>
                                <div class="col-lg-4">
                                    <label>Due Date </label>
                                    <input type="date" class="form-control due_date" id="due_date" />
                                </div>
                                <div class="col-lg-1 pt-3">
                                    <label class="hidden"></label>
                                    <a href="#" onclick="addOrders(this,event)" class="btn btn-primary btn-icon btn-sm flex-shrink-0">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                                <div class="col-lg-1 pt-3">
                                    <label class="hidden"></label>
                                    <a href="#" onclick="removeOrders(this,event)" class="btn btn-danger btn-icon btn-sm flex-shrink-0">
                                        <i class="fa fa-minus"></i>
                                    </a>
                                </div>
                                <div class="col pt-2" ><hr width="700px"></div>
                            </div>`);
    evt.preventDefault();
};

window.removeOrders = (input, evt) => {
    $(input).parent().parent().remove();
    evt.preventDefault();
};

window.openModalEdit = (input, evt) => {
    evt.preventDefault();
    var data = {id: $(input).attr('data')};
    getResult('/todoList/' + $(input).attr('data')).then(res => {
        let response = res.data
        if (response.success) {
            $('#editTodoList').modal(
                'show'
            )
            // console.log(response.data.title);
            document.getElementById('e_id').value = response.data.id;
            document.getElementById('e_title').value = response.data.title;
            document.getElementById('e_description').value = response.data.description;
            document.getElementById('e_due_date').value = response.data.due_date;
        } else {
            Swal.fire('Failed!', res.data.message, 'error');
        }
    })   
}

window.submitOrders = (input, evt) => {
    evt.preventDefault();

    let titles = $(".title");
    let title = [];
    let description = [];
    let due_date = [];


    for (let x = 0; x < titles.length; x++) {
        title.push($(titles[x]).val());
        description.push($($(".description")[x]).val());
        due_date.push($($(".due_date")[x]).val());
    }

    let data = {
        title: title,
        description: description,
        due_date: due_date,
    };

    Swal.fire({
        title: "Save Confirmation",
        text: "Are you sure you save this data",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Simpan",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            createData("/createTodoList", data)
            .then((res) => {
                let response = res.data;
                if (response.success) {
                    afterLoadingAttr('#saveBtn')
                    messages("Data saved successfully", "/todoList");
                }
            })
            .catch((err) => {
                afterLoadingAttr("#saveBtn");
                let error = err.response.data;
                console.log(error);
                if (!error.success) {
                    toastr.error(error.message);
                }
            });
        }
    });
};

window.updateForm = (input,evt) => {
    evt.preventDefault();
    let data = {
        id : getValue('e_id'),
        title : getValue('e_title'),
        description: getValue('e_description'),
        due_date: getValue('e_due_date'),
    }

    Swal.fire({
        title: 'Save Confirmation',
        text: "Are you sure you save this data",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Save',
        cancelButtonText: 'Back',
    }).then((result) => {
        if (result.isConfirmed) {
            createData('/updateTodoList' , data).then(res => {
                let response = res.data
                if (response.success) {
                    afterLoadingAttr('#saveBtn')
                    messages('Data saved successfully', '/todoList')
                }
            }).catch(err => {
                afterLoadingAttr('#saveBtn')
                let error = err.response.data
                console.log(error)
                if (!error.success) {
                    toastr.error(error.message)
                }
            })
        }
    })
}

window.deleteList = input => {
    var data = {id: $(input).attr('data')};
    Swal.fire({
        title: 'Warning',
        text: "Are you sure deleting this data?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            deleteData('/todoList/' + $(input).attr('data')).then(res => {
                const response = res.data
                if (response.success) {
                    Swal.fire('Success!', res.data.message, 'success');
                    window.location.reload();
                } else {
                    Swal.fire('Failed!', res.data.message, 'error');
                }
            })
        }
    })
}

window.verifyList = (input) => {
    var data = { id: $(input).attr("data") };
    Swal.fire({
        title: "Warning",
        text: "Are you sure verify this data?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        reverseButtons: true,
    }).then((result) => {
        verifyData("/verifyTodoList/" + $(input).attr("data")).then((res) => {
            const response = res.data;
            if (response.success) {
                Swal.fire("Success!", res.data.message, "success");
                window.location.reload();
            } else {
                Swal.fire("Failed!", res.data.message, "error");
            }
        });
    });
};