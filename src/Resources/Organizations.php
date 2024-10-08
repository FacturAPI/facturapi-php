<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\Facturapi_Exception;

class Organizations extends BaseClient
{
  protected $ENDPOINT = 'organizations';


  /**
   * Get all Organizations
   *
   * @param Search parameters
   *
   * @return JSON objects for all Organizations
   *
   * @throws Facturapi_Exception
   **/
  public function all($params = null)
  {
    try {
      return json_decode($this->execute_get_request($this->get_request_url($params)));
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception('Unable to get organizations: ' . $e->getMessage());
    }
  }

  /**
   * Get a Organization by ID
   *
   * @param id : Unique ID for Organization
   *
   * @return JSON object for requested Organization
   *
   * @throws Facturapi_Exception
   **/
  public function retrieve($id)
  {
    try {
      return json_decode($this->execute_get_request($this->get_request_url($id)));
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception('Unable to get organization: ' . $e->getMessage());
    }
  }

  /**
   * Create a Organization
   *
   * @param params : array of properties and property values for new Organization
   *
   * @return Response body with JSON object
   * for created Organization from HTTP POST request
   *
   * @throws Facturapi_Exception
   **/
  public function create($params)
  {
    try {
      return json_decode($this->execute_JSON_post_request($this->get_request_url(), $params));
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception('Unable to create organization: ' . $e->getMessage());
    }
  }

  /**
   * Update a Organization's legal information
   *
   * @param $id
   * @param $params array of properties and property values for Organization's legal information
   *
   * @return Response body from HTTP PUT request
   *
   * @throws Facturapi_Exception
   *
   */
  public function updateLegal($id, $params)
  {
    try {
      return json_decode($this->execute_JSON_put_request($this->get_request_url($id) . "/legal", $params));
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception('Unable to update organization\'s legal information: ' . $e->getMessage());
    }
  }

  /**
   * Update a Organization's customization information
   *
   * @param $id
   * @param $params array of properties and property values for Organization's customization information
   *
   * @return Response body from HTTP PUT request
   *
   * @throws Facturapi_Exception
   *
   */
  public function updateCustomization($id, $params)
  {
    try {
      return json_decode($this->execute_JSON_put_request($this->get_request_url($id) . "/customization", $params));
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception('Unable to update organization\'s customization information: ' . $e->getMessage());
    }
  }

  /**
   * Update a Organization's receipt settings
   *
   * @param $id
   * @param $params array of properties and property values for Organization's receipt settings
   *
   * @return Response body from HTTP PUT request
   *
   * @throws Facturapi_Exception
   *
   */
  public function updateReceiptSettings($id, $params)
  {
    try {
      return json_decode($this->execute_JSON_put_request($this->get_request_url($id) . "/receipts", $params));
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception('Unable to update organization\'s receipt settings: ' . $e->getMessage());
    }
  }

  /**
   * Update the Organization's domain
   *
   * @param $id Organization Id
   * @param $params array of properties and property values for the Organization's domain
   *
   * @return Response body from HTTP PUT request
   *
   * @throws Facturapi_Exception
   *
   */
  public function updateDomain($id, $params)
  {
    try {
      return json_decode($this->execute_JSON_put_request($this->get_request_url($id) . "/domain", $params));
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception('Unable to update organization\'s domain: ' . $e->getMessage());
    }
  }

  /**
   * Update the Organization's domain
   *
   * @param $id Organization Id
   * @param $params array of properties and property values for the Organization's domain
   *
   * @return Response body from HTTP PUT request
   *
   * @throws Facturapi_Exception
   *
   */
  public function checkDomainIsAvailable($id, $params)
  {
    try {
      return json_decode(
        $this->execute_get_request(
          $this->get_request_url("domain-check" . $this->array_to_params($params))
        )
      );
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception('Unable to check domain\'s availability: ' . $e->getMessage());
    }
  }

  /**
   * Uploads the organization's logo
   *
   * @param $id
   * @param $params array of properties and property values for Organization's logo
   *
   * @return Response body from HTTP PUT request
   *
   * @throws Facturapi_Exception
   *
   */
  public function uploadLogo($id, $params)
  {
    try {
      return json_decode($this->execute_data_put_request($this->get_request_url($id) . "/logo", $params));
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception('Unable to upload organization\'s logo: ' . $e->getMessage());
    }
  }

  /**
   * Uploads the organization's certificate (CSD)
   *
   * @param $id
   * @param $params array of properties and property values for organization's certificate (CSD)
   *
   * @return Response body from HTTP PUT request
   *
   * @throws Facturapi_Exception
   *
   */
  public function uploadCertificate($id, $params)
  {
    try {
      return json_decode($this->execute_data_put_request($this->get_request_url($id) . "/certificate", $params));
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception('Unable to upload organization\'s certificate (CSD): ' . $e->getMessage());
    }
  }

  /**
   * Get the Test Api Key for an Organization
   *
   * @param id : Unique ID for Organization
   *
   * @return String Test Api Key
   *
   * @throws Facturapi_Exception
   **/
  public function getTestApiKey($id)
  {
    try {
      return json_decode($this->execute_get_request($this->get_request_url($id) . "/apikeys/test"));
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception('Unable to get organization\'s test key: ' . $e->getMessage());
    }
  }

  /**
   * Renews the Test Api Key for an Organization and makes the previous one inactive
   *
   * @param id : Unique ID for Organization
   *
   * @return String Test Api Key
   *
   * @throws Facturapi_Exception
   **/
  public function renewTestApiKey($id)
  {
    try {
      return json_decode(
        $this->execute_JSON_put_request(
          $this->get_request_url($id) . "/apikeys/test",
          []
        )
      );
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception('Unable to renew organization\'s test key: ' . $e->getMessage());
    }
  }

  /**
   * Renews the Test Api Key for an Organization and makes the previous one inactive
   *
   * @param id : Unique ID for Organization
   *
   * @return Array Array of object with first_12 characters, created_at field and id field
   *
   * @throws Facturapi_Exception
   **/
  public function lisLiveApiKeys($id)
  {
    try {
      return json_decode(
        $this->execute_get_request(
          $this->get_request_url($id) . "/apikeys/live",
          []
        )
      );
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception($e);
    }
  }


  /**
   * Renews the Test Api Key for an Organization and makes the previous one inactive
   *
   * @param id : Unique ID for Organization
   *
   * @return String Live Api Key
   *
   * @throws Facturapi_Exception
   **/
  public function renewLiveApiKey($id)
  {
    try {
      return json_decode(
        $this->execute_JSON_put_request(
          $this->get_request_url($id) . "/apikeys/live",
          []
        )
      );
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception('Unable to renew organization\'s live key: ' . $e->getMessage());
    }
  }

  /**
   * Deletes the Test Api Key for an Organization and makes the previous one inactive
   *
   * @param organizationId : Unique ID for Organization
   * @param apiKeyId: Unique ID for the Api Key
   *
   * @return Array Array of object with first_12 characters, created_at field and id field
   *
   * @throws Facturapi_Exception
   **/
  public function deleteLiveApiKey($organizationId, $apiKeyId)
  {
    try {
      return json_decode(
        $this->execute_JSON_put_request(
          $this->get_request_url($organizationId) . "/apikeys/live" . "/" . $apiKeyId,
          []
        )
      );
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception($e);
    }
  }

  /**
   * Delete a Organization
   *
   * @param id : Unique ID for the Organization
   *
   * @return Response body from HTTP DELETE request
   *
   * @throws Facturapi_Exception
   **/
  public function delete($id)
  {
    try {
      return json_decode($this->execute_delete_request($this->get_request_url($id), null));
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception('Unable to delete organization: ' . $e->getMessage());
    }
  }

  /**
   * Delete a Organization's Certificate
   *
   * @param id : Unique ID for the Organization
   *
   * @return Response body from HTTP DELETE request
   *
   * @throws Facturapi_Exception
   **/
  public function deleteCertificate($id)
  {
    try {
      return json_decode($this->execute_delete_request($this->get_request_url($id) .  "/certificate", null));
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception('Unable to delete organization: ' . $e->getMessage());
    }
  }

  /**
   * Get the series of an Organization
   *
   * @param id : Unique ID for the Organization
   *
   * @return Response body from HTTP GET request
   *
   * @throws Facturapi_Exception
   **/
  public function getSeriesGroup($id)
  {
    try {
      return json_decode($this->execute_get_request($this->get_request_url($id) . "/series-group"));
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception('Unable to find series: ' . $e);
    }
  }

  /**
   * Create a Series Organization
   * 
   * @param id : Unique ID for the Organization
   * 
   *
   * @param params : object of properties and property values for new Series Organization
   *
   * @return Response body with JSON object
   * for created Organization from HTTP POST request
   *
   * @throws Facturapi_Exception
   **/
  public function createSeriesGroup($id, $params)
  {
    try {
      return json_decode($this->execute_JSON_post_request($this->get_request_url($id) . "/series-group", $params));
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception('Unable to create series: ' . $e);
    }
  }

  /**
   * Update a Series Organization
   * 
   * @param id : Unique ID for the Organization
   * 
   * @param series_name: Name of the series to update
   *
   * @param params : object of properties and property values for updated Series Organization
   *
   * @return Response body with JSON object
   * for updated Series Organization from HTTP POST request
   *
   * @throws Facturapi_Exception
   **/
  public function updateSeriesGroup($id, $series_name, $params)
  {
    try {
      return json_decode($this->execute_JSON_put_request($this->get_request_url($id) . "/series-group" . "/" . $series_name, $params));
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception('Unable to create series: ' . $e);
    }
  }

  /**
   * Delete a Series Organization
   * 
   * @param id : Unique ID for the Organization
   * 
   * @param series_name: Name of the series to update
   *
   * @param params : object of properties and property values for new Series Organization
   *
   * @return Response body with JSON object
   * for delete Series Organization from HTTP DELETE request
   *
   * @throws Facturapi_Exception
   **/
  public function deleteSeriesGroup($id, $series_name)
  {
    try {
      return json_decode($this->execute_delete_request($this->get_request_url($id) . "/series-group" . "/" . $series_name, null));
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception('Unable to create series: ' . $e);
    }
  }
}
