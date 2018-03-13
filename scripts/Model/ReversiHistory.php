<?php

////////////////////////////////////////////////////////////////////////////////
///	@file			ReversiHistory.php
///	@brief			リバーシ履歴クラス実装ファイル
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

require_once("ReversiPoint.php");

////////////////////////////////////////////////////////////////////////////////
///	@class		ReversiHistory
///	@brief		リバーシ履歴クラス
///
////////////////////////////////////////////////////////////////////////////////
class ReversiHistory
{
	// #region メンバ変数
	private $_point;								//!< ポイント
	private $_color;								//!< 色
	// #endregion

	// #region プロパティ
	public function getPoint(){ return $this->_point; }
	public function setPoint($_point){ $this->_point = $_point; }

	public function getColor(){ return $this->_color; }
	public function setColor($_color){ $this->_color = $_color; }
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
		$this->_point = new ReversiPoint();
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
		$this->_point->setx(-1);
		$this->_point->sety(-1);
		$this->_color = -1;
	}
}

?>
