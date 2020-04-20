<?php 
include('../../config/config.php');
$hombre = new hombre($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$hombre->$proceso( $_GET['hombre'] );
print_r(json_encode($hombre->respuesta));

class hombre{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){ 
        $this->db=$db;
    }
    public function recibirDatos($hombre){
        $this->datos = json_decode($hombre, true);
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
        $this->almacenar_hombre();
    }
    private function almacenar_hombre(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO hombres (nombre,apellido,edad,dui) VALUES(
                        "'. $this->datos['nombre'] .'",
                        "'. $this->datos['apellido'] .'",
                        "'. $this->datos['edad'] .'",
                        "'. $this->datos['dui'] .'"
                    )
                ');
                $this->respuesta['msg'] = 'Insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE hombres SET
                        nombre     = "'. $this->datos['nombre'] .'",
                        apellido     = "'. $this->datos['apellido'] .'", 
                        edad         = "'. $this->datos['edad'] .'",
                        dui           = "'. $this->datos['dui'] .'"
                    WHERE idHombre   = "'. $this->datos['idHombre'] .'"
                ');
                $this->respuesta['msg'] = 'Actualizado correctamente';
            }
        }
    }
    public function buscarHombre($valor = ''){
        $this->db->consultas('
            select hombres.idHombre, hombres.nombre, hombres.apellido, hombres.edad, hombres.dui
            from hombres
            where hombres.edad like "%'. $valor .'%" or hombres.nombre like "%'. $valor .'%"
        ');
        return $this->respuesta = $this->db->obtener_data();
    }
    public function eliminarHombre($idHombre = 0){
        $this->db->consultas('
            DELETE hombres
            FROM hombres
            WHERE hombres.idHombre="'.$idHombre.'"
        ');
        return $this->respuesta['msg'] = 'Eliminado correctamente';
    }
}
?>