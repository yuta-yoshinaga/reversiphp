<?php

////////////////////////////////////////////////////////////////////////////////
///	@file			ReversiSetting.php
///	@brief			アプリ設定クラス
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

require_once("ReversiConst.php");

////////////////////////////////////////////////////////////////////////////////
///	@class		ReversiSetting
///	@brief		アプリ設定クラス
///
////////////////////////////////////////////////////////////////////////////////
public class ReversiSetting
{
	// #region メンバ変数
	private $_mMode				= ReversiConst::$DEF_MODE_ONE;					//!< 現在のモード
	private $_mType				= ReversiConst::$DEF_TYPE_HARD;					//!< 現在のタイプ
	private $_mPlayer			= ReversiConst::$REVERSI_STS_BLACK;				//!< プレイヤーの色
	private $_mAssist			= ReversiConst::$DEF_ASSIST_ON;					//!< アシスト
	private $_mGameSpd			= ReversiConst::$DEF_GAME_SPD_MID;				//!< ゲームスピード
	private $_mEndAnim			= ReversiConst::$DEF_END_ANIM_ON;				//!< ゲーム終了アニメーション
	private $_mMasuCntMenu		= ReversiConst::$DEF_MASU_CNT_8;				//!< マスの数
	private $_mMasuCnt			= ReversiConst::$DEF_MASU_CNT_8_VAL;			//!< マスの数
	private $_mPlayCpuInterVal	= ReversiConst::$DEF_GAME_SPD_MID_VAL2;			//!< CPU対戦時のインターバル(msec)
	private $_mPlayDrawInterVal	= ReversiConst::$DEF_GAME_SPD_MID_VAL;			//!< 描画のインターバル(msec)
	private $_mEndDrawInterVal	= 100;											//!< 終了アニメーション描画のインターバル(msec)
	private $_mEndInterVal		= 500;											//!< 終了アニメーションのインターバル(msec)
	private $_mPlayerColor1		= "#FF0000";									//!< プレイヤー1の色
	private $_mPlayerColor2		= "#FFFFFF";									//!< プレイヤー2の色
	private $_mBackGroundColor	= "#FF00FF";									//!< 背景の色
	private $_mBorderColor		= "#FF0000";									//!< 枠線の色
	// #endregion

	// #region プロパティ
	public function getmMode(){ return $this->_mMode; }
	public function setmMode($_mMode){ $this->_mMode = $_mMode; }

	public function getmType(){ return $this->_mType; }
	public function setmType($_mType){ $this->_mType = $_mType; }

	public function getmPlayer(){ return $this->_mPlayer; }
	public function setmPlayer($_mPlayer){ $this->_mPlayer = $_mPlayer; }

	public function getmAssist(){ return $this->_mAssist; }
	public function setmAssist($_mAssist){ $this->_mAssist = $_mAssist; }

	public function getmGameSpd(){ return $this->_mGameSpd; }
	public function setmGameSpd($_mAssist){ $this->_mGameSpd = $_mGameSpd; }

	public function getmEndAnim(){ return $this->_mEndAnim; }
	public function setmEndAnim($_mEndAnim){ $this->_mEndAnim = $_mEndAnim; }

	public function getmMasuCntMenu(){ return $this->_mMasuCntMenu; }
	public function setmMasuCntMenu($_mMasuCntMenu){ $this->_mMasuCntMenu = $_mMasuCntMenu; }

	public function getmMasuCnt(){ return $this->_mMasuCnt; }
	public function setmMasuCnt($_mMasuCnt){ $this->_mMasuCnt = $_mMasuCnt; }

	public function getmPlayCpuInterVal(){ return $this->_mPlayCpuInterVal; }
	public function setmPlayCpuInterVal($_mPlayCpuInterVal){ $this->_mPlayCpuInterVal = $_mPlayCpuInterVal; }

	public function getmPlayDrawInterVal(){ return $this->_mPlayDrawInterVal; }
	public function setmPlayDrawInterVal($_mPlayDrawInterVal){ $this->_mPlayDrawInterVal = $_mPlayDrawInterVal; }

	public function getmEndDrawInterVal(){ return $this->_mEndAnim; }
	public function setmEndDrawInterVal($_mEndAnim){ $this->_mEndAnim = $_mEndAnim; }

	public function getmEndInterVal(){ return $this->_mEndInterVal; }
	public function setmEndInterVal($_mEndInterVal){ $this->_mEndInterVal = $_mEndInterVal; }

	public function getmEndInterVal(){ return $this->_mEndInterVal; }
	public function setmEndInterVal($_mEndInterVal){ $this->_mEndInterVal = $_mEndInterVal; }

	public function getmPlayerColor1(){ return $this->_mPlayerColor1; }
	public function setmPlayerColor1($_mPlayerColor1){ $this->_mPlayerColor1 = $_mPlayerColor1; }

	public function getmPlayerColor2(){ return $this->_mPlayerColor2; }
	public function setmPlayerColor2($_mPlayerColor2){ $this->_mPlayerColor2 = $_mPlayerColor2; }

	public function getmBackGroundColor(){ return $this->_mBackGroundColor; }
	public function setmBackGroundColor($_mBackGroundColor){ $this->_mBackGroundColor = $_mBackGroundColor; }

	public function getmBorderColor(){ return $this->_mBorderColor; }
	public function setmBorderColor($_mBorderColor){ $this->_mBorderColor = $_mBorderColor; }

	// #endregion

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
		$this->reset();
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
	///	@brief			リセット
	///	@fn				reset()
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function reset()
	{
		mMode				= ReversiConst::$DEF_MODE_ONE;						// 現在のモード
		mType				= ReversiConst::$DEF_TYPE_HARD;						// 現在のタイプ
		mPlayer				= ReversiConst::$REVERSI_STS_BLACK;					// プレイヤーの色
		mAssist				= ReversiConst::$DEF_ASSIST_ON;						// アシスト
		mGameSpd			= ReversiConst::$DEF_GAME_SPD_MID;					// ゲームスピード
		mEndAnim			= ReversiConst::$DEF_END_ANIM_ON;					// ゲーム終了アニメーション
		mMasuCntMenu		= ReversiConst::$DEF_MASU_CNT_8;					// マスの数
		mMasuCnt			= ReversiConst::$DEF_MASU_CNT_8_VAL;				// マスの数
		mPlayCpuInterVal	= ReversiConst::$DEF_GAME_SPD_MID_VAL2;				// CPU対戦時のインターバル(msec)
		mPlayDrawInterVal	= ReversiConst::$DEF_GAME_SPD_MID_VAL;				// 描画のインターバル(msec)
		mEndDrawInterVal	= 100;												// 終了アニメーション描画のインターバル(msec)
		mEndInterVal		= 500;												// 終了アニメーションのインターバル(msec)
		mPlayerColor1		= "#FF0000";										// プレイヤー1の色
		mPlayerColor2		= "#FFFFFF";										// プレイヤー2の色
		mBackGroundColor	= "#FF00FF";										// 背景の色
		mBorderColor		= "#FF0000";										// 枠線の色
	}
}

?>
