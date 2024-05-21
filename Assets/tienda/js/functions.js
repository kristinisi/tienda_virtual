$(".js-select2").each(function () {
  $(this).select2({
    minimumResultsForSearch: 20,
    dropdownParent: $(this).next(".dropDownSelect2"),
  });
});

$(".parallax100").parallax100();

$(".gallery-lb").each(function () {
  // the containers for all your galleries
  $(this).magnificPopup({
    delegate: "a", // the selector for gallery item
    type: "image",
    gallery: {
      enabled: true,
    },
    mainClass: "mfp-fade",
  });
});

$(".js-addwish-b2").on("click", function (e) {
  e.preventDefault();
});

$(".js-addwish-b2").each(function () {
  let nameProduct = $(this).parent().parent().find(".js-name-b2").html();
  $(this).on("click", function () {
    swal(nameProduct, "is added to wishlist !", "success");

    $(this).addClass("js-addedwish-b2");
    $(this).off("click");
  });
});

$(".js-addwish-detail").each(function () {
  let nameProduct = $(this)
    .parent()
    .parent()
    .parent()
    .find(".js-name-detail")
    .html();

  $(this).on("click", function () {
    swal(nameProduct, "is added to wishlist !", "success");

    $(this).addClass("js-addedwish-detail");
    $(this).off("click");
  });
});

/*---------------------------------------------*/

//Función para añadir productos al carrito
$(".js-addcart-detail").each(function () {
  //obtenemos el nombre del producto
  let nameProduct = $(this)
    .parent()
    .parent()
    .parent()
    .parent()
    .find(".js-name-detail")
    .html();
  //le agregamos el evento click
  $(this).on("click", function () {
    //capturamos los datos del producto como la cantidad y el id(encriptado)
    let id = this.getAttribute("id");
    let cant = document.querySelector("#cant-product").value;

    //verificamos si es o no un número
    if (isNaN(cant) || cant < 1) {
      swal("", "La cantidad debe ser mayor o igual que 1", "error");
      return;
    }

    //hacemos la implementación XMLHttpRequest para implementar ajax
    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    let ajaxUrl = base_url + "/Tienda/addCarrito"; //accedemos a base_url(footer), al controlador Tienda y luego el método addCarrito
    let formData = new FormData();
    formData.append("id", id);
    formData.append("cant", cant);

    request.open("POST", ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function () {
      if (request.readyState != 4) return;
      if (request.status == 200) {
        let objData = JSON.parse(request.responseText);
        if (objData.status) {
          //colocamos el html del modal del carrito en el id del header_tienda productoscarrito
          document.querySelector("#productosCarrito").innerHTML =
            objData.htmlCarrito;

          //para actualizar el icono para ordenador y el del movil recorremos los dos con un foreach
          const cants = document.querySelectorAll(".cantCarrito");
          cants.forEach((element) => {
            element.setAttribute("data-notify", objData.cantCarrito);
          });
          swal(nameProduct, "¡Se agrego al carrito!", "success");
        } else {
          swal("", objData.msg, "error");
        }
      }
      return false;
    };
  });
});

$(".js-pscroll").each(function () {
  $(this).css("position", "relative");
  $(this).css("overflow", "hidden");
  let ps = new PerfectScrollbar(this, {
    wheelSpeed: 1,
    scrollingThreshold: 1000,
    wheelPropagation: false,
  });

  $(window).on("resize", function () {
    ps.update();
  });
});

// [ +/- num product ]
// Disminuir la cantidad
$(".btn-num-product-down").on("click", function () {
  let numProduct = Number($(this).next().val());
  let idpr = this.getAttribute("idpr"); //cogemos el id del producto encriptado
  if (numProduct > 1)
    //la cantidad mínima será 1
    $(this)
      .next()
      .val(numProduct - 1);
  let cant = $(this).next().val(); //nos dirigimos al siguiente elemento del que hacemos clic y obtenemos el valor(input donde tenemos la cantidad)
  //validamos porque en la vista de producto detalle solo mostramos el número y no enviamos datos en ese momento
  if (idpr != null) {
    fntUpdateCant(idpr, cant);
  }
});

// Aumentar la cantidad
$(".btn-num-product-up").on("click", function () {
  let numProduct = Number($(this).prev().val());
  let idpr = this.getAttribute("idpr"); //cogemos el id del producto encriptado
  $(this)
    .prev()
    .val(numProduct + 1);
  let cant = $(this).prev().val(); //nos dirigimos al anterior elemento del que hacemos clic y obtenemos el valor(input donde tenemos la cantidad)
  //validamos porque en la vista de producto detalle solo mostramos el número y no enviamos datos en ese momento
  if (idpr != null) {
    fntUpdateCant(idpr, cant);
  }
});

//Actualizar producto si metemos el valor por teclado
if (document.querySelector(".num-product")) {
  let inputCant = document.querySelectorAll(".num-product");
  inputCant.forEach(function (inputCant) {
    inputCant.addEventListener("keyup", function () {
      //se va a ejecutar la función cuando terminemos de presionar la tecla
      let idpr = this.getAttribute("idpr");
      let cant = this.value;
      if (idpr != null) {
        fntUpdateCant(idpr, cant);
      }
    });
  });
}

//función para borrar un producto del carrito
function fntdelItem(element) {
  //Option 1 = Modal
  //Option 2 = Vista Carrito
  let option = element.getAttribute("op"); //recogemos el option
  let idpr = element.getAttribute("idpr"); //recogemos el id del producto (llega encriptado)
  if (option == 1 || option == 2) {
    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    let ajaxUrl = base_url + "/Tienda/delCarrito"; //va a ir al controlador Tienda y luego al método delCarrito
    let formData = new FormData();
    formData.append("id", idpr);
    formData.append("option", option);
    request.open("POST", ajaxUrl, true);
    request.send(formData);

    request.onreadystatechange = function () {
      if (request.readyState != 4) return;
      if (request.status == 200) {
        let objData = JSON.parse(request.responseText);

        if (objData.status) {
          if (option == 1) {
            //eliminamos desde el modal carrito
            document.querySelector("#productosCarrito").innerHTML =
              objData.htmlCarrito;
            //actualizar la cantidad  de productos del icono del carrito
            const cants = document.querySelectorAll(".cantCarrito");
            cants.forEach((element) => {
              element.setAttribute("data-notify", objData.cantCarrito);
            });
          } else {
            //eliminamos desde la vista carrito
            element.parentNode.parentNode.remove(); //buscamos al div padre del producto subiendo dos niveles y lo eliminamos
            // actualizamos el subtotal
            document.querySelector("#subTotalCompra").innerHTML =
              objData.subTotal;
            //actualizamos el total
            document.querySelector("#totalCompra").innerHTML = objData.total;
            //verificamos si ya no tenemos elementos en el carrito comparandolo si solo tiene el encabezado principal (1)
            if (document.querySelectorAll("#tblCarrito tr").length == 1) {
              window.location.href = base_url; //redireccionamos a la página principal
            }
          }
        } else {
          swal("", objData.msg, "error");
        }
      }
      return false;
    };
  }
}

if (document.querySelector("#formRegister")) {
  let formRegister = document.querySelector("#formRegister");
  formRegister.onsubmit = function (e) {
    e.preventDefault();

    let strIdentificacion = document.querySelector("#txtIdentificacion").value;
    let strNombre = document.querySelector("#txtNombre").value;
    let strApellido = document.querySelector("#txtApellido").value;
    let intTelefono = document.querySelector("#txtTelefono").value;
    let strEmail = document.querySelector("#txtEmailCliente").value;
    let strPassword = document.querySelector("#txtPasswordCliente").value;

    console.log(
      strIdentificacion,
      strNombre,
      strApellido,
      intTelefono,
      strEmail,
      strPassword
    );

    if (
      strIdentificacion == "" ||
      strNombre == "" ||
      strApellido == "" ||
      intTelefono == "" ||
      strEmail == "" ||
      strPassword == ""
    ) {
      swal("Atención", "Todos los campos son obligatorios.", "error");
      return false;
    }

    // verificamos los campos del formulario
    let elementsValid = document.getElementsByClassName("valid");
    for (let i = 0; i < elementsValid.length; i++) {
      if (elementsValid[i].classList.contains("is-invalid")) {
        swal("Atención", "Por favor verifique los campos en rojo.", "error");
        return false;
      }
    }

    divLoading.style.display = "flex";
    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    let ajaxUrl = base_url + "/Tienda/registro"; //tenemos la url en el controlador tienda
    let formData = new FormData(formRegister);
    request.open("POST", ajaxUrl, true);
    request.send(formData);

    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        console.log(request.responseText);
        let objData = JSON.parse(request.responseText);
        if (objData.status) {
          //hacemos que se recargue de nuevo la página para que nos de la vista para la dirección de envío y podamos hacer el pago
          swal("Bienenido!", objData.msg, "success");
          window.location.reload(false);
        } else {
          swal("Error", objData.msg, "error");
        }
      }
      divLoading.style.display = "none";
      return false;
    };
  };
}

//función para actualizar la cantidad del producto en la vista del carrito
function fntUpdateCant(pro, cant) {
  if (cant <= 0) {
    //si la cantidad es menos a 0 ocultamos el boton comprar
    document.querySelector("#btnComprar").classList.add("notBlock");
  } else {
    document.querySelector("#btnComprar").classList.remove("notBlock"); //quitamos la clase para que se vuelva a mostrar

    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    let ajaxUrl = base_url + "/Tienda/updCarrito";
    let formData = new FormData();
    formData.append("id", pro);
    formData.append("cantidad", cant);
    request.open("POST", ajaxUrl, true);
    request.send(formData);

    request.onreadystatechange = function () {
      if (request.readyState != 4) return;
      if (request.status == 200) {
        let objData = JSON.parse(request.responseText);
        if (objData.status) {
          //nos dirigimos a la clse pro que corresponde al id del producto (tr) a la fila 0
          let colSubtotal = document.getElementsByClassName(pro)[0];
          //pasamos de la fila 0 va a ir a la propiedad cell a la posicion 4 que es donde se encuentra eltotal del producto y lo va a actualizar
          colSubtotal.cells[4].textContent = objData.totalProducto;
          //metemos el valor en el id de cada elemento
          document.querySelector("#subTotalCompra").innerHTML =
            objData.subTotal;
          document.querySelector("#totalCompra").innerHTML = objData.total;
        } else {
          swal("", objData.msg, "error");
        }
      }
    };
  }
  return false;
}

// Vamos a validar si existe la dirección
if (document.querySelector("#txtDireccion")) {
  let direccion = document.querySelector("#txtDireccion");
  direccion.addEventListener("keyup", function () {
    //se va a ejecutar la función cuando terminemos de presionar la tecla
    let dir = this.value;
    fntViewPago();
  });
}

//Vamos a validar si existe la ciudad
if (document.querySelector("#txtCiudad")) {
  let ciudad = document.querySelector("#txtCiudad");
  ciudad.addEventListener("keyup", function () {
    //se va a ejecutar la función cuando terminemos de presionar la tecla
    let c = this.value;
    fntViewPago();
  });
}

//Vamos a validar si existe la tarjeta
if (document.querySelector("#tarjeta")) {
  let tarjeta = document.querySelector("#tarjeta");
  tarjeta.addEventListener("keyup", function () {
    //se va a ejecutar la función cuando terminemos de presionar la tecla
    let tar = this.value;
    fntViewPago();
  });
}

//Vamos a validar si existe la caducidad
if (document.querySelector("#caducidad")) {
  let caducidad = document.querySelector("#caducidad");
  caducidad.addEventListener("keyup", function () {
    //se va a ejecutar la función cuando terminemos de presionar la tecla
    let cad = this.value;
    fntViewPago();
  });
}

//Vamos a validar si existe la seguridad
if (document.querySelector("#seguridad")) {
  let seguridad = document.querySelector("#seguridad");
  seguridad.addEventListener("keyup", function () {
    //se va a ejecutar la función cuando terminemos de presionar la tecla
    let seg = this.value;
    fntViewPago();
  });
}

//Vamos a validar si existe el titular
if (document.querySelector("#titular")) {
  let titular = document.querySelector("#titular");
  titular.addEventListener("keyup", function () {
    //se va a ejecutar la función cuando terminemos de presionar la tecla
    let tit = this.value;
    fntViewPago();
  });
}

function fntViewPago() {
  let direccion = document.querySelectorAll("#txtDireccion").value;
  let ciudad = document.querySelector("#txtCiudad").value;
  let tarjeta = document.querySelector("#tarjeta").value;
  let caducidad = document.querySelector("#caducidad").value;
  let seguridad = document.querySelector("#seguridad").value;
  let titular = document.querySelector("#titular").value;
  if (
    direccion == "" ||
    ciudad == "" ||
    tarjeta == "" ||
    caducidad == "" ||
    seguridad == "" ||
    titular == ""
  ) {
    document.querySelector("#btnComprar").classList.add("notBlock");
  } else {
    document.querySelector("#btnComprar").classList.remove("notBlock");
  }
}

//PARA GUARDAR PEDIDO
if (document.querySelector("#formPedido")) {
  let formPedido = document.querySelector("#formPedido");
  formPedido.onsubmit = function (e) {
    e.preventDefault();
    e.stopPropagation();

    let direccion = document.querySelector("#txtDireccion").value;
    let ciudad = document.querySelector("#txtCiudad").value;
    let tarjeta = document.querySelector("#tarjeta").value;
    let caducidad = document.querySelector("#caducidad").value;
    let seguridad = document.querySelector("#seguridad").value;
    let titular = document.querySelector("#titular").value;

    //Hacemos algunas validaciones
    const tarjetaPattern = /^[0-9]{4} [0-9]{4} [0-9]{4} [0-9]{4}$/;
    const caducidadPattern = /(0[1-9]|1[0-2])\/(2[2-9]|[3-9][0-9])/;
    const seguridadPattern = /^[0-9]{3,4}$/;

    if (
      direccion == "" ||
      ciudad == "" ||
      tarjeta == "" ||
      caducidad == "" ||
      seguridad == "" ||
      titular == ""
    ) {
      swal("Atención", "Todos los campos son obligatorios.", "error");
      return false;
    }

    if (
      !tarjetaPattern.test(tarjeta) ||
      !caducidadPattern.test(caducidad) ||
      !seguridadPattern.test(seguridad)
    ) {
      swal("Atención", "Algunos campos no son correctos.", "error");
      return false;
    }

    divLoading.style.display = "flex";
    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    let ajaxUrl = base_url + "/Tienda/registroPedido"; //tenemos la url en el controlador tienda
    let formData = new FormData(formPedido);
    request.open("POST", ajaxUrl, true);
    request.send(formData);

    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        console.log(request.responseText);
        let objData = JSON.parse(request.responseText);
        if (objData.status) {
          //hacemos que se recargue de nuevo la página para que nos de la vista para la dirección de envío y podamos hacer el pago
          swal("Gracias por su compra!", objData.msg, "success");
          window.location.href = base_url; //redireccionamos a la página principal
        } else {
          swal("Error", objData.msg, "error");
        }
      }
      divLoading.style.display = "none";
      return false;
    };
  };
}
