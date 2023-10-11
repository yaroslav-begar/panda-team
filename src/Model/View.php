<?php
/** @noinspection ALL */

namespace Model;

class View
{
    /**
     * @var array
     */
	private $data = [];

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
	public function __set(string $key, $value): void
	{
		$this->data[$key] = $value;
	}

    /**
     * @param string $key
     * @return mixed
     */
	public function __get(string $key)
	{
		return $this->data[$key];
	}

    /**
     * @param string $template
     * @return void
     */
	public function display(string $template): void
	{
        $template = __DIR__ . '/../../view/' . $template . '.php';
		foreach($this->data as $key => $value) {
			$$key = $value;
		}
        require_once __DIR__ . '/../../view/layout.php';
	}
}
