	<?php

	include_once("get_course.php");

	$user = $_POST['stu_user'];
	$pwd = $_POST['stu_pwd'];

	$string = get_course($user, $pwd);
	
	$match = "/(?<=<\/th><\/tr>)[\s\S]*(?=<tr><td class=\"firstHiddenTd\">)/";
    
	preg_match($match, $string, $table);

	$course = tableToArray($table[0]);
	
	echo "<table border= 1px>";
	for ($i = 0; $i  <= 10; $i ++) { 
		
		echo "<tr>";
		for ($j = 0; $j <= 7; $j++) {

			echo  "<td>" . $course[$i][$j] . "</td>";
		}
		echo "</tr>";
	}
	echo "</table>";

	function tableToArray($str){

		$match1 = "/(?<=rowspan=\")[123456789]/";
		preg_match_all($match1, $str, $rowspan);

		$match2 = "/(?<=rowspan=\"[123456789]\"[( >)|>])[\s\S]*?(?=<\/td>)/";
		preg_match_all($match2, $str, $results2, 2);

		$k = 0;

		for ($i = 0; $i  <= 10; $i ++) { 
			
			for ($j = 0; $j <= 7; $j++) { 
				
				$n =$rowspan[0][$k];
				if (!isset($course[$i][$j])) {

					$course[$i][$j] = str_replace('<br>',' ,', $results2[$k][0]);
					$course[$i][$j] = trim(strip_tags($course[$i][$j]));
					$course[$i][$j] = str_replace('>&nbsp;', '', $course[$i][$j] );
					$course[$i][$j] = str_replace('style="text-align:center;vertical-align: middle;">', '', $course[$i][$j] );

					while ( $n != 1){
							
							$n--; 
							$course[$n + $i][$j] = $course[$i][$j];

					}

					$k++;
				}
				
			}

		}

		return  $course;
		
	}

	?>