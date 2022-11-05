<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use RestServer\RestController;
require APPPATH . '/libraries/RestController.php';
require APPPATH . '/libraries/Format.php';


class API extends RestController {

    function getStatusApp_get()
    {
      // Obtenemos el estado del oximetro para saber si comienza a escanear o no
      $data = $this->db->where_in('id', 1);
      $data = $this->db->get('oximetro_status');
      $status = $data->row()->scan_status;
      echo ($status);
    }

    function getStatusOxi_get()
    {
      // Obtenemos el estado del oximetro si esta conectado al mismo internet
      $data = $this->db->where_in('id', 1);
      $data = $this->db->get('oximetro_status');
      $status = $data->row()->oximetro_connection;
      $repsuesta = array(
        "status" => 1,
        "msg" => "OK",
        "oxi_internet_status" => $status
      );
      echo json_encode($repsuesta);
    }

    function getStatusDataSend_get()
    {
      // Obtenemos el estado del oximetro si esta enviando la informacion
      $data = $this->db->where_in('id', 1);
      $data = $this->db->get('oximetro_status');
      $status = $data->row()->data_send;
      echo ($status);
    }

    function changeStatusApp_get() 
    {
      // Cambiamos el status para que comience a scanear
      $this->db->where('id', 1);
      $resp = $this->db->update('oximetro_status', array('scan_status' => 1));
      if ($resp = 1) {
        $status = 1; 
        $msg = "Status Changed";
      } else {
        $status = 0; 
        $msg = "ERROR";
      }
      $repsuesta = array(
        "status" => $status,
        "msg" => $msg
      );
      echo json_encode($repsuesta);
    }

    function changeStatusOxi_get() 
    {
      // Cambiamos el status del oximetro para que la app sepa que ya esta conectada a internet
      $this->db->where('id', 1);
      $resp = $this->db->update('oximetro_status', array('oximetro_connection' => 1));
      if ($resp = 1) {
        $status = 1; 
        $msg = "Status Changed";
      } else {
        $status = 0; 
        $msg = "ERROR";
      }
      $repsuesta = array(
        "status" => $status,
        "msg" => $msg
      );
      echo json_encode($repsuesta);
    }

    function changeStatusDataSend_get() 
    {
      // Cambiamos el status del oximetro para que la app sepa que ya se envio la informacion
      $this->db->where('id', 1);
      $resp = $this->db->update('oximetro_status', array('data_send' => 1));
      if ($resp = 1) {
        $status = 1; 
        $msg = "Status Changed";
      } else {
        $status = 0; 
        $msg = "ERROR";
      }
      $repsuesta = array(
        "status" => $status,
        "msg" => $msg
      );
      echo json_encode($repsuesta);
    }

    function changeStatusDataSendTo0_get() 
    {
      // Cambiamos el status del oximetro para que la app sepa que ya esta en 0 para nuevos regsitros
      $this->db->where('id', 1);
      $resp = $this->db->update('oximetro_status', array('data_send' => 0));
      if ($resp = 1) {
        $status = 1; 
        $msg = "Status Changed";
      } else {
        $status = 0; 
        $msg = "ERROR";
      }
      $repsuesta = array(
        "status" => $status,
        "msg" => $msg
      );
      echo json_encode($repsuesta);
    }

    function changeStatusOxiDesconect_get() 
    {
      // Cambiamos el status del oximetro para que la app sepa que ya NO esta conectada a internet
      $this->db->where('id', 1);
      $resp = $this->db->update('oximetro_status', array('oximetro_connection' => 0));
      if ($resp = 1) {
        $status = 1; 
        $msg = "Status Changed";
      } else {
        $status = 0; 
        $msg = "ERROR";
      }
      $repsuesta = array(
        "status" => $status,
        "msg" => $msg
      );
      echo json_encode($repsuesta);
    }

    function getLatestTwoRegister_get() 
    {
      // Obtenemoslos dos ultimos registros
      $query_get = $this->db->query("SELECT id, oxygen, heart_rate, temperature, DATE(registration_date) AS 'Date', TIME(registration_date) AS 'Hour' FROM records ORDER BY id DESC LIMIT 2");
      $data = $query_get->result();
      $repsuesta = array(
        "status" => 1,
        "msg" => "OK",
        "data" => $data
      );
      echo json_encode($repsuesta);
    }

    function getLatestRegister_get() 
    {
      // Obtiene el ultimo registro que se hizo
      $query_get = $this->db->query("SELECT id, oxygen, heart_rate, temperature, DATE(registration_date) AS 'Date', TIME(registration_date) AS 'Hour' FROM records ORDER BY id DESC LIMIT 1");
      $data = $query_get->row();
      $repsuesta = array(
        "status" => 1,
        "msg" => "OK",
        "data" => $data
      );
      echo json_encode($repsuesta);
    }

    function getAllData_get() 
    {
      // Se obtiene todos los datos registrados
      $data = $this->db->query("SELECT id, oxygen, heart_rate, temperature, DATE(registration_date) AS 'Date', TIME(registration_date) AS 'Hour' FROM records");
      $repsuesta = array(
        "status" => 1,
        "msg" => "OK",
        "data" => $data->result()
      );
      echo json_encode($repsuesta);
    }

    function getDataByDate_post()
    {
      // Se obtiene todos los registros de un dia en especifico
      $this->form_validation->set_data($this->post());
      $date = $this->post("date");

      // Checamos que si nos de una fecha
      if($date != "") {
        // Obtenemos los datos
        $sql = "SELECT id, oxygen, heart_rate, temperature, DATE(registration_date) AS 'Date', TIME(registration_date) AS 'Hour' FROM records WHERE DATE(registration_date) = ?";
        $data = $this->db->query($sql, array($date));
        
        if($data->row() != null){
          // Si, si tiene registros de ese dia
          $repsuesta = array(
            "status" => 1,
            "msg" => "OK",
            "data" => $data->result()
          );
        } else {
          // Si no tiene registros
          $repsuesta = array(
            "status" => 1,
            "msg" => "Without Data"
          );
        }
      } else {
        // Si no envio una fecha
        $repsuesta = array(
          "status" => 0,
          "msg" => "No se recibio ningun dato"
        );
      }

      echo json_encode($repsuesta);
    }

    function saveData_post()
    {
      // Obtenemos datos de los sensores
      $this->form_validation->set_data($this->post());
      $oxi = $this->post("oxygen");
      $hr = $this->post("heart_rate");
      $temp = $this->post("temperature");

      // Verificamos que si este recibiendo datos
      if ( $oxi != "" && $hr != "" && $temp != "" ) {

        // Estructuramos los datos para guardarlos
        $data = array(
          'oxygen' => $oxi,
          'heart_rate' => $hr,
          'temperature' => $temp
        );

        // Insertamos los datos en la tabla
        $registro = $this->db->insert("records", $data);

        // Cambiamos el status para que el oximetro se detenga de registar
        $this->db->update('oximetro_status', array('scan_status' => 0));

      } else{
        $registro = false;
      }

      if ($registro) {
        // Si el query se ejecuto sin problemas
        $repsuesta = array(
          "status" => 1,
          "msg" => "Saved!"
        );
      } else {
        // Si no se puedo guardar
        $repsuesta = array(
          "status" => 0,
          "msg" => "ERROR"
        );
      }

      echo json_encode($repsuesta);
    }

  }
