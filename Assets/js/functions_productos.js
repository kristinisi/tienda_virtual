let tableProductos;

tableProductos = $("#tableProductos").dataTable({
  aProcessing: true,
  aServerSide: true,
  language: {
    url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
  },
  ajax: {
    url: " " + base_url + "/Productos/getProductos",
    dataSrc: "",
  },
  columns: [
    { data: "idproducto" },
    { data: "nombre" },
    { data: "stock" },
    { data: "precio" },
    { data: "status" },
    { data: "options" },
  ],
  // estamos haciendo referencia a las columnas de la tabla para agregarles las siguientes clases
  columnDefs: [
    { className: "textcenter", targets: [2] }, //columna 2 (stock) se refiere a las columnas que tenemos arriba
    { className: "textright", targets: [3] }, //columna 3(orecio)
    { className: "textcenter", targets: [4] }, //Columna 4(status)
  ],

  resonsieve: "true",
  bDestroy: true,
  iDisplayLength: 10,
  order: [[0, "desc"]],
});

//agregamos todos los eventos a la hora que se cargue el documento
window.addEventListener(
  "load",
  function () {
    //verificamos si existe el formulario
    if (document.querySelector("#formProductos")) {
      let formProductos = document.querySelector("#formProductos");
      formProductos.onsubmit = function (e) {
        e.preventDefault(); //evitamos que se recargue la página

        //guardamos los datos en variables
        let strNombre = document.querySelector("#txtNombre").value;
        let strDescripcion = document.querySelector("#txtDescripcion").value;
        let strPrecio = document.querySelector("#txtPrecio").value;
        let intStock = document.querySelector("#txtStock").value;

        //comprobamos que no haya campos vacíos que no queramos
        if (strNombre == "" || strPrecio == "" || intStock == "") {
          swal("Atención", "Todos los campos son obligatorios.", "error");
          return false;
        }

        divLoading.style.display = "flex"; //para cuando tarde en cargar muestre el loading

        //envío de datos mediante ajax
        //objeto xml httprequest
        let request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP");
        let ajaxUrl = base_url + "/Productos/setProducto";
        let formData = new FormData(formProductos);
        request.open("POST", ajaxUrl, true);
        request.send(formData);

        request.onreadystatechange = function () {
          if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText); //convertimos a objeto lo que nos devuelve el responseText
            if (objData.status) {
              swal("", objData.msg, "success"); //mostramos la alerta
              //obtenemos el id de producto
              document.querySelector("#idProducto").value = objData.idproducto;
              document
                .querySelector("#containerGallery")
                .classList.remove("notBlock");
              tableProductos.api().ajax.reload(); //Recargamos la tabla
            } else {
              swal("Error", objData.msg, "error");
            }
          }
          divLoading.style.display = "none";
          return false;
        };
      };
    }

    //verimicamos si existe el elemento del botón añadir imagen
    if (document.querySelector(".btnAddImage")) {
      let btnAddImage = document.querySelector(".btnAddImage"); //guardamos el elemento en la variable
      btnAddImage.onclick = function (e) {
        let key = Date.now(); //retornamos la variable de fecha para generar una clave para el id y que no se repita
        let newElement = document.createElement("div"); //nos creamos un elemento div
        newElement.id = "div" + key; //creamos el elemento con el id único
        //metemos dento del div todos los elementos para la imagen
        newElement.innerHTML = ` 
           <div class="prevImage"></div>
           <input type="file" name="foto" id="img${key}" class="inputUploadfile">
           <label for="img${key}" class="btnUploadfile"><i class="fas fa-upload "></i></label>
           <button class="btnDeleteImage notBlock" type="button" onclick="fntDelItem('#div${key}')"><i class="fas fa-trash-alt"></i></button>`;

        //lo anterior lo metemos dentro del contenedor images
        document.querySelector("#containerImages").appendChild(newElement);
        //le va a asignar el evento clic al elemento con el id y al btnuploadfile que tenga dentro
        document.querySelector("#div" + key + " .btnUploadfile").click();

        fntInputFile();
      };
    }

    fntInputFile();
    fntCategorias();
  },
  false
);

//función para subir la imagen del producto
function fntInputFile() {
  let inputUploadfile = document.querySelectorAll(".inputUploadfile"); //guardamos la información del imput file del formulario
  inputUploadfile.forEach(function (inputUploadfile) {
    //recorremos todos los elementos que tenga la clase
    inputUploadfile.addEventListener("change", function () {
      //va a ejecutar todo el script para cargar la imagen a nuestro servidor enviandolo por ajax
      //guardamos los datos en variables
      let idProducto = document.querySelector("#idProducto").value;
      let parentId = this.parentNode.getAttribute("id"); //se refiere a su elemento padre que obtiene el id de ese elemento
      let idFile = this.getAttribute("id"); //hace referencia a ese elemento y obtiene su id
      let uploadFoto = document.querySelector("#" + idFile).value; //obtiene el valor del elemento que correscponde a la imagen
      let fileimg = document.querySelector("#" + idFile).files; //se refiere al input de tipo file qu va a obtener el archivo que está cargando
      let prevImg = document.querySelector("#" + parentId + " .prevImage"); //nos dirigimos a previmage de ese id
      let nav = window.URL || window.webkitURL; //esto depende del navegador donde nos encontremos

      //validamos si existe una imagen
      if (uploadFoto != "") {
        let type = fileimg[0].type; //obtenemos el tipo de archivo en la posición 0
        let name = fileimg[0].name; //obtenemos el name en la posición 0
        //validamos el tipo de archivo que estamos cargando
        if (
          type != "image/jpeg" &&
          type != "image/jpg" &&
          type != "image/png"
        ) {
          prevImg.innerHTML = "Archivo no válido";
          uploadFoto.value = "";
          return false;
        } else {
          //si es correcto el tipo de archivo
          //creamos un objeto url con ese inputfile
          let objeto_url = nav.createObjectURL(this.files[0]);
          //le agregamos el loading para hasta que se cargue la imagen
          prevImg.innerHTML = `<img class="loading" src="${base_url}/Assets/images/loading.svg" >`;

          //se esta mostrando el xmlhttprequest para implementar el ajax
          let request = window.XMLHttpRequest
            ? new XMLHttpRequest()
            : new ActiveXObject("Microsoft.XMLHTTP");
          let ajaxUrl = base_url + "/Productos/setImage"; //ponemos la ruta donde se va a ahacer la petición ajax
          let formData = new FormData();
          formData.append("idproducto", idProducto); //agregamos al formulado el idproducto
          formData.append("foto", this.files[0]); //le colocamos a foto el contenido de la foto
          request.open("POST", ajaxUrl, true); //abrimos una conexión con post
          request.send(formData);

          //hacemos la validación para ver si nos retorna la información o no
          request.onreadystatechange = function () {
            if (request.readyState != 4) return;
            if (request.status == 200) {
              let objData = JSON.parse(request.responseText);
              if (objData.status) {
                //donde se va a mostrar la imagen le vamos a colocar la url de la imagen temporal
                prevImg.innerHTML = `<img src="${objeto_url}">`;
                //nos devuelve el nombre para poder eliminarlo por el atributo
                document
                  .querySelector("#" + parentId + " .btnDeleteImage")
                  .setAttribute("imgname", objData.imgname);
                //cambiamos las clases para poder ocultar los botones o los mostremos
                document
                  .querySelector("#" + parentId + " .btnUploadfile")
                  .classList.add("notBlock");
                document
                  .querySelector("#" + parentId + " .btnDeleteImage")
                  .classList.remove("notBlock");
              } else {
                swal("Error", objData.msg, "error");
              }
            }
          };
        }
      }
    });
  });
}

//función que elimina las imagenes dentro del boton actualizar
function fntDelItem(element) {
  //element es el id de la foto
  let nameImg = document
    .querySelector(element + " .btnDeleteImage") //corresponde al boton de la img
    .getAttribute("imgname"); //correspode al nombre de la imagen
  let idProducto = document.querySelector("#idProducto").value;
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = base_url + "/Productos/delFile";

  let formData = new FormData();
  formData.append("idproducto", idProducto);
  formData.append("file", nameImg);
  request.open("POST", ajaxUrl, true);
  request.send(formData);
  request.onreadystatechange = function () {
    if (request.readyState != 4) return;
    if (request.status == 200) {
      let objData = JSON.parse(request.responseText);
      if (objData.status) {
        let itemRemove = document.querySelector(element); //la variable es = al elemento que pasamos como parametro(id div)
        itemRemove.parentNode.removeChild(itemRemove); //nos referims al padre de ese elemento para eliminarlo(al hijo)
      } else {
        swal("", objData.msg, "error");
      }
    }
  };
}

//función para el boton view de productos
function fntViewInfo(idProducto) {
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = base_url + "/Productos/getProducto/" + idProducto; //lamamos al método con el id del producto
  request.open("GET", ajaxUrl, true); //hacemos la petición
  request.send(); //enviamos la petición

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText); //convertimos a objeto el fotmato json que nos devuelve
      if (objData.status) {
        let htmlImage = "";
        let objProducto = objData.data;

        //convetimos a texto el status del producto
        let estadoProducto =
          objProducto.status == 1
            ? '<span class="badge badge-success">Activo</span>'
            : '<span class="badge badge-danger">Inactivo</span>';

        document.querySelector("#celNombre").innerHTML = objProducto.nombre;
        document.querySelector("#celPrecio").innerHTML = objProducto.precio;
        document.querySelector("#celStock").innerHTML = objProducto.stock;
        document.querySelector("#celCategoria").innerHTML =
          objProducto.categoria;
        document.querySelector("#celStatus").innerHTML = estadoProducto;
        document.querySelector("#celDescripcion").innerHTML =
          objProducto.descripcion;

        if (objProducto.images.length > 0) {
          let objProductos = objProducto.images;
          for (let p = 0; p < objProductos.length; p++) {
            //guardamos en html las imagenes para mostrarlas
            htmlImage += `<img src="${objProductos[p].url_image}"></img>`;
          }
        }
        //metemos en la celda necesaria las imágenes que hemos extraido anteriormente
        document.querySelector("#celFotos").innerHTML = htmlImage;
        $("#modalViewProducto").modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };
}

//función para el boton editar producto
function fntEditInfo(idProducto) {
  document.querySelector("#titleModal").innerHTML = "Actualizar Producto";
  document
    .querySelector(".modal-header")
    .classList.replace("headerRegister", "headerUpdate");
  document.querySelector("#btnText").innerHTML = "Actualizar";

  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = base_url + "/Productos/getProducto/" + idProducto;
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);

      if (objData.status) {
        let htmlImage = "";
        let objProducto = objData.data;

        document.querySelector("#idProducto").value = objProducto.idproducto;
        document.querySelector("#txtNombre").value = objProducto.nombre;
        document.querySelector("#txtDescripcion").value =
          objProducto.descripcion;
        document.querySelector("#txtPrecio").value = objProducto.precio;
        document.querySelector("#txtStock").value = objProducto.stock;
        document.querySelector("#listCategoria").value =
          objProducto.categoriaid;
        document.querySelector("#listStatus").value = objProducto.status;

        //renderizamos los select para que se vean los valores correctos
        $("#listCategoria").selectpicker("render");
        $("#listStatus").selectpicker("render");

        //sacamos las imágenes del producto
        if (objProducto.images.length > 0) {
          let objProductos = objProducto.images;
          for (let p = 0; p < objProductos.length; p++) {
            let key = Date.now() + p;
            htmlImage += `<div id="div${key}">
                          <div class="prevImage">
                          <img src="${objProductos[p].url_image}"></img>
                          </div>
                          <button type="button" class="btnDeleteImage" onclick="fntDelItem('#div${key}')" imgname="${objProductos[p].img}">
                          <i class="fas fa-trash-alt"></i></button></div>`;
          }
        }
        //colocamos las imagenes para que se visualicen
        document.querySelector("#containerImages").innerHTML = htmlImage;
        document
          .querySelector("#containerGallery")
          .classList.remove("notBlock");
        $("#modalFormProductos").modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };
}

//función para el botón de eliminar un producto
function fntDelInfo(idProducto) {
  swal(
    {
      title: "Eliminar Producto",
      text: "¿Realmente quiere eliminar el producto?",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "Si, eliminar!",
      cancelButtonText: "No, cancelar!",
      closeOnConfirm: false,
      closeOnCancel: true,
    },
    function (isConfirm) {
      if (isConfirm) {
        let request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP");
        let ajaxUrl = base_url + "/Productos/delProducto";
        let strData = "idProducto=" + idProducto;
        request.open("POST", ajaxUrl, true);
        request.setRequestHeader(
          "Content-type",
          "application/x-www-form-urlencoded"
        );
        request.send(strData);
        request.onreadystatechange = function () {
          if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
              swal("Eliminar!", objData.msg, "success");
              tableProductos.api().ajax.reload();
            } else {
              swal("Atención!", objData.msg, "error");
            }
          }
        };
      }
    }
  );
}

//función para extraer las categorias  y colocarlas en el select
function fntCategorias() {
  if (document.querySelector("#listCategoria")) {
    //si existe el elemento para mostrar las categorías
    let ajaxUrl = base_url + "/Categorias/getSelectCategorias"; //sacamos la ruta para sacar las categorias
    let request = window.XMLHttpRequest //objeto xml
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    request.open("GET", ajaxUrl, true); //Abrimos la conexión
    request.send(); //enviamos datos

    request.onreadystatechange = function () {
      //hacemos la validación para ver si nos retorna la información o no
      if (request.readyState == 4 && request.status == 200) {
        document.querySelector("#listCategoria").innerHTML =
          request.responseText; //le metemos al select los options de la lista
        $("#listCategoria").selectpicker("render"); //jquery para que renderice y se muestre todas las opciones aplicando lo que es el buscador
      }
    };
  }
}

//fucnión para abrir el modal para nuevo producto o actualizar producto
function openModal() {
  document.querySelector("#idProducto").value = "";
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#titleModal").innerHTML = "Nuevo Producto";
  document.querySelector("#formProductos").reset();
  document.querySelector("#containerGallery").classList.add("notBlock"); //ocultams el elemento
  document.querySelector("#containerImages").innerHTML = ""; //vaciamos el elemento
  document.querySelector("#formProductos").classList.remove("was-validated"); //para que se limpie la validación del formulario

  $("#modalFormProductos").modal("show");
}
