<?php
	require_once(dirname(__FILE__) . "/class.pmprogateway.php");
	class PMProGateway_paypal
	{
		function PMProGateway_paypal($gateway = NULL)
		{
			$this->gateway = $gateway;
			return $this->gateway;
		}										
		
		function process(&$order)
		{
			if(floatval($order->InitialPayment) == 0)
			{
				//auth first, then process
				$authorization_id = $this->authorize($order);					
				if($authorization_id)
				{
					$this->void($order, $authorization_id);						
					$order->ProfileStartDate = date("Y-m-d", strtotime("+ " . $order->BillingFrequency . " " . $order->BillingPeriod)) . "T0:0:0";
					$order->ProfileStartDate = apply_filters("pmpro_profile_start_date", $order->ProfileStartDate, $order);
					return $this->subscribe($order);
				}
				else
				{
					if(empty($order->error))
						$order->error = "Unknown error: Authorization failed.";
					return false;
				}
			}
			else
			{
				//charge first payment
				if($this->charge($order))
				{																							
					//setup recurring billing
					if(pmpro_isLevelRecurring($order->membership_level))
					{
						$order->ProfileStartDate = date("Y-m-d", strtotime("+ " . $order->BillingFrequency . " " . $order->BillingPeriod)) . "T0:0:0";
						$order->ProfileStartDate = apply_filters("pmpro_profile_start_date", $order->ProfileStartDate, $order);
						if($this->subscribe($order))
						{							
							return true;
						}
						else
						{							
							if($this->refund($order, $order->payment_transaction_id))
							{
								if(empty($order->error))
									$order->error = "Unknown error: Payment failed.";							
							}
							else
							{
								if(empty($order->error))
									$order->error = "Unknown error: Payment failed.";
								
								$order->error .= " A partial payment was made that we could not refund. Please contact the site owner immediately to correct this.";
							}
							
							return false;	
						}
					}
					else
					{
						//only a one time charge							
						$order->status = "success";	//saved on checkout page											
						$order->saveOrder();
						return true;
					}
				}								
			}	
		}
		
		function authorize(&$order)
		{
			if(empty($order->code))
				$order->code = $order->getRandomCode();
									
			//paypal profile stuff
			$nvpStr = "";
			if(!empty($order->Token))
				$nvpStr .= "&TOKEN=" . $order->Token;
			$nvpStr .="&AMT=1.00&CURRENCYCODE=" . pmpro_getOption("currency");			
			$nvpStr .= "&NOTIFYURL=" . urlencode(admin_url('admin-ajax.php') . "?action=ipnhandler");
			//$nvpStr .= "&L_BILLINGTYPE0=RecurringPayments&L_BILLINGAGREEMENTDESCRIPTION0=" . $order->PaymentAmount;
			
			$nvpStr .= "&PAYMENTACTION=Authorization&IPADDRESS=" . $_SERVER['REMOTE_ADDR'] . "&INVNUM=" . $order->code;
						
			//credit card fields
			if($order->cardtype == "American Express")
				$cardtype = "Amex";
			else
				$cardtype = $order->cardtype;
			
			if(!empty($cardtype))
				$nvpStr .= "&CREDITCARDTYPE=" . $cardtype . "&ACCT=" . $order->accountnumber . "&EXPDATE=" . $order->ExpirationDate . "&CVV2=" . $order->CVV2;

			//Maestro/Solo card fields. (Who uses these?) :)
			if(!empty($order->StartDate))
				$nvpStr .= "&STARTDATE=" . $order->StartDate . "&ISSUENUMBER=" . $order->IssueNumber;
			
			//billing address, etc
			if(!empty($order->Address1))
			{
				$nvpStr .= "&EMAIL=" . $order->Email . "&FIRSTNAME=" . $order->FirstName . "&LASTNAME=" . $order->LastName . "&STREET=" . $order->Address1;
				
				if($order->Address2)
					$nvpStr .= "&STREET2=" . $order->Address2;
				
				$nvpStr .= "&CITY=" . $order->billing->city . "&STATE=" . $order->billing->state . "&COUNTRYCODE=" . $order->billing->country . "&ZIP=" . $order->billing->zip . "&SHIPTOPHONENUM=" . $order->billing->phone;
			}

			//for debugging, let's attach this to the class object
			$this->nvpStr = $nvpStr;
			
			$this->httpParsedResponseAr = $this->PPHttpPost('DoDirectPayment', $nvpStr);
						
			if("SUCCESS" == strtoupper($this->httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($this->httpParsedResponseAr["ACK"])) {
				$order->authorization_id = $this->httpParsedResponseAr['TRANSACTIONID'];
				$order->updateStatus("authorized");				
				return $order->authorization_id;				
			} else  {				
				$order->status = "error";
				$order->errorcode = $this->httpParsedResponseAr['L_ERRORCODE0'];
				$order->error = urldecode($this->httpParsedResponseAr['L_LONGMESSAGE0']);
				$order->shorterror = urldecode($this->httpParsedResponseAr['L_SHORTMESSAGE0']);
				return false;				
			}					
		}
		
		function void(&$order, $authorization_id)
		{
			if(empty($authorization_id))
				return false;
			
			//paypal profile stuff
			$nvpStr="&AUTHORIZATIONID=" . $authorization_id . "&NOTE=Voiding an authorization for a recurring payment setup.";
		
			$this->httpParsedResponseAr = $this->PPHttpPost('DoVoid', $nvpStr);
									
			if("SUCCESS" == strtoupper($this->httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($this->httpParsedResponseAr["ACK"])) {				
				return true;				
			} else  {				
				$order->status = "error";
				$order->errorcode = $this->httpParsedResponseAr['L_ERRORCODE0'];
				$order->error = urldecode($this->httpParsedResponseAr['L_LONGMESSAGE0']);
				$order->shorterror = urldecode($this->httpParsedResponseAr['L_SHORTMESSAGE0']);
				return false;				
			}	
		}	
		
		function refund(&$order, $transaction_id)
		{
			if(empty($transaction_id))
				return false;
			
			//paypal profile stuff
			$nvpStr="&TRANSACTIONID=" . $transaction_id . "&NOTE=Refunding a charge.";
		
			$this->httpParsedResponseAr = $this->PPHttpPost('RefundTransaction', $nvpStr);
						
			if("SUCCESS" == strtoupper($this->httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($this->httpParsedResponseAr["ACK"])) {				
				return true;				
			} else  {				
				$order->status = "error";
				$order->errorcode = $this->httpParsedResponseAr['L_ERRORCODE0'];
				$order->error = urldecode($this->httpParsedResponseAr['L_LONGMESSAGE0']);
				$order->shorterror = urldecode($this->httpParsedResponseAr['L_SHORTMESSAGE0']);
				return false;				
			}	
		}
		
		function charge(&$order)
		{
			global $pmpro_currency;
			
			if(empty($order->code))
				$order->code = $order->getRandomCode();
			
			//taxes on the amount
			$amount = $order->InitialPayment;
			$amount_tax = $order->getTaxForPrice($amount);						
			$order->subtotal = $amount;
			$amount = round((float)$amount + (float)$amount_tax, 2);
			
			//paypal profile stuff
			$nvpStr = "";
			if(!empty($order->Token))
				$nvpStr .= "&TOKEN=" . $order->Token;
			$nvpStr .="&AMT=" . $amount . "&ITEMAMT=" . $order->InitialPayment . "&TAXAMT=" . $amount_tax . "&CURRENCYCODE=" . $pmpro_currency;			
			$nvpStr .= "&NOTIFYURL=" . urlencode(admin_url('admin-ajax.php') . "?action=ipnhandler");
			//$nvpStr .= "&L_BILLINGTYPE0=RecurringPayments&L_BILLINGAGREEMENTDESCRIPTION0=" . $order->PaymentAmount;
			
			$nvpStr .= "&PAYMENTACTION=Sale&IPADDRESS=" . $_SERVER['REMOTE_ADDR'] . "&INVNUM=" . $order->code;			
			
			//credit card fields
			if($order->cardtype == "American Express")
				$cardtype = "Amex";
			else
				$cardtype = $order->cardtype;

			if(!empty($cardtype))
				$nvpStr .= "&CREDITCARDTYPE=" . $cardtype . "&ACCT=" . $order->accountnumber . "&EXPDATE=" . $order->ExpirationDate . "&CVV2=" . $order->CVV2;

			//Maestro/Solo card fields. (Who uses these?) :)
			if(!empty($order->StartDate))
				$nvpStr .= "&STARTDATE=" . $order->StartDate . "&ISSUENUMBER=" . $order->IssueNumber;
			
			//billing address, etc
			if($order->Address1)
			{
				$nvpStr .= "&EMAIL=" . $order->Email . "&FIRSTNAME=" . $order->FirstName . "&LASTNAME=" . $order->LastName . "&STREET=" . $order->Address1;
				
				if($order->Address2)
					$nvpStr .= "&STREET2=" . $order->Address2;
				
				$nvpStr .= "&CITY=" . $order->billing->city . "&STATE=" . $order->billing->state . "&COUNTRYCODE=" . $order->billing->country . "&ZIP=" . $order->billing->zip . "&SHIPTOPHONENUM=" . $order->billing->phone;
			}

			$this->httpParsedResponseAr = $this->PPHttpPost('DoDirectPayment', $nvpStr);
						
			if("SUCCESS" == strtoupper($this->httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($this->httpParsedResponseAr["ACK"])) {
				$order->payment_transaction_id = $this->httpParsedResponseAr['TRANSACTIONID'];
				$order->updateStatus("success");				
				return true;				
			} else  {				
				$order->status = "error";
				$order->errorcode = $this->httpParsedResponseAr['L_ERRORCODE0'];
				$order->error = urldecode($this->httpParsedResponseAr['L_LONGMESSAGE0']);
				$order->shorterror = urldecode($this->httpParsedResponseAr['L_SHORTMESSAGE0']);				
				return false;				
			}								
		}
		
		function subscribe(&$order)
		{
			global $pmpro_currency;
						
			if(empty($order->code))
				$order->code = $order->getRandomCode();			
			
			//taxes on the amount
			$amount = $order->PaymentAmount;
			$amount_tax = $order->getTaxForPrice($amount);						
			$order->subtotal = $amount;
			$amount = round((float)$amount + (float)$amount_tax, 2);
						
			//paypal profile stuff
			$nvpStr = "";
			if(!empty($order->Token))
				$nvpStr .= "&TOKEN=" . $order->Token;
			$nvpStr .="&AMT=" . $order->PaymentAmount . "&TAXAMT=" . $amount_tax . "&CURRENCYCODE=" . $pmpro_currency . "&PROFILESTARTDATE=" . $order->ProfileStartDate;
			$nvpStr .= "&BILLINGPERIOD=" . $order->BillingPeriod . "&BILLINGFREQUENCY=" . $order->BillingFrequency . "&AUTOBILLAMT=AddToNextBilling";
			$nvpStr .= "&DESC=" . urlencode(substr($order->membership_level->name . " at " . get_bloginfo("name"), 0, 127));
			$nvpStr .= "&NOTIFYURL=" . urlencode(admin_url('admin-ajax.php') . "?action=ipnhandler");
			//$nvpStr .= "&L_BILLINGTYPE0=RecurringPayments&L_BILLINGAGREEMENTDESCRIPTION0=" . $order->PaymentAmount;
			
			//if billing cycles are defined						
			if(!empty($order->TotalBillingCycles))
				$nvpStr .= "&TOTALBILLINGCYCLES=" . $order->TotalBillingCycles;
			
			//if a trial period is defined
			if(!empty($order->TrialBillingPeriod))
			{
				$trial_amount = $order->TrialAmount;				
				$trial_tax = $order->getTaxForPrice($trial_amount);
				$trial_amount = round((float)$trial_amount + (float)$trial_tax, 2);
				
				$nvpStr .= "&TRIALBILLINGPERIOD=" . $order->TrialBillingPeriod . "&TRIALBILLINGFREQUENCY=" . $order->TrialBillingFrequency . "&TRIALAMT=" . $trial_amount;
			}
			if(!empty($order->TrialBillingCycles))
				$nvpStr .= "&TRIALTOTALBILLINGCYCLES=" . $order->TrialBillingCycles;
			
			//credit card fields
			if($order->cardtype == "American Express")
				$cardtype = "Amex";
			else
				$cardtype = $order->cardtype;
			
			if($cardtype)			
				$nvpStr .= "&CREDITCARDTYPE=" . $cardtype . "&ACCT=" . $order->accountnumber . "&EXPDATE=" . $order->ExpirationDate . "&CVV2=" . $order->CVV2;

			//Maestro/Solo card fields. (Who uses these?) :)
			if(!empty($order->StartDate))
				$nvpStr .= "&STARTDATE=" . $order->StartDate . "&ISSUENUMBER=" . $order->IssueNumber;
			
			//billing address, etc
			if($order->Address1)
			{
				$nvpStr .= "&EMAIL=" . $order->Email . "&FIRSTNAME=" . $order->FirstName . "&LASTNAME=" . $order->LastName . "&STREET=" . $order->Address1;
				
				if($order->Address2)
					$nvpStr .= "&STREET2=" . $order->Address2;
				
				$nvpStr .= "&CITY=" . $order->billing->city . "&STATE=" . $order->billing->state . "&COUNTRYCODE=" . $order->billing->country . "&ZIP=" . $order->billing->zip . "&SHIPTOPHONENUM=" . $order->billing->phone;
			}

			//for debugging let's add this to the class object
			$this->nvpStr = $nvpStr;
						
			$this->httpParsedResponseAr = $this->PPHttpPost('CreateRecurringPaymentsProfile', $nvpStr);
						
			if("SUCCESS" == strtoupper($this->httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($this->httpParsedResponseAr["ACK"])) {
				$order->status = "success";				
				$order->subscription_transaction_id = urldecode($this->httpParsedResponseAr['PROFILEID']);
				return true;
				//exit('CreateRecurringPaymentsProfile Completed Successfully: '.print_r($this->httpParsedResponseAr, true));
			} else  {				
				$order->status = "error";
				$order->errorcode = $this->httpParsedResponseAr['L_ERRORCODE0'];
				$order->error = urldecode($this->httpParsedResponseAr['L_LONGMESSAGE0']);
				$order->shorterror = urldecode($this->httpParsedResponseAr['L_SHORTMESSAGE0']);
				return false;
				//exit('CreateRecurringPaymentsProfile failed: ' . print_r($httpParsedResponseAr, true));
			}
		}	
		
		function update(&$order)
		{
			//paypal profile stuff
			$nvpStr = "";			
			$nvpStr .= "&PROFILEID=" . $order->subscription_transaction_id;
			
			//credit card fields
			if($order->cardtype == "American Express")
				$cardtype = "Amex";
			else
				$cardtype = $order->cardtype;
			
			//credit card fields
			if($cardtype)			
				$nvpStr .= "&CREDITCARDTYPE=" . $cardtype . "&ACCT=" . $order->accountnumber . "&EXPDATE=" . $order->ExpirationDate . "&CVV2=" . $order->CVV2;

			//Maestro/Solo card fields. (Who uses these?) :)
			if($order->StartDate)
				$nvpStr .= "&STARTDATE=" . $order->StartDate . "&ISSUENUMBER=" . $order->IssueNumber;
			
			//billing address, etc
			if($order->Address1)
			{
				$nvpStr .= "&EMAIL=" . $order->Email . "&FIRSTNAME=" . $order->FirstName . "&LASTNAME=" . $order->LastName . "&STREET=" . $order->Address1;
				
				if($order->Address2)
					$nvpStr .= "&STREET2=" . $order->Address2;
				
				$nvpStr .= "&CITY=" . $order->billing->city . "&STATE=" . $order->billing->state . "&COUNTRYCODE=" . $order->billing->country . "&ZIP=" . $order->billing->zip;
			}		
			
			$this->httpParsedResponseAr = $this->PPHttpPost('UpdateRecurringPaymentsProfile', $nvpStr);
									
			if("SUCCESS" == strtoupper($this->httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($this->httpParsedResponseAr["ACK"])) {
				$order->status = "success";
				$order->subscription_transaction_id = urldecode($this->httpParsedResponseAr['PROFILEID']);
				return true;
				//exit('CreateRecurringPaymentsProfile Completed Successfully: '.print_r($this->httpParsedResponseAr, true));
			} else  {				
				$order->status = "error";
				$order->errorcode = $this->httpParsedResponseAr['L_ERRORCODE0'];
				$order->error = urldecode($this->httpParsedResponseAr['L_LONGMESSAGE0']);
				$order->shorterror = urldecode($this->httpParsedResponseAr['L_SHORTMESSAGE0']);
				return false;
				//exit('CreateRecurringPaymentsProfile failed: ' . print_r($httpParsedResponseAr, true));
			}
		}
		
		function cancel(&$order)
		{
			//paypal profile stuff
			$nvpStr = "";			
			$nvpStr .= "&PROFILEID=" . $order->subscription_transaction_id . "&ACTION=Cancel&NOTE=User requested cancel.";							
			
			$this->httpParsedResponseAr = $this->PPHttpPost('ManageRecurringPaymentsProfileStatus', $nvpStr);
									
			if("SUCCESS" == strtoupper($this->httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($this->httpParsedResponseAr["ACK"]) || $this->httpParsedResponseAr['L_ERRORCODE0'] == "11556") {				
				$order->updateStatus("cancelled");					
				return true;
				//exit('CreateRecurringPaymentsProfile Completed Successfully: '.print_r($this->httpParsedResponseAr, true));
			} else  {				
				$order->status = "error";
				$order->errorcode = $this->httpParsedResponseAr['L_ERRORCODE0'];
				$order->error = urldecode($this->httpParsedResponseAr['L_LONGMESSAGE0']);
				$order->shorterror = urldecode($this->httpParsedResponseAr['L_SHORTMESSAGE0']);
				return false;
				//exit('CreateRecurringPaymentsProfile failed: ' . print_r($httpParsedResponseAr, true));
			}
		}	
		
		/**
		 * PAYPAL Function
		 * Send HTTP POST Request
		 *
		 * @param	string	The API method name
		 * @param	string	The POST Message fields in &name=value pair format
		 * @return	array	Parsed HTTP Response body
		 */
		function PPHttpPost($methodName_, $nvpStr_) {
			global $gateway_environment;
			$environment = $gateway_environment;	
		
			$API_UserName = pmpro_getOption("apiusername");
			$API_Password = pmpro_getOption("apipassword");
			$API_Signature = pmpro_getOption("apisignature");
			$API_Endpoint = "https://api-3t.paypal.com/nvp";
			if("sandbox" === $environment || "beta-sandbox" === $environment) {
				$API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
			}						
			
			$version = urlencode('72.0');
		
			// setting the curl parameters.
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
		
			// turning off the server and peer verification(TrustManager Concept).
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
		
			// NVPRequest for submitting to server
			$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";
					
			// setting the nvpreq as POST FIELD to curl
			curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
		
			// getting response from server
			$httpResponse = curl_exec($ch);
		
			if(empty($httpResponse)) {
				exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
			}
		
			// Extract the RefundTransaction response details
			$httpResponseAr = explode("&", $httpResponse);
		
			$httpParsedResponseAr = array();
			foreach ($httpResponseAr as $i => $value) {
				$tmpAr = explode("=", $value);
				if(sizeof($tmpAr) > 1) {
					$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
				}
			}
		
			if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
				exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
			}
		
			return $httpParsedResponseAr;
		}
	}
?>
