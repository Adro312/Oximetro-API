<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use RestServer\RestController;
require APPPATH . '/libraries/RestController.php';
require APPPATH . '/libraries/Format.php';


class API extends RestController {

    function getStatus_get()
    {
      // Obtenemos el estado del oximetro para saber si comienza a escanear o no
      $data = $this->db->where_in('id', 1);
      $data = $this->db->get('oximetro_status');
      $status = $data->row()->scan_status;
      echo $status;
    }

    function changeStatus_get() 
    {
      $this->db->where('id', 1);
      $resp = $this->db->update('oximetro_status', array('oximetro_status' => 1));
      $msg = $resp ? "OK" : "ERROR"; 
      $array = array(
        "status" => $msg
      );
      echo json_encode($array);
    }

    function getRegister_get() 
    {
      $query_id = $this->db->where_in('id', 1);
      $query_id = $this->db->get('ultimo_registro');
      $last_id = $query_id->row()->ultimo_registro;

      $query_get = $this->db->where_in('id', $last_id);
      $query_get = $this->db->get('registros');
      $datos = $query_get->result();

      echo json_encode($datos);
    }

    function getAllData_get() 
    {
      $data = $this->db->get('registros')->result();
      echo json_encode($data);
    }

    function saveData_post()
    {
      // Obtenemos datos de los sensores
      $this->form_validation->set_data($this->post());
      $h = $this->post("humedad");
      $t = $this->post("temperatura");

      // Verificamos que si este recibiendo datos
      if ( $h != "" && $t != "" ) {
        // Estructuramos los datos para guardarlos
        $data = array(
          'dht11_temperatura' => $t,
          'dht11_humedad' => $h
        );

        // Insertamos los datos en la tabla
        $registro = $this->db->insert("registros", $data);

        // Actualizamos el ultimo Id registrado
        $last_id = $this->db->insert_id();
        $this->db->where('id', 1);
        $this->db->update('ultimo_registro', array('ultimo_registro' => $last_id));

        // Cambiamos el estado del oximetro para que ya no registre mas datos
        $this->db->where('id', 1);
        $this->db->update('status_oximetro', array('status_oximetro' => 0));
      } else{
        $registro = false;
      }

      if ($registro) {
        $repsuesta = array(
          "status" => 1,
          "msg" => "Se guardo correctamente!"
        );
        echo json_encode($repsuesta);
      } else {
        $repsuesta = array(
          "status" => 0,
          "msg" => "Error al guardar los datos"
        );
        echo json_encode($repsuesta);
      }
    }

  }
