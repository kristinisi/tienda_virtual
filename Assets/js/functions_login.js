// Login Page Flipbox control
//cambia el estado visual de un elemento HTML cuando se hace clic en otro elemento específico. -- ESTO LO PUEDO QUITAR PORQUE NO RECUPERAMOS CONTRASEÑA Y NO SE MUESTRA EL OTRO FORMULARIO
$('.login-content [data-toggle="flip"]').click(function () {
  $(".login-box").toggleClass("flipped");
  return false;
});

//Vamos a agregar todos los eventos que vayan dentro de la siguiente función
document.addEventListener(
  "DOMContentLoaded",
  function () {
    if (document.querySelector("#formLogin")) {
      //si existe el elemento formLogin
      let formLogin = document.querySelector("#formLogin");
      formLogin.onsubmit = function (e) {
        e.preventDefault(); //previene que se recargue la página cuando le damos al botón submit

        //recogemos los valores del formulario
        let strEmail = document.querySelector("#txtEmail").value;
        let strPassword = document.querySelector("#txtPassword").value;

        //hacemos una validación por si algún campo está vacío
        if (strEmail == "" || strPassword == "") {
          swal("Por favor", "Escribe usuario y contraseña.", "error");
          return false;
        } else {
          //hacemos todo el proceso para enviar los datos al controlador
          let request = window.XMLHttpRequest
            ? new XMLHttpRequest()
            : new ActiveXObject("Microsoft.XMLHTTP"); //validamos el navegador en el que estamos
          let ajaxUrl = base_url + "/Login/loginUser"; //colocamos la url/el controlador/y el método
          var formData = new FormData(formLogin); //creamos un objeto formData y le enviamos como parámetro todos los elementos del formulario
          request.open("POST", ajaxUrl, true); //abrimos la conexión enviandola por POST a la url
          request.send(formData); //enviamos el formData

          console.log(request);
        }
      };
    }
  },
  false
);
