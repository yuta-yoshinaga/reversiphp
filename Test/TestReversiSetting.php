<?php

////////////////////////////////////////////////////////////////////////////////
///	@file			TestReversiSetting.php
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

require_once("../Model/ReversiSetting.php");

////////////////////////////////////////////////////////////////////////////////
///	@class		TestReversiSetting
///	@brief		アプリ設定クラステストドライバー
///
////////////////////////////////////////////////////////////////////////////////
class TestReversiSetting
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
		$testVar = 0;
		$testVarStr = "TEST";

		// *** TEST CASE 1 *** //
		$testObj = new ReversiSetting();$allCnt++;
		echo "[TestReversiSetting] Start\n";
		echo "**************************\n";
		if($testObj != NULL){
			echo " - [OK] Class new SUCCESS\n";$curCnt++;
			// *** getter/setter TEST *** //
			// *** TEST CASE 2 *** //
			$var = $testObj->getmMode();$allCnt++;
			if($var == ReversiConst::$DEF_MODE_ONE){			echo " - [OK] getmMode() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmMode() FAILUR ". $var. "\n";
			// *** TEST CASE 3 *** //
			$testObj->setmMode($testVar);$allCnt++;
			$var = $testObj->getmMode();
			if($var == $testVar){								echo " - [OK] setmMode() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmMode() FAILUR ". $var. "\n";
			// *** TEST CASE 4 *** //
			$var = $testObj->getmType();$allCnt++;
			if($var == ReversiConst::$DEF_TYPE_HARD){			echo " - [OK] getmType() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmType() FAILUR ". $var. "\n";
			// *** TEST CASE 5 *** //
			$testObj->setmType($testVar);$allCnt++;
			$var = $testObj->getmType();
			if($var == $testVar){								echo " - [OK] setmType() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmType() FAILUR ". $var. "\n";
			// *** TEST CASE 6 *** //
			$var = $testObj->getmPlayer();$allCnt++;
			if($var == ReversiConst::$REVERSI_STS_BLACK){		echo " - [OK] getmPlayer() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmPlayer() FAILUR ". $var. "\n";
			// *** TEST CASE 7 *** //
			$testObj->setmPlayer($testVar);$allCnt++;
			$var = $testObj->getmPlayer();
			if($var == $testVar){								echo " - [OK] setmPlayer() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmPlayer() FAILUR ". $var. "\n";
			// *** TEST CASE 8 *** //
			$var = $testObj->getmAssist();$allCnt++;
			if($var == ReversiConst::$DEF_ASSIST_ON){			echo " - [OK] getmAssist() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmAssist() FAILUR ". $var. "\n";
			// *** TEST CASE 9 *** //
			$testObj->setmAssist($testVar);$allCnt++;
			$var = $testObj->getmAssist();
			if($var == $testVar){								echo " - [OK] setmAssist() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmAssist() FAILUR ". $var. "\n";
			// *** TEST CASE 10 *** //
			$var = $testObj->getmGameSpd();$allCnt++;
			if($var == ReversiConst::$DEF_GAME_SPD_MID){		echo " - [OK] getmGameSpd() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmGameSpd() FAILUR ". $var. "\n";
			// *** TEST CASE 11 *** //
			$testObj->setmGameSpd($testVar);$allCnt++;
			$var = $testObj->getmGameSpd();
			if($var == $testVar){								echo " - [OK] setmGameSpd() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmGameSpd() FAILUR ". $var. "\n";
			// *** TEST CASE 12 *** //
			$var = $testObj->getmEndAnim();$allCnt++;
			if($var == ReversiConst::$DEF_END_ANIM_ON){			echo " - [OK] getmEndAnim() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmEndAnim() FAILUR ". $var. "\n";
			// *** TEST CASE 13 *** //
			$testObj->setmEndAnim($testVar);$allCnt++;
			$var = $testObj->getmEndAnim();
			if($var == $testVar){								echo " - [OK] setmEndAnim() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmEndAnim() FAILUR ". $var. "\n";
			// *** TEST CASE 14 *** //
			$var = $testObj->getmMasuCntMenu();$allCnt++;
			if($var == ReversiConst::$DEF_MASU_CNT_8){			echo " - [OK] getmMasuCntMenu() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmMasuCntMenu() FAILUR ". $var. "\n";
			// *** TEST CASE 15 *** //
			$testObj->setmMasuCntMenu($testVar);$allCnt++;
			$var = $testObj->getmMasuCntMenu();
			if($var == $testVar){								echo " - [OK] setmMasuCntMenu() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmMasuCntMenu() FAILUR ". $var. "\n";
			// *** TEST CASE 16 *** //
			$var = $testObj->getmPlayCpuInterVal();$allCnt++;
			if($var == ReversiConst::$DEF_GAME_SPD_MID_VAL2){	echo " - [OK] getmPlayCpuInterVal() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmPlayCpuInterVal() FAILUR ". $var. "\n";
			// *** TEST CASE 17 *** //
			$testObj->setmPlayCpuInterVal($testVar);$allCnt++;
			$var = $testObj->getmPlayCpuInterVal();
			if($var == $testVar){								echo " - [OK] setmPlayCpuInterVal() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmPlayCpuInterVal() FAILUR ". $var. "\n";
			// *** TEST CASE 18 *** //
			$var = $testObj->getmPlayDrawInterVal();$allCnt++;
			if($var == ReversiConst::$DEF_GAME_SPD_MID_VAL){	echo " - [OK] getmPlayDrawInterVal() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmPlayDrawInterVal() FAILUR ". $var. "\n";
			// *** TEST CASE 19 *** //
			$testObj->setmPlayDrawInterVal($testVar);$allCnt++;
			$var = $testObj->getmPlayDrawInterVal();
			if($var == $testVar){								echo " - [OK] setmPlayDrawInterVal() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmPlayDrawInterVal() FAILUR ". $var. "\n";
			// *** TEST CASE 20 *** //
			$var = $testObj->getmEndDrawInterVal();$allCnt++;
			if($var == 100){									echo " - [OK] getmEndDrawInterVal() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmEndDrawInterVal() FAILUR ". $var. "\n";
			// *** TEST CASE 21 *** //
			$testObj->setmEndDrawInterVal($testVar);$allCnt++;
			$var = $testObj->getmEndDrawInterVal();
			if($var == $testVar){								echo " - [OK] setmEndDrawInterVal() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmEndDrawInterVal() FAILUR ". $var. "\n";
			// *** TEST CASE 22 *** //
			$var = $testObj->getmEndInterVal();$allCnt++;
			if($var == 500){									echo " - [OK] getmEndInterVal() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmEndInterVal() FAILUR ". $var. "\n";
			// *** TEST CASE 23 *** //
			$testObj->setmEndInterVal($testVar);$allCnt++;
			$var = $testObj->getmEndInterVal();
			if($var == $testVar){								echo " - [OK] setmEndInterVal() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmEndInterVal() FAILUR ". $var. "\n";
			// *** TEST CASE 24 *** //
			$var = $testObj->getmPlayerColor1();$allCnt++;
			if($var == "#FF0000"){								echo " - [OK] getmPlayerColor1() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmPlayerColor1() FAILUR ". $var. "\n";
			// *** TEST CASE 25 *** //
			$testObj->setmPlayerColor1($testVarStr);$allCnt++;
			$var = $testObj->getmPlayerColor1();
			if($var == $testVarStr){							echo " - [OK] setmPlayerColor1() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmPlayerColor1() FAILUR ". $var. "\n";
			// *** TEST CASE 26 *** //
			$var = $testObj->getmPlayerColor2();$allCnt++;
			if($var == "#FFFFFF"){								echo " - [OK] getmPlayerColor2() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmPlayerColor2() FAILUR ". $var. "\n";
			// *** TEST CASE 27 *** //
			$testObj->setmPlayerColor2($testVarStr);$allCnt++;
			$var = $testObj->getmPlayerColor2();
			if($var == $testVarStr){							echo " - [OK] setmPlayerColor2() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmPlayerColor2() FAILUR ". $var. "\n";
			// *** TEST CASE 28 *** //
			$var = $testObj->getmBackGroundColor();$allCnt++;
			if($var == "#FF00FF"){								echo " - [OK] getmBackGroundColor() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmBackGroundColor() FAILUR ". $var. "\n";
			// *** TEST CASE 29 *** //
			$testObj->setmBackGroundColor($testVarStr);$allCnt++;
			$var = $testObj->getmBackGroundColor();
			if($var == $testVarStr){							echo " - [OK] setmBackGroundColor() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmBackGroundColor() FAILUR ". $var. "\n";
			// *** TEST CASE 30 *** //
			$var = $testObj->getmBorderColor();$allCnt++;
			if($var == "#FF0000"){								echo " - [OK] getmBorderColor() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] getmBorderColor() FAILUR ". $var. "\n";
			// *** TEST CASE 31 *** //
			$testObj->setmBorderColor($testVarStr);$allCnt++;
			$var = $testObj->getmBorderColor();
			if($var == $testVarStr){							echo " - [OK] setmBorderColor() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] setmBorderColor() FAILUR ". $var. "\n";
			// *** Method TEST *** //
			// *** TEST CASE 32 *** //
			$testObj->reset();$allCnt++;
			$execCnt = 0;
			$cmpCnt = 0;
			$var = $testObj->getmMode();$execCnt++;
			if($var == ReversiConst::$DEF_MODE_ONE){			$cmpCnt++;}
			$var = $testObj->getmType();$execCnt++;
			if($var == ReversiConst::$DEF_TYPE_HARD){			$cmpCnt++;}
			$var = $testObj->getmPlayer();$execCnt++;
			if($var == ReversiConst::$REVERSI_STS_BLACK){		$cmpCnt++;}
			$var = $testObj->getmAssist();$execCnt++;
			if($var == ReversiConst::$DEF_ASSIST_ON){			$cmpCnt++;}
			$var = $testObj->getmGameSpd();$execCnt++;
			if($var == ReversiConst::$DEF_GAME_SPD_MID){		$cmpCnt++;}
			$var = $testObj->getmEndAnim();$execCnt++;
			if($var == ReversiConst::$DEF_END_ANIM_ON){			$cmpCnt++;}
			$var = $testObj->getmMasuCntMenu();$execCnt++;
			if($var == ReversiConst::$DEF_MASU_CNT_8){			$cmpCnt++;}
			$var = $testObj->getmPlayCpuInterVal();$execCnt++;
			if($var == ReversiConst::$DEF_GAME_SPD_MID_VAL2){	$cmpCnt++;}
			$var = $testObj->getmPlayDrawInterVal();$execCnt++;
			if($var == ReversiConst::$DEF_GAME_SPD_MID_VAL){	$cmpCnt++;}
			$var = $testObj->getmEndDrawInterVal();$execCnt++;
			if($var == 100){									$cmpCnt++;}
			$var = $testObj->getmEndInterVal();$execCnt++;
			if($var == 500){									$cmpCnt++;}
			$var = $testObj->getmPlayerColor1();$execCnt++;
			if($var == "#FF0000"){								$cmpCnt++;}
			$var = $testObj->getmPlayerColor2();$execCnt++;
			if($var == "#FFFFFF"){								$cmpCnt++;}
			$var = $testObj->getmBackGroundColor();$execCnt++;
			if($var == "#FF00FF"){								$cmpCnt++;}
			$var = $testObj->getmBorderColor();$execCnt++;
			if($var == "#FF0000"){								$cmpCnt++;}
			if($execCnt == $cmpCnt){							echo " - [OK] reset() SUCCESS\n";$curCnt++;}
			else												echo " - [Error] reset() $cmpCnt / $execCnt FAILUR \n";
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
