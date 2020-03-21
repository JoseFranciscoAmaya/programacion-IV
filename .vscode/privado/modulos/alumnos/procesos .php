<? php 
include ( '../../Config/Config.php' );
$ alumno = nuevo alumno ( $ conexion );

$ proceso = '' ;
if ( isset ( $ _GET [ 'proceso' ]) && strlen ( $ _GET [ 'proceso' ])> 0 ) {
	$ proceso = $ _GET [ 'proceso' ];
}
$ alumno -> $ proceso ( $ _GET [ 'alumno' ]);
print_r ( json_encode ( $ alumno -> respuesta ));

clase alumno {
    privado  $ datos = array (), $ db ;
    public  $ respuesta = [ 'msg' => 'correcto' ];

     función  pública __construct ( $ db ) {
        $ this -> db = $ db ;
    }
     función  pública recibirDatos ( $ alumno ) {
        $ this -> datos = json_decode ( $ alumno , verdadero );
        $ this -> validar_datos ();
    }
     función  privada validar_datos () {
        if ( empty ( $ this -> datos [ 'codigo' ])) {
            $ this -> respuesta [ 'msg' ] = 'por favor ingrese el codigo del estudiante' ;
        }
        if ( empty ( $ this -> datos [ 'nombre' ])) {
            $ this -> respuesta [ 'msg' ] = 'por favor ingrese el nombre del estudiante' ;
        }
        if ( empty ( $ this -> datos [ 'direccion' ])) {
            $ this -> respuesta [ 'msg' ] = 'por favor ingrese la direccion del estudiante' ;
        }
        $ this -> almacen_alumno ();
    }
     función  privada almacena_alumno () {
        if ( $ this -> respuesta [ 'msg' ] === 'correcto' ) {
            if ( $ this -> datos [ 'accion' ] === 'nuevo' ) {
                $ this -> db -> consultas ( '
                    INSERTAR EN LOS ALUMNOS (codigo, nombre, direccion, telefono) VALORES (
                        "' . $ this -> datos [ ' codigo ' ]. '",
                        "' . $ this -> datos [ ' nombre ' ]. '",
                        "' . $ this -> datos [ ' direccion ' ]. '",
                        "' . $ this -> datos [ ' telefono ' ]. '"
                    )
                ' );
                $ this -> respuesta [ 'msg' ] = 'Registro insertado correctamente' ;
            }
        }
    }
}
?> 