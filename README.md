<div align="center"> 
  
# $\color{Cyan}{LOGIN\ MVC\ Alvaro\ Gomez}$
</div>

En este repositorio encontraremos un login primitivo de prueba basado en el modelo, vista y controlador.

En el login tendremos en cuenta que los campos a rellenar tienen que tener cierta medida y formato antes de si quiera enviar la solicitud al modelo. Una vez pasa esta parte pasa a solicitar al index la acción de autentificación.

En la autentificación nos manda a la función en AuthController.php hara la conexión con la base de datos, si no lo consigue saltara un error, y creara un objeto Usuario pasandole el promt con el nombre introducido y la contraseña. Si no encuentra nada saltara un mensaje de error.

Una vez hallamos encontrado el usuario almacenaremos el nombre de usuario en la variable de sesión y mandaremos al usuario al Dasboard habiendo completado el login. Luego en el Dashboard podra desloguearse.
