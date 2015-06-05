<?php

class Modelo {
	
	private static $instancia;
	
	private static $user = 'root';
	private static $pass = '';
	private static $host = '127.0.0.1';
	private static $dbnm = 'bestnid';
	
	private $con;
	
	private $order = 'fecha_ini DESC';
	
	function __construct() {
		$this->con = new mysqli(
			self::$host,
			self::$user,
			self::$pass,
			self::$dbnm);
	}
	
	public function setOrder($orden){
		$this->order = $orden;
	}
	
	private function order(){
		return " ORDER BY  {$this->order} ";
	}
	
	private function update(){
		$this->con->query("UPDATE `producto` SET `estado`= 2 WHERE fecha_fin < CURDATE()");
	}
	
	public static function getInstance(){
		if (  !self::$instancia instanceof self)
		{
			self::$instancia = new self;
		}
		return self::$instancia;
	}
	
	
	
	//OBTIENE TODOS LOS PRODUCTOS
	public function getAllProducts(){
		$res = $this->con->query("SELECT * FROM producto".$this->order());
		
		$resultado = array();
		while( $fila = $res->fetch_assoc() ){
			$resultado[] = $fila;
		}
		return $resultado;
		
	}
	
	//FILTRA LOS PRODUCTOS CON CATEGORIA = A LA $IDCATEGORIA
	public function getProductsOfCategory($idcategoria){
		$res = $this->con->query("SELECT * FROM producto WHERE id_categoria = {$idcategoria}".$this->order());
		
		$resultado = array();
		while( $fila = $res->fetch_assoc() ){
			$resultado[] = $fila;
		}
		return $resultado;
		
	}
	
	//OBTIENE TODAS LAS CATEGORIAS
	public function getAllCategories(){
		$res = $this->con->query("SELECT * FROM categoria");
		
		$resultado = array();
		while( $fila = $res->fetch_assoc() ){
			$resultado[] = $fila;
		}
		return $resultado;
		
	}
	
	// FUNCION DE VALEN PARA VERIFICAR USUARIO NO FUNCIONA, NO ENTIENDO PORQUE
	// public function verifyUser($user, $pass){
		// var_dump($user);
		// $res = $this->con->query("SELECT * FROM 'usuario' WHERE 'user' = {$user}");

		// var_dump($res);
		// if($res){
			// $user = $res->fetch_assoc();
			// if( $user['pass'] == $pass ) return true;
		// }
		// return false;		
	// } 
	
	
	//NUEVA FUNCION DE VERIFICAR QUE SI FUNCIONA, PERO HACE MAS LABURO
		public function verifyUser($user, $pass){
		$res = $this->con->query("SELECT * FROM usuario");
		while( $fila = $res->fetch_assoc() ){
			if($fila['user'] == $user){
				if( $fila['pass'] == $pass ) return $fila;
				else{ ?><p class="center red-text" > Contraseña Invalida </p> <?php return false;} 
			}
		}
		?><p class="center red-text" > Usuario Invalido </p> <?php
		return false;
				
	}
	
	//BUSCAR PRODUCTOS CON $TEXTO EN DESCRIPCION O TITULO
	public function getAllProductsWith($text){
		$res = $this->con->query("SELECT * FROM `producto` WHERE `titulo` LIKE '%{$text}%' OR `descripcion` LIKE '%{$text}%'".$this->order());
		$resultado = array();
		while( $fila = $res->fetch_assoc() ){
				$resultado[] = $fila;
		}
	return $resultado;
	}

	//DADA LA ID DE UN PRODUCTO TE DEVUELVE EL REGISTRO DE ESE PRODUCTO
	public function getProduct($id){
		$res = $this->con->query("SELECT * FROM producto WHERE id = '{$id}' ");
		$fila = array();
		$fila[] = $res->fetch_assoc() ;
		$resultado = $fila[0];
		
	return $resultado;
	}
	
	//DADA EL ID DE UN USUARIO DEVUELVE EL NOMBRE DE USUARIO
	public function getUserName($id){
		$res = $this->con->query("SELECT * FROM usuario WHERE id = '{$id}' ");
		$fila = array();
		$fila[] = $res->fetch_assoc() ;
		$resultado = $fila[0]['user'];
	return $resultado;
	}
	
	//DADA LA ID DE UN PRODUCTO, DEVUELVE TODOS LOS COMENTARIOS PARA ESE PRODUCTO
	public function getComentarios($id){
		$res = $this->con->query("SELECT * FROM comentario WHERE id_producto = '{$id}' ");
		$resultado = array();
		while( $fila = $res->fetch_assoc() ){
				$resultado[] = $fila;
		}
	return $resultado;
	}
	
	//INSERTA UN COMENTARIO A LA TABLA CON LOS PARAMETROS $texto, $id_producto, $id_user
	public function setComentario($texto, $id_producto, $id_user){
		$this->con->query(
		"INSERT INTO comentario 
		(`contenido`, `id_producto`, `id_usuario`) 
		VALUES ('{$texto}','{$id_producto}','{$id_user}')"
		);
	}
	//INSERTA UN PRODUCTO CON FECHA ACTUAL
	public function setProducto($titulo, $descripcion, $id_categoria, $imagen, $id_usuario){
		$date = date('Y/m/d', time());								//FECHA ACTUAL
		$date2 = date('Y-m-d', strtotime($date . " + 30 days")); 	//CREA FECHA FIN 
		
		$this->con->query(
		"INSERT INTO producto 
		(`titulo`, `descripcion`, `id_categoria`, `foto`, `id_usuario`, `fecha_ini`, `fecha_fin`) 
		VALUES ('{$titulo}','{$descripcion}','{$id_categoria}','{$imagen}','{$id_usuario}','{$date}','{$date2}')"
		);
	return $this->con->insert_id;
	}
	
	//Verifica que el nombre de usuario no esté en la base de datos.
	public function usuarioNoExiste($username){
		$resul=$this->con->query(
			"SELECT * FROM usuario WHERE user = '{$username}' "
		);
		if ($resul->num_rows == 0){
			return true;
		}
		else{
			return false;
		}		
	}
	
	//Crea un usuario nuevo siempre y cuando no exista el username en la base de datos.
	public function crearUsuarioNuevo($nombre, $apellido, $dni, $numTarjeta, $nombre_usuario, $mail, $contra){
		
		if ($this->usuarioNoExiste($nombre_usuario)){
			if($this->con->query("INSERT INTO `usuario` (`nombre`, `apellido`, `documento`, `user`, `pass`, `email`, `tarjeta_credito`) VALUES ('{$nombre}', '{$apellido}', '{$dni}', '{$nombre_usuario}', '{$contra}', '{$mail}', '{$numTarjeta}')")
			){
			$respuesta = "Se creo el usuario exitosamente";	
			}
			else{
			$respuesta = "Error al crear usuario [DB ERROR]";
			}
		}
		else {
			$respuesta = "El nombre de usuario elegido ya existe";
		}
	return $respuesta;
	}
	
}
	
	
	
?>
