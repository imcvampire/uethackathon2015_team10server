<?php

namespace App\Contracts;

interface Search {
	public function index($index);
	public function get($query);
}