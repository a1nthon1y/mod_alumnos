$(function(){
	$("#datatables-1").dataTable();
	$("#datatables-1-0").dataTable();
	$("#datatables-1-1").dataTable();
	$("#datatables-1-2").dataTable();
	$("#datatables-1-3").dataTable();
	$("#datatables-1-4").dataTable();
	$("#datatables-1-5").dataTable();
	$("#datatables-1-6").dataTable();
	$("#datatables-1-7").dataTable();
	$("#datatables-1-8").dataTable();
	$("#datatables-1-9").dataTable();
    $("#datatables-1-10").dataTable();
    $("#datatables-1-11").dataTable();

	var table = $('#datatables-2-1').DataTable();
	var table = $('#datatables-2-2').DataTable();
	var table = $('#datatables-2-3').DataTable();
 
    $("#datatables-2 tfoot th").each( function ( i ) {
        var select = $('<select class="form-control input-sm"><option value=""></option></select>')
            .appendTo( $(this).empty() )
            .on( 'change', function () {
                table.column( i )
                    .search( '^'+$(this).val()+'$', true, false )
                    .draw();
            } );
 
        table.column( i ).data().unique().sort().each( function ( d, j ) {
            select.append( '<option value="'+d+'">'+d+'</option>' )
        } );
    } );

    $('#datatables-3').dataTable( {
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            data = api.column( 4 ).data();
            total = data.length ?
                data.reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                } ) :
                0;
 
            // Total over this page
            data = api.column( 4, { page: 'current'} ).data();
            pageTotal = data.length ?
                data.reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                } ) :
                0;
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                '$'+pageTotal +' ( $'+ total +' total)'
            );
        }
    } );
    $('#datatables-4').DataTable( {
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "./assets/libs/jquery-datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
        }
    } );    
})