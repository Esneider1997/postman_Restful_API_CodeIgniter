<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Validation\Validation;

class TransaccionModel extends Model
{
	protected $table                = 'transaccion';
	protected $primaryKey           = 'id';

	protected $returnType           = 'array';
	protected $protectFields        = true;
	protected $allowedFields        = ['cuenta_id', 'tipo_transaccion_id', 'monto'];

	// Dates
	protected $useTimestamps        = true;

	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';

	// Validation
	protected $validationRules      = [
		'cuenta_id'				=> 'required',
		'tipo_transaccion_id'	=> 'required',
		'monto'					=> 'required|numeric'
	];
	protected $validationMessages   = [
		'monto' => [
			'numeric' => 'Los valores ingresados deben de ser numericos'
		]
	];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];
}
