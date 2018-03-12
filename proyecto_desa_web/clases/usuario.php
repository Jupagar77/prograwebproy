<?php

class usuario {

    //$data["nombre"] && $data["trabajo"] && $data["celular"] && $data["email"] && $data["direccion"]
    private $nombre;
    private $trabajo;
    private $celular;
    private $email;
    private $direccion;
    private $password;

    function __construct($nombre, $trabajo, $celular, $email, $direccion, $password) {
        $this->nombre = $nombre;
        $this->trabajo = $trabajo;
        $this->celular = $celular;
        $this->email = $email;
        $this->direccion = $direccion;
        $this->password = $password;
    }

    function toString() {
        $cadena = $this->nombre . "*" . $this->trabajo. "*" . $this->celular. "*" . $this->email. "*" . $this->password. "*" . $this->direccion . "\n";
        return $cadena;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTrabajo() {
        return $this->trabajo;
    }

    function getCelular() {
        return $this->celular;
    }

    function getEmail() {
        return $this->email;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getPassword() {
        return $this->password;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setTrabajo($trabajo) {
        $this->trabajo = $trabajo;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setPassword($password) {
        $this->password = $password;
    }

}
