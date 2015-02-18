<div class="bs-examples" style="border:1px solid black; ">
	<div id="recordChart" class="modal fade">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-info">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h1 class="modal-title text-primary fa fa-user "><?php echo " Entry"; ?> Chart</h1>
				</div>

				<div class="modal-body">
					<div class="container">
						<div id="chart-area" style="min-height:400px" ></div>
					</div>
					
				</div>

			</div>
		</div>
	</div>
</div>
<!-- 	<div id="chart-area" style="height:2000px" ></div> -->





<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script>

	

	function createData() {
		var peptide_data = <?php echo json_encode($data); ?>;

		// console.log(peptide_data);
		var new_data = new Array();


			new_data.push(new Array('Entry Name', 'Length' ));

		// $cnt = 0;
		$.each(peptide_data, function(key, value){	

			var l = parseInt( $.trim( value.sequence_length.replace('AA','') ) );

			// if(l > 1000)
			// 	console.log( value.entry_name+' '+ l);

			new_data.push( new Array(value.entry_name,  l ) );

			// $cnt++;
			// if( $cnt == 12 )
			// 	return false;

		});

		// return new Array( new Array('Dino', 'Length'), new Array('Dino', 2) );
		return new_data;
	}



	google.load("visualization", "1", {packages:["corechart"]});
	// google.setOnLoadCallback(drawChart);


	$(document).ready(function(){  
		$('#recordChart').on('shown.bs.modal', function (e) {

			// console.log('>>>>>');
			// console.log(createData());
			

			var data = google.visualization.arrayToDataTable( createData() );

			var options = {
			  title: 'Sequence Lengths , in AA',
			  legend: { position: 'none' },
			  // histogram: { bucketSize: 5 },
			  width: '80%', height: '100%',
			  chartArea:{ left: '5%', top: '8%', width: "80%", height: "70%" },
			// chartArea: {top: 0, right: 0, bottom: 0, height:'95%', width:'70%'},

				hAxis: {showTextEvery: 0, slantedText: true, slantedTextAngle: 90}			  
			};



			// var height = data.getNumberOfRows() * 41 + 30;
			var height = data.getNumberOfRows() * 2 + 30;


			$(this).find('#chart-area').css({height: height});

			var chart = new google.visualization.Histogram(document.getElementById('chart-area'));
			chart.draw(data, options);


			//resize modal
			$('.modal .modal-body').css('max-height', $(window).height() * 0.8);
			$('.modal .modal-lg').css('width', $(window).width() * 0.8);
			$('.modal .modal-body').css('overflow-y', 'auto'); 
			//resize modal


		});
	});


</script>
