<?php
	session_start();
	error_reporting(E_ALL);
	

	if(!isset($_SESSION['peptide']) && !isset($_SESSION['proteinType']) && !isset($_SESSION['evidenceLevel']) && !isset($_SESSION['taxonomy'])){
		// set post into session
		$_SESSION['peptide'] = $_POST['peptide'];
		$_SESSION['proteinType'] = $_POST['proteinType'];
		$_SESSION['evidenceLevel'] = $_POST['evidenceLevel'];
		$_SESSION['taxonomy'] = $_POST["taxonomy"];

		$peptide = $_SESSION['peptide'];
		$proteinType = $_SESSION['proteinType'];
		$evidenceLevel = $_SESSION['evidenceLevel'];
		$taxonomy = $_SESSION["taxonomy"];
	}

		$peptide = $_SESSION['peptide'];
		$proteinType = $_SESSION['proteinType'];
		$evidenceLevel = $_SESSION['evidenceLevel'];
		$taxonomy = $_SESSION["taxonomy"];

		$dataFilter = new DataFilter();

		$_SESSION['filter'] = $_GET['filter'];
		// echo "<pre>";
		// print_r($dataFilter->getOriginal());
		// echo "</pre>";	
		$msg = $dataFilter->getSelected($peptide, $proteinType, $evidenceLevel, $taxonomy);
	// print_r($msg);

	class DataFilter{
		public function __construct(){

		}

		public function getSelected($peptide, $proteinType, $evidenceLevel, $taxonomy){

			return array(
						"peptide" => $peptide,
						"proteinType" => $proteinType,
						"evidenceLevel" => $evidenceLevel,
						"taxonomy" => $taxonomy
						);
		}
		function fetchData(){
			include 'lib/PDO_connect.php';
			$query = $db->prepare("SELECT * FROM sp_protein");
			$query->execute();
			$rows = $query->fetchAll();

			// }
			return $rows;
		}
}
?>