<?php 

    // MEMORY - CLASE PARTIDA
    // SEBASTIAN RJ
    // 13/12/2022

class partida{

    private $nombreJ;
    private $dificultad;
    private $tema;
    private $cartas;
    private $carta1;
    private $carta2;
    private $ptosJ;
    private $tiempoI;
    private $partidaGanada;
    private $parejaR;
    private $levantadas;

    public function getNombreJ(){
        return $this->nombreJ;
    }
    public function setNombreJ($nombreJ){
        $this->nombreJ = $nombreJ;
        return $this;
    }
    public function getDificultad(){
        return $this->dificultad;
    }
    public function setDificultad($dificultad){
        return $this->dificultad = $dificultad;
    }
    public function getTema(){
        return $this->tema;
    }
    public function setTema($tema){
       return $this->tema=$tema;
    }
    public function getCartas(){
        return $this->cartas;
    }
    public function setCartas($cartas){
         return $this->cartas = $cartas;
    }
    public function getCarta1(){
        return $this->carta1;
    }
    public function setCarta1($carta1){
         return $this->carta1 = $carta1;
    }
    public function getCarta2(){
        return $this->carta2;
    }
    public function setCarta2($carta2){
         return $this->carta2 = $carta2;
    }
    public function getPtosJ(){
        return $this->ptosJ;
    }
    public function setPtosJ($ptosJ){
        return $this->ptosJ = $ptosJ;
    }
    public function getTiempoI(){
        return $this->tiempoI;
    }
    public function setTiempoI($tiempoI){
        return $this->tiempoI = $tiempoI; 
    }
    public function getPartidaGanada(){
        return $this->partidaGanada;
    }
    public function setPartidaGanada($partidaGanada){
        return $this->partidaGanada = $partidaGanada;
    }
    public function getParejaR(){
        return $this->parejaR;
    }
    public function setParejaR($parejaR){
         $this->parejaR = $parejaR;
    }
    public function getLevantadas(){
        return $this->levantadas;
    }
    public function setLevantadas($levantadas){
        $this->levantadas=$levantadas;
        
    }

    public function __construct($nombreJ,$dificultad,$tema,$cartas,$ptosJ,$tiempoI,$partidaGanada,$parejaR){
        $this->nombreJ=$nombreJ;
        $this->dificultad=$dificultad;
        $this->tema=$tema;
        $this->cartas=$cartas;
        $this->ptosJ=$ptosJ;
        $this->tiempoI=$tiempoI;
        $this->partidaGanada=$partidaGanada;
        $this->parejaR=$parejaR;
        $this->levantadas=0;
    }
    
    


}

?>