<?php

#################### mpgGlobals #############################################





###################### curlPost #############################################


###################### mpgHttpsPost #########################################




###################### mpgHttpsPostStatus ###################################



############# mpgResponse ###################################################





################## mpgRequest ###############################################




##################### mpgCustInfo ###########################################



##################### mpgRecur ##############################################

class mpgRecur{

	var $params;
	var $recurTemplate = array('recur_unit','start_now','start_date','num_recurs','period','recur_amount');

	public function __construct($params)
	{
		$this->params = $params;
		if( (! $this->params['period']) )
		{
			$this->params['period'] = 1;
		}
	}

	public function toXML()
	{
		$xmlString = "";

		foreach($this->recurTemplate as $tag)
		{
			$xmlString .= "<$tag>". $this->params[$tag] ."</$tag>";
		}

		return "<recur>$xmlString</recur>";
	}

}//end class

##################### mpgAvsInfo ############################################

class mpgAvsInfo
{

    var $params;
    var $avsTemplate = array('avs_street_number','avs_street_name','avs_zipcode','avs_email','avs_hostname','avs_browser','avs_shiptocountry','avs_shipmethod','avs_merchprodsku','avs_custip','avs_custphone');

	public function __construct($params)
    {
        $this->params = $params;
    }

	public function toXML()
    {
        $xmlString = "";

        foreach($this->avsTemplate as $tag)
        {
        	//will only add to the XML the tags from the template that were also passed in by the merchant
			if(array_key_exists($tag, $this->params))
			{
				$xmlString .= "<$tag>". $this->params[$tag] ."</$tag>";
			}
        }

        return "<avs_info>$xmlString</avs_info>";
    }

}//end class

##################### mpgCvdInfo ############################################

class mpgCvdInfo
{

    var $params;
    var $cvdTemplate = array('cvd_indicator','cvd_value');

	public function __construct($params)
    {
        $this->params = $params;
    }

	public function toXML()
    {
        $xmlString = "";

        foreach($this->cvdTemplate as $tag)
        {
            $xmlString .= "<$tag>". $this->params[$tag] ."</$tag>";
        }

        return "<cvd_info>$xmlString</cvd_info>";
    }

}//end class

##################### mpgAchInfo ############################################

class mpgAchInfo
{

	var $params;
	var $achTemplate = array('sec','cust_first_name','cust_last_name',
			'cust_address1','cust_address2','cust_city',
			'cust_state','cust_zip','routing_num','account_num',
			'check_num','account_type','micr');

	public function __construct($params)
	{
		$this->params = $params;
	}

	public function toXML()
	{
		$xmlString = "";

		foreach($this->achTemplate as $tag)
		{
			$xmlString .= "<$tag>". $this->params[$tag] ."</$tag>";
		}

		return "<ach_info>$xmlString</ach_info>";
	}

}//end class

##################### mpgConvFeeInfo ########################################

class mpgConvFeeInfo
{

	var $params;
	var $convFeeTemplate = array('convenience_fee');

	public function __construct($params)
	{
		$this->params = $params;
	}

	public function toXML()
	{
		$xmlString = "";

		foreach($this->convFeeTemplate as $tag)
		{
			$xmlString .= "<$tag>". $this->params[$tag] ."</$tag>";
		}

		return "<convfee_info>$xmlString</convfee_info>";
	}

}//end class

##################### mpgTransaction ########################################



###################### MpiHttpsPost #########################################

class MpiHttpsPost
{

	var $api_token;
	var $store_id;
	var $mpiRequest;
	var $mpiResponse;

	public function __construct($storeid,$apitoken,$mpiRequestOBJ)
	{

		$this->store_id=$storeid;
		$this->api_token= $apitoken;
		$this->mpiRequest=$mpiRequestOBJ;
		$dataToSend=$this->toXML();

		$url = $this->mpiRequest->getURL();

  		$httpsPost= new httpsPost($url, $dataToSend);	
  		$response = $httpsPost->getHttpsResponse();

		if(!$response)
		{

			$response="<?xml version=\"1.0\"?>".
					"<MpiResponse>".
					"<type>null</type>".
					"<success>false</success>".
					"<message>null</message>".
					"<PaReq>null</PaReq>".
					"<TermUrl>null</TermUrl>".
					"<MD>null</MD>".
					"<ACSUrl>null</ACSUrl>".
					"<cavv>null</cavv>".
					"<PAResVerified>null</PAResVerified>".
					"</MpiResponse>";
		}

		$this->mpiResponse=new MpiResponse($response);
			
	}



	public function getMpiResponse()
	{
		return $this->mpiResponse;

	}

	public function toXML( )
	{

		$req=$this->mpiRequest ;
		$reqXMLString=$req->toXML();

		$xmlString ="<?xml version=\"1.0\"?>".
					"<MpiRequest>".
					"<store_id>$this->store_id</store_id>".
					"<api_token>$this->api_token</api_token>".
					$reqXMLString.
					"</MpiRequest>";

		return ($xmlString);

	}

}//end class mpiHttpsPost

############# MpiResponse ###################################################


class MpiResponse{

	var $responseData;

	var $p; //parser

	var $currentTag;
	var $receiptHash = array();
	var $currentTxnType;

	var $ACSUrl;

	public function __construct($xmlString)
	{

		$this->p = xml_parser_create();
		xml_parser_set_option($this->p,XML_OPTION_CASE_FOLDING,0);
		xml_parser_set_option($this->p,XML_OPTION_TARGET_ENCODING,"UTF-8");
		xml_set_object($this->p, $this);
		xml_set_element_handler($this->p,"startHandler","endHandler");
		xml_set_character_data_handler($this->p,"characterHandler");
		xml_parse($this->p,$xmlString);
		xml_parser_free($this->p);

	}//end of constructor

	//vbv start
	
	//To prevent Undefined Index Notices
	private function getMpiResponseValue($responseData, $value)
	{
		return (isset($responseData[$value]) ? $responseData[$value] : '');
	}

	public function getMpiMessage()
	{
		return $this->getMpiResponseValue($this->responseData,'message');
	}


	public function getMpiSuccess()
	{
		return $this->getMpiResponseValue($this->responseData,'success');
	}

	public function getMpiPAResVerified()
	{
		return $this->getMpiResponseValue($this->responseData,'PAResVerified');
	}

	public function getMpiAcsUrl()
	{
		return $this->getMpiResponseValue($this->responseData,'ACSUrl');
	}

	public function getMpiPaReq()
	{
		return $this->getMpiResponseValue($this->responseData,'PaReq');
	}
	
	public function getMpiTermUrl()
	{
		return $this->getMpiResponseValue($this->responseData,'TermUrl');
	}

	public function getMpiMD()
	{
		return $this->getMpiResponseValue($this->responseData,'MD');
	}

	public function getMpiCavv()
	{
		return $this->getMpiResponseValue($this->responseData,'cavv');
	}

	public function getMpiEci()
	{
		return $this->getMpiResponseValue($this->responseData,'eci');
	}

	public function getMpiResponseData()
	{
		return($this->responseData);
	}

	public function getMpiPopUpWindow()
	{
		$popUpForm ='<html><head><title>Title for Page</title></head><SCRIPT LANGUAGE="Javascript" >' .
					"<!--
					function OnLoadEvent()
					{
						window.name='mainwindow';
						//childwin = window.open('about:blank','popupName','height=400,width=390,status=yes,dependent=no,scrollbars=yes,resizable=no');
						//document.downloadForm.target = 'popupName';
						document.downloadForm.submit();
					}
					-->
					</SCRIPT>" .
					'<body onload="OnLoadEvent()">
						<form name="downloadForm" action="' . $this->getMpiAcsUrl() .
						'" method="POST">
						<noscript>
						<br>
						<br>
						<center>
						<h1>Processing your 3-D Secure Transaction</h1>
						<h2>
						JavaScript is currently disabled or is not supported
						by your browser.<br>
						<h3>Please click on the Submit button to continue
						the processing of your 3-D secure
						transaction.</h3>
						<input type="submit" value="Submit">
						</center>
						</noscript>
						<input type="hidden" name="PaReq" value="' . $this->getMpiPaReq() . '">
						<input type="hidden" name="MD" value="' . $this->getMpiMD() . '">
						<input type="hidden" name="TermUrl" value="' . $this->getMpiTermUrl() .'">
						</form>
					</body>
					</html>';

		return $popUpForm;
	}


	public function getMpiInLineForm()
	{

		$inLineForm ='<html><head><title>Title for Page</title></head><SCRIPT LANGUAGE="Javascript" >' .
					"<!--
					function OnLoadEvent()
					{
						document.downloadForm.submit();
					}
					-->
					</SCRIPT>" .
					'<body onload="OnLoadEvent()">
						<form name="downloadForm" action="' . $this->getMpiAcsUrl() .
						'" method="POST">
						<noscript>
						<br>
						<br>
						<center>
						<h1>Processing your 3-D Secure Transaction</h1>
						<h2>
						JavaScript is currently disabled or is not supported
						by your browser.<br>
						<h3>Please click on the Submit button to continue
						the processing of your 3-D secure
						transaction.</h3>
						<input type="submit" value="Submit">
						</center>
						</noscript>
						<input type="hidden" name="PaReq" value="' . $this->getMpiPaReq() . '">
						<input type="hidden" name="MD" value="' . $this->getMpiMD() . '">
						<input type="hidden" name="TermUrl" value="' . $this->getMpiTermUrl() .'">
						</form>
					</body>
					</html>';

		return $inLineForm;
	}

	private function characterHandler($parser,$data)
	{
		if(isset($this->responseData[$this->currentTag]))
		{
			$this->responseData[$this->currentTag] .= $data;
		}
		else
		{
			$this->responseData[$this->currentTag] = $data;
		}
	}//end characterHandler

	private function startHandler($parser,$name,$attrs)
	{
		$this->currentTag=$name;
	}


	private function endHandler($parser,$name)
	{

	}


}//end class MpiResponse

################## mpiRequest ###############################################

class MpiRequest
{

	var $txnTypes = array(
						'txn' =>array('xid', 'amount', 'pan', 'expdate','MD', 'merchantUrl','accept','userAgent','currency','recurFreq', 'recurEnd','install'),
						'acs'=> array('PaRes','MD')
					);
	
	var $txnArray;
	var $procCountryCode = "";
	var $testMode = "";

	public function __construct($txn)
	{

		if(is_array($txn))
		{
			$this->txnArray = $txn;
		}
		else
		{
			$temp[0]=$txn;
			$this->txnArray=$temp;
		}
	}
	public function setProcCountryCode($countryCode)
	{
		$this->procCountryCode = ((strcmp(strtolower($countryCode), "us") >= 0) ? "_US" : "");
	}
	
	public function setTestMode($state)
	{
		if($state === true)
		{
			$this->testMode = "_TEST";
		}
		else
		{
			$this->testMode = "";
		}
	}
	
	public function getURL()
	{
		$g=new mpgGlobals();
		$gArray=$g->getGlobals();
	
		//$txnType = $this->getTransactionType();
	
		$hostId = "MONERIS".$this->procCountryCode.$this->testMode."_HOST";
		$fileId = "MONERIS".$this->procCountryCode."_MPI_FILE";
	
		$url =  $gArray['MONERIS_PROTOCOL']."://".
				$gArray[$hostId].":".
				$gArray['MONERIS_PORT'].
				$gArray[$fileId];
	
		//echo "PostURL: " . $url;
	
		return $url;
	}
	
	public function toXML()
	{
		$xmlString = "";
		$tmpTxnArray=$this->txnArray;
		$txnArrayLen=count($tmpTxnArray); //total number of transactions

		for($x=0;$x < $txnArrayLen;$x++)
		{
			$txnObj=$tmpTxnArray[$x];
			$txn=$txnObj->getTransaction();
	
			$txnType=array_shift($txn);
			$tmpTxnTypes=$this->txnTypes;
			$txnTypeArray=$tmpTxnTypes[$txnType];
			$txnTypeArrayLen=count($txnTypeArray); //length of a specific txn type
	
			$txnXMLString="";
			
			for($i=0;$i < $txnTypeArrayLen ;$i++)
			{
				//Will only add to the XML if the tag was passed in by merchant
				if(array_key_exists($txnTypeArray[$i], $txn))
                {
				 	$txnXMLString  .="<$txnTypeArray[$i]>"   //begin tag
									.$txn[$txnTypeArray[$i]] // data
									. "</$txnTypeArray[$i]>"; //end tag
				}
			}
		 
			$txnXMLString = "<$txnType>$txnXMLString";

			$txnXMLString .="</$txnType>";
	
			$xmlString .=$txnXMLString;
		}

		return $xmlString;

	}//end toXML

}//end class MpiRequest

################# mpiTransaction ############################################

class MpiTransaction
{
	var $txn;

	public function __construct($txn)
	{
		$this->txn=$txn;
	}

	public function getTransaction()
	{
		return $this->txn;
	}
}//end class MpiTransaction


###################### riskHttpsPost ########################################

class riskHttpsPost{

	var $api_token;
	var $store_id;
	var $riskRequest;
	var $riskResponse;

	public function __construct($storeid,$apitoken,$riskRequestOBJ)
	{

		$this->store_id=$storeid;
		$this->api_token= $apitoken;
		$this->riskRequest=$riskRequestOBJ;
		$dataToSend=$this->toXML();
	
		$url = $this->riskRequest->getURL();

  		$httpsPost= new httpsPost($url, $dataToSend);	
  		$response = $httpsPost->getHttpsResponse();

		if(!$response)
		{

			$response="<?xml version=\"1.0\"?><response><receipt>".
					"<ReceiptId>Global Error Receipt</ReceiptId>".
					"<ResponseCode>null</ResponseCode>".
					"<AuthCode>null</AuthCode><TransTime>null</TransTime>".
					"<TransDate>null</TransDate><TransType>null</TransType><Complete>false</Complete>".
					"<Message>null</Message><TransAmount>null</TransAmount>".
					"<CardType>null</CardType>".
					"<TransID>null</TransID><TimedOut>null</TimedOut>".
					"</receipt></response>";
		}

		//print "Got a xml response of: \n$response\n";
		$this->riskResponse=new riskResponse($response);

	}



	public function getRiskResponse()
	{
		return $this->riskResponse;

	}

	public function toXML( )
	{

		$req=$this->riskRequest ;
		$reqXMLString=$req->toXML();

		$xmlString ="<?xml version=\"1.0\"?>".
					"<request>".
					"<store_id>$this->store_id</store_id>".
					"<api_token>$this->api_token</api_token>".
					"<risk>".
					$reqXMLString.
					"</risk>".
					"</request>";

		return ($xmlString);

	}

}//end class riskHttpsPost



############# riskResponse ##################################################


class riskResponse{

	var $responseData;

	var $p; //parser

	var $currentTag;
	var $isResults;
	var $isRule;
	var $ruleName;
	var $results = array();
	var $rules = array();

	public function __construct($xmlString)
	{

		$this->p = xml_parser_create();
		xml_parser_set_option($this->p,XML_OPTION_CASE_FOLDING,0);
		xml_parser_set_option($this->p,XML_OPTION_TARGET_ENCODING,"UTF-8");
		xml_set_object($this->p,$this);
		xml_set_element_handler($this->p,"startHandler","endHandler");
		xml_set_character_data_handler($this->p,"characterHandler");
		xml_parse($this->p,$xmlString);
		xml_parser_free($this->p);

	}//end of constructor


	public function getRiskResponse()
	{
		return($this->responseData);
	}
	
	//To prevent Undefined Index Notices
	private function getMpgResponseValue($responseData, $value)
	{
		return (isset($responseData[$value]) ? $responseData[$value] : '');
	}

	//-----------------  Receipt Variables  ---------------------------------------------------------//

	public function getReceiptId()
	{
		return $this->getMpgResponseValue($this->responseData,'ReceiptId');
	}

	public function getResponseCode()
	{
		return $this->getMpgResponseValue($this->responseData,'ResponseCode');
	}

	public function getMessage()
	{
		return $this->getMpgResponseValue($this->responseData,'Message');
	}

	public function getResults()
	{
		return ($this->results);
	}

	public function getRules()
	{
		return ($this->rules);
	}

	//-----------------  Parser Handlers  ---------------------------------------------------------//

	private function characterHandler($parser,$data)
	{
		@$this->responseData[$this->currentTag] .=$data;

		if($this->isResults)
		{
			//print("\n".$this->currentTag."=".$data);
			$this->results[$this->currentTag] = $data;
			 
		}

		if($this->isRule)
		{

			if ($this->currentTag == "RuleName")
			{
				$this->ruleName=$data;
			}
			$this->rules[$this->ruleName][$this->currentTag] = $data;

		}
	}//end characterHandler


	private function startHandler($parser,$name,$attrs)
	{
		$this->currentTag=$name;

		if($this->currentTag == "Result")
		{
			$this->isResults=1;
		}

		if($this->currentTag == "Rule")
		{
			$this->isRule=1;
		}
	} //end startHandler

	private function endHandler($parser,$name)
	{
		$this->currentTag=$name;

		if($name == "Result")
		{
			$this->isResults=0;
		}

		if($this->currentTag == "Rule")
		{
			$this->isRule=0;
		}

		$this->currentTag="/dev/null";
	} //end endHandler



}//end class riskResponse


################## riskRequest ##############################################

class riskRequest{

	var $txnTypes =array(
						'session_query' => array('order_id','session_id','service_type','event_type'),
						'attribute_query' => array('order_id','policy_id','service_type'),
						'assert' => array('orig_order_id','activities_description','impact_description','confidence_description')
	);

	var $txnArray;
	var $procCountryCode = "";
	var $testMode = "";

	public function __construct($txn)
	{
		if(is_array($txn))
		{
			$this->txnArray = $txn;
		}
		else
		{
			$temp[0]=$txn;
			$this->txnArray=$temp;
		}
	}
	
	public function setProcCountryCode($countryCode)
	{
		$this->procCountryCode = ((strcmp(strtolower($countryCode), "us") >= 0) ? "_US" : "");
	}
	
	public function setTestMode($state)
	{
		if($state === true)
		{
			$this->testMode = "_TEST";
		}
		else
		{
			$this->testMode = "";
		}
	}
	
	public function getURL()
	{
		$g=new mpgGlobals();
		$gArray=$g->getGlobals();
	
		//$txnType = $this->getTransactionType();
	
		$hostId = "MONERIS".$this->procCountryCode.$this->testMode."_HOST";
		$fileId = "MONERIS".$this->procCountryCode."_FILE";
	
		$url =  $gArray['MONERIS_PROTOCOL']."://".
				$gArray[$hostId].":".
				$gArray['MONERIS_PORT'].
				$gArray[$fileId];
	
		//echo "PostURL: " . $url;
	
		return $url;
	}

	public function toXML()
	{
		$xmlString = "";

		$tmpTxnArray=$this->txnArray;

		$txnArrayLen=count($tmpTxnArray); //total number of transactions
		for($x=0;$x < $txnArrayLen;$x++)
		{
			$txnObj=$tmpTxnArray[$x];
			$txn=$txnObj->getTransaction();

			$txnType=array_shift($txn);
			$tmpTxnTypes=$this->txnTypes;
			$txnTypeArray=$tmpTxnTypes[$txnType];
			$txnTypeArrayLen=count($txnTypeArray); //length of a specific txn type

			$txnXMLString="";
			for($i=0;$i < $txnTypeArrayLen ;$i++)
			{
				//Will only add to the XML if the tag was passed in by merchant
				if(array_key_exists($txnTypeArray[$i], $txn))
                {
				 	$txnXMLString  .="<$txnTypeArray[$i]>"   //begin tag
									.$txn[$txnTypeArray[$i]] // data
									. "</$txnTypeArray[$i]>"; //end tag
				}
			}

			$txnXMLString = "<$txnType>$txnXMLString";

			$sessionQuery  = $txnObj->getSessionAccountInfo();
			 
			if($sessionQuery != null)
			{
				$txnXMLString .= $sessionQuery->toXML();
			}

			$attributeQuery  = $txnObj->getAttributeAccountInfo();
	
			if($attributeQuery != null)
			{
				$txnXMLString .= $attributeQuery->toXML();
			}
	
			$txnXMLString .="</$txnType>";
	
			$xmlString .=$txnXMLString;
	
			return $xmlString;
		}

		return $xmlString;

	}//end toXML
}//end class

##################### mpgSessionAccountInfo #################################

class mpgSessionAccountInfo
{

	var $params;
	var $sessionAccountInfoTemplate = array('policy','account_login','password_hash','account_number','account_name',
											'account_email','account_telephone','pan','account_address_street1','account_address_street2','account_address_city',
											'account_address_state','account_address_country','account_address_zip','shipping_address_street1','shipping_address_street2','shipping_address_city',
											'shipping_address_state','shipping_address_country','shipping_address_zip','local_attrib_1','local_attrib_2','local_attrib_3','local_attrib_4',
											'local_attrib_5','transaction_amount','transaction_currency');

	public function __construct($params)
	{
		$this->params = $params;
	}

	public function toXML()
	{
		$xmlString = "";
		foreach($this->sessionAccountInfoTemplate as $tag)
		{
			if(isset($this->params[$tag]))
			{
				$xmlString .= "<$tag>". $this->params[$tag] ."</$tag>";
			}
		}
		return "<session_account_info>$xmlString</session_account_info>";
	}

}//end class mpgSessionAccountInfo

##################### mpgAttributeAccountInfo ###############################

class mpgAttributeAccountInfo
{

	var $params;
	var $attributeAccountInfoTemplate = array('device_id','account_login','password_hash','account_number','account_name',
											'account_email','account_telephone','cc_number_hash','ip_address','ip_forwarded','account_address_street1','account_address_street2','account_address_city',
											'account_address_state','account_address_country','account_address_zip','shipping_address_street1','shipping_address_street2','shipping_address_city',
											'shipping_address_state','shipping_address_country','shipping_address_zip');

	public function __construct($params)
	{
		$this->params = $params;
	}

	public function toXML()
	{
		$xmlString = "";
		foreach($this->attributeAccountInfoTemplate as $tag)
		{
			if(isset($this->params[$tag]))
			{
				$xmlString .= "<$tag>". $this->params[$tag] ."</$tag>";
			}
		}

		return "<attribute_account_info>$xmlString</attribute_account_info>";
	}

}//end class


##################### riskTransaction #######################################

class riskTransaction{

	var $txn;
	var $attributeAccountInfo = null;
	var $sessionAccountInfo = null;

	public function __construct($txn)
	{
		$this->txn=$txn;
	}

	public function getTransaction()
	{
		return $this->txn;
	}

	public function getAttributeAccountInfo()
	{
		return $this->attributeAccountInfo;
	}
	
	public function setAttributeAccountInfo($attributeAccountInfo)
	{
		$this->attributeAccountInfo = $attributeAccountInfo;
	}

	public function getSessionAccountInfo()
	{
		return $this->sessionAccountInfo;
	}
	
	public function setSessionAccountInfo($sessionAccountInfo)
	{
		$this->sessionAccountInfo = $sessionAccountInfo;
	}
}//end class RiskTransaction

/******************* AMEX Level23 *******************/
class mpgAxLevel23
{

	private $template = array	(
			'axlevel23' => array ('table1' => null, 'table2' => null, 'table3' => null)
	);

	private $data;

	public function __construct()
	{
		$this->data = $this->template;
	}

	public function setTable1($big04, $big05, $big10, axN1Loop $axN1Loop)
	{
		$this->data['axlevel23']['table1']['big04'] = $big04;
		$this->data['axlevel23']['table1']['big05'] = $big05;
		$this->data['axlevel23']['table1']['big10'] = $big10;
		$this->data['axlevel23']['table1']['n1_loop'] = $axN1Loop->getData();
	}

	public function setTable2(axIt1Loop $axIt1Loop)
	{
		$this->data['axlevel23']['table2']['it1_loop'] = $axIt1Loop->getData();
	}

	public function setTable3(axTxi $axTxi)
	{
		$this->data['axlevel23']['table3']['txi'] = $axTxi->getData();
	}

	public function toXML()
	{
		$xmlString=$this->toXML_low($this->data, "axlevel23");

		return $xmlString;
	}

	private function toXML_low($dataArray, $root)
	{
		$xmlRoot = "";

		foreach ($dataArray as $key => $value)
		{
			if(!is_numeric($key) && $value != "" && $value != null)
			{
				$xmlRoot .= "<$key>";
			}
			else if(is_numeric($key) && $key != "0")
			{
				$xmlRoot .= "</$root><$root>";
			}
				
			if(is_array($value))
			{
				$xmlRoot .= $this->toXML_low($value, $key);
			}
			else
			{
				$xmlRoot .= $value;
			}
				
			if(!is_numeric($key) && $value != "" && $value != null)
			{
				$xmlRoot .= "</$key>";
			}
		}

		return $xmlRoot;
	}

	public function getData()
	{
		return $this->data;
	}
}

class axN1Loop
{
	private $template = array (
							'n101' => null ,
							'n102' => null , 
							'n301' => null , 
							'n401' => null , 
							'n402' => null , 
							'n403' => null , 
							'ref' => null
	);

	private $data;

	public function __construct()
	{
		$this->data = array();
	}

	public function setN1Loop($n101, $n102, $n301, $n401, $n402, $n403, axRef $ref)
	{
		$this->template['n101'] = $n101;
		$this->template['n102'] = $n102;
		$this->template['n301'] = $n301;
		$this->template['n401'] = $n401;
		$this->template['n402'] = $n402;
		$this->template['n403'] = $n403;
		$this->template['ref'] = $ref->getData();

		array_push($this->data, $this->template);
	}

	public function getData()
	{
		return $this->data;
	}
}

class axRef
{
	private $template = array (
			'ref01' => null , 'ref02' => null
	);

	private $data;

	public function __construct()
	{
		$this->data = array();
	}

	public function setRef($ref01, $ref02)
	{
		$this->template['ref01'] = $ref01;
		$this->template['ref02'] = $ref02;

		array_push($this->data, $this->template);
	}

	public function getData()
	{
		return $this->data;
	}
}

class axIt1Loop
{
	private $template = array(
			'it102' => null, 'it103'  => null, 'it104' => null, 'it105' => null, 'it106s' => null , 'txi' => null , 'pam05' => null, 'pid05' => null
	);

	private $data;

	public function __construct()
	{
		$this->data = array();
	}

	public function setIt1Loop($it102, $it103, $it104, $it105, axIt106s $it106s, axTxi $txi, $pam05, $pid05)
	{
		$this->template['it102'] = $it102;
		$this->template['it103'] = $it103;
		$this->template['it104'] = $it104;
		$this->template['it105'] = $it105;
		$this->template['it106s'] = $it106s->getData();
		$this->template['txi'] = $txi->getData();
		$this->template['pam05'] = $pam05;
		$this->template['pid05'] = $pid05;

		array_push($this->data, $this->template);
	}

	public function getData()
	{
		return $this->data;
	}
}

class axIt106s
{
	private $template = array (
			'it10618' => null, 'it10719' => null
	);

	private $data;

	public function __construct()
	{
		$this->data = $this->template;
	}
	
	public function setIt10618($it10618)
	{
		$this->data['it10618'] = $it10618;
	}
	
	public function setIt10719($it10719)
	{
		$this->data['it10719'] = $it10719;
	}

	public function getData()
	{
		return $this->data;
	}
}

class axTxi
{
	private $template = array (
			'txi01' => null, 'txi02' => null, 'txi03' => null, 'txi06' => null
	);

	private $data;

	public function __construct()
	{
		$this->data = array();
	}

	public function setTxi($txi01, $txi02, $txi03, $txi06)
	{
		$this->template['txi01'] = $txi01;
		$this->template['txi02'] = $txi02;
		$this->template['txi03'] = $txi03;
		$this->template['txi06'] = $txi06;

		array_push($this->data, $this->template);
	}

	public function getData()
	{
		return $this->data;
	}

}

class mpgAxRaLevel23
{

	private $template = array(
			'axralevel23' => array(
					'airline_process_id' => null,
					'invoice_batch' => null,
					'establishment_name' => null,
					'carrier_name' => null,
					'ticket_id' => null,
					'issue_city' => null,
					'establishment_state' => null,
					'number_in_party' => null,
					'passenger_name' => null,
					'taa_routing' => null,
					'carrier_code' => null,
					'fare_basis' => null,
					'document_type' => null,
					'doc_number' => null,
					'departure_date' => null
			)
	);

	private $data;

	public function __construct()
	{
		$this->data = $this->template;
	}

	public function setAxRaLevel23($airline_process_id, $invoice_batch, $establishment_name, $carrier_name, $ticket_id, $issue_city, $establishment_state, $number_in_party, $passenger_name, $taa_routing, $carrier_code, $fare_basis, $document_type, $doc_number, $departure_date)
	{
		$this->data['axralevel23']['airline_process_id'] = $airline_process_id;
		$this->data['axralevel23']['invoice_batch'] = $invoice_batch;
		$this->data['axralevel23']['establishment_name'] = $establishment_name;
		$this->data['axralevel23']['carrier_name'] = $carrier_name;
		$this->data['axralevel23']['ticket_id'] = $ticket_id;
		$this->data['axralevel23']['issue_city'] = $issue_city;
		$this->data['axralevel23']['establishment_state'] = $establishment_state;
		$this->data['axralevel23']['number_in_party'] = $number_in_party;
		$this->data['axralevel23']['passenger_name'] = $passenger_name;
		$this->data['axralevel23']['taa_routing'] = $taa_routing;
		$this->data['axralevel23']['carrier_code'] = $carrier_code;
		$this->data['axralevel23']['fare_basis'] = $fare_basis;
		$this->data['axralevel23']['document_type'] = $document_type;
		$this->data['axralevel23']['doc_number'] = $doc_number;
		$this->data['axralevel23']['departure_date'] = $departure_date;
	}

	public function setAirlineProcessId($airline_process_id)
	{
		$this->data['axralevel23']['airline_process_id'] = $airline_process_id;
	}

	public function setInvoiceBatch($invoice_batch)
	{
		$this->data['axralevel23']['invoice_batch'] = $invoice_batch;
	}

	public function setEstablishmentName($establishment_name)
	{
		$this->data['axralevel23']['establishment_name'] = $establishment_name;
	}

	public function setCarrierName($carrier_name)
	{
		$this->data['axralevel23']['carrier_name'] = $carrier_name;
	}

	public function setTicketId($ticket_id)
	{
		$this->data['axralevel23']['ticket_id'] = $ticket_id;
	}

	public function setIssueCity($issue_city)
	{
		$this->data['axralevel23']['issue_city'] = $issue_city;
	}

	public function setEstablishmentState($establishment_state)
	{
		$this->data['axralevel23']['establishment_state'] = $establishment_state;
	}

	public function setNumberInParty($number_in_party)
	{
		$this->data['axralevel23']['number_in_party'] = $number_in_party;
	}

	public function setPassengerName($passenger_name)
	{
		$this->data['axralevel23']['passenger_name'] = $passenger_name;
	}

	public function setTaaRouting($taa_routing)
	{
		$this->data['axralevel23']['taa_routing'] = $taa_routing;
	}

	public function setCarrierCode($carrier_code)
	{
		$this->data['axralevel23']['carrier_code'] = $carrier_code;
	}

	public function setFareBasis($fare_basis)
	{
		$this->data['axralevel23']['fare_basis'] = $fare_basis;
	}

	public function setDocumentType($document_type)
	{
		$this->data['axralevel23']['document_type'] = $document_type;
	}

	public function setDocNumber($doc_number)
	{
		$this->data['axralevel23']['doc_number'] = $doc_number;
	}

	public function setDepartureDate($departure_date)
	{
		$this->data['axralevel23']['departure_date'] = $departure_date;
	}

	public function toXML()
	{
		$xmlString=$this->toXML_low($this->data, "axralevel23");

		return $xmlString;
	}

	private function toXML_low($dataArray, $root)
	{
		$xmlRoot = "";

		foreach ($dataArray as $key => $value)
		{
			if(!is_numeric($key) && $value != "" && $value != null)
			{
				$xmlRoot .= "<$key>";
			}
			else if(is_numeric($key) && $key != "0")
			{
				$xmlRoot .= "</$root><$root>";
			}

			if(is_array($value))
			{
				$xmlRoot .= $this->toXML_low($value, $key);
			}
			else
			{
				$xmlRoot .= $value;
			}

			if(!is_numeric($key) && $value != "" && $value != null)
			{
				$xmlRoot .= "</$key>";
			}
		}

		return $xmlRoot;
	}

	public function getData()
	{
		return $this->data;
	}
}//end class

/******************* Visa Level23 *******************/
class mpgVsLevel23
{

	private $template = array(
			'corpai' => null,
			'corpas' => null,
			'vspurcha' => null,
			'vspurchl' => null
	);

	private $data;

	public function __construct()
	{
		$this->data = $this->template;
	}

	public function setVsCorpa(vsCorpai $vsCorpai, vsCorpas $vsCorpas)
	{
		$this->data['vspurcha'] = null;
		$this->data['vspurchal'] = null;

		$this->data['corpai'] = $vsCorpai->getData();
		$this->data['corpas'] = $vsCorpas->getData();
	}

	public function setVsPurch(vsPurcha $vsPurcha, vsPurchl $vsPurchl)
	{
		$this->data['corpai'] = null;
		$this->data['corpas'] = null;

		$this->data['vspurcha'] = $vsPurcha->getData();
		$this->data['vspurchl'] = $vsPurchl->getData();
	}

	public function toXML()
	{
		$xmlString=$this->toXML_low($this->data, "0");

		return $xmlString;
	}

	private function toXML_low($dataArray, $root)
	{
		$xmlRoot = "";

		foreach ($dataArray as $key => $value)
		{
			if(!is_numeric($key) && $value != "" && $value != null)
			{
				$xmlRoot .= "<$key>";
			}
			else if(is_numeric($key) && $key != "0")
			{
				$xmlRoot .= "</$root><$root>";
			}

			if(is_array($value))
			{
				$xmlRoot .= $this->toXML_low($value, $key);
			}
			else
			{
				$xmlRoot .= $value;
			}

			if(!is_numeric($key) && $value != "" && $value != null)
			{
				$xmlRoot .= "</$key>";
			}
		}

		return $xmlRoot;
	}

	public function getData()
	{
		return $this->data;
	}
}//end class

class vsPurcha
{

	private $template = array(
			'buyer_name' => null,
			'local_tax_rate' => null,
			'duty_amount' => null,
			'discount_treatment' => null,
			'discount_amt' => null,
			'freight_amount' => null,
			'ship_to_pos_code' => null,
			'ship_from_pos_code' => null,
			'des_cou_code' => null,
			'vat_ref_num' => null,
			'tax_treatment' => null,
			'gst_hst_freight_amount' => null,
			'gst_hst_freight_rate' => null
	);

	private $data;

	public function __construct()
	{
		$this->data = $this->template;
	}

	public function setVsPurcha($buyer_name, $local_tax_rate, $duty_amount, $discount_treatment, $discount_amt, $freight_amount, $ship_to_pos_code, $ship_from_pos_code, $des_cou_code, $vat_ref_num, $tax_treatment, $gst_hst_freight_amount, $gst_hst_freight_rate)
	{
		$this->data['buyer_name'] = $buyer_name;
		$this->data['local_tax_rate'] = $local_tax_rate;
		$this->data['duty_amount'] = $duty_amount;
		$this->data['discount_treatment'] = $discount_treatment;
		$this->data['discount_amt'] = $discount_amt;
		$this->data['freight_amount'] = $freight_amount;
		$this->data['ship_to_pos_code'] = $ship_to_pos_code;
		$this->data['ship_from_pos_code'] = $ship_from_pos_code;
		$this->data['des_cou_code'] = $des_cou_code;
		$this->data['vat_ref_num'] = $vat_ref_num;
		$this->data['tax_treatment'] = $tax_treatment;
		$this->data['gst_hst_freight_amount'] = $gst_hst_freight_amount;
		$this->data['gst_hst_freight_rate'] = $gst_hst_freight_rate;
	}

	public function setBuyerName($buyer_name)
	{
		$this->data['buyer_name'] = $buyer_name;
	}

	public function setLocalTaxRate($local_tax_rate)
	{
		$this->data['local_tax_rate'] = $local_tax_rate;
	}

	public function setDutyAmount($duty_amount)
	{
		$this->data['duty_amount'] = $duty_amount;
	}

	public function setDiscountTreatment($discount_treatment)
	{
		$this->data['discount_treatment'] = $discount_treatment;
	}

	public function setDiscountAmt($discount_amt)
	{
		$this->data['discount_amt'] = $discount_amt;
	}

	public function setFreightAmount($freight_amount)
	{
		$this->data['freight_amount'] = $freight_amount;
	}

	public function setShipToPostalCode($ship_to_pos_code)
	{
		$this->data['ship_to_pos_code'] = $ship_to_pos_code;
	}

	public function setShipFromPostalCode($ship_from_pos_code)
	{
		$this->data['ship_from_pos_code'] = $ship_from_pos_code;
	}

	public function setDesCouCode($des_cou_code)
	{
		$this->data['des_cou_code'] = $des_cou_code;
	}

	public function setVatRefNum($vat_ref_num)
	{
		$this->data['vat_ref_num'] = $vat_ref_num;
	}

	public function setTaxTreatment($tax_treatment)
	{
		$this->data['tax_treatment'] = $tax_treatment;
	}

	public function setGstHstFreightAmount($gst_hst_freight_amount)
	{
		$this->data['gst_hst_freight_amount'] = $gst_hst_freight_amount;
	}

	public function setGstHstFreightRate($gst_hst_freight_rate)
	{
		$this->data['gst_hst_freight_rate'] = $gst_hst_freight_rate;
	}

	public function getData()
	{
		return $this->data;
	}
}//end class

class vsPurchl
{

	private $template = array(
			'item_com_code' => null,
			'product_code' => null,
			'item_description' => null,
			'item_quantity' => null,
			'item_uom' => null,
			'unit_cost' => null,
			'vat_tax_amt' => null,
			'vat_tax_rate' => null,
			'discount_treatment' => null,
			'discount_amt' => null
	);

	private $data;

	public function __construct()
	{
		$this->data = array();
	}

	public function setVsPurchl($item_com_code, $product_code, $item_description, $item_quantity, $item_uom, $unit_cost, $vat_tax_amt, $vat_tax_rate, $discount_treatment, $discount_amt)
	{
		$this->template['item_com_code'] = $item_com_code;
		$this->template['product_code'] = $product_code;
		$this->template['item_description'] = $item_description;
		$this->template['item_quantity'] = $item_quantity;
		$this->template['item_uom'] = $item_uom;
		$this->template['unit_cost'] = $unit_cost;
		$this->template['vat_tax_amt'] = $vat_tax_amt;
		$this->template['vat_tax_rate'] = $vat_tax_rate;
		$this->template['discount_treatment'] = $discount_treatment;
		$this->template['discount_amt'] = $discount_amt;

		array_push($this->data, $this->template);
	}

	public function getData()
	{
		return $this->data;
	}
}//end class

class vsCorpai
{

	private $template = array(
			'ticket_number' => null,
			'passenger_name1' => null,
			'total_fee' => null,
			'exchange_ticket_number' => null,
			'exchange_ticket_amount' => null,
			'travel_agency_code' => null,
			'travel_agency_name' => null,
			'internet_indicator' => null,
			'electronic_ticket_indicator' => null,
			'vat_ref_num' => null
	);

	private $data;

	public function __construct()
	{
		$this->data = $this->template;
	}

	public function setCorpai($ticket_number, $passenger_name1, $total_fee, $exchange_ticket_number, $exchange_ticket_amount, $travel_agency_code, $travel_agency_name, $internet_indicator, $electronic_ticket_indicator, $vat_ref_num)
	{
		$this->data['ticket_number'] = $ticket_number;
		$this->data['passenger_name1'] = $passenger_name1;
		$this->data['total_fee'] = $total_fee;
		$this->data['exchange_ticket_number'] = $exchange_ticket_number;
		$this->data['exchange_ticket_amount'] = $exchange_ticket_amount;
		$this->data['travel_agency_code'] = $travel_agency_code;
		$this->data['travel_agency_name'] = $travel_agency_name;
		$this->data['internet_indicator'] = $internet_indicator;
		$this->data['electronic_ticket_indicator'] = $electronic_ticket_indicator;
		$this->data['vat_ref_num'] = $vat_ref_num;
	}

	public function setTicketNumber($ticket_number)
	{
		$this->data['ticket_number'] = $ticket_number;
	}

	public function setPassengerName1($passenger_name1)
	{
		$this->data['passenger_name1'] = $passenger_name1;
	}

	public function setTotalFee($total_fee)
	{
		$this->data['total_fee'] = $total_fee;
	}

	public function setExchangeTicketNumber($exchange_ticket_number)
	{
		$this->data['exchange_ticket_number'] = $exchange_ticket_number;
	}

	public function setExchangeTicketAmount($exchange_ticket_amount)
	{
		$this->data['exchange_ticket_amount'] = $exchange_ticket_amount;
	}

	public function setTravelAgencyCode($travel_agency_code)
	{
		$this->data['travel_agency_code'] = $travel_agency_code;
	}

	public function setTravelAgencyName($travel_agency_name)
	{
		$this->data['travel_agency_name'] = $travel_agency_name;
	}

	public function setInternetIndicator($internet_indicator)
	{
		$this->data['internet_indicator'] = $internet_indicator;
	}

	public function setElectronicTicketIndicator($electronic_ticket_indicator)
	{
		$this->data['electronic_ticket_indicator'] = $electronic_ticket_indicator;
	}

	public function setVatRefNum($vat_ref_num)
	{
		$this->data['vat_ref_num'] = $vat_ref_num;
	}

	public function getData()
	{
		return $this->data;
	}
}//end class

class vsCorpas
{

	private $template = array(
			'conjunction_ticket_number' => null,
			'trip_leg_info' => null,
			'control_id' => null
	);

	private $data;

	public function __construct()
	{
		$this->data = array();
	}

	public function setCorpas($conjunction_ticket_number, vsTripLegInfo $vsTripLegInfo, $control_id)
	{
		$this->template['conjunction_ticket_number'] = $conjunction_ticket_number;
		$this->template['trip_leg_info'] = $vsTripLegInfo->getData();
		$this->template['control_id'] = $control_id;

		array_push($this->data, $this->template);
	}

	public function getData()
	{
		return $this->data;
	}
}//end class

class vsTripLegInfo
{

	private $template = array(
			'coupon_number' => null,
			'carrier_code1' => null,
			'flight_number' => null,
			'service_class' => null,
			'orig_city_airport_code' => null,
			'stop_over_code' => null,
			'dest_city_airport_code' => null,
			'fare_basis_code' => null,
			'departure_date1' => null,
			'departure_time' => null,
			'arrival_time' => null
	);

	private $data;

	public function __construct()
	{
		$this->data = array();
	}

	public function setTripLegInfo($coupon_number, $carrier_code1, $flight_number, $service_class, $orig_city_airport_code, $stop_over_code, $dest_city_airport_code, $fare_basis_code, $departure_date1, $departure_time, $arrival_time)
	{
		$this->template['coupon_number'] = $coupon_number;
		$this->template['carrier_code1'] = $carrier_code1;
		$this->template['flight_number'] = $flight_number;
		$this->template['service_class'] = $service_class;
		$this->template['orig_city_airport_code'] = $orig_city_airport_code;
		$this->template['stop_over_code'] = $stop_over_code;
		$this->template['dest_city_airport_code'] = $dest_city_airport_code;
		$this->template['fare_basis_code'] = $fare_basis_code;
		$this->template['departure_date1'] = $departure_date1;
		$this->template['departure_time'] = $departure_time;
		$this->template['arrival_time'] = $arrival_time;

		array_push($this->data, $this->template);
	}

	public function getData()
	{
		return $this->data;
	}
}//end class

/**************** MasterCard Level23 ****************/

class mpgMcLevel23
{

	private $template = array(
			'mccorpac' => null,
			'mccorpai' => null,
			'mccorpas' => null,
			'mccorpal' => null,
			'mccorpar' => null
	);

	private $data;

	public function __construct()
	{
		$this->data = $this->template;
	}

	public function setMcCorpac(mcCorpac $mcCorpac)
	{
		$this->data['mccorpac'] = $mcCorpac->getData();
	}

	public function setMcCorpai(mcCorpai $mcCorpai)
	{
		$this->data['mccorpai'] = $mcCorpai->getData();
	}

	public function setMcCorpas(mcCorpas $mcCorpas)
	{
		$this->data['mccorpas'] = $mcCorpas->getData();
	}

	public function setMcCorpal(mcCorpal $mcCorpal)
	{
		$this->data['mccorpal'] = $mcCorpal->getData();
	}

	public function setMcCorpar(mcCorpar $mcCorpar)
	{
		$this->data['mccorpar'] = $mcCorpar->getData();
	}

	public function toXML()
	{
		$xmlString=$this->toXML_low($this->data, "0");

		return $xmlString;
	}

	private function toXML_low($dataArray, $root)
	{
		$xmlRoot = "";

		foreach ($dataArray as $key => $value)
		{
			if(!is_numeric($key) && $value != "" && $value != null)
			{
				$xmlRoot .= "<$key>";
			}
			else if(is_numeric($key) && $key != "0")
			{
				$xmlRoot .= "</$root><$root>";
			}

			if(is_array($value))
			{
				$xmlRoot .= $this->toXML_low($value, $key);
			}
			else
			{
				$xmlRoot .= $value;
			}

			if(!is_numeric($key) && $value != "" && $value != null)
			{
				$xmlRoot .= "</$key>";
			}
		}

		return $xmlRoot;
	}

	public function getData()
	{
		return $this->data;
	}
}//end class


class mcCorpac
{

	private $template = array(
			'customer_code1' => null,
			'additional_card_acceptor_data' => null,
			'austin_tetra_number' => null,
			'naics_code' => null,
			'card_acceptor_type' => null,
			'card_acceptor_tax_id' => null,
			'corporation_vat_number' => null,
			'card_acceptor_reference_number' => null,
			'freight_amount1' => null,
			'duty_amount1' => null,
			'ship_to_pos_code' => null,
			'destination_province_code' => null,
			'destination_country_code' => null,
			'ship_from_pos_code' => null,
			'order_date' => null,
			'card_acceptor_vat_number' => null,
			'customer_vat_number' => null,
			'unique_invoice_number' => null,
			'commodity_code' => null,
			'authorized_contact_name' => null,
			'authorized_contact_phone' => null,
			'tax' => null
	);

	private $data;

	public function __construct()
	{
		$this->data = $this->template;
	}

	public function setMcCorpac($customer_code1, $additional_card_acceptor_data, $austin_tetra_number, $naics_code, $card_acceptor_type, $card_acceptor_tax_id, $corporation_vat_number, $card_acceptor_reference_number, $freight_amount1, $duty_amount1, $ship_to_pos_code, $destination_province_code, $destination_country_code, $ship_from_pos_code, $order_date, $card_acceptor_vat_number, $customer_vat_number, $unique_invoice_number, $commodity_code, $authorized_contact_name, $authorized_contact_phone, mcTax $mctax)
	{
		$this->data['customer_code1'] = $customer_code1;
		$this->data['additional_card_acceptor_data'] = $additional_card_acceptor_data;
		$this->data['austin_tetra_number'] = $austin_tetra_number;
		$this->data['naics_code'] = $naics_code;
		$this->data['card_acceptor_type'] = $card_acceptor_type;
		$this->data['card_acceptor_tax_id'] = $card_acceptor_tax_id;
		$this->data['corporation_vat_number'] = $corporation_vat_number;
		$this->data['card_acceptor_reference_number'] = $card_acceptor_reference_number;
		$this->data['freight_amount1'] = $freight_amount1;
		$this->data['duty_amount1'] = $duty_amount1;
		$this->data['ship_to_pos_code'] = $ship_to_pos_code;
		$this->data['destination_province_code'] = $destination_province_code;
		$this->data['destination_country_code'] = $destination_country_code;
		$this->data['ship_from_pos_code'] = $ship_from_pos_code;
		$this->data['order_date'] = $order_date;
		$this->data['card_acceptor_vat_number'] = $card_acceptor_vat_number;
		$this->data['customer_vat_number'] = $customer_vat_number;
		$this->data['unique_invoice_number'] = $unique_invoice_number;
		$this->data['commodity_code'] = $commodity_code;
		$this->data['authorized_contact_name'] = $authorized_contact_name;
		$this->data['authorized_contact_phone'] = $authorized_contact_phone;
		$this->data['tax'] = $mctax->getData();
	}

	public function setCustomerCode1($customer_code1)
	{
		$this->data['customer_code1'] = $customer_code1;
	}

	public function setAdditionalCardAcceptorData($additional_card_acceptor_data)
	{
		$this->data['additional_card_acceptor_data'] = $additional_card_acceptor_data;
	}

	public function setAustinTetraNumber($austin_tetra_number)
	{
		$this->data['austin_tetra_number'] = $austin_tetra_number;
	}

	public function setNaicsCode($naics_code)
	{
		$this->data['naics_code'] = $naics_code;
	}

	public function setCardAcceptorType($card_acceptor_type)
	{
		$this->data['card_acceptor_type'] = $card_acceptor_type;
	}

	public function setCardAcceptorTaxTd($card_acceptor_tax_id)
	{
		$this->data['card_acceptor_tax_id'] = $card_acceptor_tax_id;
	}

	public function setCorporationVatNumber($corporation_vat_number)
	{
		$this->data['corporation_vat_number'] = $corporation_vat_number;
	}

	public function setCardAcceptorReferenceNumber($card_acceptor_reference_number)
	{
		$this->data['card_acceptor_reference_number'] = $card_acceptor_reference_number;
	}

	public function setFreightAmount1($freight_amount1)
	{
		$this->data['freight_amount1'] = $freight_amount1;
	}

	public function setDutyAmount1($duty_amount1)
	{
		$this->data['duty_amount1'] = $duty_amount1;
	}

	public function setShipToPosCode($ship_to_pos_code)
	{
		$this->data['ship_to_pos_code'] = $ship_to_pos_code;
	}

	public function setDestinationProvinceCode($destination_province_code)
	{
		$this->data['destination_province_code'] = $destination_province_code;
	}

	public function setDestinationCountryCode($destination_country_code)
	{
		$this->data['destination_country_code'] = $destination_country_code;
	}

	public function setShipFromPosCode($ship_from_pos_code)
	{
		$this->data['ship_from_pos_code'] = $ship_from_pos_code;
	}

	public function setOrderDate($order_date)
	{
		$this->data['order_date'] = $order_date;
	}

	public function setCardAcceptorVatNumber($card_acceptor_vat_number)
	{
		$this->data['card_acceptor_vat_number'] = $card_acceptor_vat_number;
	}

	public function setCustomerVatNumber($customer_vat_number)
	{
		$this->data['customer_vat_number'] = $customer_vat_number;
	}

	public function setUniqueInvoiceNumber($unique_invoice_number)
	{
		$this->data['unique_invoice_number'] = $unique_invoice_number;
	}

	public function setCommodityCode($commodity_code)
	{
		$this->data['commodity_code'] = $commodity_code;
	}

	public function setAuthorizedContactName($authorized_contact_name)
	{
		$this->data['authorized_contact_name'] = $authorized_contact_name;
	}

	public function setAuthorizedContactPhone($authorized_contact_phone)
	{
		$this->data['authorized_contact_phone'] = $authorized_contact_phone;
	}

	public function setTax(mcTax $mcTax)
	{
		$this->data['tax'] = $mcTax->getData();
	}

	public function getData()
	{
		return $this->data;
	}
}//end class


class mcCorpai
{

	private $template = array(
			'passenger_name1' => null,
			'ticket_number1' => null,
			'issuing_carrier' => null,
			'customer_code1' => null,
			'issue_date' => null,
			'travel_agency_code' => null,
			'travel_agency_name' => null,
			'total_fare' => null,
			'total_fee' => null,
			'total_taxes' => null,
			'commodity_code' => null,
			'restricted_ticket_indicator' => null,
			'exchange_ticket_amount' => null,
			'exchange_fee_amount' => null,
			'travel_authorization_code' => null,
			'iata_client_code' => null,
			'tax' => null
	);

	private $data;

	public function __construct()
	{
		$this->data = $this->template;
	}

	public function setMcCorpai($passenger_name1, $ticket_number1, $issuing_carrier, $customer_code1, $issue_date, $travel_agency_code, $travel_agency_name, $total_fare, $total_fee, $total_taxes, $commodity_code, $restricted_ticket_indicator, $exchange_ticket_amount, $exchange_fee_amount, $travel_authorization_code, $iata_client_code, mcTax $mctax)
	{
		$this->data['passenger_name1'] = $passenger_name1;
		$this->data['ticket_number1'] = $ticket_number1;
		$this->data['issuing_carrier'] = $issuing_carrier;
		$this->data['customer_code1'] = $customer_code1;
		$this->data['issue_date'] = $issue_date;
		$this->data['travel_agency_code'] = $travel_agency_code;
		$this->data['travel_agency_name'] = $travel_agency_name;
		$this->data['total_fare'] = $total_fare;
		$this->data['total_fee'] = $total_fee;
		$this->data['total_taxes'] = $total_taxes;
		$this->data['commodity_code'] = $commodity_code;
		$this->data['restricted_ticket_indicator'] = $restricted_ticket_indicator;
		$this->data['exchange_ticket_amount'] = $exchange_ticket_amount;
		$this->data['exchange_fee_amount'] = $exchange_fee_amount;
		$this->data['travel_authorization_code'] = $travel_authorization_code;
		$this->data['iata_client_code'] = $iata_client_code;
		$this->data['tax'] = $mctax->getData();
	}

	public function setPassengerName1($passenger_name1)
	{
		$this->data['passenger_name1'] = $passenger_name1;
	}

	public function setTicketNumber1($ticket_number1)
	{
		$this->data['ticket_number1'] = $ticket_number1;
	}

	public function setIssuingCarrier($issuing_carrier)
	{
		$this->data['issuing_carrier'] = $issuing_carrier;
	}

	public function setCustomerCode1($customer_code1)
	{
		$this->data['customer_code1'] = $customer_code1;
	}

	public function setIssueDate($issue_date)
	{
		$this->data['issue_date'] = $issue_date;
	}

	public function setTravelAgencyCode($travel_agency_code)
	{
		$this->data['travel_agency_code'] = $travel_agency_code;
	}

	public function setTravelAgencyName($travel_agency_name)
	{
		$this->data['travel_agency_name'] = $travel_agency_name;
	}

	public function setTotalFare($total_fare)
	{
		$this->data['total_fare'] = $total_fare;
	}

	public function setTotalFee($total_fee)
	{
		$this->data['total_fee'] = $total_fee;
	}

	public function setTotalTaxes($total_taxes)
	{
		$this->data['total_taxes'] = $total_taxes;
	}

	public function setCommodityCode($commodity_code)
	{
		$this->data['commodity_code'] = $commodity_code;
	}

	public function setRestrictedTicketIndicator($restricted_ticket_indicator)
	{
		$this->data['restricted_ticket_indicator'] = $restricted_ticket_indicator;
	}

	public function setExchangeTicketAmount($exchange_ticket_amount)
	{
		$this->data['exchange_ticket_amount'] = $exchange_ticket_amount;
	}

	public function setExchangeFeeAmount($exchange_fee_amount)
	{
		$this->data['exchange_fee_amount'] = $exchange_fee_amount;
	}

	public function setTravelAuthorizationCode($travel_authorization_code)
	{
		$this->data['travel_authorization_code'] = $travel_authorization_code;
	}

	public function setIataClientCode($iata_client_code)
	{
		$this->data['iata_client_code'] = $iata_client_code;
	}

	public function setTax(mcTax $mcTax)
	{
		$this->data['tax'] = $mcTax->getData();
	}


	public function getData()
	{
		return $this->data;
	}
}//end class


class mcCorpas
{

	private $template = array(
			'travel_date' => null,
			'carrier_code1' => null,
			'service_class' => null,
			'orig_city_airport_code' => null,
			'dest_city_airport_code' => null,
			'stop_over_code' => null,
			'conjunction_ticket_number1' => null,
			'exchange_ticket_number' => null,
			'coupon_number1' => null,
			'fare_basis_code1' => null,
			'flight_number' => null,
			'departure_time' => null,
			'arrival_time' => null,
			'fare' => null,
			'fee' => null,
			'taxes' => null,
			'endorsement_restrictions' => null,
			'tax' => null
	);

	private $data;

	public function __construct()
	{
		$this->data = array();
	}

	public function setMcCorpas($travel_date, $carrier_code1, $service_class, $orig_city_airport_code, $dest_city_airport_code, $stop_over_code, $conjunction_ticket_number1, $exchange_ticket_number1, $coupon_number1, $fare_basis_code1, $flight_number, $departure_time, $arrival_time, $fare, $fee, $taxes, $endorsement_restrictions, mcTax $mcTax)
	{
		$this->template['travel_date'] = $travel_date;
		$this->template['carrier_code1'] = $carrier_code1;
		$this->template['service_class'] = $service_class;
		$this->template['orig_city_airport_code'] = $orig_city_airport_code;
		$this->template['dest_city_airport_code'] = $dest_city_airport_code;
		$this->template['stop_over_code'] = $stop_over_code;
		$this->template['conjunction_ticket_number1'] = $conjunction_ticket_number1;
		$this->template['exchange_ticket_number1'] = $exchange_ticket_number1;
		$this->template['coupon_number1'] = $coupon_number1;
		$this->template['fare_basis_code1'] = $fare_basis_code1;
		$this->template['flight_number'] = $flight_number;
		$this->template['departure_time'] = $departure_time;
		$this->template['arrival_time'] = $arrival_time;
		$this->template['fare'] = $fare;
		$this->template['fee'] = $fee;
		$this->template['taxes'] = $taxes;
		$this->template['endorsement_restrictions'] = $endorsement_restrictions;
		$this->template['tax'] = $mcTax->getData();

		array_push($this->data, $this->template);
	}

	public function getData()
	{
		return $this->data;
	}
}//end class



class mcCorpal
{

	private $template = array(
			'customer_code1' => null,
			'line_item_date' => null,
			'ship_date' => null,
			'order_date' => null,
			'medical_services_ship_to_health_industry_number' => null,
			'contract_number' => null,
			'medical_services_adjustment' => null,
			'medical_services_product_number_qualifier' => null,
			'product_code1' => null,
			'item_description' => null,
			'item_quantity' => null,
			'unit_cost' => null,
			'item_unit_measure' => null,
			'ext_item_amount' => null,
			'discount_amount' => null,
			'commodity_code' => null,
			'type_of_supply' => null,
			'vat_ref_num' => null,
			'tax' => null
	);

	private $data;

	public function __construct()
	{
		$this->data = array();
	}

	public function setMcCorpal($customer_code1, $line_item_date, $ship_date, $order_date, $medical_services_ship_to_health_industry_number, $contract_number, $medical_services_adjustment, $medical_services_product_number_qualifier, $product_code1, $item_description, $item_quantity, $unit_cost, $item_unit_measure, $ext_item_amount, $discount_amount, $commodity_code, $type_of_supply, $vat_ref_num, mcTax $mcTax)
	{
		$this->template['customer_code1'] = $customer_code1;
		$this->template['line_item_date'] = $line_item_date;
		$this->template['ship_date'] = $ship_date;
		$this->template['order_date'] = $order_date;
		$this->template['medical_services_ship_to_health_industry_number'] = $medical_services_ship_to_health_industry_number;
		$this->template['contract_number'] = $contract_number;
		$this->template['medical_services_adjustment'] = $medical_services_adjustment;
		$this->template['medical_services_product_number_qualifier'] = $medical_services_product_number_qualifier;
		$this->template['product_code1'] = $product_code1;
		$this->template['item_description'] = $item_description;
		$this->template['item_quantity'] = $item_quantity;
		$this->template['unit_cost'] = $unit_cost;
		$this->template['item_unit_measure'] = $item_unit_measure;
		$this->template['ext_item_amount'] = $ext_item_amount;
		$this->template['discount_amount'] = $discount_amount;
		$this->template['commodity_code'] = $commodity_code;
		$this->template['type_of_supply'] = $type_of_supply;
		$this->template['vat_ref_num'] = $vat_ref_num;
		$this->template['tax'] = $mcTax->getData();

		array_push($this->data, $this->template);
	}

	public function getData()
	{
		return $this->data;
	}
}//end class



class mcCorpar
{

	private $template = array(
			'passenger_name1' => null,
			'ticket_number1' => null,
			'travel_agency_code' => null,
			'travel_agency_name' => null,
			'travel_date' => null,
			'sequence_number' => null,
			'procedure_id' => null,
			'service_type' => null,
			'service_nature' => null,
			'service_amount' => null,
			'full_vat_gross_amount' => null,
			'full_vat_tax_amount' => null,
			'half_vat_gross_amount' => null,
			'half_vat_tax_amount' => null,
			'traffic_code' => null,
			'sample_number' => null,
			'start_station' => null,
			'destination_station' => null,
			'generic_code' => null,
			'generic_number' => null,
			'generic_other_code' => null,
			'generic_other_number' => null,
			'reduction_code' => null,
			'reduction_number' => null,
			'reduction_other_code' => null,
			'reduction_other_number' => null,
			'transportation_other_code' => null,
			'number_of_adults' => null,
			'number_of_children' => null,
			'class_of_ticket' => null,
			'transportation_service_provider' => null,
			'transportation_service_offered' => null
	);

	private $data;

	public function __construct()
	{
		$this->data = array();
	}

	public function setMcCorpar($passenger_name1, $ticket_number1, $travel_agency_code, $travel_agency_name, $travel_date, $sequence_number, $procedure_id, $service_type, $service_nature, $service_amount, $full_vat_gross_amount, $full_vat_tax_amount, $half_vat_gross_amount, $half_vat_tax_amount, $traffic_code, $sample_number, $start_station, $destination_station, $generic_code, $generic_number, $generic_other_code, $generic_other_number, $reduction_code, $reduction_number, $reduction_other_code, $reduction_other_number, $transportation_other_code, $number_of_adults, $number_of_children, $class_of_ticket, $transportation_service_provider, $transportation_service_offered)
	{
		$this->template['passenger_name1'] = $passenger_name1;
		$this->template['ticket_number1'] = $ticket_number1;
		$this->template['travel_agency_code'] = $travel_agency_code;
		$this->template['travel_agency_name'] = $travel_agency_name;
		$this->template['travel_date'] = $travel_date;
		$this->template['sequence_number'] = $sequence_number;
		$this->template['procedure_id'] = $procedure_id;
		$this->template['service_type'] = $service_type;
		$this->template['service_nature'] = $service_nature;
		$this->template['service_amount'] = $service_amount;
		$this->template['full_vat_gross_amount'] = $full_vat_gross_amount;
		$this->template['full_vat_tax_amount'] = $full_vat_tax_amount;
		$this->template['half_vat_gross_amount'] = $half_vat_gross_amount;
		$this->template['half_vat_tax_amount'] = $half_vat_tax_amount;
		$this->template['traffic_code'] = $traffic_code;
		$this->template['sample_number'] = $sample_number;
		$this->template['start_station'] = $start_station;
		$this->template['destination_station'] = $destination_station;
		$this->template['generic_code'] = $generic_code;
		$this->template['generic_number'] = $generic_number;
		$this->template['generic_other_code'] = $generic_other_code;
		$this->template['generic_other_number'] = $generic_other_number;
		$this->template['reduction_code'] = $reduction_code;
		$this->template['reduction_number'] = $reduction_number;
		$this->template['reduction_other_code'] = $reduction_other_code;
		$this->template['reduction_other_number'] = $reduction_other_number;
		$this->template['transportation_other_code'] = $transportation_other_code;
		$this->template['number_of_adults'] = $number_of_adults;
		$this->template['number_of_children'] = $number_of_children;
		$this->template['class_of_ticket'] = $class_of_ticket;
		$this->template['transportation_service_provider'] = $transportation_service_provider;
		$this->template['transportation_service_offered'] = $transportation_service_offered;

		array_push($this->data, $this->template);
	}

	public function getData()
	{
		return $this->data;
	}
}//end class


class mcTax
{
	private $template = array (
			'tax_amount' => null,
			'tax_rate' => null,
			'tax_type' => null,
			'tax_id' => null,
			'tax_included_in_sales' => null
	);

	private $data;

	public function __construct()
	{
		$this->data = array();
	}

	public function setTax($tax_amount, $tax_rate, $tax_type, $tax_id, $tax_included_in_sales)
	{
		$this->template['tax_amount'] = $tax_amount;
		$this->template['tax_rate'] = $tax_rate;
		$this->template['tax_type'] = $tax_type;
		$this->template['tax_id'] = $tax_id;
		$this->template['tax_included_in_sales'] = $tax_included_in_sales;

		array_push($this->data, $this->template);
	}

	public function getData()
	{
		return $this->data;
	}
}


?>
