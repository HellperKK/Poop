<?php 
//Appel de la librarie
	include "Lib.php";
//Tests
	$Object->make_child("Range");
	$Range->define_instance("construct", function($min, $max){
		_self()->min = $min;
		_self()->max = $max;
	});
	$Range->define_instance("include", function($i){
		return ($i >= _self()->min) && ($i <= _self()->max);
	});
	$test = $Range->make(0, 10);
	if($test->call("include", 2)){
		echo "Oui !";
	}
	else{
		echo "Non !";
	}
	echo "<br>";
	echo $Int->make(11)->call("times", 2)->call("remove", 3)->call("opposite");
	$Int->make_child("Intb");
	echo $Intb->make(11)->call("times", 2)->call("remove", 3)->call("opposite");
?>  