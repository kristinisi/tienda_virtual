let tableRoles;
let divLoading = document.querySelector("#divLoading");
//añadimos un evento para que se cargue cuando se cargue el html
document.addEventListener("DOMContentLoaded", function () {
  tableRoles = $("#tableRoles").dataTable({
    //estamos haciendo referencia a la tabla de roles (por su id)
    aProcesing: true,
    aServerSide: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json", //formato jason que corresponde al idioma
    },
    ajax: {
      url: " " + base_url + "/Roles/getRoles", //obtenemos la ruta en la cual nos extrae el array a formato JSON
      dataSrc: "",
    },
    columns: [
      { data: "idrol" },
      { data: "nombrerol" },
      { data: "descripcion" },
      { data: "status" },
      { data: "options" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10, //es el numero de registros que se quiere mostrar
    order: [[0, "desc"]],
  });

  // NUEVO ROL
  let formRol = document.querySelector("#formRol");
  formRol.onsubmit = function (e) {
    e.preventDefault();

    let intIdRol = document.querySelector("#idRol").value;
    let strNombre = document.querySelector("#txtNombre").value;
    let strDescripcion = document.querySelector("#txtDescripcion").value;
    let intStatus = document.querySelector("#listStatus").value;

    if (strNombre === "" || strDescripcion === "" || intStatus === "") {
      swal("Atención", "Todos los campos son obligatorios.", "error"); // alerta con diseño
      return false;
    }
    divLoading.style.display = "flex";
    // detectamos si estamos en un navegador chrome o explorer y crea un xmlhttp según el navegador
    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    let ajaxUrl = base_url + "/Roles/setRol"; //recoje la url
    let formData = new FormData(formRol); // Cambiado formElement por formRol
    // se hace el envío de datos por medio de ajax
    request.open("POST", ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        //obtenemos el formato json para convertirlo a un objeto en javascript y mostrar mensajes
        let objData = JSON.parse(request.responseText);

        if (objData.status) {
          //si el objeto objData tiene un status
          $("#modalFormRol").modal("hide"); //cerramos el modal
          formRol.reset(); //limpiamos campos del formulario
          swal("Roles de usuario", objData.msg, "success"); //mostramos el mensaje
          tableRoles.api().ajax.reload(); //refrescamos la  datetable
        } else {
          swal("Error", objData.msg, "error"); //si no tiene statur muestra un mensaje de error
        }
      }
      divLoading.style.display = "none";
      return false;
    };
  };
});

$("#tableRoles").DataTable();

function openModal() {
  document.querySelector("#idRol").value = ""; //limpiamos el id para que no haya complicaciones
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister"); //reemplazamos la clase
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary"); //reemplazamos el botón
  document.querySelector("#btnText").innerHTML = "Guardar"; //Cambiamos el span
  document.querySelector("#titleModal").innerHTML = "Nuevo Rol"; //Cambiamos el título
  document.querySelector("#formRol").reset(); //reseteamos el formulario
  document.querySelector("#formRol").classList.remove("was-validated"); //para que se limpie la validación del formulario

  $("#modalFormRol").modal("show");
}

// se va a ejecutar las funciones cuando se cargue todo el documento
window.addEventListener(
  "load",
  function () {
    // fntEditRol();
    // fntDelRol();
    // fntPermisos();
  },
  false
);

// función para editar un rol
function fntEditRol(id) {
  document.querySelector("#titleModal").innerHTML = "Actualizar Rol"; // cambiamos el texto del título
  document
    .querySelector(".modal-header")
    .classList.replace("headerRegister", "headerUpdate"); // reemplazamos la clase register por update
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-primary", "btn-info"); // reemplazamos la clase del botón
  document.querySelector("#btnText").innerHTML = "Actualizar"; // cambiamos el texto del span del HTML

  let idrol = id; //id del rol
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP"); //validamos el navegador en el que estamos
  let ajaxUrl = base_url + "/Roles/getRol/" + idrol; //url que nos saca el id del rol
  request.open("GET", ajaxUrl, true); //obtenemos la información a traves del método get por l aurl
  request.send(); //enviamos la peticion

  //obtenemos la respuesta
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText); //convertimos a un objeto el formato json

      //hacemos una validación
      if (objData.status) {
        //si el status es verdadero le introducimos los valores en las casillas del modal
        document.querySelector("#idRol").value = objData.data.idrol;
        document.querySelector("#txtNombre").value = objData.data.nombrerol;
        document.querySelector("#txtDescripcion").value =
          objData.data.descripcion;

        let optionSelect;
        if (objData.data.status == 1) {
          //deja seleccionado el select necesario
          optionSelect =
            '<opction value="1" selected class="notBlock">Activo</opction>';
        } else {
          optionSelect =
            '<opction value="2" selected class="notBlock">Inactivo</opction>';
        }

        let htmlSelect = `${optionSelect} 
                              <option value="1">Activo</option>
                              <option value="2">Inactivo</option>`;

        document.querySelector("#listStatus").innerHTML = htmlSelect;
        $("#modalFormRol").modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };
}

//funcion que dota de funcionalidad el boton eliminar
function fntDelRol(id) {
  let idrol = id; //obtenemos el valor del atributo que es el id del rol

  swal(
    {
      title: "Eliminar Rol",
      text: "¿Está seguro que desea eliminar el rol?",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "Si, eliminar.",
      cancelButtonText: "No, cancelar.",
      closeOnConfirm: false,
      closeOnCancel: true,
    },
    function (isConfirm) {
      //script para poder eliminar el rol
      if (isConfirm) {
        let request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP"); //validamos el navegador en el que estamos
        let ajaxUrl = base_url + "/Roles/delRol/";
        let strData = "idrol=" + idrol;
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
              tableRoles.api().ajax.reload(function () {
                fntEditRol();
                fntDelRol();
                fntPermisos();
              });
            } else {
              swal("Atención!", objData.msg, "error");
            }
          }
        };
      }
    }
  );
}

// Función que dota de funcionalidad al botón de permisos
function fntPermisos(id) {
  //Hacemos una petición para poder obtener los módulos
  let idrol = id; //obtenemos el id de la fila al que vamos a darle los permisos
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP"); //validamos el navegador en el que estamos
  let ajaxUrl = base_url + "/Permisos/getPermisosRol/" + idrol;
  request.open("GET", ajaxUrl, true); //obtenemos la información a traves del método get por la url
  request.send(); //enviamos la peticion

  //hacemos la validación
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      //inserta en el html la respuesta que estamos obteniendo del request.responseTxt que sera el html de Permisos.php en controller
      document.querySelector("#contentAjax").innerHTML = request.responseText;
      $(".modalPermisos").modal("show");
      //agregamos el evento submit al formulario
      document
        .querySelector("#formPermisos")
        .addEventListener("submit", fntSavePermisos, false);
    }
  };
}

function fntSavePermisos(event) {
  event.preventDefault(); //evitamos que se recargue la página cuando le demos a guardar
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP"); //validamos el navegador en el que estamos
  let ajaxUrl = base_url + "/Permisos/setPermisos"; //colocamos la url/el controlador/y el método
  let formElement = document.querySelector("#formPermisos"); //seleccionamos el formulario
  let formData = new FormData(formElement); //creamos un objeto formData y le enviamos como parámetro todos los elementos del formulario
  request.open("POST", ajaxUrl, true); //abrimos la conexión enviandola por POST a la url
  request.send(formData); //enviamsos el formData

  //hacemos la validación
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);
      if (objData.status) {
        swal("Permisos de usuario", objData.msg, "success");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };
}
