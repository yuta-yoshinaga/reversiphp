<?php

////////////////////////////////////////////////////////////////////////////////
///	@file			TestReversi.php
///	@brief			アプリ設定クラステストドライバー
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

require_once("../Model/Reversi.php");

////////////////////////////////////////////////////////////////////////////////
///	@class		TestReversi
///	@brief		アプリ設定クラステストドライバー
///
////////////////////////////////////////////////////////////////////////////////
class TestReversi
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
		$testObj = new Reversi(ReversiConst::$DEF_MASU_CNT_MAX_VAL,ReversiConst::$DEF_MASU_CNT_MAX_VAL);$allCnt++;
		echo "[TestReversi] Start\n";
		echo "**************************\n";
		if($testObj != NULL){
			echo " - [OK] Class new SUCCESS\n";$curCnt++;
			// *** getter/setter TEST *** //
			// *** TEST CASE 2 *** //
			$var = $testObj->getmMasuSts();$allCnt++;
			if($var != NULL){									echo " - [OK] getmMasuSts() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmMasuSts() FAILUR ". $var. "\n";
			// *** TEST CASE 3 *** //
			$oldVar = $var;
			$testObj->setmMasuSts($oldVar);$allCnt++;
			$var = $testObj->getmMasuSts();
			if($var == $oldVar){								echo " - [OK] setmMasuSts() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmMasuSts() FAILUR ". $var. "\n";
			// *** TEST CASE 4 *** //
			$var = $testObj->getmMasuStsOld();$allCnt++;
			if($var != NULL){									echo " - [OK] getmMasuStsOld() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmMasuStsOld() FAILUR ". $var. "\n";
			// *** TEST CASE 5 *** //
			$oldVar = $var;
			$testObj->setmMasuStsOld($oldVar);$allCnt++;
			$var = $testObj->getmMasuStsOld();
			if($var == $oldVar){								echo " - [OK] setmMasuStsOld() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmMasuStsOld() FAILUR ". $var. "\n";
			// *** TEST CASE 6 *** //
			$var = $testObj->getmMasuStsEnaB();$allCnt++;
			if($var != NULL){									echo " - [OK] getmMasuStsEnaB() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmMasuStsEnaB() FAILUR ". $var. "\n";
			// *** TEST CASE 7 *** //
			$oldVar = $var;
			$testObj->setmMasuStsEnaB($oldVar);$allCnt++;
			$var = $testObj->getmMasuStsEnaB();
			if($var == $oldVar){								echo " - [OK] setmMasuStsEnaB() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmMasuStsEnaB() FAILUR ". $var. "\n";
			// *** TEST CASE 8 *** //
			$var = $testObj->getmMasuStsCntB();$allCnt++;
			if($var != NULL){									echo " - [OK] getmMasuStsCntB() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmMasuStsCntB() FAILUR ". $var. "\n";
			// *** TEST CASE 9 *** //
			$oldVar = $var;
			$testObj->setmMasuStsCntB($oldVar);$allCnt++;
			$var = $testObj->getmMasuStsCntB();
			if($var == $oldVar){								echo " - [OK] setmMasuStsCntB() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmMasuStsCntB() FAILUR ". $var. "\n";
			// *** TEST CASE 10 *** //
			$var = $testObj->getmMasuStsPassB();$allCnt++;
			if($var != NULL){									echo " - [OK] getmMasuStsPassB() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmMasuStsPassB() FAILUR ". $var. "\n";
			// *** TEST CASE 11 *** //
			$oldVar = $var;
			$testObj->setmMasuStsPassB($oldVar);$allCnt++;
			$var = $testObj->getmMasuStsPassB();
			if($var == $oldVar){								echo " - [OK] setmMasuStsPassB() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmMasuStsPassB() FAILUR ". $var. "\n";
			// *** TEST CASE 12 *** //
			$var = $testObj->getmMasuStsAnzB();$allCnt++;
			if($var != NULL){									echo " - [OK] getmMasuStsAnzB() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmMasuStsAnzB() FAILUR ". $var. "\n";
			// *** TEST CASE 13 *** //
			$oldVar = $var;
			$testObj->setmMasuStsAnzB($oldVar);$allCnt++;
			$var = $testObj->getmMasuStsAnzB();
			if($var == $oldVar){								echo " - [OK] setmMasuStsAnzB() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmMasuStsAnzB() FAILUR ". $var. "\n";
			// *** TEST CASE 14 *** //
			$var = $testObj->getmMasuPointB();$allCnt++;
			if($var != NULL){									echo " - [OK] getmMasuPointB() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmMasuPointB() FAILUR ". $var. "\n";
			// *** TEST CASE 15 *** //
			$oldVar = $var;
			$testObj->setmMasuPointB($oldVar);$allCnt++;
			$var = $testObj->getmMasuPointB();
			if($var == $oldVar){								echo " - [OK] setmMasuPointB() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmMasuPointB() FAILUR ". $var. "\n";
			// *** TEST CASE 16 *** //
			$var = $testObj->getmMasuPointCntB();$allCnt++;
			if($var == 4){										echo " - [OK] getmMasuPointCntB() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmMasuPointCntB() FAILUR ". $var. "\n";
			// *** TEST CASE 17 *** //
			$testObj->setmMasuPointCntB($testVar);$allCnt++;
			$var = $testObj->getmMasuPointCntB();
			if($var == $testVar){								echo " - [OK] setmMasuPointCntB() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmMasuPointCntB() FAILUR ". $var. "\n";
			// *** TEST CASE 18 *** //
			$var = $testObj->getmMasuBetCntB();$allCnt++;
			if($var == 2){										echo " - [OK] getmMasuBetCntB() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmMasuBetCntB() FAILUR ". $var. "\n";
			// *** TEST CASE 19 *** //
			$testObj->setmMasuBetCntB($testVar);$allCnt++;
			$var = $testObj->getmMasuBetCntB();
			if($var == $testVar){								echo " - [OK] setmMasuBetCntB() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmMasuBetCntB() FAILUR ". $var. "\n";
			// *** TEST CASE 20 *** //
			$var = $testObj->getmMasuStsEnaW();$allCnt++;
			if($var != NULL){									echo " - [OK] getmMasuStsEnaW() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmMasuStsEnaW() FAILUR ". $var. "\n";
			// *** TEST CASE 21 *** //
			$oldVar = $var;
			$testObj->setmMasuStsEnaW($oldVar);$allCnt++;
			$var = $testObj->getmMasuStsEnaW();
			if($var == $oldVar){								echo " - [OK] setmMasuStsEnaW() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmMasuStsEnaW() FAILUR ". $var. "\n";
			// *** TEST CASE 22 *** //
			$var = $testObj->getmMasuStsCntW();$allCnt++;
			if($var != NULL){									echo " - [OK] getmMasuStsCntW() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmMasuStsCntW() FAILUR ". $var. "\n";
			// *** TEST CASE 23 *** //
			$oldVar = $var;
			$testObj->setmMasuStsCntW($oldVar);$allCnt++;
			$var = $testObj->getmMasuStsCntW();
			if($var == $oldVar){								echo " - [OK] setmMasuStsCntW() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmMasuStsCntW() FAILUR ". $var. "\n";
			// *** TEST CASE 24 *** //
			$var = $testObj->getmMasuStsPassW();$allCnt++;
			if($var != NULL){									echo " - [OK] getmMasuStsPassW() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmMasuStsPassW() FAILUR ". $var. "\n";
			// *** TEST CASE 25 *** //
			$oldVar = $var;
			$testObj->setmMasuStsPassW($oldVar);$allCnt++;
			$var = $testObj->getmMasuStsPassW();
			if($var == $oldVar){								echo " - [OK] setmMasuStsPassW() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmMasuStsPassW() FAILUR ". $var. "\n";
			// *** TEST CASE 26 *** //
			$var = $testObj->getmMasuStsAnzW();$allCnt++;
			if($var != NULL){									echo " - [OK] getmMasuStsAnzW() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmMasuStsAnzW() FAILUR ". $var. "\n";
			// *** TEST CASE 27 *** //
			$oldVar = $var;
			$testObj->setmMasuStsAnzW($oldVar);$allCnt++;
			$var = $testObj->getmMasuStsAnzW();
			if($var == $oldVar){								echo " - [OK] setmMasuStsAnzW() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmMasuStsAnzW() FAILUR ". $var. "\n";
			// *** TEST CASE 28 *** //
			$var = $testObj->getmMasuPointW();$allCnt++;
			if($var != NULL){									echo " - [OK] getmMasuPointW() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmMasuPointW() FAILUR ". $var. "\n";
			// *** TEST CASE 29 *** //
			$oldVar = $var;
			$testObj->setmMasuPointW($oldVar);$allCnt++;
			$var = $testObj->getmMasuPointW();
			if($var == $oldVar){								echo " - [OK] setmMasuPointW() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmMasuPointW() FAILUR ". $var. "\n";
			// *** TEST CASE 30 *** //
			$var = $testObj->getmMasuPointCntW();$allCnt++;
			if($var == 4){										echo " - [OK] getmMasuPointCntW() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmMasuPointCntW() FAILUR ". $var. "\n";
			// *** TEST CASE 31 *** //
			$testObj->setmMasuPointCntW($testVar);$allCnt++;
			$var = $testObj->getmMasuPointCntW();
			if($var == $testVar){								echo " - [OK] setmMasuPointCntW() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmMasuPointCntW() FAILUR ". $var. "\n";
			// *** TEST CASE 32 *** //
			$var = $testObj->getmMasuBetCntW();$allCnt++;
			if($var == 2){										echo " - [OK] getmMasuBetCntW() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmMasuBetCntW() FAILUR ". $var. "\n";
			// *** TEST CASE 33 *** //
			$testObj->setmMasuBetCntW($testVar);$allCnt++;
			$var = $testObj->getmMasuBetCntW();
			if($var == $testVar){								echo " - [OK] setmMasuBetCntW() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmMasuBetCntW() FAILUR ". $var. "\n";
			// *** TEST CASE 34 *** //
			$var = $testObj->getmMasuCnt();$allCnt++;
			if($var == ReversiConst::$DEF_MASU_CNT_MAX_VAL){	echo " - [OK] getmMasuCnt() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmMasuCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 35 *** //
			$testObj->setmMasuCnt($testVar);$allCnt++;
			$var = $testObj->getmMasuCnt();
			if($var == $testVar){								echo " - [OK] setmMasuCnt() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmMasuCnt() FAILUR ". $var. "\n";
			// *** TEST CASE 36 *** //
			$var = $testObj->getmMasuCntMax();$allCnt++;
			if($var == ReversiConst::$DEF_MASU_CNT_MAX_VAL){	echo " - [OK] getmMasuCntMax() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmMasuCntMax() FAILUR ". $var. "\n";
			// *** TEST CASE 37 *** //
			$testObj->setmMasuCntMax($testVar);$allCnt++;
			$var = $testObj->getmMasuCntMax();
			if($var == $testVar){								echo " - [OK] setmMasuCntMax() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmMasuCntMax() FAILUR ". $var. "\n";
			// *** TEST CASE 38 *** //
			$var = $testObj->getmMasuHistCur();$allCnt++;
			if($var == 0){										echo " - [OK] getmMasuHistCur() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmMasuHistCur() FAILUR ". $var. "\n";
			// *** TEST CASE 39 *** //
			$testObj->setmMasuHistCur($testVar);$allCnt++;
			$var = $testObj->getmMasuHistCur();
			if($var == $testVar){								echo " - [OK] setmMasuHistCur() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmMasuHistCur() FAILUR ". $var. "\n";
			// *** TEST CASE 40 *** //
			$var = $testObj->getmMasuHist();$allCnt++;
			if($var != NULL){									echo " - [OK] getmMasuHist() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmMasuHist() FAILUR ". $var. "\n";
			// *** TEST CASE 41 *** //
			$oldVar = $var;
			$testObj->setmMasuHist($oldVar);$allCnt++;
			$var = $testObj->getmMasuHist();
			if($var == $oldVar){								echo " - [OK] setmMasuHist() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmMasuHist() FAILUR ". $var. "\n";

			// *** Method TEST *** //
			// *** TEST CASE 42 *** //
			$testObj = new Reversi(ReversiConst::$DEF_MASU_CNT_MAX_VAL,ReversiConst::$DEF_MASU_CNT_MAX_VAL);
			$testObj->reset();$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;

			$localCnt = 0;
			$var = $testObj->getmMasuSts();$execCnt++;
			for ($i = 0; $i < $testObj->getmMasuCnt(); $i++) {
				for ($j = 0; $j < $testObj->getmMasuCnt(); $j++) {
					if($var[$i][$j] == ReversiConst::$REVERSI_STS_NONE) $localCnt++;
				}
			}
			if($localCnt == (($testObj->getmMasuCnt() * $testObj->getmMasuCnt()) - 4)){		$cmpCnt++;}

			$localCnt = 0;
			$var = $testObj->getmMasuStsPassB();$execCnt++;
			for ($i = 0; $i < $testObj->getmMasuCnt(); $i++) {
				for ($j = 0; $j < $testObj->getmMasuCnt(); $j++) {
					if($var[$i][$j] == 0) $localCnt++;
				}
			}
			if($localCnt == ($testObj->getmMasuCnt() * $testObj->getmMasuCnt())){			$cmpCnt++;}

			$localCnt = 0;
			$var = $testObj->getmMasuStsPassW();$execCnt++;
			for ($i = 0; $i < $testObj->getmMasuCnt(); $i++) {
				for ($j = 0; $j < $testObj->getmMasuCnt(); $j++) {
					if($var[$i][$j] == 0) $localCnt++;
				}
			}
			if($localCnt == ($testObj->getmMasuCnt() * $testObj->getmMasuCnt())){			$cmpCnt++;}

			$var = $testObj->getmMasuHistCur();$execCnt++;
			if($var == 0){																	$cmpCnt++;}

			$var = $testObj->getmMasuStsOld();$execCnt++;
			if($var == $testObj->getmMasuSts()){											$cmpCnt++;}

			if($execCnt == $cmpCnt){							echo " - [OK] reset() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] reset() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 43 *** //
			$testObj->AnalysisReversi(1,1);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			if($execCnt == $cmpCnt){							echo " - [OK] AnalysisReversi() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] AnalysisReversi() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 44 *** //
			$var = $testObj->getMasuSts(9,9);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			if($var == 1){																	$cmpCnt++;}
			if($execCnt == $cmpCnt){							echo " - [OK] getMasuSts() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getMasuSts() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 45 *** //
			$var = $testObj->getMasuStsOld(9,9);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			if($var == 1){																	$cmpCnt++;}
			if($execCnt == $cmpCnt){							echo " - [OK] getMasuStsOld() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getMasuStsOld() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 46 *** //
			$var = $testObj->getMasuStsEna(ReversiConst::$REVERSI_STS_WHITE,9,9);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			if($var != 1){																	$cmpCnt++;}
			if($execCnt == $cmpCnt){							echo " - [OK] getMasuStsEna() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getMasuStsEna() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 47 *** //
			$var = $testObj->getMasuStsCnt(ReversiConst::$REVERSI_STS_WHITE,9,9);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			if($var == 0){																	$cmpCnt++;}
			if($execCnt == $cmpCnt){							echo " - [OK] getMasuStsCnt() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getMasuStsCnt() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 48 *** //
			$var = $testObj->getColorEna(ReversiConst::$REVERSI_STS_WHITE);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			if($var == 0){																	$cmpCnt++;}
			if($execCnt == $cmpCnt){							echo " - [OK] getColorEna() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getColorEna() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 49 *** //
			$var = $testObj->getGameEndSts();$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			if($var == 0){																	$cmpCnt++;}
			if($execCnt == $cmpCnt){							echo " - [OK] getGameEndSts() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getGameEndSts() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 50 *** //
			$var = $testObj->setMasuSts(ReversiConst::$REVERSI_STS_WHITE,0,0);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			if($var == -1){																	$cmpCnt++;}
			if($execCnt == $cmpCnt){							echo " - [OK] setMasuSts() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setMasuSts() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 51 *** //
			$var = $testObj->setMasuStsForcibly(ReversiConst::$REVERSI_STS_WHITE,0,0);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			if($var == 0){																	$cmpCnt++;}
			if($execCnt == $cmpCnt){							echo " - [OK] setMasuStsForcibly() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setMasuStsForcibly() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 52 *** //
			$var = $testObj->setMasuCnt(ReversiConst::$DEF_MASU_CNT_18_VAL);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			if($var == 0){																	$cmpCnt++;}
			if($execCnt == $cmpCnt){							echo " - [OK] setMasuCnt() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setMasuCnt() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 53 *** //
			$var = $testObj->getPoint(ReversiConst::$REVERSI_STS_WHITE,0);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			if($var != NULL){																$cmpCnt++;}
			if($execCnt == $cmpCnt){							echo " - [OK] getPoint() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getPoint() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 54 *** //
			$var = $testObj->getPointCnt(ReversiConst::$REVERSI_STS_WHITE);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			if($var != 0){																	$cmpCnt++;}
			if($execCnt == $cmpCnt){							echo " - [OK] getPointCnt() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getPointCnt() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 55 *** //
			$var = $testObj->getBetCnt(ReversiConst::$REVERSI_STS_WHITE);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			if($var == 2){																	$cmpCnt++;}
			if($execCnt == $cmpCnt){							echo " - [OK] getBetCnt() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getBetCnt() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 56 *** //
			$var = $testObj->getPassEna(ReversiConst::$REVERSI_STS_WHITE,9,9);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			if($var == 0){																	$cmpCnt++;}
			if($execCnt == $cmpCnt){							echo " - [OK] getPassEna() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getPassEna() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 57 *** //
			$var = $testObj->getHistory(0);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			if($var != NULL){																$cmpCnt++;}
			if($execCnt == $cmpCnt){							echo " - [OK] getHistory() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getHistory() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 58 *** //
			$var = $testObj->getHistoryCnt();$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			if($var == 0){																	$cmpCnt++;}
			if($execCnt == $cmpCnt){							echo " - [OK] getHistoryCnt() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getHistoryCnt() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 59 *** //
			$var = $testObj->getPointAnz(ReversiConst::$REVERSI_STS_WHITE,9,9);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			if($var != NULL){																$cmpCnt++;}
			if($execCnt == $cmpCnt){							echo " - [OK] getPointAnz() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getPointAnz() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 60 *** //
			$var = $testObj->checkEdge(ReversiConst::$REVERSI_STS_WHITE,0,1);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			if($var == 0){																	$cmpCnt++;}
			if($execCnt == $cmpCnt){							echo " - [OK] checkEdge() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] checkEdge() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 61 *** //
			$var = $testObj->getEdgeSideZero(0,0);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			if($var == 0){																	$cmpCnt++;}
			if($execCnt == $cmpCnt){							echo " - [OK] getEdgeSideZero() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getEdgeSideZero() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 62 *** //
			$var = $testObj->getEdgeSideOne(0,1);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			if($var == 0){																	$cmpCnt++;}
			if($execCnt == $cmpCnt){							echo " - [OK] getEdgeSideOne() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getEdgeSideOne() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 63 *** //
			$var = $testObj->getEdgeSideTwo(0,2);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			if($var == 0){																	$cmpCnt++;}
			if($execCnt == $cmpCnt){							echo " - [OK] getEdgeSideTwo() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getEdgeSideTwo() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 64 *** //
			$var = $testObj->getEdgeSideThree(0,3);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			if($var == 0){																	$cmpCnt++;}
			if($execCnt == $cmpCnt){							echo " - [OK] getEdgeSideThree() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getEdgeSideThree() $cmpCnt / $execCnt FAILUR \n";

		}else{
			echo " - [Error] Class Create FAILUR\n";
		}
		echo "**************************\n";
		$result = "FAILUR";
		if($curCnt == $allCnt) $result = "SUCCESS";
		echo "[TestReversi] End $curCnt / $allCnt ". $result. "\n\n";
	}
}

?>
