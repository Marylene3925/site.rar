
<?php								


	$cl_db = new cl_db_mysql;
	$cl_db->start();
	$sql = "SELECT * FROM actualiteALaUne";
	$cl_db->query($sql);
	
	$bShowActu = false;
	
	if ($cl_db->num_rows() > 0) {
								
		$cl_db->next_record();
		
		
		$bShowActu = $cl_db->record['bDefilement'];
		
		if ($cl_db->record['bDefilement'] == 1) { //bAfficher ici
			
			
			
?>
		

		
		<div class="actuALaUne">
		<marquee id="marqueeActu" behavior="scroll" direction="left"   scrollamount="2" scrolldelay="1" onmouseover='this.stop()' onmouseout='this.start()'>
<?php
			echo $cl_db->record['descriptifRTF'];
?>
		
		
		</marquee>
		</div>
		
		
		
		
<?php
		}
	}
	
?>