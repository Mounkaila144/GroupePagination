<?php
namespace App\Models;
require_once "Model/Model.php";

use App\Model\Model;

/**
 * Modèle pour la table "annonces"
 */
class Lead extends Model
{
    protected $id;

    protected $nom;

    public function __construct()
    {
        $this->table = 'lead';
    }

    /**
     * Obtenir la valeur de id
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * Définir la valeur de id
     *
     * @return  self
     */
    public function setId(int $id):self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Obtenir la valeur de nom
     */
    public function getNom():string
    {
        return $this->nom;
    }

    /**
     * Définir la valeur de nom
     *
     * @return  self
     */
    public function setNom(string $nom):self
    {
        $this->nom = $nom;

        return $this;
    }

}