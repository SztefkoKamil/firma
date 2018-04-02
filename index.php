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
        <div class="section1">

	<?php
	
		$connect = @mysqli_connect("localhost", "Kamil", "password32123");
		
		if(!$connect){
			die('<h4>Błąd połączenia z uzytkownikiem: '.mysqli_connect_error().'</h4>');
		}	// komunikat błędu połączenia z użytkownikiem MySQL
		else{
		echo '<h3>Połączono z użytkownikiem "Kamil"</h3>';
		}
		// komunikat udanego połączenia
		
		//---------------------------------------------------------
		
		if(mysqli_query($connect, "CREATE DATABASE firma")){
			mysqli_query($connect, "ALTER DATABASE firma DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci");
			
			echo '<h3>Utworzono bazę danych o nazwie "firma"</h3>';
			// komunikat poprawnego utworzenia bazy danych "firma"
		}
		else{
			echo '<h4>Błąd tworzenia nowej bazy danych: '.mysqli_error($connect).'</h4>';
			// komunikat błędu tworzenia nowej bazy danych
		}
		 // utworzenie bazy danych
		
		mysqli_select_db($connect, "firma");
		// wybór bazy danych
		
		
		//---------------------------------------------------------------
		
		$sql = "CREATE TABLE pracownicy(
		id_pracownika int NOT NULL AUTO_INCREMENT,
		imie VARCHAR(32) NOT NULL, 
		nazwisko VARCHAR(64) NOT NULL, 
		stanowisko VARCHAR(32) NOT NULL,
		pensja float NOT NULL, 
		data_zatrudnienia date NOT NULL,
		PRIMARY KEY (id_pracownika))";
		
		if(mysqli_query($connect, $sql)){
			echo '<h3>Dodano tabelę "pracownicy"</h3>';
		}
		else{
			echo '<h4>Błąd tworzenia nowej tablicy: '.mysqli_error($connect).'</h4>';
		}
		// stworzenie tablicy pracownicy --------------------------
		
	
		$sql = "CREATE TABLE projekty(
		id_projektu int NOT NULL AUTO_INCREMENT,
		nazwa VARCHAR(64) NOT NULL,
		data_rozpoczecia date NOT NULL,
		data_zakonczenia date NOT NULL,
		koszt float NOT NULL,
		opis TEXT NOT NULL, 
		procent_wykonania int NOT NULL,
		kierownik VARCHAR(32) NOT NULL,
		PRIMARY KEY (id_projektu))";
		
		if(mysqli_Query($connect, $sql)){
			echo '<h3>Dodano tabelę "projekty"</h3>';
		}
		else{
			echo '<h4>Błąd tworzenia nowej tablicy: '.mysqli_error($connect).'</h4>';
		}
		// stworzenie teblicy projekty ----------------------------------
		
	
		$sql = "CREATE TABLE uczestnicy(
		id_pracownika int NOT NULL,
		id_projektu int NOT NULL,
		funkcja VARCHAR(32) NOT NULL,
		premia int NOT NULL,
		ocena float NOT NULL,
		CONSTRAINT PRIMARY KEY (id_pracownika, id_projektu))";
		
		if(mysqli_Query($connect, $sql)){
			echo '<h3>Dodano tabelę "uczestnicy"</h3>';
		}
		else{
			echo '<h4>Błąd tworzenia nowej tablicy: '.mysqli_error($connect).'</h4>';
		}
		// stworzenie tablicy uczestnicy ---------------------------------
		
		
		mysqli_close($connect);
		
	?>
        
        <div class="section1">
            <a href="tabele.php"><button class="button">Zobacz tabele</button></a>
        </div>
    </div>
</body>

</html>