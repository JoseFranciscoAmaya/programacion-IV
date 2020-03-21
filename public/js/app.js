var $ = el => documento . querySelector ( el ) ;     
documento . addEventListener ( "DOMContentLoaded" , event => {
    dejar  mostrarVista  =  documento . querySelector ( "[clase * = 'mostrar']" ) ;
    let  mostrarVista  =  $ ( "[clase * = 'mostrar']" ) ;
    mostrarVista . addEventListener ( 'clic' , e => {
        e . preventDefault ( ) ;
        e . stopPropagation ( ) ;

        dejar  módulo  =  e . toElement . conjunto de datos . modulo ;

        fetch ( 'public / vistas / alumnos / alumnos.html' ) . entonces (  resp => resp . text ( )  ) . entonces ( resp => {
            $ ( `# vistas- $ { módulo } ` ) . innerHTML  =  resp ;

            let  btnCerrar  =  $ ( ".close" ) ;
            btnCerrar . addEventListener ( "clic" , evento => {
                $ ( `# vistas- $ { módulo } ` ) . innerHTML  =  "" ;
            } ) ;

            let  cuerpo  =  $ ( "cuerpo" ) ,
                guión  =  documento . createElement ( "script" ) ;
            guión . src  =  `public / vistas / $ { modulo } / $ { modulo } .js` ;
            Cuerpo . appendChild ( script ) ;
        } ) ;
    } ) ;
} ) ; 