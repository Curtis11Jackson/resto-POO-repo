<?php

class RecetteRepository
{
    //caractérisé par la connexion à la base de données
    private $_db; //va être instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }

    //SETTER
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }

    public function add(Recette $rec)
    {
        //prepare une requete d'ajout de recette
        $q = $this->_db->prepare("INSERT INTO recette(nom_recette) VALUES (:nom)");
        //execute la requette avec un tableau d'association  
        $q->execute(array(
            'nom' => $rec->nom_recette()
        ));
        // On hydrate l'objet afin que son id deviennt l'id qui vient 
        //d'être créé
        $rec->hydrate(array(
            'id_ingredient' => $this->_db->lastInsertId()
        ));
    }

    public function get($id)
    {
        if (is_int($id)) {
            //on prépare la requete SELECT
            $req = $this->_db->query("SELECT * FROM recette
        WHERE id_recette = $id");
            // On récupère le résultat dans un tableau
            $donnees = $req->fetch();
            // on retourne un nouvel objet Recette construit
            //avec les donnees récupérer de la BDD
            return new Recette($donnees);
        }
    }

    public function delete($rec)
    {
        // execute une requete DELETE pour supprimer une recette avec son id
        $this->_db->exec("DELETE FROM recette WHERE id_recette=" . $rec->id_recette());
    }

    public function update($rec)
    {
        //prepare une requete UPDATE de recette par rapport à son ID
        $q = $this->_db->prepare("UPDATE recette SET nom_rec = :nom");
        //execute la requette avec un tableau d'association
        $q->execute(array(
            'nom' => $rec->nom_recette()
        ));
    }

    public function getListName()
    {
        //execute une requete SELECT qui récupère uniquement les noms de chaque recette
        $req = $this->_db->query("SELECT * FROM recette");
        //  transformer le résultat en array 
        $donnees = $req->fetch();
        // retourner cet array
        return $donnees;
    }
}