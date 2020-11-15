<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class MyConfig extends BaseConfig
{
    public $baseURL = '';

	public $domainName = '';
	public $adminEmail = '';

	public $siteName = 'Exchanger';
	public $api_link = 'https://v6.exchangerate-api.com/v6/9fc649924608314f6d2bc307/latest/USD';

}
