<?php
class Contact {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    public function create($user_id, $name, $email, $phone, $image, $encrypted_data) {
        $stmt = $this->pdo->prepare("INSERT INTO contacts (user_id, name, email, phone, image, encrypted_data) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$user_id, $name, $email, $phone, $image, $encrypted_data]);
    }

    public function getAll($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM contacts WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id, $user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM contacts WHERE id = ? AND user_id = ?");
        $stmt->execute([$id, $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $user_id, $name, $email, $phone, $image, $encrypted_data) {
        $stmt = $this->pdo->prepare("UPDATE contacts SET name = ?, email = ?, phone = ?, image = ?, encrypted_data = ? WHERE id = ? AND user_id = ?");
        return $stmt->execute([$name, $email, $phone, $image, $encrypted_data, $id, $user_id]);
    }

    public function delete($id, $user_id) {
        $stmt = $this->pdo->prepare("DELETE FROM contacts WHERE id = ? AND user_id = ?");
        return $stmt->execute([$id, $user_id]);
    }

    public function search($user_id, $keyword) {
        $stmt = $this->pdo->prepare("SELECT * FROM contacts WHERE user_id = ? AND (name LIKE ? OR email LIKE ?)");
        $searchTerm = "%$keyword%";
        $stmt->execute([$user_id, $searchTerm, $searchTerm]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}