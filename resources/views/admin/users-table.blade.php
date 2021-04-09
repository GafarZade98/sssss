@extends('admin.admin-layout')
@section('title','Users')
@section('content')
    <main class="mt-5">
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    DataTable Example
                </div>

                <div class="card-body">


{{--                    <div id="toolbar">--}}
{{--                        <button id="remove" class="btn btn-success">--}}
{{--                            <i class="fa fa-plus"></i> Add--}}
{{--                        </button>--}}
{{--                    </div>--}}
                    <table
                        id="table"
                        data-toolbar="#toolbar"
                        data-search="true"
                        data-show-refresh="true"
                        data-show-toggle="true"
                        data-show-fullscreen="true"
                        data-show-columns="true"
                        data-show-columns-toggle-all="true"
                        data-detail-view="true"
                        data-show-export="true"
                        data-click-to-select="true"
                        data-detail-formatter="detailFormatter"
                        data-minimum-count-columns="2"
                        data-show-pagination-switch="true"
                        data-pagination="true"
                        data-id-field="id"
                        data-page-list="[10, 25, 50, 100, all]"
                        data-show-footer="true"
                        data-side-pagination="server"
                        data-url="{{route('get-users')}}"
                        data-buttons="buttons"
                        data-response-handler="responseHandler">

                    </table>

{{--                    <table--}}
{{--                        id="table"--}}
{{--                        data-click-to-select="true"--}}
{{--                        data-show-refresh="true"--}}
{{--                        data-show-fullscreen="true"--}}
{{--                        data-search="true"--}}
{{--                        data-toggle="table"--}}
{{--                        data-url="{{route('get-users')}}"--}}
{{--                        data-side-pagination="server"--}}
{{--                        data-pagination="true"--}}
{{--                        data-page-list="[10, 25, 50]"--}}
{{--                        data-buttons="buttons"--}}
{{--                        data-resizable="false"--}}
{{--                        --}}{{--                    data-detail-view="true"--}}
{{--                        --}}{{--                    data-detail-view-icon="true"--}}
{{--                        --}}{{--                    data-detail-formatter="courseDetailFormatter"--}}
{{--                        class="table">--}}
{{--                        <thead>--}}
{{--                        <th scope="col" data-field="state" data-checkbox="true">ID</th>--}}
{{--                        <th scope="col" data-field="id" data-sortable="true">ID</th>--}}
{{--                        <th scope="col" data-field="name" data-sortable="true">Name</th>--}}
{{--                        <th scope="col" data-field="email" data-sortable="true">email</th>--}}
{{--                        <th scope="col" data-field="country" data-sortable="true">country</th>--}}
{{--                        <th scope="col" data-field="role" data-sortable="true">role</th>--}}
{{--                        <th scope="col" data-field="status" data-sortable="true">Status</th>--}}
{{--                        <th scope="col" data-field="operate" data-formatter="operateFormatter" data-events="operateEvents">Buttons</th>--}}
{{--                        </thead>--}}
{{--                    </table>--}}
{{--                    --}}
                </div>
            </div>
        </div>
    </main>
    <div class="modal fade" id="editorModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row" action="#" id="UpdateForm" method="post">
                        @csrf
                        <input type="hidden" class="setnull" name="id" id="userId">
                        <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control setnull" name="name" placeholder="Name" id="name">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="country">Country</label>
                            <input type="text" class="form-control setnull" placeholder="Country" required name="country"
                                   id="country">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control setnull" name="email" placeholder="Email"
                                   id="email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input type="password" class="form-control setnull" name="password" placeholder="Password"
                                   id="password">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="avatar">Avatar</label>
                            <input type="text" class="form-control setnull" name="avatar" placeholder="Avatar"
                                   id="avatar">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="role">Role</label>
                            <select class="form-control setnull" name="role" id="role">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                                <option value="author">Author</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Status</label><br>
                            <label for="statusEnable">Enable</label>
                            <input id="statusEnable" name="status" value="1" type="radio">
                            <label for="statusDisable">Disable</label>
                            <input id="statusDisable" name="status" value="0" type="radio">
                        </div>


                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="UpdateForm">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>

        var $table = $('#table')
        var $remove = $('#remove')
        var selections = []

        function getIdSelections() {
            return $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id
            })
        }

        function responseHandler(res) {
            $.each(res.rows, function (i, row) {
                row.state = $.inArray(row.id, selections) !== -1
            })
            return res
        }

        function detailFormatter(index, row) {
            var html = []
            $.each(row, function (key, value) {
                html.push('<p><b>' + key + ':</b> ' + value + '</p>')
            })
            return html.join('')
        }

        function operateFormatter(value, row, index) {
            return [
                // '<a href="javascript:void(0)" class="edit mr-2" data-toggle="modal" data-target="#editorModal">',
                // '<i class="fa fa-cog"></i>',
                // '</a>',
                '<a class="remove" href="javascript:void(0)" title="Remove">',
                '<i class="fa fa-trash"></i>',
                '</a>'
            ].join('')
        }

        window.operateEvents = {
            'click .edit': function (e, value, user, index) {
                $('#userId').val(user.id)
                $('#name').val(user.name)
                $('#country').val(user.country)
                $('#avatar').val(user.avatar)
                $('#email').val(user.email)
                $('#password').val(user.password)
                $("#role option[value='"+user.role+"']").prop('selected', true);
                $("input[name='status'][value='" + user.status + "']").prop('checked', true);


            },
            'click .remove': function (e, value, row, index) {
                $.ajax('{{route('user.delete')}}', {
                    method: 'post',
                    data: {
                        _token: '{{csrf_token()}}',
                        data: JSON.stringify($table.bootstrapTable('getSelections'))
                    },
                    success: function (data, status, xhr) {   // success callback function
                        $table.bootstrapTable('refresh')
                        //alert('success')
                    },
                    error: function (jqXhr, textStatus, errorMessage) { // error callback
                        alert('error')
                    }
                });
            }
        }
        $("#UpdateForm").submit(function (e) {
            e.preventDefault();
            $.ajax('{{route('user.store')}}', {
                method: 'post',
                data: $(this).serialize(),
                success: function (data, status, xhr) {
                    $table.bootstrapTable('refresh')
                    $('#editorModal').modal('hide');
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    alert('error')
                }
            });
        });

        $remove.click(function () {

            $('.setnull').val('')
            $('textarea').text('')
            $('#editorModal').modal('show');

        });

        function totalTextFormatter(data) {
            return 'Total'
        }

        function totalNameFormatter(data) {
            return data.length
        }
        function totalCountryFormatter(data) {
            return data.length
        }
        function totalRoleFormatter(data) {
            return data.length
        }



        function initTable() {
            $table.bootstrapTable('destroy').bootstrapTable({
                height: 550,
                locale: $('#locale').val(),
                columns: [
                        [{
                            field: 'state',
                            checkbox: true,
                            rowspan: 2,
                            align: 'center',
                            valign: 'middle'
                        }, {
                        title: 'Item ID',
                        field: 'id',
                        rowspan: 1,
                        align: 'center',
                        valign: 'middle',
                        sortable: true,
                        footerFormatter: totalTextFormatter
                    }, {
                        title: 'Item Detail',
                        colspan: 3,
                        align: 'center'
                    }],
                    [{
                        field: 'name',
                        title: 'Item Name',
                        sortable: true,
                        footerFormatter: totalNameFormatter,
                        align: 'center'
                    },
                        {
                        field: 'country',
                        title: 'Country',
                        sortable: true,
                        footerFormatter: totalCountryFormatter,
                        align: 'center'
                    },  {
                        field: 'role',
                        title: 'Role',
                        sortable: true,
                        footerFormatter: totalRoleFormatter,
                        align: 'center'
                    },
                       {
                        field: 'operate',
                        title: 'Item Operate',
                        align: 'center',
                        clickToSelect: false,
                        events: window.operateEvents,
                        formatter: operateFormatter
                    }]
                ]
            })
            $table.on('check.bs.table uncheck.bs.table ' +
                'check-all.bs.table uncheck-all.bs.table',
                function () {
                    $remove.prop('disabled', !$table.bootstrapTable('getSelections').length)

                    // save your data, here just save the current page
                    selections = getIdSelections()
                    // push or splice the selections if you want to save all data selections
                })
            $table.on('all.bs.table', function (e, name, args) {
                console.log(name, args)
            })

        }

        $(function () {
            initTable()

            $('#locale').change(initTable)
        })
    </script>

@endsection
