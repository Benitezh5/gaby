<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class clienteC extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model("clienteM");

	}

	public function index(){
		$data= array("title" => "title || ajax");
		$this->load->view("template/header", $data);
		$this->load->view("clienteV");
		$this->load->view("template/footer");
	}

	public function get_cliente(){
		$respuesta = $this->clienteM->get_cliente();
		echo json_encode($respuesta);
	}

	public function eliminar(){
		$id= $this->input->post("id");
		$respuesta=$this->clienteM->eliminar($id);
		echo json_encode($respuesta);
	}

	public function get_suscripcion(){

		$respuesta=$this->clienteM->get_suscripcion();
		echo json_encode($respuesta);
	}

	public function get_genero(){

		$respuesta=$this->clienteM->get_genero();
		echo json_encode($respuesta);
	}

	public function ingresar(){
		$datos["nombre"]= $this->input->post("nombre");
		$datos["apellido"]= $this->input->post("apellido");
		$datos["suscripcion"]= $this->input->post("suscripcion");
		$datos["genero"]= $this->input->post("genero");
		$respuesta = $this->clienteM->set_cliente($datos);
		echo json_encode($respuesta);
	}


	public function get_datos(){
		$id= $this->input->post("id");
		$respuesta=$this->clienteM->get_datos($id);
		echo json_encode($respuesta);
	}


	public function actualizar(){
		$datos["id_cliente"]= $this->input->post("id_cliente");
		$datos["nombre"]= $this->input->post("nombre");
		$datos["apellido"]= $this->input->post("apellido");
		$datos["suscripcion"]= $this->input->post("suscripcion");
		$datos["genero"]= $this->input->post("genero");
		$respuesta = $this->clienteM->actualizar($datos);
		echo json_encode($respuesta);
	}


	
}
