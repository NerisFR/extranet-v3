<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model {

	protected $table = 'reports';
	public $timestamps = true;
	protected $fillable = ['tps_adm','tps_proj','tps_maint','tps_dev','tps_parc','tps_reunion','tps_prix','tps_dep','tps_inst','tps_ctrl','tps_assist','tps_autre','tps_form','tps_total','commentaire','arrivee','depart','jour','type_heure','ctrl_log','ctrl_maj_os','ctrl_hdd','ctrl_maj_hard','ctrl_raid','ctrl_maj_soft','ctrl_backup','ctrl_antivirus','volum_backup','maj_antivirus','maj_backup'];

	public function contrat_collaborateur()
	{
		return $this->belongsTo('contrat_collaborateur');
	}

}