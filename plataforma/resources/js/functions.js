//Url donde estan las API'S de Integral Works
var urlApi = "http://localhost/Base_admin/BASE_ADMIN__HMCONSULTORES/plataforma/api/";

//--------------FUNCIONES EN GENERAL--------------------//
//Función para loguearse
function login(){
   var formElement = document.getElementById("form-login");
   formData = new FormData(formElement);
   //formData.append("serialnumber", serialNumber++);
   
   fetch(urlApi+'login.php', {
       method: 'POST',
       body: formData
    })
    .then(function(response) {
       if(response.ok) {
           return response.text()
       } else {
           throw "Error en la llamada Ajax";
       }
    
    })
    .then(function(texto) {
        var datos = JSON.parse(texto);
        console.log(datos);
        if (datos.error == false) {
           localStorage.setItem("sessionHM", JSON.stringify(datos.data[0]));
           window.location = 'dashboard.php';

        }else{
           alert(datos.message);
        }
    })
    .catch(function(err) {
       console.log(err);
    });
}

//Función para obtener registrarse
function signup(){
  var formElement = document.getElementById("form-signup");
   formData = new FormData(formElement);
   //formData.append("serialnumber", serialNumber++);
   
   fetch(urlApi+'signup.php', {
       method: 'POST',
       body: formData
    })
    .then(function(response) {
       if(response.ok) {
           return response.text()
       } else {
           throw "Error en la llamada Ajax";
       }
    
    })
    .then(function(texto) {
        var datos = JSON.parse(texto);
        console.log(datos);
        if (datos.error == false) {

           if (confirm("Registrado exitosamente") == true) {
              window.location = 'index.php';
           }

        }else{
           alert('Lo sentimos algo salio mal, intenta de nuevo.');
        }
    })
    .catch(function(err) {
       console.log(err);
    });
  
}

//Función para obtener el listado de privilegios
function getPrivileges(){

  document.getElementById("perfil").innerHTML += '';

  fetch(urlApi+'list-privileges.php', {
     method: 'GET'
  })
  .then(function(response) {
     if(response.ok) {
         return response.text()
     } else {
         throw "Error en la llamada Ajax";
     }
  
  })
  .then(function(texto) {
     var datos = JSON.parse(texto);
     console.log(datos);

     for (let i = 0; i < datos.data.length; i++) {
        document.getElementById("perfil").innerHTML += 
             "<option value="+datos.data[i].id+">"+datos.data[i].name+"</option>";
     }
  })
  .catch(function(err) {
     console.log(err);
  });
}

//Función para obtener sesión
function getSession(){
  var session = JSON.parse(localStorage.getItem('sessionHM'));
  console.log(session);

  //Asignamos el nombre en la etiqueta del dashboard
  document.getElementById("lbl-name-session").innerHTML = session.name+' ('+session.privilege_name+')';
   //Si existe imagen entonces la ponemos de perfil 
   if (session.image !== '') {
      //Si es cliente
      if (session.privileges == '10') {
         document.getElementById("img-session").src="http://localhost/Base_admin/BASE_ADMIN__HMCONSULTORES/plataforma/uploads/clients/image_perfil/"+session.id+"/"+session.image+"";
      //Si es usuario
      } else {
         document.getElementById("img-session").src="http://localhost/Base_admin/BASE_ADMIN__HMCONSULTORES/plataforma/uploads/users/image_perfil/"+session.id+"/"+session.image+"";
      }
   }
}

//Función para cerrar sesión
function closeSession(){
  if (confirm("¿Estas seguro de cerrar sesión?") == true) {
     localStorage.removeItem('sessionHM');
     window.location = "http://localhost/Base_admin/BASE_ADMIN__HMCONSULTORES/plataforma/index.php";
  }else{

  }
}

//Función para validar sesión
function checkSession(){
  var session = JSON.parse(localStorage.getItem('sessionHM'));
  if ( session == null ){
     window.location = 'http://localhost/Base_admin/BASE_ADMIN__HMCONSULTORES/plataforma/index.php';
  }
}

function checkSession2(){
  var session = JSON.parse(localStorage.getItem('sessionHM'));
  if ( session !== null ){
     window.location = 'http://localhost/Base_admin/BASE_ADMIN__HMCONSULTORES/plataforma/dashboard.php';
  }
}

//Funcion para simular href en botones
function openPage(url){
  window.location.href = url;
}

//Funcion para obtener fecha actual
function currentDateNavBar(){
   var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
   var f=new Date();
   var fecha = f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();
   document.getElementById("current-date").innerHTML = 'Hoy: '+fecha+'';
}

//Funcion para verificar privilegios
function verifyPrivileges(privileges){
   //Variable de sesion
   var session = JSON.parse(localStorage.getItem('sessionHM'));

   //Checamos si el privilegio actual pertenece a uno de los que deberia
   //Si no esta dentro de los privilegios permitidos lo redireccionamos al inicio
   if (privileges.includes(session.privileges) === false) {
      window.location.href = 'http://localhost/Base_admin/BASE_ADMIN__HMCONSULTORES/plataforma/page_error.php';
   }

}

//Funcion para asignar valor de autocomplete y eliminar una vez escogido
function setValueAutocomplete(valor, nombre, idsetval, idsettext, idempty){
   document.getElementById(""+idsetval+"").value = valor;
   document.getElementById(""+idsettext+"").value = nombre;
   document.getElementById(""+idempty+"").innerHTML = "";
}

//FUNCIONES EN GENERAL

//Funcion para filtrar los usuarios
function filterUsers(e, field){

   const queryString = window.location.search;
   const urlParams = new URLSearchParams(queryString);
   const pageno = urlParams.get('pageno');
   var filtersUrl = '';

   //Si presionamos enter
   if (e.which == 13) {

      const data = new FormData();
      //data.append('pageno', pageno);

      //Validamos que campos filtraremos
      // if (document.getElementById("user_id_filt").value !== '') {
      //    data.append('user_id_filt', document.getElementById("user_id_filt").value);
      //    filtersUrl += '&user_id_filt='+document.getElementById("user_id_filt").value+'';
      // }

      if (document.getElementById("user_name_filt").value !== '') {
         data.append('user_name_filt', document.getElementById("user_name_filt").value);
         filtersUrl += '&user_name_filt='+document.getElementById("user_name_filt").value+'';
      }

      if (document.getElementById("user_lastname_filt").value !== '') {
         data.append('user_lastname_filt', document.getElementById("user_lastname_filt").value);
         filtersUrl += '&user_lastname_filt='+document.getElementById("user_lastname_filt").value+'';
      }

      if (document.getElementById("user_email_filt").value !== '') {
         data.append('user_email_filt', document.getElementById("user_email_filt").value);
         filtersUrl += '&user_email_filt='+document.getElementById("user_email_filt").value+'';
      }

      if (document.getElementById("user_privileges_filt").value !== '') {
         data.append('user_privileges_filt', document.getElementById("user_privileges_filt").value);
         filtersUrl += '&user_privileges_filt='+document.getElementById("user_privileges_filt").value+'';
      }

      if (document.getElementById("user_disabled_filt").value !== '') {
         data.append('user_disabled_filt', document.getElementById("user_disabled_filt").value);
         filtersUrl += '&user_disabled_filt='+document.getElementById("user_disabled_filt").value+'';
      }

      //Si todo sale bien hacemos la peticion del POST
      fetch(urlApi+'list-users.php', {
         method: 'POST',
         body: data
      })
      .then(function(response) {
         if(response.ok) {
            return response.text()
         } else {
            throw "Error en la llamada Ajax";
         }
      
      })//Si es exitosa la llamada entonces...
      .then(function(texto) {
         var datos = JSON.parse(texto);
         console.log(datos);
         //Variables para paginacion antes y despues
         var pagebefore = parseInt(datos.page_number)-1;
         var pagenext = parseInt(datos.page_number)+1;

         if (datos.error == false) {
            document.getElementById('table-list-users').innerHTML = "";

            for (let i = 0; i < datos.data.length; i++) {

               if (datos.data[i].status == '0') {
                  elStatus = 'Activo';
               } else {
                  elStatus = 'Inactivo';
               }

               document.getElementById("table-list-users").innerHTML += 
               '<tr>'+
                  '<td>'+datos.data[i].name+'</td>'+
                  '<td>'+datos.data[i].lastname+'</td>'+
                  '<td>'+datos.data[i].email+'</td>'+
                  '<td>'+datos.data[i].privilege+'</td>'+
                  '<td>'+elStatus+'</td>'+
                  '<td>'+
                  '<div class="d-flex align-items-center">'+
                     '<button onclick="openPage(\'edit.php?id='+datos.data[i].id+'\');" type="button" class="btn btn-success btn-sm btn-icon-text mr-1">Editar<i class="typcn typcn-edit btn-icon-append"></i>'+                          
                     '</button>'+
                     '<button onclick="deleteUser('+datos.data[i].id+')" type="button" class="btn btn-danger btn-sm btn-icon-text">Borrar<i class="typcn typcn-delete-outline btn-icon-append"></i>'+                          
                     '</button>'+
                  '</div>'+
                  '</td>'+
               '</tr>';
            }

            ///PAGINACION///
            document.getElementById("paginate-list-users").innerHTML = '';

            //Trabajamos en la paginacion
            //Pestana de uno antes
            if (parseInt(datos.page_number) > 1) {
               document.getElementById("paginate-list-users").innerHTML += 
               '<li class="page-item">'+
                  '<a class="page-link" href="?pageno='+pagebefore+''+filtersUrl+'" aria-label="Previous">'+
                  '<span aria-hidden="true">&lt;</span>'+
                  '<span class="sr-only">Previous</span>'+
                  '</a>'+
               '</li>';
            }

            //Ciclamos el numero de paginas
            for (let j = 0; j < datos.total_pagination; j++) {
               var z = j+1;
               var page = parseInt(datos.page_number);
               if (page === z) {
                  document.getElementById("paginate-list-users").innerHTML += 
                  '<li class="page-item active"><a class="page-link" href="?pageno='+z+''+filtersUrl+'">'+z+'</a></li>';
               } else {
                  document.getElementById("paginate-list-users").innerHTML += 
                  '<li class="page-item"><a class="page-link" href="?pageno='+z+''+filtersUrl+'">'+z+'</a></li>';
               }
               
            }

            //Pestana de uno despues
            if (parseInt(datos.page_number) < datos.total_pagination) {
               document.getElementById("paginate-list-users").innerHTML += 
                  '<li class="page-item">'+
                  '<a class="page-link" href="?pageno='+pagenext+''+filtersUrl+'" aria-label="Next">'+
                  '<span aria-hidden="true">&gt;</span>'+
                  '<span class="sr-only">Next</span>'+
                  '</a>'+
               '</li>';
            }

            ///PAGINACION///

         }
      })
      .catch(function(err) {
         console.log(err);
      });
      //Fin de peticion POST para mandar los datos
   }
}

//Funcion para recuperar contraseña
function recovery_password(){
   //Traemos los datos de los campos de las contraseñas
   var formElement = document.getElementById("form-recovery");
   formData = new FormData(formElement);

   //Si todo sale bien hacemos la peticion del POST
   fetch(urlApi+'recovery-password.php', {
      method: 'POST',
      body: formData
   })
   .then(function(response) {
      if(response.ok) {
         return response.text()
      } else {
         throw "Error en la llamada Ajax";
      }
   
   })//Si es exitosa la llamada entonces...
   .then(function(texto) {
      var datos = JSON.parse(texto);
      console.log(datos);
       if (datos.error == false) {
          alert(datos.message);
          window.location = 'index.php';

       }else{
          alert(datos.message);
       }
   })
   .catch(function(err) {
      console.log(err);
   });
   //Fin de peticion POST para mandar los datos
}

function sendEmailOne(email, message, subject){

   const data = new FormData();
   data.append('email', email);
   data.append('message', message);
   data.append('subject', subject);

   fetch(urlApi+'send-email-one.php', {
      method: 'POST',
      body: data
   })
   .then(function(response) {
      if(response.ok) {
         return response.text()
      } else {
         throw "Error en la llamada Ajax";
      }
   
   })//Si es exitosa la llamada entonces...
   .then(function(texto) {
      console.log(texto);
      // var datos = JSON.parse(texto);
      // console.log(datos);
      
   })
   .catch(function(err) {
      console.log(err);
   });
}
//--------------FUNCIONES EN GENERAL--------------------//

//----FUNCIONES PARA LA SECCION DE PERFIL----//
//Funcion para obtener mis datos de mi perfil
function getMyInfo(){

   var session = JSON.parse(localStorage.getItem('sessionHM'));
   var id = session.id;
   console.log(id);

   const data = new FormData();
   data.append('id', id);
   data.append('privileges', session.privileges);

   fetch(urlApi+'get-info-user.php', {
      method: 'POST',
      body: data
   })
   .then(function(response) {
      if(response.ok) {
         return response.text()
      } else {
         throw "Error en la llamada Ajax";
      }
   
   })//Si es exitosa la llamada entonces...
   .then(function(texto) {
      var datos = JSON.parse(texto);
      console.log(datos);

      //Si es usuario normal
      if (datos.data[0].privileges !== '10') {
         //Asignamos los valores a los campos que ya tenemos
         document.getElementById("name-perfil").value = datos.data[0].name;
         document.getElementById("lastname-perfil").value = datos.data[0].lastname;
         document.getElementById("email-perfil").value = datos.data[0].email;
         //Asignamos la funcion de actualizar datos con el id del usuario
         document.getElementById("btn-save-info-basic").setAttribute("onClick", "saveInfoBasic("+datos.data[0].id+")");
         document.getElementById("btn-save-info-pass").setAttribute("onClick", "changePasswordPerfil("+datos.data[0].id+", 1)"); 
      //Si es cliente
      } else {

         //Si es cliente normal
         if (datos.data[0].type == '0') {
            document.getElementById("lastname-perfil").value = datos.data[0].lastname;
         //Si es empresa
         } else{
            document.getElementById("container-lastname-perfil").style.display="none";
         }

         //Asignamos los valores a los campos que ya tenemos
         document.getElementById("name-perfil").value = datos.data[0].name;
         document.getElementById("email-perfil").value = datos.data[0].email;
         //Asignamos la funcion de actualizar datos con el id del usuario
         document.getElementById("btn-save-info-pass").setAttribute("onClick", "changePasswordPerfil("+datos.data[0].id+", 2)"); 

         //Escondemos lo que no necesitamos
         document.getElementById("container-image-perfil").style.display="none";
         document.getElementById("btn-save-info-basic").style.display="none";

         document.getElementById("name-perfil").setAttribute("disabled", "true");
      }

      
   })
   .catch(function(err) {
      console.log(err);
   });
}

//Funcion para actualizar nombre y apellidos del usuario
function saveInfoBasic(id){
   console.log(id);

   //Traemos los datos de los campos
   var formElement = document.getElementById("form-perfil-basic");
   formData = new FormData(formElement);

   formData.append("id", id);

   fetch(urlApi+'update-perfil.php', {
      method: 'POST',
      body: formData
   })
   .then(function(response) {
      if(response.ok) {
         return response.text()
      } else {
         throw "Error en la llamada Ajax";
      }
   
   })//Si es exitosa la llamada entonces...
   .then(function(texto) {
      var datos = JSON.parse(texto);
      console.log(datos); 

      if (datos.error == false) {
         //Actualizamos la sesion
         localStorage.removeItem('sessionHM');
         localStorage.setItem("sessionHM", JSON.stringify(datos.data[0]));

         alert(datos.message);
         location.reload();

      }else{
         alert(datos.message);
      }
   })
   .catch(function(err) {
      console.log(err);
   });
}

//Funcion para cambiar contrasena del usuario
function changePasswordPerfil(id, type){
   console.log(id);
   console.log(type);

   //Traemos los datos de los campos
   var formElement = document.getElementById("form-perfil-password");
   formData = new FormData(formElement);

   console.log(formData.get('new-pass-perfil'));
   console.log(formData.get('new-pass-c-perfil'));

   switch(true) {
      case formData.get('edit-pass-user') == '':
         alert('Por favor, agrega la contraseña');
         break;
      case formData.get('new-pass-c-perfil') == '':
         alert('Por favor, confirma la contraseña');
         break;
      case formData.get('edit-pass-user') !== formData.get('new-pass-c-perfil'):
         alert('Por favor, verifica que las contraseñas sean iguales');
         break;
      default:

      formData.append("id", id);
      formData.append("type", type);
      
      //Si todo sale bien hacemos la peticion del POST
      fetch(urlApi+'change-password.php', {
         method: 'POST',
         body: formData
      })
      .then(function(response) {
         if(response.ok) {
            return response.text()
         } else {
            throw "Error en la llamada Ajax";
         }
      
      })//Si es exitosa la llamada entonces...
      .then(function(texto) {
         var datos = JSON.parse(texto);
         console.log(datos);
          if (datos.error == false) {
             alert('Contraseña cambiada con exito.');
             location.reload();

          }else{
             alert('Lo sentimos algo salio mal, intenta de nuevo.');
          }
      })
      .catch(function(err) {
         console.log(err);
      });
      //Fin de peticion POST para mandar los datos

   }
}
//----FUNCIONES PARA LA SECCION DE PERFIL----//

//----FUNCIONES PARA LA SECCION DE USUARIOS----//
//Función para obtener el listado de privilegios
function getListUsers(){

   //Obtenemos el parametro de la pagina
   //Obtenemos el id de la URL del parametro GET
   const queryString = window.location.search;
   const urlParams = new URLSearchParams(queryString);
   const pageno = urlParams.get('pageno');
   // const user_id_filt = urlParams.get('user_id_filt');
   const user_name_filt = urlParams.get('user_name_filt');
   const user_lastname_filt = urlParams.get('user_lastname_filt');
   const user_email_filt = urlParams.get('user_email_filt');
   const user_privileges_filt = urlParams.get('user_privileges_filt');
   const user_disabled_filt = urlParams.get('user_disabled_filt');
   var filtersUrl = '';

   console.log(1);
   console.log(user_name_filt);

   const data = new FormData();
   data.append('pageno', pageno);

   //Validamos que campos filtraremos
   // if (user_id_filt !== '' && user_id_filt !== null) {
   //    data.append('user_id_filt', user_id_filt);
   //    filtersUrl += '&user_id_filt='+user_id_filt+'';
   // }

   if (user_name_filt !== '' && user_name_filt !== null) {
      data.append('user_name_filt', user_name_filt);
      filtersUrl += '&user_name_filt='+user_name_filt+'';
   } 
   
   if (user_lastname_filt !== '' && user_lastname_filt !== null) {
      data.append('user_lastname_filt', user_lastname_filt);
      filtersUrl += '&user_lastname_filt='+user_lastname_filt+'';
   }
   
   if (user_email_filt !== '' && user_email_filt !== null) {
      data.append('user_email_filt', user_email_filt);
      filtersUrl += '&user_email_filt='+user_email_filt+'';
   }

   if (user_privileges_filt !== '' && user_privileges_filt !== null) {
      data.append('user_privileges_filt', user_privileges_filt);
      filtersUrl += '&user_privileges_filt='+user_privileges_filt+'';
   }

   if (user_disabled_filt !== '' && user_disabled_filt !== null) {
      data.append('user_disabled_filt', user_disabled_filt);
      filtersUrl += '&user_disabled_filt='+user_disabled_filt+'';
   }

   fetch(urlApi+'list-users.php', {
      method: 'POST',
      body: data
   })
   .then(function(response) {
      if(response.ok) {
          return response.text()
      } else {
          throw "Error en la llamada Ajax";
      }
   
   })
   .then(function(texto) {
      var datos = JSON.parse(texto);
      console.log(datos);

      //Variables para paginacion antes y despues
      var pagebefore = parseInt(datos.page_number)-1;
      var pagenext = parseInt(datos.page_number)+1;

      //Limpiamos el contenedor
      document.getElementById("table-list-users").innerHTML = '';

      //Ciclamos los registros
      for (let i = 0; i < datos.data.length; i++) {

         if (datos.data[i].status == '0') {
            elStatus = 'Activo';
         } else {
            elStatus = 'Inactivo';
         }

         document.getElementById("table-list-users").innerHTML += 
            '<tr>'+
               '<td>'+datos.data[i].name+'</td>'+
               '<td>'+datos.data[i].lastname+'</td>'+
               '<td>'+datos.data[i].email+'</td>'+
               '<td>'+datos.data[i].privilege+'</td>'+
               '<td>'+elStatus+'</td>'+
               '<td>'+
               '<div class="d-flex align-items-center">'+
                  '<button onclick="openPage(\'edit.php?id='+datos.data[i].id+'\');" type="button" class="btn btn-success btn-sm btn-icon-text mr-1">Editar<i class="typcn typcn-edit btn-icon-append"></i>'+                          
                  '</button>'+
                  '<button onclick="deleteUser('+datos.data[i].id+')" type="button" class="btn btn-danger btn-sm btn-icon-text">Borrar<i class="typcn typcn-delete-outline btn-icon-append"></i>'+                          
                  '</button>'+
               '</div>'+
               '</td>'+
            '</tr>';
      }

      ///PAGINACION///
      document.getElementById("paginate-list-users").innerHTML = '';

      //Trabajamos en la paginacion

      //Pestana de uno antes
      if (parseInt(datos.page_number) > 1) {
         document.getElementById("paginate-list-users").innerHTML += 
         '<li class="page-item">'+
            '<a class="page-link" href="?pageno='+pagebefore+''+filtersUrl+'" aria-label="Previous">'+
            '<span aria-hidden="true">&lt;</span>'+
            '<span class="sr-only">Previous</span>'+
            '</a>'+
         '</li>';
      }

      //Ciclamos el numero de paginas
      for (let j = 0; j < datos.total_pagination; j++) {
         var z = j+1;
         var page = parseInt(datos.page_number);
         if (page === z) {
            document.getElementById("paginate-list-users").innerHTML += 
            '<li class="page-item active"><a class="page-link" href="?pageno='+z+''+filtersUrl+'">'+z+'</a></li>';
         } else {
            document.getElementById("paginate-list-users").innerHTML += 
            '<li class="page-item"><a class="page-link" href="?pageno='+z+''+filtersUrl+'">'+z+'</a></li>';
         }
      }

      //Pestana de uno despues
      if (parseInt(datos.page_number) < datos.total_pagination) {
         document.getElementById("paginate-list-users").innerHTML += 
            '<li class="page-item">'+
            '<a class="page-link" href="?pageno='+pagenext+''+filtersUrl+'" aria-label="Next">'+
            '<span aria-hidden="true">&gt;</span>'+
            '<span class="sr-only">Next</span>'+
            '</a>'+
         '</li>';
      }

      ///PAGINACION///

   })
   .catch(function(err) {
      console.log(err);
   });
}

//Funcion para obtener la informacion del usuario
function getInfoUser(){
   document.getElementById("edit-perfil").innerHTML += '';

   //Obtenemos el id de la URL del parametro GET
   const queryString = window.location.search;
   const urlParams = new URLSearchParams(queryString);
   const id = urlParams.get('id');

   const data = new FormData();
   data.append('id', id);

   fetch(urlApi+'get-info-user.php', {
      method: 'POST',
      body: data
   })
   .then(function(response) {
      if(response.ok) {
         return response.text()
      } else {
         throw "Error en la llamada Ajax";
      }
   
   })//Si es exitosa la llamada entonces...
   .then(function(texto) {
      var datos = JSON.parse(texto);
      console.log(datos);
       if (datos.error == false) {
         document.getElementById("edit-name-user").value = datos.data[0].name;
         document.getElementById("edit-lastname-user").value = datos.data[0].lastname;
         document.getElementById("edit-email-user").value = datos.data[0].email;
         document.getElementById("edit-status-user").value = datos.data[0].status;
         
         for (let i = 0; i < datos.privileges.length; i++) {
            if (datos.data[0].privileges == datos.privileges[i].id) {
               
               document.getElementById("edit-perfil").innerHTML += 
                 "<option selected value="+datos.privileges[i].id+">"+datos.privileges[i].name+"</option>";

            } else {
               
               document.getElementById("edit-perfil").innerHTML += 
                 "<option value="+datos.privileges[i].id+">"+datos.privileges[i].name+"</option>";

            }

         }

       }else{
          alert('Lo sentimos algo salio mal, intenta de nuevo.');
       }
   })
   .catch(function(err) {
      console.log(err);
   });
}

//Funcion para eliminar usuario
function deleteUser(id){

   const data = new FormData();
   data.append('id', id);

   //Preguntamos si desea eliminar el registro, si confirma, hacemos peticion POST para eliminarlo
   if (confirm("¿Estas seguro de eliminar este usuario?") == true) {
      //Peticion POST para mandar los datos
      fetch(urlApi+'delete-user.php', {
         method: 'POST',
         body: data
      })
      .then(function(response) {
         if(response.ok) {
            return response.text()
         } else {
            throw "Error en la llamada Ajax";
         }
      
      })//Si es exitosa la llamada entonces...
      .then(function(texto) {
         var datos = JSON.parse(texto);
         console.log(datos);
          if (datos.error == false) {
            alert('Usuario eliminado con exito.');
            window.location = 'list.php';

          }else{
             alert('Lo sentimos algo salio mal, intenta de nuevo.');
          }
      })
      .catch(function(err) {
         console.log(err);
      });
   } 
}

//Función para crear un usuario
function createUser(){
   var formElement = document.getElementById("form-create-user");
   formData = new FormData(formElement);

   switch(true) {
      case formData.get('name-user') == '':
        alert('Por favor, agrega el/los nombres');
        break;
      case formData.get('email-user') == '':
         alert('Por favor, agrega el correo electrónico');
         break;
      case formData.get('pass-user') == '':
         alert('Por favor, agrega la contraseña');
         break;
      case formData.get('confirm-pass-user') == '':
         alert('Por favor, confirma la contraseña');
         break;
      case formData.get('pass-user') !== formData.get('confirm-pass-user'):
         alert('Por favor, verifica que las contraseñas sean iguales');
         break;
      case formData.get('perfil') == '':
            alert('Por favor, elige el perfil');
            break;
      default:
        
      //Peticion POST para mandar los datos
      fetch(urlApi+'add-user.php', {
         method: 'POST',
         body: formData
      })
      .then(function(response) {
         if(response.ok) {
            return response.text()
         } else {
            throw "Error en la llamada Ajax";
         }
      
      })//Si es exitosa la llamada entonces...
      .then(function(texto) {
         var datos = JSON.parse(texto);
         console.log(datos);
          if (datos.error == false) {
             alert('Usuario creado con exito.');
             window.location = 'list.php';

          }else{
             alert('Lo sentimos algo salio mal, intenta de nuevo.');
          }
      })
      .catch(function(err) {
         console.log(err);
      });
      //Fin de peticion POST para mandar los datos
      
    }//Fin de Switch
   
}

//Funcion para actualizar usuario
function saveUser(){
   var formElement = document.getElementById("form-edit-user");
   formData = new FormData(formElement);

   switch(true) {
      case formData.get('edit-name-user') == '':
        alert('Por favor, agrega el/los nombres');
        break;
      case formData.get('edit-email-user') == '':
         alert('Por favor, agrega el correo electrónico');
         break;
      case formData.get('edit-perfil') == '':
            alert('Por favor, elige el perfil');
            break;
      default:

      //Si todo sale bien hacemos la peticion del POST
      fetch(urlApi+'update-user.php', {
         method: 'POST',
         body: formData
      })
      .then(function(response) {
         if(response.ok) {
            return response.text()
         } else {
            throw "Error en la llamada Ajax";
         }
      
      })//Si es exitosa la llamada entonces...
      .then(function(texto) {
         var datos = JSON.parse(texto);
         console.log(datos);
          if (datos.error == false) {
             //Actualizamos la sesion
            //localStorage.removeItem('session');
            //localStorage.setItem("session", JSON.stringify(datos.data[0]));

             alert('Usuario actualizado con exito.');
             window.location = 'list.php';

          }else{
             alert('Lo sentimos algo salio mal, intenta de nuevo.');
          }
      })
      .catch(function(err) {
         console.log(err);
      });
      //Fin de peticion POST para mandar los datos
   
   }//Fin del swicth de validaciones de nombre, correo y perfil
}

function changePassword(){
   //Obtenemos el id de la URL del parametro GET
   const queryString = window.location.search;
   const urlParams = new URLSearchParams(queryString);
   const id = urlParams.get('id');

   //Traemos los datos de los campos de las contraseñas
   var formElement = document.getElementById("form-change-user");
   formData = new FormData(formElement);

   switch(true) {
      case formData.get('edit-pass-user') == '':
         alert('Por favor, agrega la contraseña');
         break;
      case formData.get('edit-confirm-pass-user') == '':
         alert('Por favor, confirma la contraseña');
         break;
      case formData.get('edit-pass-user') !== formData.get('edit-confirm-pass-user'):
         alert('Por favor, verifica que las contraseñas sean iguales');
         break;
      default:

      formData.append("id", id);
      
      //Si todo sale bien hacemos la peticion del POST
      fetch(urlApi+'change-password.php', {
         method: 'POST',
         body: formData
      })
      .then(function(response) {
         if(response.ok) {
            return response.text()
         } else {
            throw "Error en la llamada Ajax";
         }
      
      })//Si es exitosa la llamada entonces...
      .then(function(texto) {
         var datos = JSON.parse(texto);
         console.log(datos);
          if (datos.error == false) {
             alert('Contraseña cambiada con exito.');
             window.location = 'list.php';

          }else{
             alert('Lo sentimos algo salio mal, intenta de nuevo.');
          }
      })
      .catch(function(err) {
         console.log(err);
      });
      //Fin de peticion POST para mandar los datos

   }

}
//----FUNCIONES PARA LA SECCION DE USUARIOS----//

//--------------FUNCIONES PARA LA SECCION DE CLIENTES--------------------//

//Funcion para validar si es empresa
function configEnterprise(element){
   //Si es empresa, ocultamos los campos de persona
   if (element == '1') {
      document.getElementById("container-name").style.display="none";
      document.getElementById("container-lastname").style.display="none";
      document.getElementById("container-name-enterprise").style.display="block";
      document.getElementById("container-contact-name-enterprise").style.display="block";
      document.getElementById("container-contact-phone-enterprise").style.display="block";
      document.getElementById("flag-enterprise").value = "1";
      
   } else {
      document.getElementById("container-name").style.display="block";
      document.getElementById("container-lastname").style.display="block";
      document.getElementById("container-name-enterprise").style.display="none";
      document.getElementById("container-contact-name-enterprise").style.display="none";
      document.getElementById("container-contact-phone-enterprise").style.display="none";
      document.getElementById("flag-enterprise").value = "0";
   }
}

function createClient(){
   //Obtenemos la sesion
   var session = JSON.parse(localStorage.getItem('sessionHM'));

   var formElement = document.getElementById("form-create-client");
   formData = new FormData(formElement);
   formData.append("idUser", session.id);

   //Bnadera para saber si es empresa o no
   var flagEnterprise = document.getElementById("flag-enterprise").value;
   //Variable para meter campos obligatorios
   var contentObligatory = '';

   if (flagEnterprise == '1') {
      if (formData.get('name-enterprise') == '') {
         alert('Por favor, agrega el nombre de la empresa');
         return false;
      }
   } else {
      if (formData.get('name-client') == '') {
         alert('Por favor, agrega el nombre del cliente');
         return false;
      }
   }

   switch(true) {
      case formData.get('email-client') == '':
         alert('Por favor, agrega el correo electrónico');
         break;
      case formData.get('rfc-client') == '':
         alert('Por favor, agrega el RFC');
         break;
      case formData.get('pass-client') == '':
         alert('Por favor, agrega la contraseña');
         break;
      case formData.get('confirm-pass-client') == '':
         alert('Por favor, confirma la contraseña');
         break;
      case formData.get('pass-client') !== formData.get('confirm-pass-client'):
         alert('Por favor, verifica que las contraseñas sean iguales');
         break;
      default:

      //Peticion POST para mandar los datos
      fetch(urlApi+'add-client.php', {
         method: 'POST',
         body: formData
      })
      .then(function(response) {
         if(response.ok) {
            return response.text()
         } else {
            throw "Error en la llamada Ajax";
         }
      
      })//Si es exitosa la llamada entonces...
      .then(function(texto) {
         var datos = JSON.parse(texto);
         console.log(datos);
          if (datos.error == false) {
             sendEmailOne(formData.get('email-client'), '<p>Bienvenido a la plataforma de HM Consultores, para ingresar entra con el usuario: '+formData.get('email-client')+' y la contraseña: '+formData.get('pass-client')+' en la siguiente liga</p><br><a href="http://localhost/Base_admin/BASE_ADMIN__HMCONSULTORES/plataforma">Ir a la plataforma</a>', 'Bienvenido a la plataforma HM Consultores')
             alert(datos.message);
             window.location = 'list.php';

          }else{
             alert(datos.message);
          }
      })
      .catch(function(err) {
         console.log(err);
      });
      //Fin de peticion POST para mandar los datos
   }
}

//Funcion para obtener listado de clientes
function getListClients(){

   //Obtenemos el id de la URL del parametro GET
   const queryString = window.location.search;
   const urlParams = new URLSearchParams(queryString);
   const pageno = urlParams.get('pageno');
   const client_id_filt = urlParams.get('client_id_filt');
   const client_name_filt = urlParams.get('client_name_filt');
   const client_email_filt = urlParams.get('client_email_filt');
   const client_rfc_filt = urlParams.get('client_rfc_filt');
   const client_phone_filt = urlParams.get('client_phone_filt');
   const client_type_filt = urlParams.get('client_type_filt');
   const client_disabled_filt = urlParams.get('client_disabled_filt');
   var filtersUrl = '';

   const data = new FormData();
   data.append('pageno', pageno);

   //Validamos que campos filtraremos
   // if (client_id_filt !== '' && client_id_filt !== null) {
   //    data.append('client_id_filt', client_id_filt);
   //    filtersUrl += '&client_id_filt='+client_id_filt+'';
   // }

   if (client_name_filt !== '' && client_name_filt !== null) {
      data.append('client_name_filt', client_name_filt);
      filtersUrl += '&client_name_filt='+client_name_filt+'';
   }

   if (client_email_filt !== '' && client_email_filt !== null) {
      data.append('client_email_filt', client_email_filt);
      filtersUrl += '&client_email_filt='+client_email_filt+'';
   }

   if (client_rfc_filt !== '' && client_rfc_filt !== null) {
      data.append('client_rfc_filt', client_rfc_filt);
      filtersUrl += '&client_rfc_filt='+client_rfc_filt+'';
   }

   if (client_phone_filt !== '' && client_phone_filt !== null) {
      data.append('client_phone_filt', client_phone_filt);
      filtersUrl += '&client_phone_filt='+client_phone_filt+'';
   }

   if (client_type_filt !== '' && client_type_filt !== null) {
      data.append('client_type_filt', client_type_filt);
      filtersUrl += '&client_type_filt='+client_type_filt+'';
   }

   if (client_disabled_filt !== '' && client_disabled_filt !== null) {
      data.append('client_disabled_filt', client_disabled_filt);
      filtersUrl += '&client_disabled_filt='+client_disabled_filt+'';
   }

   fetch(urlApi+'list-clients.php', {
      method: 'POST',
      body: data
   })
   .then(function(response) {
      if(response.ok) {
          return response.text()
      } else {
          throw "Error en la llamada Ajax";
      }
   
   })
   .then(function(texto) {
      var datos = JSON.parse(texto);
      var typeClient = '';
      console.log(datos);

      //Variables para paginacion antes y despues
      var pagebefore = parseInt(datos.page_number)-1;
      var pagenext = parseInt(datos.page_number)+1;

      //Limpiamos el contenedor
      document.getElementById("table-list-clients").innerHTML = '';

      //Ciclamos los registros
      for (let i = 0; i < datos.data.length; i++) {

         if (datos.data[i].is_enterprise == '1') {
            typeClient = 'Moral';
         } else {
            typeClient = 'FÍsica';
         }

         if (datos.data[i].status == '0') {
            elStatus = 'Activo';
         } else {
            elStatus = 'Inactivo';
         }

         document.getElementById("table-list-clients").innerHTML += 
            '<tr>'+
               '<td>'+datos.data[i].name+'</td>'+
               '<td>'+datos.data[i].email+'</td>'+
               '<td>'+datos.data[i].rfc+'</td>'+
               '<td>'+datos.data[i].phone+'</td>'+
               '<td>'+typeClient+'</td>'+
               '<td>'+elStatus+'</td>'+
               '<td>'+
               '<div class="d-flex align-items-center">'+
                  '<button onclick="openPage(\'edit.php?id='+datos.data[i].id+'\');" type="button" class="btn btn-success btn-sm btn-icon-text mr-1">Editar<i class="typcn typcn-edit btn-icon-append"></i>'+                          
                  '</button>'+
                  '<button onclick="deleteClient('+datos.data[i].id+')" type="button" class="btn btn-danger btn-sm btn-icon-text">Borrar<i class="typcn typcn-delete-outline btn-icon-append"></i>'+                          
                  '</button>'+
               '</div>'+
               '</td>'+
            '</tr>';
      }

      ///PAGINACION///
      document.getElementById("paginate-list-clients").innerHTML = '';

      //Trabajamos en la paginacion

      //Pestana de uno antes
      if (parseInt(datos.page_number) > 1) {
         document.getElementById("paginate-list-clients").innerHTML += 
         '<li class="page-item">'+
            '<a class="page-link" href="?pageno='+pagebefore+''+filtersUrl+'" aria-label="Previous">'+
            '<span aria-hidden="true">&lt;</span>'+
            '<span class="sr-only">Previous</span>'+
            '</a>'+
         '</li>';
      }

      //Ciclamos el numero de paginas
      for (let j = 0; j < datos.total_pagination; j++) {
         var z = j+1;
         var page = parseInt(datos.page_number);
         if (page === z) {
            document.getElementById("paginate-list-clients").innerHTML += 
            '<li class="page-item active"><a class="page-link" href="?pageno='+z+''+filtersUrl+'">'+z+'</a></li>';
         } else {
            document.getElementById("paginate-list-clients").innerHTML += 
            '<li class="page-item"><a class="page-link" href="?pageno='+z+''+filtersUrl+'">'+z+'</a></li>';
         }
      }

      //Pestana de uno despues
      if (parseInt(datos.page_number) < datos.total_pagination) {
         document.getElementById("paginate-list-clients").innerHTML += 
            '<li class="page-item">'+
            '<a class="page-link" href="?pageno='+pagenext+''+filtersUrl+'" aria-label="Next">'+
            '<span aria-hidden="true">&gt;</span>'+
            '<span class="sr-only">Next</span>'+
            '</a>'+
         '</li>';
      }

      ///PAGINACION///

   })
   .catch(function(err) {
      console.log(err);
   });
}

//Funcion para obtener info de cliente en especifico
function getInfoClient(){
   //Obtenemos el id de la URL del parametro GET
   const queryString = window.location.search;
   const urlParams = new URLSearchParams(queryString);
   const id = urlParams.get('id');

   const data = new FormData();
   data.append('id', id);

   fetch(urlApi+'get-info-client.php', {
      method: 'POST',
      body: data
   })
   .then(function(response) {
      if(response.ok) {
         return response.text()
      } else {
         throw "Error en la llamada Ajax";
      }
   
   })//Si es exitosa la llamada entonces...
   .then(function(texto) {
      var datos = JSON.parse(texto);
      console.log(datos);
       if (datos.error == false) {

          //Si es empresa
         if (datos.data[0].is_enterprise == '1') {
            document.getElementById("edit-is_enterprise").value = "1";

            document.getElementById("container-name").style.display="none";
            document.getElementById("container-lastname").style.display="none";
            document.getElementById("container-name-enterprise").style.display="block";
            document.getElementById("edit-container-contact-name-enterprise").style.display="block";
            document.getElementById("edit-container-contact-phone-enterprise").style.display="block";
            document.getElementById("flag-enterprise").value = "1";

            document.getElementById("edit-name-enterprise").value = datos.data[0].name;
            document.getElementById("edit_client_contact_name").value = datos.data[0].contact_name;
            document.getElementById("edit_client_contact_phone").value = datos.data[0].contact_phone;
         } else {
            document.getElementById("edit-is_enterprise").value = "0";

            document.getElementById("container-name").style.display="block";
            document.getElementById("container-lastname").style.display="block";
            document.getElementById("container-name-enterprise").style.display="none";
            document.getElementById("edit-container-contact-name-enterprise").style.display="none";
            document.getElementById("edit-container-contact-phone-enterprise").style.display="none";
            document.getElementById("flag-enterprise").value = "0";

            document.getElementById("edit-name-client").value = datos.data[0].name;
            document.getElementById("edit-lastname-client").value = datos.data[0].lastname;
         }

         document.getElementById("edit-email-client").value = datos.data[0].email;
         document.getElementById("edit-phone-client").value = datos.data[0].phone;
         document.getElementById("edit-rfc-client").value = datos.data[0].rfc;
         document.getElementById("edit-address-client").value = datos.data[0].address;
         document.getElementById("edit-credit-days-client").value = datos.data[0].credit_days;
         document.getElementById("edit-status-client").value = datos.data[0].status;

       }else{
          alert('Lo sentimos algo salio mal, intenta de nuevo.');
       }
   })
   .catch(function(err) {
      console.log(err);
   });
}

//Funcion para actualizar cliente
function saveClient(){
   //Obtenemos la sesion
   var session = JSON.parse(localStorage.getItem('sessionHM'));

   var formElement = document.getElementById("form-edit-client");
   formData = new FormData(formElement);
   formData.append("idUser", session.id);

   //Bnadera para saber si es empresa o no
   var flagEnterprise = document.getElementById("flag-enterprise").value;

   if (flagEnterprise == '1') {
      if (formData.get('edit-name-enterprise') == '') {
         alert('Por favor, agrega el nombre de la empresa');
         return false;
      }
   } else {
      if (formData.get('edit-name-client') == '') {
         alert('Por favor, agrega el nombre del cliente');
         return false;
      }
   }

   switch(true) {
      case formData.get('edit-email-client') == '':
         alert('Por favor, agrega el correo electrónico');
         break;
      case formData.get('edit-rfc-client') == '':
         alert('Por favor, agrega el RFC');
         break;
      default:

      //Si todo sale bien hacemos la peticion del POST
      fetch(urlApi+'update-client.php', {
         method: 'POST',
         body: formData
      })
      .then(function(response) {
         if(response.ok) {
            return response.text()
         } else {
            throw "Error en la llamada Ajax";
         }
      
      })//Si es exitosa la llamada entonces...
      .then(function(texto) {
         var datos = JSON.parse(texto);
         console.log(datos);
          if (datos.error == false) {
             //Actualizamos la sesion
            //localStorage.removeItem('session');
            //localStorage.setItem("session", JSON.stringify(datos.data[0]));

             alert('Cliente actualizado con exito.');
             window.location = 'list.php';

          }else{
             alert('Lo sentimos algo salio mal, intenta de nuevo.');
          }
      })
      .catch(function(err) {
         console.log(err);
      });
      //Fin de peticion POST para mandar los datos
   
   }//Fin del swicth de validaciones de nombre, correo y perfil
}

//Funcion para cambiar contrasena
function changePasswordClient(){
   //Obtenemos el id de la URL del parametro GET
   const queryString = window.location.search;
   const urlParams = new URLSearchParams(queryString);
   const id = urlParams.get('id');

   //Traemos los datos de los campos de las contraseñas
   var formElement = document.getElementById("form-change-client");
   formData = new FormData(formElement);

   switch(true) {
      case formData.get('edit-pass-client') == '':
         alert('Por favor, agrega la contraseña');
         break;
      case formData.get('edit-confirm-pass-client') == '':
         alert('Por favor, confirma la contraseña');
         break;
      case formData.get('edit-pass-client') !== formData.get('edit-confirm-pass-client'):
         alert('Por favor, verifica que las contraseñas sean iguales');
         break;
      default:

      formData.append("id", id);
      
      //Si todo sale bien hacemos la peticion del POST
      fetch(urlApi+'change-password-client.php', {
         method: 'POST',
         body: formData
      })
      .then(function(response) {
         if(response.ok) {
            return response.text()
         } else {
            throw "Error en la llamada Ajax";
         }
      
      })//Si es exitosa la llamada entonces...
      .then(function(texto) {
         var datos = JSON.parse(texto);
         console.log(datos);
          if (datos.error == false) {
             alert('Contraseña cambiada con exito.');
             window.location = 'list.php';

          }else{
             alert('Lo sentimos algo salio mal, intenta de nuevo.');
          }
      })
      .catch(function(err) {
         console.log(err);
      });
      //Fin de peticion POST para mandar los datos

   }
}

//funcion para eliminar cliente
function deleteClient(id){
   const data = new FormData();
   data.append('id', id);

   //Preguntamos si desea eliminar el registro, si confirma, hacemos peticion POST para eliminarlo
   if (confirm("¿Estas seguro de eliminar este cliente?") == true) {
      //Peticion POST para mandar los datos
      fetch(urlApi+'delete-client.php', {
         method: 'POST',
         body: data
      })
      .then(function(response) {
         if(response.ok) {
            return response.text()
         } else {
            throw "Error en la llamada Ajax";
         }
      
      })//Si es exitosa la llamada entonces...
      .then(function(texto) {
         var datos = JSON.parse(texto);
         console.log(datos);
          if (datos.error == false) {
            alert('Cliente eliminado con exito.');
            window.location = 'list.php';

          }else{
             alert('Lo sentimos algo salio mal, intenta de nuevo.');
          }
      })
      .catch(function(err) {
         console.log(err);
      });
   } 
}

//Funcion para filtrar clientes
function filterClients(e){

   const queryString = window.location.search;
   const urlParams = new URLSearchParams(queryString);
   const pageno = urlParams.get('pageno');
   var filtersUrl = '';

   //Si presionamos enter
   if (e.which == 13) {

      const data = new FormData();

      //Validamos que campos filtraremos
      // if (document.getElementById("client_id_filt").value !== '') {
      //    data.append('client_id_filt', document.getElementById("client_id_filt").value);
      //    filtersUrl += '&client_id_filt='+document.getElementById("client_id_filt").value+'';
      // }

      if (document.getElementById("client_name_filt").value !== '') {
         data.append('client_name_filt', document.getElementById("client_name_filt").value);
         filtersUrl += '&client_name_filt='+document.getElementById("client_name_filt").value+'';
      }

      if (document.getElementById("client_email_filt").value !== '') {
         data.append('client_email_filt', document.getElementById("client_email_filt").value);
         filtersUrl += '&client_email_filt='+document.getElementById("client_email_filt").value+'';
      }

      if (document.getElementById("client_rfc_filt").value !== '') {
         data.append('client_rfc_filt', document.getElementById("client_rfc_filt").value);
         filtersUrl += '&client_rfc_filt='+document.getElementById("client_rfc_filt").value+'';
      }

      if (document.getElementById("client_phone_filt").value !== '') {
         data.append('client_phone_filt', document.getElementById("client_phone_filt").value);
         filtersUrl += '&client_phone_filt='+document.getElementById("client_phone_filt").value+'';
      }

      if (document.getElementById("client_type_filt").value !== '') {
         data.append('client_type_filt', document.getElementById("client_type_filt").value);
         filtersUrl += '&client_type_filt='+document.getElementById("client_type_filt").value+'';
      }

      if (document.getElementById("client_disabled_filt").value !== '') {
         data.append('client_disabled_filt', document.getElementById("client_disabled_filt").value);
         filtersUrl += '&client_disabled_filt='+document.getElementById("client_disabled_filt").value+'';
      }

      //Si todo sale bien hacemos la peticion del POST
      fetch(urlApi+'list-clients.php', {
         method: 'POST',
         body: data
      })
      .then(function(response) {
         if(response.ok) {
            return response.text()
         } else {
            throw "Error en la llamada Ajax";
         }
      
      })//Si es exitosa la llamada entonces...
      .then(function(texto) {
         var datos = JSON.parse(texto);
         console.log(datos);

         //Variables para paginacion antes y despues
         var pagebefore = parseInt(datos.page_number)-1;
         var pagenext = parseInt(datos.page_number)+1;

         if (datos.error == false) {
            document.getElementById('table-list-clients').innerHTML = "";

            for (let i = 0; i < datos.data.length; i++) {
               if (datos.data[i].is_enterprise == '1') {
                  typeClient = 'Moral';
               } else {
                  typeClient = 'FÍsica';
               }

               if (datos.data[i].status == '0') {
                  elStatus = 'Activo';
               } else {
                  elStatus = 'Inactivo';
               }
      
               document.getElementById("table-list-clients").innerHTML += 
                  '<tr>'+
                     '<td>'+datos.data[i].name+'</td>'+
                     '<td>'+datos.data[i].email+'</td>'+
                     '<td>'+datos.data[i].rfc+'</td>'+
                     '<td>'+datos.data[i].phone+'</td>'+
                     '<td>'+typeClient+'</td>'+
                     '<td>'+elStatus+'</td>'+
                     '<td>'+
                     '<div class="d-flex align-items-center">'+
                        '<button onclick="openPage(\'edit.php?id='+datos.data[i].id+'\');" type="button" class="btn btn-success btn-sm btn-icon-text mr-1">Editar<i class="typcn typcn-edit btn-icon-append"></i>'+                          
                        '</button>'+
                        '<button onclick="deleteClient('+datos.data[i].id+')" type="button" class="btn btn-danger btn-sm btn-icon-text">Borrar<i class="typcn typcn-delete-outline btn-icon-append"></i>'+                          
                        '</button>'+
                     '</div>'+
                     '</td>'+
                  '</tr>';
            }
         }

         ///PAGINACION///
         document.getElementById("paginate-list-clients").innerHTML = '';

         //Trabajamos en la paginacion
         //Pestana de uno antes
         if (parseInt(datos.page_number) > 1) {
            document.getElementById("paginate-list-clients").innerHTML += 
            '<li class="page-item">'+
               '<a class="page-link" href="?pageno='+pagebefore+''+filtersUrl+'" aria-label="Previous">'+
               '<span aria-hidden="true">&lt;</span>'+
               '<span class="sr-only">Previous</span>'+
               '</a>'+
            '</li>';
         }

         //Ciclamos el numero de paginas
         for (let j = 0; j < datos.total_pagination; j++) {
            var z = j+1;
            var page = parseInt(datos.page_number);
            if (page === z) {
               document.getElementById("paginate-list-clients").innerHTML += 
               '<li class="page-item active"><a class="page-link" href="?pageno='+z+''+filtersUrl+'">'+z+'</a></li>';
            } else {
               document.getElementById("paginate-list-clients").innerHTML += 
               '<li class="page-item"><a class="page-link" href="?pageno='+z+''+filtersUrl+'">'+z+'</a></li>';
            }
            
         }

         //Pestana de uno despues
         if (parseInt(datos.page_number) < datos.total_pagination) {
            document.getElementById("paginate-list-clients").innerHTML += 
               '<li class="page-item">'+
               '<a class="page-link" href="?pageno='+pagenext+''+filtersUrl+'" aria-label="Next">'+
               '<span aria-hidden="true">&gt;</span>'+
               '<span class="sr-only">Next</span>'+
               '</a>'+
            '</li>';
         }

         ///PAGINACION///


      })
      .catch(function(err) {
         console.log(err);
      });
      //Fin de peticion POST para mandar los datos
   }
}

//--------------FUNCIONES PARA LA SECCION DE CLIENTES--------------------//