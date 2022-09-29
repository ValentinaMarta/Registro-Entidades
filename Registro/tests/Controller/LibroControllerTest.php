<?php

namespace App\Test\Controller;

use App\Entity\Libro;
use App\Repository\LibroRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LibroControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private LibroRepository $repository;
    private string $path = '/libro/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Libro::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Libro index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'libro[nombre]' => 'Testing',
            'libro[autora]' => 'Testing',
            'libro[editorial]' => 'Testing',
            'libro[precio]' => 'Testing',
        ]);

        self::assertResponseRedirects('/libro/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Libro();
        $fixture->setNombre('My Title');
        $fixture->setAutora('My Title');
        $fixture->setEditorial('My Title');
        $fixture->setPrecio('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Libro');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Libro();
        $fixture->setNombre('My Title');
        $fixture->setAutora('My Title');
        $fixture->setEditorial('My Title');
        $fixture->setPrecio('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'libro[nombre]' => 'Something New',
            'libro[autora]' => 'Something New',
            'libro[editorial]' => 'Something New',
            'libro[precio]' => 'Something New',
        ]);

        self::assertResponseRedirects('/libro/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNombre());
        self::assertSame('Something New', $fixture[0]->getAutora());
        self::assertSame('Something New', $fixture[0]->getEditorial());
        self::assertSame('Something New', $fixture[0]->getPrecio());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Libro();
        $fixture->setNombre('My Title');
        $fixture->setAutora('My Title');
        $fixture->setEditorial('My Title');
        $fixture->setPrecio('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/libro/');
    }
}
