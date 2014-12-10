<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../lib/Model.php');

class SPProteinModel extends Model {

    public $id;

	public $entryId;
	public $entryName;
	public $recommendedName;
	public $alternativeName;
	public $organism;
	public $taxonomicLineage;
	public $proteinExistence;
	public $functions;
	public $subunitStructure;
	public $subcellularLocation;
	public $postTranslational;
	public $polymorphism;
	public $sequenceSimilarities;
	public $sequence;
	public $sequenceLength;
	public $dateCreated;
	public $dateLastModified;
	
    
	
    public $limit = null;
    public $offset = null;

    public function id($id = null) {
        return empty($id) ? $this->id : $this->id = $id;
    }

    public function entryId($entryId = null) {
        return empty($entryId) ? $this->entryId : $this->entryId = $entryId;
    }
	
	public function entryName($entryName = null){
		return empty($entryName) ? $this->entryName : $this->entryName = $entryName;
	}
	
	public function recommendedName($recommendedName = null) {
		return empty($recommendedName) ? $this->recommendedName : $this->recommendedName = $recommendedName;
	}
	
	public function alternativeName($alternativeName = null) {
		return empty($alternativeName) ? $this->alternativeName : $this->alternativeName = $alternativeName;
	}
	
	public function organism($organism = null) {
		return empty($organism) ? $this->organism : $this->organism = $organism;
	}
	
	public function taxonomicLineage($taxonomicLineage = null) {
		return empty($taxonomicLineage) ? $this->taxonomicLineage : $this->taxonomicLineage = $taxonomicLineage;
	}
	
	public function proteinExistence($proteinExistence = null) {
		return empty($proteinExistence) ? $this->proteinExistence : $this->proteinExistence = $proteinExistence;
	}
	
	public function functions($functions = null) {
		return empty($functions) ? $this->functions : $this->functions = $functions;
	}
	
	public function subunitStructure($subunitStructure = null) {
		return empty($subunitStructure) ? $this->subunitStructure : $this->subunitStructure = $subunitStructure;
	}
	
	public function subcellularLocation($subcellularLocation = null) {
		return empty($subcellularLocation) ? $this->subcellularLocation : $this->subcellularLocation = $subcellularLocation;
	}
	
	public function postTranslational($postTranslational = null) {
		return empty($postTranslational) ? $this->postTranslational : $this->postTranslational = $postTranslational;
	}
	
	public function sequenceSimilarities($sequenceSimilarities = null) {
		return empty($sequenceSimilarities) ? $this->sequenceSimilarities : $this->sequenceSimilarities = $sequenceSimilarities;
	}
	
	public function sequence($sequence = null) {
		return empty($sequence) ? $this->sequence : $this->sequence = $sequence;
	}
	
	public function sequenceLength($sequenceLength = null) {
		return empty($sequenceLength) ? $this->sequenceLength : $this->sequenceLength = $sequenceLength;
	}
	
	public function polymorphism($polymorphism = null) {
		return empty($polymorphism) ? $this->polymorphism : $this->polymorphism = $polymorphism;
	}
	
	public function dateCreated($dateCreated = null) {
		return empty($dateCreated) ? $this->dateCreated : $this->dateCreated = $dateCreated;
	}
	
	public function dateLastModified($dateLastModified = null) {
		return empty($dateLastModified) ? $this->dateLastModified : $this->dateLastModified = $dateLastModified;
	}

    public function __construct($tableName = null) {
        parent::__construct();        
		empty($tableName) ? $this->tableName = "sp_protein" : $this->tableName = $tableName;
    }
	
	public function values($rows = array()){
		
		if(count($rows) > 0) {
			
			$this->dateLastModified = $rows['date_last_modified'];
			$this->dateCreated = $rows['date_created'];
			$this->sequenceSimilarities = $rows['sequence_similarities'];
			$this->sequence = $rows['sequence'];
			$this->postTranslational =$rows['post_translational'];
			$this->subcellularLocation = $rows['subcellular_location'];
			$this->polymorphism = $rows['polymorphism'];
			$this->entryId = $rows['entry_ID'];
			$this->entryName = $rows['entry_name'];
			$this->recommendedName = $rows['recommended_name'];
			$this->alternativeName = $rows['alternative_name'];
			$this->organism = $rows['organism'];
			$this->taxonomicLineage = $rows['taxonomic_lineage'];
			$this->proteinExistence = $rows['protein_existence'];
			$this->functions = $rows['function'];
			$this->subunitStructure = $rows['subunit_structure'];
			$this->sequenceLength = $rows['sequence_length'];
			
		} 
	
	}
    
    public function save(){
        
		$dateLastModified = $this->dateLastModified;
		$dateCreated = $this->dateCreated;
		$sequenceSimilarities = mysql_real_escape_string($this->sequenceSimilarities);
		$sequence = $this->sequence;
		$postTranslational = mysql_real_escape_string($this->postTranslational);
		$subcellularLocation = mysql_real_escape_string($this->subcellularLocation);
		$polymorphism = mysql_real_escape_string($this->polymorphism);
		$entryId = $this->entryId;
		$entryName = $this->entryName;
		$recommendedName = $this->recommendedName;
		$alternativeName = $this->alternativeName;
		$organism = mysql_real_escape_string($this->organism);
		$taxonomicLineage = mysql_real_escape_string($this->taxonomicLineage);
		$proteinExistence = mysql_real_escape_string($this->proteinExistence);
		$functions = mysql_real_escape_string($this->functions);
		$subunitStructure = mysql_real_escape_string($this->subunitStructure);
		$sequenceLength = $this->sequenceLength;
		
		
		$this->dbConn->qry(" insert into ".$this->tableName."(`sequence`,`sequence_similarities`,`polymorphism`,`post_translational`,`subcellular_location`,`subunit_structure`,`function`,`protein_existence`,`sequence_length`,`taxonomic_lineage`,`organism`,`alternative_name`,`recommended_name`,`date_created`,`entry_name`,`entry_ID`,`date_last_modified`) values('$sequence','$sequenceSimilarities','$polymorphism','$postTranslational','$subcellularLocation','$subunitStructure','$functions','$proteinExistence','$sequenceLength','$taxonomicLineage','$organism','$alternativeName','$recommendedName','$dateCreated','$entryName','$entryId', '$dateLastModified') ");

        return mysql_insert_id();
		
		
    }
	
	public function checkIfExist(){
	
		$updates = empty($this->dateLastModified) ? "" : " date_last_modified='".$this->dateLastModified."'" ;
		$updates .= empty($this->dateCreated) ? "" : (($updates != "") ? " and date_created='".$this->dateCreated."'"  : " date_created='".$this->dateCreated."'" );
		$updates .= empty($this->sequenceSimilarities) ? "" : (($updates != "") ? " and sequence_similarities='".mysql_real_escape_string($this->sequenceSimilarities)."'"  : " sequence_similarities='".mysql_real_escape_string($this->sequenceSimilarities)."'" );
		$updates .= empty($this->sequence) ? "" : (($updates != "") ? " and sequence='".$this->sequence."'"  : " sequence='".$this->sequence."'" );
		$updates .= empty($this->postTranslational) ? "" : (($updates != "") ? " and post_translational='".mysql_real_escape_string($this->postTranslational)."'"  : " post_translational='".mysql_real_escape_string($this->postTranslational)."'" );
		$updates .= empty($this->subcellularLocation) ? "" : (($updates != "") ? " and subcellular_location='".mysql_real_escape_string($this->subcellularLocation)."'"  : " subcellular_location='".mysql_real_escape_string($this->subcellularLocation)."'" );
		
		$updates .= empty($this->entryId) ? "" : (($updates != "") ? " and entry_ID='".$this->entryId."'"  : " entry_ID='".$this->entryId."'" );
		$updates .= empty($this->entryName) ? "" : (($updates != "") ? " and entry_name='".$this->entryName."'"  : " entry_name='".$this->entryName."'" );
		$updates .= empty($this->recommendedName) ? "" : (($updates != "") ? " and recommended_name='".$this->recommendedName."'"  : " recommended_name='".$this->recommendedName."'" );
		$updates .= empty($this->alternativeName) ? "" : (($updates != "") ? " and alternative_name='".$this->alternativeName."'"  : " alternative_name='".$this->alternativeName."'" );
		$updates .= empty($this->organism) ? "" : (($updates != "") ? " and organism='".mysql_real_escape_string($this->organism)."'"  : " organism='".mysql_real_escape_string($this->organism)."'" );
		$updates .= empty($this->taxonomicLineage) ? "" : (($updates != "") ? " and taxonomic_lineage='".mysql_real_escape_string($this->taxonomicLineage)."'"  : " taxonomic_lineage='".mysql_real_escape_string($this->taxonomicLineage)."'" );
		$updates .= empty($this->proteinExistence) ? "" : (($updates != "") ? " and protein_existence='".mysql_real_escape_string($this->proteinExistence)."'"  : " protein_existence='".mysql_real_escape_string($this->proteinExistence)."'" );
		$updates .= empty($this->functions) ? "" : (($updates != "") ? " and function='".mysql_real_escape_string($this->functions)."'"  : " function='".mysql_real_escape_string($this->functions)."'" );
		$updates .= empty($this->subunitStructure) ? "" : (($updates != "") ? " and subunit_structure='".mysql_real_escape_string($this->subunitStructure)."'"  : " subunit_structure='".mysql_real_escape_string($this->subunitStructure)."'" );
		$updates .= empty($this->sequenceLength) ? "" : (($updates != "") ? " and sequence_length='".$this->sequenceLength."'" : " sequence_length='".$this->sequenceLength."'" );
		
		$updates .= empty($this->polymorphism) ? "" : (($updates != "") ? " and polymorphism='".mysql_real_escape_string($this->polymorphism)."'" : " polymorphism='".mysql_real_escape_string($this->polymorphism)."'" );
			
		
		$rs = $this->dbConn->qry(" Select * from ".$this->tableName." WHERE $updates ");
		
		return mysql_fetch_assoc($rs);
		
	}
    
    public function delete() {
        
		$id = $this->id;
        
        $this->dbConn->qry(" DELETE FROM ".$this->tableName." WHERE id='$id' ");
        
        return true;
		
    }
    
    public function update() {
		
	    $updates = empty($this->dateLastModified) ? "" : " date_last_modified='".$this->dateLastModified."'" ;
		$updates .= empty($this->dateCreated) ? "" : (($updates != "") ? ", date_created='".$this->dateCreated."'"  : " date_created='".$this->dateCreated."'" );
		
		
		$updates .= empty($this->entryId) ? "" : (($updates != "") ? ", entry_ID='".$this->entryId."'"  : " entry_ID='".$this->entryId."'" );
		$updates .= empty($this->entryName) ? "" : (($updates != "") ? ", entry_name='".$this->entryName."'"  : " entry_name='".$this->entryName."'" );
		$updates .= empty($this->recommendedName) ? "" : (($updates != "") ? ", recommended_name='".$this->recommendedName."'"  : " recommended_name='".$this->recommendedName."'" );
		$updates .= empty($this->alternativeName) ? "" : (($updates != "") ? ", alternative_name='".$this->alternativeName."'"  : " alternative_name='".$this->alternativeName."'" );
		$updates .= empty($this->organism) ? "" : (($updates != "") ? ", organism='".mysql_real_escape_string($this->organism)."'"  : " organism='".mysql_real_escape_string($this->organism)."'" );
		$updates .= empty($this->taxonomicLineage) ? "" : (($updates != "") ? ", taxonomic_lineage='".mysql_real_escape_string($this->taxonomicLineage)."'"  : " taxonomic_lineage='".mysql_real_escape_string($this->taxonomicLineage)."'" );
		$updates .= empty($this->proteinExistence) ? "" : (($updates != "") ? ", protein_existence='".$this->proteinExistence."'"  : " protein_existence='".$this->proteinExistence."'" );
		$updates .= empty($this->functions) ? "" : (($updates != "") ? ", function='".mysql_real_escape_string($this->functions)."'"  : " function='".mysql_real_escape_string($this->functions)."'" );
		$updates .= empty($this->subunitStructure) ? "" : (($updates != "") ? ", subunit_structure='".mysql_real_escape_string($this->subunitStructure)."'"  : " subunit_structure='".mysql_real_escape_string($this->subunitStructure)."'" );
		$updates .= empty($this->sequenceLength) ? "" : (($updates != "") ? ", sequence_length='".$this->sequenceLength."'" : " sequence_length='".$this->sequenceLength."'" );
		$updates .= empty($this->sequence) ? "" : (($updates != "") ? ", sequence='".$this->sequence."'"  : " sequence='".$this->sequence."'" );
		$updates .= empty($this->postTranslational) ? "" : (($updates != "") ? ", post_translational='".mysql_real_escape_string($this->postTranslational)."'"  : " post_translational='".mysql_real_escape_string($this->postTranslational)."'" );
		$updates .= empty($this->subcellularLocation) ? "" : (($updates != "") ? ", subcellular_location='".mysql_real_escape_string($this->subcellularLocation)."'"  : " subcellular_location='".mysql_real_escape_string($this->subcellularLocation)."'" ); 
		$updates .= empty($this->sequenceSimilarities) ? "" : (($updates != "") ? ", sequence_similarities='".mysql_real_escape_string($this->sequenceSimilarities)."'"  : " sequence_similarities='".mysql_real_escape_string($this->sequenceSimilarities)."'" );
		
		$updates .= empty($this->polymorphism) ? "" : (($updates != "") ? ", polymorphism='".mysql_real_escape_string($this->polymorphism)."'" : " polymorphism='".mysql_real_escape_string($this->polymorphism)."'" );
		
		
		$id = $this->id;	
		
		$this->dbConn->qry(" UPDATE ".$this->tableName." SET $updates WHERE id='$id' ");
		
		return true;
		
    }
	
	

}

?>
