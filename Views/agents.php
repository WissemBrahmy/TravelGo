	<?php
	
		$agents=$admin->getAllAgents();
		

	
	
	
	if(isset($_POST["matricule"],
		$_POST["nom"],
		$_POST["prenom"],
		$_POST["cin"]

		,$_SESSION['id']) && !isset($_POST['id'])){
	
					

			

		
			
		$admin->addAgent((object)$_POST);
	} 

	if(isset($_POST['id'],$_SESSION['id'])){
	
	
					

			

		
			
		$admin->updateAgent((object)$_POST);
	} 

	
	

	
	
	if( isset($_GET["action"])&&$_GET["action"]=="delete" &&isset($_SESSION['id'])){
		$id=$_GET["id"];
		
		
	$admin->deleteAgent($id);

	}
		

	




	
	?>
	
	<div class="main">			
	
		
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">
					Agents
					 	
				</h2>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">

					
					<div class="panel-body">
					<button class="btn-lg btn-primary" data-toggle="modal" data-target="#addModal">Ajout</button>
									

						<table data-toggle="table"    data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						  						        <th data-field="matricule" data-sortable="true">matricule</th>

						  						          <th data-field="cin" data-sortable="true">cin</th>
						  						  
						  						         <th data-field="nom" data-sortable="true">Nom</th>
						  						         <th data-field="prenom" data-sortable="true">prenom</th>
						  						          <th data-field="date naissance" data-sortable="true">date naissance</th>
						  						          <th data-field="sexe" data-sortable="true">sexe</th>
						  						           <th data-field="tel" data-sortable="true">Tel</th>
						  						             <th data-field="grade" data-sortable="true">grade</th>
				
						        <th>Action</th>
						    </tr>
						    </thead>
						    <tbody>
						    <?php foreach($agents as $agent){ ?>
						    <tr>
						    <td> <?php echo htmlentities($agent->matricule); ?></td>

						    <td> <?php echo htmlentities($agent->cin); ?></td>
						     <td> <?php echo htmlentities($agent->nom); ?></td>
						      <td> <?php echo htmlentities($agent->prenom); ?></td>
						       <td> <?php echo htmlentities($agent->date_naissance); ?></td>
						         <td> <?php echo htmlentities($agent->sexe); ?></td>
						           <td> <?php echo htmlentities($agent->tel); ?></td>
						             <td> <?php echo htmlentities($agent->grade); ?></td>
						   
						   
						  
						  
							    
							

							
							  
							 

								
									
								

							<td>
				
							   
							    

							    	<a href="index.php?page=agents&action=delete&id=<?php echo $agent->id ; ?>">
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
  	<h2 class="modal-title">Ajout Agent</h2> 
  </div>
     <div class="modal-body">
          <div class="form-group">
       	<label>matricule</label>
       	<input type="text" class="form-control" name="matricule" required="required">
       </div>
   
       <div class="form-group">
       	<label>cin</label>
       	<input type="text" class="form-control" name="cin" required="required">
       </div>
           <div class="form-group">
       	<label>Nom</label>
       	<input type="text" class="form-control" name="nom" required="required">
       </div>
                <div class="form-group">
       	<label>prenom</label>
       	<input type="text" class="form-control" name="prenom" required="required">
       </div>
           <div class="form-group">
       	<label>date_naissance</label>
       	<input type="date" class="form-control" name="date_naissance" required="required">
       </div>

          <div class="form-group">
       	<label>sexe</label>
       	<input type="text" class="form-control" name="sexe" required="required">

       </div>
           <div class="form-group">
       	<label>Tel</label>
       	<input type="text" class="form-control" name="tel" required="required">
       </div>
                  <div class="form-group">
       	<label>grade</label>
       	<input type="text" class="form-control" name="grade" required="required">
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
  	<h2 class="modal-title">Modifier Agent</h2> 
  </div>
     <div class="modal-body">
     <input type="hidden" name="id" id="id">
                      <div class="form-group">
       	<label>matricule</label>
       	<input type="text" class="form-control" id="matricule" name="matricule" required="required">
       </div>
   
       <div class="form-group">
       	<label>cin</label>
       	<input type="text" class="form-control" id="cin" name="cin" required="required">
       </div>
           <div class="form-group">
       	<label>Nom</label>
       	<input type="text" class="form-control" id="nom" name="nom" required="required">
       </div>
                <div class="form-group">
       	<label>prenom</label>
       	<input type="text" class="form-control" id="prenom" name="prenom" required="required">
       </div>
           <div class="form-group">
       	<label>date_naissance</label>
       	<input type="date" class="form-control" id="date_naissance" name="date_naissance" required="required">
       </div>

          <div class="form-group">
       	<label>sexe</label>
       	<input type="text" class="form-control" id="sexe" name="sexe" required="required">

       </div>
           <div class="form-group">
       	<label>Tel</label>
       	<input type="text" class="form-control"  id="tel" name="tel" required="required">
       </div>
                  <div class="form-group">
       	<label>grade</label>
       	<input type="text" class="form-control"  id="grade" name="grade" required="required">
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
			$("#updateModal #cin").val(data.cin);
			$("#updateModal #nom").val(data.nom);
			$("#updateModal #prenom").val(data.prenom);
			$("#updateModal #sexe").val(data.sexe);
			$("#updateModal #tel").val(data.tel);
			$("#updateModal #grade").val(data.grade);
			$("#updateModal #date_naissance").val(data.date_naissance);
			$("#updateModal #matricule").val(data.matricule);


			$("#updateModal #id").val(data.id);
			$('#updateModal').modal();



		}
	</script>



