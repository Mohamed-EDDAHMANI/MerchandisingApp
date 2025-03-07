<?php
class ResponsableRepository extends Repository {
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM responsables");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM responsables WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function assignerResponsable($pointDeVenteId, $responsableId) {
        $stmt = $this->db->prepare("UPDATE points_de_vente SET responsable_id = :responsableId WHERE id = :pointDeVenteId");
        $stmt->execute([
            'pointDeVenteId' => $pointDeVenteId,
            'responsableId' => $responsableId
        ]);
    }

    public function revoquerResponsable($id) {
        $stmt = $this->db->prepare("UPDATE points_de_vente SET responsable_id = NULL WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
?>