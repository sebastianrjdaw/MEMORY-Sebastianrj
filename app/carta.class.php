<?php 

 	// MEMORY - Clase carta
    // SEBASTIAN RJ
    // 13/12/2022
 class carta{
    private $id;
    private $vista;
    private $pareja;




	
	public function getPareja() {
		return $this->pareja;
	}
	
	public function setPareja($pareja) {
		$this->pareja = $pareja;
		return $this;
	}

	public function getVista() {
		return $this->vista;
	}
	
	public function setVista($vista) {
		$this->vista = $vista;
		return $this;
	}

	
	public function getId() {
		return $this->id;
	}

	
	public function setId($id) {
		$this->id = $id;
		return $this;
	}

    public function __construct($id,$vista,$pareja)
    {
        $this->id = $id;
        $this->vista = $vista;
        $this->pareja= $pareja;

    }

	public function enseñar()
	{
			$this->vista = true;
	}
	public function ocultar()
	{
			$this->vista = false;
	}
}
