<?php
namespace User;


class User{

    private $id_user;
    private $prenom_user;
    private $nom_user;
    private $email_user;
    private $mdp_user;
    



   
    function __construct(array $datas){ 
        foreach ($datas as $key => $value) {
            $this->$key = $value;
        }

    }

    

    

    /**
     * Get the value of id_user
     */ 
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     *
     * @return  self
     */ 
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * Get the value of prenom_user
     */ 
    public function getPrenom_user()
    {
        return $this->prenom_user;
    }

    /**
     * Set the value of prenom_user
     *
     * @return  self
     */ 
    public function setPrenom_user($prenom_user)
    {
        $this->prenom_user = $prenom_user;

        return $this;
    }

    /**
     * Get the value of nom_user
     */ 
    public function getNom_user()
    {
        return $this->nom_user;
    }

    /**
     * Set the value of nom_user
     *
     * @return  self
     */ 
    public function setNom_user($nom_user)
    {
        $this->nom_user = $nom_user;

        return $this;
    }

    /**
     * Get the value of email_user
     */ 
    public function getEmail_user()
    {
        return $this->email_user;
    }

    /**
     * Set the value of email_user
     *
     * @return  self
     */ 
    public function setEmail_user($email_user)
    {
        $this->email_user = $email_user;

        return $this;
    }

    /**
     * Get the value of mdp_user
     */ 
    public function getMdp_user()
    {
        return $this->mdp_user;
    }

    /**
     * Set the value of mdp_user
     *
     * @return  self
     */ 
    public function setMdp_user($mdp_user)
    {
        $this->mdp_user = $mdp_user;

        return $this;
    }

    /**
     * Get the value of id_user
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     */
    public function setIdUser($id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * Get the value of prenom_user
     */
    public function getPrenomUser()
    {
        return $this->prenom_user;
    }

    /**
     * Set the value of prenom_user
     */
    public function setPrenomUser($prenom_user): self
    {
        $this->prenom_user = $prenom_user;

        return $this;
    }

    /**
     * Get the value of nom_user
     */
    public function getNomUser()
    {
        return $this->nom_user;
    }

    /**
     * Set the value of nom_user
     */
    public function setNomUser($nom_user): self
    {
        $this->nom_user = $nom_user;

        return $this;
    }

    /**
     * Get the value of email_user
     */
    public function getEmailUser()
    {
        return $this->email_user;
    }

    /**
     * Set the value of email_user
     */
    public function setEmailUser($email_user): self
    {
        $this->email_user = $email_user;

        return $this;
    }

    /**
     * Get the value of mdp_user
     */
    public function getMdpUser()
    {
        return $this->mdp_user;
    }

    /**
     * Set the value of mdp_user
     */
    public function setMdpUser($mdp_user): self
    {
        $this->mdp_user = $mdp_user;

        return $this;
    }


     }