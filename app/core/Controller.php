<?php

class Controller
{
  protected $location = "Location: " . BASEURL;

  public function view($view, $data = []): void
  {
    require_once '../app/views/' . $view . '.php';
  }

  public function model($modelClass): object
  {
    require_once '../app/models/' . $modelClass . '.php';
    return new $modelClass;
  }

  public function redirect($uri)
  {
    header('Location: ' . BASEURL . $uri);
    exit;
  }
}
