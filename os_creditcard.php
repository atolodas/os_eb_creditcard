<?php
/**
 * @version            2.7.0
 * @package            Joomla
 * @subpackage         Event Booking
 * @author             Tuan Pham Ngoc
 * @copyright          Copyright (C) 2010 - 2016 Ossolution Team
 * @license            GNU/GPL, see LICENSE.php
 */
// no direct access
defined('_JEXEC') or die;

class os_creditcard extends RADPayment
{
	/**
	 * Constructor functions, init some parameter
	 *
	 * @param object $params
	 */
	public function __construct($params, $config = array('type' => 1))
	{
		parent::__construct($params, $config);

		/*if ($params->get('mode'))
		{
			$this->url = 'the_payment_gateway_url_in_live_mode';
		}
		else
		{
			$this->url = 'the_payment_gateway_url_in_test_mode';
		}*/

	}

	/**
	 * Process Payment
	 *
	 * @param object $row
	 * @param array  $data
	 */
	public function processPayment($row, $data)
	{
		$app    = JFactory::getApplication();
		$Itemid = $app->input->getInt('Itemid');

		/**
		 * Write code to pass the data to the payment gateway for payment processing. Below are some of the import data which you can
		 * access and pass to the payment gateway:
		 * $data['amount'] : Payment amount
		 * $data['item_name'] : The payment description
		 * $data['x_card_num']: Credit card number
		 * $data['exp_month']: Credit card expiration month
		 * $data['exp_year']: Credit card expiration year
		 * $['card_holder_name']: Credit card holder name
		 * $['card_type']: Credit card type, for example Visa
		 */

		$success = true;

		if ($success)
		{
			$transactionId = 'the_id_of_the_transaction';
			$this->onPaymentSuccess($row, $transactionId);

			// Redirect to the registration complete page
			$app->redirect(JRoute::_('index.php?option=com_eventbooking&view=complete&Itemid=' . $Itemid, false, false));
		}
		else
		{
			// Store the reason of the error so that it is being displayed on payment failure page
			$errorReason = 'the_returned_error_message';
			$session     = JFactory::getSession();
			$session->set('omnipay_payment_error_reason', $errorReason);

			// Redirect to payment failure page
			$app->redirect(JRoute::_('index.php?option=com_eventbooking&view=failure&Itemid=' . $Itemid, false, false));
		}
	}
}