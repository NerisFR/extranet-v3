{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('id_contrat', 'Id_contrat:') !!}
			{!! Form::text('id_contrat') !!}
		</li>
		<li>
			{!! Form::label('id_collab', 'Id_collab:') !!}
			{!! Form::text('id_collab') !!}
		</li>
		<li>
			{!! Form::label('debut', 'Debut:') !!}
			{!! Form::text('debut') !!}
		</li>
		<li>
			{!! Form::label('fin', 'Fin:') !!}
			{!! Form::text('fin') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}