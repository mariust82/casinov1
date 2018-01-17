<?php
/*
* Filters casinos according to selections
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
* @requestParameter country_accepted boolean If (country) accepted filter is checked.
* @requestParameter free_bonus boolean If free bonus filter is checked.
* @requestParameter banking_method string Value of current banking method, if current page is "Banking"
* @requestParameter label string Value of current casino label, if  current page is "Casinos"
* @requestParameter bonus_type string Value of current bonus type, if  current page is "Bonuses"
* @requestParameter country string Value of current country, if current page is "Countries"
* @requestParameter operating_system string Value of current operating system, if  current page is "Compatibility"
* @requestParameter software string Value of current software, if  current page is "Software"
* @requestParameter play_version string Value of current play version, if  current page is "Features"
* @requestParameter sort string Value can be "default", "top rated" or "newest"
*/
class CasinosFilterController extends CasinosListController {
	public function run() {
		parent::run();
		// response
	}
}
