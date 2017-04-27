<?php
$nazov = 'Administrácia';
include('funkcie.php');
include('hlavicka.php');
?>
<section>
  <h3>Administrácia</h3>
  <p>Pre pokračovanie sa najprv prihláste.</p>
  <form method="post">
    <fieldset>
      <legend>Prihlasovacie údaje</legend>
      <label for="meno">Prihlasovacie meno:</label> <input type="text" name="meno" id="meno" size="12" maxlength="12" placeholder=" 3-12zn." required><br>
    	<label for="heslo">Heslo:</label> <input type="password" name="heslo" id="heslo" size="10" placeholder=" 8-16zn., 1číslo" required>
    </fieldset>
    <input type="submit" name="prihlas" id="prihlas" value="Prihlásiť">
  </form>

  <h4>Vkladanie údajov</h4>
  <form method="post">
    <fieldset>
      <legend>Údaje o udalosti</legend>
      <label for="nazov">Názov/typ udalosti:</label> <input type="text" name="nazov" id="nazov" size="25" maxlength="70" placeholder=" max. 70 znakov" required><br>
      <label for="datum">Dátum:</label> <input type="date" name="datum" id="datum" required><br>
      <label for="popis">Popis:</label> <textarea name="popis" id="popis" rows="10" cols="30" placeholder="stručný popis, max. 1000 znakov"></textarea> <br>
    </fieldset>
    <input type="submit" name="pridaj" id="pridaj" value="Pridať">
  </form>

  </form>
</section>
<?php
include('pata.php')
?>
