<?php
require_once '../app/models/Contact.php';
require_once '../app/core/Session.php';
require_once '../app/core/Utils.php';

class ContactController {
    private $contactModel;

    public function __construct() {
        Session::start();
        if (!Session::get('user_id')) {
            header("Location: /login");
            exit();
        }

        $this->contactModel = new Contact();
    }

    // Listar contatos
    public function list() {
        $contacts = $this->contactModel->getAll(Session::get('user_id'));
        include '../app/views/contact_list.php';
    }

    // Criar um novo contato
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateInput($_POST, $_FILES);

            $user_id = Session::get('user_id');
            $encrypted_data = Utils::encrypt($_POST['encrypted_data'], $_POST['password']);
            $image = Utils::uploadImage($_FILES['image'], 'uploads/');

            $this->contactModel->create(
                $user_id, 
                htmlspecialchars($_POST['name']), 
                htmlspecialchars($_POST['email']), 
                htmlspecialchars($_POST['phone']), 
                $image, 
                $encrypted_data
            );

            header("Location: /contacts");
            exit();
        }
        include '../app/views/contact_create.php';
    }

    // Editar contato
    public function edit($id) {
        $contact = $this->contactModel->findById($id, Session::get('user_id'));
        if (!$contact) {
            $this->redirectWithError("/contacts", "Contato não encontrado.");
        }
        include '../app/views/contact_edit.php';
    }

    // Atualizar contato
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateInput($_POST);

            $image = !empty($_FILES['image']['name']) ? 
                     Utils::uploadImage($_FILES['image'], 'uploads/') : null;

            $encrypted_data = Utils::encrypt(
                json_encode(['email' => $_POST['email'], 'phone' => $_POST['phone']]), 
                Session::get('encryption_key')
            );

            $this->contactModel->update(
                $id, 
                Session::get('user_id'),
                htmlspecialchars($_POST['name']), 
                $image, 
                $encrypted_data
            );

            $this->redirectWithSuccess("/contacts", "Contato atualizado com sucesso!");
        }
    }

    // Deletar contato
    public function destroy($id) {
        $this->contactModel->delete($id, Session::get('user_id'));
        $this->redirectWithSuccess("/contacts", "Contato excluído com sucesso!");
    }

    // Pesquisar contatos
    public function search() {
        $keyword = $_GET['q'] ?? '';
        $contacts = $this->contactModel->search(Session::get('user_id'), $keyword);
        include '../app/views/contact_list.php';
    }

    // Validação básica de entrada
    private function validateInput($data, $files = null) {
        if (empty($data['name']) || empty($data['email']) || empty($data['phone'])) {
            $this->redirectWithError("/contacts/create", "Todos os campos são obrigatórios.");
        }

        if ($files && $files['image']['error'] !== UPLOAD_ERR_OK) {
            $this->redirectWithError("/contacts/create", "Erro no upload da imagem.");
        }
    }

    // Métodos auxiliares
    private function redirectWithError($location, $message) {
        Session::set('error', $message);
        header("Location: $location");
        exit();
    }

    private function redirectWithSuccess($location, $message) {
        Session::set('success', $message);
        header("Location: $location");
        exit();
    }
}