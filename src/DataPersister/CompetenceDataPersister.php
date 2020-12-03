<?php
namespace App\DataPersister;

use App\Entity\User;
use App\Entity\Competence;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

final class CompetenceDataPersister implements ContextAwareDataPersisterInterface
{
    
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
      $this->manager=$manager;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Competence;
    }

    public function persist($data, array $context = [])
    {
      // call your persistence layer to save $data
      $this->manager->persist($data);
      $this->manager->flush();
      return $data;
    }

    public function remove($data, array $context = [])
    {}

    
}
