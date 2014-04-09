<?php

namespace OpenGrapher;

use Symfony\Component\Yaml\Parser;

class OpenGrapher {

	protected $data;
	protected $tags;
	protected $parser;
	protected $entries;

	public function __construct()
	{
		$this->parser = new Parser;
	}

	public function parse($file)
	{
		$this->data = $this->parser->parse(file_get_contents($file));

		foreach ($this->data as $key => $value) {
			foreach ($value as $itemKey => $itemValue) {
				$this->add($key, $itemKey, $itemValue);
			}
		}

		return $this;
	}

	protected function build($entry)
	{
		foreach ($this->entries[$entry] as $key => $value) {
			$this->tags .= "<meta property=\"og:$key\" content=\"$value\">\n";
		}
	}

	protected function buildAll()
	{
		foreach ($this->entries as $key => $value) {
			$this->build($key);
		}
	}

	public function add($key, $entryKey, $entryValue)
	{
		$this->entries[$key][$entryKey] = $entryValue;

		return $this;
	}

	public function remove()
	{
		if (array_key_exists($key, $this->tags))
		{
			unset($this->tags[$key]);
		}

		return $this;
	}

	public function find($entry)
	{
		if ( ! array_key_exists($entry, $this->entries))
		{
			throw new \Exception("Cannot find by meta tags for: $entry");
		}
		else
		{
			$this->build($entry);
		}

		return $this;
	}

	public function findAll()
	{
		$this->buildAll();

		return $this;
	}

	public function get()
	{
		return $this->tags;
	}

}