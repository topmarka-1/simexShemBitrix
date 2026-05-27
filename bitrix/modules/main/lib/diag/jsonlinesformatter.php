<?php

/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2025 Bitrix
 */

namespace Bitrix\Main\Diag;

use Bitrix\Main\Web\Json;

class JsonLinesFormatter implements LogFormatterInterface
{
	/**
	 * Basic formatter to a JSON line string.
	 * @param string $message Not used.
	 * @param array $context An array to JSON-encode.
	 * @see https://jsonlines.org
	 */
	public function format($message, array $context = []): string
	{
		return Json::encode($context, JSON_UNESCAPED_UNICODE) . "\n";
	}
}
