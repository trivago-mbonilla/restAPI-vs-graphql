<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Entity\Hotel;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class HotelRepositoryTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testSearchById()
    {
        $hotels = $this->em->getRepository(Hotel::class)->find(2);

        $this->assertCount(1, [$hotels]);
    }

    public function testSearchAll()
    {
        $hotels = $this->em->getRepository(Hotel::class)->findAll();

        $this->assertNotEmpty($hotels);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null; // avoid memory leaks
    }
}