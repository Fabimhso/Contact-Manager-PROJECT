<h1>Meus Contatos</h1>
<form method="GET" action="/contacts/search">
    <input type="text" name="keyword" placeholder="Pesquisar contato">
    <button type="submit">Buscar</button>
</form>

<a href="/contacts/create">Novo Contato</a>

<?php foreach ($contacts as $contact): ?>
    <div>
        <img src="/uploads/<?php echo htmlspecialchars($contact['image']); ?>" width="50">
        <h3><?php echo htmlspecialchars($contact['name']); ?></h3>
        <p><?php echo htmlspecialchars($contact['email']); ?></p>
        <p><?php echo htmlspecialchars($contact['phone']); ?></p>
        <a href="/contacts/view/<?php echo $contact['id']; ?>">Ver</a>
        <a href="/contacts/delete/<?php echo $contact['id']; ?>">Deletar</a>
    </div>
<?php endforeach; ?>
