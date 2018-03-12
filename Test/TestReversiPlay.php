<?php

////////////////////////////////////////////////////////////////////////////////
///	@file			TestReversiPlay.php
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

require_once("../Model/ReversiPlay.php");

////////////////////////////////////////////////////////////////////////////////
///	@class		TestReversiPlay
///	@brief		アプリ設定クラステストドライバー
///
////////////////////////////////////////////////////////////////////////////////
class TestReversiPlay
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
		$testObj = new ReversiPlay();$allCnt++;
		echo "[TestReversiPlay] Start\n";
		echo "**************************\n";
		if($testObj != NULL){
			echo " - [OK] Class new SUCCESS\n";$curCnt++;
			// *** getter/setter TEST *** //
			// *** TEST CASE 2 *** //
			$var = $testObj->getmReversi();$allCnt++;
			if($var != NULL){									echo " - [OK] getmReversi() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmReversi() FAILUR ". $var. "\n";
			// *** TEST CASE 3 *** //
			$oldVar = $var;
			$testObj->setmReversi($oldVar);$allCnt++;
			$var = $testObj->getmReversi();
			if($var == $oldVar){								echo " - [OK] setmReversi() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmReversi() FAILUR ". $var. "\n";

			// *** TEST CASE 4 *** //
			$var = $testObj->getmSetting();$allCnt++;
			if($var != NULL){									echo " - [OK] getmSetting() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmSetting() FAILUR ". $var. "\n";
			// *** TEST CASE 5 *** //
			$oldVar = $var;
			$testObj->setmSetting($oldVar);$allCnt++;
			$var = $testObj->getmSetting();
			if($var == $oldVar){								echo " - [OK] setmSetting() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmSetting() FAILUR ". $var. "\n";

			// *** TEST CASE 6 *** //
			$var = $testObj->getmCurColor();$allCnt++;
			if($var == 0){										echo " - [OK] getmCurColor() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmCurColor() FAILUR ". $var. "\n";
			// *** TEST CASE 7 *** //
			$testObj->setmCurColor($testVar);$allCnt++;
			$var = $testObj->getmCurColor();
			if($var == $testVar){								echo " - [OK] setmCurColor() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmCurColor() FAILUR ". $var. "\n";

			// *** TEST CASE 8 *** //
			$var = $testObj->getmCpu();$allCnt++;
			if($var != NULL){									echo " - [OK] getmCpu() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmCpu() FAILUR ". $var. "\n";
			// *** TEST CASE 9 *** //
			$oldVar = $var;
			$testObj->setmCpu($oldVar);$allCnt++;
			$var = $testObj->getmCpu();
			if($var == $oldVar){								echo " - [OK] setmCpu() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmCpu() FAILUR ". $var. "\n";

			// *** TEST CASE 10 *** //
			$var = $testObj->getmEdge();$allCnt++;
			if($var != NULL){									echo " - [OK] getmEdge() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmEdge() FAILUR ". $var. "\n";
			// *** TEST CASE 11 *** //
			$oldVar = $var;
			$testObj->setmEdge($oldVar);$allCnt++;
			$var = $testObj->getmEdge();
			if($var == $oldVar){								echo " - [OK] setmEdge() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmEdge() FAILUR ". $var. "\n";

			// *** TEST CASE 12 *** //
			$var = $testObj->getmPassEnaB();$allCnt++;
			if($var == 0){										echo " - [OK] getmPassEnaB() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmPassEnaB() FAILUR ". $var. "\n";
			// *** TEST CASE 13 *** //
			$testObj->setmPassEnaB($testVar);$allCnt++;
			$var = $testObj->getmPassEnaB();
			if($var == $testVar){								echo " - [OK] setmPassEnaB() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmPassEnaB() FAILUR ". $var. "\n";

			// *** TEST CASE 14 *** //
			$var = $testObj->getmPassEnaW();$allCnt++;
			if($var == 0){										echo " - [OK] getmPassEnaW() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmPassEnaW() FAILUR ". $var. "\n";
			// *** TEST CASE 15 *** //
			$testObj->setmPassEnaW($testVar);$allCnt++;
			$var = $testObj->getmPassEnaW();
			if($var == $testVar){								echo " - [OK] setmPassEnaW() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmPassEnaW() FAILUR ". $var. "\n";

			// *** TEST CASE 16 *** //
			$var = $testObj->getmGameEndSts();$allCnt++;
			if($var == 0){										echo " - [OK] getmGameEndSts() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmGameEndSts() FAILUR ". $var. "\n";
			// *** TEST CASE 17 *** //
			$testObj->setmGameEndSts($testVar);$allCnt++;
			$var = $testObj->getmGameEndSts();
			if($var == $testVar){								echo " - [OK] setmGameEndSts() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmGameEndSts() FAILUR ". $var. "\n";

			// *** TEST CASE 18 *** //
			$var = $testObj->getmPlayLock();$allCnt++;
			if($var == 0){										echo " - [OK] getmPlayLock() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmPlayLock() FAILUR ". $var. "\n";
			// *** TEST CASE 19 *** //
			$testObj->setmPlayLock($testVar);$allCnt++;
			$var = $testObj->getmPlayLock();
			if($var == $testVar){								echo " - [OK] setmPlayLock() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmPlayLock() FAILUR ". $var. "\n";

			// *** TEST CASE 20 *** //
			$var = $testObj->getViewMsgDlg();$allCnt++;
			if($var != NULL){									echo " - [OK] getViewMsgDlg() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getViewMsgDlg() FAILUR ". $var. "\n";
			// *** TEST CASE 21 *** //
			$oldVar = $var;
			$testObj->setViewMsgDlg($oldVar);$allCnt++;
			$var = $testObj->getViewMsgDlg();
			if($var == $oldVar){								echo " - [OK] setViewMsgDlg() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setViewMsgDlg() FAILUR ". $var. "\n";

			// *** TEST CASE 22 *** //
			$var = $testObj->getDrawSingle();$allCnt++;
			if($var != NULL){									echo " - [OK] getDrawSingle() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getDrawSingle() FAILUR ". $var. "\n";
			// *** TEST CASE 23 *** //
			$oldVar = $var;
			$testObj->setDrawSingle($oldVar);$allCnt++;
			$var = $testObj->getDrawSingle();
			if($var == $oldVar){								echo " - [OK] setDrawSingle() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setDrawSingle() FAILUR ". $var. "\n";

			// *** TEST CASE 24 *** //
			$var = $testObj->getCurColMsg();$allCnt++;
			if($var != NULL){									echo " - [OK] getCurColMsg() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getCurColMsg() FAILUR ". $var. "\n";
			// *** TEST CASE 25 *** //
			$oldVar = $var;
			$testObj->setCurColMsg($oldVar);$allCnt++;
			$var = $testObj->getCurColMsg();
			if($var == $oldVar){								echo " - [OK] setCurColMsg() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setCurColMsg() FAILUR ". $var. "\n";

			// *** TEST CASE 26 *** //
			$var = $testObj->getCurStsMsg();$allCnt++;
			if($var != NULL){									echo " - [OK] getCurStsMsg() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getCurStsMsg() FAILUR ". $var. "\n";
			// *** TEST CASE 27 *** //
			$oldVar = $var;
			$testObj->setCurStsMsg($oldVar);$allCnt++;
			$var = $testObj->getCurStsMsg();
			if($var == $oldVar){								echo " - [OK] setCurStsMsg() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setCurStsMsg() FAILUR ". $var. "\n";

			// *** Method TEST *** //
			$testObj = new ReversiPlay();

			$callback1 = function($title , $msg) {
			    echo "ViewMsgDlg : ". $title. " ". $msg;
			};
			$testObj->getViewMsgDlg()->add($callback1);

			$callback2 = function($y, $x, $sts, $bk, $text) {
			    echo "DrawSingle : ". $y. " ". $x. " ". $sts. " ". $bk. " ". $text;
			};
			$testObj->getDrawSingle()->add($callback2);

			$callback3 = function($text) {
			    echo "CurColMsg : ". $text;
			};
			$testObj->getCurColMsg()->add($callback3);

			$callback4 = function($text) {
			    echo "CurStsMsg : ". $text;
			};
			$testObj->getCurStsMsg()->add($callback4);

			// *** TEST CASE 28 *** //
			$testObj->reversiPlay(0,0);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			$cmpCnt++;
			if($execCnt == $cmpCnt){							echo " - [OK] reversiPlay() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] reversiPlay() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 29 *** //
			$testObj->reversiPlayEnd();$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			$cmpCnt++;
			if($execCnt == $cmpCnt){							echo " - [OK] reversiPlayEnd() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] reversiPlayEnd() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 30 *** //
			$testObj->reversiPlayPass(ReversiConst::$REVERSI_STS_BLACK);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			$cmpCnt++;
			if($execCnt == $cmpCnt){							echo " - [OK] reversiPlayPass() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] reversiPlayPass() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 31 *** //
			$testObj->drawUpdate(ReversiConst::$DEF_ASSIST_ON);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			$cmpCnt++;
			if($execCnt == $cmpCnt){							echo " - [OK] drawUpdate() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] drawUpdate() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 32 *** //
			$testObj->drawUpdateForcibly(ReversiConst::$DEF_ASSIST_ON);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			$cmpCnt++;
			if($execCnt == $cmpCnt){							echo " - [OK] drawUpdateForcibly() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] drawUpdateForcibly() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 33 *** //
			$testObj->reset();$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			$cmpCnt++;
			if($execCnt == $cmpCnt){							echo " - [OK] reset() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] reset() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 34 *** //
			$testObj->gameEndAnimExec();$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			$cmpCnt++;
			if($execCnt == $cmpCnt){							echo " - [OK] gameEndAnimExec() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] gameEndAnimExec() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 35 *** //
			$testObj->sendDrawMsg(0,0);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			$cmpCnt++;
			if($execCnt == $cmpCnt){							echo " - [OK] sendDrawMsg() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] sendDrawMsg() $cmpCnt / $execCnt FAILUR \n";

			// *** TEST CASE 36 *** //
			$testObj->sendDrawInfoMsg(0,0);$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$execCnt++;
			$cmpCnt++;
			if($execCnt == $cmpCnt){							echo " - [OK] sendDrawInfoMsg() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] sendDrawInfoMsg() $cmpCnt / $execCnt FAILUR \n";

		}else{
			echo " - [Error] Class Create FAILUR\n";
		}
		echo "**************************\n";
		$result = "FAILUR";
		if($curCnt == $allCnt) $result = "SUCCESS";
		echo "[TestReversiPlay] End $curCnt / $allCnt ". $result. "\n\n";
	}
}

?>
