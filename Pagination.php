<?php

namespace App;

require_once "Model/Lead.php";

use App\Models\Lead;
use Exception;

class Pagination
{
    //Nombre d'element par page
    private $parPage = 8;

    private $min;
    private $max;
    private $minIteme;
    private $maxIteme;

    private $currentPage;

    public function __construct()
    {
        //verification si on n'a min max rt pae dans les parametre d'url
        if (isset($_GET['pagemin'], $_GET['pagemax']) && !empty($_GET['pagemin']) && !empty($_GET['pagemax'])) {
            $this->minIteme = (int)strip_tags($_GET['pagemin']);
            $this->maxIteme = (int)strip_tags($_GET['pagemax']);
            if (isset($_GET['page'])){
                $this->currentPage =(int)strip_tags($_GET['page']);
            }else{
                $this->currentPage =1;
            }

            if ((int)strip_tags($_GET['pagemin'])==1){
                $this->min = (int)strip_tags($_GET['pagemin']);
                $this->max = (int)strip_tags($_GET['pagemax'])*$this->parPage;
            }else{
                $this->min = (int)strip_tags($_GET['pagemin'])*$this->parPage;
                $this->max = (int)strip_tags($_GET['pagemax'])*$this->parPage;
            }


        } else {
            $this->minIteme =1;
            $this->maxIteme =1000;

            $this->min = 1;
            $this->max = 1000;
            $this->currentPage = 1;
        }

    }


    public function getMin(): ?int
    {
        return $this->minIteme;
    }

    public function getMax(): ?int
    {
        return $this->maxIteme;
    }

    public function getNext(): ?int
    {
        if($this->getPage()>$this->getTotalPageByGroupe()){
            throw new Exception("LA page n'exist pas");
        }else{
            return $this->getPage() + 1;
        }
    }

    public function getPreview(): ?int
    {
        if($this->getPage()<1){
            throw new Exception("LA page n'exist pas");
        }else{
            return $this->getPage() - 1;
        }
    }

    public function getPage(): ?int
    {
        if($this->currentPage<0 or $this->currentPage>$this->getTotalPageByGroupe()){
            throw new Exception("LA page n'exist pas");
        }else{
            return $this->currentPage;
        }
    }

    public function getTotalPageByGroupe()
    {
        //Nombre total de Leads en fonction de min et max
        $Lead = new Lead;
        $nb_lead = $Lead->CountAllByGroupe($this->min, $this->max);

        //nombre total de page
        $pages = ceil($nb_lead / $this->parPage);
        return $pages;
    }
    public function getTotalPage()
    {
        //Nombre total de Leads en fonction de min et max
        $Lead = new Lead;
        $nb_lead = $Lead->CountAll();

        //nombre total de page
        $pages = ceil($nb_lead / $this->parPage);
        return $pages;
    }

    public function getLeads()
    {

        $premier = ($this->getPage() * $this->parPage) - $this->parPage;

        //List des Leads en fonction de min et max et le nombre d'elment par page
        $Lead = new Lead;
        $leads = $Lead->findAll($this->min, $this->max, $premier, $this->parPage);

        return $leads;
    }

}