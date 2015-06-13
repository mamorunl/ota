<?php
/**
 * Created by Bas Hepping <info@mamoru.nl>.
 * Date: 13-6-2015
 * Time: 20:42
 */

namespace mamorunl\OTA\Models;


use Exception;
use Illuminate\Support\Facades\Config;
use SoapHeader;
use SoapVar;

class OTAConnection
{
    protected $connection;

    public function __construct($name)
    {
        if (Config::has('providers.' . $name)) {
            $this->setConnection(Config::get('providers.' . $name));
        }
    }

    /**
     * Setup the connection to the OTA supplier
     *
     * @param array $connection_data
     *
     * @throws Exception
     */
    public function setConnection(array $connection_data)
    {
        if (!isset($connection_data['url']) || !isset($connection_data['username']) || !isset($connection_data['password'])) {
            throw new Exception('Invalid data array supplied');
        }

        $this->connection = new \SoapClient($connection_data['url'], [
            'trace'      => 1,
            'exceptions' => true
        ]);
        $this->connection->__setSoapHeaders($this->getHeaders($connection_data['username'], $connection_data['password']));
    }

    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Setup the headers for the SOAP connection
     *
     * @return SoapHeader
     */
    private function getHeaders($username, $password)
    {
        $header_part = '<wsse:Security xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
        SOAP-ENV:mustUnderstand="1">
<wsse:UsernameToken>
  <wsse:Username>' . $username . '</wsse:Username>
  <wsse:Password>' . $password . '</wsse:Password>
  </wsse:UsernameToken>
  </wsse:Security>
';
        $ns = "http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd";

        $soap_var_header = new SoapVar($header_part, XSD_ANYXML, null, null, null);
        $soap_header = new SoapHeader($ns, 'wsse', $soap_var_header);

        return $soap_header;
    }
}