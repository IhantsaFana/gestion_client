<?php
class Facture extends Controller
{
    private $factureModel;

    public function __construct()
    {
        $this->factureModel = $this->model('Factures');
    }

    public function index()
    {
        if(isset($_SESSION['user_id'])){
            $facture = $this->factureModel->read();
            $data = [
                'factures' => $facture
            ];
            $this->view('facture/index', $data);
        } else {
            redirect('');
        }
    }

    public function add()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = [
                'client' => trim($_POST['client']),
                'caissier' => trim($_POST['caissier']),
                'montant' => trim($_POST['montant']),
                'percu' => trim($_POST['percu']),
                'retourne' => trim($_POST['retourne']),
                'etat' => trim($_POST['etat']),
                'client_err' => '',
                'caissier_err' => '',
                'montant_err' => '',
                'percu_err' => '',
                'retourne_err' => '',
                'etat_err' => '',
            ];
            if (empty($data['client']))
            {
                $data['client_err'] = 'Entrer le client';
            }
            if (empty($data['client_err']))
            {
                if ($this->factureModel->add($data))
                {
                    flash('client_added', 'Facture bien ajouté');
                    redirect('facture');
                }
                else
                {
                    die('Erreur');
                }
            }
            else
            {
                $this->view('facture/add', $data);
            }
        }
        else 
        {
            $data = [
                'client' => '',
                'caissier' => '',
                'montant' => '',
                'percu' => '',
                'retourne' => '',
                'etat' => '',
                'client_err' => '',
                'caissier_err' => '',
                'montant_err' => '',
                'percu_err' => '',
                'retourne_err' => '',
                'etat_err' => '',
            ];
            $this->view('facture/add', $data);
        }
    }

    public function edit($id)
    {
        if (!$id) {
            die('Erreur : Aucun identifiant fourni.');
        }

        // Vérifier si c'est une requête POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Nettoyage des données envoyées par le formulaire
            $data = [
                'id' => $id,
                'client' => trim($_POST['client']),
                'caissier' => trim($_POST['caissier']),
                'montant' => trim($_POST['montant']),
                'percu' => trim($_POST['percu']),
                'retourne' => trim($_POST['retourne']),
                'etat' => trim($_POST['etat']),
                'client_err' => '',
                'caissier_err' => '',
                'montant_err' => '',
                'percu_err' => '',
                'retourne_err' => '',
                'etat_err' => '',
            ];
    
            // Validation des champs obligatoires
            if (empty($data['client'])) {
                $data['client_err'] = 'Entrer le client';
            }
    
            if (empty($data['caissier'])) {
                $data['caissier_err'] = 'Entrer le caissier';
            }
    
            if (empty($data['montant'])) {
                $data['montant_err'] = 'Entrer le montant';
            }
    
            // Vérifier s'il n'y a pas d'erreurs
            if (empty($data['client_err']) && empty($data['caissier_err']) && empty($data['montant_err'])) {
                // Appel du modèle pour mettre à jour la facture
                if ($this->factureModel->edit($data)) {
                    flash('facture_message', 'La facture a été mise à jour');
                    redirect('facture');
                } else {
                    die('Erreur lors de la mise à jour');
                }
            } else {
                // Si des erreurs sont présentes, recharge la vue avec les erreurs
                $this->view('facture/edit', $data);
            }
        } else {
            // Charger les données actuelles de la facture
            $facture = $this->factureModel->getFactureById($id);
    
            // Vérifier si la facture existe
            if (!$facture) {
                die('Facture non trouvée');
            }
    
            // Préparer les données à afficher dans le formulaire
            $data = [
                'id' => $facture->id,
                'client' => $facture->client,
                'caissier' => $facture->caissier,
                'montant' => $facture->montant,
                'percu' => $facture->percu,
                'retourne' => $facture->retourne,
                'etat' => $facture->etat,
                'client_err' => '',
                'caissier_err' => '',
                'montant_err' => '',
                'percu_err' => '',
                'retourne_err' => '',
                'etat_err' => '',
            ];
    
            // Charger la vue avec les données actuelles de la facture
            $this->view('facture/edit', $data);
        }
    }
    
    public function delete($id)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if($this->factureModel->delete($id))
            {
                flash('facture_message', 'Facture supprimé');
                redirect('facture');
            }
            else
            {
                die('Erreur');
            }
        }
        else
        {
            redirect('facture');
        }
    }
}