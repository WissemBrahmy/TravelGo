	<?php
	
		$jours_feriers=$admin->getAllJours_feriers();
		

	
	
	
	if(isset($_POST["name"],$_POST["date"],$_SESSION['id']) && !isset($_POST['id'])){
	
					

			

		
			
		$admin->addJour_ferier((object)$_POST);
	} 

	if(isset($_POST["name"],$_POST["date"],$_POST['id'],$_SESSION['id'])){
	
	
					

			

		
			
		$admin->updateJour_ferier((object)$_POST);
	} 

	
	

	
	
	if( isset($_GET["action"])&&$_GET["action"]=="delete" &&isset($_SESSION['id'])){
		$id=$_GET["id"];
		
		
	$admin->deleteJour_ferier($id);

	}
		

	




	
	?>
	
	<div class="main">			
	
		
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">
					Jours Feriers
					 	
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
						  						        <th data-field="nom" data-sortable="true">Nom</th>
						  						  
						  						   
						  						            <th data-field="date" data-sortable="true">Date</th>
						  						

						     
						        
						       
						      
						        <th>Action</th>
						    </tr>
						    </thead>
						    <tbody>
						    <?php foreach($jours_feriers as $jour_ferier){ ?>
						    <tr>
						     <td> <?php echo htmlentities($jour_ferier->name); ?></td>
						      <td> <?php echo htmlentities($jour_ferier->date); ?></td>
						      
						   
						  
						  
							    
							

							
							  
							 

								
									
								

							<td>
				
							   
							    

							    	<a href="index.php?page=jours_feriers&action=delete&id=<?php echo $jour_ferier->id ; ?>">
							    		<button class="btn btn-danger" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
							    	</a>
							    		<button  onclick='update(<?php echo json_encode($jour_ferier); ?>)' class="btn btn-warning" >
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
  	<h2 class="modal-title">Ajout Jour</h2> 
  </div>
     <div class="modal-body">
   
    
           <div class="form-group">
       	<label>Nom</label>
       	<input type="text" class="form-control" name="name" required="required">
       </div>
           <div class="form-group">
       	<label>Date</label>
       	<input type="date" class="form-control" name="date" required="required">
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
  	<h2 class="modal-title">Modifier Jour</h2> 
  </div>
     <div class="modal-body">
     <input type="hidden" name="id" id="id">
            <div class="form-group">
       	<label>Nom</label>
       	<input type="text" class="form-control" name="name" id="name" required="required">
       </div>
   
    
       <div class="form-group">
       	<label>Date</label>
       	<input type="date" class="form-control" name="date" id="date" required="required">
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
		
			$("#updateModal #name").val(data.name);
				$("#updateModal #date").val(data.date);



			$("#updateModal #id").val(data.id);
			$('#updateModal').modal();



		}
	</script>



