<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for creating user.
 *
 * It's best practice for building and handling forms in Symfony.
 * - Separation of concerns: separating the form structure and business logic. This separation makes the codebase more modular and maintainable.
 * - Reusability: we can reuse it across our source code, reduces code duplication and ensures consistency in form layouts and behavior.
 * - Data Transformation and Validation.
 * - Integration with Entities
 * - Automatic Form Rendering: based on buildForm definitions, reduces the amount of manual HTML coding.
 * - Testable: for unit testing. @todo should have unit test for this.
 */
class CreateUserType extends AbstractType
{
    /**
     * Building form to create user.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'First name:', //@todo lang string to support multiple languages instead of hardcoded.
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Last name:',
            ])
            ->add('address', TextType::class, [
                'label' => 'Address:',
            ])
        ;
    }

    /**
     * Mapping form data with User model.
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}