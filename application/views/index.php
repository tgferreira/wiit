  <nav class="navbar navbar-default">
  	<div class="container-fluid">
  		<div class="navbar-header">
  			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
  				<span class="icon-bar"></span>
  				<span class="icon-bar"></span>
  				<span class="icon-bar"></span>
  			</button>
  			<a class="navbar-brand" href="<?php echo base_url()?>">WIIT</a>
  		</div>
  		<div class="collapse navbar-collapse" id="myNavbar">
  			<ul class="nav navbar-nav">
  				<li class="active"><a href="<?php echo base_url()?>">Home</a></li>
  			</ul>
  		</div>
  	</div>
  </nav>

  <div class="col-md-4">
  	<div class="panel panel-primary">
  		<div class="panel panel-heading"><center><strong>Buscas</center></strong></div>
  		<div class="panel panel-body">
  			<form role="form" action="<?php echo base_url('Home'); ?>" method="POST" >
  				<div class="form-group">
  					<label for="term">Encontrar:</label>
  					<input type="text" class="form-control" id="term" name="term" placeholder="Pizza">
  				</div>
  				<div class="form-group">
  					<label for="location">Em:</label>
  					<input type="text" class="form-control" id="location" name="location" placeholder="Itajubá, MG">
  				</div>

  				<center><button class="btn btn-lg btn-primary">Buscar</button></center>
  			</form>
  		</div>
  	</div>
  </div>

  <div class="col-md-8">
  	<div class="panel panel-primary">
  		<div class="panel panel-heading"><center><strong>Resultados</strong></center></div>
  		<div class="panel panel-body">
  			<table class="table table-bordered">
  				<thead>
  					<tr>
  						<td>Nº</td>
  						<td>Nome</td>
  						<td>Endereço</td>
  						<td>Contato</td>
  						<td>Mapa</td>
  					</tr>
  				</thead>
  				<tbody>
  					<?php 
  					if(isset($response)){
  						echo '<h2> Foram encontrados ' .  $response->total . ' resultados.</h3>';

  						$i = 1;

  						foreach ($response->businesses as $obj) {
  							?>
  							<tr>
  								<td><?php echo '#'.$i;?></td>
  								<td><?php echo '<p><strong>' . $obj->name . '</strong></p>';?></td>
  								<td><?php echo '<p>' . $obj->location->display_address[0] . '</p>';?></td>
  								<?php 
  								if(isset($obj->display_phone))
  									echo '<td><p>' . $obj->display_phone . '</p></td>';
  								else
  									echo '<td> </td>'
  								?>
  								<td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal<?php echo $i; ?>">Here!</button></td>
  								<!-- Modal -->
  								<div class="modal fade" id="myModal<?php echo $i; ?>" role="dialog">
  									<div class="modal-dialog">

  										<!-- Modal content-->
  										<div class="modal-content">
  											<div class="modal-header">
  												<button type="button" class="close" data-dismiss="modal">&times;</button>
  												<h4 class="modal-title">Como chegar?</h4>
  											</div>
  											<div class="modal-body" style=" height:300px">
  												<iframe 
  												src="https://maps.google.com.br/maps?q=<?php echo $obj->location->coordinate->latitude . ',' . $obj->location->coordinate->longitude?>&output=embed&dg=oo" 
  												width="100%" 
  												height="100%" 
  												frameborder="0" 
  												style="border:0" 
  												allowfullscreen>
  											</iframe>
  											
  										</div>
  										<div class="modal-footer">
  											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  										</div>
  									</div>
  								</div>
  							</div>
  						</tr>

  						<?php
  						++$i;
  					}
  					?>
  				</tbody>
  			</table>
  		</div>
  	</div>
  	<?php

  } else{
  	?>

  	<div class="alert alert-info">
  		<center>Obtenha resultados com a busca ao lado!</center>
  	</div>
  	<?php
  }
  ?>
</div>