function format ( d ,name) {
    return '<strong>'+name.toUpperCase()+' Text:</strong><br><div class="detailtext">'+
        d.text + '</div>';
}
function removeDT(editor,DT) {
    editor
           .title( 'Delete record' )
        .message( "Are you sure you wish to delete this row?" )
        .buttons( { "label": "Delete", "fn": function () { editor.submit() } } )
        .remove( DT.closest('tr') );

}
function showDetailDT(dt,name,this$) {


    var tr = this$.closest('tr');

    var row_prev = dt.row(tr);
    var row = dt.row( tr );
    if(tr.hasClass('child')) {
        if (  tr.hasClass('details')){
            tr.removeClass('details');
            var ul = tr.find('ul');
            ul.find('.detail_li').remove();
        }else{

            tr.addClass('details');
            var row_prev = dt.row(tr.prev());
            var ul = tr.find('ul');
            ul.append("<li class='detail_li'>" + format(row_prev.data(), name) + "</li>");

        }

    }
    else {

        if (row.child.isShown()) {
            tr.removeClass('details');
            row.child.hide();
        }
        else {
            tr.addClass('details');

            console.log(row.child(format(row_prev.data(), name),'detail-row').show());
            console.log(row.child());
            console.log(row_prev.child());

            // Add to the 'open' array

        }
    }
}

var editor;
var reportEditor;
var usersEditor;
var usersEditorEdit;
var detailRows = [];
// use a global for the submit and return data rendering in the examples


$(function(){


    $('.warning').click(function () {
       $(this).fadeOut();
    });


    //editors
    editor = new $.fn.dataTable.Editor( {
            "ajax": "ajax/posts",
            "table": "#example",

            "fields": [  {
                "label": "Title:",
                "name": "title"
            },  {
                "label": "Text:",
                "type": "textarea",
                "name": "text"
            }
            ]
        } );

    usersEditor = new $.fn.dataTable.Editor( {
            "ajax": "ajax/users",
            "table": "#usersTable",

            "fields": [  {
                "label": "Email:",
                "name": "email"
            },  {
                "label": "Password:",
                "type": "password",
                "name": "password"
            }, {
                label: "Image:",
                name: "avatar",
                type: "upload",
                display: function ( file_id ) {
                    return '<img src="'+dtu.file( 'files', file_id ).web_path+'"/>';

                },
                clearText: "Clear",
                noImageText: 'No image'
            },
                {
                    label: "Role:",
                    name:  "role",
                    type:  "select",
                    options: [
                        { label: "Admin", value: "admin" },
                        { label: "Editor",value: "editor" },
                        { label: "User",  value: "user" }

                    ]
                }
            ]
        } );
    usersEditorEdit = new $.fn.dataTable.Editor( {
            "ajax": "ajax/users",
            "table": "#usersTable",

            "fields": [ {
                label: "Image:",
                name: "avatar",
                type: "upload",
                display: function ( file_id ) {
                    return '<img src="'+dtu.file( 'files', file_id ).web_path+'"/>';

                },
                clearText: "Clear",
                noImageText: 'No image'
            },
                {
                    label: "Role:",
                    name:  "role",
                    type:  "select",
                    options: [
                        { label: "Admin", value: "admin" },
                        { label: "Editor",value: "editor" },
                        { label: "User",  value: "user" }

                    ]
                }
            ]
        } );


    reportEditor = new $.fn.dataTable.Editor( {
        "ajax": "ajax/reports",
        "table": "#reportsTable"

    } );

    //CRUD
    //create new DT
    $('a.editor_create').on( 'click', function (e) {
        e.preventDefault();

        editor
            .title( 'Create new record' )
            .buttons( { "label": "Add", "fn": function () { editor.submit() } } )
            .create();
    } );

    // Edit record
    $('#example').on( 'click', 'a.editor_edit', function (e) {
        e.preventDefault();

        editor
            .title( 'Edit record' )
            .buttons( { "label": "Update", "fn": function () { editor.submit() } } )
            .edit( $(this).closest('tr') );
    } );
    // remove from DT
    $('#example').on( 'click', 'a.editor_remove', function (e) {
        e.preventDefault();
        removeDT(editor,$(this))
    });
    $('#reportsTable').on( 'click', 'a.editor_remove', function (e) {
        e.preventDefault();
        removeDT(reportEditor,$(this))
    });

    // show detail in DT
    $('#example').on( 'click', 'a.details-control', function (e) {
        e.preventDefault();
        showDetailDT(dt,'post',$(this))
    });
    $('#reportsTable').on( 'click', 'a.details-control', function (e) {
        e.preventDefault();
        showDetailDT(dtr,'email',$(this))
    });



    //Tables
    var dt = $('#example').DataTable( {
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        dom: "frtip",
        ajax: {
            url: "ajax/posts",
            type: "POST"
        },
        serverSide: true,
        columns: [

            { data: "title" },
            { data: "date",
              searchable: false},
            {
                data: "text",
                visible:false,
                searchable: false},

            {
                data: null,
                className: "center columnWrap",
                searchable: false,
                defaultContent: '<a href="" class="editor_edit btn btn-primary btn-sm tableEdit" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> ' +
                '<a href=""  role="button" class="editor_remove btn btn-danger btn-sm tableEdit"><i class="fa fa-times" aria-hidden="true"></i></a> ' +
                '<a href=""  role="button" class="details-control btn btn-success btn-sm tableEdit"><i class="fa fa-eye" aria-hidden="true"></i></a>'
            }

        ],
        select: true

    } );


    var dtr = $('#reportsTable').DataTable( {
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        dom: "frtip",
        ajax: {
            url: "ajax/reports",
            type: "POST"
        },
        serverSide: true,
        columns: [

            { data: "title" },
            {
                data: "text",
                visible:false,
                searchable: false},
            { data: "author" },
            { data: "date",
                searchable: false},

            {
                data: null,

                className: "center",

                searchable: false,
                defaultContent: '<a href=""  role="button" class="editor_remove btn btn-danger btn-sm tableEdit"><i class="fa fa-times" aria-hidden="true"></i></a> ' +
                '<a href=""  role="button" class="details-control btn btn-success btn-sm tableEdit"><i class="fa fa-eye" aria-hidden="true"></i></a>'
            }
        ],
        select: true

    } );


    var dtu = $('#usersTable').DataTable( {
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        dom: "Bfrtip",
        ajax: {
            url: "ajax/users",
            type: "POST"
        },
        serverSide: true,
        columns: [

            { data: "email" },
            {
            data: "avatar",
                render: function ( file_id ) {
                return file_id ?
                 '<img src="'+dtu.file( 'files', file_id ).web_path+'" class="table-img"/>':
                    null;
            },
                defaultContent: "No image",
                title: "Image"
            },
            {data: 'role'}

        ],



        select: true,
        buttons: [
            { extend: "create", editor: usersEditor },
            { extend: "edit",   editor: usersEditorEdit },
            { extend: "remove", editor: usersEditor }
        ]

    } );

});

