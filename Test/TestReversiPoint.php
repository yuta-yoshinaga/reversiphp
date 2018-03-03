<?php

////////////////////////////////////////////////////////////////////////////////
///	@file			TestReversiPoint.php
///	@brief			リバーシポイントクラステストドライバー
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

require_once("../Model/ReversiPoint.php");

////////////////////////////////////////////////////////////////////////////////
///	@class		TestReversiPoint
///	@brief		リバーシポイントクラステストドライバー
///
////////////////////////////////////////////////////////////////////////////////
class TestReversiPoint
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
		$testObj = new ReversiPoint();$allCnt++;
		echo "[TestReversiPoint] Start\n";
		echo "**************************\n";
		if($testObj != NULL){
			echo " - [OK] Class new SUCCESS\n";$curCnt++;
			// *** getter/setter TEST *** //
			// *** TEST CASE 2 *** //
			$var = $testObj->getx();$allCnt++;
			if($var == 0){			echo " - [OK] getx() SUCCESS\n";$curCnt++;}
			else					echo " - [Error] getx() FAILUR ". $var. "\n";
			// *** TEST CASE 3 *** //
			$testObj->setx($testVar);$allCnt++;
			$var = $testObj->getx();
			if($var == $testVar){	echo " - [OK] setx() SUCCESS\n";$curCnt++;}
			else					echo " - [Error] setx() FAILUR ". $var. "\n";
			// *** TEST CASE 4 *** //
			$var = $testObj->gety();$allCnt++;
			if($var == 0){			echo " - [OK] gety() SUCCESS\n";$curCnt++;}
			else					echo " - [Error] gety() FAILUR ". $var. "\n";
			// *** TEST CASE 5 *** //
			$testObj->sety($testVar);$allCnt++;
			$var = $testObj->gety();
			if($var == $testVar){	echo " - [OK] sety() SUCCESS\n";$curCnt++;}
			else					echo " - [Error] sety() FAILUR ". $var. "\n";
		}else{
			echo " - [Error] Class Create FAILUR\n";
		}
		echo "**************************\n";
		$result = "FAILUR";
		if($curCnt == $allCnt) $result = "SUCCESS";
		echo "[TestReversiPoint] End $curCnt / $allCnt ". $result. "\n\n";
	}
}

?>
