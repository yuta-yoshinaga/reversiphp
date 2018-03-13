<?php

////////////////////////////////////////////////////////////////////////////////
///	@file			index.php
///	@brief			コントローラー
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

	// *** PHP 警告表示 OFF *** //
	ini_set( "display_errors", "Off");
	// *** 内部文字エンコーディングを *** //
	// *** UTF-8 で統一する *** //
	mb_internal_encoding('UTF-8');
	mb_regex_encoding('UTF-8');

	$reversiPlay = NULL;
	if(!isset($_SESSION)) session_start();
	if(!isset($_SESSION['ReversiPlay'])){
		// *** 初めてのアクセス *** //
		$reversiPlay = new ReversiPlay();
		$_SESSION['ReversiPlay'] = $reversiPlay;
	}else{
		$reversiPlay = $_SESSION['ReversiPlay'];
	}

	////////////////////////////////////////////////////////////////////////////////
	// メソッドパラメータ取得と分岐
	////////////////////////////////////////////////////////////////////////////////
	if(isset($_POST["func"]))				$param_func = $_POST["func"];
	else									return_error('parameter error!');

	if($param_func == 'setSetting')			setSetting();
	else if($param_func == 'reset')			reset();
	else if($param_func == 'reversiPlay')	reversiPlay();
	else									return_error('func 指定が不正です。');

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			JSON 形式出力関数
	///	@fn				return_json($result)
	///	@param[in]		$result
	///	@return			実行結果json
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	function return_json($result){
		if(isset($_POST["aj_debug"]))
			print_a($result);
		else{
			header('Content-Type: application/json');
			echo json_encode($result);
		}
		exit;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			エラー
	///	@fn				return_error()
	///	@return			実行結果json
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	function return_error($result){
		echo($result);
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			Ajax出力
	///	@fn				print_ajax()
	///	@return			実行結果json
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	function print_ajax($msg){
		if(isset($_POST["aj_debug"])) print_a($msg);
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			設定反映
	///	@fn				setSetting()
	///	@return			実行結果json
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	function setSetting()
	{
		// *** メソッド用パラメータ確認 *** //
		if(isset($_POST["data"]))		$param_data = $_POST["data"];
		else							return_json('パラメータが不正です。');
		$AjUtilObj = new CAjaxUtility();
		$res = $AjUtilObj->setSetting(json_decode($param_data));
		return_json($res);
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			リセット
	///	@fn				reset()
	///	@return			実行結果json
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	function reset()
	{
		$AjUtilObj = new CAjaxUtility();
		$res = $AjUtilObj->reset();
		return_json($res);
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			リバーシプレイ
	///	@fn				reversiPlay()
	///	@return			実行結果json
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	function reversiPlay()
	{
		// *** メソッド用パラメータ確認 *** //
		if(isset($_POST["y"]))			$param_y = $_POST["y"];
		else							return_json('パラメータが不正です。');
		if(isset($_POST["x"]))			$param_x = $_POST["x"];
		else							return_json('パラメータが不正です。');
		$AjUtilObj = new CAjaxUtility();
		$res = $AjUtilObj->reversiPlay($param_y,$param_x);
		return_json($res);
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@class		CAjaxUtility
	///	@brief		AjaxUtlityクラス
	///
	////////////////////////////////////////////////////////////////////////////////
	class CAjaxUtility
	{
		////////////////////////////////////////////////////////////////////////////////
		///	@brief			コンストラクタ
		///	@fn				__construct()
		///	@return			ありません
		///	@author			Yuta Yoshinaga
		///	@date			2018.03.02
		///
		////////////////////////////////////////////////////////////////////////////////
		function __construct(){}

		////////////////////////////////////////////////////////////////////////////////
		///	@brief			デストラクタ
		///	@fn				__destruct()
		///	@return			ありません
		///	@author			Yuta Yoshinaga
		///	@date			2018.03.02
		///
		////////////////////////////////////////////////////////////////////////////////
		function __destruct(){}

		////////////////////////////////////////////////////////////////////////////////
		///	@brief			Ajaxテスト
		///	@fn				test()
		///	@return			ありません
		///	@author			Yuta Yoshinaga
		///	@date			2018.03.02
		///
		////////////////////////////////////////////////////////////////////////////////
		public function test(){print_ajax($_POST);}

		////////////////////////////////////////////////////////////////////////////////
		///	@brief			設定反映
		///	@fn				setSetting($data)
		///	@param[in]		$data		設定データ(連想配列形式)
		///	@return			実行結果json
		///	@author			Yuta Yoshinaga
		///	@date			2018.03.02
		///
		////////////////////////////////////////////////////////////////////////////////
		public function setSetting($data)
		{
			$settng = new ReversiSetting();
			$settng->setmMode($data['mMode']);
			$settng->setmType($data['mType']);
			$settng->setmPlayer($data['mPlayer']);
			$settng->setmAssist($data['mAssist']);
			$settng->setmGameSpd($data['mGameSpd']);
			$settng->setmEndAnim($data['mEndAnim']);
			$settng->setmMasuCntMenu($data['mMasuCntMenu']);
			$settng->setmMasuCnt($data['mMasuCnt']);
			$settng->setmPlayCpuInterVal($data['mPlayCpuInterVal']);
			$settng->setmPlayDrawInterVal($data['mPlayDrawInterVal']);
			$settng->setmEndDrawInterVal($data['mEndDrawInterVal']);
			$settng->setmEndInterVal($data['mEndInterVal']);
			$settng->setmPlayerColor1($data['mPlayerColor1']);
			$settng->setmPlayerColor2($data['mPlayerColor2']);
			$settng->setmBackGroundColor($data['mBackGroundColor']);
			$settng->setmBorderColor($data['mBorderColor']);
			$reversiPlay->setmSetting($settng);
			$reversiPlay->reset();
			$_SESSION['ReversiPlay'] = $reversiPlay;
			$arr_result['auth'] = '[SUCCESS]';
			return($arr_result);
		}

		////////////////////////////////////////////////////////////////////////////////
		///	@brief			リセット
		///	@fn				reset()
		///	@return			実行結果json
		///	@author			Yuta Yoshinaga
		///	@date			2018.03.02
		///
		////////////////////////////////////////////////////////////////////////////////
		public function reset()
		{
			$reversiPlay->reset();
			$_SESSION['ReversiPlay'] = $reversiPlay;
			$arr_result['auth'] = '[SUCCESS]';
			return($arr_result);
		}

		////////////////////////////////////////////////////////////////////////////////
		///	@brief			リバーシプレイ
		///	@fn				reversiPlay($y,$x)
		///	@param[in]		$y			$y座標
		///	@param[in]		$x			$x座標
		///	@return			実行結果json
		///	@author			Yuta Yoshinaga
		///	@date			2018.03.02
		///
		////////////////////////////////////////////////////////////////////////////////
		public function reversiPlay($y,$x)
		{
			$reversiPlay->reversiPlay($y,$x);
			$_SESSION['ReversiPlay'] = $reversiPlay;
			$arr_result['auth'] = '[SUCCESS]';
			return($arr_result);
		}
	}

?>
