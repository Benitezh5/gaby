<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class clienteM extends CI_Model {

	public function get_cliente(){
		$pa_consultar="CALL pa_consultar()";
		$query=$this->db->query($pa_consultar);
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function eliminar($id){
		$pa_eliminar="CALL pa_eliminar(?)";
		$arreglo= array("id_cliente"=> $id);
		$query=$this->db->query($pa_eliminar, $arreglo);
		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function get_suscripcion(){
		$exe=$this->db->get("suscripcion");
		return $exe->result();
	}

	public function get_genero(){
		$exe=$this->db->get("genero");
		return $exe->result();
	}

	public function set_cliente($datos){
		$pa_ingresar="CALL pa_insertar(?,?,?,?)";
		$arreglo= array("nombre" => $datos["nombre"],
			"apellido" => $datos["apellido"],
			"id_suscripcion" => $datos["suscripcion"],
			"id_genero" => $datos["genero"]);
		$query=$this->db->query($pa_ingresar, $arreglo);
		if($query!==null){
			return "add";
		}else{
			return false;
		}
	}

	public function get_datos($id){
		$pa_consultarporid="CALL pa_consultarporid(?)";
		$arreglo = array("id_cliente" =>$id);
		$query = $this->db->query($pa_consultarporid, $arreglo);
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
	}

	public function actualizar($datos){
		$pa_actualizar="CALL pa_actualizar(?,?,?,?,?)";
		$arreglo = array("id_cliente" => $datos["id_cliente"],
			"nombre" => $datos["nombre"],
			"apellido" => $datos["apellido"],
			"id_suscripcion" => $datos["suscripcion"],
			"id_genero" => $datos["genero"]);
		$query= $this->db->query($pa_actualizar, $arreglo);
		if($query){
			return "edi";
		}else{
			return false;
		}
	}



}
