<?php
/*
 * anatod ® - ©
 */
class class_db {
    PUBLIC  $conn=NULL;
    
    CONST user      =   'test',
          pass      =   'test5678',
          db        =   'test_anatod',
          serverip  =   'anatodtest.c75o4mima6rb.us-east-1.rds.amazonaws.com';
    
    public function __construct(){
        if(!$this->conn){
            try {
                $this->conn = new mysqli(SELF::serverip,SELF::user,SELF::pass,SELF::db); 
                $this->conn->set_charset("utf8");
                if (!$this->conn) {die('No se pudo conectcl.');}
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }
    }
    
    // Retorna la consulta de los clientes {Id, nombre del cliente,Dni , nombre localidad, nombre provincia}
    public function clientes(){
        if ($this->conn->connect_error) die("Problemas con la conexión a la base de datos");

        $registros = $this->conn->query("select cl.cliente_id as cliente_id,
                                                cl.cliente_nombre as cliente_nombre,
                                                cl.cliente_dni as cliente_dni,
                                                lc.localidad_nombre as localidad_nombre,
                                                pr.provincia_nombre as provincia_nombre
                                                from clientes as cl 
                                                inner join localidades as lc on lc.localidad_id = cl.cliente_localidad 
                                                inner join provincias as pr on pr.provincia_id = lc.localidad_provincia"
                                                
                                                ) or die($this->conn->error);
        return $registros;
    }
    
    // Retorna la consulta de los clientes {id de la provincia, nombre provincia}
    public function clientes_ciudades_provincias(){
        $lista_clientes = [];

        if ($this->conn->connect_error) die("Problemas con la conexión a la base de datos");

        $registros = $this->conn->query("select pr.provincia_id as provincia_id,
                                                pr.provincia_nombre as provincia_nombre,
                                                lc.localidad_nombre as localidad_nombre
                                                from clientes as cl 
                                                inner join localidades as lc on lc.localidad_id = cl.cliente_localidad 
                                                inner join provincias as pr on pr.provincia_id = lc.localidad_provincia"
                                                
                                                ) or die($this->conn->error);
        return $registros;
    }

    // Retorna si una usuario existe
    public function existe_usuario( $nombre,$dni,$localidad_codigo ){
        $retu = false;
        
        if ($this->conn->connect_error) die("Problemas con la conexión a la base de datos");
        
        $registros = $this->conn->query("select * from clientes where cliente_nombre='".$nombre."'  AND  cliente_dni =".$dni." AND cliente_localidad=".$localidad_codigo ) 
        or die($this->conn->error);
        
        $retu = $registros->num_rows != 0;

        return $retu;
    }

    // Editar usuarios
    public function editar_usuario($nombre_a, $dni_a, $localidad_codigo_a, $nombre_n,$dni_n,$localidad_codigo_n ){
        $retu = false;
        
        if ($this->conn->connect_error) die("Problemas con la conexión a la base de datos");
        
        $this->conn->query("update clientes set
                            cliente_nombre = '".$nombre_n."' ,cliente_dni = ".$dni_n." , cliente_localidad = ".$localidad_codigo_n.
                            " where cliente_nombre='".$nombre_a."' AND cliente_dni=".$dni_a." AND cliente_localidad=".$localidad_codigo_a)
            or die($this->conn->error);
    }

    // agregar usuario 
    public function agregar_usuario( $nombre, $dni, $localidad ){

        if ($this->conn->connect_error) die("Problemas con la conexión a la base de datos");
        
        $this->conn->query("insert into clientes(cliente_nombre,cliente_dni,cliente_localidad) values ('".$nombre."',".$dni.",'".$localidad."')") or die($this->conn->error);
        
    }

    // Retorna el codigo de una ciudad en base a su nombre
    public function codigo_ciudad($localidad_nombre){
        $retu = "F"; # no existe el codigo para el respectivo nombre
        if ($this->conn->connect_error) die("Problemas con la conexión a la base de datos");

        $registros = $this->conn->query("select localidad_id from localidades where localidad_nombre='".$localidad_nombre."'" ) or die($this->conn->error);

        foreach($registros as $reg){
            $retu = (int) $reg['localidad_id'];
        }

        return $retu;
    }

    public function close(){
        $this->conn->close();
    }
}
?>