<?php

////////////////////////////////////////////////////////////////////////////////
///	@file			Test.php
///	@brief			テスト実行
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

require_once("TestReversiSetting.php");
$testObj1 = new TestReversiSetting();
$testObj1->test_run();
unset($testObj1);

require_once("TestReversiPoint.php");
$testObj1 = new TestReversiPoint();
$testObj1->test_run();

require_once("TestReversiHistory.php");
$testObj1 = new TestReversiHistory();
$testObj1->test_run();

require_once("TestReversiAnz.php");
$testObj1 = new TestReversiAnz();
$testObj1->test_run();

require_once("TestReversi.php");
$testObj1 = new TestReversi();
$testObj1->test_run();

?>
