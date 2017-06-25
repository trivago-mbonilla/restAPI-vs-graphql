<?php
/**
 * Created by PhpStorm.
 * User: mbonilla
 * Date: 6/25/17
 * Time: 1:55 PM
 */

namespace GraphAppBundle\Entity\Hotel;


use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\StringType;

class HotelType extends AbstractObjectType
{

    /**
     * @param ObjectTypeConfig $config
     */
    public function build($config)
    {
        $config->addFields([
            'id'   => new IdType(),
            'name' => new StringType(),
        ]);
    }
}