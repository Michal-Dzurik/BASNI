	<?php
		$old = ini_set('memory_limit', '8192M');

		if (isset($_GET)) {
			$searched_term = substr($_GET["rhyme_string"], -2);
			if (isset($_GET["rhyme_number"]) && $_GET["rhyme_number"] != "" && $_GET["rhyme_number"] !== null) {
				$number_of_results = $_GET["rhyme_number"];
			}
			else{
				$number_of_results = 15;
			}

			$count = 0;

			$lines = [];
			$words = [];
			$result = [];
		    $handle = fopen("Spisovné_slová.txt", "r");

		    while(!feof($handle)) {
		        $lines[] = trim(fgets($handle));
		    }

		    fclose($handle);

			for ($i = 0; $i < count($lines); $i++) { 
				$term = substr($lines[$i], -2);

				if ($term === $searched_term) {
					array_push($words, $lines[$i]);
				}
			}

			for ($i = 0; $i < $number_of_results; $i++) {
			    $numb = rand(0, count($words));
			    echo $words[$numb] . "#";
			}



		}

