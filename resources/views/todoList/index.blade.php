@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                    </span>
                    <h3 class="card-label">Daftar Todo List</h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="#" onclick="openModal(event)" class="btn btn-primary font-weight-bolder">
                        <span class="svg-icon svg-icon-md">
                            <i class="flaticon2-plus text-white"></i>
                        </span>
                        Tambah Todo List
                    </a>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="kt_datatable_todolist" style="margin-top: 13px !important">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <!--end: Datatable-->
            </div>
        </div>
    </div>
</div>

{{--Modal Add--}}
<div class="modal fade" id="inputTodoList" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Todo List</h4>
            </div>
            <div class="modal-body">
                <form role="form" onsubmit="submitOrders(this,event)" method="POST">
                    <div class="card-body">
                        <div id="todo-list"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary submitBtn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editTodoList" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Edit Todo List</h4>
            </div>
            <div class="modal-body">
                <form role="form" onsubmit="updateForm(this,event)" method="POST">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label>Title </label>
                                <input type="text" class="form-control title" id="e_title" placeholder="Title" />
                                <input type="hidden" class="form-control form-control-color" id="e_id" />
                            </div>
                            <div class="col-lg-6">
                                <label>Description </label>
                                <input type="text" class="form-control description" id="e_description" placeholder="Description" />
                            </div>
                            <div class="col-lg-4">
                                <label>Due Date </label>
                                <input type="date" class="form-control due_date" id="e_due_date" />
                            </div>
                            <div class="col pt-2" ><hr width="700px"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary submitBtn">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{asset('app/build/todoList.js')}}" type="text/javascript"></script>
@endsection


