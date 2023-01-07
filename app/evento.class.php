<?php
    //MEMORY - Clase Evento
    //Sebastian RJ
    //07-01-2023

class evento
{
    private $fecha;
    private $descripcion;
    private $visible;

	/**
	 * @return mixed
	 */
	public function getFecha() {
		return $this->fecha;
	}
	
	/**
	 * @param mixed $fecha 
	 * @return self
	 */
	public function setFecha($fecha): self {
		$this->fecha = $fecha;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getDescripcion() {
		return $this->descripcion;
	}
	
	/**
	 * @param mixed $descripcion 
	 * @return self
	 */
	public function setDescripcion($descripcion): self {
		$this->descripcion = $descripcion;
		return $this;
	}

    public function __construct($fecha,$descripcion)
    {
        $this->fecha = $fecha;
        $this->descripcion = $descripcion;
    }
    public function visible($fecha){
        if($fecha>time()){
                return false;
        }else{
            return true;
        }
       }
}
?>