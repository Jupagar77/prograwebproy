<?php

class archivo {
    private $fecha;
    private $tamano;
    private $descripcion;
    private $clasificacion;
    private $autor;
    
    function archivo($fecha, $tamano, $descripcion, $clasificacion,$autor) {
        $this->autor=$autor;
        $this->feha = $fecha;
        $this->tamano = $tamano;
        $this->descripcion = $descripcion;
        $this->clasificacion = $clasificacion;
    }
    function toString(){
        $cadena=$this->autor."*".$this->fecha."*".$this->tamano."*".$this->descripcion."*".$this->clasificacion."\n";
        return $cadena; 
    }
    function getFecha() {
        return $this->fecha;
    }

    function getTamano() {
        return $this->tamano;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getClasificacion() {
        return $this->clasificacion;
    }

    function getAutor() {
        return $this->autor;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setTamano($tamano) {
        $this->tamano = $tamano;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setClasificacion($clasificacion) {
        $this->clasificacion = $clasificacion;
    }

    function setAutor($autor) {
        $this->autor = $autor;
    }



}
