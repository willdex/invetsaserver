<?php
include_once("../clsSistema_integral.php");
include_once("../clsPuntuacion.php");
include_once("../clsDetalle_puntuacion.php");
include_once("../clsPeso.php");
include_once("mpdf/mpdf.php");




$sistema_integral=New Sistema_integral();
$puntuacion= New Puntuacion();
$detalle_puntuacion=New Detalle_puntuacion();
$peso=New Peso();

$id_sistema=$_GET['id'];

$rpt_sim=$sistema_integral->get_formulario_por_id_sim($id_sistema);
$rpt_puntuacion=$puntuacion->get_formulario_puntuacion_por_id_sim($id_sistema);
$rpt_peso=$peso->get_formulario_peso_por_id_sim($id_sistema);
$rpt_detalle_puntuacion=$detalle_puntuacion->get_formulario_detalle_puntuacion_por_id_sim_y_puntuacion($id_sistema,$id_puntuacion);


 

$html.='

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet"  href="mPDF/style.css">
    <meta charset="utf-8">
    <title>SISTEMA INTEGRAL DE MONITOREO</title>
      
       
<style type="text/css">

        header {
            padding: 10px 0;
            margin-bottom: 1px;
        }

       #tabla_contenido,#tabla_puntuacion{
        border:1px solid #000; 
        margin: 5px;
        align-content: top;
        background: #E7F3EB;
       }
       #tabla_puntuacion
       {
        width: 350px;
       }
       th, #tr_cabecera{
         background-color: #025522;
        color: white;
         border: 2px solid #000;

       }
      table th{
        color:white;
                padding: 5px 20px; 
        color: #fff;  
        border-bottom: 1px solid #C1CED9; 
        white-space: nowrap; 
        font-weight: normal; 
      }


        .a1 {width:905px; text-align: left; border: 0px;  position: relative;
        padding-left: 20px; }

        .gordo{

          width: 800px;
        }

        .border-lb {border: 0px 0px 0px 0px; border-width: 0 2px 2px 0px; text-align: left;}
        
        .xmen{width: 912px; border: 0px 0px 0px 0px; border-width: 0 0 2px 2px; text-align: left;}
        
        .foto1 {position: relative; background-color: #025522; left: 500px; top: 200px;    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);}

          .foto2 {position: relative; background-color: #025522; left: 500px; top: 160px;
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);}

        .volve {height: 30px;}

        .fuu {height: 40px}

       #tr_cabecera>td
       {

        color: black;
       }
       #tabla_contenido tr ,#tabla_contenido tr td, #accion tr td,#manipulacion tr td,#control tr td
       {
        border: 1px solid #000;
        padding-left: 8px;

       }
        #irregularidades tr th
       {
        border: 0px solid #000;
        padding-left: 8px;
        width: 30px;

       }
       #irregularidades tr td
       {
        border: 2px solid #000;
        padding-left: 8px;
        border-bottom: 1px;
        order-left: 1px;
        width: 30px;
       
       }

       #vacunador tr{
        width: 5220px;

       }

       td{
        height: 40px;
     
       }
       div{
        height: 100%;
       }
       table
       {
        border-collapse: collapse;
        margin-bottom:1px;
       
       }
       body{
         font-family: arial;
       }
       #accion
       {
        width: 400px;
       }
       #ire ,#ire_l
       {
        border: 1px solid #000;
        text-align: center;
        padding: 0px;
       }

       table td {
    padding: 5px;
    text-align:left;

}
     </style>



  </head>
  <body>
    <header >
    <TABLE class="titulo_tabla1">
      <tr>
        <td>
          <img style="width: 50px; height: 50px" src="imagen/invetsa.png"> 

         </td>
         <td align="center">
         <h2 >SIM (SISTEMA INTEGRAL DE MONITOREO)</h2>
         <h3  >INVERSIONES VETERINARIAS S.A.</h3>
        </td>
        <td>
         Codigo:'.$rpt_sim->codigo.'  <br>
         Revision:'.$rpt_sim->revision.'   
        </td>
      </tr>
 
    </TABLE>
   ';


 


 $html.='

 
   <table style="width:100%;">
      <tr>
        <td style="text-align: left;  ">
          EMPRESA:'.  $rpt_sim->empresa.' <br>
         GRANJA:'. $rpt_sim->granja.'<br>
         ZONA:'.$rpt_sim->zona.' <br>
         GALPON:'.$rpt_sim->codigo_galpon.'  <br>
         ENCARGADO DE GRANJA:'.$rpt_sim->encargado_granja.'  <br>
      </td>
        

        <td style="text-align: left;" colspan="2"> 
         FECHA:'.$rpt_sim->fecha.'<br>
         EDAD:'.$rpt_sim->edad.' <br>
         SEXO:'.$rpt_sim->sexo.'<br>
         AVES EVALUADAS:'.$rpt_sim->nro_pollos.'<br>
        </td>
      </tr>

   </TABLE>
</header>
   ';

$html.='

    
      <table id=tabla_contenido border="0.5"  >
          <tr >
            <th> Peso Corporal </th>
            <th> Peso Bursa  </th>
            <th> Peso de Brazo  </th>
            <th> Peso de Timo  </th>
            <th> Peso de Higado  </th>
            <th> Indice Bursal  </th>
            <th> Indice Timico </th>
            <th> Indice Hepatico </th>
            <th> Bursometro </th>
          </tr>
            
            
';
            
          
          
           

            if($rpt_peso!="-1"){
            while ($fila=mysqli_fetch_object($rpt_peso)) {
              if($fila->id=="6")
              {
                
                $html.=' <tr style="background-color: #025522; ">';
                         
              }
              else
              {
                
               $html.=' <tr>';
                 
              }
          
               if($fila->id=="6")
              {
                  $html.='
                  <td  style="color: white; " ><b>'.$fila->peso_corporal.'</b></td>
                  <td  style="color: white; " ><b>'.$fila->peso_bursa.'</b></td>
                  <td  style="color: white; " ><b>'.$fila->peso_brazo.'</b></td>
                  <td  style="color: white; " ><b>'.$fila->peso_timo.'</b></td>
                  <td  style="color: white; " ><b>'.$fila->peso_higado.'</b></td>';
                 $html.='
                  <td  style="color: white; " ><b>'.$fila->indice_bursal.'</b></td>
                  <td  style="color: white; " ><b>'.$fila->indice_timico.'</b></td>
                  <td  style="color: white; " ><b>'.$fila->indice_hepatico.'</b></td>';
                  $html.='<td  style="color: white; ">'.$fila->bursometro.'</b></td>';

                         
              }
              else
              {
                  $html.='
                  <td>'.$fila->peso_corporal.'</td>
                  <td>'.$fila->peso_bursa.'</td>
                  <td>'.$fila->peso_brazo.'</td>
                  <td>'.$fila->peso_timo.'</td>
                  <td>'.$fila->peso_higado.'</td>';
                $html.='
                  <td style="background:#FEFEDA;">'.$fila->indice_bursal.'</td>
                  <td style="background:#FEFEDA;">'.$fila->indice_timico.'</td>
                  <td style="background:#FEFEDA;">'.$fila->indice_hepatico.'</td>';
                   $html.='<td>'.$fila->bursometro.'</td>';
                 
              }

                  $html.='</tr>';
            }
          }
          
$html.='               
      </table>
      <table>
';    

 

            if($rpt_peso!="-1"){
              
            while ($objeto=mysqli_fetch_object($rpt_puntuacion)) {
              $bajo=$objeto->id % 2;
             
              if($bajo==1){
                $html.='<tr>';
              }
              $html.='<td>
                    <div ><table id=tabla_puntuacion >';
              $rpt_detalle_puntuacion=$detalle_puntuacion->get_formulario_detalle_puntuacion_por_id_sim_y_puntuacion($id_sistema,$objeto->id);
              $html.='
                <tr>
                <th colspan=2>
                '.$objeto->id.' '.$objeto->nombre.'
                </th>
                </tr>
              ';
              if($objeto->id==13)
              {
               $html.=' <tr style="background-color: #025522;" >
                  <td style="border: 1px solid #000; color:white;"> GRADO</td>
                  <td style="border: 1px solid #000; color:white;"> CANTIDAD</td>
                  </tr>';
              }

              if($rpt_detalle_puntuacion!="-1"){
              while($fila=mysqli_fetch_object($rpt_detalle_puntuacion)){
           $html.='
                  <tr>
                  <td style="border: 1px solid #000;">'.$fila->nombre.'</td>
                  <td style="border: 1px solid #000;">'.$fila->estado.'</td>
                  </tr>
                  ';
            }
          }
          $html.='</table></div>';

          }
          if($bajo==0){
               $html.='</tr>';
              }
              $html.='</td>';
          }
             

$html.='</table>

<br>
';
   
 
 
   


$html.='
</div>
 
<b>Observaciones:</b><br>
 '. $rpt_sim->observaciones.'
<br>
<br>
<b>Comentarios:</b><br>
  '.$rpt_sim->comentarios.'
<br>
<br>
 ';

 

$src_imagen_jefe='imagen/jefe.jpg';
$src_firma_invetsa='imagen/ic_camara.png';
$src_firma_empresa='imagen/ic_camara.png';

$src_imagen1="../".$rpt_sim->imagen1; 
$src_imagen2="../".$rpt_sim->imagen2; 
$src_imagen3="../".$rpt_sim->imagen3; 
$src_imagen4="../".$rpt_sim->imagen4; 
$src_imagen5="../".$rpt_sim->imagen5; 
$src_imagen6="../".$rpt_sim->imagen6; 
$src_imagen7="../".$rpt_sim->imagen7; 
$src_imagen8="../".$rpt_sim->imagen8; 
$src_imagen9="../".$rpt_sim->imagen9; 
$src_imagen10="../".$rpt_sim->imagen10; 


 if(file_exists("../".$rpt_sim->firma_invetsa))
{
  $src_firma_invetsa="../".$rpt_sim->firma_invetsa;
}
 if(file_exists("../".$rpt_sim->firma_empresa))
{
  $src_firma_empresa="../".$rpt_sim->firma_empresa;
}
 

$html.='
 

         <table id=tabla_contenido border="0.5" cellpadding="3" bordercolor="#000000">
          <tr >
            <th ><font size="4">IMAGENES</font></th> 
          </tr>
            
            <tbody>
              <TR>';
              $html.=' <td> ';

 if(file_exists($src_imagen1))
{
     $html.=' <img style="height: 200px; width: 200px;" src="'.$src_imagen1.'">';
}
 if(file_exists( $src_imagen2))
{
   $html.=' <img style="height: 200px; width: 200px;" src="'.$src_imagen2.'">';
}
if(file_exists($src_imagen3))
{
   $html.=' <img style="height: 200px; width: 200px;" src="'.$src_imagen3.'">';
} 
 if(file_exists($src_imagen4))
{
   $html.=' <img style="height: 200px; width: 200px;" src="'.$src_imagen4.'">';  
}
 if(file_exists( $src_imagen5))
{
   $html.=' <img style="height: 200px; width: 200px;" src="'.$src_imagen5.'">';
}
if(file_exists($src_imagen6))
{
   $html.='<img style="height: 200px; width: 200px;" src="'.$src_imagen6.'"> ';
}     
 if(file_exists($src_imagen7))
{
    $html.='<img style="height: 200px; width: 200px;" src="'.$src_imagen7.'"> ';
}
 if(file_exists( $src_imagen8))
{
  $html.='<img style="height: 200px; width: 200px;" src="'.$src_imagen8.'"> '; 
}
if(file_exists($src_imagen9))
{
  $html.='<img style="height: 200px; width: 200px;" src="'.$src_imagen9.'"> '; 
}     
 if(file_exists($src_imagen10))
{
  $html.='<img style="height: 200px; width: 200px;" src="'.$src_imagen10.'"> ';  
} 


              $html.=' </td> ';
              $html.=' </TR>';
            
     $html.=' </tbody>       
      </table>';

  



$html.='
 
<br>
<br>
<br>
 
 
 <table id=tabla_contenido class="foto2">
<tr>
<th>Encargado de Granja</th>
<th>Firmado por Invetsa</th>
</tr>
<tr>
<td align=center>
<img src="'.$src_firma_empresa.'" width="300px"/><br>
<center>'.$rpt_sim->encargado_granja.'<BR>
ENCARGADO DE GRANJA</center>
</td>
<td>
<img src="'.$src_firma_invetsa.'" width="300px"/><br>
<center>'.$rpt_sim->tecnico.'<br>
TECNICO</center>
</td>
</tr> </table>

  </body>
 
</html>';

//echo $html;

$mPDF=new mPDF("c","A4");
$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
$mPDF->writeHTML($html);

//$mPDF->Output("reporte.pdf","D");
$mPDF->Output("reporte.pdf","I");
if(isset($_POST['descargar']))
{
  $mPDF->Output("reporte.pdf","D");
}
 

?>

 