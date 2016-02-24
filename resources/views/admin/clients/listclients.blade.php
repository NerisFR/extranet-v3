

<div class='row'>
    <div class='col-xs-12'>
    	<div class='box'>
			<div class='box-header'>
				<h3 class='box-title'>Liste des clients</h3>
			</div>
			<div class='box-body'>
				<table id='listCLI' class='table table-bordered table-striped table-hover display nowrap' cellspacing="0" width="100%">
					<thead>
						<tr>
						    <th>Nom</th>
						    <th>Adresse</th>
						    <th>CP</th>
						    <th>Ville</th>
						    
						    <th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
    					@foreach ($clients as $client)
							<tr id={{ $client->id }} title='Double-clic pour ouvrir'>
							    <td>{{ $client->nom }}</td>
							    <td>{{ $client->adresse }}</td>
							    <td>{{ $client->cp }}</td>
							    <td>{{ $client->ville }}</td>
							    
							    <td><i id='{{ $client->id }}' style='cursor:Pointer' class='ion-close del-cli'></i></td>
						    </tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>