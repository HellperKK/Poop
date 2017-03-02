<?php 

//Definition de la classe Booleen
	$Object->make_child("Booleen");
	$Booleen->define_instance("construct", function(){
	});

//Definition de la classe True
	$Booleen->make_child("True");
	$True->define_instance("not", function(){
		return _get("false");
	});

//Definition de la classe False
	$Booleen->make_child("False");
	$False->define_instance("not", function(){
		return _get("true");
	});

//Creation des instances uniques true et false
	$true = $True->make();
	$false = $False->make();

//Gel des booleens
	$Booleen->freeze();
	$True->freeze();
	$False->freeze();

//Definition de la classe Int
	$Object->make_child("Int");
	$Int->define_instance("construct", function($val){
		_self()->val = (int) $val;
	});
	$Int->define_instance("to_s", function(){return _self()->val;});
	$Int->define_instance("opposite", function(){
		return _self()->call("parent")->make(- _self()->val);
	});
	$Int->define_instance("add", function($anInt){
		return _self()->call("parent")->make(_self()->val + $anInt);
	});
	$Int->define_instance("remove", function($anInt){
		return _self()->call("parent")->make(_self()->val - $anInt);
	});
	$Int->define_instance("times", function($anInt){
		if($anInt > 0){
			return _self()->call("times", $anInt - 1)->call("add", _self()->val);
		}
		else{
			return _self()->call("parent")->make(0);
		}
	});
	$Int->define_instance("pow", function($anInt){
		if($anInt > 0){
			return _self()->call("pow", $anInt - 1)->call("times", _self()->val);
		}
		else{
			return _self()->call("parent")->make(1);
		}
	});
?>