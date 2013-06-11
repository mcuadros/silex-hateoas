<?php
namespace SilexHal;

use Symfony\Component\HttpFoundation\Response;
use Nocarrier\Hal;


class ResourceResponse extends Response
{
    const AS_JSON = 10;
    const AS_XML = 20;

    protected $data;
    protected $format;

    public function __construct($data = null, $status = 200, $headers = array())
    {
        parent::__construct('', $status, $headers);

        if (null === $data) {
            $data = new \ArrayObject();
        }

        $this->setData($data);
    }

    public static function create($data = null, $status = 200, $headers = array())
    {
        return new static($data, $status, $headers);
    }


    public function setData(Hal $data = null)
    {
        $this->data = $data;
        return $this->update();
    }

    public function setFormat($format = self::AS_JSON)
    {
        $this->format = $format;
        return $this->update();
    }

    protected function update()
    {
        $content = null;
        switch ($this->format) {
            case null:
            case self::AS_JSON:
                $mime = 'application/hal+json';
                if ($this->data) $content = $this->data->asJSON();
                break;
            case self::AS_XML:
                $mime = 'application/hal+xml';
                if ($this->data) $content = $this->data->asXML();
                break;
            default:
                throw new InvalidArgumentException(sprintf(
                    'Invalid format given "%d"', $this->format
                ));
                break;
        }

        $this->headers->set('Content-Type', $mime);
        return $this->setContent($content);
    }
}
