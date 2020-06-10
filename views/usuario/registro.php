<h2>REGISTRARSE</h2>
<?php  if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'):?>
<strong>REGISTRO COMPLETADO CORRECTAMENTE</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
<strong>REGISTRO HA FALLADO, INTRODUCE BIEN LOS DATOS</strong>
<?php endif; ?>
<?php Utls::deleteSession('register'); ?>
<form action="<?=base_url?>usuario/save" method="post">
    <label for="nombre">Nombre</label>
	<input type="text" name="nombre" required/>
	
	<label for="apellidos">Apellidos</label>
	<input type="text" name="apellidos" required/>
	
	<label for="email">Email</label>
	<input type="email" name="email" required/>
	
	<label for="password">Contraseña</label>
	<input type="password" name="password" required/>
	
	<input type="submit" value="Registrarse" />
</form>

