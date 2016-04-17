<?php

namespace PoweredByMoe\ApiBundle\Admin;

use OAuth2\OAuth2;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ClientAdmin extends Admin
{
    private $grant_choices = [
        OAuth2::GRANT_TYPE_AUTH_CODE => 'oauth2.grant_type.auth',
        OAuth2::GRANT_TYPE_IMPLICIT => 'oauth2.grant_type.implicit',
        OAuth2::GRANT_TYPE_USER_CREDENTIALS => 'oauth2.grant_type.user_credentials',
        OAuth2::GRANT_TYPE_CLIENT_CREDENTIALS => 'oauth2.grant_type.client_credentials',
        OAuth2::GRANT_TYPE_REFRESH_TOKEN => 'oauth2.grant_type.refresh_token',
        OAuth2::GRANT_TYPE_EXTENSIONS => 'oauth2.grant_type.extensions',
    ];

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('randomId')
            ->add('redirectUris')
            ->add('secret')
            ->add('allowedGrantTypes')
            ->add('id')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('application.name')
            ->add('allowedGrantTypes', 'choice', [
                'multiple' => true,
                'choices' => $this->grant_choices
            ])
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('application', 'sonata_type_model_autocomplete',[
                'property' => 'name',
                'to_string_callback' => function($entity, $property) {
                    return $entity->getName();
                }
            ])
            ->add('randomId')
            ->add('redirectUris', 'sonata_type_native_collection',[
                'allow_add' => true,
                'allow_delete' => true,
            ])
            ->add('secret')
            ->add('allowedGrantTypes', 'choice', [
                'multiple' => true,
                'choices' => $this->grant_choices
            ])
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('randomId')
            ->add('redirectUris')
            ->add('secret')
            ->add('allowedGrantTypes')
            ->add('id')
        ;
    }
}
