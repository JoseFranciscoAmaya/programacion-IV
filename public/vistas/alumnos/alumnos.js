var  $  =  el  =>  documento . querySelector ( el ) ,
    frmAlumnos  =  $ ( "#frmAlumnos" ) ;
frmAlumnos . addEventListener ( "submit" , e => {
    e . preventDefault ( ) ;
    e . stopPropagation ( ) ;

    dejar alumnos  =  {
        accion     : 'nuevo' ,
        codigo     : $ ( "#txtCodigoAlumno" ) . valor ,
        nombre     : $ ( "#txtNombreAlumno" ) . valor ,
        direccion : $ ( "#txtDireccionAlumno" ) . valor ,
        telefono   : $ ( "#txtTelefonoAlumno" ) . valor
    } ;
    fetch ( `private / Modulos / alumnos / procesos.php? proceso = recibirDatos & alumno = $ { JSON . stringify ( alumnos ) } ` ) . entonces (  resp => resp . json ( )  ) . entonces ( resp => {
        $ ( "#respuestaAlumno" ) . innerHTML  =  `
            <div class = "alert alert-success" role = "alert">
                $ { resp . msg }
            </div>
        ` ;
    } ) ;
} ) ; 