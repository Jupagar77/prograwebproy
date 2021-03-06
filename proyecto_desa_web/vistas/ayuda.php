<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Iniciar Sesión</title>
  <link href="../styles.css" rel="stylesheet" type="text/css"/>
  <link rel="shortcut icon" type="image/png" href="../images/mp4.png"/>
</head>
<body>

<main class="centrar_main_home centrar_main_ayuda">
  <div>
      <h1>AYUDA DEL SITIO</h1>
      <p>
        <i>Contacto: Gerson Vargas Gálvez & Juan Pablo Gutierrez</i>
      </p>
      <hr />
  </div>
      <article>
        <h2>HOME</h2>
        <p>
          <i>Página principal del sistema. El sistema permite almacenar archivos .MP4 en un ambiente seguro.</i>
        </p>
        <ul>
          <li>
            <p> En esta página se permite el login de los ususarios previamente registrados o bien registrarse para usar el sistema.</p>
          </li>
        </ul>
      </article>
      <hr />
      <article>
        <h2>REGISTRARSE</h2>
        <p>
          <i>En la página de inicio dar click en el botón
            <b>Registrar</b>. Permite a los usuarios que no estén registadros, crear una cuenta para ingresar al sitio.</i>
        </p>
        <ul>
          <li>
            <h3>Formulario</h3>
            <p>El usuario debe completar los campos solicitados en el formulario, los cuales son campos de información básica
              para poder usar el sistema.</p>
            <i>Nota: El usuario debe recordar el password y nombre de usario o correo para poder usar el sistema.</i>

          </li>
          <li>
            <h3>Registrar</h3>
            <p>Al dar click en el botón
              <b>Registrar</b> se creará una cuenta para hacer uso del almacenamiento de archivos .MP4 </p>

          </li>
        </ul>
      </article>
      <hr />
      <article>
        <h2>LOGIN</h2>

        <ul>
          <li>
            <h3>Usuario</h3>
            <p> El usuario puede ingresar al sistema con el nombre de usuario o bien con el correo electrónico.</p>
          </li>
          <li>
            <h3>Password</h3>
            <p>Además, el usuario deberá digitar el password.</p>
          </li>
          <li>
            <h3>Ingresar</h3>
            <p>Una vez ingresados los datos anteriores correctamente, el usuario deberá dar click en el botón
              <b>Ingresar</b>, si los datos no son correctos el usuario no podrá ingresar al sistema.</p>
          </li>
        </ul>
      </article>
      <hr />
      <article>
        <h2>Login Correcto: Acciones de la cuenta:</h2>

        <ul>
          <li>
            <h3>Editar Perfil</h3>
            <p>Al dar click en el botón de editar perfil, se muestra un formulario donde el usuario puede editar la información
              de su cuenta en el sistema.</p>
            <p>
              <strong>Guardar: </strong>
              Se edita la información del usuario en el sistema.
            </p>
            <p>
              <strong>Cancelar: </strong>
              Se cancela la acción de editar perfil.
            </p>
          </li>
          <li>
            <h3>Ver Perfil</h3>
            <p>Permite ver la información del usuario usuario que tiene iniciada la sesión.</p>
          </li>
          <li>
            <h3>Ocultar Información</h3>
            <p>Si el usuario ha dado click en editar perfil o ver perfil, este podrá ocultar dicha información dando click en
              el botón de ocultar perfil.
              <b>Ingresar</b>.</p>
          </li>

        </ul>
      </article>
      <hr />
      <article>
        <h2>Login Correcto: Cargar archivo:</h2>
        <p>
          <i>Formulario que permite subir archivos
            <b>.MP4</b> al servidor.</i>
        </p>
        <ul>
          <li>
            <h3>Seleccionar archivo:</h3>
            <p>Permite seleccionar un archivo local.
            </p>
          </li>
          <li>
            <h3>Categoría:</h3>
            <p>
              Permite indicar una categoría/clasificación del archivo que se desea guardar.
            </p>
          </li>
          <li>
            <h3>Descripción:</h3>
            <p>
              Permite indicar una breve descripción del archivo que se desea guardar.
            </p>
          </li>
          <li>
            <h3>Agregar:</h3>
            <p>
              Dar click en el botón
              <b>Agregar</b> para subir el archivo.
            </p>
          </li>

        </ul>
      </article>
      <hr />

      <article>
        <h2>Login Correcto: Búsqueda/Filtro de archivos</h2>
        <p>
          <i>Filtrar contenido por nombre del archivo.</i>
        </p>
        <ul>
          <li>
            <h3>Campos:</h3>
            <p>Primero ingresar los caracteres que se quieren filtrar.
            </p>
            <p>Dar click en el botón filtrar para hacer la búsqueda de los archivos.
            </p>
          </li>
        </ul>
      </article>
      <hr />

      <article>
        <h2>Login Correcto: Listado de archivos</h2>
        <p>
          <i>Muestra una tabla con el listado de los archivos que se tienen en el servidor</i>
        </p>
        <ul>
          <li>
            <h3>Ver detalles:</h3>
            <p>Permite ver los detalles del archivo seleccionado.
            </p>
          </li>
          <li>
            <h3>Descargar:</h3>
            <p>
              Permite descargar localmente el archivo.
            </p>
          </li>
          <li>
            <h3>Compartir:</h3>
            <p>
              Permite compartir el archivo con otros usuarios registrados en el sistema.
            </p>
          </li>
          <li>
            <h3>Borrar:</h3>
            <p>
              Borra el archivo seleccionado del servidor.
            </p>
          </li>
        </ul>
      </article>
      <article>
          <h2>Login Correcto: Cerrar sesión</h2>
          <p>
            Si el usuario desea salir del sistema, deberá dar click en el botón salir del sistema, en donde será 
            redirigido a la página inicial de login.
          </p>
          
        </article>
    </main>
<footer>
  <div class="container">
    <div class="row">
      <div class="col-sm-4 pleft">
        <p class="font-weight-bold float-left">
          <img src="../images/wifi.png" class="rounded-circle" alt="header">
          <img src="../images/llama.png" class="rounded-circle" alt="header">

        </p>
      </div>
      <div class="col-sm-4 pcenter">
        <p class="font-weight-bold float-center">
            <a class="btn btn-link" href="../index.php">Inicio</a>
            <i class="mr-1 ml-1">|</i>
            <a class="btn btn-link" href="about_us.php">Contactenos</a>
            <i class="mr-1 ml-1">|</i>
            <a class="btn btn-link" href="ayuda.php">Ayuda</a>
        </p>
      </div>
      <div class="col-sm-4 pright">
        <p class="font-weight-bold float-right">
          <img src="../images/twiter.png" class="rounded-circle" alt="header">
          <img src="../images/facebook.png" class="rounded-circle" alt="header">

        </p>
      </div>
    </div>
  </div>
</footer>
  </div>
</body>

</html>