<?php
namespace App\DataPersister;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Referentiel;

final class ReferentielDataPersister implements ContextAwareDataPersisterInterface
{
    
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
      $this->manager=$manager;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Referentiel;
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
    }

    
}
