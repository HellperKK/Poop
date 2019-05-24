<?php
	function _self(){
		$objet = debug_backtrace();
		//~ $filtre = array_filter($objet, function($i){return isset($i["object"]);});
		return $objet[2]["object"];
	}
	function _get($nom){
		return $GLOBALS[$nom];
	}
	// function _super(){
	// 	return _self()->call("parent");
	// }
	class __instance__{
		function __construct($genitor){
			$this->genitor = $genitor;
		}
		function get($nom, $default){
			if(isset($this->$nom)){
				return $this->$nom;
			}
			else{
				return $GLOBALS[$this->genitor]->get_instance($nom, $default);
			}
		}
		function call($nom, ...$args){
			$default = function(...$args){return null;};
			$fonc = $this->get($nom, $default);
			return $fonc(...$args);
		}
		function __toString(){
			return (string) $this->call("to_s");
		}
	}

	class __object__{
		protected $freeze, $genitor, $instances, $valeurs;
		function __construct($name, $genitor){
			$this->name = $name;
			$this->genitor = $genitor;
			$this->instances = [];
			$this->valeurs = [];
			$this->frozen = false;
		}
		function make(...$args){
			if(! $this->frozen){
				$inst = new __instance__($this->name);
				$inst->call("construct", ...$args);
				return $inst;
			}
			else{
				echo "La classe " . $this->name . " est gelee";
			}
		}
		function define_instance($nom, $valeur){
			$this->instances[$nom] = $valeur;
			return $this;
		}
		function get_instance($nom, $default){
			if(isset($this->instances[$nom])){
				return $this->instances[$nom];
			}
			elseif($this->genitor != ""){
				return $GLOBALS[$this->genitor]->get_instance($nom, $default);
			}
			else{
				return $default;
			}
		}
		function make_child($classe){
			$GLOBALS[$classe] = new __object__($classe, $this->name);
			return $GLOBALS[$classe];
		}
		function define($nom, $valeur){
			$this->valeurs[$nom] = $valeur;
			return $this;
		}
		function get($nom, $default) {
			if(isset($this->valeurs[$nom])){
				return $this->valeurs[$nom];
			}
			elseif($this->genitor != ""){
				return $GLOBALS[$this->genitor]->get($nom, $default);
			}
			else{
				return $default;
			}
		}
		function call($nom, ...$args){
			$default = function(...$args){return null;};
			$fonc = $this->get($nom, $default);
			return $fonc(...$args);
		}
		function freeze(){
			$this->frozen = true;
		}
		function __toString(){
			return (string) $this->call("to_s");
		}
	}
//Definition de la classe Object
	$Object = new __object__("Object", "");
	$Object->freeze();
	include "Primitives.php";
	$Object->define("to_s", function(){return "Je suis un " . _self()->name . " !";});
	$Object->define_instance("construct", function(...$args){_self()->args = $args;});
	$Object->define_instance("to_s", function(){return "";});
	$Object->define_instance("parent", function(){
		return _get(_self()->genitor);
	});
?>
