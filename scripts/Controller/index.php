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

	require_once("../debuglib.php");
	require_once("../Model/ReversiPlay.php");

	// *** PHP 警告表示 OFF *** //
//	ini_set( "display_errors", "Off");
        ini_set( "display_errors", "On");
	// *** 内部文字エンコーディングを *** //
	// *** UTF-8 で統一する *** //
	mb_internal_encoding('UTF-8');
	mb_regex_encoding('UTF-8');

	$reversiPlay = NULL;
	if(!isset($_SESSION)){
		session_start();
	}
	if(!isset($_SESSION['ReversiPlay'])){
		// *** 初めてのアクセス *** //
		$reversiPlay = new ReversiPlay();
		$_SESSION['ReversiPlay'] = $reversiPlay;
	}else{
		$reversiPlay = $_SESSION['ReversiPlay'];
		if($reversiPlay == NULL){
			$reversiPlay = new ReversiPlay();
			$_SESSION['ReversiPlay'] = $reversiPlay;
		}
	}

	$callbacks = array();
	// *** コールバック登録 *** //
	$callback1 = function($title , $msg){
		global $callbacks;
		$callbacks['funcs'][] = array("func" => "ViewMsgDlg","param1" => $title,"param2" => $msg);
	};
	$delegate1 = new Delegate();
	$delegate1->add($callback1);
	$reversiPlay->setViewMsgDlg($delegate1);

	$callback2 = function($y, $x, $sts, $bk, $text){
		global $callbacks;
		$callbacks['funcs'][] = array("func" => "DrawSingle","param1" => $y,"param2" => $x,"param3" => $sts,"param4" => $bk,"param5" => $text);
	};
	$delegate2 = new Delegate();
	$delegate2->add($callback2);
	$reversiPlay->setDrawSingle($delegate2);

	$callback3 = function($text){
		global $callbacks;
		$callbacks['funcs'][] = array("func" => "CurColMsg","param1" => $text);
	};
	$delegate3 = new Delegate();
	$delegate3->add($callback3);
	$reversiPlay->setCurColMsg($delegate3);

	$callback4 = function($text){
		global $callbacks;
		$callbacks['funcs'][] = array("func" => "CurStsMsg","param1" => $text);
	};
	$delegate4 = new Delegate();
	$delegate4->add($callback4);
	$reversiPlay->setCurStsMsg($delegate4);

	$callback5 = function($time){
		global $callbacks;
		$callbacks['funcs'][] = array("func" => "Wait","param1" => $time);
	};
	$delegate5 = new Delegate();
	$delegate5->add($callback5);
	$reversiPlay->setWait($delegate5);

	$_SESSION['ReversiPlay'] = $reversiPlay;

	////////////////////////////////////////////////////////////////////////////////
	// メソッドパラメータ取得と分岐
	////////////////////////////////////////////////////////////////////////////////
	$param_func = "";
	if(isset($_POST["func"]))				$param_func = $_POST["func"];
	else									return_error('parameter error!');

	if($param_func == 'setSetting')			setSetting($reversiPlay);
	else if($param_func == 'reset')			reset2($reversiPlay);
	else if($param_func == 'reversiPlay')	reversiPlay($reversiPlay);
	else									return_error('func 指定が不正です。 '. $param_func);

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
			header('Access-Control-Allow-Origin: null');
			header('Access-Control-Allow-Credentials: true');
			header('Content-Type: application/json');
			echo json_encode($result);
		}
		session_write_close();
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
	///	@fn				setSetting($reversiPlay)
	///	@param[in]		$reversiPlay
	///	@return			実行結果json
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	function setSetting($reversiPlay)
	{
		// *** メソッド用パラメータ確認 *** //
		if(isset($_POST["para"]))	$param_data = $_POST["para"];
		else						return_json('パラメータが不正です。');
		$AjUtilObj = new CAjaxUtility();
		$AjUtilObj->setmreversiPlay($reversiPlay);
		$res = $AjUtilObj->setSetting($param_data);
		return_json($res);
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			リセット
	///	@fn				reset2($reversiPlay)
	///	@param[in]		$reversiPlay
	///	@return			実行結果json
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	function reset2($reversiPlay)
	{
		$AjUtilObj = new CAjaxUtility();
		$AjUtilObj->setmreversiPlay($reversiPlay);
		$res = $AjUtilObj->reset();
		return_json($res);
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			リバーシプレイ
	///	@fn				reversiPlay($reversiPlay)
	///	@param[in]		$reversiPlay
	///	@return			実行結果json
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	function reversiPlay($reversiPlay)
	{
		// *** メソッド用パラメータ確認 *** //
		if(isset($_POST["y"]))	$param_y = $_POST["y"];
		else					return_json('パラメータが不正です。');
		if(isset($_POST["x"]))	$param_x = $_POST["x"];
		else					return_json('パラメータが不正です。');
		$AjUtilObj = new CAjaxUtility();
		$AjUtilObj->setmreversiPlay($reversiPlay);
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
		private $_mreversiPlay;												//!< マスの状態
		private $_mcallbacks;												//!< コールバック

		public function getmreversiPlay(){return $this->_mreversiPlay; }
		public function setmreversiPlay($_mreversiPlay){ $this->_mreversiPlay = $_mreversiPlay; }

		public function getmcallbacks(){return $this->_mcallbacks; }
		public function setmcallbacks($_mcallbacks){ $this->_mcallbacks = $_mcallbacks; }

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
			global $callbacks;

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
			$settng->setmTheme($data['mTheme']);
			$settng->setmPlayerColor1($data['mPlayerColor1']);
			$settng->setmPlayerColor2($data['mPlayerColor2']);
			$settng->setmBackGroundColor($data['mBackGroundColor']);
			$settng->setmBorderColor($data['mBorderColor']);

			$callbacks = array();
			$this->_mreversiPlay->setmSetting($settng);
			$this->_mreversiPlay->reset();

			$_SESSION['ReversiPlay'] = $this->_mreversiPlay;
			$arr_result['auth'] = '[SUCCESS]';
			$arr_result['callbacks'] = $callbacks;

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
			global $callbacks;

			$callbacks = array();
			$this->_mreversiPlay->reset();

			$_SESSION['ReversiPlay'] = $this->_mreversiPlay;
			$arr_result['auth'] = '[SUCCESS]';
			$arr_result['callbacks'] = $callbacks;

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
			global $callbacks;

			$callbacks = array();
			$this->_mreversiPlay->reversiPlay($y,$x);

			$_SESSION['ReversiPlay'] = $this->_mreversiPlay;
			$arr_result['auth'] = '[SUCCESS]';
			$arr_result['callbacks'] = $callbacks;

			return($arr_result);
		}
	}

?>
