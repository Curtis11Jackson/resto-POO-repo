<?php

class Recette
{
    //définir les attributs
    private $_id_recette;
    private $_nom_recette;

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
    public function id_recette()
    {
        //retourne l'id de l'ingrédient
        return $this->_id_recette;
    }

    public function nom_recette()
    {
        //retourne le nom de l'ingrédient
        return $this->_nom_recette;
    }

    //SETTER
    public function setid_recette($id)
    {
        $id = (int) $id;

        if ($id > 0) {
            $this->_id_recette = $id;
        }
    }

    public function setnom_recette($nom)
    {
        if (is_string($nom)) {
            $this->_nom_recette = $nom;
        }
    }
}
