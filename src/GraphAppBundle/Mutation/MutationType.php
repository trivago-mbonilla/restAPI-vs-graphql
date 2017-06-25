<?php
/**
 * Created by PhpStorm.
 * User: mbonilla
 * Date: 6/25/17
 * Time: 2:10 PM
 */

namespace GraphAppBundle\Mutation;


use GraphAppBundle\Mutation\Hotel\AddHotelField;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\Object\AbstractObjectType;

class MutationType extends  AbstractObjectType
{

    /**
     * @param ObjectTypeConfig $config
     */
    public function build($config)
    {
        $config->addFields([
            new AddHotelField()
        ]);
    }
}