<?php
/**
 * @licence Proprietary
 */
namespace Auth\HttpApiBundle\Security\Encoder;

use Devolicious\SilexTurboApiBundle\Security\Encoder\ApiEncoder as BaseEncoder;

/**
 * Class ApiEncoder
 *
 * @author Joseph LEMOINE <j.lemoine@ludi.cat>
 */
class ApiEncoder extends BaseEncoder
{
    /**
     * @param string $username
     * @param string $apiKey
     * @param int $days
     *
     * @return string
     */
    public function hash($username, $apiKey, int $days = 0)
    {
        $day = new \DateTime();
        if (0 !== $days) {
            $day->modify(sprintf('%d day', $day));
        }
        
        return md5(strtolower($username).$day->format('d-m-Y').$apiKey);
    }

    /**
     * Check on day before and after the current one to avoid timezone issues
     * 
     * @param string $hash
     * @param string $username
     * @param string $apiKey
     *
     * @return bool
     */
    public function isHashValid($hash, $username, $apiKey)
    {
        return in_array($hash, [
            $this->hash($username, $apiKey, -1),
            $this->hash($username, $apiKey),
            $this->hash($username, $apiKey, 1),
        ]);
    }
}
