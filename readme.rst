###################
Api Graph Facebook & Codeigniter
###################

Según lo solicictado se realizo el desarrollo de una API en codeigniter3 

*******************
Requerimiento
*******************

Build a service which retrieves the profile of one facebook user, using the Facebook API Graph.

We expect an API endpoint which we could hit with an facebook id as parameter and the response should be all the possible information about his profile.
Example:

Request:

GET /profile/facebook/123456
Response:

STATUS 200
{
    "id": 123456,
    "firstName": "Juan",
    "lastName": "Perez"
}

**************************
Instalación
**************************

- Copiar todos los archivos del proyecto en su localhost dentro de la carpeta codigniter. 
  Ej: http://localhost/codeigniter/(archivos descargados)
- Crear una base de datos en Mysql con el nombre facebook e importar el archivo facebook.sql que se encuentra en la raiz del proyecto.

*******************
Modo de prueba
*******************

Para acceder desde el localhost se debe ingresar la siguientes url en el navegador:

- Para perfiles públicos que no requieren la solicitud de token y aprobación del usuario se puede ingresar desde:
  http://localhost/codeigniter/index.php/profile/facebook/(idPerfil)
  Se muestra por pantalla los datos del usuario en formato json.-
  
- Para perfiles que requieren la solicitud de token y aprobación del usuario se debe ingresar desde:
  http://localhost/codeigniter/index.php/profile/facebook
  
  Se redireccionara al login de Facebook y al accceder se muestra por pantalla los datos del usuario en formato json y además se almacenan en la tabla user de la base de datos.-  
