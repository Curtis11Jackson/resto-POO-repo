<?php

class Ingredient
{
    //définir les attributs
    private $_id_ingredient;
    private $_nom_ingredient;

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
    public function id_ingredient()
    {
        //retourne l'id de l'ingrédient
        return $this->_id_ingredient;
    }

    public function nom_ingredient()
    {
        //retourne le nom de l'ingrédient
        return $this->_nom_ingredient;
    }

    //SETTER
    public function setid_ingredient($id)
    {
        $id = (int) $id;

        if ($id > 0) {
            $this->_id_rec = $id;
        }
    }

    public function setnom_ingredient($nom)
    {
        if (is_string($nom)) {
            $this->_nom_rec = $nom;
        }
    }
}