<?php include 'views/partials/header.php'; ?>

<div class="container mx-auto mt-5">
    <h1 class="text-2xl font-bold mb-5">Editar Contato</h1>

    <form action="/contacts/update/<?= $contact['id']; ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-4">
            <label class="block font-bold mb-2" for="name">Nome</label>
            <input type="text" name="name" id="name" value="<?= htmlspecialchars($contact['name']); ?>" class="input input-bordered w-full" required>
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
            <label class="block font-bold mb-2" for="image">Imagem (opcional)</label>
            <input type="file" name="image" id="image" class="file-input file-input-bordered w-full">
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Contato</button>
        <a href="/contacts" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include 'views/partials/footer.php'; ?>