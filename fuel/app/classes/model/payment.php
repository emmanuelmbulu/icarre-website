<?php

class Model_Payment extends \Orm\Model {
	protected static $_properties = array(
		"id",
		"amount" => array(
            "label" => "form.input.amount.label",
            "data_type" => "float",
            "validation" => array("required"),
            "form" => array(
                "type" => "number",
                "name" => "amount",
            )
        ),
		"currency" => array(
            "label" => "form.input.currency.label",
            "data_type" => "varchar",
            "validation" => array("required"),
            "form" => array(
                "type" => false,
            )
        ),
		"status" => array(
			"label" => "form.input.status.label",
			"data_type" => "enum",
            "form" => array(
                "type" => false,
            )
		),
		"reference" => array(
			"label" => "form.input.reference.label",
			"data_type" => "varchar",
            "form" => array(
                "type" => false,
            )
		),
		"direct_payer" => array(
			"label" => "form.input.payer.label",
			"data_type" => "text",
            "validation" => array("required"),
            "form" => array(
                "type" => "text",
                "name" => "payer",
            )
        ),
		"created_at" => array(
			"label" => "form.input.createdat.label",
			"data_type" => "datetime",
            "form" => array(
                "type" => false,
            )
		),
		"updated_at" => array(
			"label" => "payment.amount.updatedat",
			"data_type" => "datetime",
            "form" => array(
                "type" => false,
            )
		),
	);

	protected static $_table_name = 'payment';

	protected static $_primary_key = array('id');

	protected static $_conditions = array(
        'order_by' => array('id' => 'desc'),
    );

	protected static $_has_many = array(
	);

	protected static $_many_many = array(
	);

	protected static $_has_one = array(
	);

	protected static $_belongs_to = array(
		/*'moyen_paiement' => array(
	        'key_from' => 'moyen_paiement_id',
	        'model_to' => 'Model_MoyenPaiement',
	        'key_to' => 'id',
		),
		'note_debit' => array(
	        'key_from' => 'note_debit_id',
	        'model_to' => 'Model_NoteDebit',
	        'key_to' => 'id',
	        'cascade_save' => true,
	        'cascade_delete' => true,
		),
		'auteur' => array(
	        'key_from' => 'auteur_id',
	        'model_to' => 'Model_Gestionnaire',
	        'key_to' => 'id',
	        'cascade_save' => true,
	        'cascade_delete' => true,
	    ),*/
	);

}
