<?php  
include('../../config/config.php'); 
$expediente = new expediente($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$expediente->$proceso( $_GET['expediente'] );
print_r(json_encode($expediente->respuesta));

class expediente{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){ 
        $this->db=$db;
    }
    public function recibirDatos($expediente){
        $this->datos = json_decode($expediente, true);
        $this->validar_datos();
    }
    private function validar_datos(){
    
        if( empty($this->datos['cronica']) ){
            $this->respuesta['msg'] = 'ingresar enfermedad cronica';
        }
        if( empty($this->datos['leve']) ){
            $this->respuesta['msg'] = 'ingresar enfermedad leve';
        }
        if( empty($this->datos['sintoma']) ){
            $this->respuesta['msg'] = 'ingresar sintoma';
        }
        if( empty($this->datos['discapacidad']) ){
            $this->respuesta['msg'] = 'ingresar discapacidad';
        }
        $this->almacenar_expediente();
    }
    private function almacenar_expediente(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO expedientes (cronica,leve,sintoma,discapacidad) VALUES(
                        "'. $this->datos['cronica'] .'",
                        "'. $this->datos['leve'] .'",
                        "'. $this->datos['sintoma'] .'",
                        "'. $this->datos['discapacidad'] .'"
                    )
                ');
                $this->respuesta['msg'] = 'Insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE expedientes SET
                          cronica          = "'. $this->datos['cronica'] .'",
                          leve             = "'. $this->datos['leve'] .'",
                          sintoma          = "'. $this->datos['sintoma'] .'",
                          discapacidad     = "'. $this->datos['discapacidad'] .'"
                    WHERE idExpediente   = "'. $this->datos['idExpediente'] .'"
                ');
                $this->respuesta['msg'] = 'Actualizado correctamente';
            }
        }
    }
    public function buscarExpediente($valor = ''){
        $this->db->consultas('
            select expedientes.idExpediente, expedientes.cronica, expedientes.leve, expedientes.sintoma, expedientes.discapacidad
            from expedientes
            where expedientes.sintoma like "%'. $valor .'%" or expedientes.discapacidad like "%'. $valor .'%"
        ');
        return $this->respuesta = $this->db->obtener_data();
    }
    public function eliminarExpediente($idExpediente = 0){
        $this->db->consultas('
            DELETE expedientes
            FROM expedientes
            WHERE expedientes.idExpediente="'.$idExpediente.'"
        ');
        return $this->respuesta['msg'] = 'Eliminado correctamente';
    }
}
?>