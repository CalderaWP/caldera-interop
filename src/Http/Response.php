<?php


namespace calderawp\interop\Http;

use calderawp\interop\Interfaces\InteroperabeResponse;
use GuzzleHttp\Psr7\MessageTrait;
use function GuzzleHttp\Psr7\stream_for;

/**
 * Class Response
 *
 * Object representation of an HTTP Response
 *
 * Alot of copypaste from Guzzle's PSR7 Response class
 *
 * @package calderawp\interop\Http
 */
class Response implements InteroperabeResponse
{

	use MessageTrait;

	/** @var array Map of standard HTTP status code/reason phrases */
	private static $phrases = [
		100 => 'Continue',
		101 => 'Switching Protocols',
		102 => 'Processing',
		200 => 'OK',
		201 => 'Created',
		202 => 'Accepted',
		203 => 'Non-Authoritative Information',
		204 => 'No Content',
		205 => 'Reset Content',
		206 => 'Partial Content',
		207 => 'Multi-status',
		208 => 'Already Reported',
		300 => 'Multiple Choices',
		301 => 'Moved Permanently',
		302 => 'Found',
		303 => 'See Other',
		304 => 'Not Modified',
		305 => 'Use Proxy',
		306 => 'Switch Proxy',
		307 => 'Temporary Redirect',
		400 => 'Bad Request',
		401 => 'Unauthorized',
		402 => 'Payment Required',
		403 => 'Forbidden',
		404 => 'Not Found',
		405 => 'Method Not Allowed',
		406 => 'Not Acceptable',
		407 => 'Proxy Authentication Required',
		408 => 'Request Time-out',
		409 => 'Conflict',
		410 => 'Gone',
		411 => 'Length Required',
		412 => 'Precondition Failed',
		413 => 'Request Entity Too Large',
		414 => 'Request-URI Too Large',
		415 => 'Unsupported Media Type',
		416 => 'Requested range not satisfiable',
		417 => 'Expectation Failed',
		418 => 'I\'m a teapot',
		420 => 'Increase chilll',
		422 => 'Unprocessable Entity',
		423 => 'Locked',
		424 => 'Failed Dependency',
		425 => 'Unordered Collection',
		426 => 'Upgrade Required',
		428 => 'Precondition Required',
		429 => 'Too Many Requests',
		431 => 'Request Header Fields Too Large',
		451 => 'Unavailable For Legal Reasons',
		500 => 'Internal Server Error',
		501 => 'Not Implemented',
		502 => 'Bad Gateway',
		503 => 'Service Unavailable',
		504 => 'Gateway Time-out',
		505 => 'HTTP Version not supported',
		506 => 'Variant Also Negotiates',
		507 => 'Insufficient Storage',
		508 => 'Loop Detected',
		511 => 'Network Authentication Required',
	];

	/** @var string */
	private $reasonPhrase = '';

	/** @var int */
	private $statusCode = 200;


	/**
	 * Response constructor.
	 * @param mixed $body Request body. If is array or object, will be JSON serializes
	 * @param int $status Optional. Status code. Default: 200
	 * @param array $headers Optional. Response headers.
	 */
	public function __construct($body, $status = 200, $headers = [])
	{
		$this->statusCode = (int)$status;

		if ($body !== '' && $body !== null) {
			$this->setBody($body);
		}
		$this->setReasonPhrase();

		$this->protocol = 1.1;
		$this->setHeaders($headers);
	}

	/**
	 * (re)Set the status code
	 *
	 * @param $status
	 */
	public function setStatus($status)
	{
		$this->statusCode = $status;
		$this->setReasonPhrase();
	}

	/** @inheritdoc */
	public function getStatusCode()
	{
		return $this->statusCode;
	}

	/** @inheritdoc */
	public function getReasonPhrase()
	{
		return $this->reasonPhrase;
	}

	/** @inheritdoc */
	public function withStatus($code, $reasonPhrase = '')
	{
		$new = clone $this;
		$new->setStatus((int)$code);
		$new->setReasonPhrase($reasonPhrase);
		return $new;
	}

	/**
	 * (re)Set the status code
	 *
	 * @param $body
	 */
	public function setBody($body)
	{
		if (is_array($body) || is_object($body)) {
			$body = \GuzzleHttp\json_encode($body);
		}
		$this->stream = stream_for($body);
	}

	/**
	 * Set Reason phrase
	 *
	 * @param string $reasonPhrase The new phrase. Or leave empty to set based on status code
	 */
	public function setReasonPhrase($reasonPhrase = '')
	{
		if ($reasonPhrase == '' && isset(self::$phrases[$this->statusCode])) {
			$reasonPhrase = self::$phrases[$this->statusCode];
		}
		$this->reasonPhrase = $reasonPhrase;
	}
}
