<?php

class App {

  protected $controller = 'Web', $method = 'index', $params = [];
  
  // contructor
  public function __construct()
  {
    $url = $this->parseURL();

    // controller
    if( file_exists('../app/controllers/' . ucfirst($url[0]) . '.php')) {
      $this->controller = $url[0];
      unset($url[0]);
    }

    require_once '../app/controllers/' . ucfirst($this->controller) . '.php';
    // make object
    $this->controller = new $this->controller;

    // method
    if( isset($url[1]) && method_exists($this->controller, $url[1]) ) {
      $this->method = $url[1];
      unset($url[1]);
    }

    // params
    if( !empty($url) ) {
      $this->params = array_values($url);
    }

    // jalankan controller & method, serta kirimkan params jika ada
    call_user_func_array([$this->controller, $this->method], $this->params);

  }

  // method
  public function parseURL() {
    if (isset($_GET['url'])) {
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      return $url;
    } 
    else {
      $url[] = 'Web';
      return $url;
    }
  }

}