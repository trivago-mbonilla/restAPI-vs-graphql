<?php
/**
 * Created by PhpStorm.
 * User: mbonilla
 * Date: 6/23/17
 * Time: 5:14 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Hotel;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class HotelController extends Controller
{
    /**
     * @ApiDoc(
     *     resource=true,
     *     description="Show all the hotels"
     * )
     *
     * @Route("/hotels", name="hotels")
     */
    public function showAllAction(EntityManagerInterface $em)
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $hotels = $em->getRepository('AppBundle:Hotel')->findAll();

        $jsonContent = $serializer->serialize($hotels, 'json');

        return new Response($jsonContent);
    }

    /**
     * @ApiDoc(
     *     resource=true,
     *     description="Create new hotel",
     *     input="string",
     *     output="AppBundle\Entity\Hotel"
     * )
     *
     * @Route("/hotels/create/{name}", name="new_hotel")
     */
    public function createAction($name, EntityManagerInterface $em)
    {
        // or fetch the em via the container
        $em = $this->get('doctrine')->getManager();

        $hotel = new Hotel();
        $hotel->setName($name);

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($hotel);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return new Response('Saved new hotel with id ' . $hotel->getId());
    }

    /**
     * @ApiDoc(
     *     resource=true,
     *     description="Create amount of hotels",
     *     input="integer",
     *     output="AppBundle\Entity\Hotel[]"
     * )
     * @Route("/hotels/create_amount/{amount}", name="new_amount")
     */
    public function createAmountAction(EntityManagerInterface $em, $amount)
    {
        foreach (range(0, $amount) as $n) {
            $hotel = new Hotel();
            $hotel->setName('hotel_' . $n);

            // tells Doctrine you want to (eventually) save the Product (no queries yet)
            $em->persist($hotel);

            // actually executes the queries (i.e. the INSERT query)
            $em->flush();
        }

        return new Response('Saved ' . $amount . ' hotels');
    }

    /**
     * @ApiDoc(
     *     resource=true,
     *     description="Get hotel",
     *     input="integer",
     *     output="AppBundle\Entity\Hotel"
     * )
     * @Route("/hotels/{hotelId}", name="get_hotel")
     */
    public function showAction($hotelId, EntityManagerInterface $em)
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $hotel = $em->getRepository('AppBundle:Hotel')
            ->find($hotelId);

        if (!$hotel) {
            throw $this->createNotFoundException(
                'No hotel found for id ' . $hotelId
            );
        }

        $jsonContent = $serializer->serialize($hotel, 'json');

        return new Response($jsonContent);
    }

    /**
     * @ApiDoc(
     *     resource=true,
     *     description="Update hotel",
     *     input="integer",
     *     input="string",
     *     output="AppBundle\Entity\Hotel"
     * )
     * @Route("/hotels/update/{hotelId}/{name}", name="update_hotel")
     */
    public function updateAction($hotelId, $name, EntityManagerInterface $em)
    {
        $hotel = $em->getRepository('AppBundle:Hotel')->find($hotelId);

        if (!$hotel) {
            throw $this->createNotFoundException(
                'No product found for id ' . $hotelId
            );
        }

        $hotel->setName($name);
        $em->flush();

        return $this->redirect('/hotels/'.$hotelId);
    }

    /**
     * @ApiDoc(
     *     resource=true,
     *     description="Delete hotel",
     *     input="integer",
     *     output="AppBundle\Entity\Hotel[]"
     * )
     * @Route("/hotels/delete/{hotelId}", name="delete_hotel")
     */
    public function deleteAction($hotelId, EntityManagerInterface $em)
    {
        $hotel = $em->getRepository('AppBundle:Hotel')->find($hotelId);

        if (!$hotel) {
            throw $this->createNotFoundException(
                'No product found for id ' . $hotelId
            );
        }
        $em->remove($hotel);
        $em->flush();

        return $this->redirectToRoute('hotels');
    }
}