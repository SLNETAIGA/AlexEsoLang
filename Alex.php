<?php
    // Alex(http://esolangs.org/wiki/Alex) implement on PHP
	// By SLNETAIGA(https://github.com/SLNETAIGA)
	// Usage: php Alex.php input.alex
	$source = file_get_contents($argv[1]);
    $source = preg_replace("/You\:.+?\n/","",$source,-1);
	$source = explode("- Alex.",$source);
	
	
	$stack = array();
	$p = 0;
	$l = array();
	for($i=0;$i<1000;$i++){
		$stack["A".$i] = 0;
	}
	$brackets = 0;
	for($i=0; $i<count($source); ++$i) {
		$ops = explode(" ",$source[$i]);
		
		switch(strtolower(trim($ops[0]))){
			case "increment":
				$stack[trim($ops[1])]++;
			break;
			case "decrement":
				$stack[trim($ops[1])]--;
			break;
			case "set":
				$stack[trim($ops[1])] = (int) trim($ops[2]);
			break;
			case "put":
				echo $stack[trim($ops[1])];
			break;
			case "get":
				$stack[trim($ops[1])] = (int) fgets(STDIN);
			break;
			case "gets":
				$stack[trim($ops[1])] = ord((int) fgets(STDIN));
			break;
			case "puts":
				echo chr($stack[trim($ops[1])]);
			break;
			case "label":
				$l[trim($ops[1])] = $i;
			break;
			case "ifzero":
				if($stack[trim($ops[1])] != 0){
					$i = $l[trim($ops[2])];
				}
			break;
			case "ifequals":
				if($stack[trim($ops[1])] == $stack[trim($ops[2])]){
					$i = $l[trim($ops[3])];
				}
			break;
			case "say":
			    if(strtolower(trim($ops[1])) == "space"){
					echo " ";
				} else if(strtolower(trim($ops[1])) == "linefeed"){
					echo "\n";
				} else if(strtolower(trim($ops[1])) == "comma"){
					echo ",";
				} else if(strtolower(trim($ops[1])) == "dot"){
					echo ".";
				} else {
					echo trim($ops[1]);
				}
			break;
			case "":break;
			case " ":break;
			default:
			die("I don't understand you - Alex.\n");break;
		}
	}