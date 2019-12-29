$(document).ready(function() {
	$('#tablaFuentesR').DataTable( {
		responsive: true,
		"searching": false,
		"pageLength": 5,
		language: {
	  "lengthMenu": "Mostrar _MENU_ registros",
	  "zeroRecords": "No se encontraron resultados",
	  "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	  "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
	  "infoFiltered": "(filtrado de un total de _MAX_ registros)",
	  "sSearch": "Buscar:",
	  "oPaginate": {
		  "sFirst": "Primero",
		  "sLast":"Último",
		  "sNext":"Siguiente",
		  "sPrevious": "Anterior"
	   },
	   "sProcessing":"Procesando...",
  },
//para usar los botones   

dom: 'Bfrtilp',       
buttons:[ 
	  {
	  extend:    'copyHtml5',
	  text:      '<i class="fa fa-clone"></i> ',
	  titleAttr: 'Copiar',
	  className: 'btn btn-primary'
  },
  {
	  extend:    'excelHtml5',
	  text:      '<i class="fa fa-file-excel-o"></i> ',
	  titleAttr: 'Exportar a Excel',
	  className: 'btn btn-success'
  },
  {
	  extend:    'pdfHtml5',
	  text:      '<i class="fa fa-file-pdf-o"></i> ',
	  titleAttr: 'Exportar a PDF',
	   message : 'Fuentes-SIEX',
	  className: 'btn btn-danger'
  },
  {
	  extend:    'print',
	  text:      '<i class="fa fa-print"></i> ',
	  titleAttr: 'Imprimir',
	  className: 'btn btn-info'
  },
]	        

	} );

	$('#tablaCDPs').DataTable( {
	   responsive: true,
		"searching": false,
		"pageLength": 5,
		language: {
	  "lengthMenu": "Mostrar _MENU_ registros",
	  "zeroRecords": "No se encontraron resultados",
	  "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	  "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
	  "infoFiltered": "(filtrado de un total de _MAX_ registros)",
	  "sSearch": "Buscar:",
	  "oPaginate": {
		  "sFirst": "Primero",
		  "sLast":"Último",
		  "sNext":"Siguiente",
		  "sPrevious": "Anterior"
	   },
	   "sProcessing":"Procesando...",
  },
//para usar los botones   

dom: 'Bfrtilp',       
buttons:[ 
	  {
	  extend:    'copyHtml5',
	  text:      '<i class="fa fa-clone"></i> ',
	  titleAttr: 'Copiar',
	  className: 'btn btn-primary'
  },
  {
	  extend:    'excelHtml5',
	  text:      '<i class="fa fa-file-excel-o"></i> ',
	  titleAttr: 'Exportar a Excel',
	  className: 'btn btn-success'
  },
  {
	  extend:    'pdfHtml5',
	  text:      '<i class="fa fa-file-pdf-o"></i> ',
	  titleAttr: 'Exportar a PDF',
	   message : 'Fuentes-SIEX',
	  className: 'btn btn-danger'
  },
  {
	  extend:    'print',
	  text:      '<i class="fa fa-print"></i> ',
	  titleAttr: 'Imprimir',
	  className: 'btn btn-info'
  },
]	        

	} );

	$('#tablaRegistros').DataTable( {
	 responsive: true,
		"searching": false,
		"pageLength": 5,
		language: {
	  "lengthMenu": "Mostrar _MENU_ registros",
	  "zeroRecords": "No se encontraron resultados",
	  "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	  "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
	  "infoFiltered": "(filtrado de un total de _MAX_ registros)",
	  "sSearch": "Buscar:",
	  "oPaginate": {
		  "sFirst": "Primero",
		  "sLast":"Último",
		  "sNext":"Siguiente",
		  "sPrevious": "Anterior"
	   },
	   "sProcessing":"Procesando...",
  },
//para usar los botones   

dom: 'Bfrtilp',       
buttons:[ 
	  {
	  extend:    'copyHtml5',
	  text:      '<i class="fa fa-clone"></i> ',
	  titleAttr: 'Copiar',
	  className: 'btn btn-primary'
  },
  {
	  extend:    'excelHtml5',
	  text:      '<i class="fa fa-file-excel-o"></i> ',
	  titleAttr: 'Exportar a Excel',
	  className: 'btn btn-success'
  },
  {
	  extend:    'pdfHtml5',
	  text:      '<i class="fa fa-file-pdf-o"></i> ',
	  titleAttr: 'Exportar a PDF',
	   message : 'Fuentes-SIEX',
	  className: 'btn btn-danger'
  },
  {
	  extend:    'print',
	  text:      '<i class="fa fa-print"></i> ',
	  titleAttr: 'Imprimir',
	  className: 'btn btn-info'
  },
]	        

	} );

	$('#tablaMovimientos').DataTable( {
	responsive: true,
		"searching": false,
		"pageLength": 5,
		language: {
	  "lengthMenu": "Mostrar _MENU_ registros",
	  "zeroRecords": "No se encontraron resultados",
	  "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	  "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
	  "infoFiltered": "(filtrado de un total de _MAX_ registros)",
	  "sSearch": "Buscar:",
	  "oPaginate": {
		  "sFirst": "Primero",
		  "sLast":"Último",
		  "sNext":"Siguiente",
		  "sPrevious": "Anterior"
	   },
	   "sProcessing":"Procesando...",
  },
//para usar los botones   

dom: 'Bfrtilp',       
buttons:[ 
	  {
	  extend:    'copyHtml5',
	  text:      '<i class="fa fa-clone"></i> ',
	  titleAttr: 'Copiar',
	  className: 'btn btn-primary'
  },
  {
	  extend:    'excelHtml5',
	  text:      '<i class="fa fa-file-excel-o"></i> ',
	  titleAttr: 'Exportar a Excel',
	  className: 'btn btn-success'
  },
  {
	  extend:    'pdfHtml5',
	  text:      '<i class="fa fa-file-pdf-o"></i> ',
	  titleAttr: 'Exportar a PDF',
	   message : 'Fuentes-SIEX',
	  className: 'btn btn-danger'
  },
  {
	  extend:    'print',
	  text:      '<i class="fa fa-print"></i> ',
	  titleAttr: 'Imprimir',
	  className: 'btn btn-info'
  },
]	        

	} );
} );
