<main class="contenedor seccion contenido-centrado olvide">
    <h1 class="nombre-pagina">Olvidé Password</h1>
    <p class="descripcion-pagina">Reestablece tu password escribiendo tu email a continuación</p>
    
    <?php
        //include_once __DIR__ . "/../templates/alertas.php";
     ?>
     
    <form action="/olvide" method="POST" class="formulario">
        <div class="campo">
            <label for="email">E-mail</label>
            <input 
                type="email"
                id="email"
                name="email"
                placeholder="Tu E-mail"
            >
        </div>
    
        <input type="submit" class="boton boton-verde" value="Enviar Instrucciones">
    </form>
    
    <div class="acciones acciones-olvide">
        <a href="/login">¿Ya tienes una cuenta? Inicia Sesión</a>
        <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>
    </div>
</main>