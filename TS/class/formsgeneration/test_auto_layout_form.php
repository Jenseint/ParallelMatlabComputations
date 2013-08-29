<?php
/*
 * test_auto_layout_form.php
 *
 * @(#) $Header: /opt2/ena/metal/forms/test_auto_layout_form.php,v 1.5 2008/08/16 05:12:37 mlemos Exp $
 *
 */

/*
 * Include form class code.
 */
	require("forms.php");

/*
 * Include form automatic vertical layout plug-in class.
 */
	require("form_layout_vertical.php");

/*
 * Create a form object.
 */
	$form=new form_class;

/*
 * Define the name of the form to be used for example in Javascript
 * validation code generated by the class.
 */
	$form->NAME="subscription_form";

/*
 * Use the GET method if you want to see the submitted values in the form
 * processing URL, or POST otherwise.
 */
	$form->METHOD="POST";

/*
 * Make the form be displayed and also processed by this script.
 */
	$form->ACTION="";

/*
 * Specify a debug output function you really want to output any
 * programming errors.
 */
	$form->debug="trigger_error";

/*
 * Define a warning message to display by Javascript code when the user
 * attempts to submit the this form again from the same page.
 */
	$form->ResubmitConfirmMessage=
		"Are you sure you want to submit this form again?";

/*
 * Output previously set password values
 */
	$form->OutputPasswordValues=1;

/*
 * Output multiple select options values separated by line breaks
 */
	$form->OptionsSeparator="<br>\n";

/*
 * Output all validation errors at once.
 */
	$form->ShowAllErrors=1;

/*
 * CSS class to apply to all invalid inputs.
 * Set to a non-empty string to specify the invalid input CSS class
 */
	$form->InvalidCLASS='invalid';

/*
 * Define the form field properties even if they may not be displayed.
 */
	$form->AddInput(array(
		"TYPE"=>"text",
		"NAME"=>"email",
		"ID"=>"email",
		"MAXLENGTH"=>100,
		"Capitalization"=>"lowercase",
		"ValidateAsEmail"=>1,
		"ValidationErrorMessage"=>
			"It was not specified a valid e-mail address",
		"LABEL"=>"<u>E</u>-mail address",
		"ACCESSKEY"=>"E"
	));
	$form->AddInput(array(
		"TYPE"=>"select",
		"NAME"=>"credit_card_type",
		"ID"=>"credit_card_type",
		"VALUE"=>"unknown",
		"SIZE"=>2,
		"OPTIONS"=>array(
			"unknown"=>"Unknown",
			"mastercard"=>"Master Card",
			"visa"=>"Visa",
			"amex"=>"American Express",
			"dinersclub"=>"Diners Club",
			"carteblanche"=>"Carte Blanche",
			"discover"=>"Discover",
			"enroute"=>"enRoute",
			"jcb"=>"JCB"
		),
		"ValidationErrorMessage"=>
			"It was not specified a valid credit card type",
		"LABEL"=>"Credit card t<u>y</u>pe",
		"ACCESSKEY"=>"y"
	));
	$form->AddInput(array(
		"TYPE"=>"text",
		"NAME"=>"credit_card_number",
		"ID"=>"credit_card_number",
		"SIZE"=>20,
		"ValidateOptionalValue"=>"",
		"ValidateAsCreditCard"=>"field",
		"ValidationCreditCardTypeField"=>"credit_card_type",
		"ValidationErrorMessage"=>
			"It wasn't specified a valid credit card number",
		"LABEL"=>"Credit card <u>n</u>umber",
		"ACCESSKEY"=>"n"
	));
	$form->AddInput(array(
		"TYPE"=>"text",
		"NAME"=>"user_name",
		"ID"=>"user_name",
		"MAXLENGTH"=>60,
		"ValidateAsNotEmpty"=>1,
		"ValidationErrorMessage"=>"It was not specified a valid name",
		"LABEL"=>"<u>P</u>ersonal name",
		"ACCESSKEY"=>"P"
	));
	$form->AddInput(array(
		"TYPE"=>"text",
		"NAME"=>"age",
		"ID"=>"age",
		"ValidateAsInteger"=>1,
		"ValidationLowerLimit"=>18,
		"ValidationUpperLimit"=>65,
		"ValidationErrorMessage"=>"It was not specified a valid age",
		"LABEL"=>"<u>A</u>ge",
		"ACCESSKEY"=>"A"
	));
	$form->AddInput(array(
		"TYPE"=>"text",
		"NAME"=>"weight",
		"ID"=>"weight",
		"ValidateAsFloat"=>1,
		"ValidationLowerLimit"=>10,
		"ValidationErrorMessage"=>"It was not specified a valid weight",
		"LABEL"=>"<u>W</u>eight",
		"ACCESSKEY"=>"W"
	));
	$form->AddInput(array(
		"TYPE"=>"text",
		"NAME"=>"home_page",
		"ID"=>"home_page",
		"ReplacePatterns"=>array(

				/* trim whitespace at the beginning of the text value */
				"^\\s+"=>"",

			/* trim whitespace at the end of the text value */
			"\\s+\$"=>"",

			/* Assume that URLs starting with www. start with http://www. */
			"^([wW]{3}\\.)"=>"http://\\1",

			/* Assume that URLs that do not have a : in them are http:// */
			"^([^:]+)\$"=>"http://\\1",
	
			/* Assume at least / as URI . */
			"^(http|https)://(([-!#\$%&'*+.0-9=?A-Z^_`a-z{|}~]+\.)+[A-Za-z]{2,6}(:[0-9]+)?)\$"=>"\\1://\\2/"
		),
		"ValidateRegularExpression"=>
			'^(http|https)\://(([-!#\$%&\'*+.0-9=?A-Z^_`a-z{|}~]+\.)+[A-Za-z]{2,6})(\:[0-9]+)?(/)?/',
		"ValidationErrorMessage"=>"It was not specified a valid home page URL",
		"LABEL"=>"H<u>o</u>me page",
		"ACCESSKEY"=>"o"
	));
	$form->AddInput(array(
		"TYPE"=>"text",
		"NAME"=>"alias",
		"ID"=>"alias",
		"MAXLENGTH"=>20,
		"Capitalization"=>"uppercase",
		"ValidateRegularExpression"=>"^[a-zA-Z0-9]+$",
		"ValidateRegularExpressionErrorMessage"=>
			"The alias may only contain letters and digits",
		"ValidateAsNotEmpty"=>1,
		"ValidateAsNotEmptyErrorMessage"=>"It was not specified the alias",
		"ValidateMinimumLength"=>5,
		"ValidateMinimumLengthErrorMessage"=>
			"It was not specified an alias shorter than 5 characters",
		"LABEL"=>"Acce<u>s</u>s name",
		"ACCESSKEY"=>"s"
	));
	$form->AddInput(array(
		"TYPE"=>"password",
		"NAME"=>"password",
		"ID"=>"password",
		"ONCHANGE"=>"if(value.toLowerCase) value=value.toLowerCase()",
		"ValidateAsNotEmpty"=>1,
		"ValidationErrorMessage"=>"It was not specified a valid password",
		"LABEL"=>"Passwor<u>d</u>",
		"ACCESSKEY"=>"d",
		"ReadOnlyMark"=>"********"
	));
	$form->AddInput(array(
		"TYPE"=>"password",
		"NAME"=>"confirm_password",
		"ID"=>"confirm_password",
		"ONCHANGE"=>"if(value.toLowerCase) value=value.toLowerCase()",
		"ValidateAsEqualTo"=>"password",
		"ValidationErrorMessage"=>
			"The password is not equal to the confirmation",
		"LABEL"=>"<u>C</u>onfirm password",
		"ACCESSKEY"=>"C",
		"ReadOnlyMark"=>"********"
	));
	$form->AddInput(array(
		"TYPE"=>"text",
		"NAME"=>"reminder",
		"ID"=>"reminder",
		"ValidateAsNotEmpty"=>1,
		"ValidateAsNotEmptyErrorMessage"=>
			"It was not specified a reminder phrase",
		"ValidateAsDifferentFrom"=>"password",
		"ValidateAsDifferentFromErrorMessage"=>
			"The reminder phrase may not be equal to the password",
		"LABEL"=>"Password <u>r</u>eminder",
		"ACCESSKEY"=>"r"
	));
	$form->AddInput(array(
		"TYPE"=>"select",
		"MULTIPLE"=>1,
		"NAME"=>"interests",
		"ID"=>"interests",
		"SELECTED"=>array(
			"other"
		),
		"SIZE"=>4,
		"OPTIONS"=>array(
			"arts"=>"Arts",
			"business"=>"Business",
			"computers"=>"Computers",
			"education"=>"Education",
			"entertainment"=>"Entertainment",
			"health"=>"Health",
			"news"=>"News",
			"politics"=>"Politics",
			"sports"=>"Sports",
			"science"=>"Science",
			"other"=>"Other"
		),
		"ValidateAsSet"=>1,
		"ValidationErrorMessage"=>"It were not specified any interests.",
		"LABEL"=>"<u>I</u>nterests",
		"ACCESSKEY"=>"I"
	));
	$form->AddInput(array(
		"TYPE"=>"checkbox",
		"NAME"=>"notification",
		"ID"=>"email_notification",
		"VALUE"=>"email",
		"CHECKED"=>0,
		"MULTIPLE"=>1,
		"ValidateAsSet"=>1,
		"ValidateAsSetErrorMessage"=>
			"It were not specified any types of notification",
		"LABEL"=>"E-<u>m</u>ail",
		"ACCESSKEY"=>"m",
		"ReadOnlyMark"=>"[X]"
	));
	$form->AddInput(array(
		"TYPE"=>"checkbox",
		"NAME"=>"notification",
		"ID"=>"phone_notification",
		"VALUE"=>"phone",
		"CHECKED"=>0,
		"MULTIPLE"=>1,
		"LABEL"=>"P<u>h</u>one",
		"ACCESSKEY"=>"h",
		"ReadOnlyMark"=>"[X]"
	));
	$form->AddInput(array(
		"TYPE"=>"radio",
		"NAME"=>"subscription_type",
		"VALUE"=>"administrator",
		"ID"=>"administrator_subscription",
		"ValidateAsSet"=>1,
		"ValidateAsSetErrorMessage"=>
			"It was not specified the subscription type",
		"LABEL"=>"Adm<u>i</u>nistrator",
		"ACCESSKEY"=>"i",
		"ReadOnlyMark"=>"[X]"
	));
	$form->AddInput(array(
		"TYPE"=>"radio",
		"NAME"=>"subscription_type",
		"VALUE"=>"user",
		"ID"=>"user_subscription",
		"LABEL"=>"<u>U</u>ser",
		"ACCESSKEY"=>"U",
		"ReadOnlyMark"=>"[X]"
	));
	$form->AddInput(array(
		"TYPE"=>"radio",
		"NAME"=>"subscription_type",
		"VALUE"=>"guest",
		"ID"=>"guest_subscription",
		"LABEL"=>"<u>G</u>uest",
		"ACCESSKEY"=>"G",
		"ReadOnlyMark"=>"[X]"
	));
	$form->AddInput(array(
		"TYPE"=>"button",
		"NAME"=>"toggle",
		"ID"=>"toggle",
		"VALUE"=>"On",
		"ONCLICK"=>
			"this.value=(this.value=='On' ? 'Off' : 'On'); alert('The button is '+this.value);",
		"LABEL"=>"Toggle <u>b</u>utton",
		"ACCESSKEY"=>"b"
	));
	$form->AddInput(array(
		"TYPE"=>"checkbox",
		"NAME"=>"agree",
		"ID"=>"agree",
		"VALUE"=>"Yes",
		"ValidateAsSet"=>1,
		"ValidateAsSetErrorMessage"=>
			"You have not agreed with the subscription terms.",
		"LABEL"=>"Agree with the <u>t</u>erms",
		"ACCESSKEY"=>"t"
	));

	$form->AddInput(array(
		"TYPE"=>"submit",
		"ID"=>"button_subscribe",
		"VALUE"=>"Submit subscription",
		"ACCESSKEY"=>"u"
	));
	$form->AddInput(array(
		"TYPE"=>"image",
		"ID"=>"image_subscribe",
		"SRC"=>"http://files.phpclasses.org/graphics/add.gif",
		"ALT"=>"Submit subscription",
		"STYLE"=>"border-width: 0px;"
	));
	$form->AddInput(array(
		"TYPE"=>"submit",
		"ID"=>"button_subscribe_with_content",
		"ACCESSKEY"=>"c",
		"Content"=>"<img src=\"http://files.phpclasses.org/graphics/add.gif\" style=\"border-width: 0px;\" alt=\"Submit button with content\" /> Submit button with <u>c</u>ontent",
	));

/*
 * Give a name to hidden input field so you can tell whether the form is to
 * be outputted for the first or otherwise it was submitted by the user.
 */
	$form->AddInput(array(
		"TYPE"=>"hidden",
		"NAME"=>"doit",
		"VALUE"=>1
	));

/*
 * Hidden fields can be used to pass context values between form pages,
 * like for instance database record identifiers or other information
 * that may help your application form processing scripts determine
 * the context of the information being submitted with this form.
 *
 * You are encouraged to use the DiscardInvalidValues argument to help
 * preventing security exploits performed by attackers that may spoof
 * invalid values that could be used for instance in SQL injection attacks.
 *
 * In this example, any value that is not an integer is discarded. If the
 * value was meant to be used in a SQL query, with this attack prevention
 * measure an attacker cannot submit SQL code that could be used to make
 * your SQL query retrieve unauthorized information to abuse your system.
 */
	$form->AddInput(array(
		"TYPE"=>"hidden",
		"NAME"=>"user_track",
		"VALUE"=>"0",
		"ValidateAsInteger"=>1,
		"DiscardInvalidValues"=>1
	));

/*
 * Load form input values eventually from the submitted form.
 */
	$form->LoadInputValues($form->WasSubmitted("doit"));

/*
 * Empty the array that will list the values with invalid field after
 * validation.
 */
	$verify=array();


/*
 * Check if the global array variable corresponding to hidden input field
 * is defined, meaning that the form was submitted as opposed to being
 * displayed for the first time.
 */
	if($form->WasSubmitted("doit"))
	{


/*
 * Therefore we need to validate the submitted form values.
 */
		if(($error_message=$form->Validate($verify))=="")
		{

/*
 * It's valid, set the $doit flag variable to 1 to tell the form is ready
 * to processed.
 */
			$doit=1;

		}
		else
		{

/*
 * It's invalid, set the $doit flag to 0 and encode the returned error
 * message to escape any non-ASCII ISO-latin 1 characters and HTML special
 * characters.
 */
			$doit=0;
			$error_message=HtmlEntities($error_message);
		}
	}
	else
	{

/*
 * The form is being displayed for the first time, so it is not ready to
 * be processed and there is no error message to display.
 */
		$error_message="";
		$doit=0;
	}
  if($doit)
  {

/*
 * The form is ready to be processed, just output it again as read only to
 * display the submitted values.  A real form processing script usually
 * may do something else like storing the form values in a database.
 */
  	$form->ReadOnly=1;
  }

/*
 * Add a layout input to automatically layout all inputs
 * without additional HTML templates.
 */
	$form->AddInput(array(
		'ID'=>'layout',
		'NAME'=>'layout',
		'TYPE'=>'custom',
		"CustomClass"=>"form_layout_vertical_class",
		'Inputs'=>array(
			'email',
			'credit_card_number',
			'credit_card_type',
			'user_name',
			'age',
			'weight',
			'home_page',
			'alias',
			'password',
			'confirm_password',
			'reminder',
			'interests',
			'notification-header',
			'email_notification',
			'phone_notification',
			'subscription-header',
			'administrator_subscription',
			'user_subscription',
			'guest_subscription',
			'toggle',
			'separator',
			'agree',
			'submit-separator'
		),
		'Data'=>array(
			'notification-header'=>
				'<tr><th colspan="2">When approved, receive notification by:</th></tr>',
			'subscription-header'=>
				'<tr><th colspan="2">Subscription type:</th></tr>',
			'separator'=>'<tr><td colspan="2"><hr /></td></tr>',
			'submit-separator'=>'<tr><td colspan="2"><hr /></td></tr>'
		),
		'Properties'=>array(
			'credit_card_number'=>array(
				'DefaultMark'=>($doit ? '' : '[Optional]')
			),
			'interests'=>array(
				'InputFormat'=>
					'<tr><th align="right" valign="top">{label}:</th><td valign="top">{input}&nbsp;{mark}</td></tr>'
			),
			'toggle'=>array(
				'Visible'=>!$doit
			),
			'submit-separator'=>array(
				'Visible'=>!$doit
			)
		),
		'InvalidMark'=>'[Verify]',
/*
		'DefaultMark'=>'',
		'Header'=>'<table>',
		'Footer'=>'</table>',
*/
		'InputFormat'=>
			'<tr><th align="right">{label}:</th><td valign="top">{input}&nbsp;{mark}</td></tr>',
/*
		'NoLabelInputFormat'=>'<tr><td colspan="2" align="center">{input}&nbsp;{mark}</td></tr>',
*/
	));

	if(!$doit)
	{
		if(strlen($error_message))
		{
			Reset($verify);
			$focus=Key($verify);
		}
		else
			$focus='email';
		$form->ConnectFormToInput($focus, 'ONLOAD', 'Focus', array());
	}

	$onload=HtmlSpecialChars($form->PageLoad());

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Test for Manuel Lemos' PHP form class</title>
<style type="text/css"><!--
.invalid { border-color: #ff0000; background-color: #ffcccc; }
// --></style>
</head>
<body onload="<?php	echo $onload; ?>" bgcolor="#cccccc">
<center><h1>Test for Manuel Lemos' PHP form class</h1></center>
<hr />
<?php

/*
 * Compose the form output by including a HTML form template with PHP code
 * interleaved with calls to insert form input field parts in the layout
 * HTML.
 */

	$form->StartLayoutCapture();
	$title="Form class test";
	$body_template="form_auto_layout_body.html.php";
	require("templates/form_frame.html.php");
	$form->EndLayoutCapture();

/*
 * Output the form using the function named Output.
 */
	$form->DisplayOutput();
?>
</body>
</html>