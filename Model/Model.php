<?php
namespace App\Model;
require_once "Db/Db.php";

use App\Db\Db;
use PDOStatement;

class Model extends Db
{
    // Table de la base de données
    protected $nom;

    // Instance de connexion
    private $db;
    /**
     * Méthode qui exécutera les requêtes
     * @param string $sql Requête SQL à exécuter
     * @param array $attributes Attributs à ajouter à la requête
     * @return PDOStatement|false
     */
    public function requete(string $sql, array $attributs = null)
    {
        // On récupère l'instance de Db
        $this->db = Db::getInstance();

        // On vérifie si on a des attributs
        if($attributs !== null){
            // Requête préparée
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        }else{
            // Requête simple
            return $this->db->query($sql);
        }
    }
    /**
     * Sélection de tous les enregistrements d'une table
     * @return array Tableau des enregistrements trouvés
     */
    public function findAll(int $min,int $max,$premier,$parPage)
    {
        $query = $this->requete("SELECT * FROM $this->table WHERE id BETWEEN $min AND $max  ORDER BY `id` ASC LIMIT $premier, $parPage");
        return $query->fetchAll();
    }
    /**
     * Sélection de tous les enregistrements d'une table
     * @return array Tableau des enregistrements trouvés
     */
    public function CountAll()
    {
        $query = $this->requete("SELECT  COUNT(*) AS nb_lead  FROM $this->table");
        return $query->fetch()["nb_lead"];
    }
     public function CountAllByGroupe(int $min,int $max)
    {
        $query = $this->requete("SELECT  COUNT(*) AS nb_lead  FROM $this->table WHERE id BETWEEN $min AND $max");
        return $query->fetch()["nb_lead"];
    }

    /**
     * Sélection d'un enregistrement suivant son id
     * @param int $id id de l'enregistrement
     * @return array Tableau contenant l'enregistrement trouvé
     */
    public function getFistLead()
    {
        // On exécute la requête
        return $this->requete("SELECT id FROM {$this->table} ORDER BY id ASC LIMIT 1")->fetch();
    }
    public function getLastLead()
    {
        // On exécute la requête
        return $this->requete("SELECT id FROM {$this->table} ORDER BY id DESC LIMIT 1")->fetch();
    }

}