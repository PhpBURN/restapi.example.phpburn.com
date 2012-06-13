<?php

class RestTools {

  public static function parseBody($rawBody, $from = 'json') {
    $from = strtoupper($from);

    if (method_exists(RestTools, "parseBody$from")) {
      return call_user_func_array(array(RestTools, "parseBody$from"), array($rawBody));
    } else {
      return FALSE;
    }
  }

  /**
   * This process a rawBody string into a JSON format and return it into a stdClass object
   * @param String $rawBody 
   * @return stdClass
   */
  private static function parseBodyJSON($rawBody) {
    return json_decode($rawBody);
  }

  /**
   * This process a rawBody from a multipart/form-data format and return it into
   * a stdClass object
   * 
   * @param String $rawBody 
   * @return stdClass
   */
  private static function parseBodyFORMDATA($rawBody) {
    parse_str($rawBody, $data);
    return json_decode(json_encode($data));
  }

  /**
   * This process a rawBody from a multipart/form-data format and return it into
   * a stdClass object
   * 
   * @param String $rawBody 
   * @return stdClass
   */
  private static function parseBodyXML($rawBody) {
    return json_decode(json_encode(simplexml_load_string($rawBody)));
  }

  public static function sendResponse($status = 200, array $body = array(), $content_type = 'application/json', $format = 'json') {
    $statusHeader = 'HTTP/1.1 ' . $status . ' ' . self::getStatusCodeMessage($status);
    header($statusHeader, true, $status);
    header('Content-type: ' . $content_type);

    if(count($body) > 0) {
      print json_encode($body);
    }
  }

  public static function getStatusCodeMessage($code) {
    $codes = Array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => '(Unused)',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported'
    );

    return (isset($codes[$code])) ? $codes[$code] : '';
  }

}

?>