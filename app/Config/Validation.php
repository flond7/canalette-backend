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
    'cf' => 'required',
    'category' => 'required'
  ];

	public $validationYearRules = [
    'year' => 'required|is_unique',
    'taxBusiness' => 'required',
    'taxCitizen' => 'required'
  ];

}
