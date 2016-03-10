<div class='box box-primary'>
        <div class='box-header with-border'>
            <h3 class='box-title'>Données de synthèse</h3><i class='pull-right fa fa-fw fa-chevron-down' style='cursor:Pointer;text-align: right;' id='icon-bilan-task'/>
        </div>
    </div>

    <div class='box-body' id='table-bilan-task'>
        <table class='pull-center'>
            <tr width='200'>
            <td>
            <table class='table table-bordered table-striped'>
                <tr width='40' height='35'>
                    <th>Période</th>
                </tr>
                <tr width='40' height='25'>
                    <th>Admin. Syst.</th>
                </tr>
                <tr width='40' height='25'>
                    <th>Maintenance Matériel</th>
                </tr>
                <tr width='40' height='25'>
                    <th>Gestion de parc</th>
                </tr>
                <tr width='40' height='25'>
                    <th>Etude de prix</th>
                </tr>
                <tr width='40' height='25'>
                    <th>Install. / Param.</th>
                </tr>
                <tr width='40' height='25'>
                    <th>Assistance Utilisateur</th>
                </tr>
                <tr width='40' height='25'>
                    <th>Formation</th>
                </tr>
                <tr width='40' height='25'>
                    <th>Gestion de projet</th>
                </tr>
                <tr width='40' height='25'>
                    <th>Developpement</th>
                </tr>
                <tr width='40' height='25'>
                    <th>Reunion</th>
                </tr>
                <tr width='40' height='25'>
                    <th>Déplacement</th>
                </tr>
                <tr width='40' height='25'>
                    <th>Controle journalier</th>
                </tr>
                <tr width='40' height='25'>
                    <th>Autre</th>
                </tr>
            </table>
            </td>
            <td>
                <table id='example1' class='table table-bordered table-striped'>

                <thead>
                <tr height='35'>
                    @foreach ($tdbtask as $tdbt)
                      <th class='sorting'>{{ $tdbt->mois }} {{ $tdbt->ANNEE }}</th>
                    @endforeach
                </tr> 
                </thead>
                <tbody>
                @foreach ($tdbtask as $tdbt)
                    <tr>
                        <td>{{ $tdbt->ADM_SYS or '-' }}</td>
                        <td>{{ $tdbt->MAINTENANCE or '-' }}</td>
                        <td>{{ $tdbt->GEST_PARC or '-' }}</td>
                        <td>{{ $tdbt->ETUDE_PRIX or '-' }}</td>
                        <td>{{ $tdbt->INSTALL or '-' }}</td>
                        <td>{{ $tdbt->ASSISTANCE or '-' }}</td>
                        <td>{{ $tdbt->FORMATION or '-' }}</td>
                        <td>{{ $tdbt->PROJET or '-' }}</td>
                        <td>{{ $tdbt->DEVELOPPEMENT or '-' }}</td>
                        <td>{{ $tdbt->REUNION or '-' }}</td>
                        <td>{{ $tdbt->DEPLACEMENT or '-' }}</td>
                        <td>{{ $tdbt->CONTROLE or '-' }}</td>
                        <td>{{ $tdbt->AUTRE or '-' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </td>
        </table>
    </div>





<!-- $task = array("Admin. syst.", "Maint.", "Gest. de parc", "Etude de prix", "Install.", "Assist.", "Formation", "Gestion de proj.", "Dev.", "Reunion", "Déplacement", "Ctrl journalier", "Autre"); -->

<div class='box box-primary'>
<div class='box-header with-border'>
<h3 class='col-xs-6 box-title'>Graph de synthèse</h3>
</div>
</div>
<div class='box-body'>


<div id='chartContainer' style='height: 300px; width: 700px;'></div>

</div>

<script type="text/javascript" src="{{ asset('plugins/canvasjs-1.6.2/canvasjs.min.js') }}"></script>

<script type='text/javascript'>
    var chart = new CanvasJS.Chart('chartContainer', {
      // theme: 'theme2',
    animationEnabled: true,
    backgroundColor: '#f1f1f1',
      title:{
        text: 'Bilan par taches',
        fontSize: 30
      },

      legend:{
        fontFamily: 'Open sans',
        verticalAlign: 'center',
        horizontalAlign: 'left'
      },
      data: [
      {
        type: 'pie', 
        indexLabelFontSize: 12,
        indexLabelFontFamily: 'Open sans',
        indexLabelFontColor: 'darkgrey',
        indexLabelLineColor: 'darkgrey',
        indexLabelPlacement: 'outside',
        showInLegend: true,
        toolTipContent: '{y} - <strong>#percent%</strong>',
        dataPoints:[
            @foreach ($tdbtasktotal as $tdbtt)
                { y: {{ $tdbtt->ADM_SYS }}, legendText:'ADM_SYST', indexLabel: 'ADM_SYST' },
                { y: {{ $tdbtt->MAINTENANCE }}, legendText:'MAINTENANCE', indexLabel: 'MAINTENANCE' },
                { y: {{ $tdbtt->GEST_PARC }}, legendText:'GEST_PARC', indexLabel: 'GEST_PARC' },
                { y: {{ $tdbtt->ETUDE_PRIX }}, legendText:'ETUDE_PRIX', indexLabel: 'ETUDE_PRIX' },
                { y: {{ $tdbtt->INSTALL }}, legendText:'INSTALL', indexLabel: 'INSTALL' },
                { y: {{ $tdbtt->ASSISTANCE }}, legendText:'ASSISTANCE', indexLabel: 'ASSISTANCE' },
                { y: {{ $tdbtt->FORMATION }}, legendText:'FORMATION', indexLabel: 'FORMATION' },
                { y: {{ $tdbtt->PROJET }}, legendText:'PROJET', indexLabel: 'PROJET' },
                { y: {{ $tdbtt->DEVELOPPEMENT }}, legendText:'DEV.', indexLabel: 'DEV.' },
                { y: {{ $tdbtt->REUNION }}, legendText:'REUNION', indexLabel: 'REUNION' },
                { y: {{ $tdbtt->DEPLACEMENT }}, legendText:'DEPLACEMENT', indexLabel: 'DEPLACEMENT' },
                { y: {{ $tdbtt->CONTROLE }}, legendText:'CONTROLE', indexLabel: 'CONTROLE' },
                { y: {{ $tdbtt->AUTRE }}, legendText:'AUTRE', indexLabel: 'AUTRE' }
            @endforeach
        ]
      }
    ]
    });

    chart.render();
</script>