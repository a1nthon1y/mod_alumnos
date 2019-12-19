$(document).ready(function() {
  
  $("#botonID").click(function(){
    $("#tarjetaDiv").hide(200);
    $.post('readingCard.php', {message: $(this).val()}, function(response){
      $("#tarjetaDiv").html(response).show(200);
    });
  });
  
    $('#per_cargo').change(function(){
      if($('#per_cargo').val() != '7'){
        $('#divPersonalHorario').show();
      } else{
        $('#divPersonalHorario').hide();
      }
    });
    
    $('#tbodyRelacion').on('click', '#rel_button', function(){
      var num = $(this).attr('name').substr(10);
      $(this).hide();
      $("select[name='rel_curso"+num+"']").show();
      $("select[name='rel_curso"+num+"']").attr('required', true);
    });
    
    $('#tbodyRelacion').on('change', '#rel_curso', function(){
      var num = $(this).attr('name').substr(9);
      if($(this).val() != ''){
        $('#rel_materia'+num).show();
        $('#rel_materia'+num).attr('required', true);
      } else{
        $(this).hide();
        $("select[name='rel_curso"+num+"']").attr('required', false);
        $("a[name='rel_button"+num+"']").show();
        $('#rel_materia'+num).hide();
        $('#rel_materia'+num).attr('required', false);
      }
    });
    
    $('select[name=rel_cedula]').on('change', function(){
      var rel_cedula = $('select[name=rel_cedula] option:selected').val();
      $.post('consultarDocenteRelacion.php', {action: 'registro', rel_cedula: rel_cedula}, function(respuesta){
        $('#rel_horarioTable').html(respuesta);
      });
    });
    
    $('input[name=rel_cedula2]').on('keyup', function(){
      var rel_cedula = $('select[name=rel_cedula] option:selected').val();
      $.post('consultarDocenteRelacion.php', {action: 'registro', rel_cedula: rel_cedula}, function(respuesta){
        $('#rel_horarioTable').html(respuesta);
      });
    });
    
    $('#gradosModificar0').click(function(){
      alert('entro');
      $('#gradosNombre0').attr('readonly', false);
      $('#gradosSeccion0').attr('readonly', false);
    });
    
    /*$('#btn-agregarCargo').click(function(){
        var fila = "<td><input class='form-control' type='text' name='descripcionCargo"+fila+"' placeholder='Director/Jefe de seccional/...' required/></td>";
        $('#bodyCargo').append(fila);
        
    });*/
    
    
    $('#tbodyAsistencia').on('click', '#horario', function(){
      var materia = $(this).$('#materiaAsistencia').val();
      var curso = $('#cursoAsistencia').val();
      $('#divTabla').hide();
      $("#asistenciaPanel").show();
      $("#headAsistencia").html('Materia: '+materia+' Curso: '+curso);
    });
    
    $('#btn-volverAsistencia').click(function(){
       $("#asistenciaPanel").hide();
       $('#divTabla').show();
      
    });
    
    var myVar = null;
    $('#btn-asistencia').click(function(){
      if($('#btn-asistencia').attr('class') == 'btn btn-success'){
        $('#btn-asistencia').attr('class', 'btn btn-danger');
        $('#btn-asistencia').attr('value', 'off');
        $('#mensajeBtnAsitencia').text('Apagado');
        clearInterval(myVar);
        myVar = null;
        $.post('readingCard3.php', {message: $(this).val()}, function(response){
          //$('#origenEstudiante').append('<option>'+"LISTO EL POLLO"+'</option>');
        });
      }else{
        $('#btn-asistencia').attr('class', 'btn btn-success');
        $('#btn-asistencia').attr('value', 'on');
        $('#mensajeBtnAsitencia').text('Leyendo . . . ');
        myVar = setInterval(function(){ myTimer() }, 10000);
        /*$.post('readingCard2.php', {message: $(this).val()}, function(response){
          $('#origenEstudiante').append('<option id="idArduino">'+response+'</option>');
        });*/  

        /*$.ajax({
          type: 'POST',
          url: 'readingCard2.php',
          data: {message: $(this).val()},
          success: function(response) {
            $('#origenEstudiante').append('<option id="idArduino">'+response+'</option>');
          },
          async:false
        });*/
      }
    });

    function myTimer(){
      console.log("Nojoda");
      $.post('readingCard2.php', {message: 'on', curso: $('#curso').val()}, function(response){
        if(response != ''){
          console.log(response);
          lista = JSON.parse(response);
          $('#origenEstudiante option[value='+lista.cedula+']').remove();
          $('#destinoEstudiante').append('<option value="'+lista.cedula+'">'+lista.cedula+' - '+lista.nombre+'</option>');
        }
        else $('#origenEstudiante').append("MARDICION");
      });
    }
    
    
    $('#per_nombre1').click(function() {
        $(this).attr('readonly', false);
    });
    $('#per_nombre2').click(function() {
        $(this).attr('readonly', false);
    });
    $('#per_apellido1').click(function() {
        $(this).attr('readonly', false);
    });
    $('#per_apellido2').click(function() {
        $(this).attr('readonly', false);
    });
    $('#per_email').click(function() {
        $(this).attr('readonly', false);
    });
    $('#per_telefono').click(function() {
        $(this).attr('readonly', false);
    });
    $('#per_direccion').click(function() {
        $(this).attr('readonly', false);
    });

    $('#cancelarModUsuario').click(function() {
      $('#usuarioTableDiv').show();
      $('#modUsuarioDiv').hide();
    });
    
    $('#cancelarModHorarioP').click(function() {
      $('#horarioPTableDiv').show();
      $('#modHorarioPDiv').hide();
    });
    
    $('#cancelarModGrado').click(function() {
      $('#gradoTableDiv').show();
      $('#modGradoDiv').hide();
    });
    
    $('#cancelarModMateria').click(function() {
      $('#materiaTableDiv').show();
      $('#modMateriaDiv').hide();
    });
    
    $('#cancelarModEstudiante').click(function() {
      $('#modEstudianteDiv').hide();
      $("#curso option[selected]").removeAttr("selected");
      $('#estudianteTableDiv').show();
    });
    
    $('#cancelarModEstudianteStatus').click(function() {
      $('#modEstudianteStatusDiv').hide();
      $('#estudianteTableDiv').show();
    });
    
    $('#cancelarModCargo').click(function() {
      $('#modCargoDiv').hide();
      $('#cargoTableDiv').show();
    });
    
    $('#cancelarModPersonal').click(function() {
      $('#modPersonalDiv').hide();
      $("#per_cargo option[selected]").removeAttr("selected");
      $('#personalTableDiv').show();
    });
    
    $('#cancelarModPersonalStatus').click(function() {
      $('#modPersonalStatusDiv').hide();
      $('#personalTableDiv').show();
    });
});

function agregarFilaCargos(tabla){
    var fila = document.getElementById(tabla).rows.length;
	if(document.getElementById(tabla)){
		document.getElementById(tabla).insertRow(fila).innerHTML =
		"<td><input class='form-control' type='text' name='descripcionCargo"+fila+"' placeholder='Director/Jefe de seccional/...' required/></td>";
	}
}


function borrarUltimaFila(tabla){
    var index=document.getElementById(tabla).rows.length;
    if(index>2){
        document.getElementById(tabla).deleteRow(index-1);
    }
    if(tabla == 'tablaGrado'){
        $('#btn+grado').removeAttr("disabled")
    }
}

function agregarFilaGrado(tabla){
    var fila=document.getElementById(tabla).rows.length;
    var placeholder = ["Septimo grado", "Octavo grado",
                "Noveno grado", "Primero de Diversificado", 
                "Segundo de Diversificado", "Tercero de Diversificado"];
    if(document.getElementById(tabla)){
        if(fila<=6){
          document.getElementById(tabla).insertRow(fila).innerHTML = 
        "<tr name='grado-"+fila+"'>"+
          "<td>"+
            "<input type='text' class='form-control' name='grado"+fila+"' value='"+placeholder[fila-1]+"' readonly required>"+
          "</td>"+
          "<td>"+
              "<input type='number' class='form-control' name='gradoSeccion"+fila+"' min='1' max='7' placeholder='1' required>"+
          "</td>"+
        "</tr>";
        }
    }
}

function agregarFilaMaterias(tabla){
  var fila = document.getElementById(tabla).rows.length;
	if(document.getElementById(tabla)){
		document.getElementById(tabla).insertRow(fila).innerHTML =
		"<td><input class='form-control' type='text' name='codigo"+fila+"' placeholder='Código de la materia' required/></td>"+
		"<td><input class='form-control' type='text' name='materia"+fila+"' placeholder='Nombre de la materia...' required/><\/td><\/tr>";
	}
}

function agregarFilaHoras(tabla){
    var fila = document.getElementById(tabla).rows.length;
	if(document.getElementById(tabla)){
		document.getElementById(tabla).insertRow(fila).innerHTML =
		'<td><select class="form-control" name="dia'+fila+'" required>'+
            '<option value="Todos">Todos</option>'+
            '<option value="Lunes">Lunes</option>'+
            '<option value="Martes">Martes</option>'+
            '<option value="Miercoles">Miercoles</option>'+
            '<option value="Jueves">Jueves</option>'+
            '<option value="Viernes">Viernes</option>'+
          '</select></td>'+
        "<td><input class='form-control' type='time' name='horaInicial"+fila+"' min='7:00' max='18:00' step='60' required/></td>"+
        "<td><input class='form-control' type='time' name='horaFinal"+fila+"' min='7:00' max='18:00' step='60' required/></td></tr>";
	}
}

function pasar(origen, destino){                    //Para pasar de un select a otro
    var obj1 = document.getElementById(origen);       //toma el id del select origen
    var obj2 = document.getElementById(destino);      // toma el id del select destino
    if(obj1.selectedIndex == -1) return;              //verifica que se haya seleccionado algo
    var valor = obj1.value;                           //toma el valor=id de mysql del elemento seleccionado
    var txt = obj1.options[obj1.selectedIndex].text;  //tomal el texto
    obj1.options[obj1.selectedIndex] = null;          //lo pone nullo en el selec origen
    var opc = new Option(txt, valor);                 //crea una nueva opc <option>
    opc.defaultSelected = true;
    eval(obj2.options[obj2.options.length] = opc);    // lo pone en el selec destino
  }
  
  function agregarFilaCurso(tabla){
    var curso=document.getElementById(tabla).rows.length;
    
  	if(document.getElementById(tabla)){
	    if(curso<=6){
  	    document.getElementById(tabla).insertRow(curso).innerHTML = 
        "<tr>"+
          "<td>"+
            "<div>"+
              "<br/><select class='form-control' name='grado"+curso+"' style='width:100%' required>"+
                    "<?php consultarGrados1(); ?>"+
                  "</select>"+
              "</div>"+
            "</div>"+
          "</td>"+
          "<td>"+
            "<div>"+
              "<select class='form-control' id='destinoMateria"+curso+"' name='destinoMateria"+curso+"[]' multiple >"+
              "</select>"+
            "</div>"+
          "</td>"+
          "<td>"+
           "<br/>"+
            "<div class='btn-group-vertical'>"+
              "<button type='button' id='izqDer"+curso+"' class='btn btn-info btn-sm' onclick='pasar(&#39origenMateria"+curso+"&#39, &#39destinoMateria"+curso+"&#39);'><span class='glyphicon glyphicon-arrow-left'></span></button>"+
              "<button type='button' id='derIzq"+curso+"' class='btn btn-info btn-sm' onclick='pasar(&#39destinoMateria"+curso+"&#39, &#39origenMateria"+curso+"&#39);'><span class='glyphicon glyphicon-arrow-right'></span></button>"+
            "</div>"+
          "</td>"+
          "<td>"+
            "<div>"+
              "<select class='form-control' id='origenMateria"+curso+"' name='origenMateria"+curso+"[]' multiple>"+
                "<?php consultarMateria(); ?>"+
              "</select>"+
            "</div>"+
          "</td>"+
        "</tr>";
  	  }
	  }
  }
  
  function modifyUser(cedula, nombre, nivel){
    if(nivel == 1){
        $("#usu_nivel").find("option[value='1']").attr("selected", true);
        $("#usu_nivel").find("option[value='2']").attr("selected", false);
        $("#usu_nivel").find("option[value='3']").attr("selected", false);
    } else if(nivel == 2){
        $("#usu_nivel").find("option[value='1']").attr("selected", false);
        $("#usu_nivel").find("option[value='2']").attr("selected", true);
        $("#usu_nivel").find("option[value='3']").attr("selected", false);
    } else{
        $("#usu_nivel").find("option[value='1']").attr("selected", false);
        $("#usu_nivel").find("option[value='2']").attr("selected", false);
        $("#usu_nivel").find("option[value='3']").attr("selected", true);
    }
    $('#usuarioTableDiv').hide();
    $('#usu_nombre').text(nombre);
    $('#usu_cedula').attr('value', cedula);
    
    $('#modUsuarioDiv').show();
     
  }
  
  function modifyHorarioP(id, inicio, fin, dia){
    switch (dia) {
      case 'Lunes':
        $("#diaHorarioP").find("option[value='Lunes']").attr("selected", true);
        $("#diaHorarioP").find("option[value='Martes']").attr("selected", false);
        $("#diaHorarioP").find("option[value='Miércoles']").attr("selected", false);
        $("#diaHorarioP").find("option[value='Jueves']").attr("selected", false);
        $("#diaHorarioP").find("option[value='Viernes']").attr("selected", false);
        break;
      
      case 'Martes':
        $("#diaHorarioP").find("option[value='Lunes']").attr("selected", false);
        $("#diaHorarioP").find("option[value='Martes']").attr("selected", true);
        $("#diaHorarioP").find("option[value='Miércoles']").attr("selected", false);
        $("#diaHorarioP").find("option[value='Jueves']").attr("selected", false);
        $("#diaHorarioP").find("option[value='Viernes']").attr("selected", false);
        break;
      
      case 'Miércoles':
        $("#diaHorarioP").find("option[value='Lunes']").attr("selected", false);
        $("#diaHorarioP").find("option[value='Martes']").attr("selected", false);
        $("#diaHorarioP").find("option[value='Miércoles']").attr("selected", true);
        $("#diaHorarioP").find("option[value='Jueves']").attr("selected", false);
        $("#diaHorarioP").find("option[value='Viernes']").attr("selected", false);
        break;
      
      case 'Jueves':
        $("#diaHorarioP").find("option[value='Lunes']").attr("selected", false);
        $("#diaHorarioP").find("option[value='Martes']").attr("selected", false);
        $("#diaHorarioP").find("option[value='Miércoles']").attr("selected", false);
        $("#diaHorarioP").find("option[value='Jueves']").attr("selected", true);
        $("#diaHorarioP").find("option[value='Viernes']").attr("selected", false);
        break;
      
      case 'Viernes':
        $("#diaHorarioP").find("option[value='Lunes']").attr("selected", false);
        $("#diaHorarioP").find("option[value='Martes']").attr("selected", false);
        $("#diaHorarioP").find("option[value='Miércoles']").attr("selected", false);
        $("#diaHorarioP").find("option[value='Jueves']").attr("selected", false);
        $("#diaHorarioP").find("option[value='Viernes']").attr("selected", true);
        break;
        
    }
    $('#horarioPTableDiv').hide();
    $('#inicioHorarioP').attr('value', inicio);
    $('#finHorarioP').attr('value', fin);
    $('#idHorarioP').attr('value', id);
    $('#modHorarioPDiv').show();
     
  }
  
  function modifyGrado(id, grado, seccion){
    $('#gradoTableDiv').hide();
    $('#grado').attr('value', grado);
    $('#seccion').attr('value', seccion);
    $('#idCurso').attr('value', id);
    $('#modGradoDiv').show();
     
  }
  
  function modifyMateria(id, nombre){
    $('#materiaTableDiv').hide();
    $('#idMateria').attr('value', id);
    $('#idMateria1').attr('value', id);
    $('#nombre').attr('value', nombre);
    $('#modMateriaDiv').show();
     
  }
  
  function modifyEstudiante(cedula, tarjeta, nombre1, nombre2, apellido1, apellido2, correo, telefono, estado, curso){
    $('#estudianteTableDiv').hide();
    $('#cedula').attr('value', cedula);
    $('#nombre1').attr('value', nombre1);
    $('#nombre2').attr('value', nombre2);
    $('#apellido1').attr('value', apellido1);
    $('#apellido2').attr('value', apellido2);
    $('#email').attr('value', correo);
    $('#telefono').attr('value', telefono);
    $('#tarjeta').attr('value', tarjeta);
    $("#curso option[selected]").removeAttr("selected");
    $("#curso").find("option[value='"+curso+"']").attr("selected", true);
    
    if(cedula.search('E') != (-1)) var foto = "fotos/" + cedula.replace('E', '') + ".";
    else var foto = "fotos/" + cedula.replace('V', '') + ".";
    
        if(foto + "jpg") foto = foto + "jpg";
        else if(foto + "png") foto = foto + "png";
        else if(foto + "jpeg") foto = foto + "jpeg";
        else foto = "imagenes/default_avatar_male.jpg";
        $('#divPreviewimg').html("<img src="+foto+" alt='Foto de perfil' id='preview' width='300' height='300'>");

    $('#modEstudianteDiv').show();
     
  }
  
  function modifyEstudianteStatus(cedula, estado, estadoN){
    $('#estudianteTableDiv').hide();
    $('#statusActual').text(estadoN);
    if(estadoN == 'Activo') estadoN = 'Desactivar';
    else estadoN = 'Activar';
    $('#modEstudianteStatus').text(estadoN);
    $('#statusCedula').attr('value', cedula);
    $('#statusAct').attr('value', estado);
    $('#modEstudianteStatusDiv').show();
  }
  
  function modifyCargo(id, cargo){
    $('#cargoTableDiv').hide();
    $('#idCargo').attr('value', id);
    $('#cargo').attr('value', cargo);
    $('#modCargoDiv').show();
     
  }
  
  function modifyPersonal(cedula, tarjeta, nombre1, nombre2, apellido1, apellido2, correo, telefono, direccion, estado, cargoid){
    $('#personalTableDiv').hide();
    $('#per_cedula').attr('value', cedula);
    $('#per_nombre1').attr('value', nombre1);
    $('#per_nombre2').attr('value', nombre2);
    $('#per_apellido1').attr('value', apellido1);
    $('#per_apellido2').attr('value', apellido2);
    $('#per_email').attr('value', correo);
    $('#per_telefono').attr('value', telefono);
    $('#per_direccion').attr('value', direccion);
    $('#per_tarjeta').attr('value', tarjeta);
    $("#per_cargo option[selected]").removeAttr("selected");
    $("#per_cargo").find("option[value='"+cargoid+"']").attr("selected", true);
    
    /*if(cedula.search('E') != (-1)) var foto = "fotos/" + cedula.replace('E', '') + ".";
    else var foto = "fotos/" + cedula.replace('V', '') + ".";
    
        if(foto + "jpg") foto = foto + "jpg";
        else if(foto + "png") foto = foto + "png";
        else if(foto + "jpeg") foto = foto + "jpeg";
        else foto = "imagenes/default_avatar_male.jpg";
        $('#divPreviewimg').html("<img src="+foto+" alt='Foto de perfil' id='preview' width='300' height='300'>");*/

    $('#modPersonalDiv').show();
     
  }
  
  function modifyPersonalStatus(cedula, estado, estadoN){
    $('#personalTableDiv').hide();
    $('#statusActual').text(estadoN);
    if(estadoN == 'Activo') estadoN = 'Desactivar';
    else estadoN = 'Activar';
    $('#modPersonalStatus').text(estadoN);
    $('#statusCedula').attr('value', cedula);
    $('#statusAct').attr('value', estado);
    $('#modPersonalStatusDiv').show();
  }
  
  