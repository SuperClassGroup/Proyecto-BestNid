<?php

class Modelo {
	
	private static $instancia;
	
	private static $user = 'root';
	private static $pass = '';
	private static $host = '127.0.0.1';
	private static $dbnm = 'bestnid';
	
	private $con;
	
	function __construct() {
		$this->con = new mysqli(
			self::$host,
			self::$user,
			self::$pass,
			self::$dbnm);
	}
	
	public static function getInstance(){
		if (  !self::$instancia instanceof self)
		{
			self::$instancia = new self;
		}
		return self::$instancia;
	}
	
	public function getAllProducts(){
		$res = $this->con->query("SELECT * FROM producto");
		
		$resultado = array();
		while( $fila = $res->fetch_assoc() ){
			$resultado[] = $fila;
		}
		return $resultado;
		
	}
	
	public function getProductsOfCategory($idcategoria){
		$res = $this->con->query("SELECT * FROM producto WHERE id_categoria = {$idcategoria}");
		
		$resultado = array();
		while( $fila = $res->fetch_assoc() ){
			$resultado[] = $fila;
		}
		return $resultado;
		
	}
	
	public function getAllCategories(){
		$res = $this->con->query("SELECT * FROM categoria");
		
		$resultado = array();
		while( $fila = $res->fetch_assoc() ){
			$resultado[] = $fila;
		}
		return $resultado;
		
	}
	
	
	// public function verifyUser($user, $pass){
		// var_dump($user);
		// $res = $this->con->query("SELECT * FROM 'usuario' WHERE 'user' = {$user}");

		// var_dump($res);
		// if($res){
			// $user = $res->fetch_assoc();
			// if( $user['pass'] == $pass ) return true;
		// }
		// return false;		
	// } FUNCION DE VALEN PARA VERIFICAR USUARIO NO FUNCIONA, NO ENTIENDO PORQUE
	
		public function verifyUser($user, $pass){
		$res = $this->con->query("SELECT * FROM usuario");
		while( $fila = $res->fetch_assoc() ){
			if($fila['user'] == $user){
				if( $fila['pass'] == $pass ) return true;
				else{ echo("Contraseña Invalida"); return false;}
			}
		}
		echo("Usuario Invalido");
		return false;
				
	}
	
		public function getAllProductsWith($text){
			$res = $this->con->query("SELECT * FROM `producto` WHERE `titulo` LIKE '%{$text}%' OR `descripcion` LIKE '%{$text}%'");
			$resultado = array();
			while( $fila = $res->fetch_assoc() ){
					$resultado[] = $fila;
			}
		return $resultado;
		}
	}
	
?>