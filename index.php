<?php
require_once "Pagination.php";
require_once "Model/Lead.php";
require_once "GroupsItems.php";
use App\Models\Lead;
use App\Pagination;


use App\GroupsItems;

$Lead=new Lead();
$Pagination = new Pagination();
  if (isset($_POST['groupe'])) {

      $groupe = (int)strip_tags($_POST['groupe']);
      $Groupe= new GroupsItems($groupe,$Pagination->getTotalPage());
  }elseif (isset($_GET['groupe'])){
      $groupe = (int)strip_tags($_GET['groupe']);
      $Groupe= new GroupsItems($groupe,$Pagination->getTotalPage());
  }
  else{
      $Groupe= new GroupsItems(1,$Pagination->getTotalPage());
  }





include_once "page.php";