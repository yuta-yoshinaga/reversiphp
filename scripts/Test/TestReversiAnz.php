<?php

////////////////////////////////////////////////////////////////////////////////
///	@file			TestReversiAnz.php
///	@brief			リバーシ解析クラステストドライバー
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

require_once("../Model/ReversiAnz.php");

////////////////////////////////////////////////////////////////////////////////
///	@class		TestReversiAnz
///	@brief		リバーシ解析クラステストドライバー
///
////////////////////////////////////////////////////////////////////////////////
class TestReversiAnz
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
		$testObj = new ReversiAnz();$allCnt++;
		echo "[TestReversiAnz] Start\n";
		echo "**************************\n";
		if($testObj != NULL){
			echo " - [OK] Class new SUCCESS\n";$curCnt++;
			// *** getter/setter TEST *** //
			// *** TEST CASE 2 *** //
			$var = $testObj->getMin();$allCnt++;
			if($var == 0){				echo " - [OK] getMin() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] getMin() FAILUR ". $var. "\n";
			// *** TEST CASE 3 *** //
			$testObj->setMin($testVar);$allCnt++;
			$var = $testObj->getMin();
			if($var == $testVar){		echo " - [OK] setMin() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] setMin() FAILUR ". $var. "\n";
			// *** TEST CASE 4 *** //
			$var = $testObj->getMax();$allCnt++;
			if($var == 0){				echo " - [OK] getMax() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] getMax() FAILUR ". $var. "\n";
			// *** TEST CASE 5 *** //
			$testObj->setMax($testVar);$allCnt++;
			$var = $testObj->getMax();
			if($var == $testVar){		echo " - [OK] setMax() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] setMax() FAILUR ". $var. "\n";
			// *** TEST CASE 6 *** //
			$var = $testObj->getAvg();$allCnt++;
			if($var == 0.0){			echo " - [OK] getAvg() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] getAvg() FAILUR ". $var. "\n";
			// *** TEST CASE 7 *** //
			$testObj->setAvg($testVar);$allCnt++;
			$var = $testObj->getAvg();
			if($var == $testVar){		echo " - [OK] setAvg() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] setAvg() FAILUR ". $var. "\n";
			// *** TEST CASE 8 *** //
			$var = $testObj->getPointCnt();$allCnt++;
			if($var == 0){				echo " - [OK] getPointCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] getPointCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 9 *** //
			$testObj->setPointCnt($testVar);$allCnt++;
			$var = $testObj->getPointCnt();
			if($var == $testVar){		echo " - [OK] setPointCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] setPointCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 10 *** //
			$var = $testObj->getEdgeCnt();$allCnt++;
			if($var == 0){				echo " - [OK] getEdgeCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] getEdgeCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 11 *** //
			$testObj->setEdgeCnt($testVar);$allCnt++;
			$var = $testObj->getEdgeCnt();
			if($var == $testVar){		echo " - [OK] setEdgeCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] setEdgeCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 12 *** //
			$var = $testObj->getEdgeSideOneCnt();$allCnt++;
			if($var == 0){				echo " - [OK] getEdgeSideOneCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] getEdgeSideOneCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 13 *** //
			$testObj->setEdgeSideOneCnt($testVar);$allCnt++;
			$var = $testObj->getEdgeSideOneCnt();
			if($var == $testVar){		echo " - [OK] setEdgeSideOneCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] setEdgeSideOneCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 14 *** //
			$var = $testObj->getEdgeSideTwoCnt();$allCnt++;
			if($var == 0){				echo " - [OK] getEdgeSideTwoCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] getEdgeSideTwoCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 15 *** //
			$testObj->setEdgeSideTwoCnt($testVar);$allCnt++;
			$var = $testObj->getEdgeSideTwoCnt();
			if($var == $testVar){		echo " - [OK] setEdgeSideTwoCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] setEdgeSideTwoCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 16 *** //
			$var = $testObj->getEdgeSideThreeCnt();$allCnt++;
			if($var == 0){				echo " - [OK] getEdgeSideThreeCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] getEdgeSideThreeCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 17 *** //
			$testObj->setEdgeSideThreeCnt($testVar);$allCnt++;
			$var = $testObj->getEdgeSideThreeCnt();
			if($var == $testVar){		echo " - [OK] setEdgeSideThreeCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] setEdgeSideThreeCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 18 *** //
			$var = $testObj->getEdgeSideOtherCnt();$allCnt++;
			if($var == 0){				echo " - [OK] getEdgeSideOtherCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] getEdgeSideOtherCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 19 *** //
			$testObj->setEdgeSideOtherCnt($testVar);$allCnt++;
			$var = $testObj->getEdgeSideOtherCnt();
			if($var == $testVar){		echo " - [OK] setEdgeSideOtherCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] setEdgeSideOtherCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 20 *** //
			$var = $testObj->getOwnMin();$allCnt++;
			if($var == 0){				echo " - [OK] getOwnMin() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] getOwnMin() FAILUR ". $var. "\n";
			// *** TEST CASE 21 *** //
			$testObj->setOwnMin($testVar);$allCnt++;
			$var = $testObj->getOwnMin();
			if($var == $testVar){		echo " - [OK] setOwnMin() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] setOwnMin() FAILUR ". $var. "\n";
			// *** TEST CASE 22 *** //
			$var = $testObj->getOwnMax();$allCnt++;
			if($var == 0){				echo " - [OK] getOwnMax() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] getOwnMax() FAILUR ". $var. "\n";
			// *** TEST CASE 23 *** //
			$testObj->setOwnMax($testVar);$allCnt++;
			$var = $testObj->getOwnMax();
			if($var == $testVar){		echo " - [OK] setOwnMax() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] setOwnMax() FAILUR ". $var. "\n";
			// *** TEST CASE 24 *** //
			$var = $testObj->getOwnAvg();$allCnt++;
			if($var == 0.0){			echo " - [OK] getOwnAvg() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] getOwnAvg() FAILUR ". $var. "\n";
			// *** TEST CASE 25 *** //
			$testObj->setOwnAvg($testVar);$allCnt++;
			$var = $testObj->getOwnAvg();
			if($var == $testVar){		echo " - [OK] setOwnAvg() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] setOwnAvg() FAILUR ". $var. "\n";
			// *** TEST CASE 26 *** //
			$var = $testObj->getOwnPointCnt();$allCnt++;
			if($var == 0){				echo " - [OK] getOwnPointCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] getOwnPointCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 27 *** //
			$testObj->setOwnPointCnt($testVar);$allCnt++;
			$var = $testObj->getOwnPointCnt();
			if($var == $testVar){		echo " - [OK] setOwnPointCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] setOwnPointCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 28 *** //
			$var = $testObj->getOwnEdgeCnt();$allCnt++;
			if($var == 0){				echo " - [OK] getOwnEdgeCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] getOwnEdgeCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 29 *** //
			$testObj->setOwnEdgeCnt($testVar);$allCnt++;
			$var = $testObj->getOwnEdgeCnt();
			if($var == $testVar){		echo " - [OK] setOwnEdgeCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] setOwnEdgeCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 30 *** //
			$var = $testObj->getOwnEdgeSideOneCnt();$allCnt++;
			if($var == 0){				echo " - [OK] getOwnEdgeSideOneCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] getOwnEdgeSideOneCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 31 *** //
			$testObj->setOwnEdgeSideOneCnt($testVar);$allCnt++;
			$var = $testObj->getOwnEdgeSideOneCnt();
			if($var == $testVar){		echo " - [OK] setOwnEdgeSideOneCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] setOwnEdgeSideOneCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 32 *** //
			$var = $testObj->getOwnEdgeSideTwoCnt();$allCnt++;
			if($var == 0){				echo " - [OK] getOwnEdgeSideTwoCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] getOwnEdgeSideTwoCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 33 *** //
			$testObj->setOwnEdgeSideTwoCnt($testVar);$allCnt++;
			$var = $testObj->getOwnEdgeSideTwoCnt();
			if($var == $testVar){		echo " - [OK] setOwnEdgeSideTwoCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] setOwnEdgeSideTwoCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 34 *** //
			$var = $testObj->getOwnEdgeSideThreeCnt();$allCnt++;
			if($var == 0){				echo " - [OK] getOwnEdgeSideThreeCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] getOwnEdgeSideThreeCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 35 *** //
			$testObj->setOwnEdgeSideThreeCnt($testVar);$allCnt++;
			$var = $testObj->getOwnEdgeSideThreeCnt();
			if($var == $testVar){		echo " - [OK] setOwnEdgeSideThreeCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] setOwnEdgeSideThreeCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 36 *** //
			$var = $testObj->getOwnEdgeSideOtherCnt();$allCnt++;
			if($var == 0){				echo " - [OK] getOwnEdgeSideOtherCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] getOwnEdgeSideOtherCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 37 *** //
			$testObj->setOwnEdgeSideOtherCnt($testVar);$allCnt++;
			$var = $testObj->getOwnEdgeSideOtherCnt();
			if($var == $testVar){		echo " - [OK] setOwnEdgeSideOtherCnt() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] setOwnEdgeSideOtherCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 38 *** //
			$var = $testObj->getBadPoint();$allCnt++;
			if($var == 0){				echo " - [OK] getBadPoint() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] getBadPoint() FAILUR ". $var. "\n";
			// *** TEST CASE 39 *** //
			$testObj->setBadPoint($testVar);$allCnt++;
			$var = $testObj->getBadPoint();
			if($var == $testVar){		echo " - [OK] setBadPoint() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] setBadPoint() FAILUR ". $var. "\n";
			// *** TEST CASE 40 *** //
			$var = $testObj->getGoodPoint();$allCnt++;
			if($var == 0){				echo " - [OK] getGoodPoint() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] getGoodPoint() FAILUR ". $var. "\n";
			// *** TEST CASE 41 *** //
			$testObj->setGoodPoint($testVar);$allCnt++;
			$var = $testObj->getGoodPoint();
			if($var == $testVar){		echo " - [OK] setGoodPoint() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] setGoodPoint() FAILUR ". $var. "\n";

			// *** Method TEST *** //
			// *** TEST CASE 42 *** //
			$testObj->reset();$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$var = $testObj->getMin();$execCnt++;
			if($var == 0){		$cmpCnt++;}
			$var = $testObj->getMax();$execCnt++;
			if($var == 0){		$cmpCnt++;}
			$var = $testObj->getAvg();$execCnt++;
			if($var == 0.0){	$cmpCnt++;}
			$var = $testObj->getPointCnt();$execCnt++;
			if($var == 0){		$cmpCnt++;}
			$var = $testObj->getEdgeCnt();$execCnt++;
			if($var == 0){		$cmpCnt++;}
			$var = $testObj->getEdgeSideOneCnt();$execCnt++;
			if($var == 0){		$cmpCnt++;}
			$var = $testObj->getEdgeSideTwoCntEdgeSideOneCnt();$execCnt++;
			if($var == 0){		$cmpCnt++;}
			$var = $testObj->getEdgeSideThreeCnt();$execCnt++;
			if($var == 0){		$cmpCnt++;}
			$var = $testObj->getEdgeSideOtherCnt();$execCnt++;
			if($var == 0){		$cmpCnt++;}
			$var = $testObj->getOwnMin();$execCnt++;
			if($var == 0){		$cmpCnt++;}
			$var = $testObj->getOwnMax();$execCnt++;
			if($var == 0){		$cmpCnt++;}
			$var = $testObj->getOwnAvg();$execCnt++;
			if($var == 0.0){	$cmpCnt++;}
			$var = $testObj->getOwnPointCnt();$execCnt++;
			if($var == 0){		$cmpCnt++;}
			$var = $testObj->getOwnEdgeCnt();$execCnt++;
			if($var == 0){		$cmpCnt++;}
			$var = $testObj->getOwnEdgeSideOneCnt();$execCnt++;
			if($var == 0){		$cmpCnt++;}
			$var = $testObj->getOwnEdgeSideTwoCnt();$execCnt++;
			if($var == 0){		$cmpCnt++;}
			$var = $testObj->getOwnEdgeSideThreeCnt();$execCnt++;
			if($var == 0){		$cmpCnt++;}
			$var = $testObj->getOwnEdgeSideOtherCnt();$execCnt++;
			if($var == 0){		$cmpCnt++;}
			$var = $testObj->getBadPoint();$execCnt++;
			if($var == 0){		$cmpCnt++;}
			$var = $testObj->getGoodPoint();$execCnt++;
			if($var == 0){		$cmpCnt++;}
			if($execCnt == $cmpCnt){	echo " - [OK] reset() SUCCESS\n";$curCnt++;}
			else						echo " - [Error] reset() $cmpCnt / $execCnt FAILUR \n";
		}else{
			echo " - [Error] Class Create FAILUR\n";
		}
		echo "**************************\n";
		$result = "FAILUR";
		if($curCnt == $allCnt) $result = "SUCCESS";
		echo "[TestReversiAnz] End $curCnt / $allCnt ". $result. "\n\n";
	}
}

?>
