<?php
  class factures {
    private $db;

    public function __construct(){
      $this->db = new Database();
    }
    public function read()
    {
        $this->db->query("SELECT * FROM factures");
        $result = $this->db->resultset();
        return $result;
    }

    public function getFactureById($id)
    {
        $this->db->query("SELECT * FROM factures WHERE id = :id");
        $this->db->bind(':id', $id);
        $row = $this->db->Single();
        return $row;
    }
    
    public function add($data) {
        $this->db->query('INSERT INTO factures (client, caissier, montant, percu, retourne, etat)
                            VALUES (:client, :caissier, :montant, :percu, :retourne, :etat)');
        $this->db->bind(':client', $data['client']);
        $this->db->bind(':caissier', $data['caissier']);
        $this->db->bind(':montant', $data['montant']);
        $this->db->bind(':percu', $data['percu']);
        $this->db->bind(':retourne', $data['retourne']);
        $this->db->bind(':etat', $data['etat']);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function vider() {
        $this->db->query("TRUNCATE factures");
        $result = $this->db->resultset();
        return $result;
    }

    public function edit($data) {
        $this->db->query('UPDATE factures SET id = :id, client = :client, caissier = :caissier, montant = :montant, percu = :percu, retourne = :retourne, etat = :etat WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':client', $data['client']);
        $this->db->bind(':caissier', $data['caissier']);
        $this->db->bind(':montant', $data['montant']);
        $this->db->bind(':percu', $data['percu']);
        $this->db->bind(':retourne', $data['retourne']);
        $this->db->bind(':etat', $data['etat']);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->query("DELETE FROM factures WHERE id = :id");
        $this->db->bind(':id', $id);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getTotalFactures() {
        $this->db->query("SELECT COUNT(*) FROM factures");
        $result = $this->db->resultset();
        return $result;
    }

    public function getMontantTotal() {
        $this->db->query("SELECT SUM(montant) FROM factures");
        $result = $this->db->resultset();
        return $result;
    }

    public function getFacturesPayees() {
        $this->db->query("SELECT COUNT(*) FROM factures WHERE etat = 'payée'");
        $result = $this->db->resultset();
        return $result;
    }

    public function getFacturesFacturees() {
        $this->db->query("SELECT COUNT(*) FROM factures WHERE etat = 'facturée'");
        $result = $this->db->resultset();
        return $result;
    }

    public function getFacturesAnnulees() {
        $this->db->query("SELECT COUNT(*) FROM factures WHERE etat = 'annulée'");
        $result = $this->db->resultset();
        return $result;
    }
}