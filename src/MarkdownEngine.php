<?php namespace Purekid\LaravelMarkdownExtra;

use Illuminate\View\Engines\EngineInterface;

class MarkdownEngine implements EngineInterface
{

	protected $parser;

	public function __construct($parser)
	{
		$this->parser = $parser;
	}

	public function get($path, array $data = array())
	{
		return $this->parser->transformExtra( file_get_contents($path) );
	}
}