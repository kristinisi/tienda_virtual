let tableCategorias;
let divLoading = document.querySelector("#divLoading");
// Cargamos los eventos al momento que se cargue el html o documento y ejetute la función
document.addEventListener(
  "DOMContentLoaded",

  //funcuón para el envío de datos por medio de ajax
  function () {
    tableCategorias = $("#tableCategorias").dataTable({
      aProcessing: true,
      aServerSide: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
      },
      ajax: {
        url: " " + base_url + "/Categorias/getCategorias",
        dataSrc: "",
      },
      columns: [
        { data: "idcategoria" },
        { data: "nombre" },
        { data: "descripcion" },
        { data: "status" },
        { data: "options" },
      ],
      resonsieve: "true",
      bDestroy: true,
      iDisplayLength: 10,
      order: [[0, "desc"]],
    });

    //Carga de la foto o portada para las categorías
    if (document.querySelector("#foto")) {
      let foto = document.querySelector("#foto"); //nos creamos una variable para el elemento foto
      foto.onchange = function (e) {
        //el onchange ejecuta todo lo siguiente, que es cuando cambia de valor el input foto
        let uploadFoto = document.querySelector("#foto").value; //captura el valor de la foto
        let fileimg = document.querySelector("#foto").files;
        let nav = window.URL || window.webkitURL; //se carga la ruta de la imagen
        let contactAlert = document.querySelector("#form_alert");
        if (uploadFoto != "") {
          //si se ha seleccionado una foto
          let type = fileimg[0].type; //crea una variable type para capturar el tipo de archivo que se está cargando
          let name = fileimg[0].name;
          if (
            type != "image/jpeg" &&
            type != "image/jpg" &&
            type != "image/png"
          ) {
            //si el archivo no es un jpeg, jpg, o png introducimos en el Alert del html un mensaje de advertencia
            contactAlert.innerHTML =
              '<p class="errorArchivo">El archivo no es válido.</p>';
            //si hay #img lo elimina y en delphoto lo oculta  y el valor lo pone vacío
            if (document.querySelector("#img")) {
              document.querySelector("#img").remove();
            }
            document.querySelector(".delPhoto").classList.add("notBlock");
            foto.value = "";
            return false;
          } else {
            //si es una foto
            contactAlert.innerHTML = ""; //limpia la alerta
            if (document.querySelector("#img")) {
              //verifica si existe el elemento img
              document.querySelector("#img").remove();
            }
            document.querySelector(".delPhoto").classList.remove("notBlock"); //elimina el notblock y se muestra la x para que la imagen se pueda eliminar
            let objeto_url = nav.createObjectURL(this.files[0]); //creamos un nuevo objeto haciendo referencia al archivo que se ha seleccionado y extraemos la ruta con la posicion 0
            document.querySelector(".prevPhoto div").innerHTML =
              "<img id='img' src=" + objeto_url + ">"; //colocamos en el src la ruta de la imagen que se ha capturado
          }
        } else {
          //si no hay ningun archivo
          alert("No selecciono foto");
          if (document.querySelector("#img")) {
            document.querySelector("#img").remove();
          }
        }
      };
    }

    //si existe el elemento delPhoto(que es la x)
    if (document.querySelector(".delPhoto")) {
      let delPhoto = document.querySelector(".delPhoto"); //Crea una variable
      delPhoto.onclick = function (e) {
        //le ponemos el elemento onclick
        document.querySelector("#foto_remove").value = 1; //al poner esto le decimos que la imagen actual se tiene que eliminar
        removePhoto(); //removemos la foto con la función de más abajo
      };
    }

    //NUEVA CATEGORIA
    let formCategoria = document.querySelector("#formCategoria"); //verificamos si existe el elemento formCategoria
    formCategoria.onsubmit = function (e) {
      e.preventDefault();
      let strNombre = document.querySelector("#txtNombre").value;
      let strDescripcion = document.querySelector("#txtDescripcion").value;
      let intStatus = document.querySelector("#listStatus").value;
      //comprobamos si algún campo está vacío
      if (strNombre == "" || strDescripcion == "" || intStatus == "") {
        swal("Atención", "Todos los campos son obligatorios.", "error");
        return false;
      }
      divLoading.style.display = "flex"; //por si tarda en cargar la pagina
      let request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      let ajaxUrl = base_url + "/Categorias/setCategoria";
      let formData = new FormData(formCategoria);
      request.open("POST", ajaxUrl, true);
      request.send(formData);
      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          let objData = JSON.parse(request.responseText);
          if (objData.status) {
            $("#modalFormCategorias").modal("hide");
            formCategoria.reset();
            swal("Categoria", objData.msg, "success");
            removePhoto();
            //hacemos que la datatable se actualice
            tableCategorias.api().ajax.reload();
          } else {
            swal("Error", objData.msg, "error");
          }
        }
        divLoading.style.display = "none";
        return false;
      };
    };
  },
  false
);

//función para el botón view de las categorías
function fntViewInfo(idcategoria) {
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = base_url + "/Categorias/getCategoria/" + idcategoria;
  request.open("GET", ajaxUrl, true);
  request.send();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);
      if (objData.status) {
        //si el status es verdadero pasamos al modal la información
        let estado =
          objData.data.status == 1
            ? '<span class="badge badge-success">Activo</span>'
            : '<span class="badge badge-danger">Inactivo</span>';
        document.querySelector("#celId").innerHTML = objData.data.idcategoria;
        document.querySelector("#celNombre").innerHTML = objData.data.nombre;
        document.querySelector("#celDescripcion").innerHTML =
          objData.data.descripcion;
        document.querySelector("#celEstado").innerHTML = estado;
        document.querySelector("#imgCategoria").innerHTML =
          '<img src="' + objData.data.url_portada + '"></img>';
        $("#modalViewCategoria").modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };
}

//Función para el botón de actualizar categoría
function fntEditInfo(idcategoria) {
  //datos para cambiar la apariencia del modal
  document.querySelector("#titleModal").innerHTML = "Actualizar Categoría";
  document
    .querySelector(".modal-header")
    .classList.replace("headerRegister", "headerUpdate");
  document.querySelector("#btnText").innerHTML = "Actualizar";

  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = base_url + "/Categorias/getCategoria/" + idcategoria;
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      //si nos devuelve información en el navegafor
      let objData = JSON.parse(request.responseText); //convertimos a objeto el json
      if (objData.status) {
        //si el status es verdadero pasamos al modal la información
        document.querySelector("#idCategoria").value = objData.data.idcategoria;
        document.querySelector("#txtNombre").value = objData.data.nombre;
        document.querySelector("#txtDescripcion").value =
          objData.data.descripcion;
        document.querySelector("#foto_actual").value = objData.data.portada;
        document.querySelector("#foto_remove").value = 0; //debemos poner 0 de nuevo por defecto

        //le damos al select del formulario su valor
        if (objData.data.status == 1) {
          document.querySelector("#listStatus").value = 1;
        } else {
          document.querySelector("#listStatus").value = 2;
        }
        $("#listStatus").selectpicker("render"); //para refrescar y se muestre la opcion del select

        //si existe el elemento img
        if (document.querySelector("#img")) {
          //le colocamos al src la ruta de la imagen
          document.querySelector("#img").src = objData.data.url_portada;
        } else {
          //si no existe el elemento lo crea
          document.querySelector(".prevPhoto div").innerHTML =
            "<img id='img' src=" + objData.data.url_portada + ">";
        }

        //si la protada tiene la imagen por defecto
        if (objData.data.portada == "flor_categoria.png") {
          //nos vamos a la x de delphoto para que no se muestre
          document.querySelector(".delPhoto").classList.add("notBlock");
        } else {
          //si tiene otra imagen dejamos que se visualice la x para eliminar la foto
          document.querySelector(".delPhoto").classList.remove("notBlock");
        }

        $("#modalFormCategorias").modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };
}

//función para el boton eliminar categoría
function fntDelInfo(idcategoria) {
  swal(
    {
      title: "Eliminar Categoría",
      text: "¿Realmente quiere eliminar al categoría?",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "Si, eliminar!",
      cancelButtonText: "No, cancelar!",
      closeOnConfirm: false,
      closeOnCancel: true,
    },
    function (isConfirm) {
      //si se confirma en el swal
      if (isConfirm) {
        let request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP");
        let ajaxUrl = base_url + "/Categorias/delCategoria";
        let strData = "idCategoria=" + idcategoria;
        request.open("POST", ajaxUrl, true);
        request.setRequestHeader(
          "Content-type",
          "application/x-www-form-urlencoded"
        );
        request.send(strData);
        request.onreadystatechange = function () {
          //validamos la devulucion de datos
          if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
              swal("Eliminar!", objData.msg, "success");
              tableCategorias.api().ajax.reload(); //actualizamos la tabla categorias para que la categoria eliminada no se muestre
            } else {
              swal("Atención!", objData.msg, "error");
            }
          }
        };
      }
    }
  );
}

//función que elimina la foto previa del modal categoria nueva
function removePhoto() {
  document.querySelector("#foto").value = "";
  document.querySelector(".delPhoto").classList.add("notBlock");
  if (document.querySelector("#img")) {
    //si existe el elemento lo elimina
    document.querySelector("#img").remove();
  }
}

//función que abre el modal para una nueva categoría
function openModal() {
  rowTable = "";
  document.querySelector("#idCategoria").value = "";
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#titleModal").innerHTML = "Nueva Categoría";
  document.querySelector("#formCategoria").reset();
  document.querySelector("#formCategoria").classList.remove("was-validated"); //para que se limpie la validación del formulario

  $("#modalFormCategorias").modal("show");
  removePhoto();
}
