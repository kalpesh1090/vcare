var table = '';
$(document).ready(function () {
    table = $('#return_tbl').dataTable({
        oLanguage: {
            sProcessing: "<img src='" + base_url + "/assets/images/loading.gif'>"
        },
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "searching": false,
        "order": [[0, "DESC"]],
        dom: "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-4'l><'col-sm-4'i><'col-sm-4'p>>",
        "ajax": {
            url: base_url + '/getreturndata',
            type: "GET",
            data: function (d) {
                d.title = function () {
                    return $('#title').val();
                };

            },
        },
        "columns": [
            {"taregts": 0, "searchable": false, "orderable": false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {"taregts": 1,
                "render": function (data, type, row) {

                    //var result = new Date(row.created_date);
                    var result = row.id;
                    return result;
                }
            },
            {"taregts": 2,
                "render": function (data, type, row) {

                    var result = moment(row.created_at).format('D MMM YYYY');
                    return result;
                }
            },
            
           
            {"taregts": 3,
                "render": function (data, type, row) {

                    //var result = new Date(row.created_date);
                    var result = row.first_name+' '+row.last_name;
                    return result;
                }
            },
            
           
            {"taregts": 4,
                "render": function (data, type, row) {

                   var out = '<a href="javascript:;" class="btn btn-info btn-sm"><i class="icon-plus2"></i></a>';

                   return out;
                }
            },
            {"taregts": 5,
                "render": function (data, type, row) {
                    var out='';
                    if(row.current_status == '0'){
                        out = '<a href="javascript:;" class="btn btn-danger btn-sm">Pending</a>';    
                    }else if(row.current_status == '1'){
                        out = '<a href="javascript:;" class="btn btn-danger btn-sm">Test</a>';    
                    }
                    
                    return out;
                }
            },
            {"taregts": 6, "searchable": false, "orderable": false,
                "render": function (data, type, row) {
                    var id = row.id;
                    var out = '';
                    out += '<a title="Edit" href="' + base_url + '/Income-Tax-Return/' + id + '/edit" class="text-info "><i class="icon-pencil7"></i></a>&nbsp;';
                    out += '<a title="Delete" class="text-danger delete_btn" onclick="delete_record(' + id + ')" href="javascript:;"><i class="icon-trash"></i></a>';
                    out += '&nbsp;<a title="View" href="' + base_url + '/company/job/view/' + id + '" class="text-info "><i class="icon-zoomin3"></i></a>&nbsp;';

                    return out;
                }
            },

           
        ]
    });
    $('#search').on('click', function () {
        table.fnDraw();
    });
    change_status = function (id) { //now has global scope.
        bootbox.confirm({message: "Are you sure you want change status?",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success btn-sm'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger btn-sm'
                }
            },
            callback: function (result) {
                var token = $('[name="_token"]').val();
                if (result) { // if result set to true
                    $.ajax({
                        type: "post",
                        url: base_url + '/company/job/changestatus',
                        data: {
                            "_token": token,
                            "id": id
                        },
                        success: function (data) {
                            table.fnDraw();
                        }
                    }).done(function (data) {
                        bootbox.alert(data);
                        table.fnDraw();
                    }); //ajax ends
                }
            } // callback function ends

        }); // bootbox confirm ends
    }
    delete_record = function (id) { //now has global scope.
        bootbox.confirm({message: "Are you sure you want to Delete?",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success btn-sm'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger btn-sm'
                }
            },
            callback: function (result) {
                var token = $('[name="_token"]').val();
                if (result) { // if result set to true
                    $.ajax({
                        type: "post",
                        url: base_url + '/company/job/delete',
                        data: {
                            "_token": token,
                            "id": id
                        },
                        success: function (data) {
                            table.fnDraw();
                        }
                    }).done(function (data) {
                        bootbox.alert(data);
                        table.fnDraw();
                    }); //ajax ends
                }
            } // callback function ends

        }); // bootbox confirm ends
    }



    question = function (id) { //now has global scope.

        var token = $('[name="_token"]').val();
        $.ajax({
            type: "post",
            url: base_url + '/job/question',
            data: {
                "_token": token,
                "id": id
            },
            success: function (data) {
                $('#model').html(data);
            }
        })
    }

});
