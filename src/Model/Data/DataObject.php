<?php
/**
 * @author      Open Source Team
 * @copyright   2022 Pagar.me (https://pagar.me)
 * @license     https://pagar.me Copyright
 *
 * @link        https://pagar.me
 */

declare( strict_types=1 );

namespace Woocommerce\Pagarme\Model\Data;

use ReturnTypeWillChange;
use Woocommerce\Pagarme\Model\Serialize\Serializer\Json;

defined( 'ABSPATH' ) || exit;

/**
 * Class DataObject
 * @package Woocommerce\Pagarme\Model\Data
 */
class DataObject implements \ArrayAccess
{
    /**
     * Object attributes
     * @var array
     */
    protected $_data = [];

    /** @var Json */
    private $jsonSerialize;

    /**
     * @var array
     */
    protected static $_underscoreCache = [];

    /**
     * @param Json|null $jsonSerialize
     * @param array $data
     */
    public function __construct(
        Json $jsonSerialize = null,
        array $data = []
    ) {
        $this->_data = $data;
        if (!$jsonSerialize) {
            $jsonSerialize = new Json();
        }
        $this->jsonSerialize = $jsonSerialize;
    }

    /**
     * @param array $arr
     * @return $this
     */
    public function addData(array $arr)
    {
        foreach ($arr as $index => $value) {
            $this->setData($index, $value);
        }
        return $this;
    }

    /**
     * @param string|array $key
     * @param mixed $value
     * @return $this
     */
    public function setData($key, $value = null)
    {
        if ($key === (array)$key) {
            $this->_data = $key;
        } else {
            $this->_data[$key] = $value;
        }

        /**
         * [custom]
         * Customização de Empresas
         * Para o funcionamento da Divisão de Faturamento
         * Studio Visual - Gustavo Henrique
         * 2024-11-06
         */
        if (!empty( $_COOKIE['_company_cnpj'] )) {
            //Verificar o CNPJ da empresa selecionada pelo usuário
            $select_company = $_COOKIE['_company_cnpj'];

            //Registro de Keys das empresa Pagarme
            $companies = [
                //Grudado em Você
                '12.863.194/0001-38' => [
                    'prod' => [
                        'hub_install_id' => 'e097689a-8d6d-4bf5-bb71-83bf119a626e',
                        'hub_environment' => 'Production',
                        'production_secret_key' => 'acs_666666c500ac43dbadb8d89f3ecca75777cb9eae48f59bfca04509de3edd',
                        'production_public_key' => 'pk_QaRqQ02SLt8RABPG',
                        'account_id' => 'acc_3v4LleNi1s23zj9G',
                        'merchant_id' => 'merch_2vY1Va3IYdcNDeK7',
                    ],
                    'sandbox' => [
                        'hub_install_id' => '0a9c4b17-1891-4a3a-a76e-064a9270d8c4',
                        'hub_environment' => 'Sandbox',
                        'production_secret_key' => 'acs_test_3b16baa5948aa3886b00aaafc444392c2b84afea51b6e119034c4eb',
                        'production_public_key' => 'pk_test_d46LD4RLF3hdkVMw',
                        'account_id' => 'acc_VKX49xLCvXHkPkbw',
                        'merchant_id' => 'merch_2vY1Va3IYdcNDeK7',
                    ],
                ],
                //Tudo Identificado
                '30.645.437/0001-43' => [
                    'prod' => [
                        'hub_install_id' => 'c34a46df-da8a-4487-b4ac-d83210d73ea7',
                        'hub_environment' => 'Production',
                        'production_secret_key' => 'acs_666666c500ac43dbadb8d89f3eccec00e7adefc34093ad29f0c7778bf055',
                        'production_public_key' => 'pk_wWpX7BZTNhpoyBlJ',
                        'account_id' => 'acc_eDBleOSm2izZL92r',
                        'merchant_id' => 'merch_bLDw60kHKOi3WGZo',
                    ],
                    'sandbox' => [
                        'hub_install_id' => '183503ca-30ff-442c-8a82-bd158e84076e',
                        'hub_environment' => 'Sandbox',
                        'production_secret_key' => 'acs_test_3b16baa5948aa3886b00aaa9d5f7ccca2a24ce8917207aa53234caf',
                        'production_public_key' => 'pk_test_Xvw2J3LtXXfWnPxa',
                        'account_id' => 'acc_9PAaMxh9JTlegl7O',
                        'merchant_id' => 'merch_bLDw60kHKOi3WGZo',
                    ],
                ],
                //Melhores Etiquetas
                '46.740.332/0001-03' => [
                    'prod' => [
                        'hub_install_id' => '24107efb-2003-4152-8bda-47eccbda55da',
                        'hub_environment' => 'Production',
                        'production_secret_key' => 'acs_666666c500ac43dbadb8d89f3ecc82ad03b99f784d7cab002383e9a6ee5e',
                        'production_public_key' => 'pk_yW16P41DtGc5djw7',
                        'account_id' => 'acc_jA3elnM2Unh94MO6',
                        'merchant_id' => 'merch_Y1yNj0IpnIOwXPle',
                    ],
                    'sandbox' => [
                        'hub_install_id' => 'a1307205-439e-477d-98b0-647476ae692d',
                        'hub_environment' => 'Sandbox',
                        'production_secret_key' => 'acs_test_3b16baa5948aa3886b00aaa4caa05bb7c8f4dab891042bc6d7ab8b9',
                        'production_public_key' => 'pk_test_8egLEWKUvcREpQNw',
                        'account_id' => 'acc_bBA2ZlgHqBUoLkqw',
                        'merchant_id' => 'merch_Y1yNj0IpnIOwXPle',
                    ],
                ],
                // //Studio Visual - Para teste
                // '0001' => [
                //     'prod' => [
                //         'hub_install_id' => 'dea18631-0097-4856-9175-8c095fb37158',
                //         'hub_environment' => 'Production',
                //         'production_secret_key' => 'acs_666666c500ac43dbadb8d89f3eccfa04288f57b1489c90faf20911ce78df',
                //         'production_public_key' => 'pk_58EqG3rfgf8Rk7Ww',
                //         'account_id' => 'acc_bBxO7N8HLHjVXdQ6',
                //         'merchant_id' => 'merch_6YR9jKf8MIr6aPDK',
                //     ],
                //     'sandbox' => [
                //         'hub_install_id' => 'dea18631-0097-4856-9175-8c095fb37158',
                //         'hub_environment' => 'Production',
                //         'production_secret_key' => 'acs_666666c500ac43dbadb8d89f3eccfa04288f57b1489c90faf20911ce78df',
                //         'production_public_key' => 'pk_58EqG3rfgf8Rk7Ww',
                //         'account_id' => 'acc_bBxO7N8HLHjVXdQ6',
                //         'merchant_id' => 'merch_6YR9jKf8MIr6aPDK',
                //     ],
                // ],
            ];

            //Verifica se a empresa existe
            if (!empty($companies[$select_company])) {
                //Verifica se o ambiente é o de produção
                //Caso seja, irá usar as KEYs de prod, caso não seja, irá usar as KEYs de sandbox
                $environment = ( $_SERVER['HTTP_HOST'] == 'www.grudadoemvoce.com.br') ? 'prod' : 'sandbox';
                //Seleciona dados da empresa
                $company = $companies[$select_company][$environment];
                //Verifica se é um campo que precisa ser customizado
                if (
                    $key == 'hub_install_id' ||
                    $key == 'hub_environment' ||
                    $key == 'production_secret_key' ||
                    $key == 'production_public_key' ||
                    $key == 'account_id' ||
                    $key == 'merchant_id'
                ) {
                    //Atualiza o valor
                    $this->_data[$key] = $company[$key];
                }
            }
        }

        return $this;
    }

    /**
     * @param null|string|array $key
     * @return $this
     */
    public function unsetData($key = null)
    {
        if ($key === null) {
            $this->setData([]);
        } elseif (is_string($key)) {
            if (isset($this->_data[$key]) || array_key_exists($key, $this->_data)) {
                unset($this->_data[$key]);
            }
        } elseif ($key === (array)$key) {
            foreach ($key as $element) {
                $this->unsetData($element);
            }
        }
        return $this;
    }

    /**
     * @param string|null $key
     * @param string|int $index
     * @return mixed
     */
    public function getData($key = null, $index = null)
    {
        if (!$key) {
            return $this->_data;
        }
        if (strpos($key, '/') !== false) {
            $data = $this->getDataByPath($key);
        } else {
            $data = $this->_getData($key);
        }

        if ($index) {
            if ($data === (array)$data) {
                $data = $data[$index] ?? null;
            } elseif (is_string($data)) {
                $data = explode(PHP_EOL, $data);
                $data = $data[$index] ?? null;
            } elseif ($data instanceof $this) {
                $data = $data->getData($index);
            } else {
                $data = null;
            }
        }
        return $data;
    }

    /**
     * @param string $path
     * @return mixed
     */
    public function getDataByPath(string $path)
    {
        $keys = explode('/', $path);

        $data = $this->_data;
        foreach ($keys as $key) {
            if ((array)$data === $data && isset($data[$key])) {
                $data = $data[$key];
            } elseif ($data instanceof DataObject) {
                $data = $data->getDataByKey($key);
            } else {
                return null;
            }
        }
        return $data;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getDataByKey(string $key)
    {
        return $this->_getData($key);
    }

    /**
     * @param   string $key
     * @return  mixed
     */
    protected function _getData(string $key)
    {
        if (isset($this->_data[$key])) {
            return $this->_data[$key];
        }
        return null;
    }

    /**
     * @param string $key
     * @param mixed $args
     * @return $this
     */
    public function setDataUsingMethod($key, $args = [])
    {
        $method = 'set' . str_replace('_', '', ucwords($key, '_'));
        $this->{$method}($args);
        return $this;
    }

    /**
     * @param string $key
     * @param mixed $args
     * @return mixed
     */
    public function getDataUsingMethod($key, $args = null)
    {
        $method = 'get' . str_replace('_', '', ucwords($key, '_'));
        return $this->{$method}($args);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasData($key = '')
    {
        if (empty($key) || !is_string($key)) {
            return !empty($this->_data);
        }
        return array_key_exists($key, $this->_data);
    }

    /**
     * @param array $keys array of required keys
     * @return array
     */
    public function toArray(array $keys = [])
    {
        if (empty($keys)) {
            return $this->_data;
        }
        $result = [];
        foreach ($keys as $key) {
            if (isset($this->_data[$key])) {
                $result[$key] = $this->_data[$key];
            } else {
                $result[$key] = null;
            }
        }
        return $result;
    }

    /**
     * @param  array $keys
     * @return array
     */
    public function convertToArray(array $keys = [])
    {
        return $this->toArray($keys);
    }

    /**
     * @param array $keys array of keys that must be represented
     * @param string $rootName root node name
     * @param bool $addOpenTag flag that allow to add initial xml node
     * @param bool $addCdata flag that require wrap all values in CDATA
     * @return string
     */
    public function toXml(array $keys = [], $rootName = 'item', $addOpenTag = false, $addCdata = true)
    {
        $xml = '';
        $data = $this->toArray($keys);
        foreach ($data as $fieldName => $fieldValue) {
            if ($addCdata === true) {
                $fieldValue = "<![CDATA[{$fieldValue}]]>";
            } else {
                $fieldValue = str_replace(
                    ['&', '"', "'", '<', '>'],
                    ['&amp;', '&quot;', '&apos;', '&lt;', '&gt;'],
                    $fieldValue
                );
            }
            $xml .= "<{$fieldName}>{$fieldValue}</{$fieldName}>\n";
        }
        if ($rootName) {
            $xml = "<{$rootName}>\n{$xml}</{$rootName}>\n";
        }
        if ($addOpenTag) {
            $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . $xml;
        }
        return $xml;
    }

    /**
     * @param array $arrAttributes array of keys that must be represented
     * @param string $rootName root node name
     * @param bool $addOpenTag flag that allow to add initial xml node
     * @param bool $addCdata flag that require wrap all values in CDATA
     * @return string
     */
    public function convertToXml(
        array $arrAttributes = [],
              $rootName = 'item',
              $addOpenTag = false,
              $addCdata = true
    ) {
        return $this->toXml($arrAttributes, $rootName, $addOpenTag, $addCdata);
    }

    /**
     * @param array $keys array of required keys
     * @return bool|string
     * @throws \InvalidArgumentException
     */
    public function toJson(array $keys = [])
    {
        return $this->jsonSerialize->serialize($this->toArray($keys));
    }

    /**
     * @param array $keys
     * @return bool|string
     * @throws \InvalidArgumentException
     */
    public function convertToJson(array $keys = [])
    {
        return $this->toJson($keys);
    }

    /**
     * @param string $format
     * @return string
     */
    public function toString($format = '')
    {
        if (empty($format)) {
            $result = implode(', ', $this->getData());
        } else {
            preg_match_all('/\{\{([a-z0-9_]+)\}\}/is', $format, $matches);
            foreach ($matches[1] as $var) {
                $format = str_replace('{{' . $var . '}}', $this->getData($var), $format);
            }
            $result = $format;
        }
        return $result;
    }

    /**
     * @param string $method
     * @param array $args
     * @return  mixed
     * @throws \Exception
     */
    public function __call($method, $args)
    {
        switch (substr($method, 0, 3)) {
            case 'get':
                $key = $this->_underscore(substr($method, 3));
                $index = isset($args[0]) ? $args[0] : null;
                return $this->getData($key, $index);
            case 'set':
                $key = $this->_underscore(substr($method, 3));
                $value = isset($args[0]) ? $args[0] : null;
                return $this->setData($key, $value);
            case 'uns':
                $key = $this->_underscore(substr($method, 3));
                return $this->unsetData($key);
            case 'has':
                $key = $this->_underscore(substr($method, 3));
                return isset($this->_data[$key]);
        }
        throw new \Exception(sprintf('Invalid method %1::%2', get_class($this), $method));
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        if (empty($this->_data)) {
            return true;
        }
        return false;
    }

    /**
     * @param string $name
     * @return string
     */
    protected function _underscore($name)
    {
        if (isset(self::$_underscoreCache[$name])) {
            return self::$_underscoreCache[$name];
        }
        $result = strtolower(trim(preg_replace('/([A-Z]|[0-9]+)/', "_$1", $name), '_'));
        self::$_underscoreCache[$name] = $result;
        return $result;
    }

    /**
     * @param   array $keys array of accepted keys
     * @param   string $valueSeparator separator between key and value
     * @param   string $fieldSeparator separator between key/value pairs
     * @param   string $quote quoting sign
     * @return  string
     */
    public function serialize($keys = [], $valueSeparator = '=', $fieldSeparator = ' ', $quote = '"')
    {
        $data = [];
        if (empty($keys)) {
            $keys = array_keys($this->_data);
        }
        foreach ($this->_data as $key => $value) {
            if (in_array($key, $keys)) {
                $data[] = $key . $valueSeparator . $quote . $value . $quote;
            }
        }
        $res = implode($fieldSeparator, $data);
        return $res;
    }

    /**
     * @param mixed $data
     * @param array &$objects
     * @return array
     */
    public function debug($data = null, &$objects = [])
    {
        if ($data === null) {
            $hash = spl_object_hash($this);
            if (!empty($objects[$hash])) {
                return '*** RECURSION ***';
            }
            $objects[$hash] = true;
            $data = $this->getData();
        }
        $debug = [];
        foreach ($data as $key => $value) {
            if (is_scalar($value)) {
                $debug[$key] = $value;
            } elseif (is_array($value)) {
                $debug[$key] = $this->debug($value, $objects);
            } elseif ($value instanceof DataObject) {
                $debug[$key . ' (' . get_class($value) . ')'] = $value->debug(null, $objects);
            }
        }
        return $debug;
    }

    /**
     * @param string $offset
     * @param mixed $value
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        $this->_data[$offset] = $value;
    }

    /**
     * @param string $offset
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function offsetExists($offset)
    {
        return isset($this->_data[$offset]) || array_key_exists($offset, $this->_data);
    }

    /**
     * Implementation of \ArrayAccess::offsetUnset()
     * @param string $offset
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        unset($this->_data[$offset]);
    }

    /**
     * Implementation of \ArrayAccess::offsetGet()
     * @param string $offset
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        if (isset($this->_data[$offset])) {
            return $this->_data[$offset];
        }
        return null;
    }
}
