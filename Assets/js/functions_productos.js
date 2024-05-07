let tableProductos;

//agregamos todos los eventos a la hora que se cargue el documento
window.addEventListener(
  "load",
  function () {
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

    fntCategorias();
  },
  false
);

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
  //   document.querySelector("#divBarCode").classList.add("notblock");
  //   document.querySelector("#containerGallery").classList.add("notblock");
  //   document.querySelector("#containerImages").innerHTML = "";
  $("#modalFormProductos").modal("show");
}
