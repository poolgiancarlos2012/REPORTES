<?php
class dto_usuario{
	private $idusuario;
	private $usuario;
	private $clave;
	private $idperfil;
	private $idestado;

	public function setIdusuario($valor){
		$this->idusuario=$valor;
	}
	public function getIdusuario(){
		return $this->idusuario;
	}

	public function setUsuario($valor){
		$this->usuario=$valor;
	}
	public function getUsuario(){
		return $this->usuario;
	}

	public function setClave($valor){
		$this->clave=$valor;
	}
	public function getClave(){
		return $this->clave;
	}

	public function setIdperfil($valor){
		$this->idperfil=$valor;
	}
	public function getIdperfil(){
		return $this->idperfil;
	}

	public function setIdestado($valor){
		$this->idestado=$valor;
	}
	public function getIdestado(){
		return $this->idestado;
	}

}
?>