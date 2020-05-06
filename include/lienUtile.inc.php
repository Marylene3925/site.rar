<?php

							$cheminImages = "./images/lienUtile";
							
							$sql_navig = "SELECT *
									FROM lienUtile
									
									ORDER BY id DESC 
									
									";
							
							

							
							$cl_db->query($sql_navig);
							$cpt = 0;
							
								
							while ($cl_db->next_record()) {
								
								$cpt++;
								
							
								$id = $cl_db->record['id'];
								
								$titre = htmlspecialchars(utf8_encode($cl_db->record['titre']));
								$site = htmlspecialchars(utf8_encode($cl_db->record["site"]));
								
								
								
								for ($i=1; $i<=1; $i++) {
									$image = ( (file_exists("$cheminImages/min_" . $id . "_$i.jpg")) ? "<img  alt=\"$titre\" class=\"img-responsive\" src=\"$cheminImages/" . $id . "_$i.jpg\" />" :  '' );
								}
								
								if ( $image != '') {
?>
	

			
				<div class="item tool_tip">
					<a target="_blank" href="<?php echo $site; ?>"><?php echo $image; ?></a>
				</div>
				
				
				
		
	
<?php
							}
						}
?>