<?php

// une classe concentrée sur l'interaction avec la base de données
class IngredientRepository
{
    // déclation attribut
    private $_db; //va être instance de PDO

    //CONSTRUCTEUR pas besoin d'un hydrate, il n'y a qu'un seul attribut
    public function __construct($db)
    {
        $this->setDb($db);
    }

    //SETTER
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }

    //méthodes pour faire un CRUD
    //méthode afin d'ajouter un ingredient dans la BDD
    public function add(Ingredient $ing)
    {
        // On prépare la requete afin de créer un ingrédient dans la bdd, 
        // on renseigne uniquement le nom, l'id étant généré automatiquement
        // en auto incrémentation
        $request = $this->_db->prepare("INSERT INTO ingredient(nom_ingredient) VALUES (:nom)");
        $request->execute(array(
            'nom' => $ing->nom_ingredient()
        ));
        // On hydrate l'objet afin que son id deviennt l'id qui vient 
        //d'être créé
        $ing->hydrate(array(
            'id_ingredient' => $this->_db->lastInsertId()
        ));
    }

    public function delete(Ingredient $ing)
    {
        //on execute une requete grace a notre objet PDO 
        // contenu dans l'attribut $_db
        $this->_db->exec("DELETE FROM ingredient WHERE id_ingredient=" . $ing->id_ingredient());
    }

    //création du 'read'
    public function get($id)
    {
        //on vérifie que le paramètre est bien un id
        if (is_int($id)) {
            //on prépare la requete SELECT
            $request = $this->_db->query("SELECT * FROM ingredient
        WHERE id_ing = $id");
            // On récupère le résultat dans un tableau
            $donnees = $request->fetch();
            // on retourne un nouvel objet Ingredient construit
            //avec les donnees récupérer de la BDD
            return new Ingredient($donnees);
        }
    }

    public function update(Ingredient $ing)
    {
        // On prépare la requete afin de modifier un ingrédient dans 
        // la BDD, puis on execute en injectant 
        // l'attribut $_nom de l'objet $ing
        $request = $this->_db->prepare("UPDATE ingredient SET nom_ingredient = :nom");
        $request->execute(array(
            'nom' => $ing->nom_ingredient()
        ));
    }
}