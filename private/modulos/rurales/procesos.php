<?php 
include('../../config/config.php');
$rural = new rural($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$rural->$proceso( $_GET['rural'] );
print_r(json_encode($rural->respuesta));

class rural{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){ 
        $this->db=$db;
    }
    public function recibirDatos($rural){
        $this->datos = json_decode($rural, true);
        $this->validar_datos();
    }
    private function validar_datos(){
    
        if( empty($this->datos['municipio']) ){
            $this->respuesta['msg'] = 'ingresar municipio';
        }
        if( empty($this->datos['canton']) ){
            $this->respuesta['msg'] = 'ingresar canton';
        }
        if( empty($this->datos['colonia']) ){
            $this->respuesta['msg'] = 'ingresar colonia';
        }
        if( empty($this->datos['descripcion']) ){
            $this->respuesta['msg'] = 'ingresar descripcion';
        }
        $this->almacenar_rural();
    }
    private function almacenar_rural(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO rurales (municipio,canton,colonia,descripcion) VALUES(
                        "'. $this->datos['municipio'] .'",
                        "'. $this->datos['canton'] .'",
                        "'. $this->datos['colonia'] .'",
                        "'. $this->datos['descripcion'] .'"
                    )
                ');
                $this->respuesta['msg'] = 'Insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE rurales SET
                        municipio   = "'. $this->datos['municipio'] .'",
                        canton      = "'. $this->datos['canton'] .'",
                        colonia     = "'. $this->datos['colonia'] .'",
                        descripcion = "'. $this->datos['descripcion'] .'"
                    WHERE idRural   = "'. $this->datos['idRural'] .'"
                ');
                $this->respuesta['msg'] = 'Actualizado correctamente';
            }
        }
    }
    public function buscarRural($valor = ''){
        $this->db->consultas('
            select rurales.idRural, rurales.municipio, rurales.canton, rurales.colonia, rurales.descripcion
            from rurales
            where rurales.canton like "%'. $valor .'%" or rurales.colonia like "%'. $valor .'%"
        ');
        return $this->respuesta = $this->db->obtener_data();
    }
    public function eliminarRural($idRural = 0){
        $this->db->consultas('
            DELETE rurales
            FROM rurales
            WHERE rurales.idRural="'.$idRural.'"
        ');
        return $this->respuesta['msg'] = 'Eliminado correctamente';
    }
}
?>