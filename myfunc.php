<?php

/**
 * エスケープ処理を関数に
 *
 * @param [type] $str
 * @return void
 */
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
