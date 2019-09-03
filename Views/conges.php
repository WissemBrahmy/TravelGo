	<?php
	
		$conges=$admin->getAllConges();
		$agents=$admin->getAllAgents();
		

	
	
	
	if(isset($_POST["date_deb"],
		$_POST["date_fin"],
		$_POST["agent"]
		,$_SESSION['id']) && !isset($_POST['id'])){
	
					

			

		
			
		$admin->addConges((object)$_POST);
	} 

	if(isset($_POST['id'],$_SESSION['id'])){
	
	
					

			

		
			
		$admin->updateConges((object)$_POST);
	} 

	
	

	
	
	if( isset($_GET["action"])&&$_GET["action"]=="delete" &&isset($_SESSION['id'])){
		$id=$_GET["id"];
		
		
	$admin->deleteConges($id);

	}
		

	




	
	?>
	
	<div class="main">			
	
		
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">
					Conges
					 	
				</h2>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default" id="mypanel">

					
					<div class="panel-body">
					<button  id="myButton" class="btn-lg btn-primary" data-toggle="modal" data-target="#addModal">Ajout</button>
						<button onclick="printthis()" class="btn-lg btn-warning" >Imprimer</button>
									

						<table data-toggle="table"    data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						  						        <th data-field="date_deb" data-sortable="true">date_deb</th>

						  						          <th data-field="date_fin" data-sortable="true">date_fin</th>
						  						  
						  						         <th data-field="agent" data-sortable="true">agent</th>
						  						 
				
						        <th class="hdd">Action</th>
						    </tr>
						    </thead>
						    <tbody>
						    <?php foreach($conges as $agent){ ?>
						    <tr>
						    <td> <?php echo htmlentities($agent->date_deb); ?></td>

						    <td> <?php echo htmlentities($agent->date_fin); ?></td>
						     <td> <?php echo htmlentities($agent->matricule); ?> | <?php echo htmlentities($agent->nom); ?>-<?php echo htmlentities($agent->prenom); ?></td>
						      
						     
						   
						   
						  
						  
							    
							

							
							  
							 

								
									
								

							<td class="hdd">
				
							   
							    

							    	<a href="index.php?page=conges&action=delete&id=<?php echo $agent->id ; ?>">
							    		<button class="btn btn-danger" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
							    	</a>
							    		<button  onclick='update(<?php echo json_encode($agent); ?>)' class="btn btn-warning" >
							    		Modifier
							    			
							    		</button>
							    	
							    	
							    	

							   

							    
						    	
								

						    </td>
<!-- Modal -->


						    </tr>  

						    <?php } ?>  

						    </tbody>
						</table>
					</div>
				</div>

			</div>
		</div><!--/.row-->	




<div class="modal fade bs-example-modal-sm" id="addModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">
        <form method="post" id="myForm" >
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  	<h2 class="modal-title">Ajout Conges</h2> 
  </div>
     <div class="modal-body">
          <div class="form-group">
       	<label>date_deb</label>
       	<input type="date" class="form-control" name="date_deb" required="required">
       </div>
             <div class="form-group">
       	<label>date_fin</label>
       	<input type="date" class="form-control" name="date_fin" required="required">
       </div>
   
    
             <div class="form-group">
           	<select class="form-control"  name="agent">
           	<?php foreach($agents as $a){ ?>
           	<option value="<?= $a->id ; ?>"><?= $a->matricule ?> | <?= $a->nom ?>-<?= $a->prenom ; ?></option>
           	<?php } ?>
           		
           	</select>
           </div>
           
         


     
     
    
     
      

       
     
      
      </div>
      <div class="modal-footer">
        
        <input type="submit" class="btn btn-primary" value="Confirmer">
      </div>
      </form>
     
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-sm" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">
        <form method="post"  >
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  	<h2 class="modal-title">Modifier Conges</h2> 
  </div>
     <div class="modal-body">
     <input type="hidden" name="id" id="id">
                      <div class="form-group">
       	<label>date</label>
       	<input type="date_deb" class="form-control" id="date_deb" name="date_deb" required="required">
       </div>
   
       <div class="form-group">
       	<label>date_fin</label>
       	<input type="date" class="form-control" id="date_fin" name="date_fin" required="required">
       </div>
           <div class="form-group">
           	<select class="form-control" id="agent" name="agent">
           	<?php foreach($agents as $a){ ?>
           	<option value="<?= $a->id ; ?>"><?= $a->matricule ?> | <?= $a->nom ?>-<?= $a->prenom ; ?></option>
           	<?php } ?>
           		
           	</select>
           </div>
           	
                


          
    
         


     
     
    
     
      

       
     
      
      </div>
      <div class="modal-footer">
        
        <input type="submit" class="btn btn-primary" value="Confirm">
      </div>
      </form>
     
    </div>
  </div>
</div>






		
		
	</div><!--/.main-->
		<script type="text/javascript">

		function update(data) {
			console.log(data);
			$("#updateModal #date_deb").val(data.date_deb);
			$("#updateModal #date_fin").val(data.date_fin);
			$("#updateModal #agent").val(data.user_id);
	


			$("#updateModal #id").val(data.id);
			$('#updateModal').modal();



		}
	</script>
		<script>
	function printthis() {
		
		  newWin= window.open("");
   newWin.document.write('<link href="css/bootstrap.min.css" rel="stylesheet"><link href="css/datepicker3.css" rel="stylesheet"><link href="css/styles.css" rel="stylesheet"><link href="css/bootstrap-table.css" rel="stylesheet"> <style>.form-control,.fixed-table-pagination,#mybutton,#mailthis,.hdd{ display:none;}  </style><center> <h3>Conges</h3></center>'+$("#mypanel").html());
  
$(newWin).ready(function(){ 
setTimeout(function() {
	newWin.print();
	 newWin.close();
},200);
});
  

	}

</script>



