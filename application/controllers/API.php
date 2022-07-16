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
      $data = $this->db->get('status_oximetro');
      $status = $data->row()->status_oximetro;
      echo $status;
    }

    function getAllData_get() {
      $data = $this->db->get('status_oximetro')->result();
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

        // Cambiamos el estado del oximetro para que ya no registre mas datos
        $this->db->where('id', 1);
        $this->db->update('status_oximetro', array('status_oximetro' => 0));
      } else{
        $registro = false;
      }

      if ($registro) {
        echo "Se guardo correctamente!";
      } else {
        echo "Error al guardar los datos";
      }
    }

  }
