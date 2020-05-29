<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\Facturapi_Exception;

class Organizations extends BaseClient
{
  protected $ENDPOINT = 'organizations';
  protected $API_VERSION = 'v1';


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
      throw new Facturapi_Exception('Unable to get organizations: ' . $e);
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
      throw new Facturapi_Exception('Unable to get organization: ' . $e);
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
      throw new Facturapi_Exception('Unable to create organization: ' . $e);
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
      throw new Facturapi_Exception('Unable to update organization\'s legal information: ' . $e);
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
      throw new Facturapi_Exception('Unable to update organization\'s customization information: ' . $e);
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
      throw new Facturapi_Exception('Unable to update organization\'s receipt settings: ' . $e);
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
      throw new Facturapi_Exception('Unable to update organization\'s domain: ' . $e);
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
          $this->get_request_url("domain-check" . $this->array_to_params( $params ))
        )
      );
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception('Unable to check domain\'s availability: ' . $e);
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
      throw new Facturapi_Exception('Unable to upload organization\'s logo: ' . $e);
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
      throw new Facturapi_Exception('Unable to upload organization\'s certificate (CSD): ' . $e);
    }
  }

  /**
   * Get the Api Keys for an Organization
   *
   * @param id : Unique ID for Organization
   *
   * @return JSON object for requested Organization
   *
   * @throws Facturapi_Exception
   **/
  public function getApiKeys($id)
  {
    try {
      return json_decode($this->execute_get_request($this->get_request_url($id) . "/apikeys"));
    } catch (Facturapi_Exception $e) {
      throw new Facturapi_Exception('Unable to get organization\'s api keys: ' . $e);
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
      throw new Facturapi_Exception('Unable to delete organization: ' . $e);
    }
  }
}
