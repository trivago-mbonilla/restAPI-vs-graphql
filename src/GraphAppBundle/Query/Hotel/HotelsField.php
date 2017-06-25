<?php

namespace GraphAppBundle\Query\Hotel;

use GraphAppBundle\Entity\Hotel\Hotel;
use GraphAppBundle\Entity\Hotel\HotelType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\AbstractType;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

/**
 * Created by PhpStorm.
 * User: mbonilla
 * Date: 6/25/17
 * Time: 1:48 PM
 */
class HotelsField extends AbstractContainerAwareField
{
    public function build(FieldConfig $config)
    {
        $config->setDescription("Get all hotels");
    }

    public function resolve($parent, array $args, ResolveInfo $info)
    {
        $em = $this->container->get('doctrine')->getManager();
        $repository = $em->getRepository(Hotel::class);

        return $repository->findAll();
    }
    /**
     * @return ListType
     */
    public function getType()
    {
        return new ListType(new HotelType());
    }
}