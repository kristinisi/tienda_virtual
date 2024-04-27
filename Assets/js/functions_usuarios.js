let tableUsuarios;

//al modmeto de cargar todo el html va a agregar los eventos que configuremos dentro de este script
document.addEventListener("DOMContentLoaded", function () {}, false);

//nos dirigimos al id de la tabla usuarios para la datatable y cargamos el json con .datatable
tableUsuarios = $("#tableUsuarios").dataTable({
  aProcessing: true,
  aServerSide: true,
  language: {
    url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
  },
  ajax: {
    url: " " + base_url + "/Usuarios/getUsuarios", //nos devuelve la dirección del controlador con el método
    dataSrc: "",
  },
  columns: [
    //colocamos las columnas que vamos a obtener
    { data: "idpersona" },
    { data: "nombre" },
    { data: "apellidos" },
    { data: "email_user" },
    { data: "telefono" },
    { data: "nombrerol" },
    { data: "status" },
    { data: "options" },
  ],
  resonsieve: "true",
  bDestroy: true,
  iDisplayLength: 1,
  order: [[0, "desc"]],
});

let formUsuario = document.querySelector("#formUsuario"); //hacemos referencia al formulario usuario
formUsuario.onsubmit = function (e) {
  e.preventDefault();

  let strIdentificacion = document.querySelector("#txtIdentificacion").value;
  let strNombre = document.querySelector("#txtNombre").value;
  let strApellido = document.querySelector("#txtApellido").value;
  let strEmail = document.querySelector("#txtEmail").value;
  let intTelefono = document.querySelector("#txtTelefono").value;
  let intTipousuario = document.querySelector("#listRolid").value;
  let strPassword = document.querySelector("#txtPassword").value;

  //si hay algún campo vacío hacemos que salte una alerta
  if (
    strIdentificacion == "" ||
    strApellido == "" ||
    strNombre == "" ||
    strEmail == "" ||
    intTelefono == "" ||
    intTipousuario == ""
  ) {
    swal("Atención", "Todos los campos son obligatorios.", "error");
    return false;
  }

  //Hacemos lo siguiente para asegurarnos que no se envían datos incorrectos, mal o incompletos a través de ajax
  let elementsValid = document.getElementsByClassName("valid"); //obtenemos todos los elemeentos con la clase valid
  for (let i = 0; i < elementsValid.length; i++) {
    //obtenemos todos los elementos valid y los recorremos
    if (elementsValid[i].classList.contains("is-invalid")) {
      //si contiene el elemento is-invalid
      swal("Atención", "Por favor verifique los campos en rojo.", "error"); //Nos va a mostrar una alerta
      return false;
    }
  }

  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = base_url + "/Usuarios/setUsuario"; //vamos al metodo del controlador
  let formData = new FormData(formUsuario);
  request.open("POST", ajaxUrl, true); //abrimos conexión para enviar datos por POST
  request.send(formData); //enviamos la información

  //validamos el resultado
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText); //convertimos a un objeto lo que estamos obteniendo en request.responseText
      if (objData.status) {
        //si se guardó el registro
        $("#modalFormUsuario").modal("hide"); //ocultamos el modal
        formUsuario.reset(); //reseteamos los cmpos del formulario
        swal("Usuarios", objData.msg, "success"); //mostramos la alerta de success
        tableUsuarios.api().ajax.reload(); //hacemos que los datos aparezcan en la datatable
      } else {
        swal("Error", objData.msg, "error"); //mostramos la alerta del error
      }
    }
  };
};

window.addEventListener(
  "load",
  function () {
    fntRolesUsuario();
    // fntViewUsuario();
    // fntEditUsuario();
    // fntDelUsuario();
  },
  false
);

//creamos una función que va a hacer la petición ajax
function fntRolesUsuario() {
  let ajaxUrl = base_url + "/Roles/getSelectRoles";
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajaxUrl, true);
  request.send();

  //obtenemos la respuesta
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#listRolid").innerHTML = request.responseText; //le colocamos en el select los options
      document.querySelector("#listRolid").value = 1; //nos dirijimos al select poniendo el primer option
      $("#lisrRolid").selectpicker("render"); //actualizamos el select para que se muestren los registros
    }
  };
}

//Función que muestra la vista de un usuario
function fntViewUsuario(idusuario) {
  let idpersona = idusuario;
  //verificamos en que navegador estamos para crear el objeto
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  //le damos la ruta del controlador con el método y con el id para enviar la informacion de esa persona
  let ajaxUrl = base_url + "/Usuarios/getUsuario/" + idpersona;
  request.open("GET", ajaxUrl, true); //abrimos para hacer una petición get
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText); //convertimos a un objeto el formato json

      if (objData.status) {
        //cambiamos la forma en la que vemos el staus para que no se vea un número y si una etiqueta
        let estadoUsuario =
          objData.data.status == 1
            ? '<span class="badge badge-success">Activo</span>'
            : '<span class="badge badge-danger">Inactivo</span>';

        //introducimos el resto de datos en cada texto del id del modal con la información del usuario
        document.querySelector("#celIdentificacion").innerHTML =
          objData.data.identificacion;
        document.querySelector("#celNombre").innerHTML = objData.data.nombre;
        document.querySelector("#celApellido").innerHTML =
          objData.data.apellidos;
        document.querySelector("#celTelefono").innerHTML =
          objData.data.telefono;
        document.querySelector("#celEmail").innerHTML = objData.data.email_user;
        document.querySelector("#celTipoUsuario").innerHTML =
          objData.data.nombrerol;
        document.querySelector("#celEstado").innerHTML = estadoUsuario;
        document.querySelector("#celFechaRegistro").innerHTML =
          objData.data.fechaRegistro;
        $("#modalViewUser").modal("show"); //id con jquery pq el bootstrap trabaja con jquery y mostramos el modal
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };
}

//Función que muestra la vista edición de un usuario
function fntEditUsuario(idusuario) {
  //Editamos el modal
  document.querySelector("#titleModal").innerHTML = "Actualizar Usuario";
  document
    .querySelector(".modal-header")
    .classList.replace("headerRegister", "headerUpdate");
  document.querySelector("#btnText").innerHTML = "Actualizar";

  let idpersona = idusuario; // guardamos el id del atributo donde estamos haciendo click
  //verificamos en que navegador estamos para crear el objeto
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  //le damos la ruta del controlador con el método y con el id para enviar la informacion de esa persona
  let ajaxUrl = base_url + "/Usuarios/getUsuario/" + idpersona;
  request.open("GET", ajaxUrl, true); //abrimos para hacer una petición get
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);

      if (objData.status) {
        document.querySelector("#idUsuario").value = objData.data.idpersona;
        document.querySelector("#txtIdentificacion").value =
          objData.data.identificacion;
        document.querySelector("#txtNombre").value = objData.data.nombre;
        document.querySelector("#txtApellido").value = objData.data.apellidos;
        document.querySelector("#txtTelefono").value = objData.data.telefono;
        document.querySelector("#txtEmail").value = objData.data.email_user;
        document.querySelector("#listRolid").value = objData.data.idrol;
        $("#listRolid").selectpicker("render"); // coolocamos esto para que renderice los options y muestre cual tiene el ususario

        //colocamos los valores del status
        if (objData.data.status == 1) {
          document.querySelector("#listStatus").value = 1;
        } else {
          document.querySelector("#listStatus").value = 2;
        }
        $("#listStatus").selectpicker("render"); //actualizamos el select
      }
    }

    $("#modalFormUsuario").modal("show");
  };
}

function openModal() {
  document.querySelector("#idUsuario").value = ""; //limpiamos el id para que no haya complicaciones
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister"); //reemplazamos la clase
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary"); //reemplazamos el botón
  document.querySelector("#btnText").innerHTML = "Guardar"; //Cambiamos el span
  document.querySelector("#titleModal").innerHTML = "Nuevo Usuario"; //Cambiamos el título
  document.querySelector("#formUsuario").reset(); //reseteamos el formulario

  $("#modalFormUsuario").modal("show");
}

//funcion que dota de funcionalidad el boton eliminar
function fntDelUsuario(idpersona) {
  let idUsuario = idpersona; //obtenemos el valor del atributo que es el id del usuario

  swal(
    {
      title: "Eliminar Usuario",
      text: "¿Realmente quiere eliminar el Usuario?",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "Si, eliminar!",
      cancelButtonText: "No, cancelar!",
      closeOnConfirm: false,
      closeOnCancel: true,
    },
    function (isConfirm) {
      //script para poder eliminar el rol
      if (isConfirm) {
        let request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP"); //validamos el navegador en el que estamos
        let ajaxUrl = base_url + "/Usuarios/delUsuario/";
        var strData = "idUsuario=" + idUsuario;
        request.open("POST", ajaxUrl, true);
        request.setRequestHeader(
          "Content-Type",
          "application/x-www-form-urlencoded"
        ); //enviamos la peticion
        request.send(strData); //enviamos la peticion
        request.onreadystatechange = function () {
          if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText); //convertimos a un objeto el formato json
            if (objData.status) {
              swal("Eliminar!", objData.msg, "success");
              tableUsuarios.api().ajax.reload(); //hacemos que los datos aparezcan en la datatable
              fntRolesUsuario();
              fntViewUsuario();
              fntEditUsuario();
              fntDelUsuario();
            } else {
              swal("Atención!", objData.msg, "error");
            }
          }
        };
      }
    }
  );
}
