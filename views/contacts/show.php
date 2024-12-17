<?php include 'views/partials/header.php'; ?>

<div class="container mx-auto mt-5">
    <h1 class="text-2xl font-bold mb-5">Detalhes do Contato</h1>

    <div class="card bg-base-100 shadow-xl p-5">
        <h2 class="text-xl font-bold"><?= htmlspecialchars($contact['name']); ?></h2>

        <?php if ($contact['image']): ?>
            <img src="<?= $contact['image']; ?>" alt="Imagem" class="w-32 h-32 rounded my-3">
        <?php endif; ?>

        <?php
        // Descriptografia dos dados
        $decryptedData = openssl_decrypt(
            base64_decode($contact['encrypted_data']),
            'AES-128-ECB',
            $_SESSION['encryption_key']
        );
        $data = json_decode($decryptedData, true);
        ?>

        <p>Email: <?= htmlspecialchars($data['email'] ?? 'Bloqueado'); ?></p>
        <p>Telefone: <?= htmlspecialchars($data['phone'] ?? 'Bloqueado'); ?></p>
    </div>

    <a href="/contacts" class="btn btn-secondary mt-5">Voltar</a>
</div>

<?php include 'views/partials/footer.php'; ?>