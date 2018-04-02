<?php
include('enviar_correo/enviar_correo.php');
$titulo="Respaldo de formulario del registrado.";
 
$mensaje = '
<html lang="es"><body>
<b>
 Tecnico {{nombre_tecnico}}<br>
 Nº: {{numero_formulario}}<br>
 Formulario {{nombre_formulario}}
 <br>
 <br>

 Descripción del Tecnico {{descripcion}}<br>
 </b>
 <br>
 <br>
 <br>


    <section class="imagen_footer"> <img src="http://www.invetsa.com/logo.png" style=" max-width:50px; max-height:50px;"></section>
    <section class="texto_footer">
        <p> 
            Somos una corporación pionera en importación y comercialización de productos<br>
             de uso veterinario que cuenta con 25 años de experiencia y una gestión orientada <br>
             a la excelencia operativa, brindando servicios y consultoría permanente en salud,<br>
              nutrición y tecnología animal.
        </p>
    </section>
     

<center>
<a href="'.$direccion_pagina.'" style=" background-color: #4CAF50;  
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px; " target="_blank"><table style="font-size:inherit;line-height:inherit;padding:0px;border:0px" height="49" cellpadding="0" cellspacing="0">Ver el Formulario </a>
 </center>


 </body></html>

';
 

$mensaje=str_replace('{{nombre_tecnico}}',$nombre_tecnico, $mensaje);
$mensaje=str_replace('{{nombre_formulario}}',$nombre_formulario, $mensaje);
$mensaje=str_replace('{{numero_formulario}}',$id_formulario, $mensaje);
$mensaje=str_replace('{{descripcion}}',$descripcion, $mensaje);

 

// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'From: Respaldo de formulario del Tecnico <info@invetsa.com>' . "\r\n";
$cabeceras .= 'Cc: willduabyakosky@gmail.com' . "\r\n";
$cabeceras .= 'Bcc: willduabyakosky@gmail.com' . "\r\n";

// enviamos el correo!
$exito=mail($para_cliente, $titulo, $mensaje, $cabeceras);

if($exito){
print json_encode( array('suceso' =>'1' ,'mensaje'=>'Correo enviado correctamente. XD' ));
}else{
print json_encode( array('suceso' =>'2' ,'mensaje'=>'Hubo un inconveniente. Contacta a un administrador.'.error_get_last()['message']));
}
?>
