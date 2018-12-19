﻿<?php

require_once "../classes/Tasks.php";
require '../classes/ExpeditionInitiation.php';
require '../classes/ExpeditionEndTimeInfo.php';
require '../classes/ExpeditionAbort.php';
require '../classes/ExpeditionFinish.php';	
	
	class TaskExpedition extends Expeditions{

		public function initiateExpedition(){
			if(isset($_POST['zadanie'])){
				$expedition = new ExpeditionInitiation($_POST['zadanie']);
				$expedition->setNewCoinsAmount($_POST['zadanie']);
				$expedition->setExpeditionNumberTime($_POST['zadanie']);
			}
		}

		public function getExpeditionEndTime(){
			if(isset($_POST['zadanie']) || isset($_POST['czas']) && !isset($_SESSION['expedition_stopped'])){
				$ajaxJsonData = new ExpeditionEndTimeInfo();
				$ajaxJsonData = $ajaxJsonData->getEndTime();
				echo json_encode($ajaxJsonData);
				exit();
			}
		}

		public function stopExpedition(){	
			if(isset($_POST['stopExpedition'])){
				$abortExpedition = new ExpeditionAbort();
				$abortExpedition->stopExpedition();
				unset($_SESSION['expedition_stopped']);
				exit();
			}
		}
		
		public function showExpedtionInfo(){	
			$expeditionFinish = new ExpeditionFinish();
			return $expeditionArray = $expeditionFinish->showExpeditionDetails();
		}
	}
		



		
		
	

?>
