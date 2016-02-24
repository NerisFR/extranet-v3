{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('start', 'Start:') !!}
			{!! Form::text('start') !!}
		</li>
		<li>
			{!! Form::label('end', 'End:') !!}
			{!! Form::text('end') !!}
		</li>
		<li>
			{!! Form::label('id_collab', 'Id_collab:') !!}
			{!! Form::text('id_collab') !!}
		</li>
		<li>
			{!! Form::label('id_client', 'Id_client:') !!}
			{!! Form::text('id_client') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}