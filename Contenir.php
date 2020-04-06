<?php

class Contenir
{

    private $_fk_recette;
    private $_fk_ingredient;
    private $_quantite;

    //CONSTRUCTEUR
    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    //Fonction hydratation (pour donner des valeurs aux attributs)
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);
        }
        if (method_exists($this, $method)) {
            $this->$method($value);
        }
    }

    //GETTER
    public function fk_recette(){
        return $this->_fk_recette;
    }

    public function fk_ingredient(){
        return $this->_fk_ingredient;
    }

    public function quantite(){
        return $this->_quantite;
    }

    //SETTER 
    public function setFk_recette($id)
    {
        $id = (int) $id;

        if ($id > 0) {
            $this->_fk_recette = $id;
        }
    }

    public function setFk_ingredient($id)
    {
        $id = (int) $id;

        if ($id > 0) {
            $this->_fk_ingredient = $id;
        }
    }

    public function setQuantite($quantite){
        $this->_qte = $quantite;
    }

}