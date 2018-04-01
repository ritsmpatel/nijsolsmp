<?php class Number2Word {
	
	var $words = array();
	var $places = array();
	var $number_in_words = "";
	var $decimal = "";
	var $lenDecimal = "";
	/**
	*
	* @desc Class Constructor
	* @return void
	*/
	function Number2Word($number,$flag=0) {
		if(is_numeric($number)) {
			
			$this->init();
			
			$numTmpStr = (string)$number;
			$decStr = "";
			
			$pos = strpos($numTmpStr,".");
			if ($pos) {
				$numTmpStr = substr($numTmpStr,0,$pos);
				$this->decimal = strstr((string)$number, ".");
				$this->lenDecimal = strlen($this->decimal) - 2;
				$this->decimal = substr($this->decimal, 1, $this->lenDecimal + 1);
				for($i=0;$i<strlen($this->decimal);$i++) {
					if(substr($this->decimal, $i, 1) == "0") {
						$decStr .= $this->words["0"];
					} else {
						$decStr .= $this->processWords(substr($this->decimal, $i, 1));
					}
				}
			}
			if( $pos && trim($decStr) ) {
				$this->number_in_words = $this->processWords($numTmpStr) . " Point " . $decStr ;
			} else {
				$this->number_in_words = $this->processWords($numTmpStr);
			}
		} else {
			$this->number_in_words = "Sorry !!. Please Enter a valid number.";
		}
		$this->showNumWords($flag);
	}
	
	/**
	*
	* @desc Function to process the number to words
	* @return void
	*/	
	function processWords($numTmpStr) {

		$numLen = strlen($numTmpStr) - 1;
		$numSlice = array();
		$index = 0;
		$hFlag = true;

		while($numLen >= 0) {
			if($numLen >= 2 && $hFlag) {
				$numSlice[$index++] = substr($numTmpStr, $numLen - 2, 3);
				$numLen -= 3;
				$hFlag = false;
			} elseif($numLen >= 1 && !$hFlag) {
				$numSlice[$index++] = substr($numTmpStr, $numLen - 1, 2);
				$numLen -= 2;
			} else {
				$numSlice[$index++] = substr($numTmpStr, 0, $numLen + 1);
				$numLen = -1;
			}
		}
		$numStr = "";
		$nPlace = count($numSlice) - 1;
		if($nPlace > 3) {
			return "Sorry !!. Can't convert this number $number";
		}
		for($i=$nPlace;$i>=0;$i--) {
			$slices = trim($numSlice[$i]);
			$subSlice = array();
			$tmpStr = "";
			for($j=0;$j<strlen($slices);$j++) {
				$subSlice[$j] = substr($slices, $j, 1);
			}
			$subLen = count($subSlice);
			if($subLen == 1) {
				if($subSlice[0] != "0") {
					$tmpStr .= $this->processNum("0",$subSlice[0]) . $this->places[$i];
				}
			} elseif($subLen == 2) {
				if($subSlice[0] != "0" || $subSlice[1] != "0") {
					$tmpStr .= $this->processNum($subSlice[0], $subSlice[1]) . $this->places[$i];
				}
			} else if($subLen == 3) {
				if($subSlice[0] != "0") {
					$tmpStr .= ((strlen($tmpStr) > 0)?" ":"") . $this->processNum("0",$subSlice[0]) . " Hundred  ";
				}
				$tmpStr .= $this->processNum($subSlice[1],$subSlice[2]);
			}
			$numStr .= $tmpStr;
		}
		
		/*return strtoupper($numStr);*/
		return $numStr;
	}
	
	/**
	*
	* @desc Function to show the number in words
	* @return void
	*/
	function showNumWords($flag) {
		if($flag==1)
		{
			return $this->number_in_words;
		}
		else
		{
			echo $this->number_in_words;
		}
	}
	
	/**
	*
	* @desc Function to Process the number to string
	* @param $pos1 First Position Number
	* @param $pos2 Second Position Number
	* @return String
	*/
	function processNum($pos1, $pos2) {
		if($pos1 == "0") {
			if($pos2 == "0") {
				return "";
			} else {
				return $this->words[$pos2];
			}
		} elseif($pos1 != "1") {
			if($pos2 != "0") {
				return $this->words[$pos1."0"] . $this->words[$pos2];
			} else {
				return $this->words[$pos1.$pos2];
			}
		} else {
			if($pos2 == "0") {
				return $this->words["10"];
			} else {
				return $this->words[$pos1 . $pos2];
			}
		}
		
	}
	
	/**
	*
	* @desc Function to initialize the resources
	* @return void
	*/
	function init() {
		$this->words["0"] = " Zero";
		$this->words["1"] = " One";
		$this->words["2"] = " Two";
		$this->words["3"] = " Three";
		$this->words["4"] = " Four";
		$this->words["5"] = " Five";
		$this->words["6"] = " Six";
		$this->words["7"] = " Seven";
		$this->words["8"] = " Eight";
		$this->words["9"] = " Nine";
		$this->words["10"] = " Ten";
		$this->words["11"] = " Eleven";
		$this->words["12"] = " Twelve";
		$this->words["13"] = " Thirteen";
		$this->words["14"] = " Fourteen";
		$this->words["15"] = " Fifteen";
		$this->words["16"] = " Sixteen";
		$this->words["17"] = " Seventeen";
		$this->words["18"] = " Eighteen";
		$this->words["19"] = " Nineteen";
		$this->words["20"] = " Twenty";
		$this->words["30"] = " Thirty";
		$this->words["40"] = " Fourty";
		$this->words["50"] = " Fifty";
		$this->words["60"] = " Sixty";
		$this->words["70"] = " Seventy";
		$this->words["80"] = " Eighty";
		$this->words["90"] = " Ninety";
		
		
		$this->places["1"] = " Thousand";
		$this->places["2"] = " Lak";
		$this->places["3"] = " Crore";
	}
}

?>