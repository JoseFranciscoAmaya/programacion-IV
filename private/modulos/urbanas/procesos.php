<?php 
include('../../config/config.php');
$urbana = new urbana($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$urbana->$proceso( $_GET['urbana'] );
print_r(json_encode($urbana->respuesta));

class urbana{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){ 
        $this->db=$db;
    }
    public function recibirDatos($urbana){
        $this->datos = json_decode($urbana, true);
        $this->validar_datos();
    }
    private function validar_datos(){
    
        if( empty($this->datos['municipio']) ){
            $this->respuesta['msg'] = 'ingresar municipio';
        }
        if( empty($this->datos['ciudad']) ){
            $this->respuesta['msg'] = 'ingresar ciudad';
        }
        if( empty($this->datos['avenida']) ){
            $this->respuesta['msg'] = 'ingresar avenida';
        }
        if( empty($this->datos['descripcion']) ){
            $this->respuesta['msg'] = 'ingresar descripcion';
        }
        $this->almacenar_urbana();
    }
    private function almacenar_urbana(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO urbanas (municipio,ciudad,avenida,descripcion) VALUES(
                        "'. $this->datos['municipio'] .'",
                        "'. $this->datos['ciudad'] .'",
                        "'. $this->datos['avenida'] .'",
                        "'. $this->datos['descripcion'] .'"
                    )
                ');
                $this->respuesta['msg'] = 'Insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE urbanas SET
                        municipio    = "'. $this->datos['municipio'] .'",
                        ciudad       = "'. $this->datos['ciudad'] .'",
                        avenida      = "'. $this->datos['avenida'] .'",
                        descripcion  = "'. $this->datos['descripcion'] .'"
                    WHERE idUrbana   = "'. $this->datos['idUrbana'] .'"
                '); 
                $this->respuesta['msg'] = 'Actualizado correctamente';
            }
        }
    }
    public function buscarUrbana($valor = ''){
        $this->db->consultas('
            select urbanas.idUrbana, urbanas.municipio, urbanas.ciudad, urbanas.avenida, urbanas.descripcion
            from urbanas
            where urbanas.ciudad like "%'. $valor .'%" or urbanas.avenida like "%'. $valor .'%"
        ');
        return $this->respuesta = $this->db->obtener_data();
    }
    public function eliminarUrbana($idUrbana = 0){
        $this->db->consultas('
            DELETE urbanas
            FROM urbanas
            WHERE urbanas.idUrbana="'.$idUrbana.'"
        ');
        return $this->respuesta['msg'] = 'Eliminado correctamente';
    }
}
?>