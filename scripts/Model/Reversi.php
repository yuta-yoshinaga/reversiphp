<?php

////////////////////////////////////////////////////////////////////////////////
///	@file			Reversi.php
///	@brief			リバーシクラス実装ファイル
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
require_once("ReversiAnz.php");
require_once("ReversiPoint.php");
require_once("ReversiHistory.php");

////////////////////////////////////////////////////////////////////////////////
///	@class		Reversi
///	@brief		リバーシクラス
///
////////////////////////////////////////////////////////////////////////////////
class Reversi
{
	// #region メンバ変数
	private $_mMasuSts;												//!< マスの状態
	private $_mMasuStsOld;											//!< 以前のマスの状態
	private $_mMasuStsEnaB;											//!< 黒の置ける場所
	private $_mMasuStsCntB;											//!< 黒の獲得コマ数
	private $_mMasuStsPassB;										//!< 黒が相手をパスさせる場所
	private $_mMasuStsAnzB;											//!< 黒がその場所に置いた場合の解析結果
	private $_mMasuPointB;											//!< 黒の置ける場所座標一覧
	private $_mMasuPointCntB;										//!< 黒の置ける場所座標一覧数
	private $_mMasuBetCntB;											//!< 黒コマ数
	private $_mMasuStsEnaW;											//!< 白の置ける場所
	private $_mMasuStsCntW;											//!< 白の獲得コマ数
	private $_mMasuStsPassW;										//!< 白が相手をパスさせる場所
	private $_mMasuStsAnzW;											//!< 白がその場所に置いた場合の解析結果
	private $_mMasuPointW;											//!< 白の置ける場所座標一覧
	private $_mMasuPointCntW;										//!< 白の置ける場所座標一覧数
	private $_mMasuBetCntW;											//!< 白コマ数
	private $_mMasuCnt;												//!< 縦横マス数
	private $_mMasuCntMax;											//!< 縦横マス最大数
	private $_mMasuHistCur;											//!< 履歴現在位置
	private $_mMasuHist;											//!< 履歴
	// #endregion

	// #region プロパティ
	public function getmMasuSts(){ return $this->_mMasuSts; }
	public function setmMasuSts($_mMasuSts){ $this->_mMasuSts = $_mMasuSts; }

	public function getmMasuStsOld(){ return $this->_mMasuStsOld; }
	public function setmMasuStsOld($_mMasuStsOld){ $this->_mMasuStsOld = $_mMasuStsOld; }

	public function getmMasuStsEnaB(){ return $this->_mMasuStsEnaB; }
	public function setmMasuStsEnaB($_mMasuStsEnaB){ $this->_mMasuStsEnaB = $_mMasuStsEnaB; }

	public function getmMasuStsCntB(){ return $this->_mMasuStsCntB; }
	public function setmMasuStsCntB($_mMasuStsCntB){ $this->_mMasuStsCntB = $_mMasuStsCntB; }

	public function getmMasuStsPassB(){ return $this->_mMasuStsPassB; }
	public function setmMasuStsPassB($_mMasuStsPassB){ $this->_mMasuStsPassB = $_mMasuStsPassB; }

	public function getmMasuStsAnzB(){ return $this->_mMasuStsAnzB; }
	public function setmMasuStsAnzB($_mMasuStsAnzB){ $this->_mMasuStsAnzB = $_mMasuStsAnzB; }

	public function getmMasuPointB(){ return $this->_mMasuPointB; }
	public function setmMasuPointB($_mMasuPointB){ $this->_mMasuPointB = $_mMasuPointB; }

	public function getmMasuPointCntB(){ return $this->_mMasuPointCntB; }
	public function setmMasuPointCntB($_mMasuPointCntB){ $this->_mMasuPointCntB = $_mMasuPointCntB; }

	public function getmMasuBetCntB(){ return $this->_mMasuBetCntB; }
	public function setmMasuBetCntB($_mMasuBetCntB){ $this->_mMasuBetCntB = $_mMasuBetCntB; }

	public function getmMasuStsEnaW(){ return $this->_mMasuStsEnaW; }
	public function setmMasuStsEnaW($_mMasuStsEnaW){ $this->_mMasuStsEnaW = $_mMasuStsEnaW; }

	public function getmMasuStsCntW(){ return $this->_mMasuStsCntW; }
	public function setmMasuStsCntW($_mMasuStsCntW){ $this->_mMasuStsCntW = $_mMasuStsCntW; }

	public function getmMasuStsPassW(){ return $this->_mMasuStsPassW; }
	public function setmMasuStsPassW($_mMasuStsPassW){ $this->_mMasuStsPassW = $_mMasuStsPassW; }

	public function getmMasuStsAnzW(){ return $this->_mMasuStsAnzW; }
	public function setmMasuStsAnzW($_mMasuStsAnzW){ $this->_mMasuStsAnzW = $_mMasuStsAnzW; }

	public function getmMasuPointW(){ return $this->_mMasuPointW; }
	public function setmMasuPointW($_mMasuPointW){ $this->_mMasuPointW = $_mMasuPointW; }

	public function getmMasuPointCntW(){ return $this->_mMasuPointCntW; }
	public function setmMasuPointCntW($_mMasuPointCntW){ $this->_mMasuPointCntW = $_mMasuPointCntW; }

	public function getmMasuBetCntW(){ return $this->_mMasuBetCntW; }
	public function setmMasuBetCntW($_mMasuBetCntW){ $this->_mMasuBetCntW = $_mMasuBetCntW; }

	public function getmMasuCnt(){ return $this->_mMasuCnt; }
	public function setmMasuCnt($_mMasuCnt){ $this->_mMasuCnt = $_mMasuCnt; }

	public function getmMasuCntMax(){ return $this->_mMasuCntMax; }
	public function setmMasuCntMax($_mMasuCntMax){ $this->_mMasuCntMax = $_mMasuCntMax; }

	public function getmMasuHistCur(){ return $this->_mMasuHistCur; }
	public function setmMasuHistCur($_mMasuHistCur){ $this->_mMasuHistCur = $_mMasuHistCur; }

	public function getmMasuHist(){ return $this->_mMasuHist; }
	public function setmMasuHist($_mMasuHist){ $this->_mMasuHist = $_mMasuHist; }
	// #endregion

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			コンストラクタ
	///	@fn				__construct($masuCnt, $masuMax)
	///	@param[in]		$masuCnt		縦横マス数
	///	@param[in]		$masuMax		縦横マス最大数
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function __construct($masuCnt, $masuMax)
	{
		$this->_mMasuCnt		= $masuCnt;
		$this->_mMasuCntMax		= $masuMax;

		$this->_mMasuSts		= array();
		$this->_mMasuStsOld		= array();

		$this->_mMasuStsEnaB	= array();
		$this->_mMasuStsCntB	= array();
		$this->_mMasuStsPassB	= array();
		$this->_mMasuStsAnzB	= array();

		$this->_mMasuStsEnaW	= array();
		$this->_mMasuStsCntW	= array();
		$this->_mMasuStsPassW	= array();
		$this->_mMasuStsAnzW	= array();

		for ($i = 0; $i < $this->_mMasuCntMax; $i++) {
			$this->_mMasuSts[$i]			= array();

			$this->_mMasuStsEnaB[$i]		= array();
			$this->_mMasuStsCntB[$i]		= array();
			$this->_mMasuStsPassB[$i]		= array();
			$this->_mMasuStsAnzB[$i]		= array();

			$this->_mMasuStsEnaW[$i]		= array();
			$this->_mMasuStsCntW[$i]		= array();
			$this->_mMasuStsPassW[$i]		= array();
			$this->_mMasuStsAnzW[$i]		= array();
			for ($j = 0; $j < $this->_mMasuCntMax; $j++) {
				$this->_mMasuSts[$i][$j]			= ReversiConst::$REVERSI_STS_NONE;

				$this->_mMasuStsEnaB[$i][$j]		= ReversiConst::$REVERSI_STS_NONE;
				$this->_mMasuStsCntB[$i][$j]		= ReversiConst::$REVERSI_STS_NONE;
				$this->_mMasuStsPassB[$i][$j]		= ReversiConst::$REVERSI_STS_NONE;
				$this->_mMasuStsAnzB[$i][$j]		= new ReversiAnz();

				$this->_mMasuStsEnaW[$i][$j]		= ReversiConst::$REVERSI_STS_NONE;
				$this->_mMasuStsCntW[$i][$j]		= ReversiConst::$REVERSI_STS_NONE;
				$this->_mMasuStsPassW[$i][$j]		= ReversiConst::$REVERSI_STS_NONE;
				$this->_mMasuStsAnzW[$i][$j]		= new ReversiAnz();
			}
		}
		$this->_mMasuPointB = array();
		$this->_mMasuPointW = array();
		for ($i = 0; $i < ($this->_mMasuCntMax * $this->_mMasuCntMax); $i++) {
			$this->_mMasuPointB[$i] = new ReversiPoint();
			$this->_mMasuPointW[$i] = new ReversiPoint();
		}
		$this->_mMasuPointCntB = 0;
		$this->_mMasuPointCntW = 0;

		$this->_mMasuBetCntB = 0;
		$this->_mMasuBetCntW = 0;

		$this->_mMasuHist = array();
		for ($i = 0; $i < ($this->_mMasuCntMax * $this->_mMasuCntMax); $i++) {
			$this->_mMasuHist[$i] = new ReversiHistory();
		}
		$this->_mMasuHistCur	= 0;
		$this->_mMasuStsOld		= $this->_mMasuSts;
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
		for ($i = 0; $i < $this->_mMasuCnt; $i++) {
			for ($j = 0; $j < $this->_mMasuCnt; $j++) {
				$this->_mMasuSts[$i][$j]		= ReversiConst::$REVERSI_STS_NONE;
				$this->_mMasuStsPassB[$i][$j]	= 0;
				$this->_mMasuStsAnzB[$i][$j]->reset();
				$this->_mMasuStsPassW[$i][$j]	= 0;
				$this->_mMasuStsAnzW[$i][$j]->reset();
			}
		}
		$this->_mMasuSts[($this->_mMasuCnt >> 1) - 1][($this->_mMasuCnt >> 1) - 1]	= ReversiConst::$REVERSI_STS_BLACK;
		$this->_mMasuSts[($this->_mMasuCnt >> 1) - 1][($this->_mMasuCnt >> 1)]		= ReversiConst::$REVERSI_STS_WHITE;
		$this->_mMasuSts[($this->_mMasuCnt >> 1)][($this->_mMasuCnt >> 1) - 1]		= ReversiConst::$REVERSI_STS_WHITE;
		$this->_mMasuSts[($this->_mMasuCnt >> 1)][($this->_mMasuCnt >> 1)]			= ReversiConst::$REVERSI_STS_BLACK;
		$this->makeMasuSts(ReversiConst::$REVERSI_STS_BLACK);
		$this->makeMasuSts(ReversiConst::$REVERSI_STS_WHITE);
		$this->_mMasuHistCur = 0;
		$this->_mMasuStsOld = $this->_mMasuSts;
	}
	////////////////////////////////////////////////////////////////////////////////
	///	@brief			各コマの置ける場所等のステータス作成
	///	@fn				makeMasuSts($color)
	///	@param[in]		$color		ステータスを作成するコマ
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	private function makeMasuSts($color)
	{
		$flg;
		$okflg = 0;
		$cnt1;
		$cnt2;
		$count1;
		$count2 = 0;
		$ret = -1;
		$countMax = 0;
		$loop;

		for ($i = 0; $i < $this->_mMasuCnt; $i++) {										// 初期化
			for ($j = 0; $j < $this->_mMasuCnt; $j++) {
				if ($color == ReversiConst::$REVERSI_STS_BLACK) {
					$this->_mMasuStsEnaB[$i][$j] = 0;
					$this->_mMasuStsCntB[$i][$j] = 0;
				} else {
					$this->_mMasuStsEnaW[$i][$j] = 0;
					$this->_mMasuStsCntW[$i][$j] = 0;
				}
			}
		}

		$loop = $this->_mMasuCnt * $this->_mMasuCnt;
		for ($i = 0; $i < $loop; $i++) {												// 初期化
			if ($color == ReversiConst::$REVERSI_STS_BLACK) {
				$this->_mMasuPointB[$i]->setx(0);
				$this->_mMasuPointB[$i]->sety(0);
			} else {
				$this->_mMasuPointW[$i]->setx(0);
				$this->_mMasuPointW[$i]->sety(0);
			}
		}
		if ($color == ReversiConst::$REVERSI_STS_BLACK) {
			$this->_mMasuPointCntB = 0;
		} else {
			$this->_mMasuPointCntW = 0;
		}
		$this->_mMasuBetCntB = 0;
		$this->_mMasuBetCntW = 0;

		for ($i = 0; $i < $this->_mMasuCnt; $i++) {
			for ($j = 0; $j < $this->_mMasuCnt; $j++) {
				$okflg = 0;
				$count2 = 0;
				if ($this->_mMasuSts[$i][$j] == ReversiConst::$REVERSI_STS_NONE) {		// 何も置かれていないマスなら
					$cnt1 = $i;
					$count1 = $flg = 0;
					// *** 上方向を調べる *** //
					while (($cnt1 > 0) && ($this->_mMasuSts[$cnt1 - 1][$j] != ReversiConst::$REVERSI_STS_NONE && $this->_mMasuSts[$cnt1 - 1][$j] != $color)) {
						$flg = 1;
						$cnt1--;
						$count1++;
					}
					if (($cnt1 > 0) && ($flg == 1) && ($this->_mMasuSts[$cnt1 - 1][$j] == $color)) {
						$okflg = 1;
						$count2 += $count1;
					}
					$cnt1 = $i;
					$count1 = $flg = 0;
					// *** 下方向を調べる *** //
					while (($cnt1 < ($this->_mMasuCnt - 1)) && ($this->_mMasuSts[$cnt1 + 1][$j] != ReversiConst::$REVERSI_STS_NONE && $this->_mMasuSts[$cnt1 + 1][$j] != $color)) {
						$flg = 1;
						$cnt1++;
						$count1++;
					}
					if (($cnt1 < ($this->_mMasuCnt - 1)) && ($flg == 1) && ($this->_mMasuSts[$cnt1 + 1][$j] == $color)) {
						$okflg = 1;
						$count2 += $count1;
					}
					$cnt2 = $j;
					$count1 = $flg = 0;
					// *** 右方向を調べる *** //
					while (($cnt2 < ($this->_mMasuCnt - 1)) && ($this->_mMasuSts[$i][$cnt2 + 1] != ReversiConst::$REVERSI_STS_NONE && $this->_mMasuSts[$i][$cnt2 + 1] != $color)) {
						$flg = 1;
						$cnt2++;
						$count1++;
					}
					if (($cnt2 < ($this->_mMasuCnt - 1)) && ($flg == 1) && ($this->_mMasuSts[$i][$cnt2 + 1] == $color)) {
						$okflg = 1;
						$count2 += $count1;
					}
					$cnt2 = $j;
					$count1 = $flg = 0;
					// *** 左方向を調べる *** //
					while (($cnt2 > 0) && ($this->_mMasuSts[$i][$cnt2 - 1] != ReversiConst::$REVERSI_STS_NONE && $this->_mMasuSts[$i][$cnt2 - 1] != $color)) {
						$flg = 1;
						$cnt2--;
						$count1++;
					}
					if (($cnt2 > 0) && ($flg == 1) && ($this->_mMasuSts[$i][$cnt2 - 1] == $color)) {
						$okflg = 1;
						$count2 += $count1;
					}
					$cnt2 = $j;
					$cnt1 = $i;
					$count1 = $flg = 0;
					// *** 右上方向を調べる *** //
					while ((($cnt2 < ($this->_mMasuCnt - 1)) && ($cnt1 > 0)) && ($this->_mMasuSts[$cnt1 - 1][$cnt2 + 1] != ReversiConst::$REVERSI_STS_NONE && $this->_mMasuSts[$cnt1 - 1][$cnt2 + 1] != $color)) {
						$flg = 1;
						$cnt1--;
						$cnt2++;
						$count1++;
					}
					if ((($cnt2 < ($this->_mMasuCnt - 1)) && ($cnt1 > 0)) && ($flg == 1) && ($this->_mMasuSts[$cnt1 - 1][$cnt2 + 1] == $color)) {
						$okflg = 1;
						$count2 += $count1;
					}
					$cnt2 = $j;
					$cnt1 = $i;
					$count1 = $flg = 0;
					// *** 左上方向を調べる *** //
					while ((($cnt2 > 0) && ($cnt1 > 0)) && ($this->_mMasuSts[$cnt1 - 1][$cnt2 - 1] != ReversiConst::$REVERSI_STS_NONE && $this->_mMasuSts[$cnt1 - 1][$cnt2 - 1] != $color)) {
						$flg = 1;
						$cnt1--;
						$cnt2--;
						$count1++;
					}
					if ((($cnt2 > 0) && ($cnt1 > 0)) && ($flg == 1) && ($this->_mMasuSts[$cnt1 - 1][$cnt2 - 1] == $color)) {
						$okflg = 1;
						$count2 += $count1;
					}
					$cnt2 = $j;
					$cnt1 = $i;
					$count1 = $flg = 0;
					// *** 右下方向を調べる *** //
					while ((($cnt2 < ($this->_mMasuCnt - 1)) && ($cnt1 < ($this->_mMasuCnt - 1))) && ($this->_mMasuSts[$cnt1 + 1][$cnt2 + 1] != ReversiConst::$REVERSI_STS_NONE && $this->_mMasuSts[$cnt1 + 1][$cnt2 + 1] != $color)) {
						$flg = 1;
						$cnt1++;
						$cnt2++;
						$count1++;
					}
					if ((($cnt2 < ($this->_mMasuCnt - 1)) && ($cnt1 < ($this->_mMasuCnt - 1))) && ($flg == 1) && ($this->_mMasuSts[$cnt1 + 1][$cnt2 + 1] == $color)) {
						$okflg = 1;
						$count2 += $count1;
					}
					$cnt2 = $j;
					$cnt1 = $i;
					$count1 = $flg = 0;
					// *** 左下方向を調べる *** //
					while ((($cnt2 > 0) && ($cnt1 < ($this->_mMasuCnt - 1))) && ($this->_mMasuSts[$cnt1 + 1][$cnt2 - 1] != ReversiConst::$REVERSI_STS_NONE && $this->_mMasuSts[$cnt1 + 1][$cnt2 - 1] != $color)) {
						$flg = 1;
						$cnt1++;
						$cnt2--;
						$count1++;
					}
					if ((($cnt2 > 0) && ($cnt1 < ($this->_mMasuCnt - 1))) && ($flg == 1) && ($this->_mMasuSts[$cnt1 + 1][$cnt2 - 1] == $color)) {
						$okflg = 1;
						$count2 += $count1;
					}
					if ($okflg == 1) {
						if ($color == ReversiConst::$REVERSI_STS_BLACK) {
							$this->_mMasuStsEnaB[$i][$j] = 1;
							$this->_mMasuStsCntB[$i][$j] = $count2;
							// *** 置ける場所をリニアに保存、置けるポイント数も保存 *** //
							$this->_mMasuPointB[$this->_mMasuPointCntB]->sety($i);
							$this->_mMasuPointB[$this->_mMasuPointCntB]->setx($j);
							$this->_mMasuPointCntB++;
						} else {
							$this->_mMasuStsEnaW[$i][$j] = 1;
							$this->_mMasuStsCntW[$i][$j] = $count2;
							// *** 置ける場所をリニアに保存、置けるポイント数も保存 *** //
							$this->_mMasuPointW[$this->_mMasuPointCntW]->sety($i);
							$this->_mMasuPointW[$this->_mMasuPointCntW]->setx($j);
							$this->_mMasuPointCntW++;
						}
						$ret = 0;
						if ($countMax < $count2) $countMax = $count2;
					}
				} else if ($this->_mMasuSts[$i][$j] == ReversiConst::$REVERSI_STS_BLACK) {
					$this->_mMasuBetCntB++;
				} else if ($this->_mMasuSts[$i][$j] == ReversiConst::$REVERSI_STS_WHITE) {
					$this->_mMasuBetCntW++;
				}
			}
		}

		// *** 一番枚数を獲得できるマスを設定 *** //
		for ($i = 0; $i < $this->_mMasuCnt; $i++) {
			for ($j = 0; $j < $this->_mMasuCnt; $j++) {
				if ($color == ReversiConst::$REVERSI_STS_BLACK) {
					if ($this->_mMasuStsEnaB[$i][$j] != 0 && $this->_mMasuStsCntB[$i][$j] == $countMax) {
						$this->_mMasuStsEnaB[$i][$j] = 2;
					}
				} else {
					if ($this->_mMasuStsEnaW[$i][$j] != 0 && $this->_mMasuStsCntW[$i][$j] == $countMax) {
						$this->_mMasuStsEnaW[$i][$j] = 2;
					}
				}
			}
		}
		return $ret;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			コマをひっくり返す
	///	@fn				revMasuSts($color, $y, $x)
	///	@param[in]		$color		ひっくり返す元コマ
	///	@param[in]		$y			ひっくり返す元コマの$y座標
	///	@param[in]		$x			ひっくり返す元コマの$x座標
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	private function revMasuSts($color, $y, $x)
	{
		$cnt1;
		$cnt2;
		$rcnt1;
		$rcnt2;
		$flg = 0;

		// *** 左方向にある駒を調べる *** //
		for ($flg = 0, $cnt1 = $x, $cnt2 = $y; $cnt1 > 0;) {
			if ($this->_mMasuSts[$cnt2][$cnt1 - 1] != ReversiConst::$REVERSI_STS_NONE && $this->_mMasuSts[$cnt2][$cnt1 - 1] != $color) {
				// *** プレイヤー以外の色の駒があるなら *** //
				$cnt1--;
			} else if ($this->_mMasuSts[$cnt2][$cnt1 - 1] == $color) {
				$flg = 1;
				break;
			} else if ($this->_mMasuSts[$cnt2][$cnt1 - 1] == ReversiConst::$REVERSI_STS_NONE) {
				break;
			}
		}
		if ($flg == 1) {
			// *** 駒をひっくり返す *** //
			for ($rcnt1 = $cnt1; $rcnt1 < $x; $rcnt1++) {
				$this->_mMasuSts[$cnt2][$rcnt1] = $color;
			}
		}

		// *** 右方向にある駒を調べる *** //
		for ($flg = 0, $cnt1 = $x, $cnt2 = $y; $cnt1 < ($this->_mMasuCnt - 1);) {
			if ($this->_mMasuSts[$cnt2][$cnt1 + 1] != ReversiConst::$REVERSI_STS_NONE && $this->_mMasuSts[$cnt2][$cnt1 + 1] != $color) {
				// *** プレイヤー以外の色の駒があるなら *** //
				$cnt1++;
			} else if ($this->_mMasuSts[$cnt2][$cnt1 + 1] == $color) {
				$flg = 1;
				break;
			} else if ($this->_mMasuSts[$cnt2][$cnt1 + 1] == ReversiConst::$REVERSI_STS_NONE) {
				break;
			}
		}
		if ($flg == 1) {
			// *** 駒をひっくり返す *** //
			for ($rcnt1 = $cnt1; $rcnt1 > $x; $rcnt1--) {
				$this->_mMasuSts[$cnt2][$rcnt1] = $color;
			}
		}

		// *** 上方向にある駒を調べる *** //
		for ($flg = 0, $cnt1 = $x, $cnt2 = $y; $cnt2 > 0;) {
			if ($this->_mMasuSts[$cnt2 - 1][$cnt1] != ReversiConst::$REVERSI_STS_NONE && $this->_mMasuSts[$cnt2 - 1][$cnt1] != $color) {
				// *** プレイヤー以外の色の駒があるなら *** //
				$cnt2--;
			} else if ($this->_mMasuSts[$cnt2 - 1][$cnt1] == $color) {
				$flg = 1;
				break;
			} else if ($this->_mMasuSts[$cnt2 - 1][$cnt1] == ReversiConst::$REVERSI_STS_NONE) {
				break;
			}
		}
		if ($flg == 1) {
			// *** 駒をひっくり返す *** //
			for ($rcnt1 = $cnt2; $rcnt1 < $y; $rcnt1++) {
				$this->_mMasuSts[$rcnt1][$cnt1] = $color;
			}
		}

		// *** 下方向にある駒を調べる *** //
		for ($flg = 0, $cnt1 = $x, $cnt2 = $y; $cnt2 < ($this->_mMasuCnt - 1);) {
			if ($this->_mMasuSts[$cnt2 + 1][$cnt1] != ReversiConst::$REVERSI_STS_NONE && $this->_mMasuSts[$cnt2 + 1][$cnt1] != $color) {
				// *** プレイヤー以外の色の駒があるなら *** //
				$cnt2++;
			} else if ($this->_mMasuSts[$cnt2 + 1][$cnt1] == $color) {
				$flg = 1;
				break;
			} else if ($this->_mMasuSts[$cnt2 + 1][$cnt1] == ReversiConst::$REVERSI_STS_NONE) {
				break;
			}
		}
		if ($flg == 1) {
			// *** 駒をひっくり返す *** //
			for ($rcnt1 = $cnt2; $rcnt1 > $y; $rcnt1--) {
				$this->_mMasuSts[$rcnt1][$cnt1] = $color;
			}
		}

		// *** 左上方向にある駒を調べる *** //
		for ($flg = 0, $cnt1 = $x, $cnt2 = $y; $cnt2 > 0 && $cnt1 > 0;) {
			if ($this->_mMasuSts[$cnt2 - 1][$cnt1 - 1] != ReversiConst::$REVERSI_STS_NONE && $this->_mMasuSts[$cnt2 - 1][$cnt1 - 1] != $color) {
				// *** プレイヤー以外の色の駒があるなら *** //
				$cnt2--;
				$cnt1--;
			} else if ($this->_mMasuSts[$cnt2 - 1][$cnt1 - 1] == $color) {
				$flg = 1;
				break;
			} else if ($this->_mMasuSts[$cnt2 - 1][$cnt1 - 1] == ReversiConst::$REVERSI_STS_NONE) {
				break;
			}
		}
		if ($flg == 1) {
			// *** 駒をひっくり返す *** //
			for ($rcnt1 = $cnt2, $rcnt2 = $cnt1; ($rcnt1 < $y) && ($rcnt2 < $x); $rcnt1++ , $rcnt2++) {
				$this->_mMasuSts[$rcnt1][$rcnt2] = $color;
			}
		}

		// *** 左下方向にある駒を調べる *** //
		for ($flg = 0, $cnt1 = $x, $cnt2 = $y; $cnt2 < ($this->_mMasuCnt - 1) && $cnt1 > 0;) {
			if ($this->_mMasuSts[$cnt2 + 1][$cnt1 - 1] != ReversiConst::$REVERSI_STS_NONE && $this->_mMasuSts[$cnt2 + 1][$cnt1 - 1] != $color) {
				// *** プレイヤー以外の色の駒があるなら *** //
				$cnt2++;
				$cnt1--;
			} else if ($this->_mMasuSts[$cnt2 + 1][$cnt1 - 1] == $color) {
				$flg = 1;
				break;
			} else if ($this->_mMasuSts[$cnt2 + 1][$cnt1 - 1] == ReversiConst::$REVERSI_STS_NONE) {
				break;
			}
		}
		if ($flg == 1) {
			// *** 駒をひっくり返す *** //
			for ($rcnt1 = $cnt2, $rcnt2 = $cnt1; ($rcnt1 > $y) && ($rcnt2 < $x); $rcnt1-- , $rcnt2++) {
				$this->_mMasuSts[$rcnt1][$rcnt2] = $color;
			}
		}

		// *** 右上方向にある駒を調べる *** //
		for ($flg = 0, $cnt1 = $x, $cnt2 = $y; $cnt2 > 0 && $cnt1 < ($this->_mMasuCnt - 1);) {
			if ($this->_mMasuSts[$cnt2 - 1][$cnt1 + 1] != ReversiConst::$REVERSI_STS_NONE && $this->_mMasuSts[$cnt2 - 1][$cnt1 + 1] != $color) {
				// *** プレイヤー以外の色の駒があるなら *** //
				$cnt2--;
				$cnt1++;
			} else if ($this->_mMasuSts[$cnt2 - 1][$cnt1 + 1] == $color) {
				$flg = 1;
				break;
			} else if ($this->_mMasuSts[$cnt2 - 1][$cnt1 + 1] == ReversiConst::$REVERSI_STS_NONE) {
				break;
			}
		}
		if ($flg == 1) {
			// *** 駒をひっくり返す *** //
			for ($rcnt1 = $cnt2, $rcnt2 = $cnt1; ($rcnt1 < $y) && ($rcnt2 > $x); $rcnt1++ , $rcnt2--) {
				$this->_mMasuSts[$rcnt1][$rcnt2] = $color;
			}
		}

		// *** 右下方向にある駒を調べる *** //
		for ($flg = 0, $cnt1 = $x, $cnt2 = $y; $cnt2 < ($this->_mMasuCnt - 1) && $cnt1 < ($this->_mMasuCnt - 1);) {
			if ($this->_mMasuSts[$cnt2 + 1][$cnt1 + 1] != ReversiConst::$REVERSI_STS_NONE && $this->_mMasuSts[$cnt2 + 1][$cnt1 + 1] != $color) {
				// *** プレイヤー以外の色の駒があるなら *** //
				$cnt2++;
				$cnt1++;
			} else if ($this->_mMasuSts[$cnt2 + 1][$cnt1 + 1] == $color) {
				$flg = 1;
				break;
			} else if ($this->_mMasuSts[$cnt2 + 1][$cnt1 + 1] == ReversiConst::$REVERSI_STS_NONE) {
				break;
			}
		}
		if ($flg == 1) {
			// *** 駒をひっくり返す *** //
			for ($rcnt1 = $cnt2, $rcnt2 = $cnt1; ($rcnt1 > $y) && ($rcnt2 > $x); $rcnt1-- , $rcnt2--) {
				$this->_mMasuSts[$rcnt1][$rcnt2] = $color;
			}
		}
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			パラメーター範囲チェック
	///	@fn				checkPara($para, $min, $max)
	///	@param[in]		$para 	チェックパラメーター
	///	@param[in]		$min		パラメーター最小値
	///	@param[in]		$max		パラメーター最大値
	///	@return			0 : 成功 それ以外 : 失敗
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	private function checkPara($para, $min, $max)
	{
		$ret = -1;
		if ($min <= $para && $para <= $max) $ret = 0;
		return $ret;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			解析を行う(黒)
	///	@fn				AnalysisReversiBlack()
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	private function AnalysisReversiBlack()
	{
		$tmpX;
		$tmpY;
		$sum;
		$sumOwn;
		$tmpGoodPoint;
		$tmpBadPoint;
		$tmpD1;
		$tmpD2;
		for ($cnt = 0; $cnt < $this->_mMasuPointCntB; $cnt++) {
			// *** 現在ステータスを一旦コピー *** //
			$tmpMasu = array();
			$tmpMasuEnaB = array();
			$tmpMasuEnaW = array();
			$tmpMasu = $this->_mMasuSts;
			$tmpMasuEnaB = $this->_mMasuStsEnaB;
			$tmpMasuEnaW = $this->_mMasuStsEnaW;

			$tmpY = $this->_mMasuPointB[$cnt]->gety();
			$tmpX = $this->_mMasuPointB[$cnt]->getx();
			$this->_mMasuSts[$tmpY][$tmpX] = ReversiConst::$REVERSI_STS_BLACK;					// 仮に置く
			$this->revMasuSts(ReversiConst::$REVERSI_STS_BLACK, $tmpY, $tmpX);					// 仮にひっくり返す
			$this->makeMasuSts(ReversiConst::$REVERSI_STS_BLACK);
			$this->makeMasuSts(ReversiConst::$REVERSI_STS_WHITE);
			// *** このマスに置いた場合の解析を行う *** //
			if ($this->getColorEna(ReversiConst::$REVERSI_STS_WHITE) != 0) {					// 相手がパス
				$this->_mMasuStsPassB[$tmpY][$tmpX] = 1;
			}
			if ($this->getEdgeSideZero($tmpY, $tmpX) == 0) {									// 置いた場所が角
				$tmp = $this->_mMasuStsAnzB[$tmpY][$tmpX]->getOwnEdgeCnt();
				$this->_mMasuStsAnzB[$tmpY][$tmpX]->setOwnEdgeCnt($tmp++);
				$this->_mMasuStsAnzB[$tmpY][$tmpX]->setGoodPoint($this->_mMasuStsAnzB[$tmpY][$tmpX]->getGoodPoint() + (10000 * $this->_mMasuStsCntB[$tmpY][$tmpX]));
			} else if ($this->getEdgeSideOne($tmpY, $tmpX) == 0) {								// 置いた場所が角の一つ手前
				$tmp = $this->_mMasuStsAnzB[$tmpY][$tmpX]->getOwnEdgeSideOneCnt();
				$this->_mMasuStsAnzB[$tmpY][$tmpX]->setOwnEdgeSideOneCnt($tmp++);
				if ($this->checkEdge(ReversiConst::$REVERSI_STS_BLACK, $tmpY, $tmpX) != 0) {	// 角を取られない
					$this->_mMasuStsAnzB[$tmpY][$tmpX]->setGoodPoint($this->_mMasuStsAnzB[$tmpY][$tmpX]->getGoodPoint() + (10 * $this->_mMasuStsCntB[$tmpY][$tmpX]));
				} else {																		// 角を取られる
					$this->_mMasuStsAnzB[$tmpY][$tmpX]->setBadPoint($this->_mMasuStsAnzB[$tmpY][$tmpX]->getBadPoint() + 100000);
				}
			} else if ($this->getEdgeSideTwo($tmpY, $tmpX) == 0) {								// 置いた場所が角の二つ手前
				$tmp = $this->_mMasuStsAnzB[$tmpY][$tmpX]->getOwnEdgeSideTwoCnt();
				$this->_mMasuStsAnzB[$tmpY][$tmpX]->setOwnEdgeSideTwoCnt($tmp++);
				$this->_mMasuStsAnzB[$tmpY][$tmpX]->setGoodPoint($this->_mMasuStsAnzB[$tmpY][$tmpX]->getGoodPoint() + (1000 * $this->_mMasuStsCntB[$tmpY][$tmpX]));
			} else if ($this->getEdgeSideThree($tmpY, $tmpX) == 0) {							// 置いた場所が角の三つ手前
				$tmp = $this->_mMasuStsAnzB[$tmpY][$tmpX]->getOwnEdgeSideThreeCnt();
				$this->_mMasuStsAnzB[$tmpY][$tmpX]->setOwnEdgeSideThreeCnt($tmp++);
				$this->_mMasuStsAnzB[$tmpY][$tmpX]->setGoodPoint($this->_mMasuStsAnzB[$tmpY][$tmpX]->getGoodPoint() + (100 * $this->_mMasuStsCntB[$tmpY][$tmpX]));
			} else {																			// 置いた場所がその他
				$tmp = $this->_mMasuStsAnzB[$tmpY][$tmpX]->getOwnEdgeSideOtherCnt();
				$this->_mMasuStsAnzB[$tmpY][$tmpX]->setOwnEdgeSideOtherCnt($tmp++);
				$this->_mMasuStsAnzB[$tmpY][$tmpX]->setGoodPoint($this->_mMasuStsAnzB[$tmpY][$tmpX]->getGoodPoint() + (10 * $this->_mMasuStsCntB[$tmpY][$tmpX]));
			}
			$sum = 0;
			$sumOwn = 0;
			for ($i = 0; $i < $this->_mMasuCnt; $i++) {
				for ($j = 0; $j < $this->_mMasuCnt; $j++) {
					$tmpBadPoint = 0;
					$tmpGoodPoint = 0;
					if ($this->getMasuStsEna(ReversiConst::$REVERSI_STS_WHITE, $i, $j) != 0) {
						$sum += $this->_mMasuStsCntW[$i][$j];									// 相手の獲得予定枚数
						// *** 相手の獲得予定の最大数保持 *** //
						if ($this->_mMasuStsAnzB[$tmpY][$tmpX]->getMax() < $this->_mMasuStsCntW[$i][$j]) $this->_mMasuStsAnzB[$tmpY][$tmpX]->setMax($this->_mMasuStsCntW[$i][$j]);
						// *** 相手の獲得予定の最小数保持 *** //
						if ($this->_mMasuStsCntW[$i][$j] < $this->_mMasuStsAnzB[$tmpY][$tmpX]->getMin()) $this->_mMasuStsAnzB[$tmpY][$tmpX]->setMin($this->_mMasuStsCntW[$i][$j]);
						$tmp = $this->_mMasuStsAnzB[$tmpY][$tmpX]->getPointCnt();
						$this->_mMasuStsAnzB[$tmpY][$tmpX]->setPointCnt($tmp++);				// 相手の置ける場所の数
						if ($this->getEdgeSideZero($i, $j) == 0) {								// 置く場所が角
							$tmp = $this->_mMasuStsAnzB[$tmpY][$tmpX]->getEdgeCnt();
							$this->_mMasuStsAnzB[$tmpY][$tmpX]->setEdgeCnt($tmp++);
							$tmpBadPoint = 100000 * $this->_mMasuStsCntW[$i][$j];
						} else if ($this->getEdgeSideOne($i, $j) == 0) {						// 置く場所が角の一つ手前
							$tmp = $this->_mMasuStsAnzB[$tmpY][$tmpX]->getEdgeSideOneCnt();
							$this->_mMasuStsAnzB[$tmpY][$tmpX]->setEdgeSideOneCnt($tmp++);
							$tmpBadPoint = 0;
						} else if ($this->getEdgeSideTwo($i, $j) == 0) {						// 置く場所が角の二つ手前
							$tmp = $this->_mMasuStsAnzB[$tmpY][$tmpX]->getEdgeSideTwoCnt();
							$this->_mMasuStsAnzB[$tmpY][$tmpX]->getEdgeSideTwoCnt($tmp++);
							$tmpBadPoint = 1 * $this->_mMasuStsCntW[$i][$j];
						} else if ($this->getEdgeSideThree($i, $j) == 0) {						// 置く場所が角の三つ手前
							$tmp = $this->_mMasuStsAnzB[$tmpY][$tmpX]->getEdgeSideThreeCnt();
							$this->_mMasuStsAnzB[$tmpY][$tmpX]->setEdgeSideThreeCnt($tmp++);
							$tmpBadPoint = 1 * $this->_mMasuStsCntW[$i][$j];
						} else {																// 置く場所がその他
							$tmp = $this->_mMasuStsAnzB[$tmpY][$tmpX]->getEdgeSideOtherCnt();
							$this->_mMasuStsAnzB[$tmpY][$tmpX]->setEdgeSideOtherCnt($tmp++);
							$tmpBadPoint = 1 * $this->_mMasuStsCntW[$i][$j];
						}
						if ($tmpMasuEnaW[$i][$j] != 0) $tmpBadPoint = 0;						// ステータス変化していないなら
					}
					if ($this->getMasuStsEna(ReversiConst::$REVERSI_STS_BLACK, $i, $j) != 0) {
						$sumOwn += $this->_mMasuStsCntB[$i][$j];								// 自分の獲得予定枚数
						// *** 自分の獲得予定の最大数保持 *** //
						if ($this->_mMasuStsAnzB[$tmpY][$tmpX]->getOwnMax() < $this->_mMasuStsCntB[$i][$j]) $this->_mMasuStsAnzB[$tmpY][$tmpX]->setOwnMax($this->_mMasuStsCntB[$i][$j]);
						// *** 自分の獲得予定の最小数保持 *** //
						if ($this->_mMasuStsCntB[$i][$j] < $this->_mMasuStsAnzB[$tmpY][$tmpX]->getOwnMin()) $this->_mMasuStsAnzB[$tmpY][$tmpX]->setOwnMin($this->_mMasuStsCntB[$i][$j]);
						$tmp = $this->_mMasuStsAnzB[$tmpY][$tmpX]->getOwnPointCnt();
						$this->_mMasuStsAnzB[$tmpY][$tmpX]->setOwnPointCnt($tmp++);				// 自分の置ける場所の数
						if ($this->getEdgeSideZero($i, $j) == 0) {								// 置く場所が角
							$tmp = $this->_mMasuStsAnzB[$tmpY][$tmpX]->getOwnEdgeCnt();
							$this->_mMasuStsAnzB[$tmpY][$tmpX]->setOwnEdgeCnt($tmp++);
							$tmpGoodPoint = 100 * $this->_mMasuStsCntB[$i][$j];
						} else if ($this->getEdgeSideOne($i, $j) == 0) {						// 置く場所が角の一つ手前
							$tmp = $this->_mMasuStsAnzB[$tmpY][$tmpX]->getOwnEdgeSideOneCnt();
							$this->_mMasuStsAnzB[$tmpY][$tmpX]->setOwnEdgeSideOneCnt($tmp++);
							$tmpGoodPoint = 0;
						} else if ($this->getEdgeSideTwo($i, $j) == 0) {						// 置く場所が角の二つ手前
							$tmp = $this->_mMasuStsAnzB[$tmpY][$tmpX]->getOwnEdgeSideTwoCnt();
							$this->_mMasuStsAnzB[$tmpY][$tmpX]->setOwnEdgeSideTwoCnt($tmp++);
							$tmpGoodPoint = 3 * $this->_mMasuStsCntB[$i][$j];
						} else if ($this->getEdgeSideThree($i, $j) == 0) {						// 置く場所が角の三つ手前
							$tmp = $this->_mMasuStsAnzB[$tmpY][$tmpX]->getOwnEdgeSideThreeCnt();
							$this->_mMasuStsAnzB[$tmpY][$tmpX]->setOwnEdgeSideThreeCnt($tmp++);
							$tmpGoodPoint = 2 * $this->_mMasuStsCntB[$i][$j];
						} else {																// 置く場所がその他
							$tmp = $this->_mMasuStsAnzB[$tmpY][$tmpX]->getOwnEdgeSideOtherCnt();
							$this->_mMasuStsAnzB[$tmpY][$tmpX]->setOwnEdgeSideOtherCnt($tmp++);
							$tmpGoodPoint = 1 * $this->_mMasuStsCntB[$i][$j];
						}
						if ($tmpMasuEnaB[$i][$j] != 0) $tmpGoodPoint = 0;						// ステータス変化していないなら
					}
					if ($tmpBadPoint != 0) $this->_mMasuStsAnzB[$tmpY][$tmpX]->setBadPoint($this->_mMasuStsAnzB[$tmpY][$tmpX]->getBadPoint() + $tmpBadPoint);
					if ($tmpGoodPoint != 0) $this->_mMasuStsAnzB[$tmpY][$tmpX]->setGoodPoint($this->_mMasuStsAnzB[$tmpY][$tmpX]->getGoodPoint() + $tmpGoodPoint);
				}
			}
			// *** 相手に取られる平均コマ数 *** //
			if ($this->getPointCnt(ReversiConst::$REVERSI_STS_WHITE) != 0) {
				$tmpD1 = $sum;
				$tmpD2 = $this->getPointCnt(ReversiConst::$REVERSI_STS_WHITE);
				$this->_mMasuStsAnzB[$tmpY][$tmpX]->setAvg($tmpD1 / $tmpD2);
			}

			// *** 自分が取れる平均コマ数 *** //
			if ($this->getPointCnt(ReversiConst::$REVERSI_STS_BLACK) != 0) {
				$tmpD1 = $sumOwn;
				$tmpD2 = $this->getPointCnt(ReversiConst::$REVERSI_STS_BLACK);
				$this->_mMasuStsAnzB[$tmpY][$tmpX]->setOwnAvg($tmpD1 / $tmpD2);
			}

			// *** 元に戻す *** //
			$this->_mMasuSts = $tmpMasu;
			$this->makeMasuSts(ReversiConst::$REVERSI_STS_BLACK);
			$this->makeMasuSts(ReversiConst::$REVERSI_STS_WHITE);
		}
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			解析を行う(白)
	///	@fn				AnalysisReversiWhite()
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	private function AnalysisReversiWhite()
	{
		$tmpX;
		$tmpY;
		$sum;
		$sumOwn;
		$tmpGoodPoint;
		$tmpBadPoint;
		$tmpD1;
		$tmpD2;
		for ($cnt = 0; $cnt < $this->_mMasuPointCntW; $cnt++) {
			// *** 現在ステータスを一旦コピー *** //
			$tmpMasu = array();
			$tmpMasuEnaB = array();
			$tmpMasuEnaW = array();
			$tmpMasu = $this->_mMasuSts;
			$tmpMasuEnaB = $this->_mMasuStsEnaB;
			$tmpMasuEnaW = $this->_mMasuStsEnaW;

			$tmpY = $this->_mMasuPointW[$cnt]->gety();
			$tmpX = $this->_mMasuPointW[$cnt]->getx();
			$this->_mMasuSts[$tmpY][$tmpX] = ReversiConst::$REVERSI_STS_WHITE;			// 仮に置く
			$this->revMasuSts(ReversiConst::$REVERSI_STS_WHITE, $tmpY, $tmpX);			// 仮にひっくり返す
			$this->makeMasuSts(ReversiConst::$REVERSI_STS_BLACK);
			$this->makeMasuSts(ReversiConst::$REVERSI_STS_WHITE);
			// *** このマスに置いた場合の解析を行う *** //
			if ($this->getColorEna(ReversiConst::$REVERSI_STS_BLACK) != 0) {			// 相手がパス
				$this->_mMasuStsPassW[$tmpY][$tmpX] = 1;
			}
			if ($this->getEdgeSideZero($tmpY, $tmpX) == 0) {							// 置いた場所が角
				$tmp = $this->_mMasuStsAnzW[$tmpY][$tmpX]->getOwnEdgeCnt();
				$this->_mMasuStsAnzW[$tmpY][$tmpX]->setOwnEdgeCnt($tmp++);
				$this->_mMasuStsAnzW[$tmpY][$tmpX]->setGoodPoint($this->_mMasuStsAnzW[$tmpY][$tmpX]->getGoodPoint() + (10000 * $this->_mMasuStsCntW[$tmpY][$tmpX]));
			} else if ($this->getEdgeSideOne($tmpY, $tmpX) == 0) {						// 置いた場所が角の一つ手前
				$tmp = $this->_mMasuStsAnzW[$tmpY][$tmpX]->getOwnEdgeSideOneCnt();
				$this->_mMasuStsAnzW[$tmpY][$tmpX]->setOwnEdgeSideOneCnt($tmp++);
				if ($this->checkEdge(ReversiConst::$REVERSI_STS_WHITE, $tmpY, $tmpX) != 0) {	// 角を取られない
					$this->_mMasuStsAnzW[$tmpY][$tmpX]->setGoodPoint($this->_mMasuStsAnzW[$tmpY][$tmpX]->getGoodPoint() + (10 * $this->_mMasuStsCntW[$tmpY][$tmpX]));
				} else {																// 角を取られる
					$this->_mMasuStsAnzW[$tmpY][$tmpX]->setBadPoint($this->_mMasuStsAnzW[$tmpY][$tmpX]->getBadPoint() + 100000);
				}
			} else if ($this->getEdgeSideTwo($tmpY, $tmpX) == 0) {						// 置いた場所が角の二つ手前
				$tmp = $this->_mMasuStsAnzW[$tmpY][$tmpX]->getOwnEdgeSideTwoCnt();
				$this->_mMasuStsAnzW[$tmpY][$tmpX]->setOwnEdgeSideTwoCnt($tmp++);
				$this->_mMasuStsAnzW[$tmpY][$tmpX]->setGoodPoint($this->_mMasuStsAnzW[$tmpY][$tmpX]->getGoodPoint() + (1000 * $this->_mMasuStsCntW[$tmpY][$tmpX]));
			} else if ($this->getEdgeSideThree($tmpY, $tmpX) == 0) {					// 置いた場所が角の三つ手前
				$tmp = $this->_mMasuStsAnzW[$tmpY][$tmpX]->getOwnEdgeSideThreeCnt();
				$this->_mMasuStsAnzW[$tmpY][$tmpX]->setOwnEdgeSideThreeCnt($tmp++);
				$this->_mMasuStsAnzW[$tmpY][$tmpX]->setGoodPoint($this->_mMasuStsAnzW[$tmpY][$tmpX]->getgoodPoint() + (100 * $this->_mMasuStsCntW[$tmpY][$tmpX]));
			} else {																	// 置いた場所がその他
				$tmp = $this->_mMasuStsAnzW[$tmpY][$tmpX]->getOwnEdgeSideOtherCnt();
				$this->_mMasuStsAnzW[$tmpY][$tmpX]->setOwnEdgeSideOtherCnt($tmp++);
				$this->_mMasuStsAnzW[$tmpY][$tmpX]->setGoodPoint($this->_mMasuStsAnzW[$tmpY][$tmpX]->getGoodPoint() + (10 * $this->_mMasuStsCntW[$tmpY][$tmpX]));
			}
			$sum = 0;
			$sumOwn = 0;
			for ($i = 0; $i < $this->_mMasuCnt; $i++) {
				for ($j = 0; $j < $this->_mMasuCnt; $j++) {
					$tmpBadPoint = 0;
					$tmpGoodPoint = 0;
					if ($this->getMasuStsEna(ReversiConst::$REVERSI_STS_BLACK, $i, $j) != 0) {
						$sum += $this->_mMasuStsCntB[$i][$j];							// 相手の獲得予定枚数
						// *** 相手の獲得予定の最大数保持 *** //
						if ($this->_mMasuStsAnzW[$tmpY][$tmpX]->getMax() < $this->_mMasuStsCntB[$i][$j]) $this->_mMasuStsAnzW[$tmpY][$tmpX]->setMax($this->_mMasuStsCntB[$i][$j]);
						// *** 相手の獲得予定の最小数保持 *** //
						if ($this->_mMasuStsCntB[$i][$j] < $this->_mMasuStsAnzW[$tmpY][$tmpX]->getMin()) $this->_mMasuStsAnzW[$tmpY][$tmpX]->setMin($this->_mMasuStsCntB[$i][$j]);
						$tmp = $this->_mMasuStsAnzW[$tmpY][$tmpX]->getPointCnt();
						$this->_mMasuStsAnzW[$tmpY][$tmpX]->setPointCnt($tmp++);		// 相手の置ける場所の数
						if ($this->getEdgeSideZero($i, $j) == 0) {						// 置く場所が角
							$tmp = $this->_mMasuStsAnzW[$tmpY][$tmpX]->getEdgeCnt();
							$this->_mMasuStsAnzW[$tmpY][$tmpX]->setEdgeCnt($tmp++);
							$tmpBadPoint = 100000 * $this->_mMasuStsCntB[$i][$j];
						} else if ($this->getEdgeSideOne($i, $j) == 0) {				// 置く場所が角の一つ手前
							$tmp = $this->_mMasuStsAnzW[$tmpY][$tmpX]->getEdgeSideOneCnt();
							$this->_mMasuStsAnzW[$tmpY][$tmpX]->setEdgeSideOneCnt($tmp++);
							$tmpBadPoint = 0;
						} else if ($this->getEdgeSideTwo($i, $j) == 0) {				// 置く場所が角の二つ手前
							$tmp = $this->_mMasuStsAnzW[$tmpY][$tmpX]->getEdgeSideTwoCnt();
							$this->_mMasuStsAnzW[$tmpY][$tmpX]->setEdgeSideTwoCnt($tmp++);
							$tmpBadPoint = 1 * $this->_mMasuStsCntB[$i][$j];
						} else if ($this->getEdgeSideThree($i, $j) == 0) {				// 置く場所が角の三つ手前
							$tmp = $this->_mMasuStsAnzW[$tmpY][$tmpX]->getEdgeSideThreeCnt();
							$this->_mMasuStsAnzW[$tmpY][$tmpX]->setEdgeSideThreeCnt($tmp++);
							$tmpBadPoint = 1 * $this->_mMasuStsCntB[$i][$j];
						} else {														// 置く場所がその他
							$tmp = $this->_mMasuStsAnzW[$tmpY][$tmpX]->getEdgeSideOtherCnt();
							$this->_mMasuStsAnzW[$tmpY][$tmpX]->setEdgeSideOtherCnt($tmp++);
							$tmpBadPoint = 1 * $this->_mMasuStsCntB[$i][$j];
						}
						if ($tmpMasuEnaB[$i][$j] != 0) $tmpBadPoint = 0;				// ステータス変化していないなら
					}
					if ($this->getMasuStsEna(ReversiConst::$REVERSI_STS_WHITE, $i, $j) != 0) {
						$sumOwn += $this->_mMasuStsCntW[$i][$j];						// 自分の獲得予定枚数
						// *** 自分の獲得予定の最大数保持 *** //
						if ($this->_mMasuStsAnzW[$tmpY][$tmpX]->getOwnMax() < $this->_mMasuStsCntW[$i][$j]) $this->_mMasuStsAnzW[$tmpY][$tmpX]->setOwnMax($this->_mMasuStsCntW[$i][$j]);
						// *** 自分の獲得予定の最小数保持 *** //
						if ($this->_mMasuStsCntW[$i][$j] < $this->_mMasuStsAnzW[$tmpY][$tmpX]->getOwnMin()) $this->_mMasuStsAnzW[$tmpY][$tmpX]->setOwnMin($this->_mMasuStsCntW[$i][$j]);
						$tmp = $this->_mMasuStsAnzW[$tmpY][$tmpX]->getownPointCnt();
						$this->_mMasuStsAnzW[$tmpY][$tmpX]->setownPointCnt($tmp++);		// 自分の置ける場所の数
						if ($this->getEdgeSideZero($i, $j) == 0) {						// 置く場所が角
							$tmp = $this->_mMasuStsAnzW[$tmpY][$tmpX]->getOwnEdgeCnt();
							$this->_mMasuStsAnzW[$tmpY][$tmpX]->setOwnEdgeCnt($tmp++);
							$tmpGoodPoint = 100 * $this->_mMasuStsCntW[$i][$j];
						} else if ($this->getEdgeSideOne($i, $j) == 0) {				// 置く場所が角の一つ手前
							$tmp = $this->_mMasuStsAnzW[$tmpY][$tmpX]->getOwnEdgeSideOneCnt();
							$this->_mMasuStsAnzW[$tmpY][$tmpX]->setOwnEdgeSideOneCnt($tmp++);
							$tmpGoodPoint = 0;
						} else if ($this->getEdgeSideTwo($i, $j) == 0) {				// 置く場所が角の二つ手前
							$tmp = $this->_mMasuStsAnzW[$tmpY][$tmpX]->getOwnEdgeSideTwoCnt();
							$this->_mMasuStsAnzW[$tmpY][$tmpX]->setOwnEdgeSideTwoCnt($tmp++);
							$tmpGoodPoint = 3 * $this->_mMasuStsCntW[$i][$j];
						} else if ($this->getEdgeSideThree($i, $j) == 0) {				// 置く場所が角の三つ手前
							$tmp = $this->_mMasuStsAnzW[$tmpY][$tmpX]->getOwnEdgeSideThreeCnt();
							$this->_mMasuStsAnzW[$tmpY][$tmpX]->setOwnEdgeSideThreeCnt($tmp++);
							$tmpGoodPoint = 2 * $this->_mMasuStsCntW[$i][$j];
						} else {														// 置く場所がその他
							$tmp = $this->_mMasuStsAnzW[$tmpY][$tmpX]->getOwnEdgeSideOtherCnt();
							$this->_mMasuStsAnzW[$tmpY][$tmpX]->setOwnEdgeSideOtherCnt($tmp++);
							$tmpGoodPoint = 1 * $this->_mMasuStsCntW[$i][$j];
						}
						if ($tmpMasuEnaW[$i][$j] != 0) $tmpGoodPoint = 0;				// ステータス変化していないなら
					}
					if ($tmpBadPoint != 0) $this->_mMasuStsAnzW[$tmpY][$tmpX]->setBadPoint($this->_mMasuStsAnzW[$tmpY][$tmpX]->getBadPoint() + $tmpBadPoint);
					if ($tmpGoodPoint != 0) $this->_mMasuStsAnzW[$tmpY][$tmpX]->setGoodPoint($this->_mMasuStsAnzW[$tmpY][$tmpX]->getGoodPoint() + $tmpGoodPoint);
				}
			}
			// *** 相手に取られる平均コマ数 *** //
			if ($this->getPointCnt(ReversiConst::$REVERSI_STS_BLACK) != 0) {
				$tmpD1 = $sum;
				$tmpD2 = $this->getPointCnt(ReversiConst::$REVERSI_STS_BLACK);
				$this->_mMasuStsAnzW[$tmpY][$tmpX]->getAvg($tmpD1 / $tmpD2);
			}

			// *** 自分が取れる平均コマ数 *** //
			if ($this->getPointCnt(ReversiConst::$REVERSI_STS_WHITE) != 0) {
				$tmpD1 = $sumOwn;
				$tmpD2 = $this->getPointCnt(ReversiConst::$REVERSI_STS_WHITE);
				$this->_mMasuStsAnzW[$tmpY][$tmpX]->getOwnAvg($tmpD1 / $tmpD2);
			}

			// *** 元に戻す *** //
			$this->_mMasuSts = $tmpMasu;
			$this->makeMasuSts(ReversiConst::$REVERSI_STS_BLACK);
			$this->makeMasuSts(ReversiConst::$REVERSI_STS_WHITE);
		}
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			解析を行う
	///	@fn				void AnalysisReversi($bPassEna, $wPassEna)
	///	@param[in]		$bPassEna		1=黒パス有効
	///	@param[in]		$wPassEna		1=白パス有効
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function AnalysisReversi($bPassEna, $wPassEna)
	{
		// *** 相手をパスさせることができるマス検索 *** //
		for ($i = 0; $i < $this->_mMasuCnt; $i++) {					// 初期化
			for ($j = 0; $j < $this->_mMasuCnt; $j++) {
				$this->_mMasuStsPassB[$i][$j] = 0;
				$this->_mMasuStsAnzB[$i][$j]->reset();
				$this->_mMasuStsPassW[$i][$j] = 0;
				$this->_mMasuStsAnzW[$i][$j]->reset();
			}
		}
		$this->AnalysisReversiBlack();								// 黒解析
		$this->AnalysisReversiWhite();								// 白解析

		$this->makeMasuSts(ReversiConst::$REVERSI_STS_BLACK);
		$this->makeMasuSts(ReversiConst::$REVERSI_STS_WHITE);

		// *** パスマスを取得 *** //
		for ($i = 0; $i < $this->_mMasuCnt; $i++) {
			for ($j = 0; $j < $this->_mMasuCnt; $j++) {
				if ($this->_mMasuStsPassB[$i][$j] != 0) {
					if ($bPassEna != 0) $this->_mMasuStsEnaB[$i][$j] = 3;
				}
				if ($this->_mMasuStsPassW[$i][$j] != 0) {
					if ($wPassEna != 0) $this->_mMasuStsEnaW[$i][$j] = 3;
				}
			}
		}
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			マスステータスを取得
	///	@fn				getMasuSts($y, $x)
	///	@param[in]		$y			取得するマスのY座標
	///	@param[in]		$x			取得するマスのX座標
	///	@return			-1 : 失敗 それ以外 : マスステータス
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function getMasuSts($y, $x)
	{
		$ret = -1;
		if ($this->checkPara($y, 0, $this->_mMasuCnt) == 0 && $this->checkPara($x, 0, $this->_mMasuCnt) == 0) $ret = $this->_mMasuSts[$y][$x];
		return $ret;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			以前のマスステータスを取得
	///	@fn				getMasuStsOld($y, $x)
	///	@param[in]		y			取得するマスのY座標
	///	@param[in]		x			取得するマスのX座標
	///	@return			-1 : 失敗 それ以外 : マスステータス
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function getMasuStsOld($y, $x)
	{
		$ret = -1;
		if ($this->checkPara($y, 0, $this->_mMasuCnt) == 0 && $this->checkPara($x, 0, $this->_mMasuCnt) == 0) $ret = $this->_mMasuStsOld[$y][$x];
		return $ret;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			指定座標に指定色を置けるかチェック
	///	@fn				getMasuStsEna($color, $y, $x)
	///	@param[in]		$color		コマ色
	///	@param[in]		$y			マスの$y座標
	///	@param[in]		$x			マスの$x座標
	///	@return			1 : 成功 それ以外 : 失敗
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function getMasuStsEna($color, $y, $x)
	{
		$ret = 0;
		if ($this->checkPara($y, 0, $this->_mMasuCnt) == 0 && $this->checkPara($x, 0, $this->_mMasuCnt) == 0) {
			if ($color == ReversiConst::$REVERSI_STS_BLACK) $ret = $this->_mMasuStsEnaB[$y][$x];
			else $ret = $this->_mMasuStsEnaW[$y][$x];
		}
		return $ret;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			指定座標の獲得コマ数取得
	///	@fn				getMasuStsCnt($color, $y, $x)
	///	@param[in]		$color		コマ色
	///	@param[in]		$y			マスの$y座標
	///	@param[in]		$x			マスの$x座標
	///	@return			-1 : 失敗 それ以外 : 獲得コマ数
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function getMasuStsCnt($color, $y, $x)
	{
		$ret = -1;
		if ($this->checkPara($y, 0, $this->_mMasuCnt) == 0 && $this->checkPara($x, 0, $this->_mMasuCnt) == 0) {
			if ($color == ReversiConst::$REVERSI_STS_BLACK) $ret = $this->_mMasuStsCntB[$y][$x];
			else $ret = $this->_mMasuStsCntW[$y][$x];
		}
		return $ret;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			指定色が現在置ける場所があるかチェック
	///	@fn				getColorEna($color)
	///	@param[in]		$color		コマ色
	///	@return			0 : 成功 それ以外 : 失敗
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function getColorEna($color)
	{
		$ret = -1;
		for ($i = 0; $i < $this->_mMasuCnt; $i++) {
			for ($j = 0; $j < $this->_mMasuCnt; $j++) {
				if ($this->getMasuStsEna($color, $i, $j) != 0) {
					$ret = 0;
					break;
				}
			}
		}
		return $ret;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			ゲーム終了かチェック
	///	@fn				getGameEndSts()
	///	@return			0 : 続行 それ以外 : ゲーム終了
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function getGameEndSts()
	{
		$ret = 1;
		if ($this->getColorEna(ReversiConst::$REVERSI_STS_BLACK) == 0) $ret = 0;
		if ($this->getColorEna(ReversiConst::$REVERSI_STS_WHITE) == 0) $ret = 0;
		return $ret;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			指定座標にコマを置く
	///	@fn				setMasuSts($color, $y, $x)
	///	@param[in]		$color		コマ色
	///	@param[in]		$y			マスの$y座標
	///	@param[in]		$x			マスの$x座標
	///	@return			0 : 成功 それ以外 : 失敗
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function setMasuSts($color, $y, $x)
	{
		$ret = -1;
		if ($this->getMasuStsEna($color, $y, $x) != 0) {
			$ret = 0;
			$this->_mMasuStsOld = $this->_mMasuSts;
			$this->_mMasuSts[$y][$x] = $color;
			$this->revMasuSts($color, $y, $x);
			$this->makeMasuSts(ReversiConst::$REVERSI_STS_BLACK);
			$this->makeMasuSts(ReversiConst::$REVERSI_STS_WHITE);
			// *** 履歴保存 *** //
			if ($this->_mMasuHistCur < ($this->_mMasuCntMax * $this->_mMasuCntMax)) {
				$this->_mMasuHist[$this->_mMasuHistCur]->setColor($color);
				$this->_mMasuHist[$this->_mMasuHistCur]->getPoint()->sety($y);
				$this->_mMasuHist[$this->_mMasuHistCur]->getPoint()->setx($x);
				$this->_mMasuHistCur++;
			}
		}
		return $ret;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			指定座標にコマを強制的に置く
	///	@fn				setMasuStsForcibly($color, $y, $x)
	///	@param[in]		$color		コマ色
	///	@param[in]		$y			マスの$y座標
	///	@param[in]		$x			マスの$x座標
	///	@return			0 : 成功 それ以外 : 失敗
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function setMasuStsForcibly($color, $y, $x)
	{
		$ret = 0;
		$this->_mMasuStsOld = $this->_mMasuSts;
		$this->_mMasuSts[$y][$x] = $color;
		return $ret;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			マスの数変更
	///	@fn				setMasuCnt($cnt)
	///	@param[in]		$cnt		マスの数
	///	@return			0 : 成功 それ以外 : 失敗
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function setMasuCnt($cnt)
	{
		$ret = -1;
		$chg = 0;

		if ($this->checkPara($cnt, 0, $this->_mMasuCntMax) == 0) {
			if ($this->_mMasuCnt != $cnt) $chg = 1;
			$this->_mMasuCnt = $cnt;
			$ret = 0;
			if ($chg == 1) $this->reset();
		}

		return $ret;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			ポイント座標取得
	///	@fn				getPoint($color, $num)
	///	@param[in]		$color		コマ色
	///	@param[in]		$num			ポイント
	///	@return			ポイント座標 NULL : 失敗
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function getPoint($color, $num)
	{
		$ret = NULL;
		if ($this->checkPara($num, 0, ($this->_mMasuCnt * $this->_mMasuCnt)) == 0) {
			if ($color == ReversiConst::$REVERSI_STS_BLACK) $ret = $this->_mMasuPointB[$num];
			else $ret = $this->_mMasuPointW[$num];
		}
		return $ret;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			ポイント座標数取得
	///	@fn				getPointCnt($color)
	///	@param[in]		$color		コマ色
	///	@return			ポイント座標数取得
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function getPointCnt($color)
	{
		$ret = 0;
		if ($color == ReversiConst::$REVERSI_STS_BLACK) $ret = $this->_mMasuPointCntB;
		else $ret = $this->_mMasuPointCntW;
		return $ret;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			コマ数取得
	///	@fn				getBetCnt($color)
	///	@param[in]		$color		コマ色
	///	@return			コマ数取得
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function getBetCnt($color)
	{
		$ret = 0;
		if ($color == ReversiConst::$REVERSI_STS_BLACK) $ret = $this->_mMasuBetCntB;
		else $ret = $this->_mMasuBetCntW;
		return $ret;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			パス判定
	///	@fn				getPassEna($color, $y, $x)
	///	@param[in]		$color		コマ色
	///	@param[in]		$y			マスのY座標
	///	@param[in]		$x			マスのX座標
	///	@return			パス判定
	///					- 0 : NOT PASS
	///					- 1 : PASS
	///
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function getPassEna($color, $y, $x)
	{
		$ret = 0;
		if ($this->checkPara($y, 0, $this->_mMasuCnt) == 0 && $this->checkPara($x, 0, $this->_mMasuCnt) == 0) {
			if ($color == ReversiConst::$REVERSI_STS_BLACK) $ret = $this->_mMasuStsPassB[$y][$x];
			else $ret = $this->_mMasuStsPassW[$y][$x];
		}
		return $ret;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			履歴取得
	///	@fn				getHistory($num)
	///	@param[in]		$num		ポイント
	///	@return			履歴 NULL : 失敗
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function getHistory($num)
	{
		$ret = NULL;
		if ($this->checkPara($num, 0, ($this->_mMasuCnt * $this->_mMasuCnt)) == 0) {
			$ret = $this->_mMasuHist[$num];
		}
		return $ret;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			履歴数取得
	///	@fn				getHistoryCnt()
	///	@return			履歴数
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function getHistoryCnt()
	{
		$ret = 0;
		$ret = $this->_mMasuHistCur;
		return $ret;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			ポイント座標解析取得
	///	@fn				getPointAnz($color, $y, $x)
	///	@param[in]		$color		コマ色
	///	@param[in]		$y			マスの$y座標
	///	@param[in]		$x			マスの$x座標
	///	@return			ポイント座標解析 NULL : 失敗
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function getPointAnz($color, $y, $x)
	{
		$ret = NULL;
		if ($this->checkPara($y, 0, $this->_mMasuCnt) == 0 && $this->checkPara($x, 0, $this->_mMasuCnt) == 0) {
			if ($color == ReversiConst::$REVERSI_STS_BLACK) $ret = $this->_mMasuStsAnzB[$y][$x];
			else $ret = $this->_mMasuStsAnzW[$y][$x];
		}
		return $ret;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			角の隣に置いても角を取られないマス検索
	///	@fn				checkEdge($color, $y, $x)
	///	@param[in]		$color		コマ色
	///	@param[in]		$y			マスの$y座標
	///	@param[in]		$x			マスの$x座標
	///	@return			0 : 取られる それ以外 : 取られない
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function checkEdge($color, $y, $x)
	{
		$style = 0;
		$flg1 = 0;
		$flg2 = 0;
		$loop;
		$loop2;

		if ($y == 0 && $x == 1) {
			for ($loop = $x, $flg1 = 0, $flg2 = 0; $loop < $this->_mMasuCnt; $loop++) {
				if ($this->getMasuSts($y, $loop) == $color) $flg1 = 1;
				if ($flg1 == 1 && $this->getMasuSts($y, $loop) == ReversiConst::$REVERSI_STS_NONE) break;
				if (($flg1 == 1) && ($this->getMasuSts($y, $loop) != $color) && ($this->getMasuSts($y, $loop) != ReversiConst::$REVERSI_STS_NONE)) $flg2 = 1;
			}
			if (($flg1 == 1) && ($flg2 == 0)) $style = 1;
		}
		if ($y == 1 && $x == 0) {
			for ($loop = $y, $flg1 = 0, $flg2 = 0; $loop < $this->_mMasuCnt; $loop++) {
				if ($this->getMasuSts($loop, $x) == $color) $flg1 = 1;
				if ($flg1 == 1 && $this->getMasuSts($loop, $x) == ReversiConst::$REVERSI_STS_NONE) break;
				if (($flg1 == 1) && ($this->getMasuSts($loop, $x) != $color) && ($this->getMasuSts($loop, $x) != ReversiConst::$REVERSI_STS_NONE)) $flg2 = 1;
			}
			if (($flg1 == 1) && ($flg2 == 0)) $style = 1;
		}
		if ($y == 1 && $x == 1) {
			for ($loop = $y, $flg1 = 0, $flg2 = 0; $loop < $this->_mMasuCnt; $loop++) {
				if ($this->getMasuSts($loop, $loop) == $color) $flg1 = 1;
				if ($flg1 == 1 && $this->getMasuSts($loop, $loop) == ReversiConst::$REVERSI_STS_NONE) break;
				if (($flg1 == 1) && ($this->getMasuSts($loop, $loop) != $color) && ($this->getMasuSts($loop, $loop) != ReversiConst::$REVERSI_STS_NONE)) $flg2 = 1;
			}
			if (($flg1 == 1) && ($flg2 == 0)) $style = 1;
		}
		if ($y == 0 && $x == ($this->_mMasuCnt - 2)) {
			for ($loop = $x, $flg1 = 0, $flg2 = 0; $loop > 0; $loop--) {
				if ($this->getMasuSts($y, $loop) == $color) $flg1 = 1;
				if ($flg1 == 1 && $this->getMasuSts($y, $loop) == ReversiConst::$REVERSI_STS_NONE) break;
				if (($flg1 == 1) && ($this->getMasuSts($y, $loop) != $color) && ($this->getMasuSts($y, $loop) != ReversiConst::$REVERSI_STS_NONE)) $flg2 = 1;
			}
			if (($flg1 == 1) && ($flg2 == 0)) $style = 1;
		}
		if ($y == 1 && $x == ($this->_mMasuCnt - 1)) {
			for ($loop = $y, $flg1 = 0, $flg2 = 0; $loop < $this->_mMasuCnt; $loop++) {
				if ($this->getMasuSts($loop, $x) == $color) $flg1 = 1;
				if ($flg1 == 1 && $this->getMasuSts($loop, $x) == ReversiConst::$REVERSI_STS_NONE) break;
				if (($flg1 == 1) && ($this->getMasuSts($loop, $x) != $color) && ($this->getMasuSts($loop, $x) != ReversiConst::$REVERSI_STS_NONE)) $flg2 = 1;
			}
			if (($flg1 == 1) && ($flg2 == 0)) $style = 1;
		}
		if ($y == 1 && $x == ($this->_mMasuCnt - 2)) {
			for ($loop = $y, $loop2 = $x, $flg1 = 0, $flg2 = 0; $loop < $this->_mMasuCnt; $loop++ , $loop2--) {
				if ($this->getMasuSts($loop, $loop2) == $color) $flg1 = 1;
				if ($flg1 == 1 && $this->getMasuSts($loop, $loop2) == ReversiConst::$REVERSI_STS_NONE) break;
				if (($flg1 == 1) && ($this->getMasuSts($loop, $loop2) != $color) && ($this->getMasuSts($loop, $loop2) != ReversiConst::$REVERSI_STS_NONE)) $flg2 = 1;
			}
			if (($flg1 == 1) && ($flg2 == 0)) $style = 1;
		}
		if ($y == ($this->_mMasuCnt - 2) && $x == 0) {
			for ($loop = $y, $flg1 = 0, $flg2 = 0; $loop > 0; $loop--) {
				if ($this->getMasuSts($loop, $x) == $color) $flg1 = 1;
				if ($flg1 == 1 && $this->getMasuSts($loop, $x) == ReversiConst::$REVERSI_STS_NONE) break;
				if (($flg1 == 1) && ($this->getMasuSts($loop, $x) != $color) && ($this->getMasuSts($loop, $x) != ReversiConst::$REVERSI_STS_NONE)) $flg2 = 1;
			}
			if (($flg1 == 1) && ($flg2 == 0)) $style = 1;
		}
		if ($y == ($this->_mMasuCnt - 1) && $x == 1) {
			for ($loop = $x, $flg1 = 0, $flg2 = 0; $loop < $this->_mMasuCnt; $loop++) {
				if ($this->getMasuSts($y, $loop) == $color) $flg1 = 1;
				if ($flg1 == 1 && $this->getMasuSts($y, $loop) == ReversiConst::$REVERSI_STS_NONE) break;
				if (($flg1 == 1) && ($this->getMasuSts($y, $loop) != $color) && ($this->getMasuSts($y, $loop) != ReversiConst::$REVERSI_STS_NONE)) $flg2 = 1;
			}
			if (($flg1 == 1) && ($flg2 == 0)) $style = 1;
		}
		if ($y == ($this->_mMasuCnt - 2) && $x == 1) {
			for ($loop = $y, $loop2 = $x, $flg1 = 0, $flg2 = 0; $loop > 0; $loop-- , $loop2++) {
				if ($this->getMasuSts($loop, $loop2) == $color) $flg1 = 1;
				if ($flg1 == 1 && $this->getMasuSts($loop, $loop2) == ReversiConst::$REVERSI_STS_NONE) break;
				if (($flg1 == 1) && ($this->getMasuSts($loop, $loop2) != $color) && ($this->getMasuSts($loop, $loop2) != ReversiConst::$REVERSI_STS_NONE)) $flg2 = 1;
			}
			if (($flg1 == 1) && ($flg2 == 0)) $style = 1;
		}
		if ($y == ($this->_mMasuCnt - 2) && $x == ($this->_mMasuCnt - 1)) {
			for ($loop = $y, $flg1 = 0, $flg2 = 0; $loop > 0; $loop--) {
				if ($this->getMasuSts($loop, $x) == $color) $flg1 = 1;
				if ($flg1 == 1 && $this->getMasuSts($loop, $x) == ReversiConst::$REVERSI_STS_NONE) break;
				if (($flg1 == 1) && ($this->getMasuSts($loop, $x) != $color) && ($this->getMasuSts($loop, $x) != ReversiConst::$REVERSI_STS_NONE)) $flg2 = 1;
			}
			if (($flg1 == 1) && ($flg2 == 0)) $style = 1;
		}
		if ($y == ($this->_mMasuCnt - 1) && $x == ($this->_mMasuCnt - 2)) {
			for ($loop = $x, $flg1 = 0, $flg2 = 0; $loop > 0; $loop--) {
				if ($this->getMasuSts($y, $loop) == $color) $flg1 = 1;
				if ($flg1 == 1 && $this->getMasuSts($y, $loop) == ReversiConst::$REVERSI_STS_NONE) break;
				if (($flg1 == 1) && ($this->getMasuSts($y, $loop) != $color) && ($this->getMasuSts($y, $loop) != ReversiConst::$REVERSI_STS_NONE)) $flg2 = 1;
			}
			if (($flg1 == 1) && ($flg2 == 0)) $style = 1;
		}
		if ($y == ($this->_mMasuCnt - 2) && $x == ($this->_mMasuCnt - 2)) {
			for ($loop = $y, $loop2 = $x, $flg1 = 0, $flg2 = 0; $loop > 0; $loop-- , $loop2--) {
				if ($this->getMasuSts($loop, $loop2) == $color) $flg1 = 1;
				if ($flg1 == 1 && $this->getMasuSts($loop, $loop2) == ReversiConst::$REVERSI_STS_NONE) break;
				if (($flg1 == 1) && ($this->getMasuSts($loop, $loop2) != $color) && ($this->getMasuSts($loop, $loop2) != ReversiConst::$REVERSI_STS_NONE)) $flg2 = 1;
			}
			if (($flg1 == 1) && ($flg2 == 0)) $style = 1;
		}

		return $style;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			指定座標が角か取得
	///	@fn				getEdgeSideZero($y, $x)
	///	@param[in]		$y			$y座標
	///	@param[in]		$x			$x座標
	///	@return			0 : 成功 それ以外 : 失敗
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function getEdgeSideZero($y, $x)
	{
		$ret = -1;
		if (
			($y == 0 && $x == 0)
			|| ($y == 0 && $x == ($this->_mMasuCnt - 1))
			|| ($y == ($this->_mMasuCnt - 1) && $x == 0)
			|| ($y == ($this->_mMasuCnt - 1) && $x == ($this->_mMasuCnt - 1))
		) {
			$ret = 0;
		}
		return $ret;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			指定座標が角の一つ手前か取得
	///	@fn				getEdgeSideOne($y, $x)
	///	@param[in]		$y			$y座標
	///	@param[in]		$x			$x座標
	///	@return			0 : 成功 それ以外 : 失敗
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function getEdgeSideOne($y, $x)
	{
		$ret = -1;
		if (
			($y == 0 && $x == 1)
			|| ($y == 0 && $x == ($this->_mMasuCnt - 2))
			|| ($y == 1 && $x == 0)
			|| ($y == 1 && $x == 1)
			|| ($y == 1 && $x == ($this->_mMasuCnt - 2))
			|| ($y == 1 && $x == ($this->_mMasuCnt - 1))
			|| ($y == ($this->_mMasuCnt - 2) && $x == 0)
			|| ($y == ($this->_mMasuCnt - 2) && $x == 1)
			|| ($y == ($this->_mMasuCnt - 2) && $x == ($this->_mMasuCnt - 2))
			|| ($y == ($this->_mMasuCnt - 2) && $x == ($this->_mMasuCnt - 1))
			|| ($y == ($this->_mMasuCnt - 1) && $x == 1)
			|| ($y == ($this->_mMasuCnt - 1) && $x == ($this->_mMasuCnt - 2))
		) {
			$ret = 0;
		}
		return $ret;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			指定座標が角の二つ手前か取得
	///	@fn				getEdgeSideTwo($y, $x)
	///	@param[in]		$y			$y座標
	///	@param[in]		$x			$x座標
	///	@return			0 : 成功 それ以外 : 失敗
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function getEdgeSideTwo($y, $x)
	{
		$ret = -1;
		if (
			($y == 0 && $x == 2)
			|| ($y == 0 && $x == ($this->_mMasuCnt - 3))
			|| ($y == 2 && $x == 0)
			|| ($y == 2 && $x == 2)
			|| ($y == 2 && $x == ($this->_mMasuCnt - 3))
			|| ($y == 2 && $x == ($this->_mMasuCnt - 1))
			|| ($y == ($this->_mMasuCnt - 3) && $x == 0)
			|| ($y == ($this->_mMasuCnt - 3) && $x == 2)
			|| ($y == ($this->_mMasuCnt - 3) && $x == ($this->_mMasuCnt - 3))
			|| ($y == ($this->_mMasuCnt - 3) && $x == ($this->_mMasuCnt - 1))
			|| ($y == ($this->_mMasuCnt - 1) && $x == 2)
			|| ($y == ($this->_mMasuCnt - 1) && $x == ($this->_mMasuCnt - 3))
		) {
			$ret = 0;
		}
		return $ret;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			指定座標が角の三つ以上手前か取得
	///	@fn				getEdgeSideThree($y, $x)
	///	@param[in]		$y			$y座標
	///	@param[in]		$x			$x座標
	///	@return			0 : 成功 それ以外 : 失敗
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function getEdgeSideThree($y, $x)
	{
		$ret = -1;
		if (
			($y == 0 && (3 <= $x && $x <= ($this->_mMasuCnt - 4)))
			|| ((3 <= $y && $y <= ($this->_mMasuCnt - 4)) && $x == 0)
			|| ($y == ($this->_mMasuCnt - 1) && (3 <= $x && $x <= ($this->_mMasuCnt - 4)))
			|| ((3 <= $y && $y <= ($this->_mMasuCnt - 4)) && $x == ($this->_mMasuCnt - 1))
		) {
			$ret = 0;
		}
		return $ret;
	}
}

?>
