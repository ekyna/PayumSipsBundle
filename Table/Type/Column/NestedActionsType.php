<?php

namespace Ekyna\Bundle\AdminBundle\Table\Type\Column;

use Ekyna\Bundle\AdminBundle\Acl\AclOperatorInterface;
use Ekyna\Component\Table\Extension\Core\Type\Column\NestedActionsType as BaseType;
use Ekyna\Component\Table\Table;
use Ekyna\Component\Table\TableConfig;
use Ekyna\Component\Table\View\Cell;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\PropertyAccess\PropertyAccessor;

/**
 * Class NestedActionsType
 * @package Ekyna\Bundle\AdminBundle\Table\Type\Column
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class NestedActionsType extends BaseType
{
    /**
     * @var \Ekyna\Bundle\AdminBundle\Acl\AclOperatorInterface
     */
    private $aclOperator;

    public function __construct(AclOperatorInterface $aclOperator)
    {
        $this->aclOperator = $aclOperator;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureButtonOptions(OptionsResolverInterface $resolver)
    {
        parent::configureButtonOptions($resolver);

        $resolver
            ->setDefaults(array(
                'permission' => null,
            ))
            ->setAllowedTypes(array(
                'permission' => array('string', 'null'),
            ));
    }

    /**
     * {@inheritdoc}
     */
    protected function prepareButtons(TableConfig $config, array $buttonsOptions)
    {
        $buttonResolver = new OptionsResolver();
        $this->configureButtonOptions($buttonResolver);

        $dataClass = $config->getDataClass();

        $tmp = array();
        foreach ($buttonsOptions as $buttonOptions) {
            $tmpButton = $buttonResolver->resolve($buttonOptions);
            if (null !== $tmpButton['permission'] && !$this->aclOperator->isAccessGranted($dataClass, $tmpButton['permission'])) {
                continue;
            }
            $tmp[] = $tmpButton;
        }
        return $tmp;
    }

    /**
     * {@inheritdoc}
     */
    public function buildViewCell(Cell $cell, Table $table, array $options)
    {
        parent::buildViewCell($cell, $table, $options);

        $cell->setVars(array(
            'type' => 'nested_actions',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'admin_nested_actions';
    }
}
