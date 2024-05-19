// Funciones generales para el admin

// Validación del formulario
(function () {
  "use strict";

  let forms = document.querySelectorAll(".needs-validation");

  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener(
      "submit",
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add("was-validated");
      },
      false
    );
  });
})();

//Bloqueamos todas las teclas y solo vamos a permitir el ingreso de números
function controlTag(e) {
  tecla = e.keyCode ? e.keyCode : e.which; //capturamos lo que se está escribiendo
  if (tecla == 8)
    return true; //el 8 está para borrar en la tecla de retroceso pero le damos a true
  else if (tecla == 0 || tecla == 9) return true; //si es la 0 o 9 que es tabular nos debe retornar un true
  patron = /[0-9\s]/; //va a permitir números del 0 al 9
  n = String.fromCharCode(tecla); //pasamos como parametro la tecla
  return patron.test(n); //verificamos el patron
}

//Función que valida un texto sin números como nombre y apellidos
function testText(txtString) {
  let stringText = new RegExp(/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/); //permitimos el ingreso de las letras
  if (stringText.test(txtString)) {
    return true;
  } else {
    return false;
  }
}

function testEntero(intCant) {
  var intCantidad = new RegExp(/^([0-9])*$/);
  if (intCantidad.test(intCant)) {
    return true;
  } else {
    return false;
  }
}

function testNumero(num) {
  let numero = new RegExp(/^([0-9])*$/);
  if (numero.test(num)) {
    return true;
  } else {
    return false;
  }
}

function fntEmailValidate(email) {
  let stringEmail = new RegExp(
    /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/
  );
  if (stringEmail.test(email) == false) {
    return false;
  } else {
    return true;
  }
}

//--------------

//Función que se dirige a los elementos validText del formulario
function fntValidText() {
  let validText = document.querySelectorAll(".validText");
  validText.forEach(function (validText) {
    //cuando terminamos de presionar la tecla ejecuta la siguiente función
    validText.addEventListener("keyup", function () {
      let inputValue = this.value; //obtenemos el valos que se ha escrito por medio de this.value
      if (!testText(inputValue)) {
        //llamamos a la función testText
        this.classList.add("is-invalid");
      } else {
        this.classList.remove("is-invalid");
      }
    });
  });
}

//Hace lo mismo que la función anterior pero para números
function fntValidNumber() {
  let validNumber = document.querySelectorAll(".validNumber");
  validNumber.forEach(function (validNumber) {
    validNumber.addEventListener("keyup", function () {
      let inputValue = this.value;
      if (!testEntero(inputValue)) {
        this.classList.add("is-invalid");
      } else {
        this.classList.remove("is-invalid");
      }
    });
  });
}

//Funcion que valida el campo email
function fntValidEmail() {
  let validEmail = document.querySelectorAll(".validEmail");
  validEmail.forEach(function (validEmail) {
    validEmail.addEventListener("keyup", function () {
      let inputValue = this.value;
      if (!fntEmailValidate(inputValue)) {
        this.classList.add("is-invalid");
      } else {
        this.classList.remove("is-invalid");
      }
    });
  });
}

//Cuando se cargue todo el documento, va a ajecutar la función que llama a las funciones anteriores
window.addEventListener(
  "load",
  function () {
    fntValidText();
    fntValidEmail();
    fntValidNumber();
  },
  false
);
