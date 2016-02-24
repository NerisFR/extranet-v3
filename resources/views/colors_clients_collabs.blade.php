{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('id_collab', 'Id_collab:') !!}
			{!! Form::text('id_collab') !!}
		</li>
		<li>
			{!! Form::label('id_client', 'Id_client:') !!}
			{!! Form::text('id_client') !!}
		</li>
		<li>
			{!! Form::label('ref_color', 'Ref_color:') !!}
			{!! Form::text('ref_color') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}