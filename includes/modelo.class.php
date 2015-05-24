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
	
	
	public function verifyUser($user,$pass){
		$res = $this->con->query("SELECT pass FROM usuario WHERE usuario = {$user}");
		if($res->num_rows){
			$user = $res->fetch_assoc();
			if( $user['pass'] == $pass ) return true;
		}
		return false;		
	}
	
}