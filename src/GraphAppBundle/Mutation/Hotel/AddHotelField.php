<?php
/**
 * Created by PhpStorm.
 * User: mbonilla
 * Date: 6/25/17
 * Time: 2:11 PM
 */

namespace GraphAppBundle\Mutation\Hotel;


use Doctrine\ORM\EntityManager;
use GraphAppBundle\Entity\Hotel\Hotel;
use GraphAppBundle\Entity\Hotel\HotelType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class AddHotelField extends AbstractContainerAwareField
{
    public function build(FieldConfig $config)
    {
        $config->addArguments([
            'name' => new NonNullType(new StringType())
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info)
    {
        /** @var EntityManager $em */
        $em = $this->container->get('doctrine')->getManager();

        $hotel = new Hotel();
        $hotel->setName($args['name']);

        $em->persist($hotel);
        $em->flush();

        return $hotel;
    }

    /**
     * @return HotelType
     */
    public function getType()
    {
        return new HotelType();
    }
}