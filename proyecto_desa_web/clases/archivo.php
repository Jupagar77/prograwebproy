<?php

class archivo {
     private $nombre;
    private $descripcion;
    private $clasificacion;
    private $autor;
    private $url;
    
    function archivo($nombre,$descripcion, $clasificacion,$autor,$url) {
        $this->nombre=$nombre;
        $this->autor=$autor;
        $this->descripcion = $descripcion;
        $this->clasificacion = $clasificacion;
        $this->url = $url;
    }
    function toString(){
        $cadena=$this->nombre."*".$this->autor."*".$this->clasificacion."*".$this->descripcion."\n";
        return $cadena; 
    }
    function getNombre() {
        return $this->nombre;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

        function getUrl() {
        return $this->url;
    }

    function setUrl($url) {
        $this->url = $url;
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
