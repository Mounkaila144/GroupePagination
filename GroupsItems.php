<?php

namespace App;

use Exception;

class GroupsItems
{
    private $nb_groupe;
    private $nb_pages;
    private $currentGroupe;
    private $quotient;

    public function __construct($nb_groupe, $nb_pages)
    {
        $this->nb_groupe = $nb_groupe;
        $this->nb_pages = $nb_pages;
        $this->quotient=intdiv($this->nb_pages, $this->nb_groupe);
        if (isset($_GET['min'], $_GET['max']) && !empty($_GET['min']) && !empty($_GET['max'])) {
                $this->currentGroupe = [(int)strip_tags($_GET['min']),(int)strip_tags($_GET['max'])];
        } else {
            $this->currentGroupe = [1,$this->quotient];
        }

    }

    public function getAllGroupes()
    {
        $groupes = [];
        $rest = fmod($this->nb_pages, $this->nb_groupe);
        $quotient = $this->quotient;
        if ($rest == 0) {
            for ($i = 1; $i <= $this->nb_groupe; $i++) {
                $groupes[] = [($i - 1) * $quotient + 1, $i * $quotient];
            }
        } else {
            for ($i = 1; $i < $this->nb_groupe; $i++) {
                $groupes[] = [($i - 1) * $quotient + 1, $i * $quotient];
            }
            $groupes[] = [($this->nb_groupe - 1) * $quotient + 1, $this->nb_pages];

        }
        return $groupes;
    }

    public function getNextGroupe(): ?array
    {
        $next=[$this->getCurentGroupe()[0]+$this->quotient,$this->getCurentGroupe()[1]+$this->quotient];
        return $next;
    }

    public function getPreviewroupe(): ?array
    {

        $preview=[$this->getCurentGroupe()[0]-$this->quotient,$this->getCurentGroupe()[1]-$this->quotient];
            return $preview;
    }

    public function getCurentGroupe(): ?array
    {
        if ($this->currentGroupe[0]<=0 or $this->currentGroupe[1]>=$this->nb_pages+1){
        throw new Exception("Le groupe n'exist pas");
    }else
            return $this->currentGroupe;
    }
}