<h2><?= esc($title) ?></h2>

<?= \Config\Services::validation()->listErrors() ?>

<form action="/news/create" method="post">
    <?= csrf_field() ?>

    <label for="anno">Anno</label>
    <input type="input" name="anno" /><br />

    <label for="impostaPrivati">Imposta Privati</label>
    <input type="input" name="impostaPrivati"><br />

    <label for="impostaAzienda">Imposta Azienda</label>
    <input type="input" name="impostaAzienda"><br />

    <input type="submit" name="submit" value="Nuova tariffa annuale" />
</form>