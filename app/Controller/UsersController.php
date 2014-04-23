<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP UsersController
 * @author Jorge Moreno
 */
class UsersController extends AppController {
    public $components = array('RequestHandler');
    public function index()
    {
        $datos=  $this->User->find("all");
        $this->set(array(
            'datos' => $datos,
            '_serialize' => array('datos')
        ));
    }
    /**
     * Objeto devueltos
     * direccion: http://localhost/PollaMundialistaWeb/users/add.xml
     * parametros:
     * -->  nombres
     * -->  apellidos
     * -->  nick
     * -->  email
     * -->  pass
     * respuesta
     *      datos -> Id del perfil creado
     */
    public function add()
    {
          $this->layout="webservice";
          if(!empty($this->request->data))
          {
               $resul= $this->User->save($this->request->data);
               $datos= $this->User->id;
               $this->set(array(
                    'datos' => $datos,
                    '_serialize' => array('datos')
                ));
               
          }

    }
    
    /**
     * Se encarga de verificar si un usuario existe en el sistema con esos datos
     * direccion: users/login.xml
     * Parametros:
     * -->  nick
     * -->  pass
     * Respuesta
     * -->  datos
     *      -->User
     *          id
     *          nombres
     *          apellidos
     *          nick
     *          email
     *          pass
     *
     */
    public function login()
    {
//        $this->layout="webservice";
        $nick=$this->request->data['nick'];
        $pass=$this->request->data['pass'];
        $parametros=array(
            'conditions'=>array("email"=>$nick)
        );
        $datos=  $this->User->find("all",$parametros);
        $this->set(array(
            'datos' => $datos,
            '_serialize' => array('datos')
        ));
    }
    /**
     * Esta funcion se encarga de retornar la cantidad de personas en la polla,
     * la posicion del usuario en entre todas las personas y la puntuacion que 
     * el usuario lleva
     */
    public function getInformacion() {
        $idBet=$this->request->data['idBet'];
        $idUsuario=$this->request->data['idUsuario'];
    }

}
