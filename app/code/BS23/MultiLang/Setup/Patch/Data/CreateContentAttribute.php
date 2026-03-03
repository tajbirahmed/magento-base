<?php
namespace BS23\MultiLang\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Catalog\Model\Product;

class CreateContentAttribute implements DataPatchInterface
{
    private $moduleDataSetup;
    private $eavSetupFactory;

    public function __construct(ModuleDataSetupInterface $moduleDataSetup, EavSetupFactory $eavSetupFactory)
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $attributeId = $eavSetup->getAttributeId(Product::ENTITY, 'content');
        if ($attributeId === false || $attributeId === null) {
            $eavSetup->addAttribute(
                Product::ENTITY,
                'content',
                [
                    'type' => 'text',
                    'backend' => '',
                    'frontend' => '',
                    'label' => 'Content',
                    'input' => 'textarea',
                    'class' => '',
                    'source' => '',
                    'global' => ScopedAttributeInterface::SCOPE_STORE,
                    'visible' => true,
                    'required' => false,
                    'user_defined' => true,
                    'default' => '',
                    'wysiwyg_enabled' => true,
                    'is_html_allowed_on_front' => true,
                    'group' => 'Content'
                ]
            );
        } else {
            $eavSetup->updateAttribute(Product::ENTITY, 'content', 'is_global', ScopedAttributeInterface::SCOPE_STORE);
        }

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    public static function getDependencies() { return []; }
    public function getAliases() { return []; }
}
