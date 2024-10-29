<?php
  class Pages extends Controller{
    private $factureModel;
    public function __construct(){
      $this->factureModel = $this->model('Factures');
    }

    // Charger la page d'accueil
    public function index(){
      // Si authentification OK, rediriger vers posts
      if(isset($_SESSION['user_id'])){
        $this->view('pages/dashboard');
    } else {
        $this->view('pages/index');
    }

      //Set Data
      $data = [
        'title' => 'Dashboard',
        'description' => 'Bienvenue'
      ];
    }

    public function about(){
      //Set Data
      $data = [
        'version' => '1.0.0'
      ];

      // charger la vue 'A propos'
      $this->view('pages/about', $data);
    }

    public function dashboard()
    {
      $data = [
        'totalFactures' => $this->factureModel->getTotalFactures(),
        'montantTotal' => $this->factureModel->getMontantTotal(),
        'facturesPayees' => $this->factureModel->getFacturesPayees(),
        'facturesFacturees' => $this->factureModel->getFacturesFacturees(),
        'facturesAnnulees' =>$this->factureModel->getFacturesAnnulees(),
      ];
      $this->view('pages/dashboard', $data);
    }
  }