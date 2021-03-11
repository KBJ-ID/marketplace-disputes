let domain;
let domain2;

import { environment } from "../environments/environment";

export let Path;
export let Server;
export let Email;

// Entorno Production
if (environment.production) {
  domain = "https://prueba122233.000webhostapp.com/";
  domain2 = domain;

  // Entorno Desarrollo
} else {
  domain = "http://localhost:4200/";
  domain2 = "http://localhost:4200/src/";
}

/*=============================================
  Exportamos la ruta para tomar imágenes
  =============================================*/
Path = {
  url: domain + "assets/",

  //Cuando necestiemos trabajar con certificado SSL (registro o ingreso con facebook)
  // url: 'https://localhost:4200/assets/'
};

/*=============================================
  Exportamos el endPoint del servidor para administrar archivos
  =============================================*/
Server = {
  url:
    domain2 +
    "assets/img/index.php?key=AIzaSyAFdZCnL387NoHO_xmpFC3eTRRZaZZTp50",
  delete:
    domain2 +
    "assets/img/delete.php?key=AIzaSyAFdZCnL387NoHO_xmpFC3eTRRZaZZTp50",
};

/*=============================================
  Exportamos el endPoint del servidor para administrar correos electronicos
  =============================================*/
Email = {
  url:
    domain2 +
    "assets/email/index.php?key=AIzaSyAFdZCnL387NoHO_xmpFC3eTRRZaZZTp50",
};

/*=============================================
Exportamos el endPoint de la APIREST de Firebase
=============================================*/
export let Api = {
  url: "https://marketplace-3951a.firebaseio.com/", // YOUR FIREBASE ENDPOINT
};

/*=============================================
Exportamos el endPoint para el registro de usuarios en Firebase Authentication
=============================================*/

export let Register = {
  url:
    "https://identitytoolkit.googleapis.com/v1/accounts:signUp?key=AIzaSyAFdZCnL387NoHO_xmpFC3eTRRZaZZTp50",
};

/*=============================================
Exportamos el endPoint para el ingreso de usuarios en Firebase Authentication
=============================================*/

export let Login = {
  url:
    "https://identitytoolkit.googleapis.com/v1/accounts:signInWithPassword?key=AIzaSyAFdZCnL387NoHO_xmpFC3eTRRZaZZTp50",
};

/*=============================================
Exportamos el endPoint para enviar verificación de correo electrónico
=============================================*/

export let SendEmailVerification = {
  url:
    "https://identitytoolkit.googleapis.com/v1/accounts:sendOobCode?key=AIzaSyAFdZCnL387NoHO_xmpFC3eTRRZaZZTp50",
};

/*=============================================
Exportamos el endPoint para confirmar email de verificación
=============================================*/

export let ConfirmEmailVerification = {
  url:
    "https://identitytoolkit.googleapis.com/v1/accounts:update?key=AIzaSyAFdZCnL387NoHO_xmpFC3eTRRZaZZTp50",
};

/*=============================================
Exportamos el endPoint para tomar la data del usuario en Firebase auth
=============================================*/

export let GetUserData = {
  url:
    "https://identitytoolkit.googleapis.com/v1/accounts:lookup?key=AIzaSyAFdZCnL387NoHO_xmpFC3eTRRZaZZTp50",
};

/*=============================================
Exportamos el endPoint para Resetear la contraseña
=============================================*/

export let SendPasswordResetEmail = {
  url:
    "https://identitytoolkit.googleapis.com/v1/accounts:sendOobCode?key=AIzaSyAFdZCnL387NoHO_xmpFC3eTRRZaZZTp50",
};

/*=============================================
Exportamos el endPoint para confirmar el cambio de la contraseña
=============================================*/

export let VerifyPasswordResetCode = {
  url:
    "https://identitytoolkit.googleapis.com/v1/accounts:resetPassword?key=AIzaSyAFdZCnL387NoHO_xmpFC3eTRRZaZZTp50",
};

/*=============================================
Exportamos el endPoint para enviar la contraseña
=============================================*/

export let ConfirmPasswordReset = {
  url:
    "https://identitytoolkit.googleapis.com/v1/accounts:resetPassword?key=AIzaSyAFdZCnL387NoHO_xmpFC3eTRRZaZZTp50",
};

/*=============================================
Exportamos el endPoint para cambiar la contraseña
=============================================*/

export let ChangePassword = {
  url:
    "https://identitytoolkit.googleapis.com/v1/accounts:update?key=AIzaSyAFdZCnL387NoHO_xmpFC3eTRRZaZZTp50",
};

// Exportamos las credenciales de payu
export let Payu = {
  // Sandbox
  action: "https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/",
  merchantId: "508029",
  accountId: "512324",
  responseUrl: domain + "account/my-shopping",
  confirmationUrl: domain + "assets/payu/index.php",
  apiKey: "4Vj8eK4rloUd272L48hsrarnUA",
  test: 1,

  // Life
  // action: 'https://checkout.payulatam.com/ppp-web-gateway-payu/',
  // merchantId: ''
  // accountId: ''
  // responseUrl: 'http://localhost:4200/checkout',
  // confirmationUrl: 'http://www.test.com/confirmation'
  // apiKey: '',
  // test: 0
};

// Exportamos las credenciales de mercado pago
export let MercadoPago = {
  // Sandbox
  public_key: "TEST-4b5332b9-ed27-4506-9117-2b13dfbc9748",
  access_token:
    "TEST-3672480761513782-080623-0911d51c744df4cfd28f447fefe64b3b-622101968",

  // Life
  // public_key = "";
  // access_token = "";
};
