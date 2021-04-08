@extends('admin.admin-layout')
@section('title','Posts')
@section('content')
    <main class="mt-5">
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    DataTable Example
                </div>

                <div class="card-body">


                    <div id="toolbar">
                        <button id="remove" class="btn btn-success">
                            <i class="fa fa-plus"></i> Add
                        </button>
                    </div>
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
                        data-url="{{route('get-posts')}}"
                        data-buttons="buttons"
                        data-response-handler="responseHandler">

                    </table>


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
                        <input type="hidden" class="setnull" name="id" id="postId">
                        <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control setnull" name="name" placeholder="Name" id="name">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="title">Title</label>
                            <input type="text" class="form-control setnull" name="title" placeholder="Title" id="title">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control setnull" placeholder="slug" required name="slug"
                                   id="slug">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="keyword">Keyword</label>
                            <input type="text" class="form-control setnull" name="keyword" placeholder="Keyword"
                                   id="keyword">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="file">File</label>
                            <input type="text" class="form-control setnull" name="file" placeholder="File" id="file">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" placeholder="Description"
                                      id="description"></textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="content">Content</label>
                            <textarea class="form-control" name="content" placeholder="Text" id="content"></textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="item_id">Item</label>
                            <select class="form-control setnull" name="item_id" required id="item_id">
                                <option disabled selected>Select</option>
                                @foreach($items as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach


                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="topic_id">Topic</label>
                            <select class="form-control setnull" name="topic_id" required id="topic_id">
                                <option disabled selected>Select</option>
                                @foreach($topics as $topic)
                                    <option value="{{$topic->id}}">{{$topic->name}}</option>
                                @endforeach


                            </select>
                        </div>

                        {{--                        <div class="form-group col-md-6">--}}
                        {{--                            <label for="file_type">File Type</label>--}}
                        {{--                            <select class="form-control setnull" name="file_type" id="file_type">--}}
                        {{--                                <option value="pdf">Pdf</option>--}}
                        {{--                                <option value="xls">Xls</option>--}}
                        {{--                                <option value="img">Img</option>--}}
                        {{--                            </select>--}}
                        {{--                        </div>--}}

                        {{--                        <div class="form-group col-md-4">--}}
                        {{--                            <label for="type">Type</label>--}}
                        {{--                            <select class="form-control setnull" name="type" id="type">--}}
                        {{--                                <option value="published">Publish</option>--}}
                        {{--                                <option value="unlisted">Unlist</option>--}}
                        {{--                            </select>--}}
                        {{--                        </div>--}}

                        {{--                        <div class="form-group col-md-4">--}}
                        {{--                            <label for="ordering">Ordering number</label>--}}
                        {{--                            <input type="number" class="form-control setnull" name="ordering" placeholder="Ordering" id="ordering">--}}
                        {{--                        </div>--}}

                        <div class="form-group col-md-3">
                            <label>Status</label><br>
                            <label for="statusEnable">Enable</label>
                            <input id="statusEnable" name="status" value="1" type="radio">
                            <label for="statusDisable">Disable</label>
                            <input id="statusDisable" name="status" value="0" type="radio">
                        </div>


                    </form>
                    <div class="text-right">
                        <button onclick="addNewLinkInput()" class="btn btn-success">
                            <i class="fas fa-plus"></i> Add Link
                        </button>
                    </div>
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
                '<a href="javascript:void(0)" class="edit mr-2" data-toggle="modal" data-target="#editorModal">',
                '<i class="fa fa-cog"></i>',
                '</a>',
                '<a class="remove" href="javascript:void(0)" title="Remove">',
                '<i class="fa fa-trash"></i>',
                '</a>'
            ].join('')
        }

        window.operateEvents = {
            'click .edit': function (e, value, post, index) {
                $('#postId').val(post.id)
                $('#name').val(post.name)
                $('#title').val(post.title)
                $('#keyword').val(post.keyword)
                $('#file').val(post.file)
                $('#slug').val(post.slug)
                $('#description').text(post.description)
                $('#content').text(post.content)
                $("#item_id option[value='" + post.item_id + "']").prop('selected', true)
                $("#topic_id option[value='" + post.topic_id + "']").prop('selected', true)
                $("input[name='status'][value='" + post.status + "']").prop('checked', true);


            },
            'click .remove': function (e, value, row, index) {
                $.ajax('{{route('post.delete')}}', {
                    method: 'post',
                    data: {
                        _token: '{{csrf_token()}}',
                        data: JSON.stringify($table.bootstrapTable('getSelections'))
                    },
                    success: function (data,status,xhr) {   // success callback function
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
            $.ajax('{{route('post.store')}}', {
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

        function totalPriceFormatter(data) {
            var field = this.field
            return '$' + data.map(function (row) {
                return +row[field].substring(1)
            }).reduce(function (sum, i) {
                return sum + i
            }, 0)
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
                        rowspan: 2,
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
                    }, {
                        field: 'description',
                        title: 'Item Description',
                        sortable: true,
                        align: 'center',
                        footerFormatter: totalPriceFormatter
                    }, {
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
