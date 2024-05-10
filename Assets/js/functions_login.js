let divLoading = document.querySelector("#divLoading"); //cogemos el id del loading

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
          divLoading.style.display = "flex"; //le colocamos el estilo flex al que estaba por none

          //hacemos todo el proceso para enviar los datos al controlador
          let request = window.XMLHttpRequest
            ? new XMLHttpRequest()
            : new ActiveXObject("Microsoft.XMLHTTP"); //validamos el navegador en el que estamos
          let ajaxUrl = base_url + "/Login/loginUser"; //colocamos la url/el controlador/y el método
          let formData = new FormData(formLogin); //creamos un objeto formData y le enviamos como parámetro todos los elementos del formulario
          request.open("POST", ajaxUrl, true); //abrimos la conexión enviandola por POST a la url
          request.send(formData); //enviamos el formData

          request.onreadystatechange = function () {
            //si deadyState es 4 esque nos está devolviendo información al navegador
            if (request.readyState != 4) return; //si es diferente de 4 no vamos a hacer nada
            if (request.status == 200) {
              //si salió bien
              let objData = JSON.parse(request.responseText);
              if (objData.status) {
                //si el status es true (hizo login correctamente)
                window.location = base_url + "/dashboard"; //redireccionamos a la parte administrativa que es el dashboard
              } else {
                swal("Atención", objData.msg, "error"); //salta una alerta
                document.querySelector("#txtPassword").value = ""; //limpiamos el campo contraseña
              }
            } else {
              swal("Atención", "Error en el proceso", "error");
            }
            divLoading.style.display = "none"; //volvemos a cambiar el display para que deje de mostrarse el loading
            return false;
          };
        }
      };
    }
  },
  false
);
