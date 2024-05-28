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

  resonsieve: "true",
  bDestroy: true,
  iDisplayLength: 10,
  order: [[0, "desc"]],
});

//función para el botón de eliminar un pedido
function fntDelPedido(idPedido) {
  swal(
    {
      title: "Eliminar Pedido",
      text: "¿Realmente quiere eliminar el pedido?",
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
        let ajaxUrl = base_url + "/Pedidos/delPedido";
        let strData = "idPedido=" + idPedido;
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
              tablePedidos.api().ajax.reload();
            } else {
              swal("Atención!", objData.msg, "error");
            }
          }
        };
      }
    }
  );
}
