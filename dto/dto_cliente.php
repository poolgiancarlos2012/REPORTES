<?php
class dto_cliente{
	private $idcliente;
	private $nombre;
	private $apellido;
	private $dni;
	private $telf;
	private $direccion;
	private $iddepartamento;
	private $idprovincia;
	private $iddistrito;
	private $alta;
	private $baja;
	private $idestado;

	public function setIdcliente($valor){
		$this->idcliente=$valor;
	}
	public function getIdcliente(){
		return $this->idcliente;
	}
	public function setNombre($valor){
		$this->nombre=$valor;
	}
	public function getNombre(){
		return $this->nombre;
	}
	public function setApellido($valor){
		$this->apellido=$valor;
	}
	public function getApellido(){
		return $this->apellido;
	}
	public function setDni($valor){
		$this->dni=$valor;
	}
	public function getDni(){
		return $this->dni;
	}
	public function setTelf($valor){
		$this->telf=$valor;
	}
	public function getTelf(){
		return $this->telf;
	}
	public function setDireccion($valor){
		$this->direccion=$valor;
	}
	public function getDireccion(){
		return $this->direccion;
	}
	public function setIddepartamento($valor){
		$this->iddepartamento=$valor;
	}
	public function getIddepartamento(){
		return $this->iddepartamento;
	}
	public function setIdprovincia($valor){
		$this->idprovincia=$valor;
	}
	public function getIdprovincia(){
		return $this->idprovincia;
	}
	public function setIddistrito($valor){
		$this->iddistrito=$valor;
	}
	public function getIddistrito(){
		return $this->iddistrito;
	}
	public function setAlta($valor){
		$this->alta=$valor;
	}
	public function getAlta(){
		return $this->alta;
	}
	public function setBaja($valor){
		$this->baja=$valor;
	}
	public function getBaja(){
		return $this->baja;
	}
	public function setIdestado($valor){
		$this->baja=$valor;
	}
	public function getIdestado(){
		return $this->baja;
	}
}
?>