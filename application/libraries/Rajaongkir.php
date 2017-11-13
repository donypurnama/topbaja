<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Rajaongkir(Pro) Class
 *
 *
 * @package        	CodeIgniter
 * @subpackage    	Libraries
 * @category    		Libraries
 * @author        	Jean Rijkaard
 */
class Rajaongkir {
	public $api_key = "a9be232f35db2785c49e5345b5ae8f8a";

	public function getProvince() {
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://pro.rajaongkir.com/api/province",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: a9be232f35db2785c49e5345b5ae8f8a"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			return "cURL Error #:" . $err;
		} else {
			return $response;
		}
	}

	public function getCity($province) {
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://pro.rajaongkir.com/api/city?province=".$province,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: a9be232f35db2785c49e5345b5ae8f8a"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			return "cURL Error #:" . $err;
		} else {
			return $response;
		}
	}

	public function getSubDistrict($city) {
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://pro.rajaongkir.com/api/subdistrict?city=".$city,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: a9be232f35db2785c49e5345b5ae8f8a"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			return "cURL Error #:" . $err;
		} else {
			return $response;
		}
	}

	public function getOngkir($destinationCode, $destinationType, $weight) {
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://pro.rajaongkir.com/api/cost",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "origin=155&originType=city&destination=".$destinationCode."&destinationType=city&weight=".$weight."&courier=jne:pos:tiki:jnt",
		  CURLOPT_HTTPHEADER => array(
		    "content-type: application/x-www-form-urlencoded",
		    "key: a9be232f35db2785c49e5345b5ae8f8a"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  return "cURL Error #:" . $err;
		} else {
		  return $response;
		}
	}

	public function test(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://pro.rajaongkir.com/api/cost",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "origin=55&originType=city&destination=55&destinationType=city&weight=2230&courier=jne:pos:tiki:jnt",
		  CURLOPT_HTTPHEADER => array(
		    "content-type: application/x-www-form-urlencoded",
		    "key: a9be232f35db2785c49e5345b5ae8f8a"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  return "cURL Error #:" . $err;
		} else {
		  return $response;
		}
	}
}
