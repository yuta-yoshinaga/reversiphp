<?php

////////////////////////////////////////////////////////////////////////////////
///	@file			Delegate.php
///	@brief			デリゲートクラス実装ファイル
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

class Delegate
{
    /** @var callable[] */
    protected $callbacks = [];

    /**
     * Add callback function
     * @param callable $callback
     * @return $this
     */
    public function add(callable $callback)
    {
        $this->callbacks[] = $callback;
        return $this;
    }

    /**
     * Remove callback function
     * @param callable $callback
     * @return $this
     */
    public function remove(callable $callback)
    {
        foreach ( $this->callbacks as $key => $_callback )
        {
            if ( $callback == $_callback )
            {
                unset($this->callbacks[$key]);
                return $this;
            }
        }
        return $this;
    }

    /**
     * Invoke callback functions
     * @return mixed
     */
    public function __invoke()
    {
        $result = null;

        foreach ( $this->callbacks as $callback )
        {
            $result = call_user_func_array($callback, func_get_args());
        }

        return $result;
    }
}

?>
