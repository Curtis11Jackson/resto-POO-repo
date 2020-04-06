<?php

class ContenirRepository
{

    private $db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    //SETTER
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }

    //méthodes
    public function add(Contenir $contenir)
    {
        $q = $this->_db->prepare("INSERT INTO contenir(fk_ingredient, fk_recette, quantite) VALUES (:ingredient, :recette, :quantite)");
        $q->execute(array(
            'ingredient' => $contenir->fk_ingredient(),
            'recette' => $contenir->fk_recette(),
            'quantite' => $contenir->quantite()
        ));
    }

    public function delete($idrecette, $idingredient)
    {
        //On supprime une ligne de la table contenir
        // en fonction des 2 foreign key qui ensemble
        // remplissent le même rôle qu'une clé primaire
        // identifier une entrée de la table
        if(is_int($idingredient) && is_int($idrecette)){
        $this->_db->exec("DELETE FROM contenir 
        WHERE fk_ing=$idingredient AND fk_rec=$idrecette");
        }
    }

    
    public function update(Contenir $contenir)
    {    
            $q = $this->_db->prepare("UPDATE contenir SET fk_ingredient = :fk_ingredient, 
            fk_recette = :fk_recette, quatite=:quantite WHERE fk_ingredient=:fk_ingredient AND fk_recette=:fk_recette");
            $q->execute(array(
                'fk_recette' => $contenir->fk_ingredient(),
                'fk_ingredient' => $contenir->fk_recette(),
                'quantite' => $contenir->quantite()   
            ));
    }

    //méthode pour récupérer une ligne de la table contenir
    public function getOne($idingredient, $idrecette)
    {
        //on vérifie que les paramètres sont bien des int
        if (is_int($idingredient) && is_int($idrecette)) {
            
        }
    }

    //méthode pour récupérer tous les ingrédients d'une recette
    public function getIngByRecette()
    {
        //on vérifie que le paramètre est bien un int

    }

    //méthode pour récupérer les recettes qui ont l'ingrédient demandé
    public function getRecByIngredient()
    {
        //on vérifie que le paramètre est bien un id

    }
}