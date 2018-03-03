<?php

////////////////////////////////////////////////////////////////////////////////
///	@file			TestReversiHistory.php
///	@brief			リバーシ履歴クラステストドライバー
///	@author			Yuta Yoshinaga
///	@date			2018.03.02
///	$Version:		$
///	$Revision:		$
///
/// Copyright (c) 2018 Yuta Yoshinaga. All Rights reserved.
///
/// - 本ソフトウェアの一部又は全てを無断で複写複製（コピー）することは、
///   著作権侵害にあたりますので、これを禁止します。
/// - 本製品の使用に起因する侵害または特許権その他権利の侵害に関しては
///   当社は一切その責任を負いません。
///
////////////////////////////////////////////////////////////////////////////////

require_once("../Model/ReversiHistory.php");

////////////////////////////////////////////////////////////////////////////////
///	@class		TestReversiHistory
///	@brief		リバーシ履歴クラステストドライバー
///
////////////////////////////////////////////////////////////////////////////////
class TestReversiHistory
{
	////////////////////////////////////////////////////////////////////////////////
	///	@brief			コンストラクタ
	///	@fn				__construct()
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function __construct()
	{
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			デストラクタ
	///	@fn				__destruct()
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function __destruct()
	{
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			テスト実行
	///	@fn				test_run()
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function test_run()
	{
		$curCnt = 0;
		$allCnt = 0;
		$testVar = 1;
		$testVarStr = "TEST";

		// *** TEST CASE 1 *** //
		$testObj = new ReversiHistory();$allCnt++;
		echo "[ReversiHistory] Start\n";
		echo "**************************\n";
		if($testObj != NULL){
			echo " - [OK] Class new SUCCESS\n";$curCnt++;
			// *** getter/setter TEST *** //
			// *** TEST CASE 2 *** //
			$var = $testObj->getPoint();$allCnt++;
			if($var != NULL){			echo " - [OK] getPoint() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] getPoint() FAILUR ". $var. "\n";
			// *** TEST CASE 3 *** //
			$testObj->setPoint($var);$allCnt++;
			$var = $testObj->getPoint();
			if($var != NULL){			echo " - [OK] setPoint() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] setPoint() FAILUR ". $var. "\n";
			// *** TEST CASE 4 *** //
			$var = $testObj->getColor();$allCnt++;
			if($var == -1){				echo " - [OK] getColor() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] getColor() FAILUR ". $var. "\n";
			// *** TEST CASE 5 *** //
			$testObj->setColor($testVar);$allCnt++;
			$var = $testObj->getColor();
			if($var == $testVar){		echo " - [OK] setColor() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] setColor() FAILUR ". $var. "\n";
			// *** Method TEST *** //
			// *** TEST CASE 6 *** //
			$testObj->reset();$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$var = $testObj->getPoint();$execCnt++;
			if($var->getx() == -1){		$cmpCnt++;}
			$execCnt++;
			if($var->gety() == -1){		$cmpCnt++;}
			$var = $testObj->getColor();$execCnt++;
			if($var == -1){				$cmpCnt++;}
			if($execCnt == $cmpCnt){	echo " - [OK] reset() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] reset() FAILUR \n";
		}else{
			echo " - [Error] Class Create FAILUR\n";
		}
		echo "**************************\n";
		$result = "FAILUR";
		if($curCnt == $allCnt) $result = "SUCCESS";
		echo "[ReversiHistory] End $curCnt / $allCnt ". $result. "\n\n";
	}
}

?>
