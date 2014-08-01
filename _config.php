<?php

define('LIQUIDLAYOUT_MODULE', 'liquid-layout');

if (basename(dirname(__FILE__)) != LIQUIDLAYOUT_MODULE) {
	throw new Exception(LIQUIDLAYOUT_MODULE . ' module not installed in correct directory');
}