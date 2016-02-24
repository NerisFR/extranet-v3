<div class='row'>
    <div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
                <h3 class='box-title'>Liste des clients</h3>
            </div>
            <div class='box-body'>
                <table id='listCONT' class='table table-bordered table-striped'>
                    <thead>
                        <tr>
                            <th>Numéro</th>
                            <th>Client</th>
                            <th>Description</th>
                            <th>Démarrage</th>
                            <th style="opacity:0">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contrats as $contrat)
                            <tr id={{ $contrat->id }} title='Double-clic pour ouvrir'>
                                <td>{{ $contrat->numero }}</td>
                                <td>{{ $contrat->nom }}</td>
                                <td>{{ $contrat->description }}</td>
                                <td>{{ $contrat->demarrage }}</td>
                                <td><i id='{{ $contrat->id }}' style='cursor:Pointer' class='ion-close del-cont'></i></td>
                            </tr>
                        @endforeach          
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>