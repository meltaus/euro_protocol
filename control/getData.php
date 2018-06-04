<?php
include $_SERVER["DOCUMENT_ROOT"] . "/control/workDB.php";
		
function createDataForMailPage() {
/* Формат конечного массива $totalResult:
[iterInProtocolTable]  [protocol.id,
						protocol.time_register, 
						polis.serial_polis + polis.number_polis, 
						polis.serial_polis_memver + polis.number_polis_member, 
						protocol.time_inspection]
						

*/
		$workDB = new workDB();
	
		$result = array();
		$totalResult = array();

        $columnName = array("id", "time_register", "id_number_polis", "id_number_polis_member","time_inspection");		
        $arrayInProtocolTable = $workDB->selectDataTableOrderBy("protocol", $columnName, "time_register");
//		echo json_encode($arrayInProtocolTable);

        $columnName = array("id", "serial_polis", "number_polis");		
        $arrayInPolisTable = $workDB->selectUniqueDataTable("polis", $columnName);
//		echo json_encode($arrayInPolisTable);
		
        $iterInProtocolTable = count($arrayInProtocolTable);
		
        $iterInPolisTable = count($arrayInPolisTable);
		
		
        for ($i = 0; $i < $iterInProtocolTable; $i++) {
			array_push($result, $arrayInProtocolTable[$i][0]);
			array_push($result, $arrayInProtocolTable[$i][1]); 
			
			for ($j = 0; $j < $iterInPolisTable; $j++) {
				if ($arrayInPolisTable[$j][0] == $arrayInProtocolTable[$i][2])
					array_push($result, $arrayInPolisTable[$j][1] . $arrayInPolisTable[$j][2]);	
			}

			for ($j = 0; $j < $iterInPolisTable; $j++) {
				if ($arrayInPolisTable[$j][0] == $arrayInProtocolTable[$i][3])
					array_push($result, $arrayInPolisTable[$j][1] . $arrayInPolisTable[$j][2]);	
			}
			array_push($result, $arrayInProtocolTable[$i][4]);
			
			array_push($totalResult, $result);
			$result = [];
        }
		unset($workDB);
		return $totalResult;
	}
	
?>