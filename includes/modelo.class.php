<?php

class Modelo {

/* ESTADOS DE LAS SUBASTAS:
	0=ACTIVA
	1=TERMINADA
	2=FALTA ELEGIR GANADOR
	3=CANCELADA 
*/
	
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
	
	public function update(){
		date_default_timezone_set('America/Argentina/Buenos_Aires'); 
		$date = date('Y/m/d', time());
		$this->con->query("UPDATE `producto` SET `estado`= 2 WHERE fecha_fin < '{$date}' AND estado = 0");
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
	
		//DADA LA ID DE UN PRODUCTO, DEVUELVE TODOS LOS COMENTARIOS PARA ESE PRODUCTO
	public function getNombreCategoria($id){
		$res = $this->con->query("SELECT * FROM categoria WHERE id = '{$id}' ");
		$fila = array();
		$fila[] = $res->fetch_assoc() ;
		$resultado = $fila[0]['nombre'];
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
	public function setProducto($titulo, $descripcion, $id_categoria, $imagen, $id_usuario, $duracion){
	
		date_default_timezone_set('America/Argentina/Buenos_Aires'); 
		
		$date = date('Y/m/d', time());								//FECHA ACTUAL
		$date2 = date('Y-m-d', strtotime($date . " + {$duracion} days")); 	//CREA FECHA FIN 
		
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
	
	public function setRespuesta($respuesta,$idcomentario){
		$this->con->query("UPDATE `comentario` SET `respuesta`= '{$respuesta}' WHERE id = '{$idcomentario}'");
	}
	
	public function DiasRestantes($date){
		date_default_timezone_set('America/Argentina/Buenos_Aires'); 
		
		$currentdate = date('Y/m/d',time());
		
		$diff = abs(strtotime($date) - strtotime($currentdate));

		$days = floor(($diff / (60*60*24)));

 	return $days;
	}
	
	public function DiasDesdeHasta($date1,$date2){
		date_default_timezone_set('America/Argentina/Buenos_Aires'); 
		
		$diff = abs(strtotime($date1) - strtotime($date2));

		$days = floor(($diff / (60*60*24)));
		
 	return $days;
	}
	
	public function getProductsOfUser($id){
		$res = $this->con->query("SELECT * FROM producto WHERE id_usuario = '{$id}' ".$this->order());
		
		$resultado = array();
		while( $fila = $res->fetch_assoc() ){
			$resultado[] = $fila;
		}
		return $resultado;
		
	}
	
	public function updateProducto($id,$titulo,$descripcion,$idcategoria){
		$this->con->query("UPDATE `producto` SET `titulo`= '{$titulo}', `descripcion`= '{$descripcion}', `id_categoria`= '{$idcategoria}' WHERE id = '{$id}' ");
	}
	public function updateProductoConFoto($id,$titulo,$descripcion,$idcategoria,$foto){
		$this->con->query("UPDATE `producto` SET `titulo`= '{$titulo}', `descripcion`= '{$descripcion}', `id_categoria`= '{$idcategoria}', `foto`= '{$foto}' WHERE id = '{$id}' ");
	}
	
	public function getUser($id){
		$res = $this->con->query("SELECT * FROM usuario WHERE id = '{$id}' ");
		$fila = array();
		$fila[] = $res->fetch_assoc() ;
		$resultado = $fila[0];
		return $resultado;
	}
	
	public function getCreados($desde,$hasta){
		$desde = date('Y-m-d',$desde);
		$hasta = date('Y-m-d',$hasta);		
		$res = $this->con->query("SELECT * FROM producto WHERE fecha_ini > '{$desde}' AND fecha_ini < '{$hasta}' ");
		return $res->num_rows;
	}
	
	public function getFinalizados($desde,$hasta){
		$desde = date('Y-m-d',$desde);
		$hasta = date('Y-m-d',$hasta);		
		$res = $this->con->query("SELECT * FROM producto WHERE fecha_fin > '{$desde}' AND fecha_fin < '{$hasta}' AND estado <> 0");
		$ret = array();
		while($ofe=$res->fetch_assoc()){			
			$ret[]=$ofe;
		}
		$finalizados=0;$vencidos=0;$cancelados=0;
		foreach($ret as $a){
			switch($a['estado']){
				case 1: $finalizados = $finalizados +1; break;
				case 2: $vencidos = $vencidos +1; break;
				case 3: $cancelados = $cancelados+ 1; break;
			}
		}
		$resultado['finalizados'] = $finalizados;
		$resultado['vencidos'] = $vencidos;
		$resultado['cancelados'] = $cancelados;
		
		return $resultado;
	}
	
	
	public function getOferta($id){
		$res = $this->con->query("SELECT * FROM venta WHERE id = '{$id}' ");
		$fila = $res->fetch_assoc();
		return $fila;
	}
	
	public function setOferta( $id_usuario, $id_producto, $monto, $motivo ){
	
		$this->con->query(
			"INSERT INTO `venta`(`id`, `id_usuario`, `id_producto`, `monto`, `motivo`) VALUES (NULL,'{$id_usuario}','{$id_producto}','{$monto}','{$motivo}')"
		);
	return $this->con->insert_id;
	}
	
	public function hasOferta( $id_producto ){
	
		$q = $this->con->query(
			"SELECT * FROM venta WHERE id_usuario = '{$_SESSION['id']}' AND id_producto = '{$id_producto}' "
		);

		return ( $q->num_rows > 0 );
	}
	
	public function getMisOfertas(){
		$res = $this->con->query("SELECT v.motivo, p.titulo, p.foto, p.id, v.monto FROM venta v INNER JOIN producto p ON p.id = v.id_producto WHERE v.id_usuario = '{$_SESSION['id']}'");
		$ret = array();
		while($ofe=$res->fetch_assoc()){			
			$ret[]=$ofe;
		}
		return $ret;
	}

	public function finalizarProducto($id){
		$this->con->query("UPDATE `producto` SET `estado`= '1' WHERE id = '{$id}'");
	}
	
	public function setGanador( $id_producto, $id_user_ganador ){
		$this->con->query("UPDATE `producto` SET `id_user_ganador`= '{$id_user_ganador}' WHERE id = '{$id_producto}' ");
	}

	
	public function getOfertasOfProduct($id){
		$res = $this->con->query("SELECT * FROM venta WHERE id_producto = '{$id}'");
		
		$resultado = array();
		while( $fila = $res->fetch_assoc() ){
			$resultado[] = $fila;
		}
		return $resultado;
		
	}

	public function cancelarProducto($idprod){
		$this->con->query("UPDATE `producto` SET `estado`= '3' WHERE id = '{$idprod}' ");
	}
	
}
	
	
	
?>
