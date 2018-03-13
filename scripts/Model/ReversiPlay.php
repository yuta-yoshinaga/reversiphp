<?php

////////////////////////////////////////////////////////////////////////////////
///	@file			ReversiPlay.php
///	@brief			リバーシプレイクラス実装ファイル
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

require_once("Reversi.php");
require_once("Delegate.php");
require_once("ReversiSetting.php");

////////////////////////////////////////////////////////////////////////////////
///	@class		ReversiPlay
///	@brief		リバーシプレイクラス
///
////////////////////////////////////////////////////////////////////////////////
class ReversiPlay
{
	// #region メンバ変数
	private $_mReversi;										//!< リバーシクラス
	private $_mSetting;										//!< リバーシ設定クラス
	private $_mCurColor;									//!< 現在の色
	private $_mCpu;											//!< CPU用ワーク
	private $_mEdge;										//!< CPU用角マスワーク
	private $_mPassEnaB;									//!< 黒のパス有効フラグ
	private $_mPassEnaW;									//!< 白のパス有効フラグ
	private $_mGameEndSts;									//!< ゲーム終了ステータス
	private $_mPlayLock;									//!< プレイロック
	private $_viewMsgDlg;									//!< メッセージコールバック
	private $_drawSingle;									//!< 描画コールバック
	private $_curColMsg;									//!< 現在の色メッセージコールバック
	private $_curStsMsg;									//!< 現在のステータスメッセージコールバック
	// #endregion

	// #region プロパティ
	public function getmReversi(){ return $this->_mReversi; }
	public function setmReversi($_mReversi){ $this->_mReversi = $_mReversi; }

	public function getmSetting(){ return $this->_mSetting; }
	public function setmSetting($_mSetting){ $this->_mSetting = $_mSetting; }

	public function getmCurColor(){ return $this->_mCurColor; }
	public function setmCurColor($_mCurColor){ $this->_mCurColor = $_mCurColor; }

	public function getmCpu(){ return $this->_mCpu; }
	public function setmCpu($_mCpu){ $this->_mCpu = $_mCpu; }

	public function getmEdge(){ return $this->_mEdge; }
	public function setmEdge($_mEdge){ $this->_mEdge = $_mEdge; }

	public function getmPassEnaB(){ return $this->_mPassEnaB; }
	public function setmPassEnaB($_mPassEnaB){ $this->_mPassEnaB = $_mPassEnaB; }

	public function getmPassEnaW(){ return $this->_mPassEnaW; }
	public function setmPassEnaW($_mPassEnaW){ $this->_mPassEnaW = $_mPassEnaW; }

	public function getmGameEndSts(){ return $this->_mGameEndSts; }
	public function setmGameEndSts($_mGameEndSts){ $this->_mGameEndSts = $_mGameEndSts; }

	public function getmPlayLock(){ return $this->_mPlayLock; }
	public function setmPlayLock($_mPlayLock){ $this->_mPlayLock = $_mPlayLock; }

	public function getViewMsgDlg(){ return $this->_viewMsgDlg; }
	public function setViewMsgDlg($_viewMsgDlg){ $this->_viewMsgDlg = $_viewMsgDlg; }

	public function getDrawSingle(){ return $this->_drawSingle; }
	public function setDrawSingle($_drawSingle){ $this->_drawSingle = $_drawSingle; }

	public function getCurColMsg(){ return $this->_curColMsg; }
	public function setCurColMsg($_curColMsg){ $this->_curColMsg = $_curColMsg; }

	public function getCurStsMsg(){ return $this->_curStsMsg; }
	public function setCurStsMsg($_curStsMsg){ $this->_curStsMsg = $_curStsMsg; }
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
		$this->_mCurColor		= 0;
		$this->_mPassEnaB		= 0;
		$this->_mPassEnaW		= 0;
		$this->_mGameEndSts		= 0;
		$this->_mPlayLock		= 0;

		$this->_viewMsgDlg		= new Delegate();
		$callback1				= function($title , $msg){};
		$this->_viewMsgDlg->add($callback1);

		$this->_drawSingle		= new Delegate();
		$callback2				= function($y, $x, $sts, $bk, $text){};
		$this->_drawSingle->add($callback2);

		$this->_curColMsg		= new Delegate();
		$callback3				= function($text){};
		$this->_curColMsg->add($callback3);

		$this->_curStsMsg		= new Delegate();
		$callback4				= function($text){};
		$this->_curStsMsg->add($callback4);

		$this->_mReversi		= new Reversi(ReversiConst::$DEF_MASU_CNT_MAX_VAL, ReversiConst::$DEF_MASU_CNT_MAX_VAL);
		$this->_mSetting		= new ReversiSetting();
		$this->_mCpu			= array();
		$this->_mEdge			= array();
		for ($i = 0; $i < (ReversiConst::$DEF_MASU_CNT_MAX_VAL * ReversiConst::$DEF_MASU_CNT_MAX_VAL); $i++) {
			$this->_mCpu[$i]	= new ReversiPoint();
			$this->_mEdge[$i]	= new ReversiPoint();
		}
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
	///	@brief			シリアライズ
	///	@fn				__sleep()
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function __sleep()
	{
		return array(
			'_mReversi'
			,'_mSetting'
			,'_mCurColor'
			,'_mCpu'
			,'_mEdge'
			,'_mPassEnaB'
			,'_mPassEnaW'
			,'_mGameEndSts'
			,'_mPlayLock'
		);
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			リバーシプレイ
	///	@fn				reversiPlay($y, $x)
	///	@param[in]		$y			$y座標
	///	@param[in]		$x			$x座標
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function reversiPlay($y, $x)
	{
		$update = 0;
		$cpuEna = 0;
		$tmpCol = $this->_mCurColor;
		$pass = 0;

		if($this->_mPlayLock == 1) return;
		$this->_mPlayLock = 1;
		if ($this->_mReversi->getColorEna($this->_mCurColor) == 0) {
			if ($this->_mReversi->setMasuSts($this->_mCurColor, $y, $x) == 0) {
				if ($this->_mSetting->mType == ReversiConst::$DEF_TYPE_HARD) $this->_mReversi->AnalysisReversi($this->_mPassEnaB, $this->_mPassEnaW);
				if ($this->_mSetting->mAssist == ReversiConst::$DEF_ASSIST_ON) {
					// *** メッセージ送信 *** //
					$this->execMessage(ReversiConst::$LC_MSG_ERASE_INFO_ALL, NULL);
				}
				$this->sendDrawMsg($y, $x);													// 描画
				$this->drawUpdate(ReversiConst::$DEF_ASSIST_OFF);							// その他コマ描画
				if ($this->_mReversi->getGameEndSts() == 0) {
					if ($tmpCol == ReversiConst::$REVERSI_STS_BLACK) $tmpCol = ReversiConst::$REVERSI_STS_WHITE;
					else $tmpCol = ReversiConst::$REVERSI_STS_BLACK;
					if ($this->_mReversi->getColorEna($tmpCol) == 0) {
						if ($this->_mSetting->getmMode() == ReversiConst::$DEF_MODE_ONE) {	// CPU対戦
							$cpuEna = 1;
						} else {															// 二人対戦
							$this->_mCurColor = $tmpCol;
							$this->drawUpdate($this->_mSetting->getmAssist());				// 次のプレイヤーコマ描画
						}
					} else {
						// *** パスメッセージ *** //
						$this->reversiPlayPass($tmpCol);
						$pass = 1;
					}
				} else {
					// *** ゲーム終了メッセージ *** //
					$this->reversiPlayEnd();
				}
				$update = 1;
			} else {
				// *** エラーメッセージ *** //
				$this->ViewMsgDlgLocal("エラー", "そのマスには置けません。");
			}
		} else {
			if ($this->_mReversi->getGameEndSts() == 0) {
				if ($tmpCol == ReversiConst::$REVERSI_STS_BLACK) $tmpCol = ReversiConst::$REVERSI_STS_WHITE;
				else $tmpCol = ReversiConst::$REVERSI_STS_BLACK;
				if ($this->_mReversi->getColorEna($tmpCol) == 0) {
					if ($this->_mSetting->getmMode() == ReversiConst::$DEF_MODE_ONE) {		// CPU対戦
						$update = 1;
						$cpuEna = 1;
					} else {																// 二人対戦
						$this->_mCurColor = $tmpCol;
					}
				} else {
					// *** パスメッセージ *** //
					$this->reversiPlayPass($tmpCol);
					$pass = 1;
				}
			} else {
				// *** ゲーム終了メッセージ *** //
				$this->reversiPlayEnd();
			}
		}
		if ($pass == 1) {
			if ($this->_mSetting->getmMode() == ReversiConst::$DEF_MODE_ONE) {				// CPU対戦
				if ($this->_mSetting->getmAssist() == ReversiConst::$DEF_ASSIST_ON) {
					// *** メッセージ送信 *** //
					$this->execMessage(ReversiConst::$LC_MSG_DRAW_INFO_ALL, NULL);
				}
			}
		}
		if ($update == 1) {
			$waitTime = 0;
			if ($cpuEna == 1) {
				$waitTime = $this->_mSetting->getmPlayCpuInterVal();
			}
//			usleep($waitTime * 1000);
			$this->reversiPlaySub($cpuEna, $tmpCol);
			$this->_mPlayLock = 0;
		}else{
			$this->_mPlayLock = 0;
		}
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			リバーシプレイサブ
	///	@fn				reversiPlaySub($cpuEna, $tmpCol)
	///	@param[in]		$cpuEna
	///	@param[in]		$tmpCol
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function reversiPlaySub($cpuEna, $tmpCol)
	{
		$ret;
		for (; ;) {
			$ret = $this->reversiPlayCpu($tmpCol, $cpuEna);
			$cpuEna = 0;
			if ($ret == 1) {
				if ($this->_mReversi->getGameEndSts() == 0) {
					if ($this->_mReversi->getColorEna($this->_mCurColor) != 0) {
						// *** パスメッセージ *** //
						$this->reversiPlayPass($this->_mCurColor);
						$cpuEna = 1;
					}
				} else {
					// *** ゲーム終了メッセージ *** //
					$this->reversiPlayEnd();
				}
			}
			if ($cpuEna == 0) break;
		}
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			リバーシプレイ終了
	///	@fn				reversiPlayEnd()
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function reversiPlayEnd()
	{
		if ($this->_mGameEndSts == 0) {
			$this->_mGameEndSts = 1;
			$waitTime = $this->gameEndAnimExec();					// 終了アニメ実行
			$this->_mPlayLock = 1;
//			usleep($waitTime * 1000);
			// *** ゲーム終了メッセージ *** //
			$tmpMsg1 = "";
			$tmpMsg2 = "";
			$msgStr = "";
			$blk = 0;
			$whi = 0;
			$blk = $this->_mReversi->getBetCnt(ReversiConst::$REVERSI_STS_BLACK);
			$whi = $this->_mReversi->getBetCnt(ReversiConst::$REVERSI_STS_WHITE);
			$tmpMsg1 = "プレイヤー1 = " . $blk . " プレイヤー2 = " . $whi;
			if ($this->_mSetting->getmMode() == ReversiConst::$DEF_MODE_ONE) {
				if ($whi == $blk) $tmpMsg2 = "引き分けです。";
				else if ($whi < $blk) {
					if ($this->_mCurColor == ReversiConst::$REVERSI_STS_BLACK) $tmpMsg2 = "あなたの勝ちです。";
					else $tmpMsg2 = "あなたの負けです。";
				} else {
					if ($this->_mCurColor == ReversiConst::$REVERSI_STS_WHITE) $tmpMsg2 = "あなたの勝ちです。";
					else $tmpMsg2 = "あなたの負けです。";
				}
			} else {
				if ($whi == $blk) $tmpMsg2 = "引き分けです。";
				else if ($whi < $blk) $tmpMsg2 = "プレイヤー1の勝ちです。";
				else $tmpMsg2 = "プレイヤー2の勝ちです。";
			}
			$msgStr = $tmpMsg1 . $tmpMsg2;
			$this->ViewMsgDlgLocal("ゲーム終了", $msgStr);

			if ($this->_mSetting->getmEndAnim() == ReversiConst::$DEF_END_ANIM_ON) {
				// *** メッセージ送信 *** //
				$this->execMessage(ReversiConst::$LC_MSG_CUR_COL, NULL);
				// *** メッセージ送信 *** //
				$this->execMessage(ReversiConst::$LC_MSG_CUR_STS, NULL);
			}
		}
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			リバーシプレイパス
	///	@fn				reversiPlayPass($color)
	///	@param[in]		$color		パス色
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function reversiPlayPass($color)
	{
		// *** パスメッセージ *** //
		if ($this->_mSetting->getmMode() == ReversiConst::$DEF_MODE_ONE) {
			if ($color == $this->_mCurColor) $this->ViewMsgDlgLocal("", "あなたはパスです。");
			else $this->ViewMsgDlgLocal("", "CPUはパスです。");
		} else {
			if ($color == ReversiConst::$REVERSI_STS_BLACK) $this->ViewMsgDlgLocal("", "プレイヤー1はパスです。");
			else $this->ViewMsgDlgLocal("", "プレイヤー2はパスです。");
		}
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			リバーシプレイコンピューター
	///	@fn				reversiPlayCpu($color, $cpuEna)
	///	@param[in]		$color		CPU色
	///	@param[in]		$cpuEna		CPU有効フラグ
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function reversiPlayCpu($color, $cpuEna)
	{
		$update = 0;
		$setY;
		$setX;

		for (; ;) {
			if ($cpuEna == 1) {
				$cpuEna = 0;
				// *** CPU対戦 *** //
				$pCnt = $this->_mReversi->getPointCnt($color);
				$pInfo = $this->_mReversi->getPoint($color, rand(0,$pCnt));
				if ($pInfo != NULL) {
					$setY = $pInfo->gety();
					$setX = $pInfo->getx();
					if ($this->_mSetting->getmType() != ReversiConst::$DEF_TYPE_EASY) {	// 強いコンピューター
						$cpuflg0 = 0;
						$cpuflg1 = 0;
						$cpuflg2 = 0;
						$cpuflg3 = 0;
						$mem = -1;
						$mem2 = -1;
						$mem3 = -1;
						$mem4 = -1;
						$rcnt1 = 0;
						$rcnt2 = 0;
						$kadocnt = 0;
						$loop = $this->_mSetting->getmMasuCnt() * $this->_mSetting->getmMasuCnt();
						$pCnt = 0;
						$passCnt = 0;
						if ($color == ReversiConst::$REVERSI_STS_BLACK) $othColor = ReversiConst::$REVERSI_STS_WHITE;
						else $othColor = ReversiConst::$REVERSI_STS_BLACK;
						$othBet = $this->_mReversi->getBetCnt($othColor);			// 対戦相手のコマ数
						$ownBet = $this->_mReversi->getBetCnt($color);				// 自分のコマ数
						$endZone = 0;
						if (($loop - ($othBet + $ownBet)) <= 16) $endZone = 1;		// ゲーム終盤フラグON
						for ($i = 0; $i < $loop; $i++) {
							$this->_mCpu[$i]->setx(0);
							$this->_mCpu[$i]->sety(0);
							$this->_mEdge[$i]->setx(0);
							$this->_mEdge[$i]->sety(0);
						}

						for ($i = 0; $i < $this->_mSetting->getmMasuCnt(); $i++) {
							for ($j = 0; $j < $this->_mSetting->getmMasuCnt(); $j++) {
								if ($this->_mReversi->getMasuStsEna($color, $i, $j) != 0) {
									// *** 角の一つ手前なら別のとこに格納 *** //
									if ($this->_mReversi->getEdgeSideOne($i, $j) == 0) {
										$this->_mEdge[$kadocnt]->setx($j);
										$this->_mEdge[$kadocnt]->sety($i);
										$kadocnt++;
									} else {
										$this->_mCpu[$rcnt1]->setx($j);
										$this->_mCpu[$rcnt1]->sety($i);
										$rcnt1++;
									}
									if ($this->_mSetting->getmType() == ReversiConst::$DEF_TYPE_NOR) {
										// *** 角に置けるなら優先的にとらせるため場所を記憶させる *** //
										if ($this->_mReversi->getEdgeSideZero($i, $j) == 0) {
											$cpuflg1 = 1;
											$rcnt2 = ($rcnt1 - 1);
										}
										// *** 角の二つ手前も優先的にとらせるため場所を記憶させる *** //
										if ($cpuflg1 == 0) {
											if ($this->_mReversi->getEdgeSideTwo($i, $j) == 0) {
												$cpuflg2 = 1;
												$rcnt2 = ($rcnt1 - 1);
											}
										}
										// *** 角の三つ手前も優先的にとらせるため場所を記憶させる *** //
										if ($cpuflg1 == 0 && $cpuflg2 == 0) {
											if ($this->_mReversi->getEdgeSideThree($i, $j) == 0) {
												$cpuflg0 = 1;
												$rcnt2 = ($rcnt1 - 1);
											}
										}
									}
									// *** パーフェクトゲームなら *** //
									if ($this->_mReversi->getMasuStsCnt($color, $i, $j) == $othBet) {
										$setY = $i;
										$setX = $j;
										$pCnt = 1;
									}
									// *** 相手をパスさせるなら *** //
									if ($pCnt == 0) {
										if ($this->_mReversi->getPassEna($color, $i, $j) != 0) {
											$setY = $i;
											$setX = $j;
											$passCnt = 1;
										}
									}
								}
							}
						}

						if ($pCnt == 0 && $passCnt == 0) {
							$badPoint = -1;
							$goodPoint = -1;
							$pointCnt = -1;
							$ownPointCnt = -1;
							$tmpAnz;
							if ($rcnt1 != 0) {
								for ($i = 0; $i < $rcnt1; $i++) {
									if ($this->_mSetting->getmType() == ReversiConst::$DEF_TYPE_HARD) {
										$tmpAnz = $this->_mReversi->getPointAnz($color, $this->_mCpu[$i]->gety(), $this->_mCpu[$i]->getx());
										if ($tmpAnz != NULL) {
											if ($badPoint == -1) {
												$badPoint = $tmpAnz->getBadPoint();
												$goodPoint = $tmpAnz->getGoodPoint();
												$pointCnt = $tmpAnz->getPointCnt();
												$ownPointCnt = $tmpAnz->getOwnPointCnt();
												$mem2 = $i;
												$mem3 = $i;
												$mem4 = $i;
											} else {
												if ($tmpAnz->getBadPoint() < $badPoint) {
													$badPoint = $tmpAnz->getBadPoint();
													$mem2 = $i;
												}
												if ($goodPoint < $tmpAnz->getGoodPoint()) {
													$goodPoint = $tmpAnz->getGoodPoint();
													$mem3 = $i;
												}
												if ($tmpAnz->getPointCnt() < $pointCnt) {
													$pointCnt = $tmpAnz->getPointCnt();
													$ownPointCnt = $tmpAnz->getOwnPointCnt();
													$mem4 = $i;
												} else if ($tmpAnz->getPointCnt() == $pointCnt) {
													if ($ownPointCnt < $tmpAnz->getOwnPointCnt()) {
														$ownPointCnt = $tmpAnz->getOwnPointCnt();
														$mem4 = $i;
													}
												}
											}
										}
									}
									if ($this->_mReversi->getMasuStsEna($color, $this->_mCpu[$i]->gety(), $this->_mCpu[$i]->getx()) == 2) {
										$mem = $i;
									}
								}
								if ($mem2 != -1) {
									if ($endZone != 0) {							// 終盤なら枚数重視
										if ($mem3 != -1) {
											$mem2 = $mem3;
										}
									} else {
										if ($mem4 != -1) {
											$mem2 = $mem4;
										}
									}
									$mem = $mem2;
								}
								if ($mem == -1) $mem = rand(0,$rcnt1);
							} else if ($kadocnt != 0) {
								for ($i = 0; $i < $kadocnt; $i++) {
									if ($this->_mSetting->getmType() == ReversiConst::$DEF_TYPE_HARD) {
										$tmpAnz = $this->_mReversi->getPointAnz($color, $this->_mEdge[$i]->gety(), $this->_mEdge[$i]->getx());
										if ($tmpAnz != NULL) {
											if ($badPoint == -1) {
												$badPoint = $tmpAnz->getBadPoint();
												$goodPoint = $tmpAnz->getGoodPoint();
												$pointCnt = $tmpAnz->getPointCnt();
												$ownPointCnt = $tmpAnz->getOwnPointCnt();
												$mem2 = $i;
												$mem3 = $i;
												$mem4 = $i;
											} else {
												if ($tmpAnz->getBadPoint() < $badPoint) {
													$badPoint = $tmpAnz->getBadPoint();
													$mem2 = $i;
												}
												if ($goodPoint < $tmpAnz->getGoodPoint()) {
													$goodPoint = $tmpAnz->getGoodPoint();
													$mem3 = $i;
												}
												if ($tmpAnz->getPointCnt() < $pointCnt) {
													$pointCnt = $tmpAnz->getPointCnt();
													$ownPointCnt = $tmpAnz->getOwnPointCnt();
													$mem4 = $i;
												} else if ($tmpAnz->getPointCnt() == $pointCnt) {
													if ($ownPointCnt < $tmpAnz->getOwnPointCnt()) {
														$ownPointCnt = $tmpAnz->getOwnPointCnt();
														$mem4 = $i;
													}
												}
											}
										}
									}
									if ($this->_mReversi->getMasuStsEna($color, $this->_mEdge[$i]->gety(), $this->_mEdge[$i]->getx()) == 2) {
										$mem = $i;
									}
								}
								if ($mem2 != -1) {
									if ($endZone != 0) {							// 終盤なら枚数重視
										if ($mem3 != -1) {
											$mem2 = $mem3;
										}
									} else {
										if ($mem4 != -1) {
											$mem2 = $mem4;
										}
									}
									$mem = $mem2;
								}
								if ($mem == -1) $mem = rand(0,$kadocnt);
								// *** 置いても平気な角があればそこに置く*** //
								for ($i = 0; $i < $kadocnt; $i++) {
									if ($this->_mReversi->checkEdge($color, $this->_mEdge[$i]->gety(), $this->_mEdge[$i]->getx()) != 0) {
										if (($cpuflg0 == 0) && ($cpuflg1 == 0) && ($cpuflg2 == 0)) {
											$cpuflg3 = 1;
											$rcnt2 = $i;
										}
									}
								}
							}
							if (($cpuflg1 == 0) && ($cpuflg2 == 0) && ($cpuflg0 == 0) && ($cpuflg3 == 0)) {
								$rcnt2 = $mem;
							}
							if ($rcnt1 != 0) {
								$setY = $this->_mCpu[$rcnt2]->gety();
								$setX = $this->_mCpu[$rcnt2]->getx();
							} else if ($kadocnt != 0) {
								$setY = $this->_mEdge[$rcnt2]->gety();
								$setX = $this->_mEdge[$rcnt2]->getx();
							}
						}
					}

					if ($this->_mReversi->setMasuSts($color, $setY, $setX) == 0) {
						if ($this->_mSetting->getmType() == ReversiConst::$DEF_TYPE_HARD) $this->_mReversi->AnalysisReversi($this->_mPassEnaB, $this->_mPassEnaW);
						$this->sendDrawMsg($setY, $setX);							// 描画
						$update = 1;
					}
				}
			} else {
				break;
			}
		}
		if ($update == 1) {
			$this->drawUpdate(ReversiConst::$DEF_ASSIST_OFF);
			if ($this->_mSetting->getmAssist() == ReversiConst::$DEF_ASSIST_ON) {
				// *** メッセージ送信 *** //
				$this->execMessage(ReversiConst::$LC_MSG_DRAW_INFO_ALL, NULL);
			}
		}

		return $update;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			マス描画更新
	///	@fn				drawUpdate($assist)
	///	@param[in]		$assist	アシスト設定
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function drawUpdate($assist)
	{
		if ($assist == ReversiConst::$DEF_ASSIST_ON) {
			for ($i = 0; $i < $this->_mSetting->getmMasuCnt(); $i++) {
				for ($j = 0; $j < $this->_mSetting->getmMasuCnt(); $j++) {
					$this->sendDrawInfoMsg($i, $j);
				}
			}
		}
		$waitTime = $this->_mSetting->getmPlayDrawInterVal();
		for ($i = 0; $i < $this->_mSetting->getmMasuCnt(); $i++) {
			for ($j = 0; $j < $this->_mSetting->getmMasuCnt(); $j++) {
				if($this->_mReversi->getMasuSts($i,$j) != $this->_mReversi->getMasuStsOld($i,$j)){
//					usleep($waitTime * 1000);
					$this->sendDrawMsg($i, $j);
				}
			}
		}
		// *** メッセージ送信 *** //
		$this->execMessage(ReversiConst::$LC_MSG_CUR_COL, NULL);
		// *** メッセージ送信 *** //
		$this->execMessage(ReversiConst::$LC_MSG_CUR_STS, NULL);
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			マス描画強制更新
	///	@fn				drawUpdateForcibly($assist)
	///	@param[in]		$assist	アシスト設定
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function drawUpdateForcibly($assist)
	{
		// *** メッセージ送信 *** //
		$this->execMessage(ReversiConst::$LC_MSG_DRAW_ALL, NULL);
		if ($assist == ReversiConst::$DEF_ASSIST_ON) {
			// *** メッセージ送信 *** //
			$this->execMessage(ReversiConst::$LC_MSG_DRAW_INFO_ALL, NULL);
		} else {
			// *** メッセージ送信 *** //
			$this->execMessage(ReversiConst::$LC_MSG_ERASE_INFO_ALL, NULL);
		}
		// *** メッセージ送信 *** //
		$this->execMessage(ReversiConst::$LC_MSG_CUR_COL, NULL);
		// *** メッセージ送信 *** //
		$this->execMessage(ReversiConst::$LC_MSG_CUR_STS, NULL);
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			リセット処理
	///	@fn				reset()
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function reset()
	{
		$this->_mPassEnaB = 0;
		$this->_mPassEnaW = 0;
		if ($this->_mSetting->getmGameSpd() == ReversiConst::$DEF_GAME_SPD_FAST) {
			$this->_mSetting->setmPlayDrawInterVal(ReversiConst::$DEF_GAME_SPD_FAST_VAL);				// 描画のインターバル(msec)
			$this->_mSetting->setmPlayCpuInterVal(ReversiConst::$DEF_GAME_SPD_FAST_VAL2);				// CPU対戦時のインターバル(msec)
		} else if ($this->_mSetting->getmGameSpd() == ReversiConst::$DEF_GAME_SPD_MID) {
			$this->_mSetting->setmPlayDrawInterVal(ReversiConst::$DEF_GAME_SPD_MID_VAL);				// 描画のインターバル(msec)
			$this->_mSetting->setmPlayCpuInterVal(ReversiConst::$DEF_GAME_SPD_MID_VAL2);				// CPU対戦時のインターバル(msec)
		} else {
			$this->_mSetting->setmPlayDrawInterVal(ReversiConst::$DEF_GAME_SPD_SLOW_VAL);				// 描画のインターバル(msec)
			$this->_mSetting->setmPlayCpuInterVal(ReversiConst::$DEF_GAME_SPD_SLOW_VAL2);				// CPU対戦時のインターバル(msec)
		}

		$this->_mCurColor = $this->_mSetting->getmPlayer();
		if ($this->_mSetting->getmMode() == ReversiConst::$DEF_MODE_TWO) $this->_mCurColor = ReversiConst::$REVERSI_STS_BLACK;

		$this->_mReversi->setMasuCnt($this->_mSetting->getmMasuCnt());									// マスの数設定

		$this->_mReversi->reset();
		if ($this->_mSetting->getmMode() == ReversiConst::$DEF_MODE_ONE) {
			if ($this->_mCurColor == ReversiConst::$REVERSI_STS_WHITE) {
				$pCnt = $this->_mReversi->getPointCnt(ReversiConst::$REVERSI_STS_BLACK);
				$pInfo = $this->_mReversi->getPoint(ReversiConst::$REVERSI_STS_BLACK, rand(0,$pCnt));
				if ($pInfo != NULL) {
					$this->_mReversi->setMasuSts(ReversiConst::$REVERSI_STS_BLACK, $pInfo->gety(), $pInfo->getx());
					if ($this->_mSetting->getmType() == ReversiConst::$DEF_TYPE_HARD) $this->_mReversi->AnalysisReversi($this->_mPassEnaB, $this->_mPassEnaW);
				}
			}
		}

		$this->_mPlayLock = 1;
		$this->_mGameEndSts = 0;

		$this->drawUpdateForcibly($this->_mSetting->getmAssist());

		// *** 終了通知 *** //
		// *** メッセージ送信 *** //
		$this->execMessage(ReversiConst::$LC_MSG_DRAW_END, NULL);
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			ゲーム終了アニメーション
	///	@fn				gameEndAnimExec()
	///	@return			ウェイト時間
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function gameEndAnimExec()
	{
		$ret = 0;
		if ($this->_mSetting->getmEndAnim() == ReversiConst::$DEF_END_ANIM_ON) {
			$bCnt = $this->_mReversi->getBetCnt(ReversiConst::$REVERSI_STS_BLACK);
			$wCnt = $this->_mReversi->getBetCnt(ReversiConst::$REVERSI_STS_WHITE);

			// *** 色、コマ数表示消去 *** //
			// *** メッセージ送信 *** //
			$this->execMessage(ReversiConst::$LC_MSG_CUR_COL_ERASE, NULL);
			// *** メッセージ送信 *** //
			$this->execMessage(ReversiConst::$LC_MSG_CUR_STS_ERASE, NULL);

//			usleep($this->_mSetting->getmEndInterVal() * 1000);
			// *** マス消去 *** //
			for ($i = 0; $i < $this->_mSetting->getmMasuCnt(); $i++) {
				for ($j = 0; $j < $this->_mSetting->getmMasuCnt(); $j++) {
					$this->_mReversi->setMasuStsForcibly(ReversiConst::$REVERSI_STS_NONE, $i, $j);
				}
			}
			// *** メッセージ送信 *** //
			$this->execMessage(ReversiConst::$LC_MSG_ERASE_ALL, NULL);

			// *** マス描画 *** //
			$bCnt2 = 0;
			$wCnt2 = 0;
			$bEnd = 0;
			$wEnd = 0;
			for ($i = 0; $i < $this->_mSetting->getmMasuCnt(); $i++) {
				for ($j = 0; $j < $this->_mSetting->getmMasuCnt(); $j++) {
					if ($bCnt2 < $bCnt) {
						$bCnt2++;
						$this->_mReversi->setMasuStsForcibly(ReversiConst::$REVERSI_STS_BLACK, $i, $j);
						$this->sendDrawMsg($i, $j);
					} else {
						$bEnd = 1;
					}
					if ($wCnt2 < $wCnt) {
						$wCnt2++;
						$this->_mReversi->setMasuStsForcibly(ReversiConst::$REVERSI_STS_WHITE, ($this->_mSetting->getmMasuCnt() - 1) - $i, ($this->_mSetting->getmMasuCnt() - 1) - $j);
						$this->sendDrawMsg(($this->_mSetting->getmMasuCnt() - 1) - $i, ($this->_mSetting->getmMasuCnt() - 1) - $j);
					} else {
						$wEnd = 1;
					}
					if ($bEnd == 1 && $wEnd == 1) {
						break;
					}else{
//						usleep($this->_mSetting->getmEndDrawInterVal() * 1000);
					}
				}
			}
			$ret = 0;
		}
		return $ret;
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			描画メッセージ送信
	///	@fn				sendDrawMsg($y, $x)
	///	@param[in]		$y			Y座標
	///	@param[in]		$x			X座標
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function sendDrawMsg($y, $x)
	{
		$mTmpPoint = new ReversiPoint();
		$mTmpPoint->sety($y);
		$mTmpPoint->setx($x);
		// *** メッセージ送信 *** //
		$this->execMessage(ReversiConst::$LC_MSG_DRAW, $mTmpPoint);
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			情報描画メッセージ送信
	///	@fn				sendDrawInfoMsg($y, $x)
	///	@param[in]		$y			Y座標
	///	@param[in]		$x			X座標
	///	@return			ありません
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	public function sendDrawInfoMsg($y, $x)
	{
		$mTmpPoint = new ReversiPoint();
		$mTmpPoint->sety($y);
		$mTmpPoint->setx($x);
		// *** メッセージ送信 *** //
		$this->execMessage(ReversiConst::$LC_MSG_DRAW_INFO, $mTmpPoint);
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			メッセージ
	///	@fn				execMessage($what, $obj)
	///	@param[in]		$what
	///	@param[in]		$obj
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	private function execMessage($what, $obj)
	{
		if ($what == ReversiConst::$LC_MSG_DRAW) {
			// *** マス描画 *** //
			$msgPoint = $obj;
			$dMode = $this->_mReversi->getMasuSts($msgPoint->gety(), $msgPoint->getx());
			$dBack = $this->_mReversi->getMasuStsEna($this->_mCurColor, $msgPoint->gety(), $msgPoint->getx());
			$dCnt = $this->_mReversi->getMasuStsCnt($this->_mCurColor, $msgPoint->gety(), $msgPoint->getx());
			$this->DrawSingleLocal($msgPoint->gety(), $msgPoint->getx(), $dMode, $dBack, $dCnt);
		} else if ($what == ReversiConst::$LC_MSG_ERASE) {
			// *** マス消去 *** //
			$msgPoint = $obj;
			$this->DrawSingleLocal($msgPoint->gety(), $msgPoint->getx(), 0, 0, "0");
		} else if ($what == ReversiConst::$LC_MSG_DRAW_INFO) {
			// *** マス情報描画 *** //
			$msgPoint = $obj;
			$dMode = $this->_mReversi->getMasuSts($msgPoint->gety(), $msgPoint->getx());
			$dBack = $this->_mReversi->getMasuStsEna($this->_mCurColor, $msgPoint->gety(), $msgPoint->getx());
			$dCnt = $this->_mReversi->getMasuStsCnt($this->_mCurColor, $msgPoint->gety(), $msgPoint->getx());
			$this->DrawSingleLocal($msgPoint->gety(), $msgPoint->getx(), $dMode, $dBack, $dCnt);
		} else if ($what == ReversiConst::$LC_MSG_ERASE_INFO) {
			// *** マス情報消去 *** //
			$msgPoint = $obj;
			$dMode = $this->_mReversi->getMasuSts($msgPoint->gety(), $msgPoint->getx());
			$this->DrawSingleLocal($msgPoint->gety(), $msgPoint->getx(), $dMode, 0, "0");
		} else if ($what == ReversiConst::$LC_MSG_DRAW_ALL) {
			// *** 全マス描画 *** //
			for ($i = 0; $i < $this->_mSetting->getmMasuCnt(); $i++) {
				for ($j = 0; $j < $this->_mSetting->getmMasuCnt(); $j++) {
					$dMode = $this->_mReversi->getMasuSts($i, $j);
					$dBack = $this->_mReversi->getMasuStsEna($this->_mCurColor, $i, $j);
					$dCnt = $this->_mReversi->getMasuStsCnt($this->_mCurColor, $i, $j);
					$this->DrawSingleLocal($i, $j, $dMode, $dBack, $dCnt);
				}
			}
		} else if ($what == ReversiConst::$LC_MSG_ERASE_ALL) {
			// *** 全マス消去 *** //
			for ($i = 0; $i < $this->_mSetting->getmMasuCnt(); $i++) {
				for ($j = 0; $j < $this->_mSetting->getmMasuCnt(); $j++) {
					$this->DrawSingleLocal($i, $j, 0, 0, "0");
				}
			}
		} else if ($what == ReversiConst::$LC_MSG_DRAW_INFO_ALL) {
			// *** 全マス情報描画 *** //
			for ($i = 0; $i < $this->_mSetting->getmMasuCnt(); $i++) {
				for ($j = 0; $j < $this->_mSetting->getmMasuCnt(); $j++) {
					$dMode = $this->_mReversi->getMasuSts($i, $j);
					$dBack = $this->_mReversi->getMasuStsEna($this->_mCurColor, $i, $j);
					$dCnt = $this->_mReversi->getMasuStsCnt($this->_mCurColor, $i, $j);
					$this->DrawSingleLocal($i, $j, $dMode, $dBack, $dCnt);
				}
			}
		} else if ($what == ReversiConst::$LC_MSG_ERASE_INFO_ALL) {
			// *** 全マス情報消去 *** //
			for ($i = 0; $i < $this->_mSetting->getmMasuCnt(); $i++) {
				for ($j = 0; $j < $this->_mSetting->getmMasuCnt(); $j++) {
					$dMode = $this->_mReversi->getMasuSts($i, $j);
					$this->DrawSingleLocal($i, $j, $dMode, 0, "0");
				}
			}
		} else if ($what == ReversiConst::$LC_MSG_DRAW_END) {
			$this->_mPlayLock = 0;
		} else if ($what == ReversiConst::$LC_MSG_CUR_COL) {
			$tmpStr = "";
			if ($this->_mSetting->getmMode() == ReversiConst::$DEF_MODE_ONE) {
				if ($this->_mCurColor == ReversiConst::$REVERSI_STS_BLACK) $tmpStr = "あなたはプレイヤー1です ";
				else $tmpStr = "あなたはプレイヤー2です ";
			} else {
				if ($this->_mCurColor == ReversiConst::$REVERSI_STS_BLACK) $tmpStr = "プレイヤー1の番です ";
				else $tmpStr = "プレイヤー2の番です ";
			}
			$this->CurColMsgLocal($tmpStr);
		} else if ($what == ReversiConst::$LC_MSG_CUR_COL_ERASE) {
			$this->CurColMsgLocal("");
		} else if ($what == ReversiConst::$LC_MSG_CUR_STS) {
			$tmpStr = "プレイヤー1 = " . $this->_mReversi->getBetCnt(ReversiConst::$REVERSI_STS_BLACK) . " プレイヤー2 = " . $this->_mReversi->getBetCnt(ReversiConst::$REVERSI_STS_WHITE);
			$this->CurStsMsgLocal($tmpStr);
		} else if ($what == ReversiConst::$LC_MSG_CUR_STS_ERASE) {
			$this->CurStsMsgLocal("");
		} else if ($what == ReversiConst::$LC_MSG_MSG_DLG) {
		} else if ($what == ReversiConst::$LC_MSG_DRAW_ALL_RESET) {
		}
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			メッセージダイアログ
	///	@fn				ViewMsgDlgLocal($title , $msg)
	///	@param[in]		$title	タイトル
	///	@param[in]		$msg	メッセージ
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	private function ViewMsgDlgLocal($title , $msg)
	{
		if($this->_viewMsgDlg != NULL){
			$callback = $this->_viewMsgDlg;
			$callback($title, $msg);
		}
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			1マス描画
	///	@fn				DrawSingleLocal($y, $x, $sts, $bk, $text)
	///	@param[in]		$y		Y座標
	///	@param[in]		$x		X座標
	///	@param[in]		$sts	ステータス
	///	@param[in]		$bk		背景
	///	@param[in]		$text	テキスト
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	private function DrawSingleLocal($y, $x, $sts, $bk, $text)
	{
		if($this->_drawSingle != NULL){
			$callback = $this->_drawSingle;
			$callback($y, $x, $sts, $bk, $text);
		}
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			現在の色メッセージ
	///	@fn				CurColMsgLocal($text)
	///	@param[in]		$text	テキスト
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	private function CurColMsgLocal($text)
	{
		if($this->_curColMsg != NULL){
			$callback = $this->_curColMsg;
			$callback($text);
		}
	}

	////////////////////////////////////////////////////////////////////////////////
	///	@brief			現在のステータスメッセージ
	///	@fn				CurStsMsgLocal($text)
	///	@param[in]		$text	テキスト
	///	@return			ありません
	///	@author			Yuta Yoshinaga
	///	@date			2018.03.02
	///
	////////////////////////////////////////////////////////////////////////////////
	private function CurStsMsgLocal($text)
	{
		if($this->_curStsMsg != NULL){
			$callback = $this->_curStsMsg;
			$callback($text);
		}
	}
}

?>
