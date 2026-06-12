<section id="unos-forma">
    <h2>Prijava</h2>
    <form action="administrator.php" method="POST">
        <div class="form-item">
            <label for="username">Korisničko ime</label>
            <div class="form-field">
                <input type="text" name="username" id="username" class="form-field-textual">
            </div>
        </div>
        <div class="form-item">
            <label for="lozinka">Lozinka</label>
            <div class="form-field">
                <input type="password" name="lozinka" id="lozinka" class="form-field-textual">
            </div>
        </div>
        <div class="form-item form-buttons">
            <button type="submit" name="prijava">Prijava</button>
        </div>
        <p>Nemate račun? <a href="registracija.php">Registrirajte se</a></p>
    </form>
</section>