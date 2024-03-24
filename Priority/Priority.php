<?php 

namespace Priority;

class Priority {

    private $Id_Priority;
    private $Nom_Priority;


    function __construct(array $datas){

        
        foreach ($datas as $key => $value) {
            $this->$key = $value;
        }
    }


    /**
     * Get the value of id_priority
     */ 
    public function getId_priority()
    {
        return $this->Id_Priority;
    }

    /**
     * Set the value of id_priority
     *
     * @return  self
     */ 
    public function setId_priority($id_priority)
    {
        $this->Id_Priority = $id_priority;

        return $this;
    }

    /**
     * Get the value of nom_priority
     */ 
    public function getNom_priority()
    {
        return $this->Nom_Priority;
    }

    /**
     * Set the value of nom_priority
     *
     * @return  self
     */ 
    public function setNom_priority($nom_priority)
    {
        $this->Nom_Priority = $nom_priority;

        return $this;
    }
}


?>