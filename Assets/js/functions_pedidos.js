let tablePedidos;
tablePedidos = $("#tablePedidos").dataTable({
  aProcessing: true,
  aServerSide: true,
  language: {
    url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
  },
  ajax: {
    url: " " + base_url + "/Pedidos/getPedidos",
    dataSrc: "",
  },
  columns: [
    { data: "idpedido" },
    { data: "fecha" },
    { data: "monto" },
    { data: "options" },
  ],
  // estamos haciendo referencia a las columnas de la tabla para agregarles las siguientes clases
  //   columnDefs: [
  //     { className: "textcenter", targets: [2] }, //columna 2 (stock) se refiere a las columnas que tenemos arriba
  //     { className: "textright", targets: [3] }, //columna 3(orecio)
  //     { className: "textcenter", targets: [4] }, //Columna 4(status)
  //   ],

  resonsieve: "true",
  bDestroy: true,
  iDisplayLength: 10,
  order: [[0, "desc"]],
});
