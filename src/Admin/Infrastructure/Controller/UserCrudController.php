<?php

namespace App\Admin\Infrastructure\Controller;

use App\Users\Domain\Entity\User;
use App\Users\Domain\Entity\ValueObject\UserRoles;
use App\Users\Domain\Factory\UserFactory;
use App\Users\Infrastructure\Service\UserPasswordHasher;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{

    public function __construct(private readonly UserPasswordHasherInterface $basePasswordHasher)
    {

    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance->getVirtualRole()) {
            $entityInstance->setRoles([$entityInstance->getVirtualRole()]);
        }
        parent::updateEntity($entityManager, $entityInstance);
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance->getVirtualRole()) {
            $entityInstance->setRoles([$entityInstance->getVirtualRole()]);
        }
        $entityInstance->setPassword($entityInstance->virtual_password, new UserPasswordHasher($this->basePasswordHasher));
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('login'),
            TextField::new('virtual_password', 'Password')->setFormType(PasswordType::class)
                ->hideOnIndex()->hideOnDetail()->hideWhenUpdating(),
            TextField::new('first_name'),
            TextField::new('last_name'),
            TextField::new('mid_name'),
            TelephoneField::new('phone'),
            TextField::new('slack_id'),

            ChoiceField::new('virtual_role', 'Role')->setChoices(UserRoles::ALLOWED_ROLES)
        ];
    }
}
