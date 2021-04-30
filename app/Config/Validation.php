<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------

	public $validationDrainRules = [
    'num' => 'required|is_unique[drainChannels.num]',
    'street' => 'required'
  ];

	public $validationUserRules = [
    'first_name' => 'required',
    'last_name' => 'required',
    'cf' => 'required|is_unique[users.cf]',
    'category' => 'required',
    'tax_type' => 'required'
  ];

	public $validationYearRules = [
    'year' => 'required|is_unique[taxes.year]',
    'taxBusiness' => 'required',
    'taxCitizen' => 'required',
    'ivaFull' => 'required',
    'ivaSplit' => 'required',
    'ivaZero' => 'required',
    'mailing_money' => 'required'
  ];

	public $validationRelationalRules = [
		'id_year' => 'required',
    'id_user' => 'required',
    'id_drain' => 'required',
    'amount_paid' => 'required',
    'amount_computed' => 'required'
	];

}
