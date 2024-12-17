<h1>Novo Contato</h1>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Nome" required>
    <input type="email" name="email" placeholder="E-mail">
    <input type="text" name="phone" placeholder="Telefone">
    <textarea name="encrypted_data" placeholder="Dados secretos"></textarea>
    <input type="password" name="password" placeholder="Senha para criptografia" required>
    <input type="file" name="image">
    <button type="submit">Salvar</button>
</form>

<?php include 'views/partials/header.php'; ?>

<div class="container mx-auto mt-5">
    <h1 class="text-2xl font-bold mb-5">Adicionar Novo Contato</h1>

    <form action="/contacts/store" method="POST" enctype="multipart/form-data">
        <div class="mb-4">
            <label class="block font-bold mb-2" for="name">Nome</label>
            <input type="text" name="name" id="name" class="input input-bordered w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-bold mb-2" for="email">Email</label>
            <input type="email" name="email" id="email" class="input input-bordered w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-bold mb-2" for="phone">Telefone</label>
            <input type="text" name="phone" id="phone" class="input input-bordered w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-bold mb-2" for="image">Imagem</label>
            <input type="file" name="image" id="image" class="file-input file-input-bordered w-full">
        </div>

        <button type="submit" class="btn btn-primary">Salvar Contato</button>
    </form>
</div>

<?php include 'views/partials/footer.php'; ?>
