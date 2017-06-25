<?php
/**
 * Created by PhpStorm.
 * User: mbonilla
 * Date: 6/25/17
 * Time: 2:00 PM
 */

namespace GraphAppBundle\Entity\Hotel;


use Youshido\GraphQL\Config\Object\InputObjectTypeConfig;
use Youshido\GraphQL\Type\InputObject\AbstractInputObjectType;
use Youshido\GraphQL\Type\Scalar\StringType;

class HotelTypeInput extends AbstractInputObjectType
{

    /**
     * @param InputObjectTypeConfig $config
     */
    public function build($config)
    {
        $config->addFields([
            'name' => new StringType()
        ]);
    }
}