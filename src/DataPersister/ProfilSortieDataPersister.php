<?php
namespace App\DataPersister;

use App\Entity\ProfilDeSortie;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

final class ProfilSortieDataPersister implements ContextAwareDataPersisterInterface
{
    private $manager;
    public function __construct(EntityManagerInterface $manager)
    {
      $this->manager=$manager;
    }
    public function supports($data, array $context = []): bool
    {
        return $data instanceof ProfilDeSortie;
    }

    public function persist($data, array $context = [])
    {
      // call your persistence layer to save $data
      $this->manager->persist($data);
      $this->manager->flush();
      return $data;
    }

    public function remove($data, array $context = [])
    {
      $data->setStatus(false); 
      $this->manager->persist($data);
      $this->manager->flush();
      // call your persistence layer to delete $data
    }
}
?>