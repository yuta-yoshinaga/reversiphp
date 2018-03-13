<?php

////////////////////////////////////////////////////////////////////////////////
///	@file			ReversiAnz.php
///	@brief			リバーシ解析クラス実装ファイル
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

////////////////////////////////////////////////////////////////////////////////
///	@class		ReversiAnz
///	@brief		リバーシ解析クラス
///
////////////////////////////////////////////////////////////////////////////////
class ReversiAnz
{
	// #region メンバ変数
	private $_min;														//!< 最小値
	private $_max;														//!< 最大値
	private $_avg;														//!< 平均
	private $_pointCnt;													//!< 置けるポイント数
	private $_edgeCnt;													//!< 角を取れるポイント数
	private $_edgeSideOneCnt;											//!< 角一つ前を取れるポイント数
	private $_edgeSideTwoCnt;											//!< 角二つ前を取れるポイント数
	private $_edgeSideThreeCnt;											//!< 角三つ前を取れるポイント数
	private $_edgeSideOtherCnt;											//!< それ以外を取れるポイント数
	private $_ownMin;													//!< 最小値
	private $_ownMax;													//!< 最大値
	private $_ownAvg;													//!< 平均
	private $_ownPointCnt;												//!< 置けるポイント数
	private $_ownEdgeCnt;												//!< 角を取れるポイント数
	private $_ownEdgeSideOneCnt;										//!< 角一つ前を取れるポイント数
	private $_ownEdgeSideTwoCnt;										//!< 角二つ前を取れるポイント数
	private $_ownEdgeSideThreeCnt;										//!< 角三つ前を取れるポイント数
	private $_ownEdgeSideOtherCnt;										//!< それ以外を取れるポイント数
	private $_badPoint;													//!< 悪手ポイント
	private $_goodPoint;												//!< 良手ポイント
	// #endregion

	// #region プロパティ
	public function getMin(){ return $this->_min; }
	public function setMin($_min){ $this->_min = $_min; }

	public function getMax(){ return $this->_max; }
	public function setMax($_max){ $this->_max = $_max; }

	public function getAvg(){ return $this->_avg; }
	public function setAvg($_avg){ $this->_avg = $_avg; }

	public function getPointCnt(){ return $this->_pointCnt; }
	public function setPointCnt($_pointCnt){ $this->_pointCnt = $_pointCnt; }

	public function getEdgeCnt(){ return $this->_edgeCnt; }
	public function setEdgeCnt($_edgeCnt){ $this->_edgeCnt = $_edgeCnt; }

	public function getEdgeSideOneCnt(){ return $this->_edgeSideOneCnt; }
	public function setEdgeSideOneCnt($_edgeSideOneCnt){ $this->_edgeSideOneCnt = $_edgeSideOneCnt; }

	public function getEdgeSideTwoCnt(){ return $this->_edgeSideTwoCnt; }
	public function setEdgeSideTwoCnt($_edgeSideTwoCnt){ $this->_edgeSideTwoCnt = $_edgeSideTwoCnt; }

	public function getEdgeSideThreeCnt(){ return $this->_edgeSideThreeCnt; }
	public function setEdgeSideThreeCnt($_edgeSideThreeCnt){ $this->_edgeSideThreeCnt = $_edgeSideThreeCnt; }

	public function getEdgeSideOtherCnt(){ return $this->_edgeSideOtherCnt; }
	public function setEdgeSideOtherCnt($_edgeSideOtherCnt){ $this->_edgeSideOtherCnt = $_edgeSideOtherCnt; }

	public function getOwnMin(){ return $this->_ownMin; }
	public function setOwnMin($_ownMin){ $this->_ownMin = $_ownMin; }

	public function getOwnMax(){ return $this->_ownMax; }
	public function setOwnMax($_ownMax){ $this->_ownMax = $_ownMax; }

	public function getOwnAvg(){ return $this->_ownAvg; }
	public function setOwnAvg($_ownAvg){ $this->_ownAvg = $_ownAvg; }

	public function getOwnPointCnt(){ return $this->_ownPointCnt; }
	public function setOwnPointCnt($_ownPointCnt){ $this->_ownPointCnt = $_ownPointCnt; }

	public function getOwnEdgeCnt(){ return $this->_ownEdgeCnt; }
	public function setOwnEdgeCnt($_ownEdgeCnt){ $this->_ownEdgeCnt = $_ownEdgeCnt; }

	public function getOwnEdgeSideOneCnt(){ return $this->_ownEdgeSideOneCnt; }
	public function setOwnEdgeSideOneCnt($_ownEdgeSideOneCnt){ $this->_ownEdgeSideOneCnt = $_ownEdgeSideOneCnt; }

	public function getOwnEdgeSideTwoCnt(){ return $this->_ownEdgeSideTwoCnt; }
	public function setOwnEdgeSideTwoCnt($_ownEdgeSideTwoCnt){ $this->_ownEdgeSideTwoCnt = $_ownEdgeSideTwoCnt; }

	public function getOwnEdgeSideThreeCnt(){ return $this->_ownEdgeSideThreeCnt; }
	public function setOwnEdgeSideThreeCnt($_ownEdgeSideThreeCnt){ $this->_ownEdgeSideThreeCnt = $_ownEdgeSideThreeCnt; }

	public function getOwnEdgeSideOtherCnt(){ return $this->_ownEdgeSideOtherCnt; }
	public function setOwnEdgeSideOtherCnt($_ownEdgeSideOtherCnt){ $this->_ownEdgeSideOtherCnt = $_ownEdgeSideOtherCnt; }

	public function getBadPoint(){ return $this->_badPoint; }
	public function setBadPoint($_badPoint){ $this->_badPoint = $_badPoint; }

	public function getGoodPoint(){ return $this->_goodPoint; }
	public function setGoodPoint($_goodPoint){ $this->_goodPoint = $_goodPoint; }
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
		$this->_min					= 0;
		$this->_max					= 0;
		$this->_avg					= 0.0;
		$this->_pointCnt			= 0;
		$this->_edgeCnt				= 0;
		$this->_edgeSideOneCnt		= 0;
		$this->_edgeSideTwoCnt		= 0;
		$this->_edgeSideThreeCnt	= 0;
		$this->_edgeSideOtherCnt	= 0;
		$this->_ownMin				= 0;
		$this->_ownMax				= 0;
		$this->_ownAvg				= 0.0;
		$this->_ownPointCnt			= 0;
		$this->_ownEdgeCnt			= 0;
		$this->_ownEdgeSideOneCnt	= 0;
		$this->_ownEdgeSideTwoCnt	= 0;
		$this->_ownEdgeSideThreeCnt	= 0;
		$this->_ownEdgeSideOtherCnt	= 0;
		$this->_badPoint			= 0;
		$this->_goodPoint			= 0;
	}
}

?>
