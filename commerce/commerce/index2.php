<?php
include 'backend/database.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="icon" href="images/logo%20safmma.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="logo.png" />
	<title>Ajout d'un nouveau Client</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="ajax/ajax.js"></script>
	<style>
		body{
			background-color: purple;
		}
		table{
			color: pink;
		}
	</style>
</head>
<body>
<div class="container">
<p id="success"></p>
	<div class="table-wrapper">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-6">
					<h2>Gestion <b><a href="index2.php">Client</a></b></h2>
				</div>
				<div class="col-sm-6">
					<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Ajouter Nouveau Client</span></a>
					<a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple"><i class="material-icons"></i> <span>Supprimer</span></a>
					<a href="admin/tableau de bord.php" class="btn btn-danger" id="modal"><i class="material-icons"></i> <span>Quittez</span></a>						
				</div>
				<form align="center" action="" method="GET"></br></br></br></br>
					<input type="text" placeholder="Chercher ici" name="search">&nbsp;
					<input type="submit" value="Chercher" name="btn" class="btn btn-sm btn-primary">
				</form>
			</div>
		</div>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>
						<span class="custom-checkbox">
							<input type="checkbox" id="selectAll">
							<label for="selectAll"></label>
						</span>
					</th>
					<th>N°</th>
					<th>Nom & Prenom</th>
					<th>Email </th>
					<th>Password</th>
					<th>Telephone</th>
					<th>Adresse</th>
					<th>ACTION</th>
				</tr>
			</thead>
			<tbody>
			
			<?php
			$query = "SELECT * FROM users";
			if( isset($_GET['search']) ){
				$name = mysqli_real_escape_string($conn, htmlspecialchars($_GET['search']));
				$query = "SELECT * FROM users WHERE name ='$name' OR email ='$name' OR contact ='$name'";
			}
				$result = mysqli_query($conn,$query);
				$i=1;
				while($row = mysqli_fetch_array($result)) {
			?>
			<tr id="<?php echo $row["id"]; ?>">
			<td>
						<span class="custom-checkbox">
							<input type="checkbox" class="user_checkbox" data-user-id="<?php echo $row["id"]; ?>">
							<label for="checkbox2"></label>
						</span>
					</td>
				<td><?php echo $i; ?></td>
				<td><?php echo $row["name"]; ?></td>
				<td><?php echo $row["email"]; ?></td>
				<td><?php echo $row["password"]; ?></td>
				<td><?php echo $row["contact"]; ?></td>
				<td><?php echo $row["city"]; ?></td>
				<td>
					<a href="#editEmployeeModal" class="edit" data-toggle="modal">
						<i class="fa fa-edit update" data-toggle="tooltip" 
						data-id="<?php echo $row["id"]; ?>"
						data-name="<?php echo $row["name"]; ?>"
						data-email="<?php echo $row["email"]; ?>"
						data-pass="<?php echo $row["password"]; ?>"
						data-phone="<?php echo $row["contact"]; ?>"
						data-city="<?php echo $row["city"]; ?>"
						title="Modifier"></i>
					</a>
					<a href="#deleteEmployeeModal" class="delete" data-id="<?php echo $row["id"]; ?>" data-toggle="modal"><i class="fa fa-trash" 
						title="Supprimer"></i></a>
				</td>
			</tr>
			<?php
			$i++;
			}
			?>
			</tbody>
		</table>
	</div>
</div>
<!-- Ajouter Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="user_form">
				<div class="modal-header">						
					<h4 class="modal-title">Ajouter Client</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>NOM & PRENOM</label>
						<input type="text" id="name" name="name" class="form-control" required>
					</div>
					<div class="form-group">
						<label>email</label>
						<input type="email" id="email" name="email" class="form-control" required>
					</div>
					<div class="form-group">
						<label>PASSWORD</label>
						<input type="password" id="pass" name="pass" class="form-control" required>
					</div>
					<div class="form-group">
						<label>TELEPHONE</label>
						<input type="text" id="phone" name="phone" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Adresse</label>
						<input type="number" id="city" name="city" class="form-control" required>
					</div>						
				</div>
				<div class="modal-footer">
					<input type="hidden" value="1" name="type">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Quittez">
					<button type="button" class="btn btn-success" id="btn-add">Ajouter</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Modifier Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="update_form">
				<div class="modal-header">						
					<h4 class="modal-title">Modifier Client</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id_u" name="id" class="form-control" required>					
					<div class="form-group">
						<label>NOM & PRENOM</label>
						<input type="text" id="name_u" name="name" class="form-control" required>
					</div>
					<div class="form-group">
						<label>email</label>
						<input type="email" id="email_u" name="email" class="form-control" required>
					</div>
					<div class="form-group">
						<label>PASSWORD</label>
						<input type="password" id="pass_u" name="pass" class="form-control" placeholder="Veuillez saisir le mot de passe" required>
					</div>
					<div class="form-group">
						<label>TELEPHONE</label>
						<input type="text" id="phone_u" name="phone" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Adresse</label>
						<input type="number" id="city_u" name="city" class="form-control" required>
					</div>	
				</div>
				<div class="modal-footer">
				<input type="hidden" value="2" name="type">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Quittez">
					<button type="button" class="btn btn-info" id="update">Modifier</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Supprimer Modal HTML -->
<div id="deleteEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Supprimer Client</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id_d" name="id" class="form-control">					
					<p>Vous avez sûr de supprimer ce champ?</p>
					<p class="text-warning"><small>Cette action ne peut être undone.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Quittez">
					<button type="button" class="btn btn-danger" id="delete">Supprimer</button>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>    