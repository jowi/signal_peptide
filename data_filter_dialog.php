<div class="bs-examples">
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-primary ">Data Filter</h4>
                </div>
                <form role="form" name="generate" action="entries?filter=default" method="post">
                	<div class="modal-body">		                    
                    	<div class="form-group">
                    		<label for="recipient-name" class="control-label">Signal Peptide:</label>
	                    	<div class="radio">
	                    		<label><input type="radio" name="peptide" value="Yes" checked="checked">Yes</label>
								<label><input type="radio" name="peptide" value="No">No</label>
					        </div>
					    </div>
					    <div class="form-group">
                            <label for="recipient-name" class="control-label">Protein Type:</label>
                            <select class="form-control" name="proteinType">
                            	<option value="None">-Select-</option>
								<option value="All">All</option>
								<option value="Transmembrane">Transmembrane</option>
								<option value="Globular">Globular</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Evidence Level:</label>
                            <select class="form-control" name="evidenceLevel">
                            	<option value="None">-Select-</option>
								<option value="Qualifed Experimental Entries">Qualifed Experimental Entries</option>
								<option value="Unqualified Experimental Entries">Unqualified Experimental Entries</option>
								<option value="Non-experimental Entries">Non-experimental Entries</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Taxonomy:</label>
                            <select class="form-control" name="taxonomy">
                            	<option value="None">-Select-</option>
								<option value="Eukaryote">Eukaryote</option>
								<option value="Prokaryote">Prokaryote</option>
								<option value="Viruses">Viruses</option>
                            </select>
                        </div>
                        <!-- <div class="form-group">
                    		<label for="recipient-name" class="control-label">Subject to redundancy check?:</label>
	                    	<div class="radio">
	                    		<label><input type="radio" name="redundancy" value="Yes" checked="checked">Yes</label>
								<label><input type="radio" name="redundancy" value="No">No</label>
					        </div>
					    </div> -->
                	</div>
	                <div class="modal-footer">
	                    <button type="submit" class="btn btn-primary" id="generatePeptide">Generate</button>		                
	                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	                </div>
                </form>
            </div>
        </div>
    </div>
</div>
