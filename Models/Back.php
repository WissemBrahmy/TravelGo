<?php
namespace back\Models\backEnd;


use PDO;

use connection\DB as DBB;

class Back
{
		private $db;


	public function __construct() {
		//singletone db instance
	$this->db=DBB::getConnection();

	

	}

		public function login($guest){
		$q=$this->db->prepare("select * from users where login=?");
		$q->execute([$guest->login]);
		if($q->rowCount()) {
			$user=$q->fetch(PDO::FETCH_OBJ);
			if(!password_verify($guest->password,$user->password)) {
				return "<span style='color:red'>Wrong login or password !</span>";
			} 
			$_SESSION['id']=$user->id;
			$_SESSION['name']=$user->nom;
	
			//redirection
			echo "<script>location.href='index.php' </script>";
		} else{
			return "<span style='color:red'>Wrong login or password !</span>";

		}
	

	}
//***********************AGENTS *******************************************//	

//return all admins 
	public function getAllAgents() {
		$q=$this->db->query("select * from users where role=0 ");
		$admins=$q->fetchAll(PDO::FETCH_OBJ);
		
		return $admins;
	}




	
	public function addAgent($admin) {
	
	
		
		$q=$this->db->prepare("insert into users( `matricule`,`cin`, `nom`,`prenom`, `date_naissance`, `tel`,`grade`, `sexe`) values(?,?,?,?,?,?,?,?)");
	
		
		if(
		$q->execute([$admin->matricule,$admin->cin,$admin->nom,$admin->prenom,$admin->date_naissance,$admin->tel,$admin->grade,$admin->sexe]) ) {
			echo "<script>alert(' Agent cree')</script>";
		echo " <script>location.href='index.php?page=agents'</script>";

		} else{
			echo "<script>alert('Probleme ajout agent')</script>";

		}
	

	
	}
			public function updateAgent($admin) {
    $q=$this->db->prepare("update users set matricule=?,cin=?,nom=?, prenom=?,date_naissance=?,tel=?,grade=?, sexe=? where id=? ");

   if( $q->execute([$admin->matricule,


   	$admin->cin,


   	$admin->nom,
   	$admin->prenom,
   	$admin->date_naissance,
   	$admin->tel,
   	$admin->grade,
   	$admin->sexe,
   	$admin->id])) {

   	echo "<script>location.href='index.php?page=agents'; alert(' Agent modifiee');</script>";
   } else{
   	echo "<script> alert('Probleme);</script>";

   }

	}


			




	public function deleteAgent($id) {
		$q=$this->db->prepare("delete from users where id=?");
		if($q->execute([$id])) {
			echo "<script>location.href='index.php?page=agents'; alert('  Agent supprime '); </script>";
		} else{
			echo "<script> alert('Probleme')</script>";
		}
	}
	//***********************AGENTS *******************************************//	

//return all admins 
	public function getAllJours_feriers() {
		$q=$this->db->query("select * from jours_feriers");
		$admins=$q->fetchAll(PDO::FETCH_OBJ);
		
		return $admins;
	}




	
	public function addJour_ferier($admin) {
	
	
		
		$q=$this->db->prepare("insert into jours_feriers( `name`,  `date`) values(?,?)");
	
		
		if(
		$q->execute([$admin->name,$admin->date]) ) {
			echo "<script>alert(' Jour ferier cree')</script>";
		echo " <script>location.href='index.php?page=jours_feriers'</script>";

		} else{
			echo "<script>alert('Probleme ajout ')</script>";

		}
	

	
	}
			public function updateJour_ferier($info) {
    $q=$this->db->prepare("update jours_feriers set name=?,date=? where id=? ");

   if( $q->execute([$info->name,$info->date,$info->id])) {

   	echo "<script>location.href='index.php?page=jours_feriers'; alert(' Jour ferier modifiee');</script>";
   } else{
   	echo "<script> alert('Probleme);</script>";

   }

	}


			




	public function deleteJour_ferier($id) {
		$q=$this->db->prepare("delete from jours_feriers where id=?");
		if($q->execute([$id])) {
			echo "<script>location.href='index.php?page=jours_feriers'; alert('  Jour ferier supprime '); </script>";
		} else{
			echo "<script> alert('Probleme')</script>";
		}
	}
















//***********************************INFOS*************************//

	public function getAllAbsences() {
		$q=$this->db->query("select absences.*,users.nom,users.prenom,users.matricule from absences inner join users on absences.user_id=users.id ");
		$informations=$q->fetchAll(PDO::FETCH_OBJ);
		return $informations;
	}

	public function addAbsence($info) {
		$qq=$this->db->query("select * from jours_feriers where date='".$info->date."'");
		if($qq->rowCount()){
			   	echo "<script>location.href='index.php?page=absences'; alert(' Date d absence est un jour ferier');</script>";

		}
		else{

    $q=$this->db->prepare("insert into absences(date,heures,user_id) values(?,?,?)");
   if( $q->execute([$info->date,$info->heures,$info->agent])) {
   	echo "<script>location.href='index.php?page=absences'; alert(' Autorisation Absence ajoute');</script>";
   } else{
   	echo "<script> alert('Probleme);</script>";

   }
}

	}
		public function updateAbsence($info) {
				$qq=$this->db->query("select * from jours_feriers where date='".$info->date."'");
		if($qq->rowCount()){
			   	echo "<script>location.href='index.php?page=absences'; alert(' Date d absence est un jour ferier');</script>";

		}
		else{


    $q=$this->db->prepare("update absences set date=?,heures=?,user_id=? where id=? ");
   if( $q->execute([$info->date,$info->heures,$info->agent,$info->id])) {
   	echo "<script>location.href='index.php?page=absences'; alert(' Absence modifiee');</script>";
   } else{
   	echo "<script> alert('Probleme);</script>";

   }
}

	}
		public function deleteAbsence($id) {
		$q=$this->db->prepare("delete from absences where id=?");
		if($q->execute([$id])) {
			echo "<script>window.location.href='index.php?page=absences'; alert(' Absence supprimee');</script>";
		} else{
			
			echo "<script> alert(' Probleme');</script>";
		}
	}

	//***********************************CONGES*************************//

	public function getAllConges() {
		$q=$this->db->query("select conges.*,users.nom,users.prenom,users.matricule from conges inner join users on conges.user_id=users.id ");
		$informations=$q->fetchAll(PDO::FETCH_OBJ);
		return $informations;
	}

	public function addConges($info) {
		$qq=$this->db->prepare("select * from jours_feriers where date between ? and ?");
		$qq->execute([$info->date_deb,$info->date_fin]);
		if($qq->rowCount()){
			   	echo "<script>location.href='index.php?page=conges'; alert('Periode de conges contient un jour ferier');</script>";

		}
		else{

    $q=$this->db->prepare("insert into conges(date_demande,date_deb,date_fin,user_id) values(?,?,?,?)");
   if( $q->execute([date('Y-m-d'),$info->date_deb,$info->date_fin,$info->agent])) {
   	echo "<script>location.href='index.php?page=conges'; alert(' conges ajoute');</script>";
   } else{
   	echo "<script> alert('Probleme);</script>";

   }
}

	}
		public function updateConges($info) {
	$qq=$this->db->prepare("select * from jours_feriers where date between ? and ?");
		$qq->execute([$info->date_deb,$info->date_fin]);
		if($qq->rowCount()){
			   	echo "<script>location.href='index.php?page=conges'; alert('Periode de conges contient un jour ferier');</script>";

		}
		else{


    $q=$this->db->prepare("update conges set date_demande=?,date_deb=?,date_fin=?, user_id=? where id=? ");
   if( $q->execute([date('Y-m-d'),$info->date_deb,$info->date_fin,$info->agent,$info->id])) {
   	echo "<script>location.href='index.php?page=conges'; alert(' conges modifie');</script>";
   } else{
   	echo "<script> alert('Probleme);</script>";

   }
}

	}
		public function deleteConges($id) {
		$q=$this->db->prepare("delete from conges where id=?");
		if($q->execute([$id])) {
			echo "<script>window.location.href='index.php?page=conges'; alert('Conges supprimee');</script>";
		} else{
			
			echo "<script> alert(' Probleme');</script>";
		}
	}

	


//***********************************INSCRIPTIONS*************************//

	public function getAllDeplacements() {
		$q=$this->db->query("select deplacements.*,users.nom,users.prenom,users.matricule,users.grade from deplacements inner join users on deplacements.user_id=users.id");
		$inscriptions=$q->fetchAll(PDO::FETCH_OBJ);
		return $inscriptions;
	}

		public function deleteDeplacement($id) {
		$q=$this->db->prepare("delete from deplacements where id=?");
		if($q->execute([$id])) {
			echo "<script>window.location.href='index.php?page=deplacements'; alert(' Deplacement supprimee');</script>";
		} else{
			
			echo "<script> alert(' Probleme');</script>";
		}

	}
				public function updateDeplacement($info) {
    $q=$this->db->prepare("update deplacements set date=?,lieu=?,prime=?,user_id=? where id=? ");

   if( $q->execute([$info->date,$info->lieu,$info->prime,$info->agent,$info->id])) {

   	echo "<script>location.href='index.php?page=deplacements'; alert(' deplacement modifiee');</script>";
   } else{
   	echo "<script> alert('Probleme);</script>";

   }

	}
				public function AddDeplacement($info) {
    $q=$this->db->prepare("insert into  deplacements(date,lieu,prime,user_id) values(?,?,?,?)");

   if( $q->execute([$info->date,$info->lieu,$info->prime,$info->agent])) {

   	echo "<script>location.href='index.php?page=deplacements'; alert(' deplacement Ajoute');</script>";
   } else{
   	echo "<script> alert('Probleme);</script>";

   }

	}
		






	


}