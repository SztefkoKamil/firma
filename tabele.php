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
	
		$connect = @mysqli_connect("localhost", "Kamil", "password32123", "firma");
		
		if(!$connect){
			die('<h4>Błąd połączenia z uzytkownikiem: '.mysqli_connect_error().'</h4>');
		}	// komunikat błędu połączenia z użytkownikiem MySQL
		
		if(!mysqli_set_charset($connect, "utf8")){
			echo '<h4>Błąd ustawień kodowania: '.mysqli_error($connect).'</h4>';
		}
		
		//--------------------------------------------------------------------
		
		// zadanie 2 ---------------------
		$zapytanie = 'SELECT pracownicy.imie, pracownicy.nazwisko, projekty.nazwa, uczestnicy.ocena FROM pracownicy, projekty, uczestnicy WHERE pracownicy.id_pracownika=uczestnicy.id_pracownika AND projekty.id_projektu=uczestnicy.id_projektu';
		// zmienna z zapytaniem o odpowiednie dane
		
		$rezultat_zapytania = mysqli_query($connect, $zapytanie);
		
	?>

                <h3>Uczestnicy projektów</h3>
                <table>
                    <tr>
                        <th>imię</th>
                        <th>nazwisko</th>
                        <th>nazwa projektu</th>
                        <th>ocena pracownika</th>
                    </tr>

    <?php
		
		while($rekord = mysqli_fetch_assoc($rezultat_zapytania)){
			$imie = $rekord['imie'];
			$nazwisko = $rekord['nazwisko'];
			$projekt = $rekord['nazwa'];
			$ocena = $rekord['ocena'];
			// pętla zapisujące do zmiennej tablice asocjacyjną i wyciągająca z niej odpowiednie dane
		
        echo '<tr><td>'.$imie.'</td><td>'.$nazwisko.'</td><td>'.$projekt.'</td><td>'.$ocena.'</td></tr>';
	       // echo rysujące ciało tabeli
		}
		// zadanie 2 ---------------------
	?>

                </table>
        </div>

        <div class="section1">

    <?php
		//zadanie 3 ---------------------
		
		$zapytanie = "SELECT uczestnicy.id_pracownika, uczestnicy.id_projektu, projekty.data_zakonczenia FROM uczestnicy, projekty WHERE uczestnicy.id_projektu=projekty.id_projektu AND projekty.data_zakonczenia<'2018-04-01' ORDER BY uczestnicy.id_projektu";
		// zmienna z zapytaniem o odpowiednie dane
		
		$rezultat_zapytania = mysqli_query($connect, $zapytanie);
		
		$projekt = array();
		$uczestnik = array();
		$y = 0;
		$first = true;
		
		while($rekord = mysqli_fetch_assoc($rezultat_zapytania)){
			$x = $rekord['id_projektu'];
			
			if($first){
				array_push($projekt, $x);
			}
			$first = false;
			
			if($x != $projekt[$y]){
				$y++;
				array_push($projekt, $x);
			}
			
			if(!isset($uczestnicy[$y])){
				$uczestnicy[$y] = 0;
			}
			$uczestnicy[$y] += 1;
			
		} // zliczanie uczestników projektów
		
		
		$zapytanie = 'SELECT projekty.nazwa, projekty.koszt, projekty.data_zakonczenia FROM projekty WHERE projekty.data_zakonczenia<"2018-04-01"';
		// zmienna z zapytaniem o odpowiednie dane
		
		$rezultat_zapytania = mysqli_query($connect, $zapytanie);
		// zapytanie do bazy
	?>

                <h3>Dane projektów zakończonych</h3>
                <table>
                    <tr>
                        <th>nazwa</th>
                        <th>koszt</th>
                        <th>data zakończenia</th>
                        <th>liczba uczestników</th>
                    </tr>

     <?php
	 
		$x = 0;
		while($rekord = mysqli_fetch_assoc($rezultat_zapytania)){
			$projekt = $rekord['nazwa'];
			$koszt = $rekord['koszt'];
			$data_zak = $rekord['data_zakonczenia'];
			// pętla zapisujące do zmiennej tablice asocjacyjną i wyciągająca z niej odpowiednie dane
		
        echo '<tr><td>'.$projekt.'</td><td>'.$koszt.'</td><td>'.$data_zak.'</td><td>'.$uczestnicy[$x].'</td></tr>';
	       // echo rysujące ciało tabeli
		$x++;
		}
		// zadanie 3 -------------------------------
	?>
	
                </table>
        </div>

        <div class="section1">
		
    <?php
		// zadanie 4 -------------------------------
		
		$zapytanie = "SELECT id_pracownika, id_projektu, ocena FROM uczestnicy ORDER BY id_projektu";
		// zmienna z zapytaniem o odpowiednie dane
		
		$rezultat_zapytania = mysqli_query($connect, $zapytanie);
		
		$projekt = array();
		$uczestnicy = array();
		$suma = array();
		$y = 0;
		$first = true;
		
		while($rekord = mysqli_fetch_assoc($rezultat_zapytania)){
			$x = $rekord['id_projektu'];
			
			if($first){
				array_push($projekt, $x);
			}
			$first = false;
			
			if($x != $projekt[$y]){
				$y++;
				array_push($projekt, $x);
			}
			
			if(!isset($uczestnicy[$y])){
				$uczestnicy[$y] = 0;
			}
			$uczestnicy[$y] += 1;
			
			
			if(!isset($suma[$y])){
				$suma[$y] = 0;
			}
			$suma[$y] += $rekord['ocena'];
			
		} // zliczanie uczestników i ocen projektów
		
		$srednia = array();
		$x = 0;
		$y = count($projekt);
		
		for($i = 0; $i<$y; $i++){
			$srednia[$i] =  $suma[$i] / $uczestnicy[$i];
			$srednia[$i] = round($srednia[$i], 1);
			
			if($srednia[$i]>$x){
				$x = $srednia[$i];
			}
		}
		// wyliczenie, zaokrąglenie i wyszukanie najwyższej średniej
		
		$id_pojektu = array();
		
		for($i = 0; $i<$y; $i++){
			if($srednia[$i]==$x){
				array_push($id_pojektu, $projekt[$i]);
			}
		}
		// sprawdzenie ile razy występuje najwyższa średnia
		
		$x = '';
		$y = count($id_pojektu);
		if($y==1){
			$x = $id_pojektu[0];
		}
		else{
			for($i = 0; $i<$y-1; $i++){
				$x = $x.$id_pojektu[$i].' OR p.id_projektu=';
			}
			$y -= 1;
			$x = $x.@$id_pojektu[$y];
		}
		// utworzenie porządanego członu zapytania
		
		$zapytanie = 'SELECT p.id_projektu, p.nazwa, p.data_rozpoczecia, p.data_zakonczenia, p.koszt, p.opis, p.kierownik FROM projekty AS p WHERE p.id_projektu='.$x;
		// zmienna z zapytaniem o odpowiednie dane
		
		$rezultat_zapytania = mysqli_query($connect, $zapytanie);
		// zapytanie do bazy
	?>

                <h3>Projekty z najwyższą średnią oceną uczestników</h3>
                <table>
                    <tr>
                        <th>nazwa</td>
                            <th>data rozpoczęcia</th>
                            <th>data zakończenia</th>
                            <th>koszt</th>
                            <th>opis</th>
                            <th>kierownik</th>
                            <th>średnia ocena</th>
                    </tr>

    <?php
		
		while($rekord = @mysqli_fetch_assoc($rezultat_zapytania)){
			$y = $rekord['id_projektu']-1;
			$projekt = $rekord['nazwa'];
			$data_roz = $rekord['data_rozpoczecia'];
			$data_zak = $rekord['data_zakonczenia'];
			$koszt = $rekord['koszt'];
			$opis = $rekord['opis'];
			$kierownik = $rekord['kierownik'];
			// pętla zapisujące do zmiennej tablice asocjacyjną i wyciągająca z niej odpowiednie dane
		
		echo '<tr><td>'.$projekt.'</td><td>'.$data_roz.'</td><td>'.$data_zak.'</td><td>'.$koszt.'</td><td>'.$opis.'</td><td>'.$kierownik.'</td><td>'.$srednia[$y].'</td></tr>';
            // echo rysujące ciało tabeli
		}
		// zadanie 4 ----------------------------------

		mysqli_close($connect);
		
	?>
                </table>
        </div>

        <div class="section1">
            <a href="pracownicy.php"><button class="button">Edycja pracowników</button></a>
        </div>
    </div>
</body>

</html>