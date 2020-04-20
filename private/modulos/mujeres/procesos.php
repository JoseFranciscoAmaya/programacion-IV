<?php 
include('../../config/config.php');
$mujer = new mujer($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$mujer->$proceso( $_GET['mujer'] );
print_r(json_encode($mujer->respuesta));

class mujer{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){ 
        $this->db=$db;
    }
    public function recibirDatos($mujer){
        $this->datos = json_decode($mujer, true);
        $this->validar_datos();
    }
    private function validar_datos(){
    
        if( empty($this->datos['nombre']) ){
            $this->respuesta['msg'] = 'ingresar nombre completos';
        }
        if( empty($this->datos['apellido']) ){
            $this->respuesta['msg'] = 'ingresar apellido completos';
        }
        if( empty($this->datos['edad']) ){
            $this->respuesta['msg'] = 'ingresar edad exacta';
        }
        if( empty($this->datos['dui']) ){
            $this->respuesta['msg'] = 'ingresar dui';
        }
        $this->almacenar_mujer();
    }
    private function almacenar_mujer(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO mujeres (nombre,apellido,edad,dui) VALUES(
                        "'. $this->datos['nombre'] .'",
                        "'. $this->datos['apellido'] .'",
                        "'. $this->datos['edad'] .'",
                        "'. $this->datos['dui'] .'"
                    )
                ');
                $this->respuesta['msg'] = 'Insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE mujeres SET
                        nombre     = "'. $this->datos['nombre'] .'",
                        apellido     = "'. $this->datos['apellido'] .'",
                        edad         = "'. $this->datos['edad'] .'",
                        dui           = "'. $this->datos['dui'] .'"
                    WHERE idMujer   = "'. $this->datos['idMujer'] .'"
                ');
                $this->respuesta['msg'] = 'Actualizado correctamente';
            }
        }
    }
    public function buscarMujer($valor = ''){
        $this->db->consultas('
            select mujeres.idMujer, mujeres.nombre, mujeres.apellido, mujeres.edad, mujeres.dui
            from mujeres
            where mujeres.edad like "%'. $valor .'%" or mujeres.nombre like "%'. $valor .'%"
        ');
        return $this->respuesta = $this->db->obtener_data();
    }
    public function eliminarMujer($idMujer = 0){
        $this->db->consultas('
            DELETE mujeres
            FROM mujeres
            WHERE mujeres.idMujer="'.$idMujer.'"
        ');
        return $this->respuesta['msg'] = 'Eliminado correctamente';
    }
}
?>