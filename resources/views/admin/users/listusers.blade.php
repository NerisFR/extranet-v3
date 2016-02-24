<div class='row'>
    <div class='col-xs-12'>
	    <div class='box'>
		    <div class='box-header'>
		    	<h3 class='box-title'>Liste des collaborateurs</h3>
		    </div>
	    	<div class='box-body'>
	    		<table id='listUSERS' class='table table-bordered table-striped table-hover display nowrap' cellspacing="0" width="100%">
	    			<thead>
	    				<tr>
	    					<th>Nom</th>
						    <!-- <th>Prenom</th> -->
						    <th>Fonction</th>
						    <th>Embauche</th>
						    <th>Debauche</th>
						    <!-- <th>Profil</th> -->

						    <th>&nbsp;</th>
	    				</tr>
	    			</thead>
	    			<tbody>
    				@foreach ($utils as $u)
						<tr id={{ $u->id }} title='Double-clic pour ouvrir'>
					        <td>{{ $u->prenom }} {{ $u->nom }}</td>
					        <td>{{ $u->function }}</td>
                   			<td>{{ $u->embauche }}</td>
           					<td>{{ $u->debauche }}</td>

					        <td><i id='{{ $u->id }}' style='cursor:Pointer' class='ion-close del-collab'></i></td>
        				</tr>
        			@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>