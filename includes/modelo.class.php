<?php

class Modelo {
	
	private static $instancia;
	
	private static $user = 'root';
	private static $pass = '';
	private static $host = '127.0.0.1';
	private static $dbnm = 'bestnid';
	
	private $con;
	
	private $order = 'fecha_ini';
	
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
		return ' ORDER BY ' . $this->order;
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
		
		
}
	
	
	
?>
