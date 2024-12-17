<?php include 'views/partials/header.php'; ?>

<div class="container mx-auto mt-5">
    <h1 class="text-2xl font-bold mb-5">Meus Contatos</h1>

    <a href="/contacts/create" class="btn btn-primary mb-3">Adicionar Novo Contato</a>

    <!-- Formulário de Pesquisa -->
    <form method="GET" action="/contacts/search" class="mb-5">
        <input type="text" name="q" placeholder="Pesquisar contato" class="input input-bordered w-full" />
        <button type="submit" class="btn btn-primary mt-2">Buscar</button>
    </form>

    <!-- Tabela de Contatos -->
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><?= htmlspecialchars($contact['name']); ?></td>
                        <td>
                            <?php if ($contact['image']): ?>
                                <img src="<?= htmlspecialchars($contact['image']); ?>" alt="Imagem" class="w-16 h-16 rounded">
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="/contacts/show/<?= $contact['id']; ?>" class="btn btn-sm btn-info">Visualizar</a>
                            <a href="/contacts/edit/<?= $contact['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                            <form action="/contacts/destroy/<?= $contact['id']; ?>" method="POST" class="inline">
                                <button type="submit" class="btn btn-sm btn-error">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'views/partials/footer.php'; ?>
