/*!
  * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
  * Copyright 2013-2023 Start Bootstrap
  * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
  */
// 
let rechazados = [];
let razones = [];
let view = '';
let listado=[];

function renderTable(  ){
  console.log( "en reeder table" );
  //1- extraer nombres de columnas 
  
  let _cols = ['Opciones'];
  $.each(listado[0], function (_key, _val) {
    if( _key != "Mask" ){
      _cols.push(_key);
    }    
  });
  let _str = `<thead>`;
  _cols.forEach(_col => {
    _str += `<th> ${_col} </th>`;
  });
  _str += `</thead> <tbody>`;
  

  listado.forEach(_fila => {
    _str += `<tr>`;
    $.each(_fila, function (_key, _val) {
      if( _key == "Mask" ){
        let _botones = `<a href="javascript:void(0)" class="btn btn-outline-danger btn-sm" onclick="borrar('${_val}')"><i class="fas fa-trash"></i></a>
        <a href="javascript:void(0)" class="btn btn-outline-info btn-sm" onclick="editar('${_val}')"><i class="fas fa-pencil"></i></a>`;
         _str += `<td>${_botones}</td>`;
      }else{
        _str += `<td>${_val}</td>`;
      }

     
    });
    _str += `</tr>`;
  });
  _str += `</tbody>`;
  $("#myTable").html(_str);

  setTimeout(() => {

    $('#myTable').DataTable({
      pageLength: 50,
      ordering: true,
      dom: 'Bfrtip',
      buttons: [
        {
          extend: 'excel',
          text: 'Exportar a Excel ..',
          title: 'Registros',
          className: 'btn btn-info btn-sm'
        }
      ],
      
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
      }
    });

    
  }, 200);
  

}

function cargarRegistros(){
  $.ajax({
    url: 'listar_registros', // Ruta POST en tu backend
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    data: {},
    contentType: false,
    processData: false,
    success: function(_resp) {
      console.log("Listado:");
      let _res = JSON.parse(_resp);
      console.log( _res );
      listado = _res.data;
      setTimeout(() => {
        renderTable();
      }, 500);
    },
    error: function ( _error ) {
      console.error("Error al cargar el listado:");
      console.log( _error );
      bootbox.alert({
        message: "Error al cargar el listado.",
        centerVertical: true
      });
    }
  });

}//fin de cargar registros

window.addEventListener('DOMContentLoaded', event => {
  
  view =  window.location.pathname.split('/')[1];
  
  if( view == 'listar' ){
    cargarRegistros();    
  }
  // Toggle the side navigation
  const sidebarToggle = document.body.querySelector('#sidebarToggle');
  if (sidebarToggle) {
    
    sidebarToggle.addEventListener('click', event => {
      event.preventDefault();
      document.body.classList.toggle('sb-sidenav-toggled');
      localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
    });
  }

});


function cargarArchivo(){
  let valorSeleccionado = $('input[name="opcion"]:checked').val();
  
  if( valorSeleccionado == undefined ){
    bootbox.alert({
      message: "Debes seleccionar una opción de carga!",
      centerVertical: true      
    });
    return;
  }
  
  const inputFile = $('#fileSVG')[0];
  const archivo = inputFile.files[0];

  if (!archivo) {
    bootbox.alert({
      message: "Debes seleccionar un archivo para cargar!",
      centerVertical: true
    });
    return;
  }

  // Crear el FormData y agregar el archivo
  const _formData = new FormData();
  _formData.append('fileSVG', archivo,'registros.csv');
  _formData.append('opcion', valorSeleccionado);

  for (let pair of _formData.entries()) {
    console.log(pair[0]+ ', ' + pair[1]); 
  }

  console.log( "a cargar el archivo" );
  $("#frame_resultado").html('Cargando ...<br>');

  $.ajax({
    url: 'cargar_csv', // Ruta POST en tu backend
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    data: _formData,
    contentType: false,
    processData: false,
    success: function(_resp) {
      console.log("Respuesta del servidor:");
      let _res = JSON.parse(_resp);
      console.log( _res );
      rechazados = _res.data.rechazados;
      razones = _res.data.messages;

      if( _res.done ){
        bootbox.alert({
          message: _res.msg,
          centerVertical: true
        });
        
      }else{
        bootbox.alert({
          message: _res.msg,
          centerVertical: true
        });

      }

      $("#frame_resultado").append(_res.msg);
      if( rechazados.length > 0 ){
        $("#frame_resultado").append('<hr><h6>Se rechazaron estos registros</h6>');
        for ( let i = 0; i < rechazados.length; i++ ) {
          $("#frame_resultado").append(`Id: <b class="text-danger">${rechazados[i][0]}</b>: <i class="text-danger">${razones[i]}</i><br>`);
        }
      
      }
    },
    error: function ( _error ) {
      console.error("Error al cargar el archivo:");
      console.log( _error );
      bootbox.alert({
        message: "Error al cargar el archivo. Intenta nuevamente.",
        centerVertical: true
      });
    }
  });


}//fin de cargar archivo csv

function borrar( _cual ){
  console.log( "borrar registro "+_cual );
}

function editar( _cual ){
  console.log( "editar registro "+_cual );
}
