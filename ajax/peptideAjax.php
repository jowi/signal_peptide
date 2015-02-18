<?php



include '../lib/PDO_connect.php';
 



$detailView = new DetailView($db, $_REQUEST['recordid']); //$db object form included file
echo $detailView->createTable();



class DetailView {

	protected $db;
	protected $recordid;

	public function __construct($db, $recordid) {
		$this->db = $db;
		$this->recordid = $recordid;
	}


	public function getRecordInfo() {

		$query_str = "SELECT * FROM sp_protein WHERE id = ".$this->recordid;

		$query = $this->db->prepare( $query_str );
		$query->execute();
		// $data = $query->fetchAll();
		$data = $query->fetch(PDO::FETCH_ASSOC);

		return $data;
	}


	public function createTable() {

		$data = $this->getRecordInfo();

		/*UNCOMMENT ME TO SHOW DATA ARRAY*/
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		/*UNCOMMENT ME TO SHOW DATA ARRAY*/

		$str = "<table>";

		$str .= "<tr><td>{$data['entry_ID']} ({$data['entry_name']})</td><td>jowiiiiii</td></tr>";
		$str .= "<tr><td>{$data['entry_ID']} ({$data['entry_name']})</td><td>jowiiiiii</td></tr>";
		$str .= "<tr><td>{$data['entry_ID']} ({$data['entry_name']})</td><td>jowiiiiii</td></tr>";
		$str .= "<tr><td>{$data['entry_ID']} ({$data['entry_name']})</td><td>jowiiiiii</td></tr>";
		$str .= "<tr><td>{$data['entry_ID']} ({$data['entry_name']})</td><td>jowiiiiii</td></tr>";
		$str .= "<tr><td>{$data['entry_ID']} ({$data['entry_name']})</td><td>jowiiiiii</td></tr>";
		$str .= "<tr><td>{$data['entry_ID']} ({$data['entry_name']})</td><td>jowiiiiii</td></tr>";
		$str .= "<tr><td>{$data['entry_ID']} ({$data['entry_name']})</td><td>jowiiiiii</td></tr>";


		$str .= "</table>";


		return $str;
	}
}

?>