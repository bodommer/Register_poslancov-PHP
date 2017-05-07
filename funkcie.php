<?php
date_default_timezone_set('Europe/Bratislava');

$mysqli = new mysqli('localhost', 'jurco15', 'ohjai', 'jurco15');  // spojenie na skolsky server
//$mysqli = new mysqli('localhost', 'poslanec2', 'aaa', 'poslanci');  //testovacie spojenie
if ($mysqli->connect_errno) {
	echo '<p class="chyba">Nepodarilo sa pripojiť!</p>';
} else {
	$mysqli->query("SET CHARACTER SET 'utf8'");
}

function spravne_prihlasenie($meno, $heslo) {
  $m = addslashes(htmlspecialchars(strip_tags($meno)));
  $h = addslashes(htmlspecialchars(strip_tags($heslo)));
  global $mysqli;
  if (!$mysqli->connect_errno) {
    $sql="SELECT id FROM osoby WHERE meno='" . $m . "' AND heslo=MD5('$h')";
		if ($result = $mysqli->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        return $row['id'];
      }
    } else {
      return False;
    }
	}
}

function validateDate($date, $format = 'Y-m-d H:i:s')  {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function spravny_datum($datum) {
  if (!(strpos($datum, '-'))) {
    $d = addslashes(htmlspecialchars(strip_tags($datum)));
    $d1 = explode('.', $d);
    $d2 = array_reverse($d1, True);
    $d3 = implode('-', $d2);
    echo $d3;
    $datum = $d3;
  }
    return validateDate($datum, 'Y-m-d');
}

function spravny_cas($cas) {
  $c = addslashes(htmlspecialchars(strip_tags($cas)));
  return validateDate($c, 'H:i');
}

function casy_po_sebe($p, $o) {
  list($hod1, $min1) = explode(':', $p);
  list($hod2, $min2) = explode(':', $o);

  $min1 += ($hod1 * 60);
  $min2 += ($hod2 * 60);
  $rozdiel = $min2 - $min1;
  return ($rozdiel > 0);
}

function je_uz_v_db($id, $datum, $prichod, $odchod) {
  global $mysqli;
  if (!$mysqli->connect_errno) {
      $sql = "SELECT id FROM casy WHERE den='$datum' AND cas_prichodu='$prichod' AND cas_odchodu='$odchod' AND id_poslanca='$id'"; // definuj dopyt
      if ($result = $mysqli->query($sql)) {  // vykonaj dopyt
        while ($row = $result->fetch_assoc()) {
          return True;
        }
        return False;
        }
      } elseif ($mysqli->errno) {
        echo '<p>Chyba spojenia so serverom!</p>';
        return True;
		}
}

function vloz_casy($id, $datum, $prichod, $odchod, $popis) {
  global $mysqli;
  if (!$mysqli->connect_errno) {
    $datum = $mysqli->real_escape_string($datum);
    $prichod = $mysqli->real_escape_string($prichod);
    $odchod = $mysqli->real_escape_string($odchod);
    $popis = $mysqli->real_escape_string($popis);

    if (je_uz_v_db($id, $datum, $prichod, $odchod)) {
      return False;
    } else {
      $sql = "INSERT INTO casy SET den='$datum', cas_prichodu='$prichod', cas_odchodu='$odchod', poznamka='$popis', id_poslanca='$id'"; // definuj dopyt

      if ($result = $mysqli->query($sql)) {  // vykonaj dopyt
        return True;
      } elseif ($mysqli->errno) {
        return False;
      }
    }
  }
}

function vypis_zaznamy($id, $prihlaseny, $meno='') {
  global $mysqli;
  if (!$mysqli->connect_errno) {
      $sql="SELECT * FROM casy WHERE id_poslanca='$id' ORDER BY id ASC";

      if ($result = $mysqli->query($sql)) {
        if ($prihlaseny) { echo '<h4>Vaše záznamy: </h4>';
        } else { echo '<p>Záznamy o dochádzke pre: <b>' . $meno . '</b></p>';
        }
        echo '<form method="post"> <table>';
        echo '<tr><th>Číslo záznamu</th><th>Dátum</th><th>Príchod</th><th>Odchod</th><th>Poznámka</th>';
        if ($prihlaseny) echo '<th>Výber</th></tr>';
        $zaznam = 1;
        while ($riadok = $result->fetch_assoc()) {
          echo '<tr><td>' . $zaznam++ . '</td><td>' . $riadok['den'] . '</td><td>' . $riadok['cas_prichodu'] . '</td><td>' . $riadok['cas_odchodu'] . '</td><td>' . $riadok['poznamka'] . '</td>';
          if ($prihlaseny) echo '<td><input type="checkbox" name="zmazat[]" value=' . $riadok['id'] . '></td>';
          echo "</tr>\n";
        } echo '</table>';
          if ($prihlaseny) echo '<input type="submit" name="zmaz" class="button" id="zmaz" value="Zmazať zvolené záznamy">';
          echo '</form>';
      } elseif ($mysqli->errno) {
          return False;
			}
	}
}

function vymaz_zaznamy($pole) {
  global $mysqli;
  foreach ($pole as $id) {

    if (!$mysqli->connect_errno) {
      $sql="DELETE FROM casy WHERE id=" . $id;
      if ($result = $mysqli->query($sql)) {} else {
        echo "<p class='chyba'>Nastala chyba pri rušení zaznamu $id.</p>\n";
        return False ;
      }
    }
  } return True;
}

function kontrola_strana($str) {
	global $mysqli;
	return $mysqli->real_escape_string($str);
}

function vypis_triedenie($poziadavka) {
  global $mysqli;
  if (!$mysqli->connect_errno) {
      $sql='SELECT id, meno, adresa, strana, zamestnanie, vek, pocet_absencii, pocet_zvoleni FROM osoby ' . $poziadavka;

      if ($result = $mysqli->query($sql)) {
        echo '<h4>Boli nájdené nasledujúce záznamy: </h4>';
        echo '<table id="triedenie">';
        echo '<tr><th>Č.</th><th>Meno</th><th>Bydlisko</th><th>Strana</th><th>Civ. zamestnanie</th><th>Vek</th><th>Počet absencií</th><th>Počet zvolení</th></tr>';
        $zaznam = 1;
        while ($riadok = $result->fetch_assoc()) {
          echo '<tr><td>' . $zaznam++ . '<td><a href="vyhladavanie.php?poslanec=' . $riadok['id'] . '&mposlanca=' . $riadok['meno'] . '">' . $riadok['meno'] . '</a></td><td>' . $riadok['adresa'] . '</td><td>' . $riadok['strana'] . '</td><td>' . $riadok['zamestnanie'] . '</td>
          <td>' . $riadok['vek'] . '</td><td>' . $riadok['pocet_absencii'] . '</td><td>' . $riadok['pocet_zvoleni'] . '</td>';
          echo "</tr>\n";
        } echo '</table></form>';
      } elseif ($mysqli->errno) {
          return False;
}
}
}
?>
