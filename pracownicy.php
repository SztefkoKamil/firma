<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Firma</title>
    <link href="style.css" type="text/css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
	
	<?php
	
		$connect = @mysqli_connect("localhost", "Kamil", "password32123", "firma");
		
		if(!$connect){
			die('<h4>Błąd połączenia z uzytkownikiem: '.mysqli_connect_error().'</h4>');
			
		}	// komunikat błędu połączenia z użytkownikiem MySQL
		
		if(!mysqli_set_charset($connect, "utf8")){
			echo '<h4>Błąd ustawień kodowania: '.mysqli_error($connect).'</h4>';
		}
	?>	
	
        <div class="section2">
            <h3>Edycja danych pracownika</h3>
            <form action="pracownicy.php" method="post">

                <label>Numer ID pracownika: <input type="text" name="edytuj" required placeholder="wymagane"></label><br/>
                <label>Imię: <input type="text" name="imie"></label><br/>
                <label>Nazwisko: <input type="text" name="nazwisko"></label><br/>
                <label>Stanowisko: <input type="text" name="stanowisko"></label><br/>
                <label>Pensja: <input type="text" name="pensja"></label><br/>
                <input type="submit" value="Edytuj dane pracownika" class="button">

            </form>
			
	<?php  // ---------------------------------------------------------
	
		if(isset($_POST['edytuj'])){
			$zapytanie = 'UPDATE pracownicy SET ';
			
			if($_POST['imie'] != ''){
				$zapytanie = $zapytanie.'imie="'.$_POST['imie'].'"';
			} // zmień imię
			
			if($_POST['nazwisko'] != ''){
				if($_POST['imie'] != ''){
					$zapytanie = $zapytanie.', ';
				} // sprawdź czy dodać przecinek
				
				$zapytanie = $zapytanie.'nazwisko="'.$_POST['nazwisko'].'"';
			} // zmień nazwisko
			
			if($_POST['stanowisko'] != ''){
				if($_POST['nazwisko'] != '' || $_POST['imie'] != ''){
					$zapytanie = $zapytanie.', ';
				} // sprawdź czy dodać przecinek
				
				$zapytanie = $zapytanie.'stanowisko="'.$_POST['stanowisko'].'"';
			} // zmień stanowisko
			
			if($_POST['pensja'] != ''){
				if($_POST['stanowisko'] != '' || $_POST['nazwisko'] != '' || $_POST['imie'] != ''){
					$zapytanie = $zapytanie.', ';
				} // sprawdź czy dodać przecinek
				
				$zapytanie = $zapytanie.'pensja='.$_POST['pensja'];
			} // zmień pensje
			
			$zapytanie = $zapytanie.' WHERE id_pracownika='.$_POST['edytuj'];
			// dodanie warunku id pracownika
			
			$rezultat_zapytania = mysqli_query($connect, $zapytanie);
			
			if($rezultat_zapytania){
				echo '<div class="info"><h3>Zmieniono dane pracownika</h3></div>';
				
			}
		} // edycja danych pracownika -------------------------------------
	?>
			
        </div>
        <div class="section2">
            <h3>Dodanie pracownika</h3>
            <form action="pracownicy.php" method="post">

                <label>Imię: <input type="text" name="imie_dodaj" required placeholder="wymagane"></label><br/>
                <label>Nazwisko: <input type="text" name="nazwisko" required placeholder="wymagane"></label><br/>
                <label>Stanowisko: <input type="text" name="stanowisko" required placeholder="wymagane"></label><br/>
                <label>Pensja: <input type="text" name="pensja" required placeholder="wymagane"></label><br/>
                <label>Data zatrudnienia: <input type="date" name="data_zat" required></label><br/>
                <input type="submit" value="Dodaj pracownika" class="button">

            </form>
			
	<?php  // ----------------------------------------------------------
	
		if(isset($_POST['imie_dodaj'])){
			$zapytanie = 'INSERT INTO pracownicy VALUES(NULL, "'.$_POST['imie_dodaj'].'", "'.$_POST['nazwisko'].'", "'.$_POST['stanowisko'].'", "'.$_POST['pensja'].'", "'.$_POST['data_zat'].'")';
			
			$rezultat_zapytania = mysqli_query($connect, $zapytanie);
			
			if($rezultat_zapytania){
				echo '<div class="info"><h3>Dodano pracownika</h3></div>';
			}
		} // dodawanie pracownika --------------------------------------------
	?>
			
        </div>
        <div class="section2">
            <h3>Usunięcie pracownika</h3>
            <form action="pracownicy.php" method="post">

                <label>Numer ID pracownika: <input type="text" name="usun" required placeholder="wymagane"></label><br/>
                <input type="submit" value="Usuń pracownika" class="button">

            </form>
			
	<?php  // ------------------------------------------------------------
	
		if(isset($_POST['usun'])){
			$zapytanie = 'DELETE FROM pracownicy WHERE id_pracownika='.$_POST['usun'].'';
			
			$rezultat_zapytania = mysqli_query($connect, $zapytanie);
			
			if($rezultat_zapytania){
				echo '<div class="info"><h3>Usunięto pracownika</h3></div>';
				
			}
		} // usuwanie pracownika ---------------------------------------
	?>
			
        </div>
	
	<?php
	
		mysqli_close($connect);
	
	?>



    </div>
</body>

</html>